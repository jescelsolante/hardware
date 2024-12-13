<?php
// Connect to the database
$conn = new mysqli('localhost', 'jesy', '1234', 'hardware_store');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the current data
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM hardware_supplies WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $supply = $result->fetch_assoc();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $stock_quantity = $_POST['stock_quantity'];
    $supplier = $_POST['supplier'];

        // Update the database
    $sql = "UPDATE hardware_supplies 
    SET name = ?, category = ?, price = ?, stock_quantity = ?, supplier = ? 
    WHERE id = ?";
    $stmt = $conn->prepare($sql);

    // Corrected bind_param
    $stmt->bind_param("sssdsi", $name, $category, $price, $stock_quantity, $supplier, $id);

    if ($stmt->execute()) {
    // Redirect to the view_supplies.php page with a success message or updated ID
    header("Location: view_supply.php?update_success=1&id=" . $id);
    exit();
    } else {
    echo "Error updating record: " . $conn->error;
    }
}

    $conn->close();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Supply</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        
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

    <h2 class="text-center mb-4 custom"><strong>Update Supplies</strong></h2>
    <div class="row justify-content-center">
        <div class="col-md-6"> <!-- Adjust the width by changing col-md-* -->
            <div class="card shadow p-4">
                <form action="update_supply.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $supply['id']; ?>">
                    <div class="mb-3">
                        <label for="name" class="form-label">Item Name</label>
                        <input type="text" id="name" name="name" class="form-control" value="<?php echo $supply['name']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <input type="text" id="category" name="category" class="form-control" value="<?php echo $supply['category']; ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" id="price" name="price" step="0.01" class="form-control" value="<?php echo $supply['price']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="stock_quantity" class="form-label">Stock Quantity</label>
                        <input type="number" id="stock_quantity" name="stock_quantity" class="form-control" value="<?php echo $supply['stock_quantity']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="supplier" class="form-label">Supplier</label>
                        <input type="text" id="supplier" name="supplier" class="form-control" value="<?php echo $supply['supplier']; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Update Supply</button>
                </form>
            </div>
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
