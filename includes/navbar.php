<?php
// Nav items: label, target page, and the $page key that marks it active
$navItems = [
    ["label" => "Home",          "href" => "index",           "key" => "home"],
    ["label" => "Latest News",   "href" => "latest_news",      "key" => "news"],
    ["label" => "PPA's",         "href" => "ppa",               "key" => "ppa"],
    ["label" => "GAD Corner",    "href" => "gad_corner",        "key" => "gad"],
    ["label" => "Municipalities","href" => "municipalities",    "key" => "muni"],
    ["label" => "About Us",      "href" => "about",             "key" => "about"],
];

$currentPage = $page ?? "";
?>
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">

        <a class="navbar-brand fw-bold d-flex align-items-center" href="index.php">
            <img src="images/DILG Seal.png" width="50" class="me-2" alt="DILG Logo">
            <span>DILG <strong>Davao de Oro</strong></span>
        </a>

        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbar"
                aria-controls="navbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav ms-auto">
                <?php foreach ($navItems as $item): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $currentPage === $item['key'] ? 'active' : ''; ?>"
                           href="<?php echo $item['href']; ?>">
                            <?php echo $item['label']; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

    </div>
</nav>
