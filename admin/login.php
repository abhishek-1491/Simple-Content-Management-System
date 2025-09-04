<?php

session_start();
include('../includes/db.php');

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    $stmt = mysqli_prepare($conn, "SELECT id, username, password FROM admins WHERE username = ?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
       
        if (password_verify($password, $row['password'])) {
            $_SESSION['admin'] = $row['username'];
            header("Location: dashboard.php");
            exit();
        } else {
            echo "<script>alert('Invalid Password'); window.location.href='login.php';</script>";
        }
    } else {
        echo "<script>alert('Invalid Username'); window.location.href='login.php';</script>";
    }

    mysqli_stmt_close($stmt);
}
mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CMS</title>
    <link rel="stylesheet" href="../public/assets/css/style.css">
  </head>
  <body>
    <nav class="navbar">
      <h1>Simple CMS</h1>
      <button class="btn" style="background-color: green;" onclick="window.location.href='../'">Back</button>
    </nav>
    <div class="login-container">
        <form method="POST">
            <h1>Admin Login</h1>
            <div class="form-container">
                <div class="form-group">
                    <input type="text" placeholder="Enter Username" name="username" required>
                </div>
                <div class="form-group">
                    <input type="password" placeholder="Enter Password" name="password" required>
                </div>
                <input type="submit" value="Login" name="login">
            </div>
        </form>
    </div>
  </body>
</html>
