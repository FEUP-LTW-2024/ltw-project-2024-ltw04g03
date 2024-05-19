<?php
    declare(strict_types = 1);
    ini_set('session.cookie_httponly', 1);
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
<header class="header">
        <div class="logo">
            <a id="logophoto" href="Mainpage.php">
                <img src="../docs/TechTudo_logo.png" alt="Logo do site">
            </a>
            <a href="ShoppingCart.php">Shopping Cart</a>
        </div>
        <div class="filter-bar">
            <form action="searchpage.php" method="GET">
                <label for="brand">Brand:</label>
                <select id="brand" name="brand">
                    <option value="All">All brands</option>
                    <?php

                    $db = new SQLite3('../database/database.db');

                    $result = $db->query("SELECT name FROM brands");

                    // Output brands as <option> elements
                    while ($row = $result->fetchArray()) {
                        $selected = (isset($_GET['brand']) && $_GET['brand'] == $row['name']) ? 'selected' : '';
                        echo '<option value="' . $row['name'] . '" ' . $selected . '>' . $row['name'] . '</option>';
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
                        $selected = (isset($_GET['released_at']) && $_GET['released_at'] == $year) ? 'selected' : '';
                        echo '<option value="' . $year . '" ' . $selected . '>' . $year . '</option>';
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
                        $selected = (isset($_GET['storage']) && $_GET['storage'] == $storage) ? 'selected' : '';
                        echo '<option value="' . $storage . '" ' . $selected . '>' . $storage . '</option>';
                    }
                    
                    ?>
                </select>

                

                <label for="RAM">Memory RAM:</label>
                <select id="RAM" name="RAM">
                    <option value="all">All</option>
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
                        $selected = (isset($_GET['RAM']) && $_GET['RAM'] == $ram) ? 'selected' : '';
                        echo '<option value="' . $ram . '" ' . $selected . '>' . $ram . '</option>';
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
                        $selected = (isset($_GET['camera']) && $_GET['camera'] == $camera) ? 'selected' : '';
                        echo '<option value="' . $camera . '" ' . $selected . '>' . $camera . '</option>';
                    }
                    
                    ?>
                </select>

                <button type="submit">Filter</button>
            </form>
        </div><?php
        $username = $_SESSION['username'];
        include_once('../database/fetch_pfp.php'); ?>

        <div class="account">
          <?php  if(!$_SESSION['loggedin'] OR !isset($_SESSION['loggedin'])){
         echo '<a id="profilephoto" href="ProfilePage.php?username=' . $_SESSION['username'] . '"> 
              <img src="../docs/profile_images/default_pfp.jpg" alt="Profile Picture" style="width: 30px; height: 30px; border-radius: 50%">
          </a>';}else{
          echo '<a id="profilephoto" href="ProfilePage.php?username=' . $_SESSION['username'] . '"> 
              <img src="' .$profile_image . '" alt="Profile Picture" style="width: 30px; height: 30px;  border-radius: 50%">
          </a>';}?>
            <?php if($_SESSION['loggedin']){ ?>
                <a href="NewAd.php">New ad</a>
            <?php } ?>
            <a href="LoginPage.php">Login/Register</a>
            
        </div>
</header>
<?php
}
?>