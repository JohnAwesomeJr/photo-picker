<?php
require '/var/www/html/env.php';
// Get the protocol
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';

// Get the domain
$domain = $_SERVER['HTTP_HOST'];

// Get the current path
$path = $_SERVER['REQUEST_URI'];

// Combine them to form the full URL
$fullUrl = $protocol . $domain . $path;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photo Gallery</title>
    <style>
        /* Reset and basic styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            padding: 20px;
        }
        .centerContainer{
            display:flex;
            flex-direction: column;
            justify-content:start;
            align-items:center
        }
        
        /* Gallery grid */
        .gallery {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 20px;
            margin-top: 20px;
            max-width:900px;
        }
        
        /* Card styles */
        .card {
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            margin-bottom: 20px;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .card img {
            width: 100%;
            height: auto;
            display: block;
        }
        .card-content {
            padding: 15px;
        }
        .card-title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .card-checkbox {
            margin-bottom: 10px;
        }
        
        /* Sticky bar at the bottom */
        .sticky-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #ffffff;
            padding: 10px;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .total-price {
            font-size: 18px;
            font-weight: bold;
        }
        .buy-button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .buy-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<form action="<?php echo $_SERVER['REQUEST_URI'];?>thank-you.php" method="post">
<div class="centerContainer">
<div class="gallery">
    <?php
    $photosDir = './photos';
    $photos = scandir($photosDir);

    foreach ($photos as $photo) {
        if ($photo != '.' && $photo != '..') {
            echo '<div class="card">';
            echo '<img src="' . $photosDir . '/' . $photo . '" alt="' . $photo . '">';
            echo '<div class="card-content">';
            echo '<div class="card-title">' . $photo . '</div>';
            echo '<label class="card-checkbox">';
            echo '<input type="checkbox" name="checkedPhotos[]" class="photo-checkbox" value="' . $photo . '"> Add to Cart';
            echo '</label>';
            echo '</div>';
            echo '</div>';
        }
    }
    ?>
</div>
</div>


<div class="sticky-bar">
    <span class="total-price">Total Price: $<span id="total-price">0</span></span>
    <input type='hidden' name="url" value="<?php echo $fullUrl; ?>">
    <button type="submit" class="buy-button">Buy</button>

</div>
</form>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxes = document.querySelectorAll('.photo-checkbox');
        const totalPriceElement = document.getElementById('total-price');

        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                let totalPrice = 0;
                checkboxes.forEach(function(checkbox) {
                    if (checkbox.checked) {
                        totalPrice += <?= $GLOBAL_pricePerPhoto;?>; // $ per photo
                    }
                });
                totalPriceElement.textContent = totalPrice;
            });
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.card');

        cards.forEach(function(card) {
            const checkbox = card.querySelector('.photo-checkbox');

            card.addEventListener('click', function() {
                checkbox.checked = !checkbox.checked;

                // Trigger change event manually to update total price
                checkbox.dispatchEvent(new Event('change'));
            });
        });
    });
</script>

</body>
</html>
