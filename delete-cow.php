<?php
include 'config.php';

$message = "";
$alertClass = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["cow_id"])) {
        $id = intval($_POST["cow_id"]);

        $check = "SELECT * FROM cows WHERE id = ?";
        $stmt_check = $conn->prepare($check);
        $stmt_check->bind_param("i", $id);
        $stmt_check->execute();
        $result = $stmt_check->get_result();

        if ($result->num_rows > 0) {
            $sql = "DELETE FROM cows WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                $message = "Cow with ID <strong>$id</strong> has been deleted successfully.";
                $alertClass = "alert-success";
            } else {
                $message = "Error deleting cow: " . $conn->error;
                $alertClass = "alert-danger";
            }

            $stmt->close();
        } else {
            $message = "Cow with ID <strong>$id</strong> does not exist.";
            $alertClass = "alert-warning";
        }

        $stmt_check->close();
        $conn->close();
    } else {
        $message = "Please enter a valid Cow ID.";
        $alertClass = "alert-warning";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Cow</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-danger text-white">
            <h4>🐄 Delete Cow Record</h4>
        </div>
        <div class="card-body">
            <?php if (!empty($message)): ?>
                <div class="alert <?= $alertClass ?>"><?= $message ?></div>
            <?php endif; ?>

            <form method="post" action="">
                <div class="mb-3">
                    <label for="cow_id" class="form-label">Enter Cow ID to Delete</label>
                    <input type="number" name="cow_id" id="cow_id" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-danger">Delete Cow</button>
                <a href="view.php" class="btn btn-secondary">Back to List</a>
            </form>
        </div>
    </div>
</div>

</body>
</html>
