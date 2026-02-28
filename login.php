<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error){
    die("Connection failed: ".$conn->connect_error);
}

$user = $_POST['username'];
$pass = $_POST['password'];

$sql = "SELECT * FROM users WHERE username='$user' AND password='$pass'";
$result = $conn->query($sql);

if($result->num_rows > 0){
     $_SESSION['username'] = $user;
        header("Location: home.php");
        exit();
} else {
    echo "<script>
                alert('Invalid username or password');
              </script>";
        exit();
}

$conn->close();
?>