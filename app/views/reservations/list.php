<?php

$role=\core\SessionManager::getInstance()->getLoggedInUser()->role;
?>
<div class="container-fluid">

  <?php  printMessageIfSet();?>

    <div class="row">
        <div class="page-title col-9 col-md-10">
            <?php if(\core\SessionManager::getInstance()->getLoggedInUser()->role==ROLE_TYPE_ADMIN):?>
                Gérer les réservations
            <?php else:?>
                Mes réservations
            <?php endif;?>
        </div>
    </div>
    <?php require_once dirname(__FILE__) .'/../templates/search_header.php'?>
    <div class="row p-1">
        <?php printMessageIfSet();?>
    </div>
    <div class="table-responsive">
        <table class="table table-responsive">
            <?php if(count($reservations)>0):?>
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">service title</th>
                    <th scope="col">Date</th>
                    <th scope="col">Heure</th>
                    <th scope="col">nom de coiffeur</th>
                    <th scope="col">status</th>
                </tr>
                </thead>
                <tbody>
                <?php  foreach($reservations as $reservation): ?>
                    <tr class="service-item">
                        <td ><?= $reservation->id ?></td>
                        <td class="service-title"><?= $reservation->service->title ?></td>
                        <td><?= $reservation->date ?></td>
                        <td><?= $reservation->time ?></td>
                        <td><?= $reservation->service->user->user_name ?></td>
                        <td class="reservation-status"><?= getServiceStatusString($reservation->status) ?></td>
                        <td>
                            <!-- TODO:: change icons and btns size -->
                            <div class="action-btns-wrapper">
                                <div class="action-btns">
                                <?php if($role!=ROLE_TYPE_CUSTOMER && $reservation->status!=SERVICE_REQUEST_STATUS_ACCEPTED):?>
                                    <!--confirm -->
                                    <a data-action="confirm" data-confirm-msg="Etes vous sur de vouloir accepter cette réservation ?"
                                       href="<?= getUrlFor('reservations/confirm/'.$reservation->id)?>"
                                       class="s-btn success p-1 d-flex justify-content-center align-items-center salon-confirm"
                                       title="Confirmer cette réservation">
                                        <i class="fa-solid fa-check"></i>Confirmer
                                    </a>
                                <?php endif;?>
                                <?php if($role!=ROLE_TYPE_CUSTOMER && $reservation->status!=SERVICE_REQUEST_STATUS_REJECTED):?>
                                <!-- reject -->
                                <a data-action="reject" data-confirm-msg="Etes vous sur de vouloir refuser cette réservation ?" href="<?= getUrlFor('reservations/reject/'.$reservation->id) ?>" class="s-btn danger p-1 d-flex justify-content-center align-items-center salon-confirm" title="Refuser cette réservation">
                                    <i class="fa-solid fa-circle-xmark" ></i>Refuser
                                </a>
                                <?php endif;?>
                                <?php if($role!=ROLE_TYPE_COIFFEUR && $reservation->status!=SERVICE_REQUEST_STATUS_CANCELED && $reservation->status!=SERVICE_REQUEST_STATUS_ACCEPTED):?>
                                <!-- cancel -->
                                <a data-action="cancel" data-confirm-msg="Etes vous sur de vouloir annuler cette réservation ?" href="<?= getUrlFor('reservations/cancel/'.$reservation->id) ?>" class="s-btn primary p-1 d-flex justify-content-center align-items-center salon-confirm" title="Annuler cette réservation"><i class="fa-solid fa-ban" ></i>Annuler</a>
                                <?php endif;?>
                                <?php if($role==ROLE_TYPE_ADMIN && $reservation->status!=SERVICE_REQUEST_STATUS_PENDING):?>
                                <!-- pend -->
                                <a data-action="pend" data-confirm-msg="Etes vous sur de vouloir mettre cette réservation en attente ?" href="<?= getUrlFor('reservations/pend/'.$reservation->id) ?>" class="s-btn intermediate p-1 d-flex justify-content-center align-items-center salon-confirm" title="Mettre cette réservation en attente"><i class="fa-solid fa-watch-smart" ></i>Mettre en attente</a>
                                <?php endif;?>
                            </div>
                            </div>
                        </td>

                    </tr>
                <?php endforeach; ?>
                </tbody>
            <?php else: ?>
                <div class="alert alert-info">
                    <strong>Info:</strong> Aucune réservation pour le moment.
            <?php endif; ?>
        </table>
    </div>
</div>
<script src="<?= js('reservations_list.js')?>"></script>