<?php
    include_once("../templates/header.php");
    include_once("../templates/footer.php");

    print_header();
?>

<link rel='stylesheet' href = 'CreateAccount.css'>


<!-- Gets the brands directly from the databse -->
<form action="../database/create_ad.php" method="post">
    <h2>Create new ad</h2>

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


<!-- Gets the models of the defined brand -->
    <label for="model">Model:</label>
    <select id="model" name="model">
        <!-- Models will be populated here -->
    </select>



<script>
function updateModels() {
    console.log('updateModels called');

    var brandName = document.getElementById('brand').value;
    //console.log(brandName);
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '../database/get_brand_id.php?brandName=' + brandName, true);
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var brandId = this.responseText;
            //console.log(brandId);
            var trimmedbrandId = brandId.replace(/^[a-zA-Z]+/, ''); //it was giving Aplle3 instead of just 3
            //console.log(trimmedbrandId);
            
            fetchModels(trimmedbrandId);
            
        }
    };
    xhr.send();
}

function fetchModels(brandId) {
    //console.log('fetchModels called');
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '../database/get_models.php?brandId=' + brandId, true);
    console.log('fetchModels called');
    xhr.onreadystatechange = function() { 
        console.log('entrei na função');
        if (this.readyState == 4 && this.status == 200) {
            var models = JSON.parse(this.responseText);
            console.log(models);

            var modelSelect = document.getElementById('model');

            // Clear existing options
            modelSelect.innerHTML = '';

            // Add new options
           for (var i = 0; i < models.length; i++) {
                var option = document.createElement('option');
                option.value = models[i];
                option.text = models[i];
                modelSelect.appendChild(option);
            }
        }
    };
    xhr.send();
}

// Attach updateModels to the onchange event of the brand dropdown
document.getElementById('brand').onchange = updateModels;
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

  

    <input type="submit" value="Create Ad">
</form>


<?php print_footer(); ?>
</body>
</html>