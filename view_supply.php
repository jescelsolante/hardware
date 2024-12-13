<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Supplies</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom table styling */
        table {
            border-radius: 10px;
            overflow: hidden;
        }
        th, td {
            text-align: center;
            vertical-align: middle;
        }
        .btn-edit, .btn-delete {
            margin: 0 5px;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }
        .table-striped tbody tr:hover {
            background-color: #f1f1f1;
        }
        /* Set background image for the whole body */
        body {
            background-image: url('pic.png'); /* Replace with the path to your image */
            background-size: cover; /* Ensures the image covers the entire background */
            background-position: center; /* Centers the image */
            background-attachment: fixed; /* Keeps the image in place during scrolling */
        }

        /* Custom table styling */
        table {
            border-radius: 10px;
            overflow: hidden;
        }
        th, td {
            text-align: center;
            vertical-align: middle;
        }
        .btn-edit, .btn-delete {
            margin: 0 5px;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }
        .table-striped tbody tr:hover {
            background-color: #f1f1f1;
        }
        
        .custom-heading {
            color: white;
            font-style: italic;
            font-size: 50px;
    }

    </style>

</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center mb-4 custom-heading"><strong>Hardware Supplies</strong></h2>
        <a href="create_supply.php" class="btn btn-success mb-3"> + Add New Supply</a>

        <?php
        // Display success message if deletion was successful
        if (isset($_GET['delete_success']) && $_GET['delete_success'] == 1) {
            echo "<div class='alert alert-success'>The supply was successfully deleted.</div>";
        }
        ?>

        <div class="table-responsive">
            <table class="table table-striped table-bordered shadow-sm">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Item</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Supplier</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Connect to the database
                    $conn = new mysqli('localhost', 'jesy', '1234', 'hardware_store');
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Fetch all records from hardware_supplies
                    $sql = "SELECT * FROM hardware_supplies";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['category'] . "</td>";
                            echo "<td>₱" . $row['price'] . "</td>";
                            echo "<td>" . $row['stock_quantity'] . "</td>";
                            echo "<td>" . $row['supplier'] . "</td>";
                            echo "<td>
                                    <a href='update_supply.php?id=" . $row['id'] . "' class='btn btn-primary btn-sm btn-edit'>Edit</a>
                                    <a href='delete_supply.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm btn-delete'>Delete</a>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7' class='text-center'>No supplies found.</td></tr>";
                    }

                    // Close the database connection
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
