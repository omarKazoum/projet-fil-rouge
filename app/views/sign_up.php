<?= \core\InputValidator::error('test') ??"nothing"?>
<div class="container-fluid ">
    <div class="row">
        <div class="col-md-6 offset-md-3 col-12 offset-0 pt-3">
            <h1 class="page-title text-center my-4">
                Créer un compte
            </h1>
            <form class="activate-validation" action="<?= getUrlFor('signup')?>" method="post" enctype="multipart/form-data">
                <?php if(\core\InputValidator::hasErrors()){?>
                    <div class="alert alert-danger">
                        <ul class="m-0">
                            <?php foreach(\core\InputValidator::getErrors() as $error){?>
                                <?= $error?>
                            <?php }?>
                        </ul>
                    </div>
                <?php }?>

                <div class="form-group">
                    <label for="<?= FIRST_NAME_KEY ?>" class="salon-label">Votre prénom</label>
                    <input
                        data-validate="1"
                        data-validate-pattern="<?= stripAllSlashes( \core\InputValidator::NAME_PATTERN)?>"
                        data-validate-message="Le prénom peut contenir entre 3 et 50 characters"
                        type="text" name="<?= FIRST_NAME_KEY ?>"
                        id="<?= FIRST_NAME_KEY ?>"
                        value="<?= $_POST[ FIRST_NAME_KEY]??''?>"
                        class="salon-input" placeholder="Votre prénom">
                </div>
                <div class="form-group">
                    <label for="<?= LAST_NAME_KEY ?>" class="salon-label">Votre Nom</label>
                    <input type="text"
                           data-validate="1"
                           data-validate-pattern="<?= stripAllSlashes( \core\InputValidator::NAME_PATTERN)?>"
                           data-validate-message="Le nom peut contenir entre 3 et 50 characters"
                           name="<?= LAST_NAME_KEY ?>"
                           value="<?= $_POST[ LAST_NAME_KEY]??''?>"
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
                            value="<?= $_POST[ EMAIL_KEY]??''?>"
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
                           value="<?= $_POST[ USER_NAME_KEY]??''?>"
                            id="<?= USER_NAME_KEY ?>"
                           class="salon-input"
                           placeholder="Votre nom d'utilisateur">
                </div>
                <div class="form-group">
                    <label for="<?= PASSWORD_KEY ?>" class="salon-label">Votre mot de passe</label>
                    <input
                        data-validate="1"
                        data-validate-pattern="<?= stripAllSlashes( \core\InputValidator::PASSWORD_PATTERN)?>"
                        data-validate-message="Le mot de passe doit contenir au moins 10 characters"
                        type="password" name="<?= PASSWORD_KEY ?>"
                        value="<?= $_POST[ PASSWORD_KEY]??''?>"
                        class="salon-input"
                        placeholder="Your password "
                        id="<?= PASSWORD_KEY ?>"
                    >
                </div>
                <div class="form-group">
                    <label for="<?= PASSWORD_REPEAT_KEY ?>" class="salon-label">Confirmer votre mot de passe</label>
                    <input
                        data-validate="1"
                        data-validate-match="<?= PASSWORD_KEY ?>"
                        data-validate-message="Les mots de passe doit être identique"
                        type="password" name="<?= PASSWORD_REPEAT_KEY ?>"
                        value="<?= $_POST[ PASSWORD_REPEAT_KEY]??''?>"
                        class="salon-input"
                        id="<?= PASSWORD_REPEAT_KEY ?>"
                        placeholder="Retype your password ">
                </div>
                <div class="form-group">
                    <label for="<?= PHONE_KEY ?>" class="salon-label">Votre numéro de téléphone</label>
                    <input type="text"
                       name="<?= PHONE_KEY ?>"
                       value="<?= $_POST[ PHONE_KEY]??''?>"
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
                        <img class="pick-img__preview" src="<?= img('profile-avatar.svg') ?>">
                        <img class="pick-img__btn" src="<?=img('ic_pick_img.svg')?>">
                        <input type="file" name="<?= PROFILE_IMG_KEY?>" id="<?= PROFILE_IMG_KEY?>" class="pick-img__input">
                    </label>
                </div>
                <div class="form-group flex-row">
                    <div class="salon-label">
                        Je suis:
                    </div>
                    <label for="coiffeur" class="salon-label">
                        Coiffeur
                        <input type="radio"  <?= isset($_POST[ROLE_KEY]) && $_POST[ROLE_KEY]==ROLE_TYPE_COIFFEUR ? "checked":'' ?> value="<?= ROLE_TYPE_COIFFEUR ?>" name="<?= ROLE_KEY?>" id="coiffeur">
                    </label>
                  <label for="client" class="salon-label">
                      Client
                      <input type="radio"   <?= isset($_POST[ROLE_KEY]) && $_POST[ROLE_KEY]==ROLE_TYPE_CUSTOMER?"checked":'' ?> value="<?= ROLE_TYPE_CUSTOMER ?>" name="<?= ROLE_KEY?>" id="client">
                </label>
                </div>
                <div class="coiffeur-option <?= isset($_POST[ROLE_KEY]) && $_POST[ROLE_KEY]==ROLE_TYPE_CUSTOMER?"hidden":''  ?>">
                    <div class="form-group">
                        <label for="<?= CITY_KEY ?>" class="salon-label fs-6">Ville</label>
                        <select name="<?= CITY_KEY?>" data-old-value="<?= $_POST[CITY_KEY]??0 ?>" id="<?= CITY_KEY?>" class="salon-input"
                                data-validate-skip="1"
                                data-validate="1"
                                data-validate-not-equal="0"
                                data-validate-message="Choisissez une ville"
                        >
                            <option value="0">Selectionner une ville</option>
                            <!--to do insert here the list of cities-->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="<?= QUARTIER_KEY ?>" class="salon-label">Quartier</label>
                        <input
                                value="<?= $_POST[QUARTIER_KEY]??''?>"
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
                                value="<?= $_POST[STORE_NAME_KEY]??''?>"
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
                        <input type="hidden" name="<?= WORKING_DAYS_KEY?>" value="<?= $_POST[WORKING_DAYS_KEY]??''?>">
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
                            <input type="hidden" name="<?= WORKING_HOURS_KEY?>" value="<?= $_POST[WORKING_HOURS_KEY]??''?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button class="s-btn primary my-2 my-sm-0 w-100">
                        S'inscrire
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script src="<?= js('signup.js') ?>"></script>
</div>