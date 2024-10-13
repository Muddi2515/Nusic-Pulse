<?php
require_once "connection.php";
// Start output buffering
ob_start();

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $name = $_SESSION['Name'];
}

// Handle music_id
if (isset($_GET['music_id'])) {
    $music_id = $_GET['music_id'];
    $check1 = mysqli_query($con, "SELECT * FROM favourites WHERE user_id = '$user_id' AND music_id = '$music_id'");

    if (mysqli_num_rows($check1) > 0) {
        echo json_encode(false); // Already added
        exit;
    } else {
        $query1 = "INSERT INTO favourites(user_id, music_id) VALUES ('$user_id', '$music_id')";
        $result1 = mysqli_query($con, $query1);

        if ($result1) {
            echo json_encode(true); // Successfully added
            exit;
        }
    }
}

// Handle video_id
if (isset($_GET['video_id'])) {
    $video_id = $_GET['video_id'];
    $check2 = mysqli_query($con, "SELECT * FROM favourites WHERE user_id = '$user_id' AND video_id = '$video_id'");

    if (mysqli_num_rows($check2) > 0) {
        echo json_encode(false); // Already added
        exit;
    } else {
        $query2 = "INSERT INTO favourites(user_id, video_id) VALUES ('$user_id', '$video_id')";
        $result2 = mysqli_query($con, $query2);

        if ($result2) {
            echo json_encode(true); // Successfully added
            exit;
        }
    }
}

// End output buffering and flush the output
ob_end_flush();

?>
<?php
include("header.php");
?>
<!-- music_area  -->
<div class="music_area music_gallery" style="background-color: #1D1F21;">
    <div class="container">
        <div class="row mb-4">
            <div class="col-xl-12">
                <div class="section_title text-center">
                    <h3 class="text-white"><?php echo $name ?> <br> <i class="fa fa-heart text-danger"> Favourites</i> </h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="section_title text-center mt-2">
                    <h1 class="text-uppercase text-warning"><?php ?> Music Tracks</h1>
                </div>
            </div>
        </div>
        <div class="row align-items-center justify-content-center mb-20">
            <?php
            $sql = "SELECT * FROM favourites WHERE user_id = '$user_id'";
            $result = mysqli_query($con, $sql);
            $count = mysqli_num_rows($result);
            if ($count > 0) {
                while ($rowf = mysqli_fetch_array($result)) {
                    $sql1 =  "SELECT * FROM music_table WHERE music_id = '$rowf[2]'";
                    $result1 = mysqli_query($con, $sql1);

                    while ($row = mysqli_fetch_array($result1)) {
                    
                    $cardId = 'card-' . $row['music_id'];

            ?>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 mb-20 mx-2 rounded-4" style="background-color: #33363A;" id="<?php echo $cardId ?>">
                            <div class="music_field mt-2 d-flex flex-column justify-content-between" style="height: 100%;">
                                <!-- Image and Play Icon Container -->
                                <div class="position-relative text-center mb-1" style="height: 150px; overflow: hidden;">
                                    <a href="musicsss.php?allSongs=true&song_id=<?php echo $row['music_id']; ?>&title=<?php echo urlencode($row[1]); ?>&artist=<?php echo urlencode($row[2]); ?>" class="text-decoration-none">
                                        <!-- Image -->
                                        <img src="<?php echo substr($row['cover_image_path'], 3, 100); ?>" alt="Music Cover" class="img-fluid rounded-4" style="width: 100%; height: 100%; object-fit: cover;">
                                        <!-- Play Icon -->
                                        <div class="play-icon position-absolute" style="left: 50%; top: 50%; transform: translate(-50%, -50%); pointer-events: none;">
                                            <i class="fa fa-music text-white" style="font-size: 40px;"></i>
                                        </div>
                                    </a>
                                </div>
                                <!-- Title and Favorite Button -->
                                <!-- Align button and title in the center -->
                                <div class="audio_name d-flex flex-column align-items-center mb-3">
                                    <h3 class="text-center text-white"><?php echo $row[1]; ?></h3>
                                    <a type="submit" onclick="removeFavourite('remove.php?mid=<?php echo $row['music_id'] ?>', '<?php echo $row['music_id'] ?>', '<?php echo $cardId ?>');" class="btn btn-danger px-5 mb-2 pt-1 pb-0">
                                        <i class="fa fa-trash text-center"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
            <?php
                    }
                }
            } else {
                $empty = "<span class='text-danger mt-5 text-center'>No Favourite Music <a href='audio.php' class='text-primary'>continue listening</a></span>";
                echo $empty;
            } ?>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="section_title text-center mt-3">
                    <h1 class="text-uppercase text-warning"><?php ?> video Tracks</h1>
                </div>
            </div>
        </div>
        <div class="row align-items-center justify-content-center mb-20">
            <?php
            $sql = "SELECT * FROM favourites WHERE user_id = '$user_id'";
            $result = mysqli_query($con, $sql);
            $count = mysqli_num_rows($result);
            if ($count > 0) {
                while ($rowf = mysqli_fetch_array($result)) {
                    $sql1 =  "SELECT * FROM video_table WHERE video_id = '$rowf[3]'";
                    $result1 = mysqli_query($con, $sql1);
                    while ($row = mysqli_fetch_array($result1)) {

                        $cardId = 'card-' . $row['video_id'];

            ?>


                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 mb-20 mx-2 rounded-4" style="background-color: #33363A;" id="<?php echo $cardId ?>">
                            <div class="music_field mt-2 d-flex flex-column justify-content-between" style="height: 100%;">
                                <!-- Image and Play Icon Container -->
                                <!-- have to add fav=true parameter to get the favourite in video page  -->
                                <div class="position-relative text-center mb-1" style="height: 150px; overflow: hidden;">
                                    <a href="videossss.php?allSongs=true&song_id=<?php echo $row['video_id']; ?>&title=<?php echo urlencode($row[1]); ?>&artist=<?php echo urlencode($row[2]); ?>" class="text-decoration-none">
                                        <!-- Image -->
                                        <img src="<?php echo substr($row['cover_image_path'], 3, 100); ?>" alt="Video Cover" class="img-fluid rounded-4" style="width: 100%; height: 100%; object-fit: cover;">
                                        <!-- Play Icon -->
                                        <div class="play-icon position-absolute" style="left: 50%; top: 50%; transform: translate(-50%, -50%); pointer-events: none;">
                                            <i class="fa fa-play-circle text-white" style="font-size: 40px;"></i>
                                        </div>
                                    </a>
                                </div>
                                <!-- Title and Favorite Button -->
                                <!-- Align button and title in the center -->
                                <div class="audio_name d-flex flex-column align-items-center mb-3">
                                    <h3 class="text-center text-white"><?php echo $row[1]; ?></h3>
                                    <a type="submit" onclick="removeFavourite('remove.php?vid=<?php echo $row['video_id'] ?>', '<?php echo $row['video_id'] ?>', '<?php echo $cardId; ?>');" class="btn btn-danger px-5 mb-2 pt-1 pb-0">
                                        <i class="fa fa-trash text-center"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php
                        ?>
            <?php }
                }
            } else {
                $empty = "<span class='text-danger mt-5 text-center'>No Favourite Music <a href='video.php' class='text-primary'>continue listening</a></span>";
                echo $empty;
            } ?>
        </div>
    </div>
</div>
<!-- music_area end  -->

<?php
include("footer.php")
?>