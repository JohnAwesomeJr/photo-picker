<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>List of Directories</title>
    <style>
        /* Custom styles for directory cards */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }
        .card {
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s;
            margin-bottom: 15px;
            display: flex;
            overflow: hidden;
        }
        .card:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-img {
            width: 150px;
            height: auto;
            border-top-left-radius: 5px;
            border-bottom-left-radius: 5px;
            object-fit: cover;
        }
        .card-content {
            flex: 1;
            padding: 15px;
        }
        .card-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .card-link {
            display: block;
            text-decoration: none;
            color: #333333;
            background:#2be3f7;
            padding: 10px 15px;
            transition: background-color 0.3s;
            width: fit-content;
        }
        .card-link:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>List of Directories:</h2>
        <div class="row">
            <?php
            // Function to get relative path from current script to a file
            function getRelativePath($file) {
                $absolutePath = realpath($file);
                $basePath = realpath(dirname(__FILE__));
                $relativePath = str_replace($basePath, '', $absolutePath);
                return ltrim($relativePath, '/');
            }

            // Get the current directory path
            $currentDir = dirname(__FILE__);

            // Scan the directory for directories only
            $directories = glob($currentDir . '/*', GLOB_ONLYDIR);

            // Loop through the directories
            foreach ($directories as $directory) {
                // Get the directory name
                $dirName = basename($directory);

                // Check if a "photos" directory exists in this directory
                $photosDir = $directory . '/photos';
                $photo = '';

                if (is_dir($photosDir)) {
                    // Get the first image file in the "photos" directory
                    $imageFiles = glob($photosDir . '/*.{webp}', GLOB_BRACE);
                    if (!empty($imageFiles)) {
                        // Get the relative path to the image
                        $photo = getRelativePath($imageFiles[0]);
                    }
                }

                // Create a card for each directory
                echo '<div class="col-md-6">';
                echo '<div class="card">';
                
                // Display image if available, otherwise show default image or nothing
                if (!empty($photo)) {
                    echo '<img src="' . $photo . '" class="card-img" alt="Directory Image">';
                } else {
                    echo '<div class="card-img" style="background-color: #e9ecef;"></div>';
                }

                echo '<div class="card-content">';
                echo '<h5 class="card-title">' . $dirName . '</h5>';
                echo '<a href="' . $dirName . '" class="card-link">Open Directory</a>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</body>
</html>