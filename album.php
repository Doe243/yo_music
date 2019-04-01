<?php include_once "includes/header.php"; 

if (isset($_GET['id'])) {
    
    $albumId =  $_GET['id'];

}

else {
    header("Location: index.php");
}

$album = new Album($con, $albumId);

$artist = $album->getArtist();
?>

<div class="entityInfo">

    <div class="leftSection">

        <img src="<?= $album->getArtworkPath(); ?>" alt="">

    </div>

    <div class="rightSection">
        <h2><?= $album->getTitle(); ?></h2>
        <span>Par <?= $artist->getName(); ?></span>
        <p><?= $album->getNumberOfSongs();?> Titre(s)</p>
    </div>

</div>

<div class="trackListContainer">
    <ul class="trackList">
        <?php
            $songIdArray = $album->getSongIds();

            $i = 1;

            foreach ($songIdArray as $songId) {
                
                $albumSong = new Song($con, $songId);
                $albumArtist = $albumSong->getArtist();

                echo "<li class='trackListRow'>

                            <div class='trackCount'>
                                <img src='assets/images/icons/play-white.png' class='play'>
                                <span class='trackNumber'>$i</span>
                            </div>

                            <div class='trackInfo'>
                                <span class='trackName'>" . $albumSong->getTitle() . " </span>
                                <span class='artsitName'>" . $albumArtist->getName() ."</span>
                            </div>

                            <div class='trackOptions'>
                                <img src='assets/images/icons/more.png' class='optionsButtons'>
                            </div>

                            <div class='trackDuration'>
                                <span class='duration'>" .$albumSong->getDuration() . "</span>
                            </div>
                
                      </li>";
                $i++;
            }
        ?>
    </ul>
</div>



<?php include_once "includes/footer.php"; ?>