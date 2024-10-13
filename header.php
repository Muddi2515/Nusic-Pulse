<?php
require_once "connection.php";
if (isset($_SESSION['Name'])) {
    $name = $_SESSION['Name'];
    $image = $_SESSION['user_img'];
} else {
    header("location: login.php");
}


?>
<!doctype html>
<html class="no-js" lang="zxx">

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
        .display-3 {}

        .highlight {
            background-color: greenyellow;
            color: black;
            font-weight: bold;
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

        function showRemoveToast(message, isError = false) {
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
                toast.style.display = 'none';

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

        function removeFavourite(removingURL, id, cardId) {
            var favUrl = removingURL; // Check if inputElement is provided

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
                        showRemoveToast('Video Removed Successfully');
                        const card = document.getElementById(cardId);
                        if (card) {
                            card.remove();
                        }
                    } else if (result === false) {
                        showRemoveToast('Video Already Added', true);
                    } else {
                        showRemoveToast('Unexpected Error Occurred', true);
                    }
                },
                error: function() {
                    // Show error toast
                    showRemoveToast('Error removing video', true);
                }
            });
        }
    </script>
</head>

<body>


    <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

    <!-- header-start -->
    <header>
        <div class="header-area ">
            <div id="sticky-header" class="main-header-area">
                <div class="container-fluid">
                    <div class="header_bottom_border">
                        <div class="row align-items-center">
                            <div class="col-xl-3 col-lg-2">
                                <div class="logo d-flex">
                                    <a href="index.php">
                                        <img style="width: 80px; height: 80px;" class="rounded-circle" src="img/favicon.png">
                                    </a>
                                    <span class="ml-2 pt-3 mx-4" style="color: white; font-size: 25px;">E-SOUND</span>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-7">
                                <div class="main-menu  d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="index.php">Home</a></li>
                                            <li><a href="artists.php">Artists</a></li>
                                            <li><a>Categories <i class="ti-angle-down"></i></a>
                                                <ul class="submenu bg-danger">
                                                    <li><a class="text-light" href="audio.php">Audio Songs <i class="fa-solid fa-music"></i></a></li>
                                                    <li><a class="text-light" href="video.php">Video Songs <i class="fa-solid fa-video"></i></a></li>
                                                    <li><a class="text-light" href="albums.php">albums <i class="bi bi-card-list"></i></a></li>
                                                </ul>
                                            </li>
                                            <li><a>Genre <i class="ti-angle-down"></i></a>
                                                <ul class="submenu bg-danger">
                                                    <li><a class="text-light" href="functions.php?genre=rock">Rock</a></li>
                                                    <li><a class="text-light" href="functions.php?genre=pop">pop</a></li>
                                                    <li><a class="text-light" href="functions.php?genre=hiphop">hiphop</a></li>
                                                    <li><a class="text-light" href="functions.php?genre=popular">popular</a></li>
                                                    <li><a class="text-light" href="functions.php?genre=jazz">jazz</a></li>
                                                    <li><a class="text-light" href="functions.php?genre=country">country</a></li>
                                                    <li><a class="text-light" href="functions.php?genre=electronic">electronic</a></li>
                                                </ul>
                                            </li>
                                            <li><a class="fs-5" href="favourite.php"><i class="fa-regular fa-heart"> Favourites</i></a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 d-none d-lg-flex justify-content-end align-items-center">
                                <div class="social_icon">
                                    <img src="<?php echo $image ?>" alt="" class="object-fit-cover rounded-circle mx-3" style="width: 50px; height: 50px;">
                                </div>
                                <a href="logout.php" class="btn btn-outline-warning">Log Out</a>
                            </div>
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- header-end -->


    <!-- Success Toast -->
    <div id="favToast" class="toast bg-green-500 text-white p-4 rounded-lg hidden fixed right-5 top-20 z-50 transition-transform transform translate-y-[-100%]">
        Video Added Successfully
    </div>

    <!-- Error Toast -->
    <div id="errorToast" class="toast bg-red-500 text-white p-4 rounded-lg hidden fixed right-5 top-20 z-50 transition-transform transform translate-y-[-100%]">
        Error adding video
    </div>


    <!-- slider_area_start -->
    <div class="slider_area">
        <div class="single_slider  d-flex align-items-center slider_bg_1 overlay2">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="slider_text text-center ">
                            <?php
                            // Get the current file name from the URL
                            $fileName = basename($_SERVER['PHP_SELF'], ".php");

                            // Check for 'genre' in the query string
                            if (isset($_GET['genre'])) {
                                $genre = strtolower($_GET['genre']); // Convert to lowercase for consistency

                                // Display different text based on the genre parameter
                                if ($genre == 'rock') {
                                    echo '<h3>E-ROCK MUSIC</h3>';
                                } elseif ($genre == 'pop') {
                                    echo '<h3>E-POP MUSIC</h3>';
                                } elseif ($genre == 'jazz') {
                                    echo '<h3>E-JAZZ MUSIC</h3>';
                                } elseif ($genre == 'hip hop') {
                                    echo '<h3>E-HIP HOP MUSIC</h3>';
                                } elseif ($genre == 'popular') {
                                    echo '<h3>E-POPULAR MUSIC</h3>';
                                } elseif ($genre == 'country') {
                                    echo '<h3>E-COUNTRY MUSIC</h3>';
                                } elseif ($genre == 'electronic') {
                                    echo '<h3>E-ELECTRONIC MUSIC</h3>';
                                } else {
                                    echo '<h3>E-SOUND</h3>'; // Fallback for undefined genres
                                }
                            }
                            // If no genre is found, check the file name
                            else {
                                if ($fileName == 'albums') {
                                    echo '<h3>E-ALBUM</h3>';
                                } elseif ($fileName == 'video') {
                                    echo '<h3>E-VIDEO</h3>';
                                } elseif ($fileName == 'artists') {
                                    echo '<h3>E-ARTISTS</h3>';
                                } elseif ($fileName == 'favourite') {
                                    echo '<h3>E-FAVOURITES</h3>';
                                } elseif ($fileName == 'audio') {
                                    echo '<h3>E-AUDIO</h3>';
                                } else {
                                    echo '<h3>E-SOUND</h3>'; // Default title if no match
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider_area_end -->