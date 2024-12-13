<?php
// Include the database connection file
include 'db_connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $stock_quantity = $_POST['stock_quantity'];
    $supplier = $_POST['supplier'];


    // Insert data into the table
    $sql = "INSERT INTO hardware_supplies (name, category,price, stock_quantity, supplier)
            VALUES ('$name', '$category', '$price', '$stock_quantity', '$supplier')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        header("Location: view_supply.php"); // Redirect to view page
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Supply</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
        body {
            background-image: url('pic.png'); /* Replace with the path to your image */
            background-size: cover; /* Ensures the image covers the entire background */
            background-position: center; /* Centers the image */
            background-attachment: fixed; /* Keeps the image in place during scrolling */
        }
        .custom {
            color: white;
            font-style: italic;
            font-size: 20px;
        }
    </style>
</head>
<body class="bg-light">
<div class="container mt-5">

    <h2 class="text-center mb-4 custom"><strong>Add New Hardware Supply</strong></h2>
    <div class="row justify-content-center"> <!-- Add this row for alignment -->
        <div class="col-md-6"> <!-- Adjust width with col-md-* -->
            <div class="card shadow p-4">
                <form action="create_supply.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Item Name</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <input type="text" id="category" name="category" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" id="price" name="price" step="0.01" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="stock_quantity" class="form-label">Stock Quantity</label>
                        <input type="number" id="stock_quantity" name="stock_quantity" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="supplier" class="form-label">Supplier</label>
                        <input type="text" id="supplier" name="supplier" class="form-control" required>
                    </div>
                    <input type="submit" class="btn btn-primary w-100" value="Submit">
                    <a href="view_supply.php" class="btn btn-secondary w-100 mt-2">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
