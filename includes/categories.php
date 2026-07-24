<?php
/**
 * categories.php
 *
 * Single source of truth for every post category: its display label,
 * which public page it belongs to (for the post.php back-link and the
 * navbar highlight), and its admin badge color.
 *
 * Add a new category here and manage_posts.php, post.php, and the
 * homepage featured cards all pick it up automatically. If it's a PPA
 * sub-section, also add it to $ppaSections below so ppa.php knows
 * which tab to render it under.
 */

$postCategories = [
    'news' => [
        'label'      => 'Latest News',
        'back_url'   => 'latest_news.php',
        'back_label' => 'Latest News',
        'nav_key'    => 'news',
        'badge'      => 'bg-primary',
    ],
    'gad' => [
        'label'      => 'GAD Corner',
        'back_url'   => 'gad_corner.php',
        'back_label' => 'GAD Corner',
        'nav_key'    => 'gad',
        'badge'      => 'bg-success',
    ],
    'opd' => [
        'label'      => 'OPD',
        'back_url'   => 'ppa.php',
        'back_label' => 'Programs, Projects & Activities',
        'nav_key'    => 'ppa',
        'badge'      => 'bg-primary',
    ],
    'pdms' => [
        'label'      => 'PDMS',
        'back_url'   => 'ppa.php',
        'back_label' => 'Programs, Projects & Activities',
        'nav_key'    => 'ppa',
        'badge'      => 'bg-info text-dark',
    ],
    'pictu' => [
        'label'      => 'PICTU',
        'back_url'   => 'ppa.php',
        'back_label' => 'Programs, Projects & Activities',
        'nav_key'    => 'ppa',
        'badge'      => 'bg-info text-dark',
    ],
    'fas' => [
        'label'      => 'FAS',
        'back_url'   => 'ppa.php',
        'back_label' => 'Programs, Projects & Activities',
        'nav_key'    => 'ppa',
        'badge'      => 'bg-warning text-dark',
    ],
    'lgcds' => [
        'label'      => 'LGCDS',
        'back_url'   => 'ppa.php',
        'back_label' => 'Programs, Projects & Activities',
        'nav_key'    => 'ppa',
        'badge'      => 'bg-secondary',
    ],
    'lgmes' => [
        'label'      => 'LGMES',
        'back_url'   => 'ppa.php',
        'back_label' => 'Programs, Projects & Activities',
        'nav_key'    => 'ppa',
        'badge'      => 'bg-dark',
    ],
];

// PPA sub-sections: which tab (section-content id) and, where relevant,
// which sub-tab (sub-content id) each category renders under on ppa.php.
$ppaSections = [
    'opd'   => ['section' => 'opd',   'sub' => 'opd-general'],
    'pdms'  => ['section' => 'opd',   'sub' => 'pdms'],
    'pictu' => ['section' => 'opd',   'sub' => 'pictu'],
    'fas'   => ['section' => 'fas',   'sub' => null],
    'lgcds' => ['section' => 'lgcds', 'sub' => null],
    'lgmes' => ['section' => 'lgmes', 'sub' => null],
];