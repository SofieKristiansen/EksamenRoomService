<?php
require "settings/init.php";
session_start();
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
?>
<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="utf-8">
    <title>Indkøbskurv</title>
    <meta name="robots" content="All">
    <meta name="author" content="Udgiver">
    <meta name="copyright" content="Information om copyright">
    <link href="css/styles.css" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body class="bg-baggrundsfarve">
<?php include("navbar.php"); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
            <div class="breadcrumb-container">
                <div class="back-arrow pt-3">
                    <?php include("tilbagepil.php"); ?>
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
            <div class="mb-5 text-primærtekstfarve">
                <div class="display-2 overskrift fw-medium">Indkøbskurv</div>
            </div>
            <?php if (empty($cart)): ?>
                <p class="brødtekst fs-1 fw-bold text-primærtekstfarve">Din indkøbskurv er tom.</p>
                <p class="brødtekst fs-1 text-primærtekstfarve">Det ser ud til, at du ikke har tilføjet nogen varer til din kurv endnu. Udforsk vores udvalg og find dine favoritter!</p>
                <div class="d-flex justify-content-end">
                    <a href="forside.php" class="btn btn-lg shadow rounded-pill btn-primærknap fs-3 brødtekst ms-3" style="width: 160px;">
                        Forside
                    </a>
                </div>
            <?php else: ?>
                <?php foreach ($cart as $productId => $quantity): ?>
                    <?php
                    $sql = "SELECT * FROM produkter WHERE prodId = :prodId";
                    $produkt = $db->sql($sql, [':prodId' => $productId])[0];
                    ?>
                    <div class="card shadow bg-kortfarve mb-5" style="border-radius: 70px;">
                        <div class="row">
                            <div class="col-3">
                                <img src="img/<?php echo $produkt->prodProduktBillede ?>" class="img-fluid object-fit-cover" alt="" style="border-radius: 70px;">
                            </div>
                            <div class="col-9 d-flex flex-column justify-content-between">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h2 class="brødtekst text-primærtekstfarve text-bold fs-2 pt-4 me-5" style="line-height: 1;"><?php echo $produkt->prodNavn ?></h2>
                                    <div class="d-flex align-items-center ">
                                        <button type="button" class="btn btn-lg me-3" data-bs-toggle="modal" data-bs-target="#tilpasModal<?php echo $productId; ?>" style="padding: 0; margin: 0;">
                                            <img src="img/blyant.webp" alt="rediger" class="pt-2 me-3" style="width: 35px; height:auto; margin: 0;">
                                        </button>

                                        <!-- Tilpas Modal -->
                                        <div class="modal fade" id="tilpasModal<?php echo $productId; ?>" tabindex="-1" aria-labelledby="tilpasModalLabel<?php echo $productId; ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" style="max-width: 600px;">
                                                <div class="modal-content border-outlinefarve">
                                                    <div class="modal-header">
                                                        <button type="button" class="btn-close btn-close-primærfarve lukkeknap" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="modal-title text-primærtekstfarve fs-1 brødtekst pb-4 fw-bold" id="tilpasModalLabel<?php echo $productId; ?>">Tilpas din bestilling</div>
                                                        <div class="text-primærtekstfarve fs-2 brødtekst pb-4 fw-medium"><?php echo $produkt->prodNavn; ?></div>
                                                        <?php
                                                        $sql = "SELECT * FROM ingredienser WHERE ingrProdukterId = :produktId ORDER BY ingrNavn ASC";
                                                        $bind = [":produktId" => $produkt->prodId];
                                                        $ingredienser = $db->sql($sql, $bind);
                                                        foreach ($ingredienser as $index => $ingrediens) {
                                                            ?>

                                                            <div class="d-flex justify-content-between align-items-center mb-4">
                                                                <div class="dropdown" style="width: 300px;">
                                                                    <button class="btn btn-sekundærknap border-outlinefarve rounded-pill fs-2 fw-bold brødtekst text-primærtekstfarve text-start ps-4 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="width: 100%;">
                                                                        <?php echo $ingrediens->ingrNavn ?>
                                                                    </button>
                                                                    <ul class="dropdown-menu p-0 m-0 border-outlinefarve" style="width: 300px;">
                                                                        <li class="display-3 brødtekst d-flex justify-content-between align-items-center text-center">
                                                                            <div class="dropdown-item text-primærtekstfarve minus">-</div>
                                                                            <div class="dropdown-item text-primærtekstfarve tal">1</div>
                                                                            <div class="dropdown-item text-primærtekstfarve plus">+</div>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <div class="ms-3 fs-2 brødtekst text-primærtekstfarve fw-bold">
                                                                    + <?php echo $ingrediens->ingrPris ?> kr
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="#" class="btn btn-secondary me-3 btn-lg rounded-pill btn-sekundærknap brødtekst text-primærtekstfarve border-outlinefarve" style="width: 160px;">Annuller</a>
                                                        <a href="#" class="btn btn-primary me-3 btn-lg rounded-pill btn-primærknap brødtekst text-sekundærekstfarve border-outlinefarve" style="width: 160px;">Gem</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Slet knap og modal -->
                                        <button type="button" class="btn btn-lg me-5" data-bs-toggle="modal" data-bs-target="#sletModal<?php echo $productId; ?>" style="padding: 0; margin: 0;">
                                            <img src="img/skraldespand.webp" alt="" class="pt-2" style="width: 35px; height:auto; margin: 0;">
                                        </button>

                                        <div class="modal fade" id="sletModal<?php echo $productId; ?>" tabindex="-1" aria-labelledby="sletModalLabel<?php echo $productId; ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content border-outlinefarve" style="border-radius: 30px">
                                                    <div class="modal-header">
                                                        <div class="modal-title text-primærtekstfarve" id="sletModalLabel<?php echo $productId; ?>"></div>
                                                        <button type="button" class="btn-close btn-close-primærfarve lukkeknap" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-primærtekstfarve brødtekst">
                                                        <p class="fw-bold fs-1">Slet din bestilling</p>
                                                        <p class="fs-2 fw-medium">Er du sikker på at du vil slette dette fra din bestilling?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary me-3 btn-lg rounded-pill btn-sekundærknap text-primærtekstfarve border-outlinefarve fs-4 fw-medium brødtekst" data-bs-dismiss="modal" style="width: 160px;">Annuller</button>
                                                        <form action="removeFromCart.php" method="post" style="display:inline;">
                                                            <input type="hidden" name="productId" value="<?php echo $productId; ?>">
                                                            <button type="submit" class="btn btn-primary me-3 btn-lg rounded-pill btn-primærknap text-sekundærekstfarve border-outlinefarve fs-4 fw-medium brødtekst" style="width: 160px;">Ja, slet</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="brødtekst text-primærtekstfarve fs-1 fw-bold">
                                    <div class="d-flex justify-content-between align-items-end mb-3">
                                        <div class="dropdown">
                                            <button class="btn dropdown-toggle align bg-white border-outlinefarve fs-1 d-flex justify-content-between brødtekst text-primærtekstfarve ps-4 pe-4 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="border-radius: 70px; width: 100%">
                                                Antal: <?php echo $quantity; ?>
                                            </button>
                                            <ul class="dropdown-menu text-end pe-2 border-outlinefarve" style="width: 100%;">
                                                <li><a class="dropdown-item text-primærtekstfarve brødtekst display-4" href="#">1</a></li>
                                                <li><a class="dropdown-item text-primærtekstfarve brødtekst display-4" href="#">2</a></li>
                                                <li><a class="dropdown-item text-primærtekstfarve brødtekst display-4" href="#">3</a></li>
                                                <li><a class="dropdown-item text-primærtekstfarve brødtekst display-4" href="#">4</a></li>
                                                <li><a class="dropdown-item text-primærtekstfarve brødtekst display-4" href="#">5</a></li>
                                                <li><a class="dropdown-item text-primærtekstfarve brødtekst display-4" href="#">6</a></li>
                                            </ul>
                                        </div>
                                        <div class="brødtekst text-primærtekstfarve fs-2 fw-bold me-5" id="pris">
                                            <?php echo number_format($produkt->prodPris * $quantity, 2); ?> kr.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="d-flex justify-content-end align-items-end vstack" style="margin-left: auto">
                    <div class="brødtekst text-primærtekstfarve fs-2 fw-bold me-5 mt-5 mb-3" id="total-pris"> Total:
                        <?php echo number_format(array_reduce($cart, function ($carry, $quantity) use ($db) {
                            $sql = "SELECT prodPris FROM produkter WHERE prodId = :prodId";
                            $product = $db->sql($sql, [':prodId' => $quantity]);
                            return $carry + $product[0]->prodPris * $quantity;
                        }, 0), 2); ?> kr.
                    </div>
                    <a href="DinBetaling.php">
                        <button type="button" class="btn btn-lg shadow rounded-pill btn-primærknap fs-3 brødtekst ms-3 me-5">
                            Fortsæt
                        </button>
                    </a>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-1"></div>
    </div>
</div>

<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
