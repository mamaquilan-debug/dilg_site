<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include "../includes/db.php";

// Statistics
$totalPosts    = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM posts"));
$totalNews     = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM posts WHERE category='news'"));
$totalGad      = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM posts WHERE category='gad'"));
$totalOpd      = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM posts WHERE category='opd'"));
$totalPdms      = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM posts WHERE category='pdms'"));
$totalPictu      = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM posts WHERE category='pictu'"));
$totalFas      = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM posts WHERE category='fas'"));
$totalLgcds      = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM posts WHERE category='lgcds'"));
$totalLgmes      = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM posts WHERE category='lgmes'"));
$totalFeatured = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM posts WHERE featured=1"));

$recentPosts = mysqli_query($conn, "SELECT * FROM posts ORDER BY created_at DESC LIMIT 5");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard | DILG CMS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>

<?php include "includes/sidebar.php"; ?>

<div class="main">

    <?php include "includes/topbar.php"; ?>

    <div class="content">

        <h2 class="mb-4 fw-bold">Dashboard</h2>

        <div class="row g-4">

            <div class="col-md-3">
                <div class="card card-box shadow">
                    <div class="card-body">
                        <h6 class="text-muted">Featured</h6>
                        <h2><?php echo $totalFeatured; ?></h2>
                        <i class="bi bi-star-fill fs-1 text-danger"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card card-box shadow">
                    <div class="card-body">
                        <h6 class="text-muted">Total Posts</h6>
                        <h2><?php echo $totalPosts; ?></h2>
                        <i class="bi bi-newspaper fs-1 text-primary"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card card-box shadow">
                    <div class="card-body">
                        <h6 class="text-muted">Latest News</h6>
                        <h2><?php echo $totalNews; ?></h2>
                        <i class="bi bi-megaphone fs-1 text-success"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card card-box shadow">
                    <div class="card-body">
                        <h6 class="text-muted">GAD Posts</h6>
                        <h2><?php echo $totalGad; ?></h2>
                        <i class="bi bi-people-fill fs-1 text-warning"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card card-box shadow">
                    <div class="card-body">
                        <h6 class="text-muted">OPD Posts</h6>
                        <h2><?php echo $totalOpd; ?></h2>
                        <i class="bi bi-building fs-1 text-info"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card card-box shadow">
                    <div class="card-body">
                        <h6 class="text-muted">PDMS Posts</h6>
                        <h2><?php echo $totalPdms; ?></h2>
                        <i class="bi bi-file-earmark-text fs-1 text-secondary"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card card-box shadow">
                    <div class="card-body">
                        <h6 class="text-muted">PICTU Posts</h6>
                        <h2><?php echo $totalPictu; ?></h2>
                        <i class="bi bi-motherboard fs-1 text-secondary"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card card-box shadow">
                    <div class="card-body">
                        <h6 class="text-muted">FAS Posts</h6>
                        <h2><?php echo $totalFas; ?></h2>
                        <i class="bi bi-gear fs-1 text-secondary"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card card-box shadow">
                    <div class="card-body">
                        <h6 class="text-muted">LGCDS Posts</h6>
                        <h2><?php echo $totalLgcds; ?></h2>
                        <i class="bi bi-building fs-1 text-secondary"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card card-box shadow">
                    <div class="card-body">
                        <h6 class="text-muted">LGMES Posts</h6>
                        <h2><?php echo $totalLgmes; ?></h2>
                        <i class="bi bi-building fs-1 text-secondary"></i>
                    </div>
                </div>
            </div>

        </div>

        <br><br>

        <div class="card shadow">

            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Recent Posts</h5>
            </div>

            <div class="card-body">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($post = mysqli_fetch_assoc($recentPosts)): ?>
                            <tr>
                                <td>
                                    <img src="../uploads/<?php echo htmlspecialchars($post['image']); ?>"
                                         width="90" style="border-radius:10px; object-fit:cover;">
                                </td>
                                <td><strong><?php echo htmlspecialchars($post['title']); ?></strong></td>
                                <td>
                                    <?php if ($post['category'] == "news"): ?>
                                        <span class="badge bg-primary">News</span>
                                    <?php elseif ($post['category'] == "gad"): ?>
                                        <span class="badge bg-success">GAD</span>
                                    <?php elseif ($post['category'] == "opd"): ?>
                                        <span class="badge bg-primary">OPD</span>
                                    <?php elseif ($post['category'] == "pdms"): ?>
                                        <span class="badge bg-info text-dark">PDMS</span>
                                    <?php elseif ($post['category'] == "pictu"): ?>
                                        <span class="badge bg-info text-dark">PICTU</span>
                                    <?php elseif ($post['category'] == "fas"): ?>
                                        <span class="badge bg-warning text-dark">FAS</span>
                                    <?php elseif ($post['category'] == "lgcds"): ?>
                                        <span class="badge bg-secondary">LGCDS</span>
                                    <?php elseif ($post['category'] == "lgmes"): ?>
                                        <span class="badge bg-dark">LGMES</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary"><?php echo htmlspecialchars($post['category']); ?></span
                                    <?php endif; ?>
                                </td>
                                <td><?php echo date("M d, Y", strtotime($post['created_at'])); ?></td>
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
