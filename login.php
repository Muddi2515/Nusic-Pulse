<?php
require_once "connection.php";

if(isset($_POST['btn'])){

  $email = $_POST['email'];
  $pass = md5($_POST['pass']);

  $sql = "SELECT * FROM users WHERE Email = '$email' and Password = '$pass'";
  $result = mysqli_query($con, $sql);
  while($row = mysqli_fetch_assoc($result)){
    $_SESSION['Name'] = $row['Name'];
    $_SESSION['user_id'] = $row['user_id'];
    $_SESSION['user_img'] = $row['user_img'];

  }
  $count = mysqli_num_rows($result);
  
  if($count > 0){
    header("location: index.php");
   }else{
    echo "<script>
       alert('Invalid Email or Password');
        </script>";
   }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
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
              <div class="card-body px-5 py-5 ">
                <div class="text-center">
                  <img src="img/favicon.png" class="rounded-circle" alt="" style="width: 250px; height: 250px;">
                </div>
                <h2 class="card-title text-center mb-4">Login</h2>
                <form method="post">
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control text-light p_input">
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="pass" id="pass" class="form-control text-light p_input">
                  </div>
                  <div class="form-group">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" onclick="Function()" class="form-check-input"> Show Password </label>
                    </div>
                  </div>
                  <div class="text-center">
                    <button type="submit" name="btn" class="btn btn-primary btn-block enter-btn">Login</button>
                  </div>
  
                  <p class="sign-up text-center">Don't have an Account?<a href="register.php"> Register</a></p>
                  <p class="sign-up text-center">Are you an<a href="admin/login.php"> Admin?</a></p>
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