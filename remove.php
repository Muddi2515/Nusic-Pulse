<?php


require_once "connection.php";
// Start output buffering
ob_start();

if (isset($_GET['mid'])) {
    $mid = $_GET['mid'];
    $delete1 = mysqli_query($con, "DELETE  FROM favourites WHERE music_id = '$mid'");
    if ($delete1) {
        echo json_encode(true); // Audio removed Successfully
        exit;
    } else {

        echo json_encode(true); // Audio Not Deleted
        exit;
    }
}

if (isset($_GET['vid'])) {
    $vid = $_GET['vid'];
    $delete1 = mysqli_query($con, "DELETE  FROM favourites WHERE video_id = '$vid'");

    if ($delete1) {
        echo json_encode(true); // Video Deleted
        exit;
    } else {

        echo json_encode(false); // Video Not Deleted
        exit;
    }
}


// End output buffering and flush the output
ob_end_flush();

?>