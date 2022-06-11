<div class="container-fluid">
        <div class="row">
            <div class="page-title col-9 col-md-10">
                <?= $service_action=='add'?'Ajouter un service':'Modification du service'.$serviceToEdit->title ?>
            </div>
        </div>
        <div class="row">
            <form action="<?= getUrlFor($service_action=='add'?'services/add':'services/update') ?>" method="post" class="col-12 " enctype="multipart/form-data">
                <?php
                if(\core\InputValidator::hasErrors()){?>
                    <div class="alert alert-danger">
                        <?= implode('',\core\InputValidator::getErrors())?>
                    </div>
                <?php } ?>

                <div class="form-group">
                    <label for="<?= SERVICE_TITLE_KEY?>">Nom du service</label>
                    <input type="text" class="form-control" id="<?= SERVICE_TITLE_KEY?>" name="<?= SERVICE_TITLE_KEY?>" value="<?= $serviceToEdit->title?? $_POST[SERVICE_TITLE_KEY]??''?>">
                </div>
                <!-- service description-->
                <div class="form-group">
                    <label for="<?= SERVICE_DESCRIPTION_KEY?>">Description du service</label>
                    <textarea class="form-control" id="<?= SERVICE_DESCRIPTION_KEY?>" name="<?= SERVICE_DESCRIPTION_KEY?>" rows="3"><?= $serviceToEdit->description?? $_POST[SERVICE_DESCRIPTION_KEY]??''?></textarea>
                </div>
                <!-- service price-->
                <div class="form-group">
                    <label for="<?= SERVICE_PRICE_KEY?>">Prix du service</label>
                    <input type="number" class="form-control" id="<?= SERVICE_PRICE_KEY?>" name="<?= SERVICE_PRICE_KEY?>" value="<?= $serviceToEdit->price?? $_POST[SERVICE_PRICE_KEY]??''?>">
                </div>
                <!-- service category-->
                <div class="form-group">
                    <label for="<?= SERVICE_CATEGORY_ID_KEY?>">Catégorie du service</label>
                    <select class="form-select" id="<?= SERVICE_CATEGORY_ID_KEY?>" name="<?= SERVICE_CATEGORY_ID_KEY?>">
                        <?php foreach(\app\models\Category::all() as $category): ?>
                            <option value="<?= $category->id?>" <?= isset($serviceToEdit) && $serviceToEdit->category_id==$category->id?'selected':''?>><?= $category->title?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <!-- service image -->
                <div class="form-group">
                    <label for="<?= SERVICE_IMG_KEY?>">Image du service</label>
                    <input type="file" class="form-control" id="<?= SERVICE_IMG_KEY?>" name="<?= SERVICE_IMG_KEY?>" value="<?= $serviceToEdit->img?? $_POST[SERVICE_IMG_KEY]??''?>">
                </div>
            <!-- submit -->
            <div class="form-group">
                <button type="submit" class="s-btn primary">Enregistrer</button>
            </form>

        </div>
</div>


