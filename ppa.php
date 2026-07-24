<?php
$page = "ppa";
$page_title = "Programs, Projects & Activities";

include 'includes/header.php';
include 'includes/navbar.php';
include 'includes/db.php';

/**
 * Fetch and render the uploaded posts for one PPA category as blog-cards.
 * Falls back to an empty-state message when nothing has been published yet.
 */
function render_ppa_posts($conn, $category)
{
    $category = mysqli_real_escape_string($conn, $category);

    $query = mysqli_query($conn, "
        SELECT * FROM posts
        WHERE category = '$category'
        ORDER BY created_at DESC
    ");

    if (mysqli_num_rows($query) === 0) {
        echo '<div class="empty-state" style="grid-column:1/-1;">'
           . '<i class="bi bi-folder2-open"></i>'
           . 'No posts published in this section yet — check back soon.'
           . '</div>';
        return;
    }

    while ($row = mysqli_fetch_assoc($query)) {

        $excerpt = strip_tags($row['caption']);
        $excerpt = strlen($excerpt) > 100
            ? htmlspecialchars(substr($excerpt, 0, 100)) . '...'
            : htmlspecialchars($excerpt);
        ?>

        <div class="blog-card">

            <img src="uploads/<?php echo htmlspecialchars($row['image']); ?>"
                 alt="<?php echo htmlspecialchars($row['title']); ?>">

            <div class="blog-info">
                <span><?php echo date("F d, Y", strtotime($row['created_at'])); ?></span>
                <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                <p><?php echo $excerpt; ?></p>
                <a href="post.php?id=<?php echo (int)$row['id']; ?>">Read More</a>
            </div>

        </div>

        <?php
    }
}
?>

<section class="page-banner">
    <div class="container">
        <span><i class="bi bi-kanban-fill"></i> Programs, Projects & Activities</span>
        <h1>DILG Davao de Oro Programs, Projects & Activities</h1>
        <p>
            Strengthening local governance through responsive programs,
            innovative projects, and meaningful activities that empower
            Local Government Units across the Province of Davao de Oro.
        </p>
    </div>
</section>

<section class="ppa-section">
    <div class="container">

        <!-- ================= INTRO ================= -->
        <div class="ppa-intro">
            <h2>Provincial Office Sections</h2>
            <p>
                Select a section below to explore its Programs, Projects,
                Activities, accomplishments, announcements, and initiatives.
            </p>
        </div>

        <!-- ================= MAIN BUTTONS ================= -->
        <div class="ppa-grid">

            <button class="ppa-btn active" data-target="opd">
                <i class="bi bi-building"></i>
                <div>
                    <h3>OPD</h3>
                    <small>Office of the Provincial Director</small>
                </div>
            </button>

            <button class="ppa-btn" data-target="fas">
                <i class="bi bi-cash-stack"></i>
                <div>
                    <h3>FAS</h3>
                    <small>Finance and Administrative Section</small>
                </div>
            </button>

            <button class="ppa-btn" data-target="lgcds">
                <i class="bi bi-mortarboard-fill"></i>
                <div>
                    <h3>LGCDS</h3>
                    <small>Local Government Capacity Development Section</small>
                </div>
            </button>

            <button class="ppa-btn" data-target="lgmes">
                <i class="bi bi-graph-up-arrow"></i>
                <div>
                    <h3>LGMES</h3>
                    <small>Local Government Monitoring and Evaluation Section</small>
                </div>
            </button>

        </div>

        <!-- ====================================================== -->
        <!-- ====================== OPD ============================ -->
        <!-- ====================================================== -->
        <div id="opd" class="section-content active">

            <div class="section-header">
                <div>
                    <span class="section-tag">OFFICE</span>
                    <h2>Office of the Provincial Director</h2>
                    <p>
                        The Office of the Provincial Director provides
                        overall leadership, supervision, coordination,
                        and strategic direction in implementing the
                        Programs, Projects, and Activities of DILG
                        Davao de Oro.
                    </p>
                </div>
                <img src="uploads/OPD.png" alt="OPD">
            </div>

            <!-- SUB BUTTONS -->
            <div class="sub-buttons">
                <button class="sub-btn active" data-sub="opd-general">Office Updates</button>
                <button class="sub-btn" data-sub="pdms">Planning and Development Management Section</button>
                <button class="sub-btn" data-sub="pictu">Provincial Information and Communication Technology Unit</button>
            </div>

            <!-- ======================================= -->
            <!-- OPD GENERAL -->
            <!-- ======================================= -->
            <div id="opd-general" class="sub-content active">

                <div class="blog-banner">
                    <img src="uploads/#.png" alt="OPD General">
                </div>

                <div class="blog-content">
                    <span>OFFICE UPDATES</span>
                    <h2>Office of the Provincial Director</h2>
                    <p>
                        General announcements, activities, and initiatives
                        from the Office of the Provincial Director that are
                        not specific to PDMS or PICTU.
                    </p>
                </div>

                <div class="blog-grid">
                    <?php render_ppa_posts($conn, 'opd'); ?>
                </div>

            </div>

            <!-- ======================================= -->
            <!-- PDMS -->
            <!-- ======================================= -->
            <div id="pdms" class="sub-content">

                <div class="blog-banner">
                    <img src="uploads/Planning.png" alt="PDMS">
                </div>

                <div class="blog-content">
                    <span>FEATURED SECTION</span>
                    <h2>Planning and Development Management Section</h2>
                    <p>
                        The Planning and Development Management Section
                        facilitates planning, policy development,
                        project monitoring, strategic management,
                        and implementation of priority initiatives
                        supporting local governance.
                    </p>
                </div>

                <div class="blog-grid">
                    <?php render_ppa_posts($conn, 'pdms'); ?>
                </div>

            </div>

            <!-- ======================================= -->
            <!-- PICTU -->
            <!-- ======================================= -->
            <div id="pictu" class="sub-content">

                <div class="blog-banner">
                    <img src="images/pictu.jpg" alt="PICTU">
                </div>

                <div class="blog-content">
                    <span>FEATURED SECTION</span>
                    <h2>Provincial Information and Communication Technology Unit</h2>
                    <p>
                        The Provincial Information and Communication
                        Technology Unit (PICTU) provides ICT support,
                        system development, technical assistance,
                        network administration, digital innovation,
                        website management, multimedia production,
                        and information technology solutions for
                        DILG Davao de Oro.
                    </p>
                </div>

                <div class="blog-grid">
                    <?php render_ppa_posts($conn, 'pictu'); ?>
                </div>

            </div>

        </div>

        <!-- ================================================= -->
        <!-- ==================== FAS ========================= -->
        <!-- ================================================= -->
        <div id="fas" class="section-content">

            <div class="section-header">
                <div>
                    <span class="section-tag">SECTION</span>
                    <h2>Finance and Administrative Section</h2>
                    <p>
                        The Finance and Administrative Section
                        manages financial resources,
                        procurement,
                        budgeting,
                        accounting,
                        human resource management
                        and administrative services.
                    </p>
                </div>
                <img src="images/fas-banner.jpg" alt="FAS">
            </div>

            <div class="blog-grid">
                <?php render_ppa_posts($conn, 'fas'); ?>
            </div>

        </div>

        <!-- ================================================= -->
        <!-- =================== LGCDS ======================== -->
        <!-- ================================================= -->
        <div id="lgcds" class="section-content">

            <div class="section-header">
                <div>
                    <span class="section-tag">SECTION</span>
                    <h2>Local Government Capacity Development Section</h2>
                    <p>
                        LGCDS strengthens the capability of Local
                        Government Units through training,
                        technical assistance,
                        coaching,
                        mentoring
                        and institutional development.
                    </p>
                </div>
                <img src="images/lgcds-banner.jpg" alt="LGCDS">
            </div>

            <div class="blog-grid">
                <?php render_ppa_posts($conn, 'lgcds'); ?>
            </div>

        </div>

        <!-- ================================================= -->
        <!-- ==================== LGMES ======================= -->
        <!-- ================================================= -->
        <div id="lgmes" class="section-content">

            <div class="section-header">
                <div>
                    <span class="section-tag">SECTION</span>
                    <h2>Local Government Monitoring and Evaluation Section</h2>
                    <p>
                        LGMES is responsible for monitoring,
                        validating,
                        evaluating,
                        and assessing the implementation
                        of DILG programs, projects,
                        and initiatives across the province.
                    </p>
                </div>
                <img src="uploads/LGMES.png" alt="LGMES">
            </div>

            <div class="blog-grid">
                <?php render_ppa_posts($conn, 'lgmes'); ?>
            </div>

        </div>

    </div>
</section>

<script>
// ================= MAIN SECTION BUTTONS =================
const mainButtons = document.querySelectorAll(".ppa-btn");
const mainSections = document.querySelectorAll(".section-content");

mainButtons.forEach(button => {
    button.addEventListener("click", function () {
        mainButtons.forEach(btn => btn.classList.remove("active"));
        mainSections.forEach(sec => sec.classList.remove("active"));

        this.classList.add("active");
        document.getElementById(this.dataset.target).classList.add("active");
    });
});

// ================= OPD SUB BUTTONS =================
const subButtons = document.querySelectorAll(".sub-btn");
const subContents = document.querySelectorAll(".sub-content");

subButtons.forEach(button => {
    button.addEventListener("click", function () {
        subButtons.forEach(btn => btn.classList.remove("active"));
        subContents.forEach(sec => sec.classList.remove("active"));

        this.classList.add("active");
        document.getElementById(this.dataset.sub).classList.add("active");
    });
});
</script>

<?php include 'includes/footer.php'; ?>