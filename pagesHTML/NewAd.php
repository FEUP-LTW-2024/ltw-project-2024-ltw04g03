<?php
    include_once("../templates/header.php");
    include_once("../templates/footer.php");

    print_header();
?>

<link rel='stylesheet' href = 'CreateAccount.css'>
<link rel="stylesheet" href="style.css"> 

<form action="../database/create_ad.php" method="post">
    <h2>Create new ad</h2>

    <label for="brand">Brand:</label>
    <select id="brand" name="brand">
        <option value="Samsung">Samsung</option>
        <option value="Xiaomi">Xiaomi</option>
        <option value="Apple">Apple</option>
        <option value="Google">Google</option>
        <option value="Huawei">Huawei</option>
        <option value="Nokia">Nokia</option>
        <option value="Microsoft">Microsoft</option>
        <option value="Oppo">Oppo</option>
    </select>

    <!-- POR FAZER. de preferencia com o GetModelByBrand-->
   <!-- Present all the models of the selected brand as options 
<label for="model">Model:</label>
<select id="model" name="model">
<?php/*
    include_once("../database/fetch_models.php");

    // Loop through the fetched models and display them
    foreach ($models as $model) {
        $model_name = $model['model']; // Corrected typo here

        echo "<option value='$model_name'>$model_name</option>";
    }*/
?>
</select>-->

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