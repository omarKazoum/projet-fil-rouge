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
            <tr >
                <td>
                    <img style="width:100px;height:100px" src="<?=$service->img ?>" alt="<?= $service->title?>">
                </td>
                <td><?= $service->title ?></td>
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
<div class="modal fade bd-example-modal-sm" id='modal1' tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Réserver le service <span id="service_title"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
<div class="modal-body">
            <form action="<?= getUrlFor('services/reserve')?>" method="post">
                <input type="hidden" name="service_id" id="service_id">
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" class="form-control" id="date" name="date">
                </div>
                <div class="form-group">
                    <label for="time">Time</label>
                    <input type="time" class="form-control" id="time" name="time">
                </div>
                <button type="submit" class="s-btn primary">Réserver</button>
            </form>
</div>
<script>
   /* document.querySelectorAll('.reserve-btn').forEach(function(btn){
        btn.addEventListener('click',function(e){
            e.preventDefault();
            var service_id = e.target.getAttribute('data-service-id');

        });
    });
*/
</script>