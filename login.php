<?php

    session_start() ;

    if ( isset( $_SESSION[ 'user_id' ] ) ) {
        header( 'Location: /crud_login' ) ;
    }

    require 'database.php' ;

    if ( !empty( $_POST[ 'email' ] ) && !empty( $_POST[ 'password' ] ) ) {
        $records = $connection -> prepare( 'SELECT id, email, password FROM users WHERE email=:email' ) ;
        $records -> bindParam( ':email', $_POST[ 'email' ] ) ;
        $records -> execute() ;
        $results = $records -> fetch( PDO::FETCH_ASSOC ) ;

        $loginReportMessage = '' ;

        if ( count( $results ) > 0 && password_verify( $_POST[ 'password' ], $results[ 'password' ] ) ) {
            $_SESSION[ 'user_id' ] = $results[ 'id' ] ;
            header( 'Location: /crud_login' ) ;
        } else {
            $loginReportMessage = 'Incorrect Password!' ;
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="./assets/css/styles.css">
</head>
<body>

    <?php require 'partials/header.php' ; ?>

    <?php if ( !empty( $loginReportMessage ) ):?>
        <p><?= $loginReportMessage ?></p>
    <?php endif ; ?>

    <div class="form-container">
        <h1>Login</h1>
        <span>or <a href="signup.php">signup</a></span>

        <form class="" action="login.php" method="post">
            <input type="text" name="email" placeholder="Enter your e-mail">
            <input type="password" name="password" placeholder="Enter your password">
            <input type="submit" value="Send">
        </form>
    </div>

    <?php require 'partials/footer.php' ; ?>
</body>
</html>