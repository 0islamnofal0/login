<?php
session_start();

include("db.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_name = $_POST['name'];
    $gmail = $_POST['email'];
    $password = $_POST['password'];
    $activity = $_POST['activity'];
    $Project_Budget = $_POST['projectBudget'];
    $Budget_of_Finance = $_POST['financeBudget'];

    if (!empty($gmail) && !empty($password) && !is_numeric($gmail)) {
        $stmt = $con->prepare("INSERT INTO form (name, email, password, activity, projectBudget, financeBudget) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssii", $user_name, $gmail, $password, $activity, $Project_Budget, $Budget_of_Finance);
        
        if ($stmt->execute()) {
            echo "<script type='text/javascript'>alert('Successfully registered')</script>";
        } else {
            echo "<script type='text/javascript'>alert('Registration failed')</script>";
        }

        $stmt->close();
    } else {
        echo "<script type='text/javascript'>alert('Please enter some valid information')</script>";
    }
}

$con->close();
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Sign Up</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container" id="signUpContainer">
    <h2>Sign Up</h2>
    <form method="post">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="activity">Activity:</label>
            <select id="activity" name="activity" required>
                <option value="" disabled selected>Select activity</option>
                <option value="industrial">Industrial</option>
                <option value="agricultural">Agricultural</option>
                <option value="commercial">Commercial</option>
            </select>
        </div>
        <div class="form-group">
            <label for="projectBudget">Project Budget:</label>
            <input type="number" id="projectBudget" name="projectBudget" required>
        </div>
        <div class="form-group">
            <label for="financeBudget">Budget of Finance:</label>
            <input type="number" id="financeBudget" name="financeBudget" required>
        </div>
        <button class="btn" type="submit">Sign Up</button>
    </form>
    <p style="text-align: center; margin-top: 10px;">
        Already have an account? <a href="login.php" style="color: #183d3d;">Login</a>
    </p>
</div>
</body>
</html>
