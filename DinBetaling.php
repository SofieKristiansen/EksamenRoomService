<?php
require "settings/init.php";
?>
<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="utf-8">

    <title>Din betaling</title>

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

<div class="container-fluid pt-3">
    <div class="row">
        <div class="col-1"></div>

        <div class="col-10">
            <div class="breadcrumb-container">
                <div class="back-arrow hstack">
                    <?php include("tilbagepil.php"); ?>
                </div>
            </div>
        </div>

        <div class="col-1"></div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-1"></div>

        <div class="col-10">

            <div class="mb-5">
                <h2 class="display-1 overskrift fw-medium">Din bestilling</h2>
            </div>

            <div class="card shadow bg-kortfarve" style="border-radius: 70px;">
                <div class="row">
                    <?php
                    $sql = "SELECT * FROM produkter INNER JOIN ingredienser ON ingrProdukterId = prodId ORDER BY ingrNavn ASC LIMIT 1";
                    $produkter = $db->sql($sql, $bind);
                    foreach ($produkter as $produkt) {
                        ?>

                        <div class=" d-flex flex-column justify-content-between">
                            <div class="col-6 mb-3 text-start">
                                <h2 class="brødtekst text-primærtekstfarve fw-bold fs-2 pt-4 ps-5" style="line-height: 1;">Oversigt</h2>
                            </div>

                            <div class="col-12 mb-3 text-start">
                                <h2 class="brødtekst text-primærtekstfarve text-bold fs-2 pt-4 ps-5" style="line-height: 1;"><?php echo $produkt->prodNavn ?></h2>
                            </div>

                            <div class="d-flex justify-content-end align-items-end flex-grow-1 col-12">
                                <div class="brødtekst text-primærtekstfarve fs-2 fw-bold me-5 mt-5 mb-3" id="total-pris"> Total:
                                    <?php echo number_format($produkt->prodPris, 2); ?> kr.
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>

            <div class="card shadow bg-kortfarve mt-5 pt-5" style="border-radius: 70px;">
                <div class="row">

                    <div class="col-6 text-start">
                        <h2 class="brødtekst text-primærtekstfarve fw-bold fs-2 ps-5" style="line-height: 1;">Værelsesnummer</h2>

                        <div class="col-2 input-group mb-3 mt-3 text-start ps-5">
                            <input type="text" class="form-control rounded-pill p-1 brødtekst text-primærtekstfarve fs-2 ps-4" style="width: 100px" placeholder="Indtast her.." aria-label="Indtast her..">
                        </div>

                    </div>

                    <div class="col-3"></div>

                    <div class="ms-5 ps-5">
                        <div class="brødtekst text-primærtekstfarve fs-2 pt-2">
                            <div class="form-check p-3">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault1">
                                <label class="form-check-label" for="flexCheckDefault1">
                                    Betal online
                                </label>
                            </div>
                            <div class="form-check p-3 d-flex justify-content-between align-items-center">
                                <div>
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault2">
                                    <label class="form-check-label" for="flexCheckDefault2">
                                        Betalt ved check ud
                                    </label>
                                </div>
                                <a href="#">
                                    <button type="button" class="btn btn-lg shadow rounded-pill btn-primærknap fs-3 brødtekst me-5" data-bs-toggle="modal" data-bs-target="#modal">
                                        Betal
                                    </button>
                                </a>

                            </div>
                            <div class="form-check p-3">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault3">
                                <label class="form-check-label" for="flexCheckDefault3">
                                    Betal ved levering
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-outlinefarve">

                                <div class="modal-header">
                                    <div class="modal-title text-primærtekstfarve" id="exampleModalLabel"></div>
                                    <button type="button" class="btn-close btn-close-primærfarve lukkeknap" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <p class="fs-2 text-primærtekstfarve brødtekst">Betalingsmetoder</p>

                                    <div class="btn-group-vertical" role="group" aria-label="Vertical radio toggle button group">
                                        <input type="radio" class="btn-check" name="vbtn-radio" id="vbtn-radio1" autocomplete="off">
                                        <label class="btn btn-outline-primærfarve d-flex align-items-center" style="width: 300px;" for="vbtn-radio1">
                                            <img src="img/visa.png" alt="" style="width: 45px; height:auto;">
                                            <span class="bg-white border-outlinefarve fs-4 brødtekst text-primærtekstfarve ms-5">Visa</span>
                                        </label>
                                        <input type="radio" class="btn-check" name="vbtn-radio" id="vbtn-radio2" autocomplete="off">
                                        <label class="btn btn-outline-primærfarve d-flex align-items-center" style="width: 300px;" for="vbtn-radio2">
                                            <img src="img/dankort.png" alt="" style="width: 50px; height:auto;">
                                            <span class="bg-white border-outlinefarve fs-4 brødtekst text-primærtekstfarve ms-5">Dankort</span>
                                        </label>
                                        <input type="radio" class="btn-check" name="vbtn-radio" id="vbtn-radio3" autocomplete="off">
                                        <label class="btn btn-outline-primærfarve d-flex align-items-center" style="width: 300px;" for="vbtn-radio3">
                                            <img src="img/paypal.png" alt="" style="width: 50px; height:auto;">
                                            <span class="bg-white border-outlinefarve fs-4 brødtekst text-primærtekstfarve ms-5">PayPal</span>
                                        </label>
                                        <input type="radio" class="btn-check" name="vbtn-radio" id="vbtn-radio4" autocomplete="off">
                                        <label class="btn btn-outline-primærfarve d-flex align-items-center" style="width: 300px;" for="vbtn-radio4">
                                            <img src="img/mobilepay.png" alt="" style="width: 50px; height:auto;">
                                            <span class="bg-white border-outlinefarve fs-4 brødtekst text-primærtekstfarve ms-5">MobilePay</span>
                                        </label>
                                        <input type="radio" class="btn-check" name="vbtn-radio" id="vbtn-radio5" autocomplete="off">
                                        <label class="btn btn-outline-primærfarve d-flex align-items-center" style="width: 300px;" for="vbtn-radio5">
                                            <img src="img/mastercard.png" alt="" style="width: 50px; height:auto;">
                                            <span class="bg-white border-outlinefarve fs-4 brødtekst text-primærtekstfarve ms-5">Mastercard</span>
                                        </label>
                                    </div>

                                    <p class="fs-4 mt-3 text-primærtekstfarve brødtekst">Du bliver omdirigeret til din betalingsmetode via sikre (SSL) sider. Her vil du kunne fuldføre din kreditkortbetaling for din bestilling.</p>
                                </div>

                                <div class="modal-footer">
                                    <a href="#" class="btn btn-primary me-3 btn-lg rounded-pill btn-primærknap text-sekundærekstfarve border-outlinefarve" style="width: 150px;">Fortsæt</a>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

        </div>
        <div class="col-1"></div>
    </div>
</div>


<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
