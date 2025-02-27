<?php

    /*******w******** 
        
        Name: Shiqi Yu
        Date: 26 February 2025
        Description: Challenge 5 & 6: Project Prep Challenge Cookies and Sessions

    ****************/
    session_start();

    define("RANDOM_NUMBER_MAXIMUM", 100);
    define("RANDOM_NUMBER_MINIMUM", 1);

    // Initialize leaderboard session if it doesn't exist
    if (!isset($_SESSION['leaderboard'])) {
        $_SESSION['leaderboard'] = [];
    }

    if(!isset($_SESSION['attempts'])){
        $_SESSION['attempts'] = 0;
    }
    
    $user_submitted_a_guess = isset($_POST['guess']);
    $user_requested_a_reset = isset($_POST['reset']);

    // Reset the game 
    if ($user_requested_a_reset) {
        unset($_SESSION['random_number']);
        $_SESSION['attempts'] = 0;
        $message = "Game has been reset, try again";
    }

    // Generate a random number
    if(!isset($_SESSION['random_number'])) {
        $_SESSION['random_number'] = rand(RANDOM_NUMBER_MINIMUM, RANDOM_NUMBER_MAXIMUM);
        $_SESSION['attempts'] = 0;
    }

    // When submitted, compare the guess number with random_number
    if($user_submitted_a_guess){
        $user_guess = (int)$_POST['user_guess'];
        $random_number = $_SESSION['random_number'];
        $_SESSION['attempts']++;
        

        if($user_guess < $random_number) {
            $message = "Higher";
        }
        elseif ($user_guess > $random_number) {
            $message = "Lower";
        }
        else {
            $message ="You got it! with {$_SESSION['attempts']} attempts";

            $show_name_form = true;
            }

    }

    // Get user name and store it in the leaderboard(defined as array of objects: name, attempts)
    if (isset($_POST['name'])) {
        $user_name = trim($_POST['name']);
        $leaderboard = $_SESSION['leaderboard'];

        // Check if the user already exists in the leaderboard
        $user_found = false;
        foreach ($leaderboard as $index => $player){
            // Check if the name exist
            if($player['name'] === $user_name) {
                if($player['attempts'] > $_SESSION['attempts']){
                    $_SESSION['leaderboard'][$index]['attempts'] = $_SESSION['attempts'];
                }
                $user_found = true;
                break;
            }
        }

        // If the user doesn't exist in the leaderboard, add them
        if (!$user_found) {
            $_SESSION['leaderboard'][] = ['name' => $user_name, 'attempts' => $_SESSION['attempts']];
        }

        // Sort leanderboard
        usort($_SESSION['leaderboard'], function($a, $b) {
            return $a['attempts'] - $b['attempts'];
        });

        // Trim to top 3
        $_SESSION['leaderboard'] = array_slice($leaderboard, 0, 3);

    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Number Guessing Game</title>
</head>
<body>
    <h1>Guessing Game</h1>
    
    <form method="post">
        <label for="user_guess">Your Guess</label>
        <input id="user_guess" name="user_guess" autofocus>
        <input type="submit" name="guess" value="Guess">
        <input type="submit" name="reset" value="Reset">
        <?php if (isset($message)): ?>
            <p><?= $message ?></p> 
        <?php endif; ?>
    </form>

    <?php if (isset($show_name_form)): ?>
        <form method="post">
            <label for="name">Enter your name:</label>
            <input type="text" id="name" name="name" required>
            <button type="submit">Submit</button>
        </form>
    <?php endif; ?>

    <?php if (!empty($_SESSION['leaderboard'])): ?>
        <h2>Leaderboard</h2>
        <ol>
            <?php foreach ($_SESSION['leaderboard'] as $player): ?>
                <li><?= $player['name'] ?> - <?= $player['attempts'] ?> attempts</li>
            <?php endforeach; ?>
        </ol>
    <?php endif; ?>
</body>
</html>