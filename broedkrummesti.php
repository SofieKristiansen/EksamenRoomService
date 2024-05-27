<?php

$kategoriId = isset($_GET['kategoriId']) ? intval($_GET['kategoriId']) : 0;
$prodId = isset($_GET['prodId']) ? intval($_GET['prodId']) : 0;

if ($prodId > 0) {
    $sqlprodukt = "SELECT produkter.*, kategorier.kateNavn AS kategoriNavn FROM produkter INNER JOIN kategorier ON produkter.prodKateBrødId = kategorier.kateId WHERE produkter.prodId = $prodId";
    $produkter = $db->sql($sqlprodukt);
    if (!empty($produkter)) {
        $produkt = $produkter[0];
        $produkterURL = "produkter.php?kategoriId={$produkt->prodKateBrødId}";

        $produktNavnArray = explode(' ', $produkt->prodNavn);
        $kortProduktNavn = $produktNavnArray[0];
        ?>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb fs-1 pt-3 mt-3 fw-medium brødtekst">
                <li class="breadcrumb-item"><a class="text-primærtekstfarve" href="forside.php">Forside</a></li>
                <li class="breadcrumb-item"><a class="text-primærtekstfarve" href="<?php echo $produkterURL; ?>"><?php echo $produkt->kategoriNavn; ?></a></li>
                <li class="breadcrumb-item active text-primærtekstfarve" aria-current="page"><?php echo $kortProduktNavn; ?></li>
            </ol>
        </nav>
        <?php
    }
} elseif ($kategoriId > 0) {
    $sqlkategori = "SELECT * FROM kategorier WHERE kateId = $kategoriId";
    $kategorier = $db->sql($sqlkategori);
    if (!empty($kategorier)) {
        $kategori = $kategorier[0];
        ?>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb fs-1 pt-3 mt-3 fw-medium brødtekst">
                <li class="breadcrumb-item"><a class="text-primærtekstfarve" href="forside.php">Forside</a></li>
                <li class="breadcrumb-item active text-primærtekstfarve" aria-current="page"><?php echo $kategori->kateNavn; ?></li>
            </ol>
        </nav>
        <?php
    } else {
        echo "Kategorien blev ikke fundet.";
    }
} else {
    echo "Ugyldigt produkt- eller kategori-ID.";
}
?>