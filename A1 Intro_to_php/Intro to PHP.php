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
    <title>Assignment 1</title>
</head>
<body>
    <!-- Remember that alternative syntax is good and html inside php is bad -->
    
    <!-- Gallery name -->
    <h1><?php echo $config['gallery_name']; ?></h1>

    <!-- Number of Large Images -->
    <h2><?php echo count($config['local_images']) . " Large Images"; ?></h2>

    <!-- Display images in the gallery -->
    <!-- Image format: <img src="images/camera.png" alt="camera"> -->
    <!-- Link format: <a href="http://www.twitter.com">Value Size</a> -->
    <div id="large-images">
        <?php foreach ($config['local_images'] as $image): ?> 
           <div>
               <img src="images/<?php echo $image['name'] ?>.jpg" alt ="Gallery Image">
               <p>Photo by <a href ="<?php echo $image['url']; ?>"> <?php echo $image['photographer']; ?></a></p>
           </div>
        <?php endforeach; ?>
    </div>
</body>
</html>