<?php
    require_once 'header.php';

    if(isset($_POST['save_book'])){
        $book_name             = $_POST['book_name'];
        $book_author_name      = $_POST['book_author_name'];
        $book_publication_name = $_POST['book_publication_name'];
        $book_purchase_date    = $_POST['book_purchase_date'];
        $book_price            = $_POST['book_price'];
        $book_qty              = $_POST['book_qty'];
        $available_qty         = $_POST['available_qty'];
        $librarian_name        = $_SESSION["librarian_username"];


        $book_image = explode('.', $_FILES['book_image']['name']);
        $img_extension = end($book_image);
        $img_final_name = $book_name.'.'.$img_extension;

        $result = mysqli_query($link, "INSERT INTO `books`(`book_name`, `book_image`, `book_author_name`, `book_publication_name`, `book_purchase_date`, `book_price`, `book_qty`, `available_qty`, `librarian_username`) VALUES ('$book_name', '$img_final_name', '$book_author_name', '$book_publication_name', '$book_purchase_date', '$book_price', '$book_qty', '$available_qty', '$librarian_name')");
        if ($result) {
            move_uploaded_file($_FILES['book_image']['tmp_name'], '../images/books/'.$img_final_name);
            $success = "Book inserted succefully";
        } else {
            $error = "Something wrong";
        }
    }
?>
                <!-- content HEADER -->
                <!-- ========================================================= -->
                <div class="content-header">
                    <!-- leftside content header -->
                    <div class="leftside-content-header">
                        <ul class="breadcrumbs">
                            <li><i class="fa fa-home" aria-hidden="true"></i><a href="index.php">Dashboard</a></li>
                            <li><a href="javascript:avoid(0)">Add Book</a></li>
                        </ul>
                    </div>
                </div>
                <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
                <div class="row animated fadeInUp">
                    <div class="col-md-8 col-sm-offset-2">
                    <div class="panel">
                        <div class="panel-content">
                            <div class="row">
                                <div class="col-md-12">
                                    <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">


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


                                        <h3 class="mb-lg text-center">Add Book</h3>
                                        <div class="form-group">
                                            <label for="book_name" class="col-sm-4 control-label">Book Name</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="book_name" placeholder="Book Name" name="book_name" required=''>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="book_image" class="col-sm-4 control-label">Book Image</label>
                                            <div class="col-sm-8">
                                                <input type="file" class="form-control" id="book_image" placeholder="Book Image" name="book_image" required=''>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="book_author_name" class="col-sm-4 control-label">Author name</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="book_author_name" placeholder="Book Author Name" name="book_author_name" required=''>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="book_publication_name" class="col-sm-4 control-label">Publication name</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="book_publication_name" placeholder="Book Publication Name" name="book_publication_name" required=''>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="book_purchase_date" class="col-sm-4 control-label">Purchase Date</label>
                                            <div class="col-sm-8">
                                                <input type="date" class="form-control" id="book_purchase_date" placeholder="Purchase Date" name="book_purchase_date" required=''>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="book_price" class="col-sm-4 control-label">Book Price</label>
                                            <div class="col-sm-8">
                                                <input type="number" class="form-control" id="book_price" placeholder="Book Price" name="book_price" required=''>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="book_qty" class="col-sm-4 control-label">Book Quantity</label>
                                            <div class="col-sm-8">
                                                <input type="number" class="form-control" id="book_qty" placeholder="Book Quantity" name="book_qty" required=''>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="available_qty" class="col-sm-4 control-label">Available Quantity</label>
                                            <div class="col-sm-8">
                                                <input type="number" class="form-control" id="available_qty" placeholder="Available Quantity" name="available_qty" required=''>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-4 col-sm-10">
                                                <button class="btn btn-primary" name="save_book" type="submit"><i class="fa fa-save"></i> Save Book</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
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