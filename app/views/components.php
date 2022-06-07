<style>
    input[type="file"] {
        background-color: red;
    }
    .img-preview{
        width:100px;
        height: 100px;
    }
    #img-input{

    }
</style>
<link rel="stylesheet" href="<?=css('style.css') ?>">
<form action="#">
    <label for="pick-img" class="pick-img" >
        <img class="pick-img__preview" src="<?= img('profile-avatar.svg') ?>">
        <img class="pick-img__btn" src="<?=img('ic_pick_img.svg')?>">
        <input type="file" name="img" id="pick-img" class="pick-img__input">
    </label>

    <label for="time">time</label>
    <div class="days">

    </div>
    <div class="time-intervals-picker">
        <div class="time-intervals-wrapper">
        </div>
        <div class="interval-btns">
            <button class="s-btn primary add-interval-btn ">
                +
            </button>
            <button class="s-btn primary minus-interval-btn ">
                -
            </button>
        </div>

    </div>
    <button id="test">test data</button>
</form>
<div class="services-container">
    <div class="service-card">
        <img src="<?= img('landing_bg.jpg')?>" alt="service-img" class="service-card-img">
        <div class="service-card-content">
            <h3 class="service-owner_info">
                <img src="<?= img('salon_en_lign.jpeg')?>" alt="" class="service-owner-avatar">
                <p class="service-owner-name">Jack Man</p>
            </h3>
            <h3 class="service-card-title">
                Coiffeur
            </h3>
            <p class="service-card-description">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                Aperiam, doloremque.
            </p>
            <div class="service-card-price">
                starting at
            <span class="service-card-price-value">
                20
            </span>
                <span class="service-card-price-currency">
                $
            </span>
            </div>
        </div>


</div>
</div>

    <script>
        document.querySelector('#pick-img').addEventListener('change',(e)=>{
            let reader=new FileReader();
            reader.readAsDataURL(e.target.files[0]);
            reader.onload=function(readerEvent){
                document.querySelector('.pick-img__preview').src=readerEvent.target.result;
            }
        });
        //for days of the wek picker
        let selectedDays='1,3,4,5';
        let daysContainer=document.querySelector('.days');
        const days_list=['lundi','mardi','mercredi','jeudi','vendredi','samedi','dimanche'];
        for(let i=0;i<days_list.length;i++){
            let dayName=days_list[i];
            let input=document.createElement('input');
            input.type='checkbox';
            input.name="day-"+i;
            input.value=i;
            input.dataset.index=i;
            input.id="day-"+i;

            input.style.display='none';
            let label=document.createElement('label');
            label.classList.add('day-label');
            label.htmlFor="day-"+i;
            label.innerText=dayName;
            daysContainer.appendChild(label);
            label.appendChild(input);
            input.addEventListener('change',(e)=>{
                e.target.parentElement.classList.toggle('active');
            });
        }

        document.getElementById('test').addEventListener('click',(e)=>{
            e.preventDefault();
            let inputsReturn=[];
            document.querySelector('.days').querySelectorAll('input').forEach((e)=>{
                if(e.checked){
                    inputsReturn.push(e.dataset.index);
                }

            });

            console.log(inputsReturn.join(','));
        });
        selectedDays=selectedDays.split(',');
        console.log(selectedDays);
        document.querySelector('.days').querySelectorAll('input').forEach(input=>{
            let index=input.dataset.index;
            if(selectedDays.includes(index)){
                console.log("checked "+index);
                input.checked=true;
                input.parentElement.classList.add('active');
            };
        });

        //for time intervals picker
        const addTimeInterval=(index,min,max)=>{
            console.log('index is '+index);
            const intervalElement=document.createElement("div");
            intervalElement.classList.add('time-interval');
            intervalElement.innerHTML=`
                    <label for="interval-${index}-start" class="time-label">de</label>
                    <input min="${min}" max="${max}" type="time" name="start" id="interval-${index}-start" class="time-input">
                    <label for="interval-${index}-end" class="time-label">à</label>
                    <input min="${min}" max="${max}" type="time" name="start" id="interval-${index}-end" class="time-input">
                `;
            document.querySelector('.time-intervals-wrapper').appendChild(intervalElement);
        }
        var index=0;
        addTimeInterval(index);
        document.querySelector('.add-interval-btn').addEventListener('click',(e)=>{
            e.preventDefault();
            index++;
            addTimeInterval(index);
        })
        document.querySelector('.minus-interval-btn').addEventListener('click',(e)=>{
            e.preventDefault();
            if(index!=0) {
                document.querySelector('.time-intervals-wrapper').removeChild(document.querySelector('.time-intervals-wrapper').lastChild);
                index--;
            }
        })
        //for service card
    </script>
    <input type="text" class="salon-input" placeholder="enter an email">
