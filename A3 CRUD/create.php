<!----------------
    
    Assignment 3: Blog Application
    Name: Shiqi Yu
    Date: 07 February 2025
    Description: create a new post

------------------>

<?php 
    
require('connect.php');
require('authenticate.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);

    if (strlen($title) > 0 && strlen($content) > 0) {
        $query = "INSERT INTO blogs (title, content) VALUES (:title, :content)";
        $statement =$db->prepare($query);
        $statement->bindValue(':title', $title);
        $statement->bindValue(':content', $content);
        $statement->execute();
        header('Location: index.php');
        exit();
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Post</title>
</head>
<body>
    <div class="navbar">
        <a href="index.php">Home</a>
        <a href="create.php">New Post</a>
    </div>

    <h1>Create a New Post</h1>
    <form id="newpost" method="POST" action="create.php">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>

        <label>Content:</label>
        <textarea id="content" name ="content" rows="10" cols="80" placeholder="Tell us something interesting" required></textarea>

        <button type="submit">Submit</button>
    </form>
</body>
</html>