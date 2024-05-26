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

                        <div class=" d-flex flex-column justify-content-between">
                            <div class="col-6 mb-3 text-start">
                                <h2 class="brødtekst text-primærtekstfarve fw-bold fs-2 pt-4 ps-5" style="line-height: 1;">Oversigt</h2>
                            </div>

                            <div class="col-12 mb-3 text-start">
                                <h2 class="brødtekst text-primærtekstfarve text-bold fs-2 pt-4 ps-5" style="line-height: 1;"><?php echo $produkt->prodNavn ?></h2>
                            </div>

                            <div class="d-flex justify-content-end align-items-end flex-grow-1 col-12">
                                <div class="brødtekst text-primærtekstfarve fs-2 fw-bold me-5 mt-5 mb-3" id="total-pris"> Total:
                                    <?php echo number_format($produkt->prodPris, 2); ?> kr.
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>

            <div class="card shadow bg-kortfarve mt-5 pt-5" style="border-radius: 70px;">
                <div class="row">

                    <div class="col-6 text-start">
                        <h2 class="brødtekst text-primærtekstfarve fw-bold fs-2 ps-5" style="line-height: 1;">Værelsesnummer</h2>

                        <div class="col-2 input-group mb-3 mt-3 text-start ps-5">
                            <input type="text" class="form-control rounded-pill p-1 brødtekst text-primærtekstfarve fs-2 ps-4" style="width: 100px" placeholder="Indtast her.." aria-label="Indtast her..">
                        </div>

                    </div>

                    <div class="col-3"></div>

                    <div class="ms-5 ps-5">
                        <div class="brødtekst text-primærtekstfarve fs-2 pt-2">
                            <div class="form-check p-3">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault1">
                                <label class="form-check-label" for="flexCheckDefault1">
                                    Betal online
                                </label>
                            </div>
                            <div class="form-check p-3 d-flex justify-content-between align-items-center">
                                <div>
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault2">
                                    <label class="form-check-label" for="flexCheckDefault2">
                                        Betalt ved check ud
                                    </label>
                                </div>
                                <a href="#">
                                    <button type="button" class="btn btn-lg shadow rounded-pill btn-primærknap fs-3 brødtekst me-5">
                                        Betal
                                    </button>
                                </a>
                            </div>
                            <div class="form-check p-3">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault3">
                                <label class="form-check-label" for="flexCheckDefault3">
                                    Betal ved levering
                                </label>
                            </div>
                        </div>
                    </div>


                </div>

        </div>
        <div class="col-1"></div>
    </div>
</div>


<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
