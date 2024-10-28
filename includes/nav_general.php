<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">MKPC</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'register.php' ? 'active' : ''; ?>" href="register.php">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'login.php' ? 'active' : ''; ?>" href="login.php">Login</a>
                </li>

                <!-- Products Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?php echo basename($_SERVER['PHP_SELF']) == 'products.php' ? 'active' : ''; ?>" href="products.php" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Products
                    </a>
                    <ul class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item text-white" href="graphics.php">Graphics Cards</a></li>
                        <li><a class="dropdown-item text-white" href="cpu.php">CPUs</a></li>
                        <li><a class="dropdown-item text-white" href="memory.php">Memory Cards</a></li>
                    </ul>
                </li>
            </ul>

            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="logout.php" class="btn btn-danger ms-auto">Logout</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS (for toggler) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<style>
    .nav-link {
        color: white !important; /* White text for navbar links */
    }
    
    .nav-link:hover {
        background-color: #ff4d4d !important; /* Red background on hover */
        color: white !important; /* Keep text white on hover */
    }

    .nav-link.active {
        background-color: #ff4d4d; /* Highlight active page */
        color: white; /* Keep text white */
    }

    .dropdown-menu {
        background-color: #333 !important; /* Dark background for dropdown */
    }

    .dropdown-item {
        color: white !important; /* White text for dropdown items */
    }

    .dropdown-item:hover {
        background-color: #ff4d4d !important; /* Red background on hover for dropdown items */
        color: white !important;
    }
</style>
