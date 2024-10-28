<?php
// Include the navbar
include 'includes/nav_general.php';
?>

<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-4">About MKPC</h1>
        <p class="lead">Quality PC Parts and Exceptional Service</p>
    </div>

    <!-- Company Info Section -->
    <section class="mb-5">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2>Who We Are</h2>
                <p>MKPC is a dedicated provider of high-quality PC parts and accessories. Whether you're a professional gamer, a tech enthusiast, or building your first custom rig, we’re here to help you find the perfect components.</p>
                <p>Our team consists of experts who share a passion for technology and innovation. We strive to offer top-notch products and customer service, ensuring that every purchase meets your expectations.</p>
            </div>
            
        </div>
    </section>

    <!-- Mission Section -->
    <section class="bg-light p-5 rounded mb-5">
        <h2 class="text-center">Our Mission</h2>
        <p class="text-center">To empower tech enthusiasts by providing the best PC parts with unmatched customer support.</p>
    </section>


    <!-- Values Section -->
    <section class="bg-dark text-white p-5 rounded">
        <h2 class="text-center">Our Core Values</h2>
        <div class="row mt-4">
            <div class="col-md-4 text-center">
                <i class="fas fa-star fa-3x mb-3"></i>
                <h5>Quality</h5>
                <p>We only provide the best components for your build, backed by trusted brands and rigorous testing.</p>
            </div>
            <div class="col-md-4 text-center">
                <i class="fas fa-user-friends fa-3x mb-3"></i>
                <h5>Customer Focus</h5>
                <p>Our customers are our priority. We’re here to help every step of the way, from selection to support.</p>
            </div>
            <div class="col-md-4 text-center">
                <i class="fas fa-cogs fa-3x mb-3"></i>
                <h5>Innovation</h5>
                <p>We keep up with the latest tech to bring you the newest and most reliable parts available.</p>
            </div>
        </div>
    </section>
</div>

<style>
    /* Custom Styles */
    .card-body h5 {
        font-weight: bold;
    }

    .card-body p {
        color: #666;
    }

    .bg-light {
        background-color: #f8f9fa !important;
    }

    .bg-dark {
        background-color: #212529 !important;
    }

    .text-white {
        color: #ffffff !important;
    }
</style>

<?php
// Include the footer
include 'includes/footer.php';
?>
