<?php
session_start();
$cartCount = !empty($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0;
?>

<nav class="navbar bg-sekundærfarve" style="height: 110px">
    <div class="container-fluid">
        <div class="row w-100">
            <div class="col-1"></div>
            <div class="col-10">
                <div class="d-flex justify-content-between display-3 brødtekst">
                    <div>
                        <a href="forside.php"><img src="img/LogoStrandV1.png" alt="Logo" class="img-fluid" style="width: 150px"></a>
                    </div>
                    <div class="ms-auto mt-2">
                        <a href="#" class="" data-bs-toggle="modal" data-bs-target="#sprogModal">
                            <img src="img/globus.webp" alt="" class="img-fluid col-1" style="width: 60px">
                        </a>
                        <a href="Indkøbskurv.php" class="ms-4 position-relative">
                            <img src="img/Indkøbskurv.webp" alt="Indkøbskurv" class="img-fluid col-1" style="width: 60px">
                            <span id="cart-badge" class="fs-3 position-absolute top-25 start-100 translate-middle badge bg-baggrundsfarve rounded-circle">
                                <?php if ($cartCount > 0): ?>
                                    <?php echo $cartCount; ?>
                                <?php else: ?>
                                    <span class="visually-hidden"></span>
                                <?php endif; ?>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
</nav>

<div class="modal fade" id="sprogModal" tabindex="-1" aria-labelledby="sprogModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-outlinefarve">
            <div class="modal-header">
                <h5 class="modal-title" id="sprogModalLabel"></h5>
                <button type="button" class="btn-close btn-close-primærfarve lukkeknap" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-primærtekstfarve brødtekst">
                <p class="fs-2 fw-bold mb-4">Hvilket sprog foretrækker du?</p>
                <div class="form-check fs-3 mb-4">
                    <input class="form-check-input form-check-input" type="radio" name="sprog" id="dansk" value="dansk" checked>
                    <label class="form-check-label ms-2" for="dansk">Dansk</label>
                </div>
                <div class="form-check fs-3 mb-4">
                    <input class="form-check-input" type="radio" name="sprog" id="english" value="english">
                    <label class="form-check-label ms-2" for="english">English</label>
                </div>
                <div class="form-check fs-3 mb-4">
                    <input class="form-check-input" type="radio" name="sprog" id="deutsch" value="deutsch">
                    <label class="form-check-label ms-2" for="deutsch">Deutsch</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn me-3 btn-lg rounded-pill btn-sekundærknap brødtekst text-primærtekstfarve border-outlinefarve" data-bs-dismiss="modal" style="width: 160px;">Annuller</button>
                <button type="button" class="btn btn-lg rounded-pill btn-primærknap brødtekst" data-bs-dismiss="modal" style="width: 160px;">Gem</button>
            </div>
        </div>
    </div>
</div>

<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
