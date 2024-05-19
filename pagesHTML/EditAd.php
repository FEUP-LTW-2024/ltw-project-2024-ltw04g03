<?php
include_once("../templates/header.php");
include_once("../templates/footer.php");

print_header();

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: LoginPage.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ad_id'])) {
    $ad_id = $_POST['ad_id'];

    // Fetch the ad details from the database
    $db = new SQLite3('../database/database.db');
    $stmt = $db->prepare('SELECT * FROM AD WHERE id = :ad_id');
    $stmt->bindValue(':ad_id', $ad_id, SQLITE3_INTEGER);
    $result = $stmt->execute();
    $ad = $result->fetchArray(SQLITE3_ASSOC);

    if (!$ad) {
        echo "Ad not found.";
        exit;
    }
} else {
    echo "Invalid request.";
    exit;
}

$form_id = bin2hex(random_bytes(32));
$_SESSION['csrf_token'][$form_id] = bin2hex(random_bytes(32));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Ad</title>
    <link rel="stylesheet" href="editprofile.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1 id="editProfileTitle">Edit Ad</h1>

<form id="editProfileForm" action="../database/update_ad.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="form_id" value="<?php echo $form_id; ?>">
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'][$form_id]; ?>">
    <input type="hidden" name="ad_id" value="<?php echo htmlspecialchars($ad['id']); ?>">
    <input type="hidden" name="current_image_path" value="<?php echo htmlspecialchars($ad['image_path']); ?>">

    <label for="brand">Brand:</label>
    <select id="brand_id_list" name="brand">
        <?php
        $result = $db->query("SELECT name FROM brands");
        while ($row = $result->fetchArray()) {
            $selected = ($row['name'] == $ad['brand']) ? 'selected' : '';
            echo '<option value="' . htmlspecialchars($row['name']) . '" ' . $selected . '>' . htmlspecialchars($row['name']) . '</option>';
        }
        ?>
    </select>

    <label for="model">Model:</label>
    <select id="model" name="model">
        <option value="<?php echo htmlspecialchars($ad['model']); ?>"><?php echo htmlspecialchars($ad['model']); ?></option>
    </select>

    <script defer>
        document.addEventListener('DOMContentLoaded', function () {
            function updateModels() {
                var brandName = document.getElementById("brand_id_list").value;
                var xhr = new XMLHttpRequest();
                xhr.open('GET', '../database/get_brand_id.php?brandName=' + brandName, true);
                xhr.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        var brandId = this.responseText.trim();
                        var trimmedBrandId = brandId.replace(/^[a-zA-Z]+/, '');
                        fetchModels(trimmedBrandId);
                    }
                };
                xhr.send();
            }

            function fetchModels(brandId) {
                var xhr = new XMLHttpRequest();
                xhr.open('GET', '../database/get_models.php?brandId=' + brandId, true);
                xhr.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        var models = JSON.parse(this.responseText);
                        var modelSelect = document.getElementById('model');
                        modelSelect.innerHTML = '';

                        for (var i = 0; i < models.length; i++) {
                            var option = document.createElement('option');
                            option.value = models[i];
                            option.text = models[i];
                            modelSelect.appendChild(option);
                        }

                        if (models.length > 0) {
                            modelSelect.value = models[0];
                        }
                    }
                };
                xhr.send();
            }

            document.getElementById("brand_id_list").addEventListener('change', updateModels);
            updateModels();
        });
    </script>


    <label for="description">Description:</label>
    <input type="text" id="description" name="description" value="<?php echo htmlspecialchars($ad['description']); ?>" required>

    <label for="location">Location:</label>
    <input type="text" id="location" name="location" value="<?php echo htmlspecialchars($ad['location']); ?>" required>

    <label for="condition">Condition:</label>
    <select id="condition" name="condition">
        <?php
        $conditions = ["Out of the box", "As new", "Very good", "Good", "Bad", "For parts"];
        foreach ($conditions as $condition) {
            $selected = ($condition == $ad['condition']) ? 'selected' : '';
            echo '<option value="' . htmlspecialchars($condition) . '" ' . $selected . '>' . htmlspecialchars($condition) . '</option>';
        }
        ?>
    </select>

    <label for="price">Price:</label>
    <input type="number" step="0.01" id="price" name="price" value="<?php echo htmlspecialchars($ad['price']); ?>" required> $

    <label for="image">Image:</label>
    <input type="file" id="image" name="image" accept="image/*">
    <p>Current Image:</p>
    <img src="<?php echo htmlspecialchars($ad['image_path']); ?>" alt="<?php echo htmlspecialchars($ad['brand'] . ' ' . $ad['model']); ?>" style="height:200px;">

    <button id="editProfileSubmit" type="submit">Save Changes</button>
</form>

<?php print_footer(); ?>
</body>
</html>
