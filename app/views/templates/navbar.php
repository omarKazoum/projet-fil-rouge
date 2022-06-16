<?php
$sm=\core\SessionManager::getInstance();
if($sm->isLoggedIn())
$user=$sm->getLoggedInUser();
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light" id="navbar">
    <a class="navbar-brand d-flex align-items-center" href="<?= getUrlFor('/')?>">
        <img src="<?= img('salon_en_ligne.jpeg')?>" alt="salon en ligne logo" class="logo">
        <p class="d-lg-none">Salon en ligne</p>
    </a>
    <button class="navbar-toggler s-btn primary" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon color-success"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
        <ul class="navbar-nav gap-1 align-items-center">
            <?php if(!$sm->isLoggedIn()):?>
                <li class="nav-item active">
                    <a class="s-btn outlined" href="<?= getUrlFor('signup')?>">Créer un compte</a>
                </li>
                <li class="nav-item">
                    <a class="s-btn normal" href="<?= getUrlFor('login')?>">Se Connecter</a>
                </li>
            <?php else:?>

                <li class="nav-item flex-column d-flex">
                    <span class="text-primary bold">
                        <?= $user->user_name?>
                    </span>
                    <?= getRoleText($user->role)?>

                </li>
                <li class="nav-item">

                    <img src="<?= getUserImageUrl($user) ?>" alt="" class="profile-icon" style="width: 50px;height: 50px;border-radius: 50%;border: 1px solid #ee9144f7;">
                </li>

            <?php endif;?>
        </ul>
        <?php if(in_array(\core\Route::getCurrentRequestLabel(),[SERVICE_REQUESTS_ENDPOINT_LABEL,SERVICES_ENDPOINT_LABEL,CATEGORIES_ENDPOINT_LABEL])){?>
            <form class="form-inline my-2 my-lg-0 d-flex gap-1" action="<?= getSearchActionLink() ?>" method="GET">
                <input class="form-control mr-sm-2 py-0"
                       name="search"
                       type="search"
                       placeholder="<?= getSearchPlaceHolderText() ?>"
                       aria-label="Search"
                       value="<?= $_GET['search']??'' ?>"
                >
                <button class="s-btn primary my-2 my-sm-0" type="submit">Rechercher</button>
            </form>
        <?php }?>
    </div>
    <script>
        document.querySelectorAll(".navbar-toggler").forEach(function(btn){
            btn.addEventListener("click", function(){
                const targetId=btn.getAttribute("data-target")
                const target=document.querySelector(targetId)
                const toggleClass=btn.getAttribute("data-toggle")
                target.classList.toggle(toggleClass)
            });
        });
    </script>
</nav>