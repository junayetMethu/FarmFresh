<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cow_name = $_POST['cow_name'];
    $cow_age = $_POST['cow_age'];
    $cow_breed = $_POST['cow_breed'];
    $cow_weight = $_POST['cow_weight'];

    $sql = "INSERT INTO cows (cow_name, cow_age, cow_breed, cow_weight) 
            VALUES ('$cow_name', '$cow_age', '$cow_breed', '$cow_weight')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Cow added successfully!'); window.location.href='add-cow.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New Cow</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <div class="container">
        <h2>Add New Cow</h2>
        <form method="POST" action="">
            <label for="cow_name">Cow Name:</label>
            <input type="text" id="cow_name" name="cow_name" required>

            <label for="cow_age">Age:</label>
            <input type="number" id="cow_age" name="cow_age" required>

            <label for="cow_breed">Breed:</label>
            <input type="text" id="cow_breed" name="cow_breed" required>

            <label for="cow_weight">Weight (kg):</label>
            <input type="number" id="cow_weight" name="cow_weight" required>

            <button type="submit">Add Cow</button>
        </form>
    </div>
</body>
</html>
