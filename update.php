<?php
# Include navigation
include('includes/nav.php');

# Open database connection
require('connect_db.php');

# Check if the item ID is provided via GET (to load the current data)
if (isset($_GET['id'])) {
    $item_id = mysqli_real_escape_string($link, trim($_GET['id']));

    # Fetch the current item details from the database
    $q = "SELECT * FROM products WHERE item_id='$item_id'";
    $r = @mysqli_query($link, $q);

    # If the item exists, store its current data
    if ($r && mysqli_num_rows($r) == 1) {
        $item = mysqli_fetch_assoc($r);
    } else {
        echo "Item not found!";
        exit();
    }
}

# Check if form is submitted to update the item
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    # Initialize an error array
    $errors = array();

    # Check for item ID
    if (empty($_POST['item_id'])) {
        $errors[] = 'Item ID is missing.'; 
    } else {
        $id = mysqli_real_escape_string($link, trim($_POST['item_id']));
    }

    # Check for item name
    if (empty($_POST['item_name'])) {
        $errors[] = 'Please provide the item name.'; 
    } else {
        $n = mysqli_real_escape_string($link, trim($_POST['item_name']));
    }

    # Check for item description
    if (empty($_POST['item_desc'])) {
        $errors[] = 'Please provide the item description.'; 
    } else {
        $d = mysqli_real_escape_string($link, trim($_POST['item_desc']));
    }

    # Check for item image
    if (empty($_POST['item_img'])) {
        $errors[] = 'Please provide the image URL.'; 
    } else {
        $img = mysqli_real_escape_string($link, trim($_POST['item_img']));
    }

    # Check for item price
    if (empty($_POST['item_price'])) {
        $errors[] = 'Please provide the item price.'; 
    } else {
        $p = mysqli_real_escape_string($link, trim($_POST['item_price']));
    }

    # If no errors, proceed with the update
    if (empty($errors)) {
        # Prepare the update query
        $q = "UPDATE products 
              SET item_name='$n', item_desc='$d', item_img='$img', item_price='$p' 
              WHERE item_id='$id'";
        $r = @mysqli_query($link, $q);

        # If the query is successful, redirect to read.php
        if ($r) {
            header("Location: read.php");
            exit();
        } else {
            echo "Error updating record: " . mysqli_error($link);
        }

        # Close the database connection
        mysqli_close($link);
    } else {
        # Print the errors
        foreach ($errors as $msg) {
            echo " - $msg<br>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Item</title>
</head>
<body>

<!-- HTML Form for updating items -->
<h1>Update Item</h1>
<form action="update.php" method="post">
    <!-- Hidden field to store item ID -->
    <input type="hidden" name="item_id" value="<?php echo $item['item_id']; ?>">

    <label for="item_name">Item Name:</label>
    <input type="text" id="item_name" class="form-control" name="item_name" required 
           value="<?php echo isset($item['item_name']) ? $item['item_name'] : ''; ?>">

    <label for="item_desc">Description:</label>
    <textarea id="item_desc" class="form-control" name="item_desc" required><?php echo isset($item['item_desc']) ? $item['item_desc'] : ''; ?></textarea>

    <label for="item_img">Image URL:</label>
    <input type="text" id="item_img" class="form-control" name="item_img" required 
           value="<?php echo isset($item['item_img']) ? $item['item_img'] : ''; ?>">

    <label for="item_price">Price:</label>
    <input type="number" id="item_price" class="form-control" name="item_price" min="0" step="0.01" required 
           value="<?php echo isset($item['item_price']) ? $item['item_price'] : ''; ?>"><br>

    <input type="submit" class="btn btn-dark" value="Update Item">
</form>

</body>
</html>

<?php include('includes/footer.php'); ?>
