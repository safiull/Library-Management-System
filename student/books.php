<?php
    require_once 'header.php';
?>
                <!-- content HEADER -->
                <!-- ========================================================= -->
                <div class="content-header">
                    <!-- leftside content header -->
                    <div class="leftside-content-header">
                        <ul class="breadcrumbs">
                            <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">Dashboard</a></li>
                            <li><a href="#">Books</a></li>
                        </ul>
                    </div>
                </div>
                <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
                <div class="row animated fadeInUp">
                    <div class="col-sm-12">
                        <div class="panel">
                            <div class="panel-content">
                                <form method="POST" action="">
                                    <div class="row pt-md">
                                        <div class="form-group col-sm-9 col-lg-10">
                                                <span class="input-with-icon">
                                            <input name="search_result" type="text" class="form-control" id="lefticon" placeholder="Search" required="">
                                            <i class="fa fa-search"></i>
                                        </span>
                                        </div>
                                        <div class="form-group col-sm-3  col-lg-2 ">
                                            <button name="search_name" type="submit" class="btn btn-primary btn-block">Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <?php
                        if (isset($_POST['search_name'])) {
                            $search_result = $_POST['search_result'];
                            ?>
                            <div class="col-sm-12">
                                <div class="panel">
                                    <div class="panel-content">
                                        <div class="row">
                                            <?php
                                                $result = mysqli_query($link, "SELECT * FROM `books` WHERE `book_name` LIKE '%$search_result%'");
                                                $temp = mysqli_num_rows($result);
                                                if ($temp > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                                  
                                                    ?>
                                                        <div class="col-sm-3 col-md-2 text-center">
                                                            <img style="width: 100px; height: 150px;" class="img-fluid" src="../images/books/<?= $row['book_image'] ?>">
                                                            <p style="margin: 0px; padding: 0;"><?= $row['book_name'] ?></p>
                                                            <b>Available : <?= $row['available_qty'] ?></b>
                                                        </div>
                                                <?php 
                                                        } 
                                                    } else {
                                                        echo "<h3 style='margin-left: 20px;' class='text-danger'>Books Not found !<h3>";
                                                    }
                                                ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        } else {
                            ?>
                            <div class="col-sm-12">
                                <div class="panel">
                                    <div class="panel-content">
                                        <div class="row">
                                            <?php
                                                $result = mysqli_query($link, "SELECT * FROM `books`");
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                          
                                            ?>
                                                <div class="col-sm-3 col-md-2 text-center">
                                                    <img style="width: 100px; height: 150px;" class="img-fluid" src="../images/books/<?= $row['book_image'] ?>">
                                                    <p style="margin: 0px; padding: 0;"><?= $row['book_name'] ?></p>
                                                    <b>Available : <?= $row['available_qty'] ?></b>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                            }
                        ?>
                    
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