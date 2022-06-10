<div class="container-fluid">
        <div class="row">
            <div class="page-title col-9 col-md-10">
                <?= $service_action=='add'?'ajouter un service':'modification du service' ?>
            </div>
        </div>
        <div class="row">
            <form action="<?= $service_action=='add'?'service/add':'service/edit' ?>" method="post" class="col-12 col-md-10 offset-md-1">


            </form>

        </div>
</div>


