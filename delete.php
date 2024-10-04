<?php

# Include navigation
include('includes/nav.php');

# Open database connection
require('connect_db.php');

# Check if item_id is set in the URL (GET method)
if (isset($_GET['item_id'])) {
    # Sanitize the item ID from the URL
    $id = mysqli_real_escape_string($link, trim($_GET['item_id']));
    
    # Prepare the SQL delete query
    $sql = "DELETE FROM products WHERE item_id='$id'";
    
    # Execute the query
    if (mysqli_query($link, $sql)) {
        # Redirect to the read page after successful deletion
        header("Location: read.php");
        exit();  # Ensure script execution stops after redirection
    } else {
        # If there's an error, display it
        echo "Error deleting record: " . mysqli_error($link);
    }

    # Close the database connection
    mysqli_close($link);
} else {
    # If item_id is not set, display an error
    echo "No item selected for deletion.";
}
?>

<!-- No form is needed for deletion -->
<!-- Optionally, include a message confirming the deletion before redirecting -->
