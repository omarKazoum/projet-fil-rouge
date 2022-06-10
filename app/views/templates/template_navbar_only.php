<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= css('Normalize.css')?>">
    <link rel="stylesheet" href="<?= css('bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?= css('style.css')?>">
    <link rel="stylesheet" href="<?= css('validator.css')?>">

    <title>Salon en ligne</title>
</head>

<body>
<div class="container-fluid">
    <header class="row ">

        <!---Create navbar--->
        <?php require_once "navbar.php" ?>
        <!------Header------>
    </header>
    <main class="row pt-2 no-gutters">

            <!--Content of laoding page--->
            <?= $page_content ?>

    </main>
</div>
<script src="<?= js('validator.js') ?>"></script>
<script src="<?= js('bootstrap.bundle.min.js') ?>"></script>
<script src="<?= js('script.js') ?>"></script>
<script src="<?= js('sweetalert2.js') ?>"></script>
<script src="<?= js('main.js') ?>"></script>
<script src="<?= js('popper.min.js') ?>"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script>
    $(document).on('click', 'ul li', function() {
        $(this).addClass('active').siblings().removeClass('active')
    })
</script>
<script src="<?= js('confirm.js')?>"></script>

</body>

</html>