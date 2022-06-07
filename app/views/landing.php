<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= css('Normalize.css')?>">
    <link rel="stylesheet" href="<?= css('bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?= css('style.css')?>">
    <title>Salon en ligne</title></head>
<style>
    .landing-wrapper{
        background-repeat: no-repeat;
        background-size: cover;
        background-image: url('<?=  img('landing_bg.jpg') ?>');
    }
    body{
        height: 100vh;
        margin: 0px !important;
        border: 0;
    }

</style>

<body>
<div class="container-fluid h-100" >
    <header class="row ">

        <!---Create navbar--->
        <?php require_once "templates/navbar.php" ?>
        <!------Header------>
    </header>
        <div class="row h-100 landing-wrapper" style="">
            <div class=" col-16 col-md-6 text-light d-flex flex-column justify-content-center h-100">
                <h1 class="fs-1">SalonEnLigne</h1>
                <p class="mt-2 fs-5">Trouvez les meilleurs services coiffeur
                    prés de chez vous
                <p>
                    <a  href="<?= getUrlFor('login') ?>" class="s-btn primary my-2 my-sm-0" type="submit">Connectez-vous</a>
                    <a  href="<?= getUrlFor('signup') ?>" class="s-btn primary my-2 my-sm-0" type="submit">Créer un compte</a>
                </p>
            </div>

    </div>
</div>
<script src="<?= js('bootstrap.bundle.min.js')?>"></script>
<script src="<?= js('script.js')?>"></script>
<script src="<?= js('sweetalert2.js')?>"></script>
<script src="<?= js('popper.min.js')?>"></script>
<script src="<?= js('assets/js/script.js')?>"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
</body>
</html>