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
                    <ul>
                        <?php foreach(\core\InputValidator::getErrors() as $error){?>
                            <?= $error?>
                        <?php }?>
                    </ul>
                </div>
                <?php }?>

                <div class="form-group">
                    <input
                        data-validate="1"
                        data-validate-pattern="^\w{3,50}"
                        data-validate-message="Le prénom peut contenir entre 3 et 50 characters"
                        type="text" name="<?= FIRST_NAME_KEY ?>" value="<?= $_POST[ FIRST_NAME_KEY]??''?>" class="salon-input" placeholder="Votre prénom">
                </div>
                <div class="form-group">
                    <input type="text"
                           data-validate="1"
                           data-validate-pattern="^\w{3,50}"
                           data-validate-message="Le nom peut contenir entre 3 et 50 characters"
                           name="<?= LAST_NAME_KEY ?>" value="<?= $_POST[ LAST_NAME_KEY]??''?>" class="salon-input" placeholder="Votre nom">
                </div>
                <div class="form-group">
                    <input
                            data-validate="1"
                            data-validate-pattern="^\w+@\w+(\.\w+)+$"
                            data-validate-message="Doit étre un email valid"
                            type="email" name="<?= EMAIL_KEY ?>" value="<?= $_POST[ EMAIL_KEY]??''?>" class="salon-input" placeholder="Votre email">
                </div>
                <div class="form-group">
                    <input type="text" name="<?= USER_NAME_KEY ?>"
                           data-validate="1"
                           data-validate-pattern="^\w{3,50}"
                           data-validate-message="User name can be a word containing between 3 and 50 characters"
                           value="<?= $_POST[ USER_NAME_KEY]??''?>" class="salon-input" placeholder="Votre nom d'utilisateur">
                </div>
                <div class="form-group">
                    <input
                        data-validate="1"
                        data-validate-pattern="^.{10,}$"
                        data-validate-message="Le mot de passe doit contenir au moins 10 characters"
                        type="password" name="<?= PASSWORD_KEY ?>" value="<?= $_POST[ PASSWORD_KEY]??''?>"
                        class="salon-input"
                        placeholder="Your password "
                        id="<?= PASSWORD_KEY ?>"
                    >
                </div>
                <div class="form-group">
                    <input
                        data-validate="1"
                        data-validate-match="<?= PASSWORD_KEY ?>"
                        data-validate-message="Les mots de passe doit être identique"
                        type="password" name="<?= PASSWORD_REPEAT_KEY ?>" value="<?= $_POST[ PASSWORD_REPEAT_KEY]??''?>" class="salon-input" placeholder="Retype your password ">
                </div>
                <div class="form-group">
                    <input type="text"
                       name="<?= PHONE_KEY ?>" value="<?= $_POST[ PHONE_KEY]??''?>"
                       class="salon-input"
                       placeholder="Numéro de tel"
                       data-validate="1"
                       data-validate-pattern="^\+{0,1}(212)|0[658]\d{8}$"
                       data-validate-message="Doit etre un numéro du telephone valid "
                    >
                </div>
                <div class="form-group">
                    <div for="id" class="salon-label fs-6">Image de profile:(optionel)</div>
                    <label for="pick-img" class="pick-img" >
                        <img class="pick-img__preview" src="<?= img('profile-avatar.svg') ?>">
                        <img class="pick-img__btn" src="<?=img('ic_pick_img.svg')?>">
                        <input type="file" name="<?= PROFILE_IMG_KEY?>" id="pick-img" class="pick-img__input">
                    </label>
                </div>

                <div class="form-group">
                    <label for="<?= CITY_KEY ?>" class="salon-label fs-6">Ville</label>
                    <select name="<?= CITY_KEY?>" id="<?= CITY_KEY?>" class="salon-input"
                            data-validate="1"
                            data-validate-not-equal="0"
                            data-validate-message="Choisissez une ville"
                    >
                        <option value="0">Selectionner une ville</option>
                        <!--to do insert here the list of cities-->
                    </select>
                </div>

                <div class="form-group">
                    <input
                        data-validate="1"
                        data-validate-pattern="^\w{3,20}$"
                        data-validate-message="l'adress doit contenir entre 3 et 20 characters"
                        name="<?= ADRESS_KEY?>" id="<?= ADRESS_KEY?>" class="salon-input" placeholder="taper le nom votre adress ou de votre établissement">
                </div>
                <div class="form-group flex-row">
                    <div class="salon-label">
                        Je suis:
                    </div>
                    <label for="coiffeur" class="salon-label">
                        Coiffeur
                        <input type="radio"  <?php if(isset($_POST[ROLE_KEY])){echo $_POST[ROLE_KEY]==ROLE_TYPE_COIFFEUR?"checked":'';} ?> value="<?= ROLE_TYPE_COIFFEUR ?>" name="<?= ROLE_KEY?>" id="coiffeur">
                    </label>
                  <label for="coiffeur" class="salon-label">
                      Client
                      <input type="radio" checked value="<?= ROLE_TYPE_CUSTOMER ?>" <?php if(isset($_POST[ROLE_KEY])){echo $_POST[ROLE_KEY]==ROLE_TYPE_CUSTOMER?"checked":'';} ?> name="<?= ROLE_KEY?>" id="client">
                </label>
                </div>
                <div class="coiffeur-option hidden">
                    <div class="form-group">
                        <input name="<?= STORE_NAME_KEY ?>" id="<?= STORE_NAME_KEY ?>" class="salon-input" placeholder="taper le nom de votre salon">
                    </div>
                    <div class="form-group">
                        <div class="salon-label">
                            Jours d'ouverture:
                        </div>
                        <div class="days">

                        </div>
                        <input type="hidden" name="<?= WORKING_DAYS_KEY?>">
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
                            <input type="hidden" name="<?= WORKING_HOURS_KEY?>">
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