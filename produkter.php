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






<div class="container-fluid mt-5 ">
    <div class="row">
        <div class="col-1"></div>

        <div class="col-10 text-primærtekstfarve">

            <?php


            $sql = "SELECT * FROM produkter INNER JOIN kategorier ON prodId = kateId ORDER BY kateNavn ASC LIMIT 1";
            $produkter = $db->sql($sql, $bind);
            foreach($produkter as $produkt) {

                ?>
                <div class="kategori mb-5 d-flex">
                    <div class="row w-100">
                        <div class="col-6">
                            <h2 class="display-1 overskrift fw-medium"><?php echo $produkt->kateNavn?></h2>
                        </div>

                        <div class="col-12">
                            <h2 class="brødtekst pt-3"><?php echo $produkt->kateBeskrivelse ?></h2>
                        </div>
                    </div>
                </div>
                <?php
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
            <div class="row">


            <?php
            $produkter = $db->sql("SELECT * FROM produkter");
            foreach($produkter as $produkt) {
                ?>
                <div class="col-6 ">
                    <div class="card w-100 mt-5 bg-kortfarve ps-2 pt-3 pb-3" style="border-radius: 55px;">
                        <div class="card-header brødtekst text-primærtekstfarve fs-1 fw-bold pb-3">
                            <?php
                            echo $produkt->prodNavn;
                            ?>
                        </div>
                        <div class="card-body">

                            <img src="img/AvocadoMad-kopi.jpg" class="img-fluid prodbillede">

                            <?php
                            // Billede
                            ?>
                        </div>
                        <div class="card-footer text-muted ">
                            <div class=" fs-1 text-primærtekstfarve brødtekst pt-3">Pris</div>

                            <div class="hstack justify-content-between fs-1 brødtekst text-primærtekstfarve fw-bold">
                            <?php
                            echo $produkt->prodPris;
                            ?>

                            <div class="">
                                <a href="forside.php"><button type="button" class="btn me-3 rounded-pill btn-primærknap fs-2 brødtekst" style="width: 150px;">Se mere</button></a>
                            </div>

                            </div>

                        </div>
                    </div>
                </div>
                <?php
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
