<?php
    include_once("../templates/header.php");
    include_once("../templates/footer.php");
    
    // Access the parameters
    $brand = isset($_GET['brand']) ? $_GET['brand'] : 'all';
    $model = isset($_GET['model']) ? $_GET['model'] : 'all';
    $megapixels = isset($_GET['megapixels']) ? $_GET['megapixels'] : 'all';
    $price = isset($_GET['price']) ? $_GET['price'] : 'all';
    $display = isset($_GET['display']) ? $_GET['display'] : 'all';

    // Validate and sanitize the parameters
    $brand = filter_var($brand, FILTER_SANITIZE_STRING);
    $model = filter_var($model, FILTER_SANITIZE_STRING);
    $megapixels = filter_var($megapixels, FILTER_SANITIZE_STRING);
    $price = filter_var($price, FILTER_SANITIZE_STRING);
    $display = filter_var($display, FILTER_SANITIZE_STRING);

    // Use the parameters to filter your results
    // This depends on how your data is stored, so I can't provide a specific implementation

    print_header();
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Page</title>
    <link rel="stylesheet" href="searchpage.css"> <!-- futuro arquivo em css -->
</head>
<body>
    <div class="search">
        <label>[Applied Filter]</label>
        <label>Filter by:</label>
        <form>
            <label for="price">Price:</label>
            <select id="price">
                <option value="price">All</option>
            </select>
            <label for="condition">Condition:</label>
            <select id="condition">
                <option value="price">All</option>
            <select>
            <button type="submit">Filter</button>
        </form>
    </div>

    <?php print_footer(); ?>

</body>
</html>