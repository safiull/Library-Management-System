<?php

require_once '../dbcon.php';
if (isset($_GET['deletebook'])) {
	$id = base64_decode($_GET['deletebook']);
	$book_delete_success = mysqli_query($link, "DELETE FROM `books` WHERE `id` = '$id'");
	header("location: manage_books.php");

}