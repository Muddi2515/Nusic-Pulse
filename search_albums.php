<?php
require_once("connection.php");


if (isset($_GET['search']) && $_GET['searchByAlbum'] == 'true') {
  $search = $_GET['search'];

  $sql = "SELECT * FROM artist WHERE Name LIKE '%$search%'";
  //   $sql = "SELECT * FROM artist WHERE Name LIKE '%$search%' OR About LIKE '%$search%' OR genre LIKE '%$search%'";
  $result = mysqli_query($con, $sql);
  $count = mysqli_num_rows($result);

  if ($_GET['search'] == '') {
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
        <?php
      }
    } else {
      echo '<div class="col-12">
                <p class="text-warning text-center">No Data is Here</p>
              </div>';
    }
  }


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
      <?php
    }
  } else {
    echo '<div class="col-12">
              <p class="text-warning text-center">No Data is Here</p>
            </div>';
  }
}

if (isset($_GET['search']) && $_GET['searchFromAllMusic'] == 'true') {
  $search = $_GET['search'];

  $sql = "SELECT * FROM music_table WHERE title LIKE '%$search%' OR genre LIKE '%$search%'  OR release_date LIKE '%$search%' OR artist LIKE '%$search%' OR album LIKE '%$search%'";
  //   $sql = "SELECT * FROM artist WHERE Name LIKE '%$search%' OR About LIKE '%$search%' OR genre LIKE '%$search%'";
  $result = mysqli_query($con, $sql);
  $count = mysqli_num_rows($result);

  if ($_GET['search'] == '') {
    if ($count > 0) {
      while ($row = mysqli_fetch_array($result)) {
?>

        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 mb-20 mx-2 rounded-4" style="background-color: #33363A;">
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
            <div class="audio_name d-flex flex-column align-items-center mb-3">
              <h4 class="text-center text-white fs-5"><?php echo $row[1]; ?></h5>
              <a type="submit" onclick="addFavourite('favourite.php?music_id=<?php echo $row['music_id'] ?>', '<?php echo $row['music_id'] ?>');" class="btn btn-danger px-5 mb-2 pt-1 pb-0">
                <i class="fa fa-heart text-center text-white"></i>
              </a>
            </div>
          </div>
        </div>

      <?php
      }
    } else {
      ?>
      <div class="col-12">
        <p class="text-warning text-center">No Data is Here</p>
      </div>
    <?php
    }
  }


  if ($count > 0) {
    while ($row = mysqli_fetch_array($result)) {
    ?>

      <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 mb-20 mx-2 rounded-4" style="background-color: #33363A;">
        <div class="music_field mt-2">
          <div class="position-relative text-center mb-1">
            <a href="musicsss.php?allSongs=true&song_id=<?php echo $row['music_id']; ?>&title=<?php echo urlencode($row[1]); ?>&artist=<?php echo urlencode($row[2]); ?>" class="text-decoration-none">
              <!-- Image -->
              <img src="<?php echo substr($row['cover_image_path'], 3, 100); ?>" alt="Music Cover" class="img-fluid rounded-4" width="270" height="150" style="object-fit: cover;">

              <!-- Play Icon -->
              <div class="play-icon position-absolute" style="left: 50%; top: 50%; transform: translate(-50%, -50%); pointer-events: none;">
                <i class="fa fa-music text-white" style="font-size: 40px;"></i>
              </div>
            </a>
          </div>
          <!-- Align button and title in the center -->
          <div class="audio_name d-flex flex-column align-items-center mb-3 artist">
            <h4 class="text-center text-white fs-5"><?php echo $row['title']; ?></h4>
            <a href="favourite.php?music_id=<?php echo $row['music_id'] ?>" class="btn btn-danger px-5 mb-2 pt-1 pb-0">
              <i class="fa fa-heart text-center"></i>
            </a>
          </div>
        </div>
      </div>

    <?php
    }
  } else {
    ?>
    <div class="col-12">
      <p class="text-warning text-center">No Data is Here</p>
    </div>
    <?php
  }
}

if (isset($_GET['search']) && $_GET['searchFromAllVideo'] == 'true') {

  $search = $_GET['search'];

  $sql = "SELECT * FROM video_table WHERE title LIKE '%$search%' OR genre LIKE '%$search%'  OR release_date LIKE '%$search%' OR artist LIKE '%$search%' OR album LIKE '%$search%'";
  //   $sql = "SELECT * FROM artist WHERE Name LIKE '%$search%' OR About LIKE '%$search%' OR genre LIKE '%$search%'";
  $result = mysqli_query($con, $sql);
  $count = mysqli_num_rows($result);

  if ($_GET['search'] == '') {
    if ($count > 0) {
      while ($row = mysqli_fetch_array($result)) {
    ?>

        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 mb-20 mx-2 rounded-4" style="background-color: #33363A;">
          <div class="music_field mt-2 d-flex flex-column justify-content-between" style="height: 100%;">
            <!-- Image and Play Icon Container -->
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
            <div class="audio_name d-flex flex-column align-items-center mb-3 highlighting-search">
              <h4 class="text-center text-white fs-5"><?php echo $row[1]; ?></h4>
              <a type="submit" onclick="addFavourite('favourite.php?video_id=<?php echo $row['video_id'] ?>', '<?php echo $row['video_id'] ?>');" class="btn btn-danger px-5 mb-2 pt-1 pb-0">
                <i class="fa fa-heart text-center text-white"></i>
              </a>
            </div>
          </div>
        </div>
      <?php
      }
    } else {
      ?>
      <div class="col-12">
        <p class="text-warning text-center">No Data is Here</p>
      </div>
    <?php
    }
  }


  if ($count > 0) {
    while ($row = mysqli_fetch_array($result)) {
    ?>

      <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 mb-20 mx-2 rounded-4" style="background-color: #33363A;">
        <div class="music_field mt-2 d-flex flex-column justify-content-between" style="height: 100%;">
          <!-- Image and Play Icon Container -->
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
          <div class="audio_name d-flex flex-column align-items-center mb-3 highlighting-search">
            <h4 class="text-center text-white fs-5"><?php echo $row[1]; ?></h4>
            <a type="submit" onclick="addFavourite('favourite.php?video_id=<?php echo $row['video_id'] ?>', '<?php echo $row['video_id'] ?>');" class="btn btn-danger px-5 mb-2 pt-1 pb-0">
              <i class="fa fa-heart text-center text-white"></i>
            </a>
          </div>
        </div>
      </div>
    <?php
    }
  } else {
    ?>
    <div class="col-12">
      <p class="text-warning text-center">No Data is Here</p>
    </div>
<?php
  }
}
