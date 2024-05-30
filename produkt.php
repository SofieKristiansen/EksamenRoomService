<?php
require "settings/init.php";
?>
<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="utf-8">
    <title>Produkt</title>
    <meta name="robots" content="All">
    <meta name="author" content="Udgiver">
    <meta name="copyright" content="Information om copyright">
    <link href="css/styles.css" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body class="bg-baggrundsfarve" style="overflow-y: hidden;">

<?php
include("navbar.php");
?>

<div class="container-fluid pt-4">
    <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
            <div class="breadcrumb-container">
                <div class="back-arrow hstack">
                    <a href="produkter.php?kategoriId=<?php echo htmlspecialchars($_GET['kategoriId']); ?>" class=" pe-5">
                        <img src="img/tilbagepil.webp" class="img-fluid" alt="Tilbagepil" style="height: 70px">
                    </a>
                    <?php include("broedkrummesti.php"); ?>
                </div>
            </div>
        </div>
        <div class="col-1"></div>
    </div>
</div>


<!-- Overskrift af produktnavn -->
<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-1"></div>
        <div class="col-10 text-primærtekstfarve">
            <?php
            if (!empty($_GET['prodId'])) {
                $prodId = $_GET['prodId'];
                $sql = "SELECT * FROM produkter WHERE prodId = :prodId";
                $produkt = $db->sql($sql, [':prodId' => $prodId]);
                if (!empty($produkt)) {
                    $produkt = $produkt[0];
                    ?>
                    <div class="kategori mb-5 d-flex text-primærtekstfarve">
                        <div class="row">
                            <div class="col-10">
                                <h2 class="display-2 overskrift fw-medium"><?php echo $produkt->prodNavn ?></h2>
                            </div>
                        </div>
                    </div>
                    <?php
                } else {
                    echo "<p>Ugyldigt produkt-ID.</p>";
                }
            } else {
                echo "<p>Produkt ID blev ikke angivet.</p>";
            }
            ?>
        </div>
        <div class="col-1"></div>
    </div>
</div>


<!-- Kort med tilpas funktionen og ingredienslisten og +/- knappen med tæller funktion og læg i kurv knap -->
<div class="container-fluid">
    <div class="row">
        <div class="col-1"></div>

        <div class="col-10">
            <div class="row g-5">

                <!-- Ingrediens kort og tilpas knap -->
                <div class="col-6">
                    <div class="card shadow bg-kortfarve pt-4 ps-3 pb-1 position-relative d-flex flex-column" style="border-radius: 70px; height: 700px;">
                        <div class="card-body flex-grow-1 d-flex flex-column">
                            <div class="brødtekst text-primærtekstfarve fs-1 fw-bold">Ingredienser</div>
                            <?php
                            $sql = "SELECT * FROM ingredienser WHERE ingrProdukterId = :prodId ORDER BY ingrNavn ASC";
                            $ingredienser = $db->sql($sql, [':prodId' => $prodId]);
                            foreach ($ingredienser as $ingrediens) {
                                ?>
                                <ul class="brødtekst text-primærtekstfarve fs-2 pt-4" style="line-height: 1;">
                                    <li><?php echo $ingrediens->ingrNavn ?></li>
                                </ul>
                                <?php
                            }
                            ?>
                            <div class="mt-auto d-flex justify-content-end">
                                <a href="#">
                                    <button type="button" class="btn btn-lg shadow rounded-pill btn-primærknap fs-3 brødtekst me-2" style="width: 150px;" data-bs-toggle="modal" data-bs-target="#tilpasModal">
                                        Tilpas
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Læg i kurv kort med pristæller -->
                <div class="col-6">
                    <img src="img/<?php echo $produkt->prodProduktBillede ?>" class="img-fluid card-img-top mb-5" alt="" style="border-radius: 70px;">

                    <div class="col-12">
                        <div class="card shadow bg-kortfarve pt-2 ps-2 pe-2 pb-1 d-flex flex-column" style="border-radius: 70px; height: 210px;">
                            <div class="card-body flex-grow-1 d-flex flex-column justify-content-between">
                                <div class="row align-items-center mb-3">
                                    <div class="col">
                                        <div class="btn bg-white border-outlinefarve d-flex justify-content-between brødtekst text-primærtekstfarve ps-4 pe-4" style="border-radius: 70px; width: 100%">
                                            <div class="minus display-4 fw-medium">-</div>
                                            <div class="tal display-4 fw-medium">1</div>
                                            <div class="plus display-4 fw-medium">+</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mt-3 mb-2">
                                    <div class="brødtekst text-primærtekstfarve fs-2 pt-3 ps-2 fw-bold" id="pris">
                                        <?php echo number_format($produkt->prodPris, 2, ',', '.'); ?> kr.
                                    </div>
                                    <form id="addToCartForm" action="addToCart.php" method="post">
                                        <input type="hidden" name="productId" value="<?php echo $prodId; ?>">
                                        <input type="hidden" name="quantity" value="1" id="quantityInput">
                                        <button type="submit" class="btn btn-lg shadow rounded-pill btn-primærknap fs-3 brødtekst ms-3 me-1">
                                            Læg i kurv
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Kort for leveringstid, anmeldelser og Refood ikon -->
                <div class="col-12 mt-4">
                    <div class="card shadow bg-kortfarve pt-2 ps-3 pb-4" style="border-radius: 70px;">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="d-flex flex-column align-items-start me-5 ps-3 pt-4">
                                <span class="brødtekst text-primærtekstfarve fs-4 fw-bold">Leveringstid</span>
                                <img src="img/leveringstid.webp" alt="Leveringstid" class="mx-auto my-2" style="width: 50px; height:auto;">
                                <span class="brødtekst text-primærtekstfarve fs-5 text-center w-100">20 minutter</span>
                            </div>
                            <div class="d-flex flex-column align-items-center me-5">
                                <div class="col-12 text-center pt-4">
                                    <span class="brødtekst text-primærtekstfarve fw-bold fs-4">Anmeldelser</span>
                                </div>
                                <img src="img/stjerner.webp" alt="Anmeldelser" class="mx-auto my-2" style="width: auto; height:40px; margin: 10px 0;">
                                <span class="brødtekst text-primærtekstfarve fs-5 text-center">(4.5/5 baseret på 20 anmeldelser)</span>
                            </div>
                            <div class="d-flex align-items-center pt-4 me-5" style="height: 140px;">
                                <img src="img/StopMadspil.png" alt="Refood" style="height: 140px; width: auto;">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-1"></div>
    </div>
