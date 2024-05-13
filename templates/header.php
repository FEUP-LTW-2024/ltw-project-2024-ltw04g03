<?php
    declare(strict_types = 1);
    session_start();
function print_header() { ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Techtudo</title>
    <link rel="stylesheet" href="../pagesHTML/style.css">
</head>
<header>
        <div class="logo">
            <a href="Mainpage.php">
                <img src="../docs/TechTudo_logo.png" alt="Logo do site">
            </a>
            <a href="ShoppingCart.php">Shopping Cart</a>
        </div>
        <div class="filter-bar">
            <form action="searchpage.php" method="GET">
                <label for="brand">Brand:</label>
                <select id="brand" name="brand">
                    <?php

                    $db = new SQLite3('../database/database.db');

                    $result = $db->query("SELECT name FROM brands");

                    // Output brands as <option> elements
                    while ($row = $result->fetchArray()) {
                        echo '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
                    }
                    ?>
                </select>

                <label for="released_at">Year:</label>
                <select id="released_at" name="released_at">
                    <option value="all">All years</option>
                    <?php
                    
                    $db = new SQLite3('../database/database.db');

                    $result = $db->query("SELECT released_at FROM devices");

                    // Checks every release year of the devices and organizes them
                    $years = array();
                    while ($row = $result->fetchArray()) {
                        $year = substr($row['released_at'], 0, 4);
                        
                        // Check if the year already exists in the array
                        if (!in_array($year, $years)) {
                            $years[] = $year;
                        }
                    }

                    
                    sort($years);

                    // Output the options
                    foreach ($years as $year) {
                        echo '<option value="' . $year . '">' . $year . '</option>';
                    }
                    ?>
                </select>

                <label for="storage">Storage:</label>
                <select id="storage" name="storage">
                    <option value="all">All storage</option>
                    <?php
                    
                    $db = new SQLite3('../database/database.db');

                    $result = $db->query("SELECT storage FROM devices");

                    // Checks every storage of the devices and organizes them
                    $storages = array();
                    while ($row = $result->fetchArray()) {
                        
                        // Check if the storage already exists in the array
                        if (!in_array($row['storage'], $storages)) {
                            $storages[] = $row['storage'];
                        }
                    }

                    
                    sort($storages);

                    // Output the options
                    foreach ($storages as $storage) {
                        echo '<option value="' . $storage . '">' . $storage . '</option>';
                    }
                    ?>
                </select>

                

                <label for="RAM">Memory RAM:</label>
                <select id="RAM" name="RAM">
                    <option value="all">All RAM</option>
                    <?php
                    
                    $db = new SQLite3('../database/database.db');

                    $result = $db->query("SELECT ram FROM devices");

                    // Checks every ram of the devices and organizes them
                    $rams = array();
                    while ($row = $result->fetchArray()) {
                        
                        // Check if the ram already exists in the array
                        if (!in_array($row['ram'], $rams)) {
                            $rams[] = $row['ram'];
                        }
                    }

                    
                    sort($rams);

                    // Output the options
                    foreach ($rams as $ram) {
                        echo '<option value="' . $ram . '">' . $ram . '</option>';
                    }
                    ?>
                </select>


                <label for="display">Display:</label>
                <select id="display" name="display">
                    <option value="all">All displays</option>
                    <option value="4+">4-5 inches</option>
                    <option value="5+">5-6 inches</option>
                    <option value="6+">6-7 inches</option>
                    <option value="7+">7-8 inches</option>
                    <option value="8+">8+ inches</option>
                </select>

                <label for="camera">Camera:</label>
                <select id="camera" name="camera">
                <option value="all">All</option>
                    <?php
                    
                    $db = new SQLite3('../database/database.db');

                    $result = $db->query("SELECT camera_pixels FROM devices");

                    // Checks every camera quality of the devices and organizes them
                    $cameras = array();
                    while ($row = $result->fetchArray()) {
                        
                        // Check if the camera quality already exists in the array
                        if (!in_array($row['camera_pixels'], $cameras)) {
                            $cameras[] = $row['camera_pixels'];
                        }
                    }

                    
                    sort($cameras);

                    // Output the options
                    foreach ($cameras as $camera) {
                        echo '<option value="' . $camera . '">' . $camera . '</option>';
                    }
                    ?>
                </select>

                <button type="submit">Filter</button>
            </form>
        </div>
        <div class="account">
            <?php if($_SESSION['loggedin']){ ?>
                <a href="NewAd.php">New ad</a>
            <?php } ?>
            <a href="LoginPage.php">Login/Register</a>
            <a href="notifications.html">Notifications</a> <!-- Notifications button -->
        </div>
</header>
<?php
}
?>