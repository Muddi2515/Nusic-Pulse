<?php
require_once "connection.php";
include("header.php");
?>
<script>
    $(document).ready(function() {
        // Function to search artists 
        function searchArtists(inputElement) {
            var searchValue = inputElement ? inputElement.value : ''; // Check if inputElement is provided

            // Make AJAX request
            $.ajax({
                url: 'search_albums.php',
                type: 'GET',
                data: {
                    search: searchValue
                },
                success: function(response) {
                    // Reset the previous data in the table                    
                    $('#albums_section').empty();

                    // Append new data (assuming `response` contains valid HTML rows)
                    $('#albums_section').append(response);

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
</script>

<!-- music_area -->
<div class="music_area music_gallery" style="background-color:#1D1F21;">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="section_title text-center mb-65">
                    <h3 class="text-warning">Latest Music Tracks</h3>
                </div>
            </div>
        </div>
        <div class="row align-items-center justify-content-center mt-4 mb-20">
    <?php
    $sql = "SELECT * FROM music_table ORDER BY release_date DESC LIMIT 4";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result)) {
    ?>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 mb-20 mx-2 rounded-4" style="background-color: #33363A;">
            <div class="music_field mt-2 d-flex flex-column justify-content-between" style="height: 100%;">
                <!-- Image and Play Icon Container -->
                <div class="position-relative text-center mb-1" style="height: 150px; overflow: hidden;">
                    <a href="musicsss.php?latest=true&song_id=<?php echo $row['music_id']; ?>&title=<?php echo urlencode($row[1]); ?>&artist=<?php echo urlencode($row[2]); ?>" class="text-decoration-none">
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
    <?php } ?>
</div>

        <div class="row">
            <div class="col-xl-12">
                <div class="section_title text-center mb-65">
                    <a href="audio.php" class="btn btn-outline-warning btn-lg">More Music Tracks</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- music_area end  -->

<!-- video_area  -->
<div class="music_area music_gallery" style="background-color: #1D1F21;">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="section_title text-center mb-3">
                    <h3 class="text-warning">Latest Video Tracks</h3>
                </div>
            </div>
        </div>
        <div class="row align-items-center justify-content-center mt-4 mb-20">
    <?php
    $sql = "SELECT * FROM video_table ORDER BY release_date DESC LIMIT 4";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result)) {
    ?>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 mb-20 mx-2 rounded-4" style="background-color: #33363A;">
            <div class="music_field mt-2 d-flex flex-column justify-content-between" style="height: 100%;">
                <!-- Image and Play Icon Container -->
                <div class="position-relative text-center mb-1" style="height: 150px; overflow: hidden;">
                    <a href="videossss.php?latest=true&song_id=<?php echo $row['video_id']; ?>&title=<?php echo urlencode($row[1]); ?>&artist=<?php echo urlencode($row[2]); ?>" class="text-decoration-none">
                        <!-- Image -->
                        <img src="<?php echo substr($row['cover_image_path'], 3, 100); ?>" alt="Video Cover" class="img-fluid rounded-4" style="width: 100%; height: 100%; object-fit: cover;">
                        <!-- Play Icon -->
                        <div class="play-icon position-absolute" style="left: 50%; top: 50%; transform: translate(-50%, -50%); pointer-events: none;">
                            <i class="fa fa-play-circle text-white" style="font-size: 40px;"></i>
                        </div>
                    </a>
                </div>
                <!-- Title and Favorite Button -->
                <div class="audio_name d-flex flex-column align-items-center mb-3">
                    <h3 class="text-center text-white fs-5"><?php echo $row[1]; ?></h3>
                    <a type="submit" onclick="addFavourite('favourite.php?video_id=<?php echo $row['video_id'] ?>', '<?php echo $row['video_id'] ?>');" class="btn btn-danger px-5 mb-2 pt-1 pb-0">
                        <i class="fa fa-heart text-center text-white"></i>
                    </a>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

        <div class="row">
            <div class="col-xl-12">
                <div class="section_title text-center mb-65">
                    <a href="video.php" class="btn btn-outline-warning btn-lg">More Video Tracks</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- video_area end  -->

<!-- artist area -->
<div class="music_area music_gallery" style="background-color: #1D1F21;">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="section_title text-center mb-65">
                    <h3 class="text-warning">Artists</h3>
                </div>
            </div>
        </div>
        <div class="row align-items-center justify-content-center mb-20">
            <?php
            $sql = "SELECT * FROM artist ORDER BY Id DESC LIMIT 4";
            $result = mysqli_query($con, $sql);
            $count = mysqli_num_rows($result);
            if ($count > 0) {
                while ($row = mysqli_fetch_array($result)) {
            ?>
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 mb-65 artist rounded-4">
                        <a href="functions.php?artist=<?php echo $row['Name'] ?>">
                            <div class="row align-items-center">
                                <div class="col-xl-12 col-md-12">
                                    <div class="music_field">
                                        <div class="audio_name">
                                            <div class="name text-center">
                                                <img class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|} rounded-4" width="100%" height="250px"  src="<?php echo str_replace('../', '', $row['Image']) ?>" alt="">
                                                <h4 class="mt-3 fs-5" style="color:white;"><?php echo $row['Name'] ?></h4>
                                                <p><?php echo $row['About'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
            <?php }
            } else {
                $empty = "<span class='text-danger'>Artist Not Found</span>";
                echo $empty;
            } ?>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="section_title text-center mb-65">
                    <a href="artists.php" class="btn btn-outline-warning btn-lg">More Artists</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- artist area end -->

<!-- album area -->
<div class="music_area music_gallery" style="background-color: #1D1F21;">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="section_title text-center mb-65">
                    <h3 class="text-warning">Latest Albums</h3>
                </div>
            </div>
        </div>
        <div class="row align-items-center justify-content-center mb-20">
            <?php
            $sql = "SELECT * FROM artist LIMIT 4";
            $result = mysqli_query($con, $sql);
            $count = mysqli_num_rows($result);
            if ($count > 0) {
                while ($row = mysqli_fetch_array($result)) {
            ?>
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 mb-65 artist rounded-4">
                        <a href="functions.php?artist=<?php echo $row['Name'] ?>">
                            <div class="row align-items-center">
                                <div class="col-xl-12 col-md-12">
                                    <div class="music_field">
                                        <div class="audio_name">
                                            <div class="name text-center">
                                                <img class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|} rounded-circle" width="100%" height="250px" src="images/album.jpg" alt="">
                                                <h2 class="mt-3 fs-5" style="color:white;"><?php echo $row['Name'] ?></h2>
                                                <p><?php echo $row['About'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
            <?php }
            } else {
                $empty = "<span class='text-danger'>Artist Not Found</span>";
                echo $empty;
            } ?>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="section_title text-center mb-65">
                    <a href="albums.php" class="btn btn-outline-warning btn-lg">More Albums</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- album end  -->

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