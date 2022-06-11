<nav class="navbar navbar-expand-lg navbar-light bg-light" id="navbar">
    <a class="navbar-brand d-flex align-items-center" href="<?= getUrlFor('/')?>">
        <img src="<?= img('salon_en_lign.jpeg')?>" alt="salon en ligne logo" class="logo">
        <p class="d-lg-none">Salon en ligne</p>
    </a>
    <button class="navbar-toggler s-btn primary" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon color-success"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
        <ul class="navbar-nav gap-1">
            <?php if(!\core\SessionManager::getInstance()->isLoggedIn()):?>
            <li class="nav-item active">
                <a class="s-btn outlined" href="<?= getUrlFor('signup')?>">Créer un compte</a>
            </li>
            <li class="nav-item">
                <a class="s-btn normal" href="<?= getUrlFor('login')?>">Se Connecter</a>
            </li>
            <?php else:?>
            <li class="nav-item">
                <a class="s-btn outlined" href="<?= getUrlFor('profile')?>">Se déconnecter</a>
            <?php endif;?>
        </ul>
        <form class="form-inline my-2 my-lg-0 d-flex gap-1">
            <input class="form-control mr-sm-2 py-0" type="search" placeholder="Rechercher un service" aria-label="Search">
            <button class="s-btn primary my-2 my-sm-0" type="submit">Rechercher</button>
        </form>
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