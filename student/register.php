<?php
  
    require_once '../dbcon.php';
    session_start();
    if(isset($_SESSION['student_login'])){
        header("location: index.php");
    }

  if (isset($_POST['register'])) {
    $fname        = $_POST['fname'];
    $lname        = $_POST['lname'];
    $roll         = $_POST['roll'];
    $registration = $_POST['registration'];
    $email        = $_POST['email'];
    $username     = $_POST['username'];
    $password     = $_POST['password'];
    $phone        = $_POST['phone'];

    $user_image = explode('.', $_FILES['image']['name']);
    $img_extension = end($user_image);
    $img_final_name = $username.'.'.$img_extension;

    $empty_errors = array();

    if (empty($fname)) {
        $empty_errors['fname'] = "<span class='text-danger'>First name field must not be empty!</span>";
    }
    if (empty($lname)) {
        $empty_errors['lname'] = "<span class='text-danger'>Last name field must not be empty!</span>";
    }
    if (empty($roll)) {
        $empty_errors['roll'] = "<span class='text-danger'>Roll field must not be empty!</span>";
    }
    if (empty($registration)) {
        $empty_errors['registration'] = "<span class='text-danger'>Registration field must not be empty!</span>";
    }
    if (empty($email)) {
        $empty_errors['email'] = "<span class='text-danger'>Email field must not be empty!</span>";
    }
    if (empty($username)) {
        $empty_errors['username'] = "<span class='text-danger'>Username field must not be empty!</span>";
    }
    if (empty($password)) {
        $empty_errors['password'] = "<span class='text-danger'>Password field must not be empty!</span>";
    }
    if (empty($phone)) {
        $empty_errors['phone'] = "<span class='text-danger'>Phone field must not be empty!</span>";
    }

    if (count($empty_errors) == 0) {

        $email_check = mysqli_query($link, "SELECT * FROM `students` WHERE `email` = '$email'");
        $email_check_row = mysqli_num_rows($email_check);

        if ($email_check_row == 0) {

            $username_check = mysqli_query($link, "SELECT * FROM `students` WHERE `username` = '$username'");
            $username_check_row = mysqli_num_rows($username_check);
            if ($username_check_row == 0) {
                if (strlen($username) > 7) {
                    if (strlen($password) > 5) {
                        $password_md5 = md5($password);
                        $result = mysqli_query($link, "INSERT INTO `students`(`fname`, `lname`, `image`, `roll`, `registration`, `email`, `username`, `password`, `status`, `phone`) VALUES ('$fname', '$lname', '$img_final_name', '$roll', '$registration', '$email', '$username', '$password_md5', '0', '$phone')");

                        if ($result) {
                            move_uploaded_file($_FILES['image']['tmp_name'], '../images/students/'.$img_final_name);
                            $success = "<span><strong>Success!</strong> You are registered!</span>";
                            
                        } else {
                            $error = "<span><strong>Error !</strong> Somtging wrong!</span>";
                        }
                    } else {
                        $username_exists = "<span>Password more than 6 charecters.</span>";
                    }
                } else {
                    $username_exists = "<span>Username more than 8 charecters.</span>";
                }
            } else {
                $username_exists = "<span>This username already exists.</span>";
            }
        } else {
            $email_exists = "<span>This email already exists.</span>";
        }
        
    }


  }
?>

<!DOCTYPE html>
<html lang="en" class="fixed accounts sign-in">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Student Registration</title>
    <link rel="apple-touch-icon" sizes="120x120" href="../assets/favicon/apple-icon-120x120.png">
    <link rel="icon" type="image/png" sizes="192x192" href="../assets/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/favicon/favicon-16x16.png">
    <!--BASIC css-->
    <!-- ========================================================= -->
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/vendor/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="../assets/vendor/animate.css/animate.css">
    <!--SECTION css-->
    <!-- ========================================================= -->
    <!--TEMPLATE css-->
    <!-- ========================================================= -->
    <link rel="stylesheet" href="../assets/stylesheets/css/style.css">
</head>

