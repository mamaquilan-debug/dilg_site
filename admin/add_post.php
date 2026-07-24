<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include "../includes/db.php";
include "../includes/categories.php";

$success = "";
$error   = "";

if (isset($_POST['publish'])) {

    $category = $_POST['category'];

    if (!array_key_exists($category, $postCategories)) {

        $error = "Please select a valid category before publishing.";

    } else {

        $title    = mysqli_real_escape_string($conn, $_POST['title']);
        $caption  = mysqli_real_escape_string($conn, $_POST['caption']);
        $content  = mysqli_real_escape_string($conn, $_POST['content']);
        $category = mysqli_real_escape_string($conn, $category);
        $author   = mysqli_real_escape_string($conn, $_POST['author']);
        $featured = isset($_POST['featured']) ? 1 : 0;

        $image = $_FILES['image']['name'];
        $tmp   = $_FILES['image']['tmp_name'];

        $newImage  = time() . '_' . preg_replace('/[^A-Za-z0-9\.\-_]/', '_', $image);
        $uploadDir = "../uploads/";

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        move_uploaded_file($tmp, $uploadDir . $newImage);

        $inserted = mysqli_query($conn, "
            INSERT INTO posts (title, caption, content, image, category, featured, author)
            VALUES ('$title', '$caption', '$content', '$newImage', '$category', '$featured', '$author')
        ");

        if ($inserted) {
            $success = "Post published successfully!";
        } else {
            $error = "Could not publish this post: " . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Add Post</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/admin.css">
</head>
<body class="bg-light">

<?php include 'includes/sidebar.php'; ?>

<div class="main">

    <?php include 'includes/topbar.php'; ?>

    <div class="content">

        <div class="card shadow-lg border-0 rounded-4">

            <div class="card-header bg-primary text-white">
                <h3><i class="bi bi-pencil-square"></i> Create New Post</h3>
            </div>

            <div class="card-body">

                <?php if (!empty($success)): ?>
                    <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
                <?php endif; ?>

                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>

                <form method="POST" enctype="multipart/form-data">

                    <div class="row">

                        <div class="col-md-8">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Category</label>

                            <div class="dropdown-category">
                                <input type="hidden" name="category" id="category" value="">

                                <div class="dropdown-btn" id="dropdownBtn">
                                    <span id="selectedText">Select Category</span>
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

                    <br>

                    <label>Caption</label>
                    <textarea name="caption" rows="3" class="form-control" required></textarea>

                    <br>

                    <label>Full Article</label>
                    <textarea name="content" rows="12" class="form-control" required></textarea>

                    <br>

                    <div class="row">

                        <div class="col-md-6">
                            <label>Author</label>
                            <input type="text" name="author" value="DILG Davao de Oro" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label>Featured Image</label>
                            <input type="file" name="image" accept="image/*" class="form-control" required>
                        </div>

                    </div>

                    <br>

                    <div class="form-check">
                        <input type="checkbox" name="featured" class="form-check-input">
                        <label class="form-check-label">Set as Featured Post</label>
                    </div>

                    <br>

                    <button class="btn btn-primary btn-lg" name="publish">
                        <i class="bi bi-upload"></i>
                        Publish Post
                    </button>

                </form>

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