<?php
require_once "connection.php";
?>

<?php
// music.php


// Fetch banner images from the database
// $banner_sql = "SELECT * FROM music_table"; // Adjust the SQL query based on your banners table
// $banner_result = $con->query($banner_sql);

// $banners = [];
// if ($banner_result->num_rows > 0) {
//     while($row = $banner_result->fetch_assoc()) {
//         $banners[] = $row['image_path']; // Assuming 'image_path' is the column name for the banner image
//     }
// }

$songId = isset($_GET['song_id']) ? intval($_GET['song_id']) : 0;
$title = isset($_GET['title']) ? htmlspecialchars($_GET['title']) : 'Unknown Title';
$artist = isset($_GET['artist']) ? htmlspecialchars($_GET['artist']) : 'Unknown Artist';


if (isset($_GET['allSongs']) && $_GET['allSongs'] == 'true') {
    // Fetch all songs
    $music_sql = "SELECT * FROM music_table"; // Adjust the SQL query based on your music table
    $music_result = $con->query($music_sql);

    $playlist = []; // Initialize playlist

    // Add the clicked song first, if available
    if ($songId) {
        $clicked_song_sql = "SELECT * FROM music_table WHERE music_id = '$songId'"; // Fetch clicked song details
        $clicked_song_result = $con->query($clicked_song_sql);

        if ($clicked_song_result->num_rows > 0) {
            $clicked_song = $clicked_song_result->fetch_assoc();
            $playlist[] = [
                'songId' => $clicked_song['music_id'],
                'title' => $clicked_song['title'],
                'artist' => $clicked_song['artist'],
                'src' => str_replace('../', './', $clicked_song['audio_path']),
                'image' => str_replace('../', './', $clicked_song['cover_image_path']),
            ];
        }
    }

    // Fetch all songs except the clicked song (if it exists)
    if ($music_result->num_rows > 0) {
        while ($row = $music_result->fetch_assoc()) {
            if ($row['music_id'] == $songId) {
                continue; // Skip the clicked song if it's already added
            }
            $playlist[] = [
                'songId' => $row['music_id'],
                'title' => $row['title'],
                'artist' => $row['artist'],
                'src' => str_replace('../', './', $row['audio_path']),
                'image' => str_replace('../', './', $row['cover_image_path']),
            ];
        }
    }
} else if (isset($_GET['genre']) && $_GET['genretype'] == 'true') {
    // Fetch all songs
    $genreToFetch = $_GET['genre'];
    $music_sql = "SELECT * FROM music_table where genre = '$genreToFetch'"; // Adjust the SQL query based on your music table
    $music_result = $con->query($music_sql);

    $playlist = []; // Initialize playlist

    // Add the clicked song first, if available
    if ($songId) {
        $clicked_song_sql = "SELECT * FROM music_table WHERE music_id = '$songId'"; // Fetch clicked song details
        $clicked_song_result = $con->query($clicked_song_sql);

        if ($clicked_song_result->num_rows > 0) {
            $clicked_song = $clicked_song_result->fetch_assoc();
            $playlist[] = [
                'songId' => $clicked_song['music_id'],
                'title' => $clicked_song['title'],
                'artist' => $clicked_song['artist'],
                'src' => str_replace('../', './', $clicked_song['audio_path']),
                'image' => str_replace('../', './', $clicked_song['cover_image_path']),
            ];
        }
    }

    // Fetch all songs except the clicked song (if it exists)
    if ($music_result->num_rows > 0) {
        while ($row = $music_result->fetch_assoc()) {
            if ($row['music_id'] == $songId) {
                continue; // Skip the clicked song if it's already added
            }
            $playlist[] = [
                'songId' => $row['music_id'],
                'title' => $row['title'],
                'artist' => $row['artist'],
                'src' => str_replace('../', './', $row['audio_path']),
                'image' => str_replace('../', './', $row['cover_image_path']),
            ];
        }
    }
} else if (isset($_GET['latest']) && $_GET['latest'] == 'true') {
    // Fetch all songs

    $music_sql = "SELECT * FROM music_table ORDER BY release_date DESC LIMIT 5"; // Adjust the SQL query based on your music table
    $music_result = $con->query($music_sql);

    $playlist = []; // Initialize playlist

    // Add the clicked song first, if available
    if ($songId) {
        $clicked_song_sql = "SELECT * FROM music_table WHERE music_id = '$songId'"; // Fetch clicked song details
        $clicked_song_result = $con->query($clicked_song_sql);

        if ($clicked_song_result->num_rows > 0) {
            $clicked_song = $clicked_song_result->fetch_assoc();
            $playlist[] = [
                'songId' => $clicked_song['music_id'],
                'title' => $clicked_song['title'],
                'artist' => $clicked_song['artist'],
                'src' => str_replace('../', './', $clicked_song['audio_path']),
                'image' => str_replace('../', './', $clicked_song['cover_image_path']),
            ];
        }
    }

    // Fetch all songs except the clicked song (if it exists)
    if ($music_result->num_rows > 0) {
        while ($row = $music_result->fetch_assoc()) {
            if ($row['music_id'] == $songId) {
                continue; // Skip the clicked song if it's already added
            }
            $playlist[] = [
                'songId' => $row['music_id'],
                'title' => $row['title'],
                'artist' => $row['artist'],
                'src' => str_replace('../', './', $row['audio_path']),
                'image' => str_replace('../', './', $row['cover_image_path']),
            ];
        }
    }
} else {

    // Fetch music data (example)
    $music_sql = "SELECT * FROM music_table where artist like '%$artist%' "; // Adjust the SQL query based on your music table
    $music_result = $con->query($music_sql);


    // for related music
    $related_music_sql = "SELECT * FROM music_table where artist like '%$artist%' and music_id = '$songId'"; // Adjust the SQL query based on your music table
    $related_music_result = $con->query($related_music_sql);


    // echo "<prev>";
    // var_dump($music_result);
    // echo "<prev>";
    // exit();
    $playlist = [];

    // for  music_palyer to assing music
    if ($related_music_result->num_rows > 0) {
        while ($row = $related_music_result->fetch_assoc()) {
            $playlist[] = [
                'songId' => $row['music_id'],
                'title' => $row['title'], // Adjust the column name
                'artist' => $row['artist'], // Adjust the column name
                'src' => str_replace('../', './', $row['audio_path']), // Adjust the column name
                'image' => str_replace('../', './', $row['cover_image_path']), // Adjust the column name
            ];
        }
    }

    // for realted music
    if ($music_result->num_rows > 0) {
        while ($row = $music_result->fetch_assoc()) {

            if ($row['music_id']  == $songId) {
                continue;
            }
            $playlist[] = [
                'songId' => $row['music_id'],
                'title' => $row['title'], // Adjust the column name
                'artist' => $row['artist'], // Adjust the column name
                'src' => str_replace('../', './', $row['audio_path']), // Adjust the column name
                'image' => str_replace('../', './', $row['cover_image_path']), // Adjust the column name
            ];
        }
    }
}
$con->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>E-SOUND</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="assets/vendors/jvectormap/jquery-jvectormap.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/audioplayer.css">
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/gijgo.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/slicknav.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #1d1f21;
            color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .music-player {
            background-color: #2d2f33;
            padding: 20px;
            border-radius: 8px;
        }

        .music-player audio {
            width: 100%;
            margin-bottom: 15px;
        }

        .related-music,
        .advertisement {
            background-color: #33363a;
            padding: 15px;
            border-radius: 8px;
        }

        .related-music img,
        .advertisement img {
            width: 100%;
            height: auto;
            border-radius: 6px;
        }

        .related-music .music-item {
            margin-bottom: 10px;
        }

        .advertisement {
            margin-top: 20px;
        }

        .advertisement img {
            max-height: 250px;
        }

        .related-music h5 {
            color: #f8c43a;
        }

        .volume-control {
            display: inline-block;
            position: relative;
        }

        #volume-icon {
            font-size: 24px;
            color: #f8f9fa;
            cursor: pointer;
        }

        #volume-control {
            position: absolute;
            left: 30px;
            /* Adjust this value to control the distance from the icon */
            top: 50%;
            /* Vertically center the slider */
            transform: translateY(-50%);
            /* Adjust to properly align with the icon */
            width: 0px;
            opacity: 0;
            pointer-events: none;
            /* Disable interaction when hidden */
            transition: all 0.3s ease-in-out;
        }

        .volume-control:hover #volume-control,
        #volume-control:hover {
            width: 120px;
            /* Adjust this to the desired width */
            opacity: 1;
            pointer-events: auto;
            /* Enable interaction when visible */
        }

        /* Style the progress bar */
        #progress-bar {
            -webkit-appearance: none;
            /* Remove default styling */
            appearance: none;
            height: 8px;
            /* Height of the track */
            border-radius: 5px;
            /* Round edges of the track */
            background: #555;
            /* Background color of the track */
            outline: none;
            /* Remove outline */
            transition: background 0.2s;
            /* Smooth transition */
        }

        /* Progress bar styles */
        #progress-bar {
            --thumb-position: 0;
            /* Default thumb position */
        }

        /* Style the thumb (the draggable part) */
        #progress-bar::-webkit-slider-thumb {
            /* keep opacity zero */
            opacity: 0;
            -webkit-appearance: none;
            /* Remove default thumb */
            appearance: none;
            width: 16px;
            /* Width of the thumb */
            height: 16px;
            /* Height of the thumb */
            border-radius: 50%;
            /* Make it round */
            background: #f8c43a;
            /* Color of the thumb */
            cursor: pointer;
            /* Change cursor on hover */
            transition: transform 0.2s ease;
            /* Smooth transition effect */
            transform: translateX(var(--thumb-position));
            /* Positioning the thumb */
        }

        /* For Firefox */
        #progress-bar::-moz-range-thumb {
            width: 16px;
            /* Width of the thumb */
            height: 16px;
            /* Height of the thumb */
            border-radius: 50%;
            /* Make it round */
            background: #f8c43a;
            /* Color of the thumb */
            cursor: pointer;
            /* Change cursor on hover */
            transition: transform 0.2s ease;
            /* Smooth transition effect */
            transform: translateX(var(--thumb-position));
            /* Positioning the thumb */
        }


        /* Progress fill effect */
        #progress-bar::-webkit-slider-runnable-track {
            background: linear-gradient(to right, #f8c43a 0%, #f8c43a var(--value), #555 var(--value), #555 100%);
        }

        #progress-bar::-moz-range-track {
            background: linear-gradient(to right, #f8c43a 0%, #f8c43a var(--value), #555 var(--value), #555 100%);
        }
    </style>
    <script>
        function showToast(message, isError = false) {
            const toast = document.getElementById(isError ? 'errorToast' : 'favToast');
            toast.textContent = message;

            // Remove the hidden class
            if (toast.classList.contains('hidden')) {
                toast.classList.remove('hidden');

            } else {
                console.log('Hidden class was not present.');
            }

            // Force display to block
            toast.style.display = 'block';

            // Trigger the animation by using a small timeout
            setTimeout(() => {
                toast.classList.remove('translate-y-[-100%]'); // Move toast into view
            }, 10); // Small timeout to allow the browser to register the DOM change

            // Hide the toast after 3 seconds
            setTimeout(() => {
                toast.classList.add('translate-y-[-100%]'); // Move toast out of view
                toast.style.display = 'none'; // Hide using inline style as a fallback

                // Check if the URL contains 'favourite.php'
                if (window.location.href.includes('favourite.php')) {
                    window.location.reload(); // Reload the page if the condition is met
                }
            }, 3000);

        }
        // Function to search artists 
        function addFavourite(addingURL, id) {
            event.preventDefault();
            console.log(addingURL);
            var favUrl = addingURL; // Check if inputElement is provided

            // Make AJAX request
            $.ajax({
                url: `${favUrl}`,
                type: 'GET',
                data: {
                    value: id
                },
                success: function(response) {
                    // Parse the JSON response
                    let result = JSON.parse(response);

                    if (result === true) {
                        showToast('Video Added Successfully');
                    } else if (result === false) {
                        showToast('Video Already Added', true);
                    } else {
                        showToast('Unexpected Error Occurred', true);
                    }
                },
                error: function() {
                    // Show error toast
                    showToast('Error adding video', true);
                }

            });
        }
    </script>