<body>
<div class="wrap">
    <!-- page BODY -->
    <!-- ========================================================= -->
    <div class="page-body animated slideInDown">
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <!--LOGO-->
        <div class="logo">
            <h2 class="text-center">Student Registration</h2>
            
            <?php
                if (isset($success)) {   
            ?> 
                <div class="alert alert-success" role="alert">
                    <?= $success ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    

            <?php
                }
            ?>

            <?php
                if (isset($error)) {   
            ?> 
                <div class="alert alert-danger" role="alert">
                    <?= $error ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    

            <?php
                }
            ?>

            <?php
                if (isset($email_exists)) {   
            ?> 
                <div class="alert alert-danger" role="alert">
                    <?= $email_exists ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    

            <?php
                }
            ?>

            <?php
                if (isset($username_exists)) {   
            ?> 
                <div class="alert alert-danger" role="alert">
                    <?= $username_exists ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    

            <?php
                }
            ?>
            
        </div>
        <div class="box">
            <!--SIGN IN FORM-->
            <div class="panel mb-none">
                <div class="panel-content bg-scale-0">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="text" class="form-control" name="fname" placeholder="First Name" value="<?= isset($fname) ? $fname: ''; ?>">
                                <i class="fa fa-user"></i>
                            </span>
                            <?php
                                if (isset($empty_errors['fname'])) {
                                    echo $empty_errors['fname'];
                                }
                            ?>
                        </div>
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="text" class="form-control" name="lname" placeholder="Last Name" value="<?= isset($lname) ? $lname: ''; ?>">
                                <i class="fa fa-user"></i>
                            </span>
                            <?php
                                if (isset($empty_errors['lname'])) {
                                    echo $empty_errors['lname'];
                                }
                            ?>
                        </div>
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="file" class="form-control" name="image">
                                <i class="fa fa-user"></i>
                            </span>
                        </div>
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="text" class="form-control" name="roll" placeholder="Roll number" value="<?= isset($roll) ? $roll: ''; ?>">
                                <i class="fa fa-user"></i>
                            </span>
                            <?php
                                if (isset($empty_errors['roll'])) {
                                    echo $empty_errors['roll'];
                                }
                            ?>
                        </div>
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="text" class="form-control" name="registration" placeholder="Registration numbser" value="<?= isset($registration) ? $registration: ''; ?>">
                                <i class="fa fa-user"></i>
                            </span>
                            <?php
                                if (isset($empty_errors['registration'])) {
                                    echo $empty_errors['registration'];
                                }
                            ?>
                        </div>
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="email" class="form-control" name="email" placeholder="Email" value="<?= isset($email) ? $email: ''; ?>">
                                <i class="fa fa-envelope"></i>
                            </span>
                            <?php
                                if (isset($empty_errors['email'])) {
                                    echo $empty_errors['email'];
                                }
                            ?>
                        </div>
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="text" class="form-control" name="username" placeholder="Username" value="<?= isset($username) ? $username: ''; ?>">
                                <i class="fa fa-university"></i>
                            </span>
                            <?php
                                if (isset($empty_errors['username'])) {
                                    echo $empty_errors['username'];
                                }
                            ?>
                        </div>
                        <div class="form-group">
                            <span class="input-with-icon">
                                <input type="text" class="form-control" name="password" placeholder="Password" value="<?= isset($password) ? $password: ''; ?>">
                                <i class="fa fa-key"></i>
                            </span>
                            <?php
                                if (isset($empty_errors['password'])) {
                                    echo $empty_errors['password'];
                                }
                            ?>
                        </div>
                        <div class="form-group">
                            <span class="input-with-icon">
                                <input type="text" class="form-control" name="phone" placeholder="01*********" value="<?= isset($phone) ? $phone: ''; ?>">
                                <i class="fa fa-mobile"></i>
                            </span>
                            <?php
                                if (isset($empty_errors['phone'])) {
                                    echo $empty_errors['phone'];
                                }
                            ?>
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary btn-block" type="submit" value="Register" name="register">
                        </div>
                        <div class="form-group text-center">
                            Have an account?, <a href="login.php">Sign In</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    </div>
</div>
<!--BASIC scripts-->
<!-- ========================================================= -->
<script src="../assets/vendor/jquery/jquery-1.12.3.min.js"></script>
<script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="../assets/vendor/nano-scroller/nano-scroller.js"></script>
<!--TEMPLATE scripts-->
<!-- ========================================================= -->
<script src="../assets/javascripts/template-script.min.js"></script>
<script src="../assets/javascripts/template-init.min.js"></script>
<!-- SECTION script and examples-->
<!-- ========================================================= -->

</body>
</html>
