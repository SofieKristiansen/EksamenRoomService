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

            $sql = "SELECT * FROM produkter INNER JOIN kategorier ON prodKategoriId = kateId ORDER BY prodNavn ASC LIMIT 1";
            $produkter = $db->sql($sql, $bind);
            foreach ($produkter as $produkt) {

                ?>
                <div class="kategori mb-5 d-flex">
                    <div class="row ">
                        <div class="col-10">
                            <h2 class="display-1 overskrift fw-medium"><?php echo $produkt->prodNavn ?></h2>
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

            <div class="row g-5">

                <div class="col-6">
                    <div class="card shadow bg-kortfarve pt-4 ps-3 pb-1" style="border-radius: 70px;">
                        <div class="card-body">
                            <div class="brødtekst text-primærtekstfarve fs-1 fw-bold">Ingredienser</div>
                            <?php
                            $sql = "SELECT * FROM produkter INNER JOIN ingredienser ON ingrProdukterId = prodId ORDER BY ingrNavn ASC";
                            $produkter = $db->sql($sql, $bind);
                            foreach ($produkter as $produkt) {
                                ?>
                                <ul class="brødtekst text-primærtekstfarve fs-2 pt-4" style="line-height: 1;">
                                    <li><?php echo $produkt->ingrNavn ?></li>
                                </ul>
                                <?php
                            }
                            ?>
                            <div class="d-flex justify-content-end pe-3 pt-4">
                                <a href="#">
                                    <button type="button"
                                            class="btn shadow me-3 rounded-pill btn-primærknap fs-2 brødtekst"
                                            style="width: 150px;">Tilpas
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 ">
                    <?php
                    $sql = "SELECT * FROM produkter INNER JOIN ingredienser ON ingrProdukterId = prodId ORDER BY ingrNavn ASC LIMIT 1";
                    $produkter = $db->sql($sql, $bind);
                    foreach ($produkter as $produkt) {
                        ?>
                        <img src="img/<?php echo $produkt->prodProduktBillede ?>" class="img-fluid card-img-top pb-5"
                             alt="" style="border-radius: 70px;">
                        <?php
                    }
                    ?>

                    <div class="col-12">
                        <div class="card shadow bg-kortfarve pt-2 ps-3 pb-1" style="border-radius: 70px;">
                            <div class="card-body">

                                <div class="row align-items-center mb-3">
                                    <div class="col">
                                        <div class="btn bg-white border-outlinefarve fs-1 d-flex justify-content-between brødtekst text-primærtekstfarve ps-4 pe-4"
                                             style="border-radius: 70px; width: 100%">
                                            <div class="minus">-</div>
                                            <div class="tal">1</div>
                                            <div class="plus">+</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">

                                    <div class="brødtekst text-primærtekstfarve fs-2 fw-bold" id="pris">
                                        <?php echo number_format($produkt->prodPris, 2); ?> kr.
                                    </div>

                                    <div>
                                        <a href="#">
                                            <button type="button"
                                                    class="btn btn-lg shadow rounded-pill btn-primærknap fs-3 brødtekst">
                                                Læg i kurv
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


            </div>



        </div>

    </div>

    <div class="col-1"></div>
</div>



<script>

    const minus = document.querySelector(".minus");
    const plus = document.querySelector(".plus");
    const tal = document.querySelector(".tal");
    const prisElement = document.querySelector("#pris");

    // Gem den oprindelige pris som en attribut på knappen
    const oprindeligPris = Number(prisElement.textContent.replace(" kr.", "").replace(",", "."));
    tal.dataset.oprindeligPris = oprindeligPris;

    const opdaterPris = () => {
        const antal = Number(tal.textContent);
        const oprindeligPris = Number(tal.dataset.oprindeligPris);
        const nyPris = (oprindeligPris * antal).toFixed(2);
        prisElement.textContent = `${nyPris} kr.`;
    };

    minus.addEventListener("click", () => {
        const glTal = Number(tal.textContent);
        if (glTal > 1) {
            let nytTal = glTal - 1;
            tal.textContent = nytTal;
            opdaterPris();
        }
    });

    plus.addEventListener("click", () => {
        const glTal = Number(tal.textContent);
        if (glTal < 15) {
            let nytTal = glTal + 1;
            tal.textContent = nytTal;
            opdaterPris();
        }
    });




</script>


<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

