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

<div class="container-fluid mt-5 pt-5">
    <div class="row">
        <div class="col-1"></div>

        <div class="col-10 overskrift text-primærtekstfarve">

            <?php
            $sqlprodukter = "SELECT * FROM produkter";
            $produkter = $db->sql($sqlprodukter);
            foreach($produkter as $produkt) {
                ?>

                <div class="col-6">
                    <a href="produkter.php?kategoriId=<?php echo $produkt->prodId?>">
                        <h2 class="display-3 fw-medium"><?php echo $produkt->prodNavn?></h2>
                    </a>

                </div>

                <?php
            }
            ?>
        </div>
        <div class="col-1"></div>
    </div>
</div>




<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

