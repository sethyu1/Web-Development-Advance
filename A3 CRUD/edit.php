<!----------------
    
    Assignment 3: Blog Application
    Name: Shiqi Yu
    Date: 07 February 2025
    Description: Edit a post

------------------>

<?php

require('connect.php');
require('authenticate.php');

    // Check if an id is provided and is numeric
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        header('Location: index.php');
        exit();
    }

    $id = intval($_GET['id']);

    // Fetch the post from the database
    $query = "SELECT title, content, timestamp FROM blogs WHERE id = :id";
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $post = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$post) {
        header('Location: index.php');
        exit();
    }

    // Handle form submission for updating or deleting the post
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['update'])) {
            // Handle update
            $title = trim($_POST['title']);
            $content = trim($_POST['content']);

            if (!empty($title) && !empty($content)) {
                $updateQuery = "UPDATE blogs SET title = :title, content = :content WHERE id = :id";
                $updateStatement = $db->prepare($updateQuery);
                $updateStatement->bindValue(':title', $title, PDO::PARAM_STR);
                $updateStatement->bindValue(':content', $content, PDO::PARAM_STR);
                $updateStatement->bindValue(':id', $id, PDO::PARAM_INT);
                $updateStatement->execute();

                header('Location: post.php?id=' . $id); // Redirect to the full post page
                exit();
            }
        }

        if (isset($_POST['delete'])) {
            // Handle delete
            $deleteQuery = "DELETE FROM blogs WHERE id = :id";
            $deleteStatement = $db->prepare($deleteQuery);
            $deleteStatement->bindValue(':id', $id, PDO::PARAM_INT);
            $deleteStatement->execute();

            header('Location: index.php'); // Redirect to the home page
            exit();
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Edit this Post!</title>
</head>
<body>
    <!-- Remember that alternative syntax is good and html inside php is bad -->
    <h1>Edit Post</h1>

    <form action="edit.php?id=<?= $id ?>" method = "POST">
         <input type="hidden" name="id" value="<?= $id ?>">

            <div>
                <label for="title">Title</label>
                <input id="title" name="title" value="<?= $post['title'] ?>">
            </div>

            <div>
                <label for="content"></label>
                <textarea id="content" name="content" rows="10" cols="80" maxlength="5000" ><?= $post['content'] ?></textarea>
            </div>

            <div>
                <input type="submit" name="update" value="Update">
                <input type="submit" name="delete" value="Delete" onclick="return confirm('Are you sure you wish to delete this post?')">
            </div>
        
    </form>
</body>
</html>