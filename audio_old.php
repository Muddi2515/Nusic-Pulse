<?php
require_once "connection.php";
include("header.php");
?>

<!-- music_area  -->
<div class="music_area music_gallery">
    <div class="container">
        <div class="row">
             <div class="col-xl-5">
             <form method="get">
            <div class="form-outline" data-mdb-input-init>
                <input type="search" id="form1" name="search" class="form-control" placeholder="Search Music Track" style="border-radius: 50px; width:250px; float:left;" />
            </div>
            <input style="border-radius: 50px;" type="submit" value="Search"  name="search_btn" class="btn ml-1 btn-primary"  data-mdb-ripple-init>
          </form>
            </div>
            <div class="col-xl-7">
                <div class="section_title text-left mb-65">
                    <h3>Music Tracks</h3>
                </div>
            </div>
        </div>
        <div class="row align-items-center justify-content-center mb-20">
            <?php
            $sql = "SELECT * FROM music_table";
            if(isset($_GET['search_btn'])){
                $search = $_GET['search'];
                $sql = $sql. " WHERE title LIKE '%$search%'";
                $empty = "";
            }
            $result = mysqli_query($con, $sql);
            $count = mysqli_num_rows($result);
            if($count > 0){
            while ($row = mysqli_fetch_array($result)) {
                ?>
                <div class="col-xl-4 mb-20">
                    <div class="row align-items-center">
                        <div class="col-xl-12 col-md-12">
                            <div class="music_field">
                                <div class="audio_name">
                                    <div class="name text-center">
                                    <h2><div class="fav"><a href="favourite.php?music_id=<?php echo $row[0]?>"><i class="fa fa-heart"></i> <p class="fav2 text-light">Add to Favourites</p></a></div><?php echo $row[1]?></h2>
                                        <p><?php echo $row[2]?></p>
                                        <img src="<?php echo substr($row[8], 3, 100) ?>" width="270px" height="150px" alt="">
                                    <audio preload="auto" style="width: 350px;" controls>
                                        <source src="<?php echo substr($row[9], 3, 100) ?>">
                                    </audio>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }
                    }else{$empty = "<span class='text-danger'>Music Not Found</span>"; echo $empty;} ?>
        </div>
    </div>
</div>
<!-- music_area end  -->

<?php
include("footer.php")
    ?>