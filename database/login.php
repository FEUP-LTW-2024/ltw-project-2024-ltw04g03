<?php
// Database connection parameters
$servername = "localhost";
$username = "your_db_username";
$password = "your_db_password";
$database = "your_database_name";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve username and password from the form submission
$username = $_POST['username'];
$password = $_POST['password'];

// Prepare SQL statement to check if the username and password match
$sql = "SELECT * FROM User WHERE username='$username' AND password='$password'";
$result = $conn->query($sql);

// Check if any rows were returned
if ($result->num_rows > 0) {
    // Login successful
    echo "<script>
            alert('Login successful!');
            window.location.href = 'login.html'; // Redirect to login page
          </script>";
} else {
    // Login failed
    echo "<script>
            alert('Incorrect username or password.');
            window.location.href = 'login.html'; // Redirect to login page
          </script>";
}

// Close connection
$conn->close();
?>
