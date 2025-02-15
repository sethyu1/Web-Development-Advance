<!----------------
    
    Assignment 3: Blog Application
    Name: Shiqi Yu
    Date: 07 February 2025
    Description: Show the full page of a post.
------------------>

<?php

require('connect.php');

    if(!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        header('Location: index.php');
        exit();
    }

    

    $query = "SELECT title, content, timestamp FROM blogs WHERE id = :id";
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $post =$statement->fetch(PDO::FETCH_ASSOC);

    if(!$post) {
        header('location: index.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title><?= $post['title'] ?></title>
</head>
<body>
    <!-- Remember that alternative syntax is good and html inside php is bad -->
    <h1><?= $post['title'] ?></h1>
    <p><strong>Posted on:</strong> <?= date('F d, Y, h:i A', strtotime($post['timestamp'])) ?></p>
    <p><?= $post['content'] ?></p>
    <p><a href="edit.php?id=<?= $id ?>">Edit Post</a></p>
</body>
</html>