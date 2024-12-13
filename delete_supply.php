<?php
// Connect to the database
$conn = new mysqli('localhost', 'jesy', '1234', 'hardware_store');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete record if id is set
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM hardware_supplies WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        // Redirect to view_supplies.php with success flag
        header("Location: view_supply.php?delete_success=1");
        exit();  // Exit after redirect to stop further script execution
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Supply</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center mb-4">Delete Supply</h2>
        <div class="card shadow p-4">
            <p>Are you sure you want to delete this supply?</p>
            <!-- Cancel button redirects to the view_supplies.php without deleting -->
            <a href="view_supplies.php" class="btn btn-secondary">Cancel</a>
            <!-- Delete button that triggers the delete operation -->
            <a href="delete_supply.php?id=<?php echo htmlspecialchars($_GET['id']); ?>" class="btn btn-danger">Delete</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
