<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location:login.php");
    exit;
}

include "../includes/db.php";
include "../includes/categories.php";

$result = mysqli_query($conn, "SELECT * FROM posts ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Manage Posts</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>

<?php include "includes/sidebar.php"; ?>

<div class="main">

    <?php include "includes/topbar.php"; ?>

    <div class="content">

        <div class="d-flex justify-content-between mb-4">
            <h3>Manage Posts</h3>
            <a href="add_post.php" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i>
                Create Post
            </a>
        </div>

        <div class="card shadow">
            <div class="card-body">

                <?php if (isset($_GET['updated'])): ?>
                    <div class="alert alert-success">Post updated successfully.</div>
                <?php endif; ?>

                <?php if (isset($_GET['deleted'])): ?>
                    <div class="alert alert-danger">Post deleted successfully.</div>
                <?php endif; ?>

                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Featured</th>
                            <th>Date</th>
                            <th width="180">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td>
                                    <img src="../uploads/<?php echo htmlspecialchars($row['image']); ?>"
                                         width="90" height="60" style="object-fit:cover;border-radius:10px;">
                                </td>

                                <td>
                                    <strong><?php echo htmlspecialchars($row['title']); ?></strong>
                                    <br>
                                    <small><?php echo htmlspecialchars(substr($row['caption'], 0, 60)); ?>...</small>
                                </td>

                                <td>
                                    <?php $meta = $postCategories[$row['category']] ?? ['label' => $row['category'], 'badge' => 'bg-secondary']; ?>
                                    <span class="badge <?php echo $meta['badge']; ?>"><?php echo htmlspecialchars($meta['label']); ?></span>
                                </td>

                                <td><?php echo $row['featured'] ? "⭐" : "-"; ?></td>

                                <td><?php echo date("M d, Y", strtotime($row['created_at'])); ?></td>

                                <td>
                                    <a href="edit_post.php?id=<?php echo (int)$row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="delete_post.php?id=<?php echo (int)$row['id']; ?>"
                                       class="btn btn-danger btn-sm"
                                       onclick="return confirm('Delete this post?')">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>

            </div>
        </div>

    </div>

</div>

</body>
</html>
