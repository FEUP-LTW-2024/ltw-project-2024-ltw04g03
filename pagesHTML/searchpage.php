<?php
    include_once("../templates/header.php");
    include_once("../templates/footer.php");

    print_header();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechTudo</title>
    <link rel="stylesheet" href="MainPage.css">
    <link rel="stylesheet" href="style.css"> 
</head>
<body class="search-page">
<main>
    <div class="background">
        <div class="page-inner-content">
            <!-- Ordering Form -->
            <form method="GET" action="../pagesHTML/searchpage.php" id="orderForm">
                <input type="hidden" name="brand" value="<?php echo htmlspecialchars($_GET['brand'] ?? ''); ?>">
                <input type="hidden" name="released_at" value="<?php echo htmlspecialchars($_GET['released_at'] ?? ''); ?>">
                <input type="hidden" name="storage" value="<?php echo htmlspecialchars($_GET['storage'] ?? ''); ?>">
                <input type="hidden" name="RAM" value="<?php echo htmlspecialchars($_GET['RAM'] ?? ''); ?>">
                <input type="hidden" name="display" value="<?php echo htmlspecialchars($_GET['display'] ?? ''); ?>">
                <input type="hidden" name="camera" value="<?php echo htmlspecialchars($_GET['camera'] ?? ''); ?>">
                <label for="order">Order by Price:</label>
                <select name="order" id="order" onchange="document.getElementById('orderForm').submit();">
                    <option value="asc" <?php echo isset($_GET['order']) && $_GET['order'] == 'asc' ? 'selected' : ''; ?>>Ascending</option>
                    <option value="desc" <?php echo isset($_GET['order']) && $_GET['order'] == 'desc' ? 'selected' : ''; ?>>Descending</option>
                </select>
            </form>

            <h1 class="section-title">Filtered Ads</h1>
            <div class="underline"></div>

            <div class="Products-row">
                <?php
                // Include database connection
                $db = new PDO('sqlite:../database/database.db');

                // Base query with JOIN
                $query = "SELECT ad.*, devices.storage, devices.released_at, devices.ram, devices.display_size, devices.camera_pixels
                          FROM ad 
                          JOIN devices ON ad.device_id = devices.id 
                          WHERE 1=1";

                // Array to hold parameters for the prepared statement
                $params = [];

                // Check if brand is set and not "All"
                if (isset($_GET['brand']) && $_GET['brand'] !== 'All') {
                    $query .= " AND ad.brand = :brand";
                    $params[':brand'] = $_GET['brand'];
                }

                // Check if storage is set and not "all"
                if (isset($_GET['storage']) && $_GET['storage'] !== 'all') {
                    $query .= " AND devices.storage = :storage";
                    $params[':storage'] = $_GET['storage'];
                }

                // Check if year (released_at) is set and not "all"
                if (isset($_GET['released_at']) && $_GET['released_at'] !== 'all') {
                    $query .= " AND strftime('%Y', devices.released_at) = :released_at";
                    $params[':released_at'] = $_GET['released_at'];
                }

                // Check if RAM is set and not "all"
                if (isset($_GET['RAM']) && $_GET['RAM'] !== 'all') {
                    $query .= " AND devices.ram = :RAM";
                    $params[':RAM'] = $_GET['RAM'];
                }

                // Check if display is set and not "all"
                if (isset($_GET['display']) && $_GET['display'] !== 'all') {
                    $query .= " AND devices.display_size LIKE :display";
                    switch ($_GET['display']) {
                        case '4+':
                            $params[':display'] = '4%';
                            break;
                        case '5+':
                            $params[':display'] = '5%';
                            break;
                        case '6+':
                            $params[':display'] = '6%';
                            break;
                        case '7+':
                            $params[':display'] = '7%';
                            break;
                        case '8+':
                            $params[':display'] = '8%';
                            break;
                    }
                }

                // Check if camera is set and not "all"
                if (isset($_GET['camera']) && $_GET['camera'] !== 'all') {
                    $query .= " AND devices.camera_pixels = :camera";
                    $params[':camera'] = $_GET['camera'];
                }

                // Check if order is set and valid
                $order = 'ASC';
                if (isset($_GET['order']) && in_array($_GET['order'], ['asc', 'desc'])) {
                    $order = strtoupper($_GET['order']);
                }
                $query .= " ORDER BY ad.price $order";

                $stmt = $db->prepare($query);

                // Bind parameters
                foreach ($params as $key => $value) {
                    $stmt->bindValue($key, $value);
                }

                $stmt->execute();
                $ads = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // Display the fetched ads
                if ($ads) {
                    foreach ($ads as $ad) {
                        echo '<div class="Products">';
                    echo '<form id="productForm' . $ad['id'] . '" action="ProductPage.php" method="get">';
                    echo '<input type="hidden" name="id" value="' . $ad['id'] . '">';
                    echo '<input type="hidden" name="username" value="' . $ad['seller_username'] . '">';
                    echo '<a href="#" onclick="document.getElementById(\'productForm' . $ad['id'] . '\').submit();" class="Product-link">';
                    echo '<img src="' . htmlspecialchars($ad['image_path']) . '" alt="Product Image">';
                    echo '<div class="Product-details">';
                    echo '<p class="Model">Model: ' . htmlspecialchars($ad['model']) . '</p>';
                    echo '<p class="Condition">Condition: ' . htmlspecialchars($ad['condition']) . '</p>';
                    echo '<p class="Price">Price: ' . htmlspecialchars($ad['price']) . '$' . '</p>';
                    echo '</div>';
                    echo '</a>';
                    echo '</form>';
                    echo '</div>';
                    }
                } else {
                    echo '<p>No ads found.</p>';
                }
                ?>
            </div>
        </div>
    </div>
</main>

<?php print_footer(); ?>
</body>
</html>
