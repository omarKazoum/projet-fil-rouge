<div class="container-fluid">
    <div class="row">
    <div class="page-title col-9 col-md-10">
    Services
    </div>
    <a href="<?= getUrlFor('services/add')?>" class="s-btn primary wrap col-3 col-md-2">
    <i class="fa fa-plus"></i>
    Add Service
    </a>
    </div>
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
        <th scope="col"></th>

        </tr>
        </thead>
        <tbody>
        <?php  foreach($services as $service){ ?>
        <tr class="service-item">
        <td >
            <img style="width:100px;height:100px" src="<?=$service->img ?>" alt="<?= $service->title?>">
        </td>
        <td class="service-title"><?= $service->title ?></td>
        <td><?= $service->description ?></td>
        <td><?= $service->price ?>MAD</td>
        <td><?= $service->category->title ?></td>
        <td><?= $service->user->user_name ?></td>
        <td>
            <div class="d-flex justify-content-center">


                        <a href="<?= getUrlFor('')?>" class="s-btn primary p-1 d-flex justify-content-center align-items-center" title="Modifier ce service"><i class="fa fa-edit"></i>Modifier</a>
                        <a  href="#" class="s-btn danger p-1 d-flex justify-content-center align-items-center" title="Supprimer ce service"><i class="fa fa-trash" ></i>Supprimer</a>
                        <a  href="#" class="s-btn success p-1 d-flex justify-content-center align-items-center reserve-btn" data-service-id="<?= $service->id?>"><i class="fa fa-shopping-cart" title="Réserver ce service"></i>Réserver</a>
            </div>
        </td>

        </tr>
        <?php } ?>
        </tbody>
        <?php } ?>
        </table>
    </div>
    <div class="modal fade bd-example-modal-sm" id='service-modal' tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Réserver le service "<span id="service-title"></span>"</h5>
            </div>
            <div class="modal-body">
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
       document.querySelectorAll('.service-item .reserve-btn').forEach(function(btn) {
           btn.addEventListener('click', function (e) {
               e.preventDefault();
               $('#service-modal').modal('show');
               console.log(e.target.dataset);
               document.querySelector('#service-modal #service_id').value = e.target.dataset.serviceId;
               let title = e.target.closest('.service-item').querySelector('.service-title').innerText;
               document.querySelector('#service-modal #service-title').innerText = title;
               document.querySelectorAll('#service-modal input').forEach(function (input) {
                   if (input.name == '<?= SERVICE_REQUEST_DATE_KEY ?>' || input.name == '<?= SERVICE_REQUEST_TIME_KEY ?>') {
                       input.value = '';
                   }
               });
           });
       });
       document.querySelector("#service-modal .reserve-btn").addEventListener('click',function(e) {
           console.log("reserve btn clicked");
           e.preventDefault();
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

                           document.querySelector("")

                       }
                   }
               });
           }else{
              /* Swal.fire({
                   icon: 'error',
                   title: 'Error de validation',
                   text: 'une date et une heure sont obligatoire!',
                   footer: ''
               });*/
               alertSalon('error','Error de validation','une date et une heure sont obligatoire!');
               console.log("form is not valid");
           }
        });
    </script>
</div>