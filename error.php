<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ARTHUB</title>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz@9..144&display=swap" rel="stylesheet">
    <link href="css/error.css" rel="stylesheet">
</head>

<body>
    <?php session_start(); ?>
    <div class="error-container">
        <h3>Error</h3>
        <h1>
            <?php echo isset($_GET['message']) ? htmlspecialchars($_GET['message']) : 'An unknown error occurred.'; ?>
        </h1>
        <?php if ($_SESSION['userId']) { ?>
            <a href="index.php">Go back to homepage</a>
        <?php
        } else { ?>
            <a href="login.html">Go back to login</a>

        <?php } ?>
    </div>
</body>

</html>