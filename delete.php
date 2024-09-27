<?php

include('includes/nav.php');
# Open database connection.
require('connect_db.php');

# Check if item_id is set in the URL.
if (isset($_GET['item_id'])) {
    # Get the item ID from the URL and sanitize it.
    $id = mysqli_real_escape_string($link, trim($_GET['item_id']));
    
    # Prepare the SQL delete query.
    $sql = "DELETE FROM products WHERE item_id='$id'";
    
    # Execute the query.
    if ($link->query($sql) === TRUE) {
        # Redirect to the read page after deletion.
        header("Location: read.php");
        exit();  # Make sure to stop further script execution after redirection.
    } else {
        # If there's an error, display it.
        echo "Error deleting record: " . $link->error;
    }
    
    # Close the database connection.
    mysqli_close($link);
}
?>

<!-- HTML Form for updating items -->
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

    <input type="submit" class="btn btn-dark" value="Add Item">
</form>
