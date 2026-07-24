<?php
include 'includes/municipalities.php';

$slug = isset($_GET['slug']) ? $_GET['slug'] : '';

if (!array_key_exists($slug, $municipalities)) {
    header("Location: municipalities.php");
    exit();
}

$municipality = $municipalities[$slug];

$page = "municipalities";
$page_title = $municipality['name'];

include 'includes/header.php';
include 'includes/navbar.php';
?>

<section class="page-banner">
    <div class="container">
        <span class="eyebrow"><i class="bi bi-geo-alt-fill"></i> Municipality</span>
        <h1><?php echo htmlspecialchars($municipality['name']); ?></h1>
        <p>
            <?php echo count($municipality['barangays']); ?> barangays under the
            Municipality of <?php echo htmlspecialchars($municipality['name']); ?>.
        </p>
    </div>
</section>

<section class="municipalities-section">
    <div class="container">

        <nav class="post-breadcrumb">
            <a href="municipalities.php">&larr; Municipalities</a>
            &nbsp;/&nbsp; <?php echo htmlspecialchars($municipality['name']); ?>
        </nav>

        <div class="barangay-card-grid">
            <?php foreach ($municipality['barangays'] as $index => $barangay): ?>
            <div class="barangay-card">
                <div class="barangay-card-icon">
                    <i class="bi bi-pin-map-fill"></i>
                </div>
                <div class="barangay-card-body">
                    <span class="barangay-card-number"><?php echo str_pad($index + 1, 2, '0', STR_PAD_LEFT); ?></span>
                    <h4><?php echo htmlspecialchars($barangay); ?></h4>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<?php include 'includes/footer.php'; ?>
