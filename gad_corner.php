<?php
$page = "gad";
$page_title = "GAD Corner";

include 'includes/header.php';
include 'includes/navbar.php';
include 'includes/db.php';

$query = mysqli_query($conn, "
    SELECT * FROM posts
    WHERE category = 'gad'
    ORDER BY created_at DESC
");
?>

<section class="page-banner">
    <div class="container">
        <span class="eyebrow"><i class="bi bi-people"></i> Gender and Development</span>
        <h1>GAD Corner</h1>
        <p>
            Stay updated with the happenings of GAD Corner
            and activities of DILG Davao de Oro.
        </p>
    </div>
</section>

<section class="gad-introduction">
    <div class="gad-wave"></div>

    <div class="container">
        <div class="gad-info">

            <div class="gad-icon">
                <i class="bi bi-gender-ambiguous"></i>
            </div>

            <div>
                <h2>Gender and Development Corner</h2>
                <p>
                    The Gender and Development (GAD) Corner of DILG Davao de Oro
                    serves as a platform that promotes gender equality,
                    inclusivity, and awareness. It provides updates,
                    activities, and initiatives that support women's empowerment,
                    equal opportunities, and responsive governance.
                </p>
            </div>

        </div>
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

                                <span class="news-category">GAD Corner</span>
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
                        <i class="bi bi-people"></i>
                        No GAD Corner posts published yet — check back soon.
                    </div>
                </div>

            <?php endif; ?>

        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
