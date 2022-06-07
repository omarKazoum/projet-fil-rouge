
<div class="container-fluid " style="height:100vh">
    <div class="row">
        <div class="col-md-6 offset-md-3 col-12 offset-0 pt-3">
            <h1 class="page-title text-center my-4">
                Se connecter
            </h1>
            <form action="<?= getUrlFor('login')?>" method="post">
                <div class="form-group">
                    <input type="text" name="<?= USER_NAME_KEY ?>" value="<?= $_POST[ USER_NAME_KEY]??''?>" class="salon-input" placeholder="User name example:Ahmed">
                </div>
                <div class="form-group">
                    <input type="password" name="<?= PASSWORD_KEY ?>" value="<?= $_POST[ PASSWORD_KEY]??''?>" class="salon-input" placeholder="Your password ">
                </div>
                <div class="form-group">
                    <button class="s-btn primary my-2 my-sm-0 w-100">
                        Se connecter
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>