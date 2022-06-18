document.querySelectorAll('.pick-img__input').forEach(btn=>{
    btn.addEventListener('change',(e)=>{
            let reader=new FileReader();
            reader.readAsDataURL(e.target.files[0]);
            reader.onload=function(readerEvent){
                document.querySelector('.pick-img__preview').src=readerEvent.target.result;
            }
        });
})
//////////////////////////////////////////////
//////////for days of the wek picker//////////
//////////////////////////////////////////////
let working_days_hidden_input=document.getElementsByName('working_days')[0];
let selectedDays=working_days_hidden_input.value!=''?working_days_hidden_input.value:[];
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
        let index=e.target.dataset.index;
        if(e.target.checked){
            if(!selectedDays.includes(index)){
                selectedDays.push(index);
            }
        }else
        {
            selectedDays.splice(selectedDays.indexOf(index),1);
        }
        updateDaysInput();
    });
}
//take data from days check inputs and put it in the hidden input
const updateDaysInput=()=>{
    document.querySelector('input[name="working_days"]').value="["+selectedDays.join(',')+"]";
}
//take data from the hidden input and put it in check inputs
const updateDaysInputFromHiddenInput=()=>{
    let days=JSON.parse(document.querySelector('input[name="working_days"]').value);
    days.forEach(day=>{
        document.querySelector(`.day-label[for="day-${day}"]`).classList.add('active');
        document.querySelector(`.day-label[for="day-${day}"] input`).checked=true;
    });
}
updateDaysInputFromHiddenInput();

/////////////////////////////////////////
/////// for time intervals picker ///////
/////////////////////////////////////////
/**
 * insert a new time interval in dom
 * @param index
 * @param min
 * @param max
 */
const addTimeInterval=(index,min,max='23:59')=> {
    console.log('index is ' + index);
    const intervalElement = document.createElement("div");
    intervalElement.setAttribute('data-index', index);
    intervalElement.classList.add('time-interval');
    intervalElement.innerHTML = `
                    <label for="interval-${index}-start" class="time-label">de</label>
                    <input value="${min}" data-min="${min}" data-max="${max}" type="time" name="start" id="interval-${index}-start" class="time-input start">
                    <label for="interval-${index}-end" class="time-label">à</label>
                    <input value="${max}" data-min="${min}" data-max="${max}" type="time" name="start" id="interval-${index}-end" class="time-input end">
                `;
    document.querySelector('.time-intervals-wrapper').appendChild(intervalElement);
    intervalElement.querySelectorAll('input').forEach(input => {
        input.addEventListener('change', (e) => {
            console.log(e.target.value);
            updateWorkingHoursInput();
        });
    });
}
/**
 * update an existing time interval
 */
