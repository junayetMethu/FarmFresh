<?php
// Connect to database
$conn = new mysqli("localhost", "root", "", "cow_farm");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all cows
$sql = "SELECT id, cow_name, cow_age, cow_breed, cow_weight FROM cows";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>View Cows List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 30px;
            background-color: #f5f8fa;
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #2c3e50;
        }
        table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
            box-shadow: 0 0 10px #ccc;
            background-color: white;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #27ae60;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f1f7f2;
        }
    </style>
</head>
<body>

<h2>🐄 Cow List</h2>

<?php if ($result && $result->num_rows > 0): ?>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age (years)</th>
            <th>Breed</th>
            <th>Weight (kg)</th>
        </tr>
    </thead>
    <tbody>
        <?php while($cow = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $cow['id'] ?></td>
            <td><?= htmlspecialchars($cow['cow_name']) ?></td>
            <td><?= $cow['cow_age'] ?></td>
            <td><?= htmlspecialchars($cow['cow_breed']) ?></td>
            <td><?= $cow['cow_weight'] ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>
<?php else: ?>
<p style="text-align:center; font-size:18px;">No cows found in the database.</p>
<?php endif; ?>

<?php $conn->close(); ?>

</body>
</html>
