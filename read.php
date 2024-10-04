<?php
include 'includes/nav.php'; // Include navigation bar
include 'connect_db.php'; // Include database connection

// Query to retrieve all products from the database
$sql = "SELECT item_id, name, item_price, description FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
    <style>
        /* Add some basic styling */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>

<h2>Product List</h2>

<?php
// Check if there are any products in the database
if ($result->num_rows > 0) {
    echo "<table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>";

    // Loop through and display each product
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['item_id'] . "</td>
                <td>" . $row['name'] . "</td>
                <td>$" . $row['item_price'] . "</td>
                <td>" . $row['item_desc'] . "</td>
                <td>
                    <a href='update.php?id=" . $row['id'] . "'>Edit</a> | 
                    <a href='delete.php?id=" . $row['id'] . "'>Delete</a>
                </td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "No products found.";
}

$conn->close(); // Close the database connection
?>

</body>
<?php include 'includes/footer.php'; // Include footer ?>
</html>