const updateTimeInterval=(index,min,max='23:59')=> {
    let interval=document.querySelector(`.time-interval[data-index="${index}"]`);
    interval.querySelector('.start').value=min;
    interval.querySelector('.end').value=max;
    updateWorkingHoursInput();
}
//update working hours hidden input from time intervals
const updateWorkingHoursInput=()=>{
    workingHoursJson=[];
    document.querySelectorAll(".time-interval").forEach(intervalParent=>{
        console.log(intervalParent);
        workingHoursJson.push([intervalParent.querySelector('.start').value,intervalParent.querySelector('.end').value]);
    });
    document.querySelector('input[name="working_hours"]').value=JSON.stringify(workingHoursJson);
}
//init time intervals
const timeIntervalsHiddenInput=document.getElementsByName('working_hours')[0];
let index=0;
let workingHoursJson=[];
if(timeIntervalsHiddenInput.value!=''){
    console.log('time intervals hidden input is not empty');
    JSON.parse(timeIntervalsHiddenInput.value).forEach(interval=>{
        //insert interval
        addTimeInterval(index,interval[0],interval[1]);
        console.log("inserted interval:",interval);
    });
}else{
    console.log('time intervals hidden input is empty');
    addTimeInterval(index,"08:00");
    updateWorkingHoursInput();
}
document.querySelector('.add-interval-btn').addEventListener('click',(e)=>{
    e.preventDefault();

    index++;
    let timeIntervals=document.querySelectorAll('.time-interval');
    timeIntervals[0].parentElement.querySelectorAll('input').forEach(input=>{
        input.setAttribute('disabled','true');
    });
    addTimeInterval(index,timeIntervals[timeIntervals.length-1].querySelector('.end').value);
    updateWorkingHoursInput();
})
document.querySelector('.minus-interval-btn').addEventListener('click',(e)=>{
    e.preventDefault();
    let intervalsWrapper=document.querySelector('.time-intervals-wrapper');
    if(index!=0) {
        intervalsWrapper.removeChild(document.querySelector('.time-intervals-wrapper').lastChild);
        index--;
        updateWorkingHoursInput();
        const intervals=document.querySelectorAll('.time-interval');
        console.log("enabling");
        console.log(intervals[intervals.length-1]);
        intervals[intervals.length-1].querySelectorAll('input').forEach(value => {
            value.removeAttribute("disabled");
        })

    }
})
//TODO:: implement this function
const isTimeIntervalValid=()=>{
    console.log(workingHoursJson);
    let valid=true;
    workingHoursJson.forEach((interval,index)=> {
        console.log(index+'=>'+interval.toString());
        if(interval[0]>=interval[1]){
            valid=false;
            console.log("first is greater than second");
        }
        if(workingHoursJson.length>1 && index>0 && index<workingHoursJson.length-2 && interval[1]>workingHoursJson[index+1][0]){
            valid=false;
            console.log("second in this interval is greater than first in next interval");
        }
    });
   // console.log(valid);
    return valid;
}
//validate hours or reset them
document.querySelectorAll('.time-interval input').forEach(input=>{
    input.addEventListener('change',(e)=>{
        if(e.target.classList.contains('start')){
            console.log('start changed');
            const interval=e.target.parentElement;
            const end=interval.querySelector('.end');
            if(end.value<e.target.value){

            }
        }

    });
});
/////////////////////////////////////////
///////////adapt to user  role//////////////////
/////////////////////////////////////////
document.getElementsByName('role').forEach(radioBtn=>{
    // if (radioBtn.value ==3) {
    //     document.querySelector('.coiffeur-option').classList.remove('hidden');
    // }else{
    //     document.querySelector('.coiffeur-option').classList.add('hidden');
    // }
     radioBtn.addEventListener('change',(e)=> {
        console.log("radio btn status changed");
        console.log(radioBtn);
        if (radioBtn.value ==3) {
            document.querySelector('.coiffeur-option').classList.remove('hidden');
            enableValidationFromCoiffeurInputs(true);
        }else{
            enableValidationFromCoiffeurInputs(false);
            document.querySelector('.coiffeur-option').classList.add('hidden');
        }
    });
})
const enableValidationFromCoiffeurInputs=(b)=>{

        document.querySelectorAll(".coiffeur-option input[data-validate=\"1\"]").forEach(input=>{
            if(!b) {
                input.setAttribute("data-validate-skip", "1");
            }else{
                input.removeAttribute("data-validate-skip");
            }
        });
}
////////////////////////////////////////
//////////////for cities////////////////
////////////////////////////////////////
const cities_data=["Ouarzazate","Casablanca","El Kelaa des Srarhna","Fès","Tangier","Marrakech","Sale","Rabat","Meknès","Kenitra","Agadir","Oujda-Angad","Tétouan","Taourirt    ","Temara","Safi","Laâyoune","Mohammedia","Kouribga","Béni Mellal","El Jadid","Ait Melloul","Nador","Taza","Settat","Barrechid","Al Khmissat"    ,"Inezgane","Ksar El Kebir","Larache","Guelmim","Khénifra","Berkane","Bouskoura","Al Fqih Ben Çalah","Oued Zem","Sidi Slimane","Errachidia","    Guercif","Oulad Teïma","Ad Dakhla","Ben Guerir","Wislane","Tiflet","Lqoliaa","Taroudannt","Sefrou","Essaouira","Fnidq","Ait Ali","Sidi Qacem"    ,"Tiznit","Moulay Abdallah","Tan-Tan","Warzat","Youssoufia","Sa’ada","Martil","Aïn Harrouda","Skhirate","Ouezzane","Sidi Yahya Zaer","Benslim    ane","Al Hoceïma","Beni Enzar","M’diq","Sidi Bennour","Midalt","Azrou","Ain El Aouda","Beni Yakhlef","Semara","Ad Darwa","Al Aaroui","QasbatTadla","Boujad","Jerada","Chefchaouene","Mrirt","Sidi Mohamed Lahmar","Tineghir","El Aïoun","Azemmour","Temsia","Zoumi","Laouamra","Zagora","Ait Ourir","Sidi Bibi","Aziylal","Sidi Yahia El Gharb","Biougra","Taounate","Bouznika","Aourir","Zaïo","Aguelmous","El Hajeb","Mnasra","Mediouna","Zeghanghane","Imzouren","Loudaya","Oulad Zemam","Bou Ahmed","Tit Mellil","Arbaoua","Douar Oulad Hssine","Bahharet Oulad Ayyad","MechraaBel Ksiri","Mograne","Dar Ould Zidouh","Asilah","Demnat","Lalla Mimouna","Fritissa","Arfoud","Tameslouht","Bou Arfa","Sidi Smai’il","Taza","Souk et Tnine Jorf el Mellah","Mehdya","Oulad Hammou","Douar Oulad Aj-jabri","Aïn Taoujdat","Dar Bel Hamri","Chichaoua","Tahla","Bellaa","Oulad Yaïch","Ksebia","Tamorot","Moulay Bousselham","Sabaa Aiyoun","Bourdoud","Aït Faska","Boureït","Lamzoudia","Oulad Said","Missour","Ain Aicha","Zawyat ech Cheïkh","Bouknadel","El Ghiate","Safsaf","Ouaoula","Douar Olad. Salem","Oulad Tayeb","Echemmaia Est","Oulad Barhil","Douar ’Ayn Dfali","Setti Fatma","Skoura","Douar Ouled Ayad","Zawyat an Nwaçer","Khenichet-sur Ouerrha","Ayt Mohamed","Gueznaia","Oulad Hassoune","BniFrassen","Tifariti","Zawit Al Bour"];
cities_select=document.querySelector("select[name='city']");
cities_data.forEach(city=>{
    const option=document.createElement('option');
    if(cities_select.dataset.oldValue==city)
        option.setAttribute('selected',"true");

    option.value=city;
    option.innerText=city;
    cities_select.appendChild(option);
})