</div>


<!-- Din bestilling modal-vindue -->
<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-outlinefarve" style="border-radius: 30px">
            <div class="modal-header">
                <div class="modal-title text-primærtekstfarve" id="exampleModalLabel"></div>
                <button type="button" class="btn-close btn-close-primærfarve lukkeknap" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-primærtekstfarve brødtekst">
                <p class="fw-bold fs-1">Din bestilling</p>
                <p class="fs-2 fw-medium"><?php echo $produkt->prodNavn; ?></p>
                <p class="fs-2 fw-medium">Tilvalg:</p>
                <p class="fs-2 fw-medium">Antal: <span id="modalQuantity"></span></p>
            </div>
            <div class="modal-footer">
                <a href="produkter.php?kategoriId=<?php echo htmlspecialchars($_GET['kategoriId']); ?>" class="btn me-3 btn-lg rounded-pill btn-sekundærknap text-primærtekstfarve border-outlinefarve fs-3 fw-medium brødtekst" style="width: 180px;">Bestil mere</a>
                <a href="Indkøbskurv.php" class="btn btn-primary me-3 btn-lg rounded-pill btn-primærknap text-sekundærtekstfarve fs-3 fw-medium brødtekst" style="width: 180px;">Gå til kurv</a>
            </div>
        </div>
    </div>
</div>

<!-- Tilpas din bestilling modal-vindue -->
<div class="modal fade" id="tilpasModal" tabindex="-1" aria-labelledby="tilpasModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 600px;">
        <div class="modal-content border-outlinefarve">
            <div class="modal-header">
                <button type="button" class="btn-close btn-close-primærfarve lukkeknap" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="modal-title text-primærtekstfarve fs-1 brødtekst pb-4 fw-bold" id="tilpasModalLabel">Tilpas din bestilling</div>
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


<!-- Javascript for funktionalitet -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const minus = document.querySelector(".minus");
        const plus = document.querySelector(".plus");
        const tal = document.querySelector(".tal");
        const prisElement = document.querySelector("#pris");
        const quantityInput = document.getElementById("quantityInput");
        const addToCartForm = document.getElementById("addToCartForm");

        // Gem den oprindelige pris som en attribut på prisen
        const oprindeligPris = Number(prisElement.textContent.replace(" kr.", "").replace(",", "."));
        tal.dataset.oprindeligPris = oprindeligPris;

        const opdaterPris = () => {
            const antal = Number(tal.textContent);
            const oprindeligPris = Number(tal.dataset.oprindeligPris);
            const nyPris = (oprindeligPris * antal).toFixed(2).replace(".", ",");
            prisElement.textContent = `${nyPris} kr.`;
        };

        minus.addEventListener("click", () => {
            const glTal = Number(tal.textContent);
            if (glTal > 1) {
                let nytTal = glTal - 1;
                tal.textContent = nytTal;
                quantityInput.value = nytTal;
                opdaterPris();
            }
        });

        plus.addEventListener("click", () => {
            const glTal = Number(tal.textContent);
            if (glTal < 15) {
                let nytTal = glTal + 1;
                tal.textContent = nytTal;
                quantityInput.value = nytTal;
                opdaterPris();
            }
        });

        addToCartForm.addEventListener('submit', (event) => {
            event.preventDefault(); // Forhindre standard formularindsendelse
            const formData = new FormData(addToCartForm);

            fetch(addToCartForm.action, {
                method: 'POST',
                body: formData
            })
                .then(response => response.text())
                .then(data => {
                    // Opdater kurv-ikonet hvis nødvendigt
                    const cartBadge = document.getElementById('cart-badge');

                    let cartCount = parseInt(cartBadge.textContent, 10);
                    if (isNaN(cartCount) || cartCount < 0) {
                        cartCount = 0;
                    }

                    cartBadge.textContent = parseInt(cartCount) + parseInt(formData.get('quantity'));
                    cartBadge.classList.remove('visually-hidden');

                    // Opdater modalindholdet med det valgte antal
                    const modalQuantity = document.getElementById('modalQuantity');
                    modalQuantity.textContent = formData.get('quantity');

                    // Vis modalvinduet
                    new bootstrap.Modal(document.getElementById('modal')).show();
                })
                .catch(error => console.error('Fejl ved opdatering af kurv:', error));
        });
    });

</script>

<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
