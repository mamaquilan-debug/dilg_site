<?php
include 'includes/db.php';
include 'includes/categories.php';

if (!isset($_GET['id'])) {
    die("Post not found.");
}

$id = intval($_GET['id']);

$query = mysqli_query($conn, "SELECT * FROM posts WHERE id = '$id'");

if (mysqli_num_rows($query) == 0) {
    die("Post not found.");
}

$post = mysqli_fetch_assoc($query);
$category = strtolower(trim($post['category']));

$meta = $postCategories[$category] ?? [
    'label'      => ucfirst($category),
    'back_url'   => 'index.php',
    'back_label' => 'Home',
    'nav_key'    => '',
];

$backPage      = $meta['back_url'];
$backLabel     = $meta['back_label'];
$page          = $meta['nav_key'];
$categoryLabel = $meta['label'];

$page_title = $post['title'];

include 'includes/header.php';
include 'includes/navbar.php';
?>

<section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">

                <nav class="post-breadcrumb">
                    <a href="<?php echo $backPage; ?>">&larr; <?php echo htmlspecialchars($backLabel); ?></a>
                    &nbsp;/&nbsp; <?php echo htmlspecialchars($post['title']); ?>
                </nav>

                <div class="card border-0 shadow-sm">

                    <!-- IMAGE -->
                    <img src="uploads/<?php echo htmlspecialchars($post['image']); ?>"
                         class="img-fluid rounded-top"
                         alt="<?php echo htmlspecialchars($post['title']); ?>"
                         style="width:100%; max-height:500px; object-fit:cover;">

                    <div class="card-body p-5">

                        <span class="news-category"><?php echo htmlspecialchars($categoryLabel); ?></span>
                        <small class="text-muted ms-2"><?php echo date("F d, Y", strtotime($post['created_at'])); ?></small>

                        <h2 class="fw-bold mt-3 mb-3"><?php echo htmlspecialchars($post['title']); ?></h2>

                        <p class="text-muted mb-4">By <?php echo htmlspecialchars($post['author']); ?></p>

                        <!-- Caption -->
                        <?php if (!empty($post['caption'])): ?>
                            <p class="lead"><?php echo nl2br(htmlspecialchars($post['caption'])); ?></p>
                        <?php endif; ?>

                        <hr>

                        <!-- Full Story -->
                        <div style="font-size:17px; line-height:1.9;">
                            <?php echo nl2br(htmlspecialchars($post['content'])); ?>
                        </div>

                        <div class="mt-5">
                            <a href="<?php echo $backPage; ?>" class="btn btn-primary">
                                &larr; Back to <?php echo htmlspecialchars($backLabel); ?>
                            </a>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
