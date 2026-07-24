<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include "../includes/db.php";
include "../includes/categories.php";

if (!isset($_GET['id'])) {
    header("Location: manage_posts.php");
    exit();
}

$id = (int)$_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM posts WHERE id='$id'");
$post = mysqli_fetch_assoc($result);

if (!$post) {
    die("Post not found.");
}

$error = "";

if (isset($_POST['update'])) {

    $category = $_POST['category'];

    if (!array_key_exists($category, $postCategories)) {

        $error = "Please select a valid category before saving.";

    } else {

        $title    = mysqli_real_escape_string($conn, $_POST['title']);
        $caption  = mysqli_real_escape_string($conn, $_POST['caption']);
        $content  = mysqli_real_escape_string($conn, $_POST['content']);
        $category = mysqli_real_escape_string($conn, $category);
        $author   = mysqli_real_escape_string($conn, $_POST['author']);
        $featured = isset($_POST['featured']) ? 1 : 0;

        $image = $post['image'];

        if (!empty($_FILES['image']['name'])) {

            $newImage = time() . "_" . preg_replace('/[^A-Za-z0-9\.\-_]/', '_', $_FILES['image']['name']);

            move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/" . $newImage);

            if (file_exists("../uploads/" . $post['image'])) {
                unlink("../uploads/" . $post['image']);
            }

            $image = $newImage;
        }

        $sql = "UPDATE posts SET
            title='$title',
            caption='$caption',
            content='$content',
            image='$image',
            category='$category',
            author='$author',
            featured='$featured'
            WHERE id='$id'";

        if (!mysqli_query($conn, $sql)) {
            die("MySQL Error: " . mysqli_error($conn));
        }

        header("Location: manage_posts.php?updated=1");
        exit();
    }
}

$currentCategory = $post['category'];
$currentLabel = $postCategories[$currentCategory]['label'] ?? 'Select Category';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Post</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>

<?php include "includes/sidebar.php"; ?>

<div class="main">

    <?php include "includes/topbar.php"; ?>

    <div class="content">
        <div class="row">
            <div class="col-xl-11 mx-auto">

                <a href="manage_posts.php" class="btn btn-dark">
                    <i class="bi bi-arrow-left"></i> Back
                </a>

                <div class="card edit-card">

                    <div class="card-header bg-warning text-dark py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="mb-0">
                                <i class="bi bi-pencil-square"></i>
                                Edit Post
                            </h3>
                        </div>
                    </div>

                    <div class="card-body">

                        <?php if (!empty($error)): ?>
                            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                        <?php endif; ?>

                        <form method="POST" enctype="multipart/form-data">

                            <!-- Title & Category -->
                            <div class="row g-4 mb-4">

                                <div class="col-lg-9">
                                    <label class="form-label">Title</label>
                                    <input type="text" class="form-control" name="title"
                                           value="<?php echo htmlspecialchars($post['title']); ?>">
                                </div>

                                <div class="col-lg-3">
                                    <label class="form-label">Category</label>

                                    <div class="dropdown-category">
                                        <input type="hidden" name="category" id="category"
                                               value="<?php echo htmlspecialchars($currentCategory); ?>">

                                        <div class="dropdown-btn" id="dropdownBtn">
                                            <span id="selectedText"><?php echo htmlspecialchars($currentLabel); ?></span>
                                            <span class="arrow">&#9662;</span>
                                        </div>

                                        <ul class="dropdown-menu-custom" id="dropdownMenu">

                                            <li class="menu-item" data-value="news">Latest News</li>
                                            <li class="menu-item" data-value="gad">GAD Corner</li>

                                            <li class="menu-item has-submenu">
                                                <span>PPA</span>
                                                <ul class="submenu">

                                                    <li class="menu-item has-submenu">
                                                        <span>OPD</span>
                                                        <ul class="submenu">
                                                            <li class="menu-item" data-value="opd">OPD (General)</li>
                                                            <li class="menu-item" data-value="pdms">PDMS</li>
                                                            <li class="menu-item" data-value="pictu">PICTU</li>
                                                        </ul>
                                                    </li>

                                                    <li class="menu-item" data-value="fas">FAS</li>
                                                    <li class="menu-item" data-value="lgcds">LGCDS</li>
                                                    <li class="menu-item" data-value="lgmes">LGMES</li>

                                                </ul>
                                            </li>

                                        </ul>
                                    </div>

                                </div>

                            </div>

                            <!-- Caption -->
                            <div class="mb-4">
                                <label class="form-label">Caption</label>
                                <textarea class="form-control" rows="4" name="caption"><?php echo htmlspecialchars($post['caption']); ?></textarea>
                            </div>

                            <!-- Article -->
                            <div class="mb-4">
                                <label class="form-label">Full Article</label>
                                <textarea class="form-control" rows="10" name="content"><?php echo htmlspecialchars($post['content']); ?></textarea>
                            </div>

                            <!-- Author + Image -->
                            <div class="row">

                                <div class="col-md-5">
                                    <label class="form-label">Author</label>
                                    <input type="text" class="form-control" name="author"
                                           value="<?php echo htmlspecialchars($post['author']); ?>">
                                </div>

                                <div class="col-md-7">
                                    <label class="form-label">Current Image</label>
                                    <div class="image-preview">
                                        <img src="../uploads/<?php echo htmlspecialchars($post['image']); ?>"
                                             class="img-fluid rounded" style="max-height:250px;">
                                    </div>
                                </div>

                            </div>

                            <!-- Replace Image -->
                            <div class="mt-4">
                                <label class="form-label">Replace Image</label>
                                <input type="file" name="image" class="form-control">
                                <small class="post-info">Leave blank if you don't want to change the image.</small>
                            </div>

                            <!-- Featured -->
                            <div class="form-check mt-4">
                                <input class="form-check-input" type="checkbox" name="featured" <?php if ($post['featured']) echo "checked"; ?>>
                                <label class="form-check-label">Feature this post on the homepage</label>
                            </div>

                            <hr>

                            <div class="d-flex justify-content-between">

                                <small class="text-muted">
                                    Created: <?php echo date("F d, Y h:i A", strtotime($post['created_at'])); ?>
                                </small>

                                <div>
                                    <a href="manage_posts.php" class="btn btn-secondary">Cancel</a>
                                    <button type="submit" name="update" class="btn btn-success">
                                        <i class="bi bi-check-circle"></i>
                                        Save Changes
                                    </button>
                                </div>

                            </div>

                        </form>

                    </div>

                </div>

            </div>
        </div>
    </div>

</div>

<script>
const btn    = document.getElementById("dropdownBtn");
const menu   = document.getElementById("dropdownMenu");
const text   = document.getElementById("selectedText");
const hidden = document.getElementById("category");

btn.onclick = function () {
    menu.style.display = (menu.style.display === "block") ? "none" : "block";
};

document.querySelectorAll(".menu-item").forEach(function (item) {
    item.addEventListener("click", function (e) {

        if (item.classList.contains("has-submenu")) {
            return;
        }

        hidden.value = item.dataset.value;
        text.innerHTML = item.innerText;
        menu.style.display = "none";

        e.stopPropagation();
    });
});

document.addEventListener("click", function (e) {
    if (!document.querySelector(".dropdown-category").contains(e.target)) {
        menu.style.display = "none";
    }
});
</script>

</body>
</html>