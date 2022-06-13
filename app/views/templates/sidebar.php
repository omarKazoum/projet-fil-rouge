<div class="bg-white" id="sidebar">
  <ul class=" text-center">
    <li class="px-0 px-md-1 <?= core\Route::isRequestFor(USERS_ENDPOINT_LABEL) ? 'active' : '' ?>">
      <a href="<?= getUrlFor('profile') ?>"  data-bs-toggle="tooltip" data-bs-placement="right" title="Mon Profile">
        <i class="bi bi-person-fill"></i>
      </a>
    </li>
 <li class="px-0 px-md-1 <?= core\Route::isRequestFor(SERVICES_ENDPOINT_LABEL) ? 'active' : '' ?>">
      <a href="<?= getUrlFor('services') ?>"  data-bs-toggle="tooltip" data-bs-placement="right" title="Mes services">
        <i class="bi bi-collection"></i>
      </a>
    </li>
 <li class="px-0 px-md-1 <?= core\Route::isRequestFor(SERVICE_REQUESTS_ENDPOINT_LABEL) ? 'active' : '' ?>">
      <a href="<?= getUrlFor('reservations') ?>"  data-bs-toggle="tooltip" data-bs-placement="right" title="Réservations">
        <i class="bi bi-calendar-week"></i>
      </a>
    </li>
      <?php if(\core\SessionManager::getInstance()->getLoggedInUser()->role==ROLE_TYPE_ADMIN): ?>
          <li class="px-0 px-md-1 <?= core\Route::isRequestFor(CATEGORIES_ENDPOINT_LABEL) ? 'active' : '' ?>">
              <a href="<?= getUrlFor('categories') ?>"  data-bs-toggle="tooltip" data-bs-placement="right" title="Réservations">
                  <i class="fa-solid fa-bookmark"></i>
              </a>
          </li>
      <?php endif; ?>
 <li class="px-0 px-md-1 <?= core\Route::isRequestFor('') ? 'active' : '' ?>">
      <a href="<?= getUrlFor('logout') ?>"  data-bs-toggle="tooltip" data-bs-placement="right" title="Se déconnecter">
        <i class="bi bi-box-arrow-left"></i>
      </a>
    </li>

  </ul>
</div>
<script>
    document.querySelectorAll('#sidebar li').forEach(btn=>{
        btn.addEventListener('click',e=>{
            e.target.querySelector('a').click();
        })
    })
</script>