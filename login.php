<?php
session_start();

include("db.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $gmail = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($gmail) && !empty($password) && !is_numeric($gmail)) {
        // Use prepared statements to prevent SQL injection
        $stmt = $con->prepare("SELECT * FROM form WHERE email = ? LIMIT 1");
        $stmt->bind_param("s", $gmail);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result) {
            if ($result->num_rows > 0) {
                $user_data = $result->fetch_assoc();

                if ($user_data['password'] == $password) {
                    $_SESSION['user_id'] = $user_data['id'];  // Assuming there is an id column in your table

                    // Check the budget of finance and redirect accordingly
                    if ($user_data['financeBudget'] >= 1000 && $user_data['financeBudget'] <= 200000) {
                        header("Location: home.html");
                    } elseif ($user_data['financeBudget'] > 200000) {
                        header("Location: home1.html");
                    } else {
                        echo "<script type='text/javascript'>alert('Invalid Budget of Finance')</script>";
                    }
                    die;
                }
            }
        }
        echo "<script type='text/javascript'>alert('Wrong username or password')</script>";
    } else {
        echo "<script type='text/javascript'>alert('Wrong username or password')</script>";
    }
}
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
    <div class="container" id="loginContainer">
        <h2>Login</h2>
        <form method="post">
            <div class="form-group">
                <label for="loginEmail">Email:</label>
                <input type="email" id="loginEmail" name="email" required>
            </div>
            <div class="form-group">
                <label for="loginPassword">Password:</label>
                <input type="password" id="loginPassword" name="password" required>
            </div>
            <button class="btn" type="submit">Login</button>
        </form>
        <p style="text-align: center; margin-top: 10px;">
            Don't have an account? <a href="signup.php" style="color: #183d3d;">Sign up</a>
        </p>
    </div>
</body>
</html>
