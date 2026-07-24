<?php
/**
 * about.php
 * DILG Mission, Vision, Core Values, and Quality Policy
 */

$page = "about";
$page_title = "About Us";

include 'includes/header.php';
include 'includes/navbar.php';

$mission = "The Department shall ensure peace and order, public safety and security, uphold excellence in local governance, and enable resilient and inclusive communities.";

$vision = "A highly trusted Department and Partner in nurturing local governments and sustaining peaceful, safe, progressive, resilient, and inclusive communities towards a comfortable and secure life for Filipinos by 2040.";

$core_values = [
    [
        "letter" => "I",
        "title"  => "Integrity",
        "desc"   => "Is manifested through consistent practice of decency in behaviour, honesty in all dealings and fairness in discernment",
    ],
    [
        "letter" => "C",
        "title"  => "Commitment",
        "desc"   => "Is that sense of responsibility that each personnel has towards the delivery of DILG's mission and the achievements of its objectives and vision.",
    ],
    [
        "letter" => "T",
        "title"  => "Teamwork",
        "desc"   => "Is that sense of contribution that promotes cooperative and coordinated efforts toward working as one DILG to achieve its purpose of catalyzing excellence in local governance.",
    ],
    [
        "letter" => "R",
        "title"  => "Responsiveness",
        "desc"   => "Is that sense of timeliness and accuracy in delivering DILG's services towards the satisfaction of its customers/clients and in compliance with all the relevant requirements.",
    ],
];

$quality_policy = "We, the DILG, imbued with the core values of Integrity, Commitment, Teamwork and Responsiveness, commit to formulate sound policies on strengthening local government capacities, performing oversight function over LGUs, and providing rewards and incentives. We pledge to provide effective technical and administrative services to uphold excellence in local governance and enhance the service delivery of our Regional and Field Offices for the LGUs to become transparent, resilient, socially-protective and competitive, where people in the community live happily. We commit to continually improve the effectiveness of our Quality Management System compliant with applicable statutory and regulatory requirements and international standards gearing towards organizational efficiency in pursuing our mandate and achieving our client's satisfaction. We commit to consistently demonstrate a \"Matino, Mahusay at Maaasahang Kagawaran Para sa Mapagkalinga at Maunlad na Pamahalaang Lokal.\"";

$mlgoos = [
    ["municipality" => "Compostela",  "name" => "Name of MLGOO", "image" => "uploads/mlgoos/compostela.jpg"],
    ["municipality" => "Laak",        "name" => "Name of MLGOO", "image" => "uploads/mlgoos/laak.jpg"],
    ["municipality" => "Mabini",      "name" => "Name of MLGOO", "image" => "uploads/mlgoos/mabini.jpg"],
    ["municipality" => "Maco",        "name" => "Name of MLGOO", "image" => "uploads/mlgoos/maco.jpg"],
    ["municipality" => "Maragusan",   "name" => "Name of MLGOO", "image" => "uploads/mlgoos/maragusan.jpg"],
    ["municipality" => "Mawab",       "name" => "Name of MLGOO", "image" => "uploads/mlgoos/mawab.jpg"],
    ["municipality" => "Monkayo",     "name" => "Name of MLGOO", "image" => "uploads/mlgoos/monkayo.jpg"],
    ["municipality" => "Montevista",  "name" => "Name of MLGOO", "image" => "uploads/mlgoos/montevista.jpg"],
    ["municipality" => "Nabunturan",  "name" => "Name of MLGOO", "image" => "uploads/mlgoos/nabunturan.jpg"],
    ["municipality" => "New Bataan",  "name" => "Name of MLGOO", "image" => "uploads/mlgoos/newbataan.jpg"],
    ["municipality" => "Pantukan",    "name" => "Name of MLGOO", "image" => "uploads/mlgoos/pantukan.jpg"],
];
?>

<section class="page-banner">
    <div class="container">
        <span class="eyebrow"><i class="bi bi-award-fill"></i> About Us</span>
        <h1>Provincial Director</h1>
        <p>Meet the Provincial Director of DILG Davao de Oro.</p>
    </div>
</section>

<!-- PROVINCIAL DIRECTOR -->
<section class="pd-section">
    <div class="container">
        <div class="row align-items-center g-5">

            <div class="col-lg-6">
                <img src="uploads/PD.png" class="pd-image" alt="Provincial Director">
            </div>

            <div class="col-lg-6">

                <span class="eyebrow">Provincial Director</span>
                <h2 class="mt-2">Ma. Aurora C. Corpuz</h2>
                <h5 class="text-muted mb-4">Provincial Director</h5>

                <p>
                    Under the leadership of <strong>Ma. Aurora C. Corpuz</strong>,
                    DILG Davao de Oro continues to strengthen
                    local governance, promote peace and order,
                    enhance public safety, and ensure responsive,
                    transparent, and accountable public service
                    throughout the Province of Davao de Oro.
                </p>

                <p>
                    Together with dedicated personnel and partner
                    stakeholders, the Provincial Office remains
                    committed to empowering Local Government Units,
                    promoting inclusive development,
                    and building resilient communities across
                    the eleven (11) municipalities.
                </p>

            </div>

        </div>
    </div>
</section>

<!-- MLGOOs -->
<section class="mlgoo-section">

    <section class="page-banner">
        <div class="container">
            <span class="eyebrow"><i class="bi bi-people-fill"></i> DILG Field Officers</span>
            <h1>Municipal Local Government Operations Officers</h1>
            <p>
                DILG Davao de Oro delivers responsive public service through its Municipal Local Government Operations
                Officers (MLGOOs) assigned to the Province's eleven (11) municipalities.
            </p>
        </div>
    </section>

    <div class="container">
        <div class="row g-4">

            <?php foreach ($mlgoos as $mlgoo): ?>

                <div class="col-lg-4 col-md-6">
                    <div class="mlgoo-card">

                        <img src="<?php echo $mlgoo['image']; ?>" class="mlgoo-image" alt="<?php echo $mlgoo['municipality']; ?>">

                        <div class="mlgoo-body">
                            <h4><?php echo $mlgoo['name']; ?></h4>
                            <div class="position">Municipal Local Government Operations Officer</div>
                            <div class="municipality">
                                <i class="bi bi-geo-alt-fill"></i>
                                <?php echo $mlgoo['municipality']; ?>
                            </div>
                        </div>

                    </div>
                </div>

            <?php endforeach; ?>

        </div>
    </div>

</section>

<!-- MISSION / VISION / VALUES / POLICY -->
<section class="about-section bg-light">
    <div class="container" style="max-width:900px;">

        <div class="info-card">
            <h2>Mission</h2>
            <p><?php echo htmlspecialchars($mission); ?></p>
        </div>

        <div class="info-card">
            <h2>Vision</h2>
            <p><?php echo htmlspecialchars($vision); ?></p>
        </div>

        <div class="info-card">
            <h2>Core Values</h2>

            <div class="values-grid">
                <?php foreach ($core_values as $value): ?>
                    <div class="value-tile">
                        <span class="letter"><?php echo htmlspecialchars($value['letter']); ?></span>
                        <h3><?php echo htmlspecialchars($value['title']); ?></h3>
                        <p><?php echo htmlspecialchars($value['desc']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>

            <p class="tagline-quote">"Ang DILG ay Matino, Mahusay at Maaasahan"</p>
        </div>

        <div class="info-card mb-0">
            <h2>DILG Quality Policy</h2>
            <p><?php echo htmlspecialchars($quality_policy); ?></p>
        </div>

    </div>
</section>

<?php include 'includes/footer.php'; ?>
