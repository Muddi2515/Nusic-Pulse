<?php
require_once "connection.php";

ob_start();
if (isset($_POST['btn'])) {

  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $pass = md5($_POST['pass']);

  $count = mysqli_num_rows(mysqli_query($con, "SELECT * FROM users WHERE Email = '$email'"));
  if ($count > 0) {
    echo "<script>
       alert('Email Already Taken');
     </script>";
  } else {
    $sql = "INSERT INTO `users` VALUES('','$name','$email','$pass','$phone')";
    $result = mysqli_query($con, $sql);
    if ($result) {
      echo "<script>
          alert('Registered successfully');
          window.location = 'login.php';
          </script>";
    }
  }

}
ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Register</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="admin/assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="admin/assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="admin/assets/css/style.css">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="img/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="row w-100 m-0">
        <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
          <div class="card col-lg-4 mx-auto">
            <div class="card-body px-5 py-5">
              <div class="text-center">
                <img src="img/favicon.png" class="rounded-circle" alt="" style="width: 250px; height: 250px;">
              </div>
              <h2 class="card-title text-center mb-4">Register</h2>
              <form method="post">
                <div class="form-group">
                  <label>Username</label>
                  <input required type="text" name="name" class="form-control text-light p_input">
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input required type="email" name="email" class="form-control text-light p_input">
                </div>
                <div class="form-group">
                  <label>Phone</label>
                  <input required type="text" name="phone" class="form-control text-light p_input">
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input required type="password" name="pass" id="pass" class="form-control text-light p_input">
                </div>
                <div class="form-group">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input type="checkbox" onclick="Function()" class="form-check-input"> Show Password </label>
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" name="btn" class="btn btn-primary btn-block enter-btn">Register</button>
                </div>

                <p class="sign-up text-center">Already have an Account?<a href="login.php"> Log In</a></p>
              </form>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- row ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="admin/assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script>
    function Function() {
      var x = document.getElementById("pass");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
  </script>
  <script src="admin/assets/js/off-canvas.js"></script>
  <script src="admin/assets/js/hoverable-collapse.js"></script>
  <script src="admin/assets/js/misc.js"></script>
  <script src="admin/assets/js/settings.js"></script>
  <script src="admin/assets/js/todolist.js"></script>
  <!-- endinject -->
</body>

</html>