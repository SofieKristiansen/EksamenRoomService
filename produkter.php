<?php
require "settings/init.php";
?>
<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="utf-8">
    <title>Produkter</title>
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
                    <?php include("broedkrummesti.php"); ?>
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
            <?php
            if (!empty($_GET["kategoriId"])) {
                $kateId = $_GET["kategoriId"];
                $sqlKategori = "SELECT * FROM kategorier WHERE kateId = :kateId";
                $kategori = $db->sql($sqlKategori, [":kateId" => $kateId]);

                // Tjek om kategori blev fundet
                if (!empty($kategori)) {
                    // Udskriv kategorinavn og beskrivelse
                    $kategoriNavn = $kategori[0]->kateNavn;
                    $kategoriBeskrivelse = $kategori[0]->kateBeskrivelse;
                    ?>
                    <div class="kategori mb-5 d-flex">
                        <div class="row">
                            <div class="col-12">
                                <h2 class="display-1 overskrift fw-medium"><?php echo $kategoriNavn; ?></h2>
                            </div>
                            <div class="col-12">
                                <h2 class="brødtekst pt-3"><?php echo $kategoriBeskrivelse; ?></h2>
                            </div>
                        </div>
                    </div>

                    <div class="row g-5">
                        <?php
                        $sqlProdukter = "SELECT * FROM produkter WHERE prodKategoriId = :kateId";
                        $produkter = $db->sql($sqlProdukter, [":kateId" => $kateId]);

                        if (!empty($produkter)) {
                            foreach ($produkter as $produkt) {
                                ?>
                                <div class="col-6">

                                    <div class="bg-kortfarve pt-4 pb-3 position-relative" style="border-radius: 70px;">
                                        <div class="card-header brødtekst text-primærtekstfarve ps-4 fs-2 fw-bold pb-3 pe-3 pt-3">
                                            <?php echo $produkt->prodNavn; ?>
                                            <div class="d-flex align-items-center justify-content-center position-absolute" style="top: -15px; right: -15px;">
                                                <form id="tilføjikurv" action="addToCart.php">
                                                    <button type="submit" class="btn btn-secondary brødtekst rounded-circle bg-primærknap d-flex align-items-center justify-content-center" style="width: 70px; height: 70px; font-size: 55px; padding: 0;">+</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="card-body p-0 m-0">
                                            <img src="img/<?php echo $produkt->prodBillede ?>" class="img-fluid card-img-top" alt="">
                                        </div>
                                        <div class="card-footer">
                                            <div class="fs-1 fw- text-primærtekstfarve brødtekst fw-medium pt-3 ps-4">Pris</div>
                                            <div class="hstack justify-content-between fs-2 ps-4 brødtekst text-primærtekstfarve fw-bold" style="margin-top: -20px">
                                                <?php echo $produkt->prodPris; ?> kr.
                                                <div class="pe-2 pb-3">
                                                    <a href="produkt.php?prodId=<?php echo $produkt->prodId ?>">
                                                        <button type="button" class="btn shadow me-3 rounded-pill btn-primærknap fs-2 brødtekst" style="width: 150px;">Se mere</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {

                            echo "<div class='col-12'><p>Ingen produkter fundet i denne kategori.</p></div>";
                        }
                        ?>
                    </div>
                    <?php
                } else {

                    echo "<p>Den angivne kategori blev ikke fundet.</p>";
                }
            } else {

                echo "<p>Kategori ID blev ikke angivet.</p>";
            }
            ?>
        </div>
        <div class="col-1"></div>
    </div>
</div>

<script>
    document.getElementById('tilføjikurv').addEventListener('submit', (event) => {
        event.preventDefault(); // Forhindre standard formularindsendelse
        const formData = new FormData(event.target);

        fetch(event.target.action, {
            method: 'POST',
            body: formData
        })
            .then(response => response.text())
            .then(data => {

                const cartBadge = document.getElementById('cart-badge');

                let cartCount = parseInt(cartBadge.textContent, 10);
                if (isNaN(cartCount) || cartCount < 0) {
                    cartCount = 0;
                }

                cartBadge.textContent = cartCount + 1;
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
</script>

<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
