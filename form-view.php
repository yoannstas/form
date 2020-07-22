<?php

declare(strict_types=1);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$emailError = $streetError = $streetNumberError = $cityError = $zipCodeError = $productsError = "";
$email = $street = $streetNumber = $city = $zipCode = $productsOrdered = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["email"])) {
        $emailError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                   <strong>Empty field!</strong> Please fill in your email address.
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                   </button></div>';
    } else {
        $email = testInput($_POST["email"]);
        $_SESSION["street"] = $street;
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                   <strong>Wrong email address!</strong> 
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                   </button></div>';
        }
    }

    if (empty($_POST["street"])) {
        $streetError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                   <strong>Empty field!</strong> Please fill in your street.
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                   </button></div>';
    } else {
        $street = testInput($_POST["street"]);
        $_SESSION["street"] = $street;
    }

    if (empty($_POST["streetNumber"])) {
        $streetNumberError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                   <strong>Empty field!</strong> Please fill in your street number.
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                   </button></div>';
    } else {
        $streetNumber = testInput($_POST["streetNumber"]);
        $_SESSION["streetNumber"] = $streetNumber;
        if (!is_numeric($_POST[$streetNumber])){
            $streetNumberError ='<div class="alert alert-danger alert-dismissible fade show" role="alert">
                   <strong> only numbers allowed! </strong>
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span aria-hidden="true">x</span>
                   </button></div>';
        }
    }

    if (empty($_POST["city"])) {
        $cityError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                   <strong>Empty field!</strong> Please fill in your city.
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                   </button></div>';
    } else {
        $city = testInput($_POST["city"]);
        $_SESSION["city"] = $city;
    }


    if (empty($_POST["zipCode"])) {
        $zipCodeError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                   <strong>Empty field!</strong> Please fill in your zipcode.
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                   </button></div>';
    } else {
        $zipCode = testInput($_POST["zipCode"]);
        $_SESSION["zipCode"] = $zipCode;
        if (!is_numeric($_POST[$zipCode])){
            $zipCodeError ='<div class="alert alert-danger alert-dismissible fade show" role="alert">
                   <strong> only numbers allowed! </strong>
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span aria-hidden="true">x</span>
                   </button></div>';
        }
    }
}

function testInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>



<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" type="text/css"
          rel="stylesheet"/>
    <title>Order food & drinks</title>
</head>
<body>
<div class="container">
    <h1>Order food in restaurant "the Personal Ham Processors"</h1>
    <nav>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link active" href="?food=1">Order food</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?food=0">Order drinks</a>
            </li>
        </ul>
    </nav>
    <form method="post">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email">E-mail:</label>
                <input type="text" id="email" name="email" class="form-control" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : ''; ?>""/>
                <span class="error"><?php echo $emailError;?></span>
            </div>
            <div></div>
        </div>

        <fieldset>
            <legend>Address</legend>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="street">Street:</label>
                    <input type="text" name="street" id="street" class="form-control" value="<?php echo isset($_POST["street"]) ? $_POST["street"] : ''; ?>""/>
                    <span class="error"><?php echo $streetError;?></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="streetNumber">Street number:</label>
                    <input type="text" id="streetNumber" name="streetNumber" class="form-control" value="<?php echo isset($_POST["streetNumber"]) ? $_POST["streetNumber"] : ''; ?>""/>
                    <span class="error"><?php echo $streetNumberError;?></span>

                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="city">City:</label>
                    <input type="text" id="city" name="city" class="form-control" value="<?php echo isset($_POST["city"]) ? $_POST["city"] : ''; ?>""/>
                    <span class="error"><?php echo $cityError;?></span>

                </div>
                <div class="form-group col-md-6">
                    <label for="zipCode">Zipcode</label>
                    <input type="text" id="zipCode" name="zipCode" class="form-control" value="<?php echo isset($_POST["zipCode"]) ? $_POST["zipCode"] : ''; ?>""/>
                    <span class="error"><?php echo $zipCodeError;?></span>

                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Products</legend>
            <?php foreach ($products AS $i => $product): ?>
                <label>
                    <input type="checkbox" value="1" name="products[<?php echo $i ?>]"/> <?php echo $product['name'] ?> -
                    &euro; <?php echo number_format($product['price'], 2) ?></label><br />
            <?php endforeach; ?>
        </fieldset>

        <label>
            <input type="checkbox" name="express_delivery" value="5" />
            Express delivery (+ 5 EUR)
        </label>

        <button type="submit" class="btn btn-primary">Order!</button>
    </form>

    <footer>You already ordered <strong>&euro; <?php echo $totalValue ?></strong> in food and drinks.</footer>
</div>

<style>
    footer {
        text-align: center;
    }
</style>
</body>
</html>