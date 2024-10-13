<?php
require_once("connection.php");


if (isset($_GET['search'])) {
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
                      <img class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|} rounded-4" width="100%" height="250px" src="<?php echo str_replace('../', '', $row['Image']) ?>" alt="">
                      <h4 class="mt-3 fs-5 responsive-card-text" style="color:white;"><?php echo $row['Name'] ?></h4>
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
                    <img class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|} rounded-4" width="100%" height="250px" src="<?php echo str_replace('../', '', $row['Image']) ?>" alt="">
                    <h4 class="mt-3 fs-5 responsive-card-text" style="color:white;"><?php echo $row['Name'] ?></h4>
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
