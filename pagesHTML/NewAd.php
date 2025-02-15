<?php
    include_once("../templates/header.php");
    include_once("../templates/footer.php");

    print_header();
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if(!isset($_SESSION['username'])){
        Header('Location:../pagesHTML/LoginPage.php');
    }

    $form_id = bin2hex(random_bytes(32));
    $_SESSION['csrf_token'][$form_id] = bin2hex(random_bytes(32));
?>

<link rel='stylesheet' href = 'CreateAccount.css'>
<link rel="stylesheet" href="style.css"> 


<!-- Gets the brands directly from the databse -->
<form action="../database/create_ad1.php" method="post" enctype="multipart/form-data"> <!-- change to create_ad1.php for debugging and create_ad.php for normal -->
    <h2>Create new ad</h2>

    <label for="brand">Brand:</label>
    <select id="brand_id_list" name="brand">
        <?php

        $db = new SQLite3('../database/database.db');

        $result = $db->query("SELECT name FROM brands");

        // Output brands as <option> elements
        while ($row = $result->fetchArray()) {
            echo '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
        }
        ?>
    </select>


<!-- Gets the models of the defined brand -->
    <label for="model">Model:</label>
    <select id="model" name="model">
        <!-- Models will be populated here -->
    </select>



<script defer>
    document.addEventListener('DOMContentLoaded', function () {
            console.log('DOM fully loaded and parsed');

            function updateModels() {
                console.log('updateModels called');
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
                console.log('fetchModels called');
                var xhr = new XMLHttpRequest();
                xhr.open('GET', '../database/get_models.php?brandId=' + brandId, true);
                xhr.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        var models = JSON.parse(this.responseText);
                        console.log(models);

                        var modelSelect = document.getElementById('model');
                        modelSelect.innerHTML = '';

                        for (var i = 0; i < models.length; i++) {
                            var option = document.createElement('option');
                            option.value = models[i];
                            option.text = models[i];
                            modelSelect.appendChild(option);
                        }

                        // Set the value of the "model" dropdown to the first model
                        if (models.length > 0) {
                            modelSelect.value = models[0];
                        }
                    }
                };
            xhr.send();
}
            document.getElementById("brand_id_list").addEventListener('change', updateModels);      
        }
    );

</script>



    <label for="description">Description:</label>
    <input type="text" id="description" name="description" required>
    
    <label for="location">Location:</label>
    <input type="text" id="location" name="location" required>

    <label for="condition">Condition:</label>
    <select id="condition" name="condition">
        <option value="Out of the box">Out of the box</option>
        <option value="As new">As new</option>
        <option value="Very good">Very good</option>
        <option value="Good">Good</option>
        <option value="Bad">Bad</option>
        <option value="For parts">For parts</option>
    </select>

    <label for="price">Price:</label>
    <input type="decimal" id="price" name="price" required> $

    <label for="image">Image:</label>
    <input type="file" id="image" name="image" accept="image/*">

  
    <input type="hidden" name="form_id" value="<?php echo $form_id; ?>">
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'][$form_id]; ?>">
    <input type="submit" value="Create Ad">
</form>


<?php print_footer(); ?>
</body>
</html>