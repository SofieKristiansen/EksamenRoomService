<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="utf-8">
    <title>Produkt</title>
    <meta name="robots" content="All">
    <meta name="author" content="Udgiver">
    <meta name="copyright" content="Information om copyright">
    <link href="css/styles.css" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<video class="pausekearm" autoplay loop muted>
    <source src="pauseVid/PauseVideo.mp4" type="video/mp4">
</video>

<div>
    <div id="time" class="text-sekundærtekstfarve overskrift text-center display-1 fw-bold klokken" style="position: absolute; top: 20%; left: 50%; transform: translate(-50%, -50%); width: 100%; font-size: 11em;">12.23</div>
</div>

<div class="overlay-content">
    <a href="forside.php" class="btn me-3 btn-lg rounded-pill btn-primærknap brødtekst d-flex justify-content-center align-items-center" style="width: 520px; height: 100px;">
        <h1 class="m-0">Bestil roomservice</h1>
    </a>
</div>

</body>

<script>
    const time = document.querySelector('#time');

    function showTime() {
        const date = new Date();
        const hours = date.getHours().toString().padStart(2, 0);
        const minutes = date.getMinutes().toString().padStart(2, 0);
        const clock = hours + ':' + minutes;
        time.innerHTML = clock

        setTimeout(showTime, 1000);
    }

    showTime();

</script>

<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</html>