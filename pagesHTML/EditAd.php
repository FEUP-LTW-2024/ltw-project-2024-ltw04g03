<?php
    include_once("../templates/header.php");
    include_once("../templates/footer.php");

    print_header();
?>

<link rel='stylesheet' href='CreateAccount.css'>
<link rel="stylesheet" href="style.css"> 

<?php
    // Fetch ad information from the database based on ad ID
    $ad_id = $_GET['ad_id']; // Assuming you pass the ad ID via URL parameter
    $db = new SQLite3('../database/database.db');
    $stmt = $db->prepare("SELECT * FROM ad WHERE id = :ad_id");
    $stmt->bindValue(':ad_id', $ad_id, SQLITE3_INTEGER);
    $result = $stmt->execute();
    $ad = $result->fetchArray(SQLITE3_ASSOC);
?>

<!-- Form for editing the ad -->
<form action="../database/edit_ad.php" method="post">
    <h2>Edit Ad</h2>

    <input type="hidden" name="ad_id" value="<?php echo $ad['id']; ?>">

    <label for="brand">Brand:</label>
    <input type="text" id="brand" name="brand" value="<?php echo $ad['brand']; ?>" readonly>

    <label for="model">Model:</label>
    <input type="text" id="model" name="model" value="<?php echo $ad['model']; ?>" readonly>

    <label for="description">Description:</label>
    <input type="text" id="description" name="description" value="<?php echo $ad['description']; ?>" required>
    
    <label for="location">Location:</label>
    <input type="text" id="location" name="location" value="<?php echo $ad['location']; ?>" required>

    <label for="condition">Condition:</label>
    <select id="condition" name="condition">
        <option value="Out of the box" <?php if($ad['condition'] == 'Out of the box') echo 'selected'; ?>>Out of the box</option>
        <option value="As new" <?php if($ad['condition'] == 'As new') echo 'selected'; ?>>As new</option>
        <option value="Very good" <?php if($ad['condition'] == 'Very good') echo 'selected'; ?>>Very good</option>
        <option value="Good" <?php if($ad['condition'] == 'Good') echo 'selected'; ?>>Good</option>
        <option value="Bad" <?php if($ad['condition'] == 'Bad') echo 'selected'; ?>>Bad</option>
        <option value="For parts" <?php if($ad['condition'] == 'For parts') echo 'selected'; ?>>For parts</option>
    </select>

    <label for="price">Price:</label>
    <input type="decimal" id="price" name="price" value="<?php echo $ad['price']; ?>" required> $

    <label for="image">Image:</label>
    <input type="file" id="image" name="image" accept="image/*">

    <input type="submit" value="Update Ad">
</form>

<?php print_footer(); ?>
</body>
</html>
