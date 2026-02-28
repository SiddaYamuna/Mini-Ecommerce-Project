<html>
<?php
session_start();

$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "login_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user = $_POST['username'];
$pass = $_POST['password'];

// (optional) check if username already exists
$checkSql = "SELECT * FROM users WHERE username='$user'";
$checkResult = $conn->query($checkSql);

if ($checkResult->num_rows > 0) {
    echo "<script>
                alert('Username already exists. Please choose another.');
              </script>";
        exit();
} else {
    // insert new user
    $sql = "INSERT INTO users (username, password) VALUES ('$user', '$pass')";

    if ($conn->query($sql) === TRUE) {
        // automatically log in the new user
        $_SESSION['username'] = $user;
        header("Location:home.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
</html>














  