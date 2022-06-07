<style>

</style>
<div class="container-fluid ">
    <div class="row">
        <div class="col-md-6 offset-md-3 col-12 offset-0 pt-3">
            <h1 class="page-title text-center my-4">
                Créer un compte
            </h1>

            <form action="<?= getUrlFor('signup')?>" method="post">
                <div class="form-group">
                    <input type="text" name="<?= FIRST_NAME_KEY ?>" value="<?= $_POST[ FIRST_NAME_KEY]??''?>" class="salon-input" placeholder="Votre prénom">
                </div>
                <div class="form-group">
                    <input type="text" name="<?= LAST_NAME_KEY ?>" value="<?= $_POST[ LAST_NAME_KEY]??''?>" class="salon-input" placeholder="Votre nom">
                </div>
                <div class="form-group">
                    <input type="text" name="<?= EMAIL_KEY ?>" value="<?= $_POST[ EMAIL_KEY]??''?>" class="salon-input" placeholder="Votre email">
                </div>
                <div class="form-group">
                    <input type="text" name="<?= USER_NAME_KEY ?>" value="<?= $_POST[ USER_NAME_KEY]??''?>" class="salon-input" placeholder="Votre nom d'utilisateur">
                </div>
                <div class="form-group">
                    <input type="password" name="<?= PASSWORD_KEY ?>" value="<?= $_POST[ PASSWORD_KEY]??''?>" class="salon-input" placeholder="Your password ">
                </div>
                <div class="form-group">
                    <input type="password" name="<?= PASSWORD_REPEAT_KEY ?>" value="<?= $_POST[ PASSWORD_REPEAT_KEY]??''?>" class="salon-input" placeholder="Retype your password ">
                </div>
                <div class="form-group">
                    <input type="text" name="<?= PHONE_KEY ?>" value="<?= $_POST[ PHONE_KEY]??''?>" class="salon-input" placeholder="Numéro de tel">
                </div>
                <div class="form-group">
                    <div for="id" class="salon-label fs-6">Image de profile:</div>
                    <label for="pick-img" class="pick-img" >
                        <img class="pick-img__preview" src="<?= img('profile-avatar.svg') ?>">
                        <img class="pick-img__btn" src="<?=img('ic_pick_img.svg')?>">
                        <input type="file" name="img" id="pick-img" class="pick-img__input">
                    </label>
                </div>

                <div class="form-group">
                    <label for="<?= CITY_KEY ?>" class="salon-label fs-6">Ville</label>
                    <select name="<?= CITY_KEY?>" id="<?= CITY_KEY?>" class="salon-input">
                        <option value="0">Selectionner une ville</option>
                        <option value="washington">washington</option>
                    </select>
                </div>

                <div class="form-group">
                    <input name="<?= QUARTER_KEY?>" id="<?= QUARTER_KEY?>" class="salon-input" placeholder="taper le nom du quartier">
                </div>
                <div class="form-group">
                    <div class="salon-label">
                        Je suis:
                    </div>
                    <label for="coiffeur" class="salon-label">
                        Coiffeur
                        <input type="radio" name="<?= ROLE_KEY?>" id="coiffeur">
                    </label>
                  <label for="coiffeur" class="salon-label">
                      Client
                      <input type="radio" name="<?= ROLE_KEY?>" id="client">
                </label>
                </div>
                <div class="form-group">
                    <input name="<?= QUARTER_KEY?>" id="<?= QUARTER_KEY?>" class="salon-input" placeholder="taper le nom du quartier">
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
                    <div class="form-group">
                    <button class="s-btn primary my-2 my-sm-0 w-100">
                        Se connecter
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script src="<?= js('signup.js') ?>"></script>
</div>