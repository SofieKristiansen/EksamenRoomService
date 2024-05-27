<?php
require "settings/init.php";
?>
<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="utf-8">

    <title>Sigende titel</title>

    <meta name="robots" content="All">
    <meta name="author" content="Udgiver">
    <meta name="copyright" content="Information om copyright">

    <link href="css/styles.css" rel="stylesheet" type="text/css">

    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body class="bg-baggrundsfarve">

<?php
include("navbar.php");
?>

<?php
include("tilbagepil.php");
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
            <div class="mb-5">
                <h2 class="display-1 overskrift fw-medium">Indkøbskurv</h2>
            </div>
            <div class="card shadow bg-kortfarve" style="border-radius: 70px;">
                <div class="row">
                    <?php
                    $sql = "SELECT * FROM produkter ORDER BY prodNavn ASC LIMIT 1";
                    $produkter = $db->sql($sql, $bind);
                    foreach ($produkter as $produkt) {
                    ?>
                    <div class="col-3">
                        <img src="img/<?php echo $produkt->prodProduktBillede ?>" class="img-fluid" alt="" style="border-radius: 70px;">
                    </div>
                    <div class="col-9 d-flex flex-column justify-content-between">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h2 class="brødtekst text-primærtekstfarve text-bold fs-2 pt-4" style="line-height: 1;"><?php echo $produkt->prodNavn ?></h2>

                            <div>
                                <button type="button" class="btn btn-lg me-3" style="padding: 0; margin: 0;">
                                    <img src="img/blyant.webp" alt="" class="pt-4"
                                         style="width: 35px; height:auto; margin: 0;">
                                </button>

                                <button type="button" class="btn btn-lg me-5" data-bs-toggle="modal"
                                        data-bs-target="#sletModal" style="padding: 0; margin: 0;">
                                    <img src="img/skraldespand.webp" alt="" class="pt-4"
                                         style="width: 35px; height:auto; margin: 0;">
                                </button>

                                <div class="modal fade" id="sletModal" tabindex="-1" aria-labelledby="sletModalLabel"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-outlinefarve" style="border-radius: 30px">

                                            <div class="modal-header">
                                                <div class="modal-title text-primærtekstfarve"
                                                     id="sletModalLabel"></div>
                                                <button type="button" class="btn-close btn-close-primærfarve lukkeknap"
                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body text-primærtekstfarve brødtekst">
                                                <p class="fw-bold fs-1">Slet din bestilling</p>
                                                <p class="fs-2 fw-medium">Er du sikker på at du vil slette dette fra din
                                                    bestilling</p>
                                            </div>

                                            <div class="modal-footer">
                                                <a href="Indkøbskurv.php"
                                                   class="btn btn-secondary me-3 btn-lg rounded-pill btn-sekundærknap text-primærtekstfarve border-outlinefarve fs-4 fw-medium brødtekst"
                                                   style="width: 160px;">Anuller</a>
                                                <a href="Indkøbskurv.php"
                                                   class="btn btn-primary me-3 btn-lg rounded-pill btn-primærknap text-sekundærekstfarve border-outlinefarve fs-4 fw-medium brødtekst"
                                                   style="width: 160px;">Ja, slet</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="brødtekst text-primærtekstfarve fs-1 fw-bold">
                            <div class="d-flex justify-content-between align-items-end mb-3">
                                <div class="dropdown">
                                    <button class="btn dropdown-toggle bg-white border-outlinefarve fs-1 d-flex justify-content-between brødtekst text-primærtekstfarve ps-4 pe-4 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="border-radius: 70px; width: 100%">
                                        Antal: 1
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item text-primærtekstfarve brødtekst" href="#">1</a></li>
                                        <li><a class="dropdown-item text-primærtekstfarve brødtekst" href="#">2</a></li>
                                        <li><a class="dropdown-item text-primærtekstfarve brødtekst" href="#">3</a></li>
                                        <li><a class="dropdown-item text-primærtekstfarve brødtekst" href="#">4</a></li>
                                        <li><a class="dropdown-item text-primærtekstfarve brødtekst" href="#">5</a></li>
                                        <li><a class="dropdown-item text-primærtekstfarve brødtekst" href="#">6</a></li>
                                    </ul>
                                </div>
                                <div class="brødtekst text-primærtekstfarve fs-2 fw-bold me-5" id="pris">
                                    <?php echo number_format($produkt->prodPris, 2); ?> kr.
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end align-items-end vstack" style="margin-left: auto">
                <div class="brødtekst text-primærtekstfarve fs-2 fw-bold me-5 mt-5 mb-3" id="total-pris"> Total:
                    <?php echo number_format($produkt->prodPris, 2); ?> kr.
                </div>
                <a href="DinBetaling.php">
                    <button type="button" class="btn btn-lg shadow rounded-pill btn-primærknap fs-3 brødtekst ms-3 me-5">
                        Forsæt
                    </button>
                </a>

            </div>

            <?php
            }
            ?>
        </div>

        <div class="col-1"></div>
    </div>
</div>


<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
