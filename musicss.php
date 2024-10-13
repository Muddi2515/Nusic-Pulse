<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Sound Music Player</title>
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
    left: 30px; /* Adjust this value to control the distance from the icon */
    top: 50%; /* Vertically center the slider */
    transform: translateY(-50%); /* Adjust to properly align with the icon */
    width: 0px;
    opacity: 0;
    pointer-events: none; /* Disable interaction when hidden */
    transition: all 0.3s ease-in-out;
}

.volume-control:hover #volume-control,
#volume-control:hover {
    width: 120px; /* Adjust this to the desired width */
    opacity: 1;
    pointer-events: auto; /* Enable interaction when visible */
}


    </style>

    
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <!-- Main Music Player Section -->
            <div class="col-lg-8">
                <div class="music-player p-3">
                    <h2 class="text-center mb-4">Now Playing</h2>
                    <audio controls id="audio-player">
                        <source src="./audio/sinf-e-ahan.mp3" type="audio/mp3">
                        Your browser does not support the audio element.
                    </audio>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h4 id="song-title">Song Title</h4>
                            <p id="song-artist">Artist Name</p>
                        </div>
                        <div>
                            <button id="prev" class="btn btn-secondary">Previous</button>
                            <button id="playPause" class="btn btn-primary"><i class="bi bi-play-fill"></i></button>
                            <button id="next" class="btn btn-secondary">Next</button>
                        </div>
                    </div>

                    <!-- Progress bar -->
                    <input type="range" id="progress-bar" class="form-range" min="0" max="100" value="0">
                    <div class="d-flex justify-content-between">
                        <span id="current-time">0:00</span>
                        <span id="duration-time">0:00</span>
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
                <div class="related-music">
                    <h5>Related Music</h5>
                    <div class="music-item d-flex flex-column mb-3">
                        <img src="./audio/sinf-e-ahan.jpg" alt="Music Cover" class="img-fluid me-2" width="80">
                        <div>
                            <h6>Sinf e Ahan</h6>
                            <p>Asim Azhar</p>
                        </div>
                    </div>
                    <div class="music-item d-flex mb-3">
                        <img src="album-cover2.jpg" alt="Music Cover" class="img-fluid me-2" width="80">
                        <div>
                            <h6>Related Song 2</h6>
                            <p>Artist 2</p>
                        </div>
                    </div>
                    <div class="music-item d-flex">
                        <img src="album-cover3.jpg" alt="Music Cover" class="img-fluid me-2" width="80">
                        <div>
                            <h6>Related Song 3</h6>
                            <p>Artist 3</p>
                        </div>
                    </div>
                </div>

                <!-- Advertisement Section -->
                <div class="advertisement mt-4">
                    <h5>Advertisement</h5>
                    <img src="banner-ad.jpg" alt="Banner Ad" class="img-fluid">
                </div>
            </div>
        </div>
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
        
        // Playlist (You can dynamically generate this from your server)
        let playlist = [
            { title: "Song 1", artist: "Artist 1", src: "./audio/sinf-e-ahan.mp3" },
            { title: "Song 2", artist: "Artist 2", src: "song2.mp3" },
            { title: "Song 3", artist: "Artist 3", src: "song3.mp3" }
        ];

        let currentIndex = 0;
        let isPlaying = false;
        let isShuffle = false;
        let isRepeat = false;

        let volumeTimeout; // Variable to hold the timeout for volume control visibility

        // Load current song
        function loadSong(index) {
            audio.src = playlist[index].src;
            document.getElementById('song-title').textContent = playlist[index].title;
            document.getElementById('song-artist').textContent = playlist[index].artist;
            updateProgress();
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

        // Next Song
        function nextSong() {
            if (isShuffle) {
                currentIndex = Math.floor(Math.random() * playlist.length);
            } else {
                currentIndex = (currentIndex + 1) % playlist.length;
            }
            loadSong(currentIndex);
            audio.play();
        }

        // Previous Song
        function prevSong() {
            currentIndex = (currentIndex - 1 + playlist.length) % playlist.length;
            loadSong(currentIndex);
            audio.play();
        }

        // Update Progress Bar
        function updateProgress() {
            audio.addEventListener('timeupdate', function () {
                const progressPercent = (audio.currentTime / audio.duration) * 100;
                progressBar.value = progressPercent;

                // Update time labels
                currentTimeLabel.textContent = formatTime(audio.currentTime);
                durationTimeLabel.textContent = formatTime(audio.duration);
            });

            // Seek music on progress bar click
            progressBar.addEventListener('input', function () {
                const seekTime = (progressBar.value / 100) * audio.duration;
                audio.currentTime = seekTime;
            });
        }

        // Format Time (mm:ss)
        function formatTime(time) {
            const minutes = Math.floor(time / 60);
            const seconds = Math.floor(time % 60);
            return `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
        }

        // Volume Control Logic
        volumeControl.addEventListener('input', function () {
            audio.volume = volumeControl.value / 100;
        });

        // Show Volume Control on Hover
        const volumeIcon = document.getElementById('volume-icon'); // Ensure you have this ID in your HTML

        volumeIcon.addEventListener('mouseenter', function () {
            volumeControl.style.width = '120px'; // Show the volume control
            volumeControl.style.opacity = '1'; // Make it fully visible
            volumeControl.style.pointerEvents = 'auto'; // Allow interaction
            clearTimeout(volumeTimeout); // Clear any existing timeout
        });

        // Hide Volume Control after Delay
        volumeIcon.addEventListener('mouseleave', function () {
            volumeTimeout = setTimeout(function () {
                volumeControl.style.width = '0px'; // Hide the volume control
                volumeControl.style.opacity = '0'; // Make it invisible
                volumeControl.style.pointerEvents = 'none'; // Disable interaction
            }, 1000); // Set the delay to 1000 milliseconds (1 second)
        });

        // Prevent the volume control from disappearing when hovering over it
        volumeControl.addEventListener('mouseenter', function () {
            clearTimeout(volumeTimeout); // Clear timeout if hovering over volume control
        });

        volumeControl.addEventListener('mouseleave', function () {
            volumeTimeout = setTimeout(function () {
                volumeControl.style.width = '0px'; // Hide the volume control
                volumeControl.style.opacity = '0'; // Make it invisible
                volumeControl.style.pointerEvents = 'none'; // Disable interaction
            }, 1000); // Delay before hiding again
        });

        // Shuffle Toggle
        shuffleBtn.addEventListener('click', function () {
            isShuffle = !isShuffle;
            shuffleBtn.classList.toggle('active');
        });

        // Repeat Toggle
        repeatBtn.addEventListener('click', function () {
            isRepeat = !isRepeat;
            repeatBtn.classList.toggle('active');
        });

        // Auto play next song when the current one ends
        audio.addEventListener('ended', function () {
            if (isRepeat) {
                audio.play();  // Repeat the same song
            } else {
                nextSong();
            }
        });

        // Initial Load
        loadSong(currentIndex);

        // Event Listeners
        playPauseBtn.addEventListener('click', playPause);
        nextBtn.addEventListener('click', nextSong);
        prevBtn.addEventListener('click', prevSong);
    </script>


</body>

</html>