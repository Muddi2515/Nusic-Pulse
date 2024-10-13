<?php
require_once("connection.php");
?>


<?php
    if (isset($_GET['genre'])) {
        $genre = $_GET['genre'];

    ?>

        <!-- music_area  -->
        <div class="music_area music_gallery" style="background-color: #1D1F21;">
            <div class="container">
                <div class="row d-flex">
                    <div class="col-xl col-lg col-sm col-md">
                        <form method="get" class="mt-5">
                            <div class="form-outline" data-mdb-input-init>
                                <input type="search" id="form1" name="search" class="form-control" placeholder="Search Music Track" style="border-radius: 50px; width:250px; float:left;" />
                            </div>
                            <!-- <input style="border-radius: 50px;" type="submit" value="Search" name="search_btn" class="btn ml-1 btn-primary" data-mdb-ripple-init> -->
                        </form>
                    </div>
                    <div class="col-xl col-lg col-sm col-md">
                        <div class="section_title text-left mb-65 mt-5">
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
                        $empty = "<span class='text-warning'>Music Not Found</span>";
                        echo $empty;
                    } ?>
                </div>

                <div class="row d-flex">
                    <div class="col-xl col-lg col-sm col-md">
                        <form method="get" class="mt-5">
                            <div class="form-outline" data-mdb-input-init>
                                <input type="search" id="form1" name="search" class="form-control" placeholder="Search Video Track" style="border-radius: 50px; width:250px; float:left;" />
                            </div>
                            <!-- <input style="border-radius: 50px;" type="submit" value="Search" name="search_btn" class="btn ml-1 btn-primary" data-mdb-ripple-init> -->
                        </form>
                    </div>
                    <div class="col-xl col-lg col-sm col-md">
                        <div class="section_title text-left mb-65 mt-5">
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
                        $empty = "<span class='text-danger'>Video Not Found</span>";
                        echo $empty;
                    } ?>
                </div>
            </div>
        </div>
        <!-- music_area end  -->

    <?php } ?>