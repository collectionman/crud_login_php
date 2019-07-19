<?php
    session_start() ;

    require 'database.php' ;

    if ( isset( $_SESSION[ 'user_id' ] ) ) {
        $records = $connection -> prepare( 'SELECT id, email, password FROM users WHERE id=:id' ) ;
        $records -> bindParam( 'id', $_SESSION[ 'user_id' ] ) ;
        $records -> execute() ;
        $results = $records -> fetch( PDO::FETCH_ASSOC ) ;

        if ( count( $results ) > 0 ) {
            $user = $results ;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="stylesheet" href="./assets/css/styles.css">
</head>
<body>

    <?php require 'partials/header.php' ; ?>

    <?php if ( !empty( $user ) ):?>
        <br>Welcome. <?= $user[ 'email' ]?>
        <a class="logout" href="logout.php">logout</a>
    <?php else: ?>
        <h1>Please <a href="login.php">login</a> or <a href="signup.php">sign up</a></h1>
        <a href="login.php">login</a> or <a href="signup.php">singup</a>
    <?php endif ; ?>

    <?php require 'partials/footer.php' ; ?>
</body>
</html>