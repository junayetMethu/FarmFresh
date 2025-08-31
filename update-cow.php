<?php
include 'config.php';

$cow = null;
$not_found = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['search'])) {
        $id = $_POST['cow_id'];
        $result = mysqli_query($conn, "SELECT * FROM cows WHERE id = $id");
        if (mysqli_num_rows($result) > 0) {
            $cow = mysqli_fetch_assoc($result);
        } else {
            $not_found = true;
        }
    }

    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $cow_name = $_POST['cow_name'];
        $cow_age = $_POST['cow_age'];
        $cow_breed = $_POST['cow_breed'];
        $cow_weight = $_POST['cow_weight'];

        $sql = "UPDATE cows SET cow_name='$cow_name', cow_age=$cow_age, cow_breed='$cow_breed', cow_weight=$cow_weight WHERE id=$id";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Cow updated successfully!'); window.location.href='update-cow.php';</script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Cow</title>
    <link rel="stylesheet" href="style1.css">
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
        }
        .container {
            width: 450px;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 0px 12px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
        }
        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 16px;
            margin-top: 15px;
            border-radius: 6px;
            cursor: pointer;
            width: 100%;
        }
        .alert {
            color: red;
            margin-top: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Search Cow by ID</h2>
    <form method="POST">
        <label for="cow_id">Enter Cow ID:</label>
        <input type="number" name="cow_id" required>
        <button type="submit" name="search">Search</button>
    </form>

    <?php if ($not_found): ?>
        <div class="alert">Cow not found with that ID!</div>
    <?php endif; ?>

    <?php if ($cow): ?>
    <h2>Update Cow Info</h2>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $cow['id']; ?>">

        <label for="cow_name">Cow Name:</label>
        <input type="text" name="cow_name" value="<?php echo $cow['cow_name']; ?>" required>

        <label for="cow_age">Age:</label>
        <input type="number" name="cow_age" value="<?php echo $cow['cow_age']; ?>" required>

        <label for="cow_breed">Breed:</label>
        <input type="text" name="cow_breed" value="<?php echo $cow['cow_breed']; ?>" required>

        <label for="cow_weight">Weight:</label>
        <input type="number" name="cow_weight" value="<?php echo $cow['cow_weight']; ?>" required>

        <button type="submit" name="update">Update</button>
    </form>
    <?php endif; ?>
</div>
</body>
</html>