</head>

<body class="overflow-hidden">
        

    <!-- Success Toast -->
    <div id="favToast" class="toast bg-green-500 text-white p-4 rounded-lg hidden fixed right-5 top-20 z-50 transition-transform transform translate-y-[-100%]">
        Video Added Successfully
    </div>

    <!-- Error Toast -->
    <div id="errorToast" class="toast bg-red-500 text-white p-4 rounded-lg hidden fixed right-5 top-20 z-50 transition-transform transform translate-y-[-100%]">
        Error adding video
    </div>
    <div class="container mt-5">

        <?php

        if (isset($_GET['allSongs']) && $_GET['allSongs'] == 'true') {
        ?>
            <div class="row">
                <!-- Main Music Player Section -->
                <div class="col-lg-8">
                    <div class="music-player p-3 sticky-top" style="background-color: #2d2f33; z-index: 1000;">
                        <h2 class="text-center mb-5 fs-1 text-white" style="margin-bottom: 5rem;">Now Playing</h2>
                        <audio class="d-none mt-5" controls id="audio-player" style="opacity:0;">
                            <source src="<?= $playlist[0]['src'] ?>" type="audio/*"> <!-- Use PHP to get the source -->
                            Your browser does not support the audio element.
                        </audio>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <div>
                                    <span class="font-bold bold" style="color: #F8C43A;">Title:</span>
                                    <span id="song-title" class="h5 d-inline"> <?= $playlist[0]['title'] ?></span> <!-- Use PHP for song title -->
                                </div>
                                <div>
                                    <span class="font-bold bold" style="color: #F8C43A;">Artist:</span>
                                    <span id="song-artist" class="d-inline"><?= $playlist[0]['artist'] ?></span> <!-- Use PHP for artist name -->
                                </div>
                            </div>
                            <div>
                                <button id="prev" class="btn btn-secondary">Previous</button>
                                <button id="playPause" class="btn btn-primary"><i class="bi bi-play-fill"></i></button>
                                <button id="next" class="btn btn-secondary">Next</button>
                            </div>
                        </div>

                        <!-- Progress bar -->
                        <div class="d-flex justify-content-between gap-3">
                            <span id="current-time">--:--</span>
                            <input type="range" id="progress-bar" class="form-range" min="0" max="100" value="0">
                            <span id="duration-time">--:--</span>
                        </div>

                        <!-- Volume Control with Icon -->
                        <div class="volume-control position-relative">
                            <i class="bi bi-volume-up-fill" id="volume-icon" style="cursor: pointer;"></i>
                            <input type="range" id="volume-control" class="form-range" min="0" max="100" value="50">
                        </div>

                        <!-- Shuffle and Repeat -->
                        <div class="mt-3">
                            <button id="shuffle" class="btn btn-warning">Shuffle</button>
                            <button id="repeat" class="btn btn-warning">Repeat</button>
                        </div>
                    </div>

                </div>

                <!-- Related Music and Advertisement Section -->
                <div class="col-lg-4">
                    <!-- Related Music -->
                    <?php  ?>
                    <div class="related-music">
                        <h5>Related Music</h5>
                        <?php foreach ($playlist as $song):
                            if ($song['songId']  == $songId) {
                                continue;
                            }
                        ?>
                            <div class="position-relative music-item d-flex flex-column mb-3" <?php if ($song['songId']  == $songId) {
                                                                                                    echo 'style:display:none;';
                                                                                                }; ?>>
                                <a href="musicsss.php?allSongs=true&song_id=<?php echo $song['songId']; ?>&title=<?php echo urlencode($song['title']); ?>&artist=<?php echo urlencode($song['artist']); ?>" class="text-decoration-none">
                                    <!-- Image -->
                                    <img src="<?= $song['image'] ?>" alt="Music Cover" class="img-fluid me-2 rounded-4" width="200" height="150" style="object-fit: cover;">

                                    <!-- Play Icon -->
                                    <div class="play-icon position-absolute top-50 start-50 translate-middle" style="pointer-events: none;">
                                        <i class="fa fa-music text-white" style="font-size: 40px; color: white;"></i>
                                    </div>
                                </a>
                            </div>

                            <!-- Song Details -->
                            <div>
                                <!-- <h5 class="text-white"><span class="font-bold bold" style="color: #F8C43A;">Title: </span></h5> -->
                                <div class="audio_name d-flex align-items-center justify-content-between mb-3">
                                    <h3 class="text-center text-white"><?= $song['title'] ?></h3>
                                    <a type="submit" onclick="addFavourite('favourite.php?music_id=<?php echo $song['songId'] ?>', '<?php echo $song['songId'] ?>');" class="btn btn-warning px-5 mb-2 pt-1 pb-0">
                                        <i class="fa fa-heart text-center text-danger"></i>
                                    </a>
                                </div>
                                <p><span class="font-bold bold" style="color: #F8C43A;">Artist: </span><a href="functions.php?artist=<?php echo urlencode($song['artist']); ?>"><?= $song['artist'] ?></a></p>

                            </div>

                        <?php
                        endforeach; ?>
                    </div>

                    <!-- Advertisement Section -->
                    <div class="advertisement mt-4 d-none">
                        <h5>Advertisement</h5>
                        <?php if (!empty($banners)): ?>
                            <img src="<?= $banners[0] ?>" alt="Banner Ad" class="img-fluid"> <!-- Display the first banner -->
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php
        } else {
        ?>
            <div class="row">
                <!-- Main Music Player Section -->
                <div class="col-lg-8">
                    <div class="music-player p-3 sticky-top" style="background-color: #2d2f33; z-index: 1000;">
                        <h2 class="text-center mb-5" style="margin-bottom: 5rem;">Now Playing</h2>
                        <audio class="d-none mt-5" controls id="audio-player" style="opacity:0;">
                            <source src="<?= $playlist[0]['src'] ?>" type="audio/*"> <!-- Use PHP to get the source -->
                            Your browser does not support the audio element.
                        </audio>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <div>
                                    <span class="font-bold bold" style="color: #F8C43A;">Title:</span>
                                    <span id="song-title" class="h5 d-inline"> <?= $playlist[0]['title'] ?></span> <!-- Use PHP for song title -->
                                </div>
                                <div>
                                    <span class="font-bold bold" style="color: #F8C43A;">Artist:</span>
                                    <span id="song-artist" class="d-inline"><?= $playlist[0]['artist'] ?></span> <!-- Use PHP for artist name -->
                                </div>
                            </div>
                            <div>
                                <button id="prev" class="btn btn-secondary">Previous</button>
                                <button id="playPause" class="btn btn-primary"><i class="bi bi-play-fill"></i></button>
                                <button id="next" class="btn btn-secondary">Next</button>
                            </div>
                        </div>

                        <!-- Progress bar -->
                        <div class="d-flex justify-content-between gap-3">
                            <span id="current-time">--:--</span>
                            <input type="range" id="progress-bar" class="form-range" min="0" max="100" value="0">
                            <span id="duration-time">--:--</span>
                        </div>

                        <!-- Volume Control with Icon -->
                        <div class="volume-control position-relative">
                            <i class="bi bi-volume-up-fill" id="volume-icon" style="cursor: pointer;"></i>
                            <input type="range" id="volume-control" class="form-range" min="0" max="100" value="50">
                        </div>

                        <!-- Shuffle and Repeat -->
                        <div class="mt-3">
                            <button id="shuffle" class="btn btn-warning">Shuffle</button>
                            <button id="repeat" class="btn btn-warning">Repeat</button>
                        </div>
                    </div>

                </div>

                <!-- Related Music and Advertisement Section -->
                <div class="col-lg-4">
                    <!-- Related Music -->
                    <?php  ?>
                    <div class="related-music">
                        <h5>Related Music</h5>
                        <?php foreach ($playlist as $song):
                            if ($song['songId']  == $songId) {
                                continue;
                            }
                        ?>
                            <div class="position-relative music-item d-flex flex-column mb-3" <?php if ($song['songId']  == $songId) {
                                                                                                    echo 'style:display:none;';
                                                                                                }; ?>>
                                <a href="musicsss.php?song_id=<?php echo $song['songId']; ?>&title=<?php echo urlencode($song['title']); ?>&artist=<?php echo urlencode($song['artist']); ?>" class="text-decoration-none">
                                    <!-- Image -->
                                    <img src="<?= $song['image'] ?>" alt="Music Cover" class="img-fluid me-2 rounded-4" width="200" height="150" style="object-fit: cover;">

                                    <!-- Play Icon -->
                                    <div class="play-icon position-absolute top-50 start-50 translate-middle" style="pointer-events: none;">
                                        <i class="fa fa-music text-white" style="font-size: 40px; color: white;"></i>
                                    </div>
                                </a>
                            </div>

                            <!-- Song Details -->
                            <div>
                                <!-- <h5 class="text-white"><span class="font-bold bold" style="color: #F8C43A;">Title: </span></h5> -->
                                <div class="audio_name d-flex align-items-center justify-content-between mb-3">
                                    <h3 class="text-center text-white"><?= $song['title'] ?></h3>
                                    <a type="submit" onclick="addFavourite('favourite.php?music_id=<?php echo $song['songId'] ?>', '<?php echo $song['songId'] ?>');" class="btn btn-warning px-5 mb-2 pt-1 pb-0">
                                        <i class="fa fa-heart text-center text-danger"></i>
                                    </a>
                                </div>
                                <p><span class="font-bold bold" style="color: #F8C43A;">Artist: </span><a href="functions.php?artist=<?php echo urlencode($song['artist']); ?>"><?= $song['artist'] ?></a></p>

                            </div>

                        <?php
                        endforeach; ?>
                    </div>

                    <!-- Advertisement Section -->
                    <div class="advertisement mt-4 d-none">
                        <h5>Advertisement</h5>
                        <?php if (!empty($banners)): ?>
                            <img src="<?= $banners[0] ?>" alt="Banner Ad" class="img-fluid"> <!-- Display the first banner -->
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Music Player Variables
        const audio = document.querySelector('audio');
        const playPauseBtn = document.getElementById('playPause');
        const nextBtn = document.getElementById('next');
        const prevBtn = document.getElementById('prev');
        const progressBar = document.getElementById('progress-bar');
        const currentTimeLabel = document.getElementById('current-time');
        const durationTimeLabel = document.getElementById('duration-time');
        const volumeControl = document.getElementById('volume-control');
        const shuffleBtn = document.getElementById('shuffle');
        const repeatBtn = document.getElementById('repeat');


        // Playlist data from PHP   
        let playlist = <?= json_encode($playlist) ?>; // Encode PHP array as JSON for JavaScript

        let currentIndex = 0;
        let isPlaying = false;
        let isShuffle = false;
        let isRepeat = false;

        // Load current song
        // Load current song
        // Load current song
        function loadSong(index) {
            audio.src = playlist[index].src;
            document.getElementById('song-title').textContent = playlist[index].title;
            document.getElementById('song-artist').textContent = playlist[index].artist;
            updateProgress();

            audio.play().then(() => {
                // Unmute after loading
                audio.muted = false;
                playPause();
            }).catch(error => {
                console.error("Error playing audio:", error);
            });
            // Wait until the song's metadata is loaded to update the duration
            audio.addEventListener('loadedmetadata', () => {
                durationTimeLabel.textContent = formatTime(audio.duration);
            });
        }




        // Play or Pause Music
        function playPause() {
            if (isPlaying) {
                audio.pause();
                playPauseBtn.innerHTML = '<i class="bi bi-play-fill"></i>'; // Bootstrap icon for play
            } else {
                audio.play();
                playPauseBtn.innerHTML = '<i class="bi bi-pause-fill"></i>'; // Bootstrap icon for pause
            }
            isPlaying = !isPlaying;
        }

        // Play Next Song
        function nextSong() {
            currentIndex = isShuffle ? Math.floor(Math.random() * playlist.length) : (currentIndex + 1) % playlist.length;
            loadSong(currentIndex);
            if (isPlaying) audio.play();
        }

        // Play Previous Song
        function prevSong() {
            currentIndex = (currentIndex - 1 + playlist.length) % playlist.length;
            loadSong(currentIndex);
            if (isPlaying) audio.play();
        }

        function updateProgress() {
            audio.addEventListener('timeupdate', function() {
                const progressPercent = (audio.currentTime / audio.duration) * 100;
                progressBar.value = progressPercent;

                // Update the CSS variable for the gradient effect
                progressBar.style.setProperty('--value', `${progressPercent}%`);

                // Update the thumb position for smooth animation
                const thumbPosition = (progressPercent / 100) * (progressBar.offsetWidth - 16); // Adjust based on thumb width
                progressBar.style.setProperty('--thumb-position', `${thumbPosition}px`);

                // Update time labels
                currentTimeLabel.textContent = formatTime(audio.currentTime);
                durationTimeLabel.textContent = formatTime(audio.duration);
            });

            // Seek music on progress bar click
            progressBar.addEventListener('input', function() {
                const seekTime = (progressBar.value / 100) * audio.duration;
                audio.currentTime = seekTime;
            });
        }


        // Update Progress Bar
        // function updateProgress() {
        //     audio.addEventListener('timeupdate', function() {
        //         const progressPercent = (audio.currentTime / audio.duration) * 100;
        //         progressBar.value = progressPercent;

        //         // Update time labels
        //         currentTimeLabel.textContent = formatTime(audio.currentTime);
        //         durationTimeLabel.textContent = formatTime(audio.duration);
        //     });

        //     // Seek music on progress bar click
        //     progressBar.addEventListener('input', function() {
        //         const seekTime = (progressBar.value / 100) * audio.duration;
        //         audio.currentTime = seekTime;
        //     });
        // }

        // Format Time (mm:ss)

        audio.volume = 0.2;
        volumeControl.value = 20;

        function formatTime(time) {
            const minutes = Math.floor(time / 60);
            const seconds = Math.floor(time % 60);
            return `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
        }
        // Save the current song's index and playback time in localStorage
        function savePlaybackState() {
            localStorage.setItem('currentSongIndex', currentIndex);
            localStorage.setItem('currentTime', audio.currentTime);
        }

        // Load playback state from localStorage
        function loadPlaybackState() {
            const savedIndex = localStorage.getItem('currentSongIndex');
            const savedTime = localStorage.getItem('currentTime');

            if (savedIndex !== null && savedTime !== null) {
                currentIndex = parseInt(savedIndex);
                loadSong(currentIndex);
                audio.currentTime = parseFloat(savedTime);
            } else {
                loadSong(currentIndex, true); // Load the first song and play it
            }
        }
        audio.addEventListener('timeupdate', () => {
            const progressPercent = (audio.currentTime / audio.duration) * 100;
            progressBar.value = progressPercent;

            // Update current time label
            currentTimeLabel.textContent = formatTime(audio.currentTime);

            // Save current state
            savePlaybackState();
        });


        // Initialize the music player and load the saved state
        window.addEventListener('DOMContentLoaded', loadPlaybackState);

        // Handle page unload event to save the playback state
        window.addEventListener('beforeunload', savePlaybackState);

        // Volume Control Logic
        volumeControl.addEventListener('input', function() {
            audio.volume = volumeControl.value / 100;
        });

        // Show Volume Control on Hover
        const volumeIcon = document.getElementById('volume-icon'); // Ensure you have this ID in your HTML

        volumeIcon.addEventListener('mouseenter', function() {
            volumeControl.style.width = '120px'; // Show the volume control
            volumeControl.style.opacity = '1'; // Make it fully visible
            volumeControl.style.pointerEvents = 'auto'; // Allow interaction
            clearTimeout(volumeTimeout); // Clear any existing timeout
        });

        // Hide Volume Control after Delay
        volumeIcon.addEventListener('mouseleave', function() {
            volumeTimeout = setTimeout(function() {
                volumeControl.style.width = '0px'; // Hide the volume control
                volumeControl.style.opacity = '0'; // Make it invisible
                volumeControl.style.pointerEvents = 'none'; // Disable interaction
            }, 1000); // Set the delay to 1000 milliseconds (1 second)
        });

        // Prevent the volume control from disappearing when hovering over it
        volumeControl.addEventListener('mouseenter', function() {
            clearTimeout(volumeTimeout); // Clear timeout if hovering over volume control
        });

        volumeControl.addEventListener('mouseleave', function() {
            volumeTimeout = setTimeout(function() {
                volumeControl.style.width = '0px'; // Hide the volume control
                volumeControl.style.opacity = '0'; // Make it invisible
                volumeControl.style.pointerEvents = 'none'; // Disable interaction
            }, 1000); // Delay before hiding again
        });

        // Shuffle Toggle
        shuffleBtn.addEventListener('click', function() {
            isShuffle = !isShuffle;
            shuffleBtn.classList.toggle('active');
        });

        // Repeat Toggle
        repeatBtn.addEventListener('click', function() {
            isRepeat = !isRepeat;
            repeatBtn.classList.toggle('active');
        });

        // Initial Load
        loadSong(currentIndex);

        // Event Listeners
        playPauseBtn.addEventListener('click', playPause);
        nextBtn.addEventListener('click', nextSong);
        prevBtn.addEventListener('click', prevSong);
        audio.addEventListener('ended', () => {
            if (isRepeat) {
                loadSong(currentIndex);
                audio.play();
            } else {
                nextSong();
            }
        });

        // Volume Control
        volumeControl.addEventListener('input', (e) => {
            audio.volume = e.target.value / 100;
        });

        // Load Initial Song
        loadSong(currentIndex);
    </script>
</body>

</html>