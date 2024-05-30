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
<body class="video">

<video class="pausekearm" autoplay loop muted>
    <source src="pauseVid/PauseVideo.mp4" type="video/mp4">
</video>

<div>
    <div id="date" class="text-sekundærtekstfarve brødtekst text-center fs-1" style="position: absolute; top: 11%; left: 50%; transform: translate(-50%, -50%); width: 100%;">Dato</div>
    <div id="time" class="text-sekundærtekstfarve overskrift text-center display-1 fw-bold klokken" style="position: absolute; top: 17%; left: 50%; transform: translate(-50%, -50%); width: 100%; font-size: 11em;"></div>

    <div id="welcome" class="display-3" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 8em;">
        <p class="text-sekundærtekstfarve fw-bold overskrift text-center ">Velkommen</p>
    </div>
</div>

<div class="overlay-content">
    <a href="forside.php" class="btn me-3 mt-3 btn-lg rounded-pill btn-primærknap d-flex justify-content-center align-items-center" style="width: 520px; height: 100px;">
        <p class="m-0 display-5 fw-medium brødtekst">Bestil roomservice</p>
    </a>
</div>

<script>
    const time = document.querySelector('#time');
    const dateElement = document.querySelector('#date');
    const weekdays = ['søndag', 'mandag', 'tirsdag', 'onsdag', 'torsdag', 'fredag', 'lørdag'];
    const months = ['januar', 'februar', 'marts', 'april', 'maj', 'juni', 'juli', 'august', 'september', 'oktober', 'november', 'december'];

    function showTime() {
        const date = new Date();
        const hours = date.getHours().toString().padStart(2, '0');
        const minutes = date.getMinutes().toString().padStart(2, '0');
        const clock = hours + ':' + minutes;
        time.innerHTML = clock;

        const dayOfWeek = weekdays[date.getDay()];
        const day = date.getDate();
        const month = months[date.getMonth()];
        const year = date.getFullYear();
        const fullDate = `${dayOfWeek} ${day}. ${month}`;
        dateElement.innerHTML = fullDate;

        setTimeout(showTime, 1000);
    }

    showTime();
</script>

<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
