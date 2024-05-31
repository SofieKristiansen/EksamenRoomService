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
                        <p class="brødtekst text-primærtekstfarve fw-bold fs-1 ps-5 pb-3" style="line-height: 1;">Værelsesnummer</p>
                        <div class="col-2 input-group mb-3 mt-3 text-start ps-5">
                            <input type="number" id="vaerelsesnummer" class="form-control rounded-pill p-1 brødtekst text-primærtekstfarve fs-2 ps-4" style="width: 100px" placeholder="Indtast her.." aria-label="Indtast her..">
                            <span id="vaerelsesnummer-error" class="text-danger fs-3 ps-3" style="display: none;">Du skal indtaste dit værelsesnummer!</span>
                        </div>
                    </div>

                    <div class="col-3"></div>
                    <div class="ms-5 ps-5">
                        <div class="brødtekst text-primærtekstfarve fs-2 pt-2">

                            <div class="form-check p-3">
                                <input class="form-check-input form-check-input" type="radio" name="betaling" id="flexCheckDefault1" value="online">
                                <label class="form-check-label" for="flexCheckDefault1">Betal online</label>
                            </div>

                            <div class="form-check p-3">
                                <input class="form-check-input" type="radio" name="betaling" id="flexCheckDefault2" value="checkud">
                                <label class="form-check-label" for="flexCheckDefault2">Betal ved check ud</label>
                            </div>

                            <div class="form-check p-3 pb-4 d-flex justify-content-between align-items-center">
                                <div>
                                    <input class="form-check-input" type="radio" name="betaling" id="flexCheckDefault3" value="levering">
                                    <label class="form-check-label" for="flexCheckDefault3">Betal ved levering</label>
                                </div>

                                <a href="#" class="me-4 pe-5">
                                    <button type="button" id="betalKnappen" class="btn btn-lg rounded-pill btn-primærknap fs-3 brødtekst" style="width: 180px">
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
                <div class="modal-dialog modal-dialog-centered" style="max-width: 600px;">
                    <div class="modal-content border-outlinefarve">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalOnlineLabel"></h5>
                            <button type="button" class="btn-close btn-close-primærfarve lukkeknap"
                                    data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body modal-body text-primærtekstfarve brødtekst">
                            <p class="fs-1 fw-bold mb-4">Betalingsmetoder</p>

                            <div class="btn-group-vertical" role="group"
                                 aria-label="Vertical radio toggle button group">
                                <input type="radio" class="btn-check" name="vbtn-radio" id="vbtn-radio1"
                                       autocomplete="off">
                                <label class="btn btn-outline-primærfarve d-flex align-items-center"
                                       style="width: 300px;" for="vbtn-radio1">
                                    <img src="img/visa.png" alt="Visa" style="width: 45px; height:auto;">
                                    <span class="border-outlinefarve fs-4 fw-medium ms-5">Visa</span>
                                </label>
                                <input type="radio" class="btn-check" name="vbtn-radio" id="vbtn-radio2"
                                       autocomplete="off">
                                <label class="btn btn-outline-primærfarve d-flex align-items-center"
                                       style="width: 300px;" for="vbtn-radio2">
                                    <img src="img/dankort.png" alt="Dankort" style="width: 50px; height:auto;">
                                    <span class="border-outlinefarve fs-4 fw-medium ms-5">Dankort</span>
                                </label>
                                <input type="radio" class="btn-check" name="vbtn-radio" id="vbtn-radio3"
                                       autocomplete="off">
                                <label class="btn btn-outline-primærfarve d-flex align-items-center"
                                       style="width: 300px;" for="vbtn-radio3">
                                    <img src="img/paypal.png" alt="Paypal" style="width: 50px; height:auto;">
                                    <span class="border-outlinefarve fs-4 fw-medium ms-5">PayPal</span>
                                </label>
                                <input type="radio" class="btn-check" name="vbtn-radio" id="vbtn-radio4"
                                       autocomplete="off">
                                <label class="btn btn-outline-primærfarve d-flex align-items-center"
                                       style="width: 300px;" for="vbtn-radio4">
                                    <img src="img/mobilepay.png" alt="Mobilepay" style="width: 50px; height:auto;">
                                    <span class="border-outlinefarve fs-4 fw-medium ms-5">MobilePay</span>
                                </label>
                                <input type="radio" class="btn-check" name="vbtn-radio" id="vbtn-radio5"
                                       autocomplete="off">
                                <label class="btn btn-outline-primærfarve d-flex align-items-center"
                                       style="width: 300px;" for="vbtn-radio5">
                                    <img src="img/mastercard.png" alt="Mastercard" style="width: 50px; height:auto;">
                                    <span class="border-outlinefarve fs-4 fw-medium ms-5">Mastercard</span>
                                </label>
                            </div>

                            <p class="fs-2 fw-medium mt-4">Du bliver omdirigeret til din betalingsmetode via sikre (SSL)
                                sider. Her vil du kunne fuldføre din kreditkortbetaling for din bestilling.</p>
                        </div>

                        <div class="modal-footer">
                            <a href="#"
                               class="btn me-3 fs-3 btn-lg rounded-pill btn-primærknap text-sekundærekstfarve border-outlinefarve"
                               style="width: 180px;">Fortsæt</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalCheckUd" tabindex="-1" aria-labelledby="modalCheckUdLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" style="max-width: 600px;">
                    <div class="modal-content border-outlinefarve">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCheckUdLabel"></h5>
                            <button type="button" class="btn-close btn-close-primærfarve lukkeknap"
                                    data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-primærtekstfarve brødtekst">
                            <div class="modal-body">
                                <p class="fs-1 fw-bold mb-4">Din bestilling er på vej</p>
                                <p class="fs-2 fw-medium mb-4">Tak for din bestilling, din mad er på vej. Vi håber du nyder
                                    din mad. Beløbet opkræves ved check ud af hotellet.</p>
                            </div>
                            <div class="modal-footer">
                                <form action="clearCartAndRedirect.php" method="post">
                                    <button type="submit" class="btn me-3 fs-3 btn-lg rounded-pill btn-primærknap text-sekundærekstfarve border-outlinefarve brødtekst" style="width: 180px;">
                                        Afslut
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalLevering" tabindex="-1" aria-labelledby="modalLeveringLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" style="max-width: 600px;">
                    <div class="modal-content border-outlinefarve">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLeveringLabel"></h5>
                            <button type="button" class="btn-close btn-close-primærfarve lukkeknap"
                                    data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-primærtekstfarve brødtekst">
                            <div class="modal-body">
                                <p class="fs-1 fw-bold mb-4">Din bestilling er på vej</p>
                                <p class="fs-2 fw-medium">Tak for din bestilling, din mad er på vej. Betaling sker når
                                    maden bliver leveret. Vi håber du nyder din mad.</p>
                                <p class="fs-2 fw-bold pt-3">Vi accepterer</p>
                                <div class="hstack">
                                    <img src="img/visa.png" alt="visa" style="width: 60px; height: auto">
                                    <img src="img/dankort.png" alt="dankort" style="width: 50px; height: auto">
                                    <img src="img/mastercard.png" alt="mastercard" style="width: 45px; height: auto">
                                    <img src="img/mobilepay.png" alt="mobilepay" style="width: 45px; height: auto">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <form action="clearCartAndRedirect.php" method="post">
                                    <button type="submit" class="btn me-3 fs-3 btn-lg rounded-pill btn-primærknap text-sekundærekstfarve border-outlinefarve brødtekst" style="width: 180px;">
                                        Afslut
                                    </button>
                                </form>
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


    // Denne funktion tjekker, om feltet for værelsesnummer er tomt eller ej.
    function checkVaerelsesnummer(event) {
        const vaerelsesnummer = document.getElementById('vaerelsesnummer').value;
        const errorElement = document.getElementById('vaerelsesnummer-error');

        // Hvis værelsesnummeret er tomt, vises en rød fejlmeddelelse, og standardhandling (f.eks. form submission) forhindres.
        if (vaerelsesnummer.trim() === '') {
            errorElement.style.display = 'block';
            event.preventDefault(); // Forhindre standardhandling
            return false;
        } else {
            errorElement.style.display = 'none';
            return true;
        }
    }

    // Venter på, at hele dokumentet er færdig med at blive indlæst, før det tilføjer event listeners.
    document.addEventListener('DOMContentLoaded', function () {
        // Finder alle radioknapper for betalingsmetoder og betalingsknappen.
        const radiobuttons = document.querySelectorAll('input[name="betaling"]');
        const betalKnappen = document.getElementById('betalKnappen');

        // Funktion til at opdatere data-bs-target attributten baseret på valgt betalingsmetode.
        function updatePaymentMethod() {
            const selectedPaymentMethod = document.querySelector('input[name="betaling"]:checked');
            if (selectedPaymentMethod) {
                const paymentMethod = selectedPaymentMethod.value;
                let targetModal = '';

                if (paymentMethod === 'online') {
                    targetModal = '#modalOnline';
                } else if (paymentMethod === 'checkud') {
                    targetModal = '#modalCheckUd';
                } else if (paymentMethod === 'levering') {
                    targetModal = '#modalLevering';
                }

                betalKnappen.setAttribute('data-bs-toggle', 'modal');
                betalKnappen.setAttribute('data-bs-target', targetModal);
            }
        }

        // Først tjekkes om værelsesnummeret er indtastet ved at kalde checkVaerelsesnummer().
        betalKnappen.addEventListener('click', function (event) {
            if (!checkVaerelsesnummer(event)) {
                return;
            }

            updatePaymentMethod();

            const selectedPaymentMethod = document.querySelector('input[name="betaling"]:checked');
            if (selectedPaymentMethod) {
                const targetModal = selectedPaymentMethod.getAttribute('data-bs-target');
                // Trigger modalvinduet manuelt ved at skabe en ny Bootstrap modal og vise den.
                const modal = new bootstrap.Modal(document.querySelector(targetModal));
                modal.show();
            } else {
                event.preventDefault(); // Forhindre standardhandling, hvis ingen betalingsmetode er valgt
                alert('Vælg venligst en betalingsmetode.');
            }
        });

        radiobuttons.forEach(radio => {
            radio.addEventListener('change', function () {
                updatePaymentMethod(); // Opdater data-bs-target attributten ved ændring af betalingsmetode.
            });
        });
    });

</script>

<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
