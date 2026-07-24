<?php
$page = "news";
$page_title = "Latest News";

include 'includes/header.php';
include 'includes/navbar.php';
include 'includes/db.php';

$query = mysqli_query($conn, "
    SELECT * FROM posts
    WHERE category = 'news'
    ORDER BY created_at DESC
");
?>

<section class="page-banner">
    <div class="container">
        <span class="eyebrow"><i class="bi bi-megaphone"></i> Announcements</span>
        <h1>Latest News</h1>
        <p>
            Stay updated with the latest news, announcements,
            and activities of DILG Davao de Oro.
        </p>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <div class="row g-4">

            <?php if (mysqli_num_rows($query) > 0): ?>

                <?php while ($row = mysqli_fetch_assoc($query)): ?>

                    <div class="col-lg-4 col-md-6">
                        <div class="news-card">

                            <div class="news-image">
                                <img src="uploads/<?php echo htmlspecialchars($row['image']); ?>"
                                     alt="<?php echo htmlspecialchars($row['title']); ?>">
                            </div>

                            <div class="news-content">

                                <span class="news-category">Latest News</span>
                                <span class="news-date"><?php echo date("F d, Y", strtotime($row['created_at'])); ?></span>

                                <h3><?php echo htmlspecialchars($row['title']); ?></h3>

                                <p>
                                    <?php
                                    $excerpt = strip_tags($row['caption']);
                                    echo strlen($excerpt) > 120
                                        ? htmlspecialchars(substr($excerpt, 0, 120)) . "..."
                                        : htmlspecialchars($excerpt);
                                    ?>
                                </p>

                                <a href="post.php?id=<?php echo (int)$row['id']; ?>" class="read-more">
                                    Read Full Story <i class="bi bi-arrow-right"></i>
                                </a>

                            </div>

                        </div>
                    </div>

                <?php endwhile; ?>

            <?php else: ?>

                <div class="col-12">
                    <div class="empty-state">
                        <i class="bi bi-newspaper"></i>
                        No news posts published yet — check back soon.
                    </div>
                </div>

            <?php endif; ?>

        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
