<!----------------
    
    Assignment 3: Blog Application
    Name: Shiqi Yu
    Date: 07 February 2025
    Description: Main Page link to database and show first five posts.

------------------>

<?php
    require('connect.php');

    $query = "SELECT * FROM blogs ORDER BY id DESC LIMIT 5";

    // Prepare a PDO statement
    $statement = $db->prepare($query);

    // Execute the statement
    $statement->execute();

    // Fetch DB
    $posts = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Welcome to my Blog!</title>
</head>
<body>
    <!-- Remember that alternative syntax is good and html inside php is bad -->
    <div class="title">
        WELCOME TO MY BLOG - Seth Yu
    </div>

    <div class="navbar">
        <a href="index.php">Home</a>
        <a href="create.php">New Post</a>
    </div>

    <section>
    <h1>Blog Posts</h1>

    <?php foreach ($posts as $post): ?> 
        <h2><a href="post.php?id=<?= $post['id'] ?>"> <?= $post['title'] ?> </a></h2>
        <p><strong>Posted on:</strong> <?= date('F d, Y, h:i A', strtotime($post['timestamp'])) ?> - <a href="edit.php?id=<?= $post['id'] ?>">edit</a> </p>
        
        <p><?= strlen($post['content']) > 200 ? substr($post['content'], 0, 200) . '...' : $post['content'] ?>
        <?php if (strlen($post['content']) > 200): ?>
            <a href="post.php?id=<?= $post['id'] ?>">Read More
        <?php endif; ?></p>       
    <?php endforeach; ?>
    </section>


    <footer>Copywrong 2025 - No Rights Reserved</footer>

    
</body>
</html>