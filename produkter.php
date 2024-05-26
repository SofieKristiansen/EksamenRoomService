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
include("tilbagepil.php");
?>

<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-1"></div>
        <div class="col-10 text-primærtekstfarve">
            <?php
            if (!empty($_GET["kategoriId"])) {
                $kateId = $_GET["kategoriId"];
                $sqlProdukter = "SELECT * FROM produkter WHERE prodKategoriId = :kateId";
                $bind = [":kateId" => $kateId];
                $produkter = $db->sql($sqlProdukter, $bind);

                if (!empty($produkter)) {
                    $sqlKategori = "SELECT * FROM kategorier WHERE kateId = :kateId";
                    $kategori = $db->sql($sqlKategori, $bind)[0];
                    ?>
                    <div class="kategori mb-5 d-flex">
                        <div class="row w-100">
                            <div class="col-6">
                                <h2 class="display-1 overskrift fw-medium"><?php echo $kategori->kateNavn ?></h2>
                            </div>
                            <div class="col-12">
                                <h2 class="brødtekst pt-3"><?php echo $kategori->kateBeskrivelse ?></h2>
                            </div>
                        </div>
                    </div>
                    <?php
                } else {
                    echo "<p>Ingen produkter fundet i denne kategori.</p>";
                }
            } else {
                echo "<p>Kategori ID ikke angivet.</p>";
            }
            ?>
        </div>
        <div class="col-1"></div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
            <div class="row g-5">
                <?php
                if (!empty($produkter)) {
                    foreach ($produkter as $produkt) {
                        ?>
                        <div class="col-6">
                            <div class="bg-kortfarve pt-4 pb-3 position-relative" style="border-radius: 70px;">
                                <div class="card-header brødtekst text-primærtekstfarve ps-4 fs-2 fw-bold pb-3 pe-3 pt-3">
                                    <?php echo $produkt->prodNavn; ?>
                                    <div class="d-flex align-items-center justify-content-center position-absolute" style="top: -15px; right: -15px;">
                                        <a href="#">
                                            <button type="button" class="btn btn-secondary brødtekst rounded-circle bg-primærknap d-flex align-items-center justify-content-center" style="width: 70px; height: 70px; font-size: 55px; padding: 0;">+</button>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body p-0 m-0">
                                    <img src="img/<?php echo $produkt->prodBillede ?>" class="img-fluid card-img-top" alt="">
                                </div>
                                <div class="card-footer">
                                    <div class="fs-1 fw- text-primærtekstfarve brødtekst pt-2 ps-4">Pris</div>
                                    <div class="hstack justify-content-between fs-2 ps-4 brødtekst text-primærtekstfarve fw-bold">
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
                }
                ?>
            </div>
        </div>
        <div class="col-1"></div>
    </div>
</div>

<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
