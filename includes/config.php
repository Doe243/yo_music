<?php

ob_start();

session_start();

$timezone = date_default_timezone_get();

$con = mysqli_connect("localhost", "root", "","yo_music");

if (mysqli_connect_errno()) {
    
    echo "La connexion a échouée: " . mysqli_connect_errno();
}