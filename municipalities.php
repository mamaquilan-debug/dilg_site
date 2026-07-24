<?php
$page = "municipalities";
$page_title = "Municipalities";

include 'includes/header.php';
include 'includes/navbar.php';
include 'includes/municipalities.php';

$totalBarangays = 0;
foreach ($municipalities as $m) {
    $totalBarangays += count($m['barangays']);
}
?>

<section class="page-banner">
    <div class="container">
        <span class="eyebrow"><i class="bi bi-signpost-split"></i> Local Government Units</span>
        <h1>Municipalities of Davao de Oro</h1>
        <p>
            The Province of Davao de Oro is composed of eleven (11) municipalities,
            home to <?php echo $totalBarangays; ?> barangays in total. Select a
            municipality below to view its barangays.
        </p>
    </div>
</section>

<section class="municipalities-section">
    <div class="container">
        <div class="row g-4">

            <?php foreach ($municipalities as $slug => $m): ?>

                <div class="col-lg-4 col-md-6">
                    <a href="municipality.php?slug=<?php echo urlencode($slug); ?>" class="municipality-card">

                        <div class="municipality-card-icon">
                            <i class="bi bi-geo-alt-fill"></i>
                        </div>

                        <div class="municipality-card-body">
                            <h3><?php echo htmlspecialchars($m['name']); ?></h3>
                            <p><?php echo count($m['barangays']); ?> barangays</p>
                        </div>

                        <i class="bi bi-arrow-right municipality-card-arrow"></i>

                    </a>
                </div>

            <?php endforeach; ?>

        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
