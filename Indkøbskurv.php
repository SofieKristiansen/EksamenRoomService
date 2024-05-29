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

<div class="container-fluid pt-4">
    <div class="row">
        <div class="col-1"></div>

        <div class="col-10">
            <div class="breadcrumb-container">
                <div class="back-arrow">
                    <a href="produkt.php" class=" pe-5">
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
        <div class="col-10 text-primærtekstfarve">
            <div class="mb-5">
                <div class="display-1 overskrift fw-medium">Indkøbskurv</div>
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
                <?php
                $totalPris = 0;
                foreach ($cart as $productId => $quantity):
                    $sql = "SELECT * FROM produkter WHERE prodId = :prodId";
                    $produkt = $db->sql($sql, [':prodId' => $productId])[0];
                    $totalPris += $produkt->prodPris * $quantity;
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
                                <div class="brødtekst text-primærtekstfarve">
                                    <div class="d-flex justify-content-between align-items-end mb-3">
                                        <select id="quantitySelect<?php echo $productId; ?>" class="form-select fs-2 form-select-lg mb-3 quantitySelect" aria-label="Large select example" data-product-id="<?php echo $productId; ?>" data-prod-pris="<?php echo $produkt->prodPris; ?>" style="width: 200px;">
                                            <?php for ($i = 1; $i <= 10; $i++): ?>
                                                <option class="text-primærtekstfarve brødtekst fs-4" value="<?php echo $i; ?>" <?php echo ($i == $quantity) ? 'selected' : ''; ?>>Antal: <?php echo $i; ?></option>
                                            <?php endfor; ?>
                                        </select>

                                        <div class="brødtekst text-primærtekstfarve fs-2 fw-bold me-5 pris" id="pris<?php echo $productId; ?>">
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
                        <?php echo number_format($totalPris, 2); ?> kr.
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

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const quantitySelects = document.querySelectorAll('.quantitySelect');
        const totalPrisElement = document.getElementById('total-pris');
        let totalPris = <?php echo $totalPris; ?>;
        const cartBadge = document.getElementById('cart-badge');

        quantitySelects.forEach(select => {
            select.addEventListener('change', function() {
                const productId = this.getAttribute('data-product-id');
                const selectedQuantity = parseInt(this.value);
                const prodPris = parseFloat(this.getAttribute('data-prod-pris'));

                // Update individual product price
                const updatedPrice = (prodPris * selectedQuantity).toFixed(2);
                document.getElementById('pris' + productId).textContent = `${updatedPrice} kr.`;

                // Update total price
                totalPris = Array.from(quantitySelects).reduce((acc, select) => {
                    const selectedQuantity = parseInt(select.value);
                    const prodPris = parseFloat(select.getAttribute('data-prod-pris'));
                    return acc + (prodPris * selectedQuantity);
                }, 0);

                totalPrisElement.textContent = `Total: ${totalPris.toFixed(2)} kr.`;

                // Update cart badge
                const totalQuantity = Array.from(quantitySelects).reduce((acc, select) => {
                    return acc + parseInt(select.value);
                }, 0);

                cartBadge.textContent = totalQuantity;
                cartBadge.classList.toggle('visually-hidden', totalQuantity === 0);


            });
        });
    });
</script>

<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
