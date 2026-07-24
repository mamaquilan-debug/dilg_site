<div class="topbar d-flex justify-content-between align-items-center">

    <h4 class="mb-0"></h4>

    <div>
        <span class="me-3">
            <i class="bi bi-person-circle"></i>
            Welcome, <strong><?php echo htmlspecialchars($_SESSION['admin']); ?></strong>
        </span>

        <a href="logout.php" class="btn btn-danger btn-sm">
            <i class="bi bi-box-arrow-right"></i>
            Logout
        </a>
    </div>

</div>
