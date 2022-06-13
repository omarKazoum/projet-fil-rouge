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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Salon en ligne</title>
</head>
<body class="">

  <div class="container-fluid g-0">
    <header class="row mx-0">
      <!---Create navbar--->
      <?php require_once "navbar.php" ?>
      <!------Header------>
    </header>
    <main class="row pt-2 g-1 mx-0">
      <!--Sidebar of all page-->
      <div class="col-1 col-lg-1 ps-0">
        <?php  require_once "sidebar.php" ?>
      </div>
      <div class="content col-11 col-lg-11">
          <div class="content-wrapper">
        <!--Content of laoding page--->
                <?= $page_content ?>
          </div>
      </div>
    </main>
  </div>
  <script src="<?= js('validator.js') ?>"></script>
  <script src="<?= js('bootstrap.bundle.min.js') ?>"></script>
  <script src="<?= js('sweetalert2.js') ?>"></script>
  <script src="<?= js('script.js') ?>"></script>
  <script src="<?= js('main.js') ?>"></script>
  <script src="<?= js('validator.js') ?>"></script>
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