
<div class="container-fluid ">
    <div class="row">
        <div class="page-title col-9 col-md-10">
                Mon profile
        </div>
    </div>
    <div class="row mt-5">
            <form class="activate-validation w-75 mx-auto" action="<?= getUrlFor('profile')?>" method="post" enctype="multipart/form-data">
                <?php if(\core\InputValidator::hasErrors()){?>
                    <div class="alert alert-danger">
                        <ul class="m-0">
                            <?php foreach(\core\InputValidator::getErrors() as $error){?>
                                <?= $error?>
                            <?php }?>
                        </ul>
                    </div>
                <?php }?>
                <div class="row p-1">
                    <?php printMessageIfSet();?>
                </div>

                <div class="form-group">
                    <label for="<?= FIRST_NAME_KEY ?>" class="salon-label">Votre prénom</label>
                    <input
                        data-validate="1"
                        data-validate-pattern="<?= stripAllSlashes( \core\InputValidator::NAME_PATTERN)?>"
                        data-validate-message="Le prénom peut contenir entre 3 et 50 characters"
                        type="text" name="<?= FIRST_NAME_KEY ?>"
                        id="<?= FIRST_NAME_KEY ?>"
                        value="<?= $user->first_name?>"
                        class="salon-input" placeholder="Votre prénom">
                </div>
                <div class="form-group">
                    <label for="<?= LAST_NAME_KEY ?>" class="salon-label">Votre Nom</label>
                    <input type="text"
                           data-validate="1"
                           data-validate-pattern="<?= stripAllSlashes( \core\InputValidator::NAME_PATTERN)?>"
                           data-validate-message="Le nom peut contenir entre 3 et 50 characters"
                           name="<?= LAST_NAME_KEY ?>"
                           value="<?= $user->last_name ?>"
                           id="<?= LAST_NAME_KEY ?>"
                           class="salon-input"
                           placeholder="Votre nom">
                </div>
                <div class="form-group">
                    <label for="<?= EMAIL_KEY ?>" class="salon-label">Votre Email</label>
                    <input
                        data-validate="1"
                        data-validate-pattern="<?= stripAllSlashes( \core\InputValidator::EMAIL_PATTERN)?>"
                        data-validate-message="Doit étre un email valid"
                        type="email"
                        name="<?= EMAIL_KEY ?>"
                        value="<?= $user->email ?>"
                        id="<?= EMAIL_KEY ?>"
                        class="salon-input" placeholder="Votre email">
                </div>
                <div class="form-group">
                    <label for="<?= USER_NAME_KEY ?>" class="salon-label">Votre Nom d'utilisateur</label>
                    <input type="text"
                           name="<?= USER_NAME_KEY ?>"
                           data-validate="1"
                           data-validate-pattern="<?= stripAllSlashes( \core\InputValidator::NAME_PATTERN)?>"
                           data-validate-message="User name can be a word containing between 3 and 50 characters"
                           value="<?= $user->user_name ?>"
                           id="<?= USER_NAME_KEY ?>"
                           class="salon-input"
                           placeholder="Votre nom d'utilisateur">
                </div>
                <div class="ps-2 form-group form-group d-flex flex-row justify-content-start align-items-center">
                    <input type="checkbox"
                           name="<?= PASSWORD_UPDATE_KEY ?>"
                           id="<?= PASSWORD_UPDATE_KEY ?>">

                    <label for="<?= PASSWORD_UPDATE_KEY ?>" class="salon-label">Changer le mot de passe</label>
                </div>

                <div class="form-group password-input-parent">
                    <label for="<?= PASSWORD_KEY ?>" class="salon-label">Votre nouveau mot de passe</label>
                    <input
                        <?= isset($_POST[PASSWORD_UPDATE_KEY])||$_SERVER['REQUEST_METHOD']=='GET'?'data-validate-skip="1"':'' ?>
                        data-validate="1"
                        data-validate-pattern="<?= stripAllSlashes( \core\InputValidator::PASSWORD_PATTERN)?>"
                        data-validate-message="Le mot de passe doit contenir au moins 10 characters"
                        type="password" name="<?= PASSWORD_KEY ?>"
                        value=""
                        class="salon-input"
                        placeholder="Your password "
                        id="<?= PASSWORD_KEY ?>"
                    >
                </div>
                <div class="form-group password-input-parent">
                    <label for="<?= PASSWORD_REPEAT_KEY ?>" class="salon-label">Confirmer le nouveau mot de passe</label>
                    <input
                        <?= isset($_POST[PASSWORD_UPDATE_KEY])||$_SERVER['REQUEST_METHOD']=='GET'?'data-validate-skip="1"':'' ?>
                        data-validate="1"
                        data-validate-match="<?= PASSWORD_KEY ?>"
                        data-validate-message="Les mots de passe doit être identique"
                        type="password"
                        name="<?= PASSWORD_REPEAT_KEY ?>"
                        value=""
                        class="salon-input"
                        id="<?= PASSWORD_REPEAT_KEY ?>"
                        placeholder="Retype your password ">
                </div>
                <?php if($user->role!=ROLE_TYPE_ADMIN):?>
                    <div class="form-group">
                        <label for="<?= PHONE_KEY ?>" class="salon-label">Votre numéro de téléphone</label>
                        <input type="text"
                               name="<?= PHONE_KEY ?>"
                               value="<?= ($user->role==ROLE_TYPE_COIFFEUR?$user->coiffeur->phone:$user->customer->phone) ?>"
                               id="<?= PHONE_KEY ?>"
                               class="salon-input"
                               placeholder="Numéro de tel"
                               data-validate="1"
                               data-validate-pattern="<?= stripAllSlashes(\core\InputValidator::PHONE_PATTERN) ?>"
                               data-validate-message="Doit étre un numéro du telephone valide">
                    </div>
                    <div class="form-group">
                        <div for="id" class="salon-label fs-6">Image de profile:(optionel)</div>
                        <label for="<?= PROFILE_IMG_KEY?>" class="pick-img" >
                            <img class="pick-img__preview" src="<?=  getUserImageUrl($user) ?>">
                            <img class="pick-img__btn" src="<?=img('ic_pick_img.svg')?>">
                            <input type="file" name="<?= PROFILE_IMG_KEY?>" id="<?= PROFILE_IMG_KEY?>" class="pick-img__input">
                        </label>
                    </div>
                    <?php if($user->role==ROLE_TYPE_COIFFEUR):
                        $coiffeur=$user->coiffeur;
                        ?>
                        <div class="coiffeur-option">
                            <div class="form-group">
                                <label for="<?= CITY_KEY ?>" class="salon-label fs-6">Ville</label>
                                <select name="<?= CITY_KEY?>" data-old-value="<?= $coiffeur->city ?>" id="<?= CITY_KEY?>" class="salon-input"
                                        data-validate-skip="1"
                                        data-validate="1"
                                        data-validate-not-equal="0"
                                        data-validate-message="Choisissez une ville">
                                    <option value="0">Selectionner une ville</option>
                                    <!--to do insert here the list of cities-->
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="<?= QUARTIER_KEY ?>" class="salon-label">Quartier</label>
                                <input
                                    value="<?= $coiffeur->quartier ?>"
                                    data-validate-skip="1"
                                    data-validate="1"
                                    data-validate-pattern="<?= stripAllSlashes(\core\InputValidator::NAME_PATTERN) ?>"
                                    data-validate-message="le nom de quartier doit contenir entre 3 et 20 characters"
                                    name="<?= QUARTIER_KEY?>"
                                    id="<?= QUARTIER_KEY?>"
                                    class="salon-input"
                                    placeholder="le nom de quartier ou est situé votre salon">
                            </div>
                            <div class="form-group">
                                <label for="<?= STORE_NAME_KEY ?>" class="salon-label">Nom de salon</label>
                                <input
                                    value='<?= $coiffeur->store_title ?>'
                                    data-validate-skip="1"
                                    data-validate="1"
                                    data-validate-pattern="<?= stripAllSlashes(\core\InputValidator::NAME_PATTERN) ?>"
                                    data-validate-message="le nom de salon doit contenir entre 3 et 20 characters"
                                    name="<?= STORE_NAME_KEY ?>"
                                    id="<?= STORE_NAME_KEY ?>"
                                    class="salon-input"
                                    placeholder="taper le nom de votre beau salon">
                            </div>
                            <div class="form-group">
                                <div class="salon-label">
                                    Jours d'ouverture:
                                </div>
                                <div class="days">

                                </div>
                                <input type="hidden" name="<?= WORKING_DAYS_KEY?>" value="<?= $coiffeur->work_days?>">
                                </div>
                            <div class="form-group">
                                <div class="time-intervals-picker">
                                    <div class="salon-label">
                                        Horaires d'ouverture:
                                    </div>
                                    <div class="time-intervals-wrapper">
                                    </div>
                                    <div class="interval-btns">
                                        <div class="s-btn primary add-interval-btn ">
                                            +
                                        </div>
                                        <div class="s-btn primary minus-interval-btn ">
                                            -
                                        </div>
                                    </div>
                                    <input type="hidden" name="<?= WORKING_HOURS_KEY?>" value="<?= htmlspecialchars($coiffeur->work_hours) ?>">
                                </div>
                            </div>
                        </div>
                    <?php endif;?>
                <?php endif; ?>
                <div class="form-group">
                    <button class="s-btn primary my-2 my-sm-0 w-100">
                        Enregistrer
                    </button>
                </div>
            </form>
    </div>
    </div>
    <script src="<?= js('user_form.js') ?>"></script>
    <script>
        document.querySelector('#update_password').addEventListener('change', function (e) {
                hidePasswordFileds(!e.target.checked);
        });
        const hidePasswordFileds =(b)=>{
            document.querySelectorAll(".password-input-parent").forEach(function(el){
                if(b)el.classList.add('hidden');
                else el.classList.remove('hidden');
            });
            if(b){
                document.querySelector('#password').setAttribute('data-validate-skip', '1');
                document.querySelector('#password_repeat').setAttribute('data-validate-skip', '1');
            }else{
                document.querySelector('#password').removeAttribute('data-validate-skip');
                document.querySelector('#password_repeat').removeAttribute('data-validate-skip');
            }
        };
        hidePasswordFileds(!document.querySelector('#update_password').checked);
    </script>
</div>