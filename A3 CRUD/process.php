<!----------------
    
    Assignment 3: Blog Application
    Name: Shiqi Yu
    Date: 07 February 2025
    Description: Handle inserting, updating, deleting.

------------------>

<?php

require('connect.php');

// Check if a form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Handle insert post
    if (isset($_POST['action']) && $_POST['action'] === 'insert') {
        $title = trim($_POST['title']);
        $content = trim($_POST['content']);

        if (!empty($title) && !empty($content)) {
            $query = "INSERT INTO posts (title, content, timestamp) VALUES (:title, :content, NOW())";
            $statement = $db->prepare($query);
            $statement->bindValue(':title', $title, PDO::PARAM_STR);
            $statement->bindValue(':content', $content, PDO::PARAM_STR);
            $statement->execute();

            // Redirect to the homepage after insertion
            header('Location: index.php');
            exit();
        } else {
            echo "Title and content can not be empty!";
        }
    }

    // Handle update post
    if (isset($_POST['action']) && $_POST['action'] === 'update' && isset($_POST['id']) && is_numeric($_POST['id'])) {
        $id = intval($_POST['id']);
        $title = trim($_POST['title']);
        $content = trim($_POST['content']);

        if (!empty($title) && !empty($content)) {
            $query = "UPDATE posts SET title = :title, content = :content WHERE id = :id";
            $statement = $db->prepare($query);
            $statement->bindValue(':title', $title, PDO::PARAM_STR);
            $statement->bindValue(':content', $content, PDO::PARAM_STR);
            $statement->bindValue(':id', $id, PDO::PARAM_INT);
            $statement->execute();

            // Redirect to the full post page after updating
            header('Location: post.php?id=' . $id);
            exit();
        } else {
            echo "Title and content must not be empty!";
        }
    }

    // Handle delete post
    if (isset($_POST['action']) && $_POST['action'] === 'delete' && isset($_POST['id']) && is_numeric($_POST['id'])) {
        $id = intval($_POST['id']);

        $query = "DELETE FROM posts WHERE id = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        // Redirect to the homepage after deleting
        header('Location: index.php');
        exit();
    }

} else {
    // Redirect to the homepage if the request method is not POST
    header('Location: index.php');
    exit();
}

?>

