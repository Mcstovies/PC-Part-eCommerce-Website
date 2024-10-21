<!-- http://localhost/codespaceproject/create.php !-->

<?php
// Include navigation
include 'includes/nav.php';

// Open database connection
require 'connect_db.php';

// Initialize error array
$errors = array();

// Handle form submission (Add a new product)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check for item name
    if (empty($_POST['item_name'])) {
        $errors[] = 'Enter the item name.';
    } else {
        $n = mysqli_real_escape_string($link, trim($_POST['item_name']));
    }

    // Check for item description
    if (empty($_POST['item_desc'])) {
        $errors[] = 'Enter the item description.';
    } else {
        $d = mysqli_real_escape_string($link, trim($_POST['item_desc']));
    }

    // Check for item image
    if (empty($_POST['item_img'])) {
        $errors[] = 'Enter the item image.';
    } else {
        $img = mysqli_real_escape_string($link, trim($_POST['item_img']));
    }

    // Check for item price
    if (empty($_POST['item_price'])) {
        $errors[] = 'Enter the item price.';
    } else {
        $p = mysqli_real_escape_string($link, trim($_POST['item_price']));
    }

    // Check for category
    if (empty($_POST['category'])) {
        $errors[] = 'Enter the category.';
    } else {
        $cat = mysqli_real_escape_string($link, trim($_POST['category']));
    }

    // On success, insert data into the database
    if (empty($errors)) {
        $q = "INSERT INTO products (item_name, item_desc, item_img, item_price, category) 
              VALUES ('$n', '$d', '$img', '$p', '$cat')";
        $r = @mysqli_query($link, $q);
        if ($r) {
            echo '<p>New record created successfully.</p>';
        } else {
            echo '<p>Error occurred: ' . mysqli_error($link) . '</p>';
        }
    } else {
        // Display form errors
        echo '<p>The following error(s) occurred:</p>';
        foreach ($errors as $msg) {
            echo "$msg<br>";
        }
        echo '<p>Please try again.</p>';
    }
}

// Retrieve and display existing products
$q = "SELECT * FROM products";
$r = mysqli_query($link, $q);

if (mysqli_num_rows($r) > 0) {
    echo '<div class="row">';
    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
        echo '
        <div class="col-md-3 d-flex justify-content-center">
            <div class="card" style="width: 18rem;">
                <img src="' . $row['item_img'] . '" class="card-img-top" alt="Product Image">
                <div class="card-body">
                    <h5 class="card-title text-center">' . $row['item_name'] . '</h5>
                    <p class="card-text">' . $row['item_desc'] . '</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item text-center">&pound' . $row['item_price'] . '</li>
                    <li class="list-group-item text-center">Category: ' . $row['category'] . '</li>
                    <li class="list-group-item btn btn-dark">
                        <a class="btn btn-dark btn-lg btn-block" href="update.php?id=' . $row['item_id'] . '">Update</a>
                    </li>
                    <li class="list-group-item">
                        <a class="btn btn-dark" href="delete.php?item_id=' . $row['item_id'] . '">Delete Item</a>
                    </li>
                </ul>
            </div>
        </div>';
    }
    echo '</div>';
} else {
    echo '<p>No products found.</p>';
}

// Close the database connection
mysqli_close($link);
?>

<!-- Form to Add New Products -->
<h1>Add New Item</h1>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="item_name">Item Name:</label>
    <input type="text" id="item_name" class="form-control" name="item_name" required value="<?php if (isset($_POST['item_name'])) echo $_POST['item_name']; ?>">

    <label for="item_desc">Description:</label>
    <textarea id="item_desc" class="form-control" name="item_desc" required><?php if (isset($_POST['item_desc'])) echo $_POST['item_desc']; ?></textarea>

    <label for="item_img">Image URL:</label>
    <input type="text" id="item_img" class="form-control" name="item_img" required value="<?php if (isset($_POST['item_img'])) echo $_POST['item_img']; ?>">

    <label for="item_price">Price:</label>
    <input type="number" id="item_price" class="form-control" name="item_price" min="0" step="0.01" required value="<?php if (isset($_POST['item_price'])) echo $_POST['item_price']; ?>"><br>

    <label for="category">Category:</label>
    <input type="text" id="category" class="form-control" name="category" required value="<?php if (isset($_POST['category'])) echo $_POST['category']; ?>"><br>

    <input type="submit" class="btn btn-dark" value="Add Item">
</form>

<?php
// Include footer
include 'includes/footer.php';
?>



