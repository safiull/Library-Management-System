<?php
    require_once 'header.php';
    $login_std = $_SESSION["student_login"];
    $std_info = mysqli_query($link, "SELECT * FROM `students` WHERE `email` = '$login_std'");
    $row = mysqli_fetch_assoc($std_info);


    if (isset($_POST['update_profile'])) {
        $fname    = $_POST['fname'];
        $lname    = $_POST['lname'];
        $email    = $_POST['email'];
        $username = $_POST['username'];
        $phone    = $_POST['phone'];

        $update = mysqli_query($link, "UPDATE `students` SET `fname`='$fname',`lname`='$lname',`email`='$email',`username`='$username',`phone`='$phone' WHERE `email` = '$login_std'");

        if (!empty($_FILES['update_image']['name'])) {
            $update_image = explode('.', $_FILES['update_image']['name']);
            $img_extension = end($update_image);
            $img_final_name = $username.'.'.$img_extension;

            $update_img = mysqli_query($link, "UPDATE `students` SET `image`='$img_final_name' WHERE `email` = '$login_std'");

            move_uploaded_file($_FILES['update_image']['tmp_name'], '../images/students/'.$img_final_name);
        }
        
    }
?>
                <!-- content HEADER -->
                <!-- ========================================================= -->
                <div class="content-header">
                    <!-- leftside content header -->
                    <div class="leftside-content-header">
                        <ul class="breadcrumbs">
                            <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">Dashboard</a></li>
                            <li><a href="javascript:avoid(0)">Profile</a></li>
                        </ul>
                    </div>
                </div>
                <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
                <div class="row animated fadeInUp">
                    <div class="col-md-6 col-sm-offset-3">
                        <div class="panel">
                            <div class="panel-content">
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <div class="col-6 col-sm-offset-3 present-image">
                                    <img style="border-radius: 50%;" src="../images/students/<?= $row['image']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="update_image">Update Image</label>
                                        <input type="file" name="update_image" class="form-control" id="update_image" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="fname">Your First Name</label>
                                        <input type="text" name="fname" class="form-control" id="fname" value="<?= $row['fname']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="lname">Your Last Name</label>
                                        <input type="text" name="lname" class="form-control" id="lname" value="<?= $row['lname']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="roll">Your Roll No</label>
                                        <input type="text" class="form-control" id="roll" value="<?= $row['roll']; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="registration">Your Registration No</label>
                                        <input type="text" class="form-control" id="registration" value="<?= $row['registration']; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Your E-mail</label>
                                        <input type="email" name="email" class="form-control" id="email" value="<?= $row['email']; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="username">Your Username</label>
                                        <input type="text" name="username" class="form-control" id="username" value="<?= $row['username']; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Your Phone No</label>
                                        <input type="text" name="phone" class="form-control" id="phone" value="<?= $row['phone']; ?>">
                                    </div>
                                    <div class="form-group pull-right">
                                        <input type="submit" name="update_profile" class="btn btn-primary" value="Update Profile">
                                    </div>
                                </form>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--scroll to top-->
            <a href="#" class="scroll-to-top"><i class="fa fa-angle-double-up"></i></a>
        </div>
    </div>

<?php
    require_once 'footer.php';
?>
</body>
</html>