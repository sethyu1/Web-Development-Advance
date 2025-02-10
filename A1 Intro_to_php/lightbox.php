<?php

/*******2025 Winter******** 
    
    Name: Shiqi Yu
    Date: 12 January 2025
    Description: Assignment 1 Introduction to PHP

****************/

/*
$config = [

    'gallery_name' => 'Name of Your Gallery',
 
    'unsplash_categories' => ['array','of','category','keywords'],
 
    'local_images' => ['array','of','local','image','filenames']
 
];
*/

$config = [

    'gallery_name' => 'Seth Gallery',
 
    'local_images' => [
        [
            'name' => 'camera',
            'photographer' => 'Vadim Sherbakov',
            'url' => 'https://unsplash.com/@madebyvadim'
        ],
        [
            'name' => 'concrete',
            'photographer' => 'Margaret Barley',
            'url' => 'https://unsplash.com/@margaretbarley'

        ],
        [
            'name' => 'newyork',
            'photographer' => 'Oleg Chursin',
            'url' => 'https://unsplash.com/@olegchursin'
        ],
        [
            'name' => 'road',
            'photographer' => 'Nicholas Swanson',
            'url' => 'https://unsplash.com/@nicholasswanson'
        ]
    ]
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/luminous-lightbox/2.0.1/luminous-basic.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/luminous-lightbox/2.0.1/Luminous.min.js"></script>

    <title>Lightbox Gallery</title>
</head>
<body>
    <!-- Remember that alternative syntax is good and html inside php is bad -->
    
    <!-- Gallery name -->
    <h1><?php echo $config['gallery_name']; ?></h1>

    <!-- Display images with Thumbnails -->
    <!-- Image format: <img src="images/camera.png" alt="camera"> -->
    <!-- Link format: <a href="http://www.twitter.com">Value Size</a> -->
    <div class="image-gallery">
        <?php foreach ($config['local_images'] as $image): ?> 
           <div>
                <a href="images/<?= $image['name'] ?>.jpg" class = "luminous-link">
                    <img src="images/<?= $image['name'] ?>_thumbnail.jpg" alt="<?= $image['name'] ?>">
                </a>
           </div>
        <?php endforeach; ?>
    </div>

    <script>
        new LuminousGallery(document.querySelectorAll(".image-gallery .luminous-link"));
    </script>

</body>
</html>