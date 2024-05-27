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

<body>

<?php
include("navbar.php");
?>

<div style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; overflow: hidden; z-index: -1;">
    <img src="img/blossom.png" alt="background" class="position-absolute top-0 start-0 w-100 h-100" style="object-fit: cover;">
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-1"></div>

        <div class="col-10">
            <div class="display-1 mt-5 pt-5 overskrift text-primærtekstfarve fw-medium">Hotel Strandparken</div>
        </div>

        <div class="col-1"></div>
    </div>
</div>


<div class="container-fluid mt-5 pt-5">
    <div class="row">
        <div class="col-1"></div>

        <div class="col-10 overskrift text-primærtekstfarve">

            <?php
            $sqlkategori = "SELECT * FROM kategorier";
            $kategorier = $db->sql($sqlkategori);
            foreach($kategorier as $kategori) {
                ?>

                <div class="col-6 hstack mb-4">
                    <img src="img/<?php echo $kategori->kateIkoner?>" alt="" style="width: 4em" class="me-4">
                    <a href="produkter.php?kategoriId=<?php echo $kategori->kateId?>">
                        <h2 class="display-2 fw-medium text-primærtekstfarve"><?php echo $kategori->kateNavn?></h2>
                    </a>
                </div>

                <?php
            }
            ?>
        </div>
        <div class="col-1"></div>
    </div>
</div>

<footer class="footer bg-sekundærfarve fixed-bottom">
    <div class="container-fluid">
        <div class="row">
            <div class="col-1"></div>

            <div class="col-10">
                <p class="pt-4 pb-3 fs-4 fw-bold text-primærtekstfarve brødtekst">Ved bestilling af roomservice ønsker vi at imødekomme dine individuelle behov og præferencer så godt som muligt.
                    Vær venlig at angive eventuelle allergier eller kostrestriktioner, så vores personale kan sikre, at din madoplevelse er både lækker og sikker.</p>
            </div>

            <div class="col-1"></div>

        </div>
    </div>
</footer>




<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>