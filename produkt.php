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


<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-1"></div>
        <div class="col-10 text-primærtekstfarve">
            <?php
            if ($_GET['prodId']) {
                $prodId = $_GET['prodId'];
                $sql = "SELECT * FROM produkter WHERE prodId = :prodId";
                $produkt = $db->sql($sql, [':prodId' => $prodId]);
                foreach ($produkt as $prod) {
                    ?>
                    <div class="kategori mb-5 d-flex">
                        <div class="row">
                            <div class="col-10">
                                <h2 class="display-1 overskrift fw-medium"><?php echo $prod->prodNavn ?></h2>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                $produkt = $produkt[0];
            } else {
                echo "<p>Ingen produktvalg fundet.</p>";
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
                            if ($_GET['prodId']) {
                                $prodId = $_GET['prodId'];
                                $sql = "SELECT * FROM ingredienser WHERE ingrProdukterId = :prodId ORDER BY ingrNavn ASC";
                                $produkter = $db->sql($sql, [':prodId' => $prodId]);
                                foreach ($produkter as $produkt) {
                                    ?>
                                    <ul class="brødtekst text-primærtekstfarve fs-2 pt-4" style="line-height: 1;">
                                        <li><?php echo $produkt->ingrNavn ?></li>
                                    </ul>
                                    <?php
                                }
                            } else {
                                echo "<p>Ingen produktvalg fundet.</p>";
                            }
                            ?>
                            <div class="d-flex justify-content-end pe-3 pt-4">
                                <a href="#">
                                    <button type="button" class="btn shadow me-3 rounded-pill btn-primærknap fs-2 brødtekst" style="width: 150px;" data-bs-toggle="modal" data-bs-target="#tilpasModal">
                                        Tilpas
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6">

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
                                        <button type="button" class="btn btn-lg shadow rounded-pill btn-primærknap fs-3 brødtekst ms-3" data-bs-toggle="modal" data-bs-target="#modal">
                                            Læg i kurv
                                        </button>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card shadow bg-kortfarve pt-2 ps-3 pb-1" style="border-radius: 70px;">
                        <div class="card-body">
                            <img src="img/StopMadspil.png" alt="" style="height: 100px; width: auto;">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-1"></div>
</div>

<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-outlinefarve">

            <div class="modal-header">
                <h5 class="modal-title text-primærtekstfarve" id="exampleModalLabel">Din bestilling</h5>
                <button type="button" class="btn-close btn-close-primærfarve lukkeknap" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <p class="fs-2 text-primærtekstfarve brødtekst"></p>
            </div>

            <div class="modal-footer">
                <a href="forside.php" class="btn btn-secondary me-3 btn-lg rounded-pill btn-sekundærknap text-primærtekstfarve border-outlinefarve" style="width: 150px;">Bestil mere</a>
                <a href="Indkøbskurv.php" class="btn btn-primary me-3 btn-lg rounded-pill btn-primærknap text-sekundærekstfarve border-outlinefarve" style="width: 150px;">Gå til kurv</a>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="tilpasModal" tabindex="-1" aria-labelledby="tilpasModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-outlinefarve">
            <div class="modal-header">
                <button type="button" class="btn-close btn-close-primærfarve lukkeknap" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="modal-title text-primærtekstfarve fs-2 brødtekst pb-4" id="tilpasModalLabel">Tilpas din bestilling</h5>
                <?php
                $sql = "SELECT * FROM ingredienser WHERE ingrProdukterId = :produktId ORDER BY ingrNavn ASC";
                $bind = [":produktId" => $produkt->prodId];
                $ingredienser = $db->sql($sql, $bind);
                foreach ($ingredienser as $index => $ingrediens) {
                    ?>
                    <div>
                        <p class="d-inline-flex gap-1 align-items-center">
                            <button class="btn btn-sekundærknap brødtekst text-primærtekstfarve border-outlinefarve fs-4 toggle-collapse" style="border-radius: 70px; width: 250px; height: 50px" type="button" data-target="#collapse<?php echo $index ?>">
                                <?php echo $ingrediens->ingrNavn ?>
                            </button>
                            <span class="ms-5 brødtekst text-primærtekstfarve fs-4">+ 8 kr.</span>
                        </p>
                        <div class="collapse mb-2" id="collapse<?php echo $index?>">
                            <div class="card card-body border-outlinefarve d-flex align-items-center justify-content-center" style="border-radius: 70px; width: 250px; height: 55px">
                                <div class="btn bg-white fs-4 d-flex justify-content-between brødtekst text-primærtekstfarve ps-4 pe-4" style="border-radius: 70px; width: 100%;">
                                    <div class="minus">-</div>
                                    <div class="tal">1</div>
                                    <div class="plus">+</div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-secondary me-3 btn-lg rounded-pill btn-sekundærknap brødtekst text-primærtekstfarve border-outlinefarve" style="width: 150px;">Annuller</a>
                <a href="#" class="btn btn-primary me-3 btn-lg rounded-pill btn-primærknap brødtekst text-sekundærekstfarve border-outlinefarve" style="width: 150px;">Gem</a>
            </div>
        </div>
    </div>
</div>


<script>
    document.querySelectorAll('.toggle-collapse').forEach(button => {
        button.addEventListener('click', function() {
            var target = document.querySelector(this.getAttribute('data-target'));
            if (target.classList.contains('show')) {
                target.classList.remove('show');
            } else {
                document.querySelectorAll('.collapse.show').forEach(openCollapse => {
                    openCollapse.classList.remove('show');
                });
                target.classList.add('show');
            }
        });
    });


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

