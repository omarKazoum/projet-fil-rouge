<div class="bg-white" id="sidebar">
  <ul class="text-center">
    <li class="px-0 px-md-1 <?= core\Route::isRequestFor('') ? 'active' : '' ?>">
      <a href="<?= getUrlFor('') ?>"  data-bs-toggle="tooltip" data-bs-placement="right" title="Mon Profile">
        <i class="bi bi-person-fill"></i>
      </a>
    </li>
 <li class="px-0 px-md-1 <?= core\Route::isRequestFor('') ? 'active' : '' ?>">
      <a href="<?= getUrlFor('student') ?>"  data-bs-toggle="tooltip" data-bs-placement="right" title="Mes services">
        <i class="bi bi-collection"></i>
      </a>
    </li>
 <li class="px-0 px-md-1 <?= core\Route::isRequestFor('') ? 'active' : '' ?>">
      <a href="<?= getUrlFor('') ?>"  data-bs-toggle="tooltip" data-bs-placement="right" title="Réservations">
        <i class="bi bi-calendar-week"></i>
      </a>
    </li>
 <li class="px-0 px-md-1 <?= core\Route::isRequestFor('') ? 'active' : '' ?>">
      <a href="<?= getUrlFor('') ?>"  data-bs-toggle="tooltip" data-bs-placement="right" title="Se déconnecter">
        <i class="bi bi-box-arrow-left"></i>
      </a>
    </li>

  </ul>
</div>