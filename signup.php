<?php
    require 'database.php' ;

    function confirmPassword()
    {
        return ( $_POST[ 'password' ] == $_POST[ 'confirm_password' ] ) ;
    }

    $singUpReportMessage = '' ;

    // Si los datos recibidos desde el método post del formulario no están vacios
    if ( !empty( $_POST[ 'email' ] ) && !empty( $_POST[ 'password' ] ) ) {
        $sql_query = 'INSERT INTO users (email, password) VALUES (:email, :password);' ;

        $statement = $connection -> prepare( $sql_query ) ;

        $statement -> bindParam( ':email', $_POST[ 'email' ] ) ;

        // Si la contraseña de confirmación coincide
        if ( confirmPassword() ) {
            $crypt_password = password_hash( $_POST[ 'password' ], PASSWORD_BCRYPT ) ; // 'passwor_hash' cifra las contraseñas 
            $statement -> bindParam( ':password', $crypt_password ) ;

            if ( $statement -> execute() ) {
                $successMessage = 'User created successfully' ;
                $singUpReportMessage = $successMessage ;
            } else {
                $errorMessage = 'Sorry, your user can\'t be created' ;
                $singUpReportMessage = $errorMessage ; 
            }
        } else {
            $singUpReportMessage = 'Confirm your password' ;
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SignUp</title>
    <link rel="stylesheet" href="./assets/css/styles.css">
</head>
<body>
    <?php require 'partials/header.php' ?>

    <?php if ( !empty( $singUpReportMessage ) ):?>
        <p><?= $singUpReportMessage ?></p>
    <?php endif ; ?>

    <div class="form-container">
        <h1>Sign Up</h1>
        <span>or <a href="login.php">login</a></span>

        <form class="" action="signup.php" method="post">
            <input type="text" name="email" placeholder="Enter your e-mail">
            <input type="password" name="password" placeholder="Enter your password">
            <input type="password" name="confirm_password" placeholder="Confirm your password">
            <input type="submit" value="Send">
        </form>
    </div>

    <?php require 'partials/footer.php' ; ?>
</body>
</html>