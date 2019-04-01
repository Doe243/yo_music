<?php

include_once "includes/config.php";

include_once "includes/classes/Artist.php";

include_once "includes/classes/Album.php";

include_once "includes/classes/Song.php";

session_destroy();

if(isset($_SESSION['userLoggedIn'])) 
{
    $userLoggedIn = $_SESSION['userLoggedIn'];
}
else {
    header("Location: register.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon/favicon-16x16.png">
    <link rel="manifest" href="assets/images/favicon/site.webmanifest">
    <link rel="mask-icon" href="assets/images/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/script.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"> 
    <title>Yo! Musik</title>
</head>
<body>

    <script>

        var audioElement = new Audio();

        audioElement.setTrack("assets/music/Meek_Mill/01.Wins&Losses.mp3");

        audioElement.audio.play();

    </script>

    <div id="mainContainer">

        <div id="topContainer">

            <?php include_once "includes/navBarContainer.php"  ?>

            <div id="mainViewContainer">

                <div id="mainContent">