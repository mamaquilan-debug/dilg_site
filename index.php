<?php
$page = "home";
$page_title = "Home";

include 'includes/header.php';
include 'includes/navbar.php';
include 'includes/db.php';
include 'includes/categories.php';
include 'includes/municipalities.php';

// Featured posts for the homepage — pulled live instead of hardcoded
$featuredQuery = mysqli_query($conn, "
    SELECT * FROM posts
    WHERE featured = 1
    ORDER BY created_at DESC
    LIMIT 3
");
?>

<!-- HERO SECTION -->
<section class="hero">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-lg-6">

                <span class="eyebrow">
                    <i class="bi bi-shield-check"></i>
                    Republic of the Philippines
                </span>

                <h1 class="display-4 fw-bold mt-3">DILG Davao de Oro</h1>

                <p class="lead text-muted mt-3">
                    The Department of the Interior and Local Government
                    is committed to promoting peace, public safety,
                    local autonomy, and good governance throughout
                    the Province of Davao de Oro.
                </p>

                <div class="d-flex flex-wrap gap-3 mt-4">
                    <a href="latest_news.php" class="btn btn-primary btn-lg">Explore Latest News</a>
                    <a href="about.php" class="btn btn-outline-primary btn-lg">About the Department</a>
                </div>

            </div>

            <div class="col-lg-6">
                <div class="hero-media">

                    <img src="images/featured.jpg" class="img-fluid rounded-4 shadow-lg" alt="DILG Davao de Oro">

                    <div class="hero-badge">
                        <div class="icon"><i class="bi bi-geo-alt-fill"></i></div>
                        <div class="text">
                            <strong>11 Municipalities</strong>
                            <span>Served across the province</span>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

<!-- PROVINCIAL COVERAGE (signature strip) -->
<section class="coverage-strip">
    <div class="container">

        <span class="eyebrow">
            <i class="bi bi-signpost-split"></i>
            Provincial Coverage
        </span>

        <div class="coverage-list mt-3">
            <?php foreach ($municipalities as $slug => $m): ?>
                <?php $label = $slug === 'nabunturan' ? $m['name'] . ' (Capital)' : $m['name']; ?>
                <a href="municipality.php?slug=<?php echo urlencode($slug); ?>" class="coverage-chip">
                    <i class="bi bi-geo-alt"></i> <?php echo htmlspecialchars($label); ?>
                </a>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<!-- FEATURED NEWS -->
<section class="py-5 bg-light">
    <div class="container">

        <div class="text-center mb-5">
            <span class="eyebrow d-block mb-2"><i class="bi bi-star-fill"></i> Featured</span>
            <h2 class="fw-bold">Featured News</h2>
            <p class="text-muted">Stay updated with the latest activities and announcements.</p>
        </div>

        <div class="row g-4">

            <?php if (mysqli_num_rows($featuredQuery) > 0): ?>

                <?php while ($row = mysqli_fetch_assoc($featuredQuery)): ?>
                    <?php $categoryLabel = $postCategories[$row['category']]['label'] ?? ucfirst($row['category']); ?>

                    <div class="col-md-4">
                        <div class="news-card">

                            <div class="news-image">
                                <img src="uploads/<?php echo htmlspecialchars($row['image']); ?>"
                                     alt="<?php echo htmlspecialchars($row['title']); ?>">
                            </div>

                            <div class="news-content">

                                <span class="news-category"><?php echo htmlspecialchars($categoryLabel); ?></span>
                                <span class="news-date"><?php echo date("F d, Y", strtotime($row['created_at'])); ?></span>

                                <h3><?php echo htmlspecialchars($row['title']); ?></h3>

                                <p>
                                    <?php
                                    $excerpt = strip_tags($row['caption']);
                                    echo strlen($excerpt) > 110
                                        ? htmlspecialchars(substr($excerpt, 0, 110)) . "..."
                                        : htmlspecialchars($excerpt);
                                    ?>
                                </p>

                                <a href="post.php?id=<?php echo (int)$row['id']; ?>" class="read-more">
                                    Read More <i class="bi bi-arrow-right"></i>
                                </a>

                            </div>

                        </div>
                    </div>

                <?php endwhile; ?>

            <?php else: ?>

                <div class="col-12">
                    <div class="empty-state">
                        <i class="bi bi-newspaper"></i>
                        No featured posts yet — check back soon.
                    </div>
                </div>

            <?php endif; ?>

        </div>

    </div>
</section>

<!-- QUICK LINKS -->
<section class="py-5 quick-links">
    <div class="container">
        <div class="row g-4">

            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm text-center p-4">
                    <div class="icon-circle"><i class="bi bi-newspaper"></i></div>
                    <h5>Latest News</h5>
                    <a href="latest_news.php" class="stretched-link"></a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm text-center p-4">
                    <div class="icon-circle"><i class="bi bi-people-fill"></i></div>
                    <h5>GAD Corner</h5>
                    <a href="gad_corner.php" class="stretched-link"></a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm text-center p-4">
                    <div class="icon-circle"><i class="bi bi-building"></i></div>
                    <h5>About Us</h5>
                    <a href="about.php" class="stretched-link"></a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm text-center p-4">
                    <div class="icon-circle"><i class="bi bi-facebook"></i></div>
                    <h5>Facebook</h5>
                    <a href="https://facebook.com" class="stretched-link" target="_blank" rel="noopener"></a>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ABOUT PREVIEW -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-lg-6">
                <img src="images/about.jpg" class="img-fluid rounded-4 shadow" alt="About DILG Davao de Oro">
            </div>

            <div class="col-lg-6">
                <span class="eyebrow"><i class="bi bi-info-circle"></i> Who we are</span>
                <h2 class="fw-bold mt-2">About DILG</h2>
                <p class="text-muted mt-3">
                    The Department of the Interior and Local Government
                    serves as the primary catalyst for excellence
                    in local governance, promoting peace,
                    accountability, transparency, and sustainable
                    development among local government units.
                </p>
                <a href="about.php" class="read-more">Learn More <i class="bi bi-arrow-right"></i></a>
            </div>

        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>