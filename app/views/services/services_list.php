<div class="container-fluid">
    <div class="row">
        <div class="page-title col-9 col-md-10">
            Services
        </div>
        <div class="col-3 col-md-2">
        <?php if(\core\SessionManager::getInstance()->getLoggedInUser()->role==ROLE_TYPE_COIFFEUR){ ?>
            <a href="<?= getUrlFor('services/add')?>" class="s-btn primary wrap col-3 col-md-2">
                <i class="fa fa-plus"></i>Add Service</a>
        <?php }?>
        </div>
    </div>
    <?php require_once dirname(__FILE__) .'/../templates/search_header.php'?>

    <div class="row p-1">
        <?php printMessageIfSet();?>
    </div>
    <div class="row">
        <div class="table-responsive">
        <table class="table table-responsive">
        <?php
        if(count($services)>0){
        ?>
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">title</th>
                <th scope="col">description</th>
                <th scope="col">price</th>
                <th scope="col">category</th>
                <th scope="col">nom de coiffeur</th>
                <th data-bs-toggle="tooltip" data-bs-placement="top" title="Nombre total reçue par ce service de la part de tous les clients" scope="col">Demandes faites <i class="fa-solid fa-circle-info"></i></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
        <?php  foreach($services as $service){ ?>
            <tr class="service-item"
                data-service-hours='<?= $service->coiffeur->work_hours ?>'
                data-service-days='<?= $service->coiffeur->work_days  ?>'
            >
            <td>
                <img style="width:100px;height:80px" src="<?=$service->img!=PROFILE_IMG_NOT_UPLOADED_KEY?uploaded($service->img):img('service_img_place_holder.png') ?>" alt="<?= $service->title?>">
            </td>
            <td class="service-title"><?= $service->title ?></td>
            <td><?= $service->description ?></td>
            <td><?= $service->price ?> MAD</td>
            <td><?= $service->category->title ?></td>
            <td><?= $service->user->user_name ?></td>
            <td><?= $service->serviceRequests->count() ?></td>
            <td>
                <div class="action-btns-wrapper">
                    <div class="action-btns">
                                <!-- supprimer-->
                                <?php if(\core\SessionManager::getInstance()->getLoggedInUser()->role!=ROLE_TYPE_CUSTOMER){ ?>
                                    <a href="<?= getUrlFor('services/update/'.$service->id)?>" class="s-btn primary p-1 d-flex justify-content-center align-items-center" title="Modifier ce service">
                                        <i class="fa fa-edit"></i>Modifier
                                    </a>
                                <?php } ?>
                                <?php if($service->serviceRequests->count()<1 AND \core\SessionManager::getInstance()->getLoggedInUser()->role!=ROLE_TYPE_CUSTOMER){ ?>
                                    <a href="<?= getUrlFor('services/delete/'.$service->id) ?>" class="s-btn danger p-1 d-flex justify-content-center align-items-center confirm" data-confirm-msg="Etes vous sur de vouloir supprimer ce service ?" title="Supprimer ce service">
                                        <i class="fa fa-trash" ></i>Supprimer
                                    </a>
                                <?php }?>
                                <?php if(\core\SessionManager::getInstance()->getLoggedInUser()->role==ROLE_TYPE_CUSTOMER){ ?>
                                    <a  href="#" class="s-btn success p-1 d-flex justify-content-center align-items-center reserve-btn" data-service-id="<?= $service->id?>">
                                        <i class="fa fa-shopping-cart" title="Réserver ce service"></i>
                                        Réserver</a>
                                    <?php } ?>
                    </div>
                </div>
            </td>
            </tr>
        <?php } ?>
        </tbody>
        <?php }else{?>
            <div class="alert alert-info">
                <strong>info:</strong>Aucun service trouvé !
            <div>
            <?php } ?>
        </table>
    </div>
    </div>
    <div class="modal fade bd-example-modal-sm" id='service-modal' tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Réserver le service "<span id="service-title"></span>"</h5>
                </div>
                <div class="modal-body">
                    <div class="alert alert-success">
                        <strong>info:</strong>Ce service est diponible:<br>
                        <span id="modal-service-days">Les </span>
                        <span id="modal-service-hours"></span>

                    </div>
                    <form onsubmit="return false" action="<?= getUrlFor('services/reserve')?>" method="post">
                        <input type="hidden" name="service_id" id="service_id">
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" class="form-control" id="date" name="<?= SERVICE_REQUEST_DATE_KEY ?>" required>
                            <div class="invalid-feedback">
                                Please select a date.
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="time">Time</label>
                            <input type="time" class="form-control" id="time" name="<?= SERVICE_REQUEST_TIME_KEY ?>" required>
                            <div class="invalid-feedback">
                                Please select a time.
                            </div>
                        </div>
                        <button class="s-btn primary reserve-btn">Réserver</button>
                        <a onclick="$('#service-modal').modal('hide');" class="s-btn primary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        // if the reserv btn is clicked we will prevent the default action and show the modal after we get the service data
        document.querySelectorAll('.service-item .reserve-btn').forEach(function(btn) {
           btn.addEventListener('click', function (e) {
               e.preventDefault();
               // get the service data and show it in the modal
               const item=e.target.closest('.service-item');
               console.log("item",item);
               let serviceDaysFromItem=item.dataset.serviceDays;
               let serviceHoursFromItem=item.dataset.serviceHours;
               console.table("time",serviceHoursFromItem);  //debug
               console.table("days",serviceDaysFromItem);  //debug
               const hoursInModal=document.querySelector('#modal-service-hours');
               console.log("hoursInModal",hoursInModal);  //debug
               const daysInModal=document.querySelector('#modal-service-days');
               console.log("daysInModal",daysInModal);  //debug
               //let 's loop all days and insert them in the modal
               JSON.parse(serviceDaysFromItem).forEach(function(day){
                   daysInModal.innerHTML+=`<span class="badge badge-secondary">${getDayFromInt(day)}</span>`;
               });
                //let 's loop all hours and insert them in the modal
               let hoursTextArray=[];
               JSON.parse(serviceHoursFromItem).forEach(function(hoursInterval){
                   hoursTextArray.push(`<span class="badge badge-primary">${hoursInterval[0]} à ${hoursInterval[1]}</span>`);
                  });
               hoursInModal.innerHTML='De '+hoursTextArray.join('<br> Ou De');
               //let's display the modal
               $('#service-modal').modal('show');
               console.log(e.target.dataset);
               document.querySelector('#service-modal #service_id').value = e.target.dataset.serviceId;
               let title = e.target.closest('.service-item').querySelector('.service-title').innerText;
               document.querySelector('#service-modal #service-title').innerText = title;
               document.querySelectorAll('#service-modal input').forEach(function (input) {
                   if (input.name == '<?= SERVICE_REQUEST_DATE_KEY ?>' || input.name == '<?= SERVICE_REQUEST_TIME_KEY ?>') {
                       input.value = '';
                   if(input.name=='<?= SERVICE_REQUEST_DATE_KEY ?>'){
                       input.setAttribute('min', new Date().toISOString().split('T')[0]);
                   }
                   }
               });
           });
       });
       document.querySelector("#service-modal .reserve-btn").addEventListener('click',function(e) {
           console.log("reserve btn clicked");
           e.preventDefault();
           //prepare the form data
           let form = document.querySelector('#service-modal form');
           if(form.checkValidity()) {
               console.log("form is valid");
               let formData = new FormData(form);
               console.log(formData.get('service_id'));
               $.ajax({
                   url: form.action,
                   method: 'POST',
                   data: formData,
                   processData: false,
                   contentType: false,
                   success: function (data) {
                       console.log("api response: ");
                       console.table(data);
                       $('#service-modal').modal('hide');
                       if (data.status == '1') {
                           alertSalon('success','',data.message);
                            let id= data.data.service.id;
                            console.log("id from data is : "+id);
                            let reserveBtn=document.querySelector("[data-service-id='"+id+"']");
                            let newBtn=document.createElement('div');
                            newBtn.innerHTML="Réservé";
                            newBtn.classList.add('p-1');
                            reserveBtn.parentNode.replaceChild(newBtn,reserveBtn);
                       }
                   }
               });
           }else{

               alertSalon('error','Error de validation','une date et une heure sont obligatoire!');
               console.log("form is not valid");
           }
        });
       /**
        * @param dayInt{int}
        * @return {string}
        */
       const getDayFromInt=(dayInt)=>{
           let days=['Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche'];
           if(dayInt>=0 && dayInt<7){
               return days[dayInt];
           }else
                console.error('dayInt is not valid:'+dayInt);
       }
    </script>
</div>