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
                    $sql = "SELECT * FROM produkter INNER JOIN ingredienser ON ingrProdukterId = prodId ORDER BY ingrNavn ASC LIMIT 1";
                    $produkter = $db->sql($sql, $bind);
                    foreach ($produkter as $produkt) {
                        ?>
                        <div class="col-3">
                            <img src="img/<?php echo $produkt->prodProduktBillede ?>" class="img-fluid" alt="" style="border-radius: 70px;">
                        </div>
                        <div class="col-9 d-flex flex-column justify-content-between">

                            <div class="col-6 mb-3">
                                <h2 class="brødtekst text-primærtekstfarve text-bold fs-2 pt-4" style="line-height: 1;"><?php echo $produkt->prodNavn ?></h2>
                            </div>

                            <div class="brødtekst text-primærtekstfarve fs-1 fw-bold">
                                <div class="d-flex justify-content-between align-items-end mb-3">
                                    <div class="dropdown">
                                        <button class="btn dropdown-toggle bg-white border-outlinefarve fs-1 d-flex justify-content-between brødtekst text-primærtekstfarve ps-4 pe-4 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="border-radius: 70px; width: 100%">
                                            Antal: 1
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">1</a></li>
                                            <li><a class="dropdown-item" href="#">2</a></li>
                                            <li><a class="dropdown-item" href="#">3</a></li>
                                            <li><a class="dropdown-item" href="#"></a></li>
                                            <li><a class="dropdown-item" href="#">1</a></li>
                                            <li><a class="dropdown-item" href="#">1</a></li>
                                        </ul>
                                    </div>
                                    <div class="brødtekst text-primærtekstfarve fs-2 fw-bold me-5" id="pris">
                                        <?php echo number_format($produkt->prodPris, 2); ?> kr.
                                    </div>
                                </div>
                            </div>
                            <?php
                            }
                            ?>
                            </div>
                </div>
            </div>

            <div class="d-flex justify-content-end align-items-end vstack" style="margin-left: auto">
                <div class="brødtekst text-primærtekstfarve fs-2 fw-bold me-5 mt-5 mb-3" id="total-pris"> Total:
                    <?php echo number_format($produkt->prodPris, 2); ?> kr.
                </div>

                <a href="#">
                    <button type="button" class="btn btn-lg shadow rounded-pill btn-primærknap fs-3 brødtekst ms-3 me-5">
                        Fortsæt
                    </button>
                </a>
            </div>


        </div>
        <div class="col-1"></div>
    </div>
</div>

        <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
