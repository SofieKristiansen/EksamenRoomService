<?php
require "settings/init.php";
session_start();

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$kategoriId = isset($_GET['kategoriId']) ? $_GET['kategoriId'] : '';

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

<body class="bg-baggrundsfarve pb-5" style="overflow-y: auto">

<?php
include("navbar.php");
?>

<!-- Tilbagepil -->
<div class="container-fluid pt-4">
    <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
            <div class="breadcrumb-container">
                <div class="back-arrow">
                    <a href="javascript:void(0);" onclick="history.back(-1)" class="pe-5">
                        <img src="img/tilbagepil.webp" class="img-fluid" alt="Tilbagepil" style="height: 70px">
                    </a>
                </div>
            </div>
        </div>
        <div class="col-1"></div>
    </div>
</div>


<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-1"></div>

        <div class="col-10">

            <div class="mb-5">
                <h2 class="display-1 text-primærtekstfarve overskrift fw-medium">Din bestilling</h2>
            </div>

            <div class="card shadow bg-kortfarve" style="border-radius: 70px;">
                <div class="row">
                    <div class="d-flex flex-column justify-content-between">
                        <div class="col-12 mb-3 text-start">
                            <p class="brødtekst text-primærtekstfarve fw-bold fs-1 mt-4 pb-4 pt-4 ps-5"
                               style="line-height: 1;">Oversigt</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="ps-5">
                            <?php
                            $totalPris = 0;
                            if (!empty($cart)) {
                                foreach ($cart as $productId => $quantity) {
                                    $sql = "SELECT * FROM produkter WHERE prodId = :prodId";
                                    $produkt = $db->sql($sql, [':prodId' => $productId])[0];
                                    $totalPris += $produkt->prodPris * $quantity;
                                    ?>
                                    <div class="row mb-3">
                                        <div class="col-6">
                                            <p class="brødtekst text-primærtekstfarve text-bold fs-2"
                                                style="line-height: 1;">
                                                <?php echo $produkt->prodNavn ?>
                                            </p>
                                            <p class="brødtekst text-primærtekstfarve fs-2">
                                                Antal: <?php echo $quantity; ?></p>
                                        </div>
                                        <div class="col-6 text-end">
                                            <p class="brødtekst text-primærtekstfarve me-5 text-bold fs-2"
                                                style="line-height: 1;">
                                                <?php echo number_format($produkt->prodPris * $quantity, 2, ',', '.'); ?>
                                                kr.
                                            </p>
                                        </div>
                                    </div>
                                    <?php
                                }
                            } else {
                                echo "<p class='brødtekst text-primærtekstfarve fs-2'>Din indkøbskurv er tom.</p>";
                            }
                            ?>
                            <div class="row">
                                <div class="col-12 d-flex justify-content-end mt-5 mb-2">
                                    <p class="brødtekst text-primærtekstfarve me-2 text-bold fs-2 fw-bold"
                                        style="line-height: 1;">Total:
                                    </p>

                                    <p class="brødtekst text-primærtekstfarve text-bold fs-2 fw-bold me-5"
                                        style="line-height: 1;" id="total-pris">
                                        <?php echo number_format($totalPris, 2, ',', '.'); ?> kr.
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow bg-kortfarve mt-5 pt-5" style="border-radius: 70px;">
                <div class="row">

                    <div class="col-6 text-start">
                        <p class="brødtekst text-primærtekstfarve fw-bold fs-1 ps-5 pb-3" style="line-height: 1;">
                            Værelsesnummer</p>
                        <div class="col-2 input-group mb-3 mt-3 text-start ps-5">
                            <input type="text"
                                   class="form-control rounded-pill p-1 brødtekst text-primærtekstfarve fs-2 ps-4"
                                   style="width: 100px" placeholder="Indtast her.." aria-label="Indtast her..">
                        </div>
                    </div>

                    <div class="col-3"></div>
                    <div class="ms-5 ps-5">
                        <div class="brødtekst text-primærtekstfarve fs-2 pt-2">

                            <div class="form-check p-3">
                                <input class="form-check-input form-check-input" type="radio" name="betaling"
                                       id="flexCheckDefault1" value="online">
                                <label class="form-check-label" for="flexCheckDefault1">Betal online</label>
                            </div>


                            <div class="form-check p-3">
                                <input class="form-check-input" type="radio" name="betaling" id="flexCheckDefault2"
                                       value="checkud">
                                <label class="form-check-label" for="flexCheckDefault2">Betal ved check ud</label>
                            </div>

                            <div class="form-check p-3 pb-4 d-flex justify-content-between align-items-center">
                                <div>
                                    <input class="form-check-input" type="radio" name="betaling" id="flexCheckDefault3"
                                           value="levering">
                                    <label class="form-check-label" for="flexCheckDefault3">Betal ved levering</label>
                                </div>

                                <a href="#" class="me-4 pe-5">
                                    <button type="button" id="betalKnappen"
                                            class="btn btn-lg rounded-pill btn-primærknap fs-3 brødtekst"
                                            style="width: 180px" data-bs-toggle="modal" data-bs-target="#modal">
                                        Betal
                                    </button>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalOnline" tabindex="-1" aria-labelledby="modalOnlineLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-outlinefarve">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalOnlineLabel"></h5>
                            <button type="button" class="btn-close btn-close-primærfarve lukkeknap"
                                    data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body modal-body text-primærtekstfarve brødtekst">
                            <p class="fs-2 fw-bold mb-4">Betalingsmetoder</p>

                            <div class="btn-group-vertical" role="group"
                                 aria-label="Vertical radio toggle button group">
                                <input type="radio" class="btn-check" name="vbtn-radio" id="vbtn-radio1"
                                       autocomplete="off">
                                <label class="btn btn-outline-primærfarve d-flex align-items-center"
                                       style="width: 300px;" for="vbtn-radio1">
                                    <img src="img/visa.png" alt="" style="width: 45px; height:auto;">
                                    <span class="border-outlinefarve fs-4 fw-medium ms-5">Visa</span>
                                </label>
                                <input type="radio" class="btn-check" name="vbtn-radio" id="vbtn-radio2"
                                       autocomplete="off">
                                <label class="btn btn-outline-primærfarve d-flex align-items-center"
                                       style="width: 300px;" for="vbtn-radio2">
                                    <img src="img/dankort.png" alt="" style="width: 50px; height:auto;">
                                    <span class="border-outlinefarve fs-4 fw-medium ms-5">Dankort</span>
                                </label>
                                <input type="radio" class="btn-check" name="vbtn-radio" id="vbtn-radio3"
                                       autocomplete="off">
                                <label class="btn btn-outline-primærfarve d-flex align-items-center"
                                       style="width: 300px;" for="vbtn-radio3">
                                    <img src="img/paypal.png" alt="" style="width: 50px; height:auto;">
                                    <span class="border-outlinefarve fs-4 fw-medium ms-5">PayPal</span>
                                </label>
                                <input type="radio" class="btn-check" name="vbtn-radio" id="vbtn-radio4"
                                       autocomplete="off">
                                <label class="btn btn-outline-primærfarve d-flex align-items-center"
                                       style="width: 300px;" for="vbtn-radio4">
                                    <img src="img/mobilepay.png" alt="" style="width: 50px; height:auto;">
                                    <span class="border-outlinefarve fs-4 fw-medium ms-5">MobilePay</span>
                                </label>
                                <input type="radio" class="btn-check" name="vbtn-radio" id="vbtn-radio5"
                                       autocomplete="off">
                                <label class="btn btn-outline-primærfarve d-flex align-items-center"
                                       style="width: 300px;" for="vbtn-radio5">
                                    <img src="img/mastercard.png" alt="" style="width: 50px; height:auto;">
                                    <span class="border-outlinefarve fs-4 fw-medium ms-5">Mastercard</span>
                                </label>
                            </div>

                            <p class="fs-5 fw-medium mt-4">Du bliver omdirigeret til din betalingsmetode via sikre (SSL)
                                sider. Her vil du kunne fuldføre din kreditkortbetaling for din bestilling.</p>
                        </div>

                        <div class="modal-footer">
                            <a href="forside.php"
                               class="btn me-3 btn-lg rounded-pill btn-primærknap text-sekundærekstfarve border-outlinefarve"
                               style="width: 160px;">Fortsæt</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalCheckUd" tabindex="-1" aria-labelledby="modalCheckUdLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-outlinefarve">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCheckUdLabel"></h5>
                            <button type="button" class="btn-close btn-close-primærfarve lukkeknap"
                                    data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-primærtekstfarve brødtekst">
                            <div class="modal-body">
                                <p class="fs-2 fw-bold mb-4">Din bestilling er på vej</p>
                                <p class="fs-4 fw-medium">Tak for din bestilling, din mad er på vej. Vi håber du nyder
                                    din mad. Beløbet opkræves ved check ud af hotellet.</p>
                            </div>
                            <div class="modal-footer">
                                <a href="forside.php"
                                   class="btn me-3 btn-lg rounded-pill btn-primærknap text-sekundærekstfarve border-outlinefarve"
                                   style="width: 150px;">Afslut</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalLevering" tabindex="-1" aria-labelledby="modalLeveringLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-outlinefarve">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLeveringLabel"></h5>
                            <button type="button" class="btn-close btn-close-primærfarve lukkeknap"
                                    data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-primærtekstfarve brødtekst">
                            <div class="modal-body">
                                <p class="fs-2 fw-bold mb-4">Din bestilling er på vej</p>
                                <p class="fs-4 fw-medium">Tak for din bestilling, din mad er på vej. Betaling sker når
                                    maden bliver leveret. Vi håber du nyder din mad.</p>
                                <p class="fs-4 fw-medium">Vi accepterer</p>
                                <div class="hstack">
                                    <img src="img/visa.png" alt="visa" style="width: 60px; height: auto"> <img
                                            src="img/dankort.png" alt="dankort" style="width: 50px; height: auto">
                                    <img src="img/mastercard.png" alt="mastercard" style="width: 45px; height: auto">
                                    <img src="img/mobilepay.png" alt="mobilepay" style="width: 45px; height: auto">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a href="forside.php"
                                   class="btn me-3 btn-lg rounded-pill btn-primærknap text-sekundærekstfarve border-outlinefarve brødtekst"
                                   style="width: 160px;">Afslut</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-1"></div>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const radiobuttons = document.querySelectorAll('input[name="betaling"]');
        const betalKnappen = document.getElementById('betalKnappen');

        radiobuttons.forEach(radio => {
            radio.addEventListener('change', function () {
                if (this.value === 'online') {
                    betalKnappen.setAttribute('data-bs-target', '#modalOnline');
                } else if (this.value === 'checkud') {
                    betalKnappen.setAttribute('data-bs-target', '#modalCheckUd');
                } else if (this.value === 'levering') {
                    betalKnappen.setAttribute('data-bs-target', '#modalLevering');
                }
            });
        });
    });
</script>

<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
