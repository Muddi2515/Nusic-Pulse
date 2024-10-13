<?php
require_once "connection.php";
include("header.php");


?>


<?php
if (isset($_GET['artist'])) {
    $artist = $_GET['artist'];
?>

    <!-- <script>
        $(document).ready(function() {
            // Function to search artists 
            function searchArtists(inputElement) {
                var searchValue = inputElement ? inputElement.value : ''; // Check if inputElement is provided
                var musicType = $('#musicType').val();
                console.log(`music type is : ${musicType}`);
                var urlForAjax = '';
                var appendSection = '';
                if (musicType == 'music') {
                    urlForAjax = 'search_music.php';
                    appendSection = 'music_section';

                    return
                } else if (musicType == 'video') {
                    urlForAjax = 'search_video.php'
                    appendSection = 'video_section';
                    return
                }
                console.log(`url fro the file is : ${urlForAjax}`);
                // Make AJAX request
                $.ajax({


                    url: urlForAjax,
                    type: 'GET',
                    data: {
                        search: searchValue
                    },
                    success: function(response) {
                        // Reset the previous data in the table                    
                        appendSection.empty();

                        // Append new data (assuming `response` contains valid HTML rows)
                        appendSection.append(response);

                        // Highlight the matched text if the search value is not empty
                        if (searchValue !== '') {
                            highlightSearchTerm(searchValue);
                        }
                    }
                });
            }

            function highlightSearchTerm(term) {
                // Ensure we are only searching within the artist divs
                $('.artist').each(function() {
                    var artistDiv = $(this); // Current artist div

                    // Find text elements that should be highlighted, such as name and about fields
                    artistDiv.find('h2, p').each(function() {
                        var element = $(this); // Current h2 or p tag

                        var elementText = element.text(); // Get plain text

                        // Create a regex for case-insensitive matching
                        var regex = new RegExp('(' + term + ')', 'gi');

                        // Replace the matching text with a span wrapped around it
                        var newHtml = elementText.replace(regex, '<span class="highlight">$1</span>');

                        element.html(newHtml); // Update the element content with highlighted text
                    });
                });
            }

            $(document).ready(function() {
                // Call the searchArtists function on page load
                searchArtists(); // This will call the function without any inputElement, using an empty string

                // Event listener for input
                $('#search').on('input', function() {

                    // Get the current value of the search input
                    searchArtists(this); // Pass the input element to the function
                });
            });

        });
    </script> -->

    <div class="music_area music_gallery" style="background-color: #1D1F21; border-bottom: 3px solid #EFEFEF;">
        <div class="container">
            <div class="row">

                <div class="col-xl-5 d-none">
                    <form method="get">
                        <div class="form-outline" data-mdb-input-init>
                            <input type="search" id="form1" name="search" class="form-control" placeholder="Search Music Track" style="border-radius: 50px; width:250px; float:left;" />
                        </div>
                        <input style="display: none;" id="musicType" type="text" value="music" name="search_btn" class="btn ml-1 btn-primary" data-mdb-ripple-init>
                    </form>
                </div>
                <div class="col-xl-7 mb-5">
                    <div class="section_title mb-4">
                        <h2 class="text-uppercase text-warning"><?php echo $artist ?> Music Tracks</h2>
                    </div>
                </div>

            </div>
            <div class="row d-flex align-items-center justify-content-center mb-5 " id="music_section">
                <?php
                $sql = "SELECT * FROM music_table WHERE artist = '$artist'";
                if (isset($_GET['search_btn'])) {
                    $search = $_GET['search'];
                    $sql = $sql . " title LIKE '%$search%'";
                    $empty = "";
                }

                $result = mysqli_query($con, $sql);
                $count = mysqli_num_rows($result);
                if ($count > 0) {
                    while ($row = mysqli_fetch_array($result)) {

                        $music_id = $row['music_id']; // Assuming the column name is 'music_id'
                        $title = htmlspecialchars($row[1]); // Get the song title safely
                        $artist = htmlspecialchars($row['artist']); // Assuming the artist is in the array
                        $src = htmlspecialchars(substr($row['audio_path'], 3, 100)); // Get the audio source safely
                        // echo $src;
                ?>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 mb-20 mx-2 rounded-4" style="background-color: #33363A;">
                            <div class="music_field mt-2 d-flex flex-column justify-content-between" style="height: 100%;">
                                <!-- Image and Play Icon Container -->
                                <div class="position-relative text-center mb-1" style="height: 150px; overflow: hidden;">
                                <a href="musicsss.php?song_id=<?php echo $row['music_id']; ?>&title=<?php echo urlencode($row[1]); ?>&artist=<?php echo urlencode($row[2]); ?>" class="text-decoration-none">
                                        <!-- Image -->
                                        <img src="<?php echo substr($row['cover_image_path'], 3, 100); ?>" alt="Music Cover" class="img-fluid rounded-4" style="width: 100%; height: 100%; object-fit: cover;">
                                        <!-- Play Icon -->
                                        <div class="play-icon position-absolute" style="left: 50%; top: 50%; transform: translate(-50%, -50%); pointer-events: none;">
                                            <i class="fa fa-music text-white" style="font-size: 40px;"></i>
                                        </div>
                                    </a>
                                </div>
                                <!-- Title and Favorite Button -->
                                <div class="audio_name d-flex flex-column align-items-center mb-3">
                                    <h3 class="text-center text-white fs-5"><?php echo $row[1]; ?></h3>
                                    <a type="submit" onclick="addFavourite('favourite.php?music_id=<?php echo $row['music_id'] ?>', '<?php echo $row['music_id'] ?>');" class="btn btn-danger px-5 mb-2 pt-1 pb-0">
                                        <i class="fa fa-heart text-center text-white"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                <?php }
                } else {
                    $empty = "<span class='text-danger'>Music Not Found</span>";
                    echo $empty;
                } ?>
            </div>

            <div class="row">
                <!-- <hr class="bg-white p-1 rounded-4"> -->
                <div class="col-xl-5 d-none">
                    <form method="get">
                        <div class="form-outline" data-mdb-input-init>
                            <input type="search" id="form1" name="search" class="form-control" placeholder="Search Video Track" style="border-radius: 50px; width:250px; float:left;" />
                        </div>
                        <input style="display: none;" id="musicType" type="text" value="video" name="search_btn" class="btn ml-1 btn-primary" data-mdb-ripple-init>
                    </form>
                </div>
                <div class="col-xl-7 mb-5">
                    <div class="section_title mb-5">
                        <h2 class="text-uppercase text-warning" style=""><?php echo $artist ?> video Tracks</h2>
                    </div>
                </div>

            </div>
            <div class="row d-flex align-items-center mb-5 " id="video_section">
                <?php
                $sql = "SELECT * FROM video_table WHERE artist = '$artist'";
                if (isset($_GET['search_btn'])) {
                    $search = $_GET['search'];
                    $sql = $sql . " title LIKE '%$search%'";
                    $empty = "";
                }

                $result = mysqli_query($con, $sql);
                $count = mysqli_num_rows($result);
                if ($count > 0) {
                    while ($row = mysqli_fetch_array($result)) {

                        $video_id = $row['video_id']; // Assuming the column name is 'video_id'
                        $title = htmlspecialchars($row[1]); // Get the song title safely
                        $artist = htmlspecialchars($row['artist']); // Assuming the artist is in the array
                        $src = htmlspecialchars(substr($row['video_path'], 3, 100)); // Get the audio source safely
                        // echo $src;
                ?>

                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 mb-20 mx-2 rounded-4" style="background-color: #33363A;">
                            <div class="music_field mt-2 d-flex flex-column justify-content-between" style="height: 100%;">
                                <!-- Image and Play Icon Container -->
                                <div class="position-relative text-center mb-1" style="height: 150px; overflow: hidden;">
                                    <a href="videossss.php?song_id=<?php echo $row['video_id']; ?>&title=<?php echo urlencode($row[1]); ?>&artist=<?php echo urlencode($row[2]); ?>" class="text-decoration-none">
                                        <!-- Image -->
                                        <img src="<?php echo substr($row['cover_image_path'], 3, 100); ?>" alt="Video Cover" class="img-fluid rounded-4" style="width: 100%; height: 100%; object-fit: cover;">
                                        <!-- Play Icon -->
                                        <div class="play-icon position-absolute" style="left: 50%; top: 50%; transform: translate(-50%, -50%); pointer-events: none;">
                                            <i class="fa fa-play-circle text-white" style="font-size: 40px;"></i>
                                        </div>
                                    </a>
                                </div>
                                <!-- Title and Favorite Button -->
                                <div class="audio_name d-flex flex-column align-items-center mb-3 highlighting-searh">
                                    <h3 class="text-center text-white fs-5"><?php echo $row[1]; ?></h3>
                                    <a type="submit" onclick="addFavourite('favourite.php?video_id=<?php echo $row['video_id'] ?>', '<?php echo $row['video_id'] ?>');" class="btn btn-danger px-5 mb-2 pt-1 pb-0">
                                        <i class="fa fa-heart text-center text-white"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                <?php }
                } else {
                    $empty = "<span class='text-danger'>Music Not Found</span>";
                    echo $empty;
                } ?>
            </div>

        </div>
        <script>
            $(document).ready(function() {
                // Function to search artists 
                function searchArtists(inputElement) {
                    var searchValue = inputElement ? inputElement.value : ''; // Check if inputElement is provided

                    // Make AJAX request
                    $.ajax({
                        url: 'search_artists.php',
                        type: 'GET',
                        data: {
                            search: searchValue
                        },
                        success: function(response) {
                            // Reset the previous data in the table                    
                            $('#artists_section').empty();

                            // Append new data (assuming `response` contains valid HTML rows)
                            $('#artists_section').append(response);

                            // Highlight the matched text if the search value is not empty
                            if (searchValue !== '') {
                                highlightSearchTerm(searchValue);
                            }
                        }
                    });
                }

                function highlightSearchTerm(term) {
                    // Ensure we are only searching within the artist divs
                    $('.artist').each(function() {
                        var artistDiv = $(this); // Current artist div

                        // Find text elements that should be highlighted, such as name and about fields
                        artistDiv.find('h2, p').each(function() {
                            var element = $(this); // Current h2 or p tag

                            var elementText = element.text(); // Get plain text

                            // Create a regex for case-insensitive matching
                            var regex = new RegExp('(' + term + ')', 'gi');

                            // Replace the matching text with a span wrapped around it
                            var newHtml = elementText.replace(regex, '<span class="highlight">$1</span>');

                            element.html(newHtml); // Update the element content with highlighted text
                        });
                    });
                }

                // Call the searchArtists function on page load
                searchArtists(); // This will call the function without any inputElement, using empty string

                // Event listener for input
                $('#search').on('input', function() {
                    // Get the current value of the search input
                    searchArtists(this); // Pass the input element to the function
                });
            });
        </script>
        <div class="music_area music_gallery " style="background-color: #1D1F21;">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="section_title text-center mb-65">
                            <!-- <hr class="bg-white p-1 rounded-4"> -->
                            <h3 class="text-warning">More Artists</h3>
                            <!-- <hr class="bg-white p-1 rounded-4">   -->
                        </div>
                    </div>
                </div>
                <div class="row align-items-center justify-content-center mb-20" id="artists_section">

                </div>
            </div>
        </div>

    <?php } ?>

    <?php
    if (isset($_GET['album'])) {
        $album = $_GET['album'];
    ?>

        <div class="music_area music_gallery">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5">
                        <form method="get">
                            <div class="form-outline" data-mdb-input-init>
                                <input type="search" id="form1" name="search" class="form-control" placeholder="Search Music Track" style="border-radius: 50px; width:250px; float:left;" />
                            </div>
                            <input style="border-radius: 50px;" type="submit" value="Search" name="search_btn" class="btn ml-1 btn-primary" data-mdb-ripple-init>
                        </form>
                    </div>
                    <div class="col-xl-7">
                        <div class="section_title text-left mb-65">
                            <h2 class="text-uppercase"><?php echo $album ?> Music Tracks</h2>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center justify-content-center mb-20">
                    <?php
                    $sql = "SELECT * FROM music_table WHERE artist = '$album'";
                    if (isset($_GET['search_btn'])) {
                        $search = $_GET['search'];
                        $sql = $sql . " title LIKE '%$search%'";
                        $empty = "";
                    }
                    $result = mysqli_query($con, $sql);
                    $count = mysqli_num_rows($result);
                    if ($count > 0) {
                        while ($row = mysqli_fetch_array($result)) {
                    ?>
                            <div class="col-xl-4 mb-20">
                                <div class="row align-items-center">
                                    <div class="col-xl-12 col-md-12">
                                        <div class="music_field">
                                            <div class="audio_name">
                                                <div class="name text-center">
                                                    <h2>
                                                        <div class="fav"><a href="favourite.php?music_id=<?php echo $row[0] ?>"><i class="fa fa-heart"></i>
                                                                <p class="fav2 text-light">Add to Favourites</p>
                                                            </a></div><?php echo $row[1] ?>
                                                    </h2>
                                                    <img src="<?php echo substr($row[8], 3, 100) ?>" width="270px" height="150px" alt="">
                                                    <audio class="mt-2" preload="auto" style="width: 320px;" controls>
                                                        <source src="<?php echo substr($row['audio_path'], 3, 100) ?>">
                                                    </audio>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php }
                    } else {
                        $empty = "<span class='text-warning'>Music Not Found</span>";
                        echo $empty;
                    } ?>
                </div>

                <div class="row">
                    <div class="col-xl-5">
                        <form method="get">
                            <div class="form-outline" data-mdb-input-init>
                                <input type="search" id="form1" name="search" class="form-control" placeholder="Search Video Track" style="border-radius: 50px; width:250px; float:left;" />
                            </div>
                            <input style="border-radius: 50px;" type="submit" value="Search" name="search_btn" class="btn ml-1 btn-primary" data-mdb-ripple-init>
                        </form>
                    </div>
                    <div class="col-xl-7">
                        <div class="section_title text-left mb-65">
                            <h2 class="text-uppercase"><?php echo $album ?> video Tracks</h2>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center justify-content-center mb-20">
                    <?php
                    $sql = "SELECT * FROM video_table  WHERE artist = '$album'";
                    if (isset($_GET['search_btn'])) {
                        $search = $_GET['search'];
                        $sql = $sql . " title LIKE '%$search%'";
                        $empty = "";
                    }
                    $result = mysqli_query($con, $sql);
                    $count = mysqli_num_rows($result);
                    if ($count > 0) {
                        while ($row = mysqli_fetch_array($result)) {
                    ?>
                            <div class="col-xl-6 mb-20">
                                <div class="row align-items-center">
                                    <div class="col-xl-12 col-md-12">
                                        <div class="music_field">
                                            <div class="audio_name">
                                                <div class="name text-center">
                                                    <h2>
                                                        <div class="fav"><a href="favourite.php?video_id=<?php echo $row[0] ?>"><i class="fa fa-heart"></i>
                                                                <p class="fav2 text-light">Add to Favourites</p>
                                                            </a></div><?php echo $row[1] ?>
                                                    </h2>
                                                    <video preload="auto" poster="<?php echo substr($row[8], 3, 100) ?>" height="250px" width="500px"
                                                        controls>
                                                        <source
                                                            src="<?php echo substr($row['audio_path'], 3, 100) ?>">
                                                    </video>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php }
                    } else {
                        $empty = "<span class='text-warning'>Video Not Found</span>";
                        echo $empty;
                    } ?>
                </div>
            </div>
        </div>

        <div class="music_area music_gallery">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="section_title text-center mb-65">
                            <h3>More Albums</h3>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center justify-content-center mb-20">
                    <?php
                    $sql = "SELECT * FROM artist";
                    if (isset($_GET['search_btn'])) {
                        $search = $_GET['search'];
                        $sql = $sql . " WHERE Name LIKE '%$search%'";
                        $empty = "";
                    }
                    $result = mysqli_query($con, $sql);
                    $count = mysqli_num_rows($result);
                    if ($count > 0) {
                        while ($row = mysqli_fetch_array($result)) {
                    ?>
                            <div class="col-xl-3 mb-65 artist">
                                <a href="functions.php?album=<?php echo $row[1] ?>">
                                    <div class="row align-items-center">
                                        <div class="col-xl-12 col-md-12">
                                            <div class="music_field">
                                                <div class="audio_name">
                                                    <div class="name text-center">
                                                        <img width="250px" height="250px" src="images/album.jpg" alt="">
                                                        <h2 class="mt-3"><?php echo $row[1] ?></h2>
                                                        <p><?php echo substr($row[3], 0, -6) ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                    <?php }
                    } else {
                        $empty = "<span class='text-warning'>Artist Not Found</span>";
                        echo $empty;
                    } ?>
                </div>
            </div>
        </div>

    <?php } ?>

    <?php
    if (isset($_GET['genre'])) {
        $genre = $_GET['genre'];

    ?>

        <!-- music_area  -->
        <div class="music_area music_gallery" style="background-color: #1D1F21;">
            <div class="container">
                <div class="row d-flex text-center">
                    <div class="col-xl col-lg col-sm col-md d-none">
                        <form method="get" class="mt-5">
                            <div class="form-outline" data-mdb-input-init>
                                <input type="search" id="form1" name="search" class="form-control" placeholder="Search Music Track" style="border-radius: 50px; width:250px; float:left;" />
                            </div>
                            <!-- <input style="border-radius: 50px;" type="submit" value="Search" name="search_btn" class="btn ml-1 btn-primary" data-mdb-ripple-init> -->
                        </form>
                    </div>
                    <div class="col-xl col-lg col-sm col-md">
                        <div class="section_title mb-65 mt-5">
                            <h3 class="text-uppercase text-warning"><?php echo $genre ?> Music Tracks</h3>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center justify-content-center mb-5">
                    <?php
                    $sql = "SELECT * FROM music_table WHERE genre = '$genre'";
                    if (isset($_GET['search_btn'])) {
                        $search = $_GET['search'];
                        $sql = $sql . " title LIKE '%$search%'";
                        $empty = "";
                    }
                    $result = mysqli_query($con, $sql);
                    $count = mysqli_num_rows($result);
                    if ($count > 0) {
                        while ($row = mysqli_fetch_array($result)) {
                    ?>
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 mb-20 mx-2 rounded-4" style="background-color: #33363A;">
                        <div class="music_field mt-2 d-flex flex-column justify-content-between" style="height: 100%;">
                        <!-- Image and Play Icon Container -->
                        <div class="position-relative text-center mb-1" style="height: 150px; overflow: hidden;">
                        <a href="musicsss.php?genretype=true&genre=<?php echo $_GET['genre']; ?>&song_id=<?php echo $row['music_id']; ?>&title=<?php echo urlencode($row[1]); ?>&artist=<?php echo urlencode($row[2]); ?>" class="text-decoration-none">
                            <!-- Image -->
                            <img src="<?php echo substr($row['cover_image_path'], 3, 100); ?>" alt="Music Cover" class="img-fluid rounded-4" style="width: 100%; height: 100%; object-fit: cover;">
                            <!-- Play Icon -->
                            <div class="play-icon position-absolute" style="left: 50%; top: 50%; transform: translate(-50%, -50%); pointer-events: none;">
                                <i class="fa fa-music text-white" style="font-size: 40px;"></i>
                            </div>
                            </a>
                        </div>
                        <!-- Title and Favorite Button -->
                        <div class="audio_name d-flex flex-column align-items-center mb-3">
                            <h3 class="text-center text-white fs-5"><?php echo $row[1]; ?></h3>
                            <a type="submit" onclick="addFavourite('favourite.php?music_id=<?php echo $row['music_id'] ?>', '<?php echo $row['music_id'] ?>');" class="btn btn-danger px-5 mb-2 pt-1 pb-0">
                            <i class="fa fa-heart text-center text-white"></i>
                            </a>
                        </div>
                        </div>
                    </div>
                    <?php }
                    } else {
                        $empty = "<span class='text-center text-warning'>Music Not Found</span>";
                        echo $empty;
                    } ?>
                </div>

                <div class="row d-flex text-center">
                    <div class="col-xl col-lg col-sm col-md d-none">
                        <form method="get" class="mt-5">
                            <div class="form-outline" data-mdb-input-init>
                                <!-- <input type="search" id="form1" name="search" class="form-control" placeholder="Search Video Track" style="border-radius: 50px; width:250px; float:left;" /> -->
                            </div>
                            <!-- <input style="border-radius: 50px;" type="submit" value="Search" name="search_btn" class="btn ml-1 btn-primary" data-mdb-ripple-init> -->
                        </form>
                    </div>
                    <div class="col-xl col-lg col-sm col-md">
                        <div class="section_title mb-65 mt-5">
                            <h3 class="text-uppercase text-warning"><?php echo $genre ?> video Tracks</h3>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center justify-content-center mb-5">
                    <?php
                    $sql = "SELECT * FROM video_table  WHERE genre = '$genre'";
                    if (isset($_GET['search_btn'])) {
                        $search = $_GET['search'];
                        $sql = $sql . " title LIKE '%$search%'";
                        $empty = "";
                    }
                    $result = mysqli_query($con, $sql);
                    $count = mysqli_num_rows($result);
                    if ($count > 0) {
                        while ($row = mysqli_fetch_array($result)) {
                    
                            ?>

                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 mb-20 mx-2 rounded-4" style="background-color: #33363A;">
                            <div class="music_field mt-2 d-flex flex-column justify-content-between" style="height: 100%;">
                                <!-- Image and Play Icon Container -->
                                <div class="position-relative text-center mb-1" style="height: 150px; overflow: hidden;">
                                <a href="videossss.php?genretype=true&genre=<?php echo $_GET['genre'] ?>&song_id=<?php echo $row['video_id']; ?>&title=<?php echo urlencode($row[1]); ?>&artist=<?php echo urlencode($row[2]); ?>" class="text-decoration-none">
                                        <!-- Image -->
                                        <img src="<?php echo substr($row['cover_image_path'], 3, 100); ?>" alt="Video Cover" class="img-fluid rounded-4" style="width: 100%; height: 100%; object-fit: cover;">
                                        <!-- Play Icon -->
                                        <div class="play-icon position-absolute" style="left: 50%; top: 50%; transform: translate(-50%, -50%); pointer-events: none;">
                                            <i class="fa fa-play-circle text-white" style="font-size: 40px;"></i>
                                        </div>
                                    </a>
                                </div>
                                <!-- Title and Favorite Button -->
                                <div class="audio_name d-flex flex-column align-items-center mb-3 highlighting-searh">
                                    <h3 class="text-center text-white fs-5"><?php echo $row[1]; ?></h3>
                                    <a type="submit" onclick="addFavourite('favourite.php?video_id=<?php echo $row['video_id'] ?>', '<?php echo $row['video_id'] ?>');" class="btn btn-danger px-5 mb-2 pt-1 pb-0">
                                        <i class="fa fa-heart text-center text-white"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                         <?php }
                    } else {
                        $empty = "<span class='text-danger text-center'>Video Not Found</span>";
                        echo $empty;
                    } ?>
                </div>
            </div>
        </div>
        <!-- music_area end  -->

    <?php } ?>


    <!-- contact_rsvp -->
    <div class="contact_rsvp">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="text text-center">
                        <h3>Contact For RSVP</h3>
                        <a class="boxed-btn3" href="contact.php">Contact Me</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ contact_rsvp -->

    <?php
    include("footer.php")
    ?>