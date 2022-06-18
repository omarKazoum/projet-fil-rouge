<div class="container-fluid">
    <div class="row">
        <div class="page-title col-9 col-md-10">
            Categories
        </div>
        <a href="#" class="s-btn primary wrap col-3 col-md-2" id="addCategorieBtn">
            <i class="fa fa-plus"></i>
            Ajouter une catégorie
        </a>
    </div>
    <?php require_once dirname(__FILE__) .'/../templates/search_header.php'?>
    <div class="row p-1">
        <?php printMessageIfSet();?>
    </div>
    <div class="table-responsive">
        <table class="table table-responsive">
            <?php
            if(count($categories)>0){
                ?>
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">title</th>
                </tr>
                </thead>
                <tbody>
                <?php  foreach($categories as $categorie){ ?>
                    <tr class="category-item">
                        <td class="category-id" ><?= $categorie->id ?></td>
                        <td class="category-title"><?= $categorie->title ?></td>
                        <td>
                            <div class="action-btns-wrapper">
                                <div class="action-btns">
                                        <!-- supprimer-->
                                        <?php if($categorie->services->count()<1){ ?>
                                        <a data-action="confirm" data-confirm-msg="Êtes-vous sûr de vouloir supprimer cette catégorie ?" href="<?= getUrlFor('categories/delete/'.$categorie->id)?>" class="s-btn danger p-1 d-flex justify-content-center align-items-center salon-confirm" title="Confirmer cette réservation"><i class="fa fa-trash"></i>Supprimer</a>
                                        <?php } ?>
                                        <!-- modifier-->
                                        <a href="<?= getUrlFor('categories/update/'.$categorie->id)?>" class="s-btn primary p-1 d-flex justify-content-center align-items-center edit" title="Modifier cette catégorie"><i class="fa fa-edit"></i>Modifier</a>
                                </div>
                            </div>
                        </td>

                    </tr>
                <?php } ?>
                </tbody>
            <?php } ?>
        </table>
    </div>
    <div class="modal fade bd-example-modal-sm" id='category_modal' tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_title">Modifier la category "<span id="category-title"></span>"</h5>
                </div>
                <div class="modal-body">
                    <form  action="" method="post" class="activate-validation" novalidate>
                        <input type="hidden" name="category_id" id="category_id">
                        <div class="form-group">
                            <label for="category-title">Category Title</label>
                            <input
                                    data-validate="1"
                                    data-validate-pattern="<?= stripAllSlashes(\core\InputValidator::SERVICE_TITLE_PATTERN) ?>"
                                    data-validate-message="le nom de la category doit contenir entre 3 et 20 characters"
                                    type="text" class="form-control" id="category-title" name="<?= CATEGORY_TITLE_KEY ?>" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="s-btn primary p-1 d-flex justify-content-center align-items-center" value="Enregistrer">

                            </input>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= js('reservations_list.js')?>"></script>
    <script>
        const addCategorieEndpoint = '<?= getUrlFor('categories/save')?>';
        const updateCategorieEndpoint = '<?= getUrlFor('categories/update')?>';
        //for add category btn
        document.querySelector('#addCategorieBtn').addEventListener('click',function(e) {
            e.preventDefault();

            let modal = $('#category_modal');
            modal.modal('show');
            document.querySelector('#category_modal form').setAttribute('action',addCategorieEndpoint);
            document.querySelector('#category_modal #modal_title').innerText='Ajouter une catégorie';
        });
        //for edit category btn
        document.querySelectorAll('.edit').forEach(btn=>{
            btn.addEventListener('click',function(e) {
                console.log('edit');
                e.preventDefault();
                let modal = $('#category_modal');
                modal.modal('show');
                document.querySelector('#category_modal form').setAttribute('action',updateCategorieEndpoint);
                document.querySelector('#category_modal #modal_title').innerText='Modifier Une categorie';
                let category_id = e.target.closest('.category-item').querySelector('.category-id').innerText;
                let category_title = e.target.closest('.category-item').querySelector('.category-title').innerText;
                document.querySelector('#category_modal #category_id').value = category_id;
                document.querySelector('#category_modal #category-title').value = category_title;
            });
        })

    </script>
    <script src="<?= js('confirm.js')?>"></script>
</div>