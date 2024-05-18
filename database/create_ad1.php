
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch form data
    $brand = $_POST['brand'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $condition = $_POST['condition'];
    $price = $_POST['price'];
    $model = $_POST['model'];

?> <script>
var model = <?php echo json_encode($model); ?>;
console.log(model);
</script> <?php

    // Handle image upload
    $image_path = '';

    ?> <script>
    var img = <?php echo json_encode(basename($_FILES['image']['name'])); ?>;
    console.log(img);
    </script> <?php

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_path = '../docs/uploads/' . basename($_FILES['image']['name']);
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
            echo "Error uploading image.";
            exit;
        }
    }

    ?> <script>
    var img = <?php echo json_encode($image_path); ?>;
    console.log(img);
    </script> <?php


    // Fetch seller username from session
    if (!isset($_SESSION['username'])) {
        echo "User not logged in.";
        exit;
    }
    $seller_username = $_SESSION['username'];

    // Fetch device_id from fetch_device_id.php
    $device_id = null;  // Initialize $device_id variable to avoid potential issues

    include_once('../database/fetch_device_id.php');
    $model = $_POST['model'];
    $device_id = fetchDeviceId($model);



    ?> <script>
    var model = <?php echo json_encode($device_id); ?>;
    console.log(model);
    </script> <?php


    if (!$device_id) {
        echo "Device ID could not be retrieved.";
        exit;
    }

    // Create a new SQLite3 instance and open the database
    $db = new SQLite3('../database/database.db');

    // Prepare the SQL statement
    $sql_statement = 'INSERT INTO AD (device_id, seller_username, brand, model, condition, location, price, image_path, description) VALUES (:device_id, :seller_username, :brand, :model, :condition, :location, :price, :image_path, :description)';
    $stmt = $db->prepare($sql_statement);

    ?> <script>
var model = <?php echo json_encode($model); ?>;
console.log(model);
</script> <?php

    // Bind parameters
    $stmt->bindParam(':device_id', $device_id);
    $stmt->bindParam(':seller_username', $seller_username);
    $stmt->bindParam(':brand', $brand);
    $stmt->bindParam(':model', $model);
    $stmt->bindParam(':condition', $condition);
    $stmt->bindParam(':location', $location);
    $stmt->bindParam(':price', $price); // Ensure price is bound as a float
    $stmt->bindParam(':image_path', $image_path); // Handle null explicitly
    $stmt->bindParam(':description', $description);
    

    // Retry logic for database locked error
    $max_retries = 5;
    $retry_count = 0;
    $retry_delay = 100; // Milliseconds

    while ($retry_count < $max_retries) {
        try {
            if ($stmt->execute()) {
                // update the users role to seller
                include_once('../database/update_user.php'); //not working properly
                

                //header("Location: ../pagesHTML/Mainpage.php");
                exit;
            } else {
                throw new Exception($db->lastErrorMsg());
            }
        } catch (Exception $e) {
            if ($db->lastErrorCode() == 5) { // SQLITE_BUSY error code
                $retry_count++;
                usleep($retry_delay * 1000); // Convert to microseconds
            } else {
                // Display detailed error information
                echo "Error: Could not create ad.<br>";
                echo "SQLite Error: " . $e->getMessage() . "<br>";
                echo "SQL Statement: " . htmlspecialchars($sql_statement) . "<br>";
                echo "Device ID: " . htmlspecialchars($device_id) . "<br>";
                echo "Seller Username: " . htmlspecialchars($seller_username) . "<br>";
                echo "Brand: " . htmlspecialchars($brand) . "<br>";
                echo "Model: " . htmlspecialchars($model) . "<br>";
                echo "Condition: " . htmlspecialchars($condition) . "<br>";
                echo "Location: " . htmlspecialchars($location) . "<br>";
                echo "Price: " . htmlspecialchars($price) . "<br>";
                echo "Image Path: " . htmlspecialchars($image_path) . "<br>";
                echo "Description: " . htmlspecialchars($description) . "<br>";
                exit;
            }
        }
    }

    // If we exhausted retries
    echo "Error: Could not create ad after $max_retries retries due to database lock.<br>";
    echo "SQL Statement: " . htmlspecialchars($sql_statement) . "<br>";
    echo "Device ID: " . htmlspecialchars($device_id) . "<br>";
    echo "Seller Username: " . htmlspecialchars($seller_username) . "<br>";
    echo "Brand: " . htmlspecialchars($brand) . "<br>";
    echo "Model: " . htmlspecialchars($model) . "<br>";
    echo "Condition: " . htmlspecialchars($condition) . "<br>";
    echo "Location: " . htmlspecialchars($location) . "<br>";
    echo "Price: " . htmlspecialchars($price) . "<br>";
    echo "Image Path: " . htmlspecialchars($image_path) . "<br>";
    echo "Description: " . htmlspecialchars($description) . "<br>";
}
?>
