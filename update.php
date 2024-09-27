<?php
# Include navigation 
include('includes/nav.php');

# Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  # Connect to the database.
  require('connect_db.php');  

  # Initialize an error array.
  $errors = array();

  # Check for item ID.
  if (empty($_POST['item_id'])) {
    $errors[] = 'Update item ID.'; 
  } else {
    $id = mysqli_real_escape_string($link, trim($_POST['item_id']));
  }

  # Check for item name.
  if (empty($_POST['item_name'])) {
    $errors[] = 'Update item name.'; 
  } else {
    $n = mysqli_real_escape_string($link, trim($_POST['item_name']));
  }

  # Check for item description.
  if (empty($_POST['item_desc'])) {
    $errors[] = 'Update item description.'; 
  } else {
    $d = mysqli_real_escape_string($link, trim($_POST['item_desc']));
  }

  # Check for item image.
  if (empty($_POST['item_img'])) {
    $errors[] = 'Update image address.'; 
  } else {
    $img = mysqli_real_escape_string($link, trim($_POST['item_img']));
  }

  # Check for item price.
  if (empty($_POST['item_price'])) {
    $errors[] = 'Update item price.'; 
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

    # If the query is successful, redirect
    if ($r) {
      header("Location: read.php");
      exit();
    } else {
      echo "Error updating record: " . $link->error;
    }

    # Close database connection.
    mysqli_close($link);
  } else {
    # Print the errors
    foreach ($errors as $msg) {
      echo " - $msg<br>";
    }
  }
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
