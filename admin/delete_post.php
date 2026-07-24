<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include "../includes/db.php";

$id = (int)$_GET['id'];

$result = mysqli_query($conn, "SELECT image FROM posts WHERE id='$id'");
$post = mysqli_fetch_assoc($result);

if ($post) {

    if (file_exists("../uploads/" . $post['image'])) {
        unlink("../uploads/" . $post['image']);
    }

    mysqli_query($conn, "DELETE FROM posts WHERE id='$id'");
}

header("Location: manage_posts.php?deleted=1");
exit();
