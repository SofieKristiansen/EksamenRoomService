<?php
session_start();
unset($_SESSION['cart']); // Ryd indkøbskurven
header("Location: Pauseskearm.php"); // Omdiriger til pauseskærmen
exit();
?>