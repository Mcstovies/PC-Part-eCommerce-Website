<?php
session_start();
include 'includes/nav_general.php';
?>

<style>
    /* Full page black background */
    body {
        background-color: #121212;
        color: white;
    }

    /* Jumbotron styling */
    .jumbotron {
        background-color: #333;
        padding: 60px 0;
        text-align: center;
    }

    .jumbotron h1 {
        font-size: 3rem;
        font-weight: bold;
    }

    .jumbotron p {
        font-size: 1.2rem;
        margin-bottom: 1.5rem;
    }

    .jumbotron .btn {
        padding: 10px 30px;
        font-size: 1.1rem;
    }

    /* Container styling */
    .container {
        padding: 40px 0;
    }

    /* Feature section */
    .feature {
        background-color: #333;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .feature img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
    }

    .feature h4 {
        color: #ff4d4d;
    }

    .feature p {
        font-size: 1rem;
        color: #aaa;
    }
</style>

<!-- Jumbotron Section -->
<div class="jumbotron jumbotron-fluid text-white">
    <div class="container">
        <h1 class="display-4">Build Your Dream PC</h1>
        <p class="lead">Explore top PC components and accessories for your next build.</p>
        <a href="products.php" class="btn btn-danger btn-lg">Shop Now</a>
    </div>
</div>


<!-- Featured Products or Categories Section -->
<div class="container mt-5">
    <h2 class="text-center mb-4">Our Top Categories</h2>
    <div class="row">
        <!-- Graphics Cards Feature -->
        <div class="col-md-4">
            <div class="feature">
                <img src="img/graphiccard1.jpg" alt="Graphics Cards">
                <h4>High-Performance Graphics Cards</h4>
                <p>Power up your rig with the latest and most powerful GPUs.</p>
            </div>
        </div>
        
        <!-- CPUs Feature -->
        <div class="col-md-4">
            <div class="feature">
                <img src="img/CPU.webp" alt="CPUs">
                <h4>Processors for Every Need</h4>
                <p>Find CPUs that meet the demands of gaming, work, and more.</p>
            </div>
        </div>
        
        <!-- Memory Feature -->
        <div class="col-md-4">
            <div class="feature">
                <img src="img/memory1.webp" alt="Memory">
                <h4>Reliable and Fast Memory</h4>
                <p>Choose from a range of RAM to keep your PC running smoothly.</p>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
