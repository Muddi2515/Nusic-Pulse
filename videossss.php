<?php
require_once "connection.php";

?>

<?php
// music.php


// Fetch banner images from the database
// $banner_sql = "SELECT * FROM video_table"; // Adjust the SQL query based on your banners table
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
    $music_sql = "SELECT * FROM video_table"; // Adjust the SQL query based on your music table
    $music_result = $con->query($music_sql);

    $playlist = []; // Initialize playlist

    // Add the clicked song first, if available
    if ($songId) {
        $clicked_song_sql = "SELECT * FROM video_table WHERE video_id = '$songId'"; // Fetch clicked song details
        $clicked_song_result = $con->query($clicked_song_sql);

        if ($clicked_song_result->num_rows > 0) {
            $clicked_song = $clicked_song_result->fetch_assoc();
            $playlist[] = [
                'songId' => $clicked_song['video_id'],
                'title' => $clicked_song['title'],
                'artist' => $clicked_song['artist'],
                'src' => str_replace('../', './', $clicked_song['video_path']),
                'image' => str_replace('../', './', $clicked_song['cover_image_path']),
            ];
        }
    }

    // Fetch all songs except the clicked song (if it exists)
    if ($music_result->num_rows > 0) {
        while ($row = $music_result->fetch_assoc()) {
            if ($row['video_id'] == $songId) {
                continue; // Skip the clicked song if it's already added
            }
            $playlist[] = [
                'songId' => $row['video_id'],
                'title' => $row['title'],
                'artist' => $row['artist'],
                'src' => str_replace('../', './', $row['video_path']),
                'image' => str_replace('../', './', $row['cover_image_path']),
            ];
        }
    }
    // for genre based videos
}else if(isset($_GET['genre']) && $_GET['genretype'] == 'true') {

    $genreToFetch = $_GET['genre'];
    // Fetch all songs
    $music_sql = "SELECT * FROM video_table where genre = '$genreToFetch'"; // Adjust the SQL query based on your music table
    $music_result = $con->query($music_sql);

    $playlist = []; // Initialize playlist

    // Add the clicked song first, if available
    if ($songId) {
        $clicked_song_sql = "SELECT * FROM video_table WHERE video_id = '$songId'"; // Fetch clicked song details
        $clicked_song_result = $con->query($clicked_song_sql);

        if ($clicked_song_result->num_rows > 0) {
            $clicked_song = $clicked_song_result->fetch_assoc();
            $playlist[] = [
                'songId' => $clicked_song['video_id'],
                'title' => $clicked_song['title'],
                'artist' => $clicked_song['artist'],
                'src' => str_replace('../', './', $clicked_song['video_path']),
                'image' => str_replace('../', './', $clicked_song['cover_image_path']),
            ];
        }
    }

    // Fetch all songs except the clicked song (if it exists)
    if ($music_result->num_rows > 0) {
        while ($row = $music_result->fetch_assoc()) {
            if ($row['video_id'] == $songId) {
                continue; // Skip the clicked song if it's already added
            }
            $playlist[] = [
                'songId' => $row['video_id'],
                'title' => $row['title'],
                'artist' => $row['artist'],
                'src' => str_replace('../', './', $row['video_path']),
                'image' => str_replace('../', './', $row['cover_image_path']),
            ];
        }
    }
}else if(isset($_GET['latest']) && $_GET['latest'] == 'true') {

    // Fetch all songs
    $music_sql = "SELECT * FROM video_table ORDER BY release_date DESC LIMIT 5"; // Adjust the SQL query based on your music table
    $music_result = $con->query($music_sql);

    $playlist = []; // Initialize playlist

    // Add the clicked song first, if available
    if ($songId) {
        $clicked_song_sql = "SELECT * FROM video_table WHERE video_id = '$songId'"; // Fetch clicked song details
        $clicked_song_result = $con->query($clicked_song_sql);

        if ($clicked_song_result->num_rows > 0) {
            $clicked_song = $clicked_song_result->fetch_assoc();
            $playlist[] = [
                'songId' => $clicked_song['video_id'],
                'title' => $clicked_song['title'],
                'artist' => $clicked_song['artist'],
                'src' => str_replace('../', './', $clicked_song['video_path']),
                'image' => str_replace('../', './', $clicked_song['cover_image_path']),
            ];
        }
    }

    // Fetch all songs except the clicked song (if it exists)
    if ($music_result->num_rows > 0) {
        while ($row = $music_result->fetch_assoc()) {
            if ($row['video_id'] == $songId) {
                continue; // Skip the clicked song if it's already added
            }
            $playlist[] = [
                'songId' => $row['video_id'],
                'title' => $row['title'],
                'artist' => $row['artist'],
                'src' => str_replace('../', './', $row['video_path']),
                'image' => str_replace('../', './', $row['cover_image_path']),
            ];
        }
    }
}
else {

    // Fetch music data (example)
    $music_sql = "SELECT * FROM video_table where artist like '%$artist%' "; // Adjust the SQL query based on your music table
    $music_result = $con->query($music_sql);


    // for related music
    $related_music_sql = "SELECT * FROM video_table where artist like '%$artist%' and video_id = '$songId'"; // Adjust the SQL query based on your music table
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
                'songId' => $row['video_id'],
                'title' => $row['title'], // Adjust the column name
                'artist' => $row['artist'], // Adjust the column name
                'src' => str_replace('../', './', $row['video_path']), // Adjust the column name
                'image' => str_replace('../', './', $row['cover_image_path']), // Adjust the column name
            ];
        }
    }

    // for realted music
    if ($music_result->num_rows > 0) {
        while ($row = $music_result->fetch_assoc()) {

            if ($row['video_id']  == $songId) {
                continue;
            }
            $playlist[] = [
                'songId' => $row['video_id'],
                'title' => $row['title'], // Adjust the column name
                'artist' => $row['artist'], // Adjust the column name
                'src' => str_replace('../', './', $row['video_path']), // Adjust the column name
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Sound Music Player</title>
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
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.2/font/bootstrap-icons.min.css">

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

</head>

<body>
    <div class="container mt-5">

        <?php

        if (isset($_GET['allSongs']) && $_GET['allSongs'] == 'true') {

        ?>
            <div class="row">
                <!-- Main Video Player Section -->
                <div class="col-lg-8">
                    <div class="music-player p-3" style="background-color: #2d2f33; z-index: 1000;">
                        <h2 class="text-center mb-3" style="margin-bottom: 5rem;">Now Playing</h2>
                        <hr>
                        <video class="w-100 rounded-4" controls id="audio-player">
                            <source src="<?= $playlist[0]['src'] ?>" type="video/mp4"> <!-- Specify video type -->
                            Your browser does not support the video element.
                        </video>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="col-4">
                                <div>
                                    <span class="font-bold bold" style="color: #F8C43A;">Title:</span>
                                    <span id="song-title" class="h5 d-inline"> <?= $playlist[0]['title'] ?></span> <!-- Use PHP for song title -->
                                </div>
                                <div>
                                    <span class="font-bold bold" style="color: #F8C43A;">Artist:</span>
                                    <span id="song-artist" class="d-inline"><?= $playlist[0]['artist'] ?></span> <!-- Use PHP for artist name -->
                                </div>
                            </div>
                            <div class="col-8">
                                <button id="prev" class="btn btn-secondary">Previous</button>
                                <button id="playPause" class="btn btn-primary"><i class="bi bi-play-fill"></i></button>
                                <button id="next" class="btn btn-secondary">Next</button>
                            </div>
                        </div>

                        <!-- Progress bar  should be d-none in video-->
                        <div class="d-flex justify-content-between gap-3 d-none">
                            <span id="current-time">--:--</span>
                            <input type="range" id="progress-bar" class="form-range" min="0" max="100" value="0">
                            <span id="duration-time">--:--</span>
                        </div>

                        <!-- Volume Control with Icon should be d-none in video-->
                        <div class="volume-control position-relative d-none">
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

                <!-- Related Videos and Advertisement Section -->
                <div class="col-lg-4">
                    <!-- Related Videos -->
                    <div class="related-music">
                        <h5>Related Videos</h5>
                        <?php foreach ($playlist as $song):
                            if ($song['songId'] == $songId) {
                                continue;
                            }
                        ?>
                            <div class="position-relative music-item d-flex flex-column mb-3">
                                <a href="videossss.php?allSongs=true&song_id=<?php echo $song['songId']; ?>&title=<?php echo urlencode($song['title']); ?>&artist=<?php echo urlencode($song['artist']); ?>" class="text-decoration-none">
                                    <!-- Image -->
                                    <img src="<?= $song['image'] ?>" alt="Video Cover" class="img-fluid me-2 rounded-4" width="200" height="150" style="object-fit: cover;">
                                    <!-- Play Icon -->
                                    <div class="play-icon position-absolute top-50 start-50 translate-middle" style="pointer-events: none;">
                                        <i class="fa fa-play-circle text-white" style="font-size: 40px; color: white;"></i>
                                    </div>
                                </a>
                            </div>

                            <!-- Video Details -->
                            <div>
                                <h5 class="text-white my-0"><span class="font-bold bold" style="color: #F8C43A;">Title: </span><?= $song['title'] ?></h5>
                                <p><span class="font-bold bold my-0" style="color: #F8C43A;">Artist: </span><a href="functions.php?artist=<?php echo urlencode($song['artist']); ?>"><?= $song['artist'] ?></a></p>
                            </div>
                        <?php endforeach; ?>
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
                <!-- Main Video Player Section -->
                <div class="col-lg-8">
                    <div class="music-player p-3" style="background-color: #2d2f33; z-index: 1000;">
                        <h2 class="text-center mb-3" style="margin-bottom: 5rem;">Now Playing</h2>
                        <hr>
                        <video class="w-100 rounded-4" controls id="audio-player">
                            <source src="<?= $playlist[0]['src'] ?>" type="video/mp4"> <!-- Specify video type -->
                            Your browser does not support the video element.
                        </video>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="col-4">
                                <div>
                                    <span class="font-bold bold" style="color: #F8C43A;">Title:</span>
                                    <span id="song-title" class="h5 d-inline"> <?= $playlist[0]['title'] ?></span> <!-- Use PHP for song title -->
                                </div>
                                <div>
                                    <span class="font-bold bold" style="color: #F8C43A;">Artist:</span>
                                    <span id="song-artist" class="d-inline"><?= $playlist[0]['artist'] ?></span> <!-- Use PHP for artist name -->
                                </div>
                            </div>
                            <div class="col-8">
                                <button id="prev" class="btn btn-secondary">Previous</button>
                                <button id="playPause" class="btn btn-primary"><i class="bi bi-play-fill"></i></button>
                                <button id="next" class="btn btn-secondary">Next</button>
                            </div>
                        </div>

                        <!-- Progress bar  should be d-none in video-->
                        <div class="d-flex justify-content-between gap-3 d-none">
                            <span id="current-time">--:--</span>
                            <input type="range" id="progress-bar" class="form-range" min="0" max="100" value="0">
                            <span id="duration-time">--:--</span>
                        </div>

                        <!-- Volume Control with Icon should be d-none in video-->
                        <div class="volume-control position-relative d-none">
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

                <!-- Related Videos and Advertisement Section -->
                <div class="col-lg-4">
                    <!-- Related Videos -->
                    <div class="related-music">
                        <h5>Related Videos</h5>
                        <?php foreach ($playlist as $song):
                            if ($song['songId'] == $songId) {
                                continue;
                            }
                        ?>
                            <div class="position-relative music-item d-flex flex-column mb-3">
                                <a href="videossss.php?song_id=<?php echo $song['songId']; ?>&title=<?php echo urlencode($song['title']); ?>&artist=<?php echo urlencode($song['artist']); ?>" class="text-decoration-none">
                                    <!-- Image -->
                                    <img src="<?= $song['image'] ?>" alt="Video Cover" class="img-fluid me-2 rounded-4" width="200" height="150" style="object-fit: cover;">
                                    <!-- Play Icon -->
                                    <div class="play-icon position-absolute top-50 start-50 translate-middle" style="pointer-events: none;">
                                        <i class="fa fa-play-circle text-white" style="font-size: 40px; color: white;"></i>
                                    </div>
                                </a>
                            </div>

                            <!-- Video Details -->
                            <div>
                                <h5 class="text-white my-0"><span class="font-bold bold" style="color: #F8C43A;">Title: </span><?= $song['title'] ?></h5>
                                <p><span class="font-bold bold my-0" style="color: #F8C43A;">Artist: </span><a href="functions.php?artist=<?php echo urlencode($song['artist']); ?>"><?= $song['artist'] ?></a></p>
                            </div>
                        <?php endforeach; ?>
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
        // Video Player Variables
        const video = document.getElementById('audio-player');
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

        // Load current video
        function loadVideo(index) {
            video.src = playlist[index].src;
            document.getElementById('song-title').textContent = playlist[index].title;
            document.getElementById('song-artist').textContent = playlist[index].artist;

            // Wait until the video's metadata is loaded to update the duration
            video.addEventListener('loadedmetadata', () => {
                durationTimeLabel.textContent = formatTime(video.duration);
                updateProgress(); // Update progress immediately after loading metadata
            });

            // Play video
            video.play().then(() => {
                // Unmute after loading
                video.muted = false;
                playPause();
            }).catch(error => {
                console.error("Error playing video:", error);
            });
        }

        // Play or Pause Video
        function playPause() {
            if (isPlaying) {
                video.pause();
                playPauseBtn.innerHTML = '<i class="bi bi-play-fill"></i>'; // Bootstrap icon for play
            } else {
                video.play();
                playPauseBtn.innerHTML = '<i class="bi bi-pause-fill"></i>'; // Bootstrap icon for pause
            }
            isPlaying = !isPlaying;
        }

        // Play Next Video
        function nextVideo() {
            currentIndex = isShuffle ? Math.floor(Math.random() * playlist.length) : (currentIndex + 1) % playlist.length;
            loadVideo(currentIndex);
            if (isPlaying) video.play();
        }

        // Play Previous Video
        function prevVideo() {
            currentIndex = (currentIndex - 1 + playlist.length) % playlist.length;
            loadVideo(currentIndex);
            if (isPlaying) video.play();
        }

        function updateProgress() {
            video.addEventListener('timeupdate', function() {
                const progressPercent = (video.currentTime / video.duration) * 100;
                progressBar.value = progressPercent;

                // Update time labels
                currentTimeLabel.textContent = formatTime(video.currentTime);
                durationTimeLabel.textContent = formatTime(video.duration);
            });

            // Seek video on progress bar click
            progressBar.addEventListener('input', function() {
                const seekTime = (progressBar.value / 100) * video.duration;
                video.currentTime = seekTime;
            });
        }

        // Format Time (mm:ss)
        function formatTime(time) {
            const minutes = Math.floor(time / 60);
            const seconds = Math.floor(time % 60);
            return `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
        }

        // Initialize the video player and load the saved state
        window.addEventListener('DOMContentLoaded', () => {
            loadVideo(currentIndex); // Load initial video
            loadPlaybackState(); // Load saved state
        });

        // Event Listeners
        playPauseBtn.addEventListener('click', playPause);
        nextBtn.addEventListener('click', nextVideo);
        prevBtn.addEventListener('click', prevVideo);

        // Repeat & Shuffle Functionality
        video.addEventListener('ended', () => {
            if (isRepeat) {
                loadVideo(currentIndex);
                video.play();
            } else {
                nextVideo();
            }
        });

        // Volume Control Logic
        volumeControl.addEventListener('input', function() {
            video.volume = volumeControl.value / 100;
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
    </script>

</body>

</html>