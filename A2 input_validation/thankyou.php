<?php

/*******w******** 
    
    Name: Shiqi Yu
    Date: 26 January 2025
    Description: Server-Side User Input Validation

****************/

// validations
function validateFormData() {
    $errors = [];

    // Full Name
    $fullname = filter_input(INPUT_POST,  'fullname', FILTER_SANITIZE_STRING);
    if (empty($fullname)) {
        $errors[] = "Full Name is required";
    }

    // Address
    $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
    if (empty($address)) {
        $errors[] = "Address is required";
    }

    // Provinces 
    $validProvinces = ['AB', 'BC', 'MB', 'NB', 'NL', 'NS', 'NT', 'NU', 'ON', 'PE', 'QC', 'SK', 'YT'];
    $province = filter_input(INPUT_POST, 'province', FILTER_SANITIZE_STRING);
    if (!in_array($province, $validProvinces)) {
        $errors[] = "Invalid province";
    }

    // City
    $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
    if (empty($city)) {
        $errors[] = "City is required";
    }


    // Postal Code
    $validPostalCode = '/^[A-Za-z]\d[A-Za-z][ -]?\d[A-Za-z]\d$/';
    $postalCode = filter_input(INPUT_POST, 'postal', FILTER_SANITIZE_STRING);
    if (!preg_match($validPostalCode, $postalCode)) {
        $errors[] = "Invalid postal code";
    }

    // Email
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email address";
    }

    // Payment Information

    // Card Type
    $creditCardType = filter_input(INPUT_POST, 'cardtype', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
    if ($creditCardType === null || ($creditCardType)) {
        $errors[] = "You must choose a card type";
    }

    // Name on Card
    $cardName = filter_input(INPUT_POST, 'cardname', FILTER_SANITIZE_STRING);
    if (empty($cardName)) {
        $errors[] = "Card Name is required";
    }

    // Expire Date
    $creditCardMonth = filter_input(INPUT_POST, 'month', FILTER_VALIDATE_INT);
    if ($creditCardMonth === false || $creditCardMonth < 1 || $creditCardMonth > 12) {
        $errors[] = "Invalid credit card month";
    }

    $creditCardYear = filter_input(INPUT_POST, 'year', FILTER_VALIDATE_INT);
    if ($creditCardYear === false || $creditCardYear < (int)date('Y') || $creditCardYear > ((int)date('Y') + 5)) {
        $errors[] = "Invalid credit card year";
    }

    // Card Number
    $creditCardNumber = filter_input(INPUT_POST, 'cardnumber', FILTER_SANITIZE_NUMBER_INT);
    if (empty($creditCardNumber) || !preg_match('/^\d{10}$/', $creditCardNumber)) {
        $errors[] = "Card number mut be exactly 10 numbers";
    }

    // Quantity for product
    for ($i = 1; $i <=5; $i++) {
        $qtyKey = 'qty' . $i;
        $quantity = $_POST[$qtyKey];

        if (!empty($quantity) && filter_var($quantity, FILTER_VALIDATE_INT) === false) {
            $errors[] = "Invalid quantity for product $i";
        }
    }


    return $errors;
}

$cartItems = [];

// Define the product descriptions and prices directly within the loop
for ($i = 1; $i <= 5; $i++) {
    $qtyKey = 'qty' . $i;
    $quantity = filter_input(INPUT_POST, $qtyKey, FILTER_VALIDATE_INT);
    
    if ($quantity > 0) {
        switch ($i) {
            case 1:
                $description = 'MacBook';
                $price = 1899.99;
                break;
            case 2:
                $description = 'Razer Gaming Mouse';
                $price = 79.99;
                break;
            case 3:
                $description = 'WD My Passport Portable HDD';
                $price = 179.99;
                break;
            case 4:
                $description = 'Google Nexus 7';
                $price = 249.99;
                break;
            case 5:
                $description = 'DD-45 Drum Kit';
                $price = 119.99;
                break;
        }

        $cartItems[] = [
            'quantity' => $quantity,
            'description' => $description,
            'price' => $price,
        ];
    }
}

if (!empty($_POST['fullname'])) {
    $content1 = "Thank you for your order {$_POST['fullname']}.";
    $content2 = "Here's a summary of your order:";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Thanks for your order!</title>
</head>
<body>
    <!-- Remember that alternative syntax is good and html inside php is bad -->
    <div class="invoice" id="summary">
        <?php
        $validationErrors = validateFormData();
        if (empty($validationErrors)) :
        ?>
            <div class="head">
                <h1><?= $content1 ?></h1>
                <h2><?= $content2 ?></h2>

                <table>
                    <tr>
                        <td colspan="4" >Address Information</td>
                    </tr>

                    <tr>
                        <td class="alignright">Address:</td>
                        <td><?= $_POST['address'] ?></td>   
                        <td class="alignright">City:</td>
                        <td><?= $_POST['city'] ?></td>
                    </tr>

                    <tr>
                        <td class="alignright">Province:</td>
                        <td><?= $_POST['province'] ?></td>   
                        <td class="alignright">Postal Code:</td>
                        <td><?= $_POST['postal'] ?></td>
                    </tr>   

                    <tr>
                        <td class="alignright" colspan="2">Email:</td>
                        <td colspan="2"><?= $_POST['email'] ?></td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <td colspan="3">Order Information</td>
                    </tr>

                    <tr>
                        <td>Quantity</td>
                        <td>Description</td>
                        <td>Cost</td>
                    </tr>

                    <?php
                        $totalCost = 0;
                        foreach ($cartItems as $item ) :
                            $itemCost = $item['quantity'] * $item['price'];
                            $totalCost += $itemCost;
                    ?>
                    <tr>
                        <td><?= $item['quantity'] ?></td>
                        <td><?= $item['description'] ?></td>
                        <td class="alignright"><?= $item['quantity'] * $item['price'] ?></td>
                    </tr>
                <?php endforeach; ?>

                    <tr>
                        <td colspan="2" class="alignright">Totals</td>
                        <td class="alignright">$<?= $totalCost ?></td>
                    </tr>

                </table>
            </div>    
        <?php else : ?>
            <h4>Sorry, this page can only be loaded when submitting an order.</h4>
            <ul>
                <?php foreach ($validationErrors as $error) : ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif ?>
    </div>
</body>
</html>