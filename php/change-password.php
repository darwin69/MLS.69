<?php

$msg = "";

include 'config.php';

if (isset($_GET['reset'])) {
    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE code='{$_GET['reset']}'")) > 0) {
        if (isset($_POST['submit'])) {
            $password = mysqli_real_escape_string($conn, md5($_POST['password']));
            $confirm_password = mysqli_real_escape_string($conn, md5($_POST['confirm-password']));

            if ($password === $confirm_password) {
                $query = mysqli_query($conn, "UPDATE users SET password='{$password}', code='' WHERE code='{$_GET['reset']}'");

                if ($query) {
                    header("Location: MLS.html");
                }
            } else {
                $msg = "<div class='alert alert-danger'>Les deux mots de passe ne correspondent pas !</div>";
            }
        }
    } else {
        $msg = "<div class='alert alert-danger'>Le lien n'a pu ête envoyé.</div>";
    }
} else {
    header("Location: forgot-password.php");
}

?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Changer de mot de passe | Mafia Life Style</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords"
        content="Login Form" />
    

    <link href="//fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    
    <link rel="stylesheet" href="style.css" type="text/css" media="all" />
    

    <script src="../js.js" crossorigin="anonymous"></script>

</head>

<body>

    
    <section class="w3l-mockup-form">
        <div class="container">
           
            <div class="workinghny-form-grid">
                <div class="main-mockup">
                    <div class="alert-close">
                        <span class="fa fa-close"></span>
                    </div>
                    <div class="w3l_form align-self">
                        <div class="left_grid_info">
                            <img src="images/image3.svg" alt="">
                        </div>
                    </div>
                    <div class="content-wthree">
                        <h2>Changer de mot de passe</h2>
                        <p>Petit problème ? Pas de problème !</p>
                        <?php echo $msg; ?>
                        <form action="" method="post">
                            <input type="password" class="password" name="password" placeholder="Entrer votre mot de passe" required>
                            <input type="password" class="confirm-password" name="confirm-password" placeholder="Confirmer votre mot de passe" required>
                            <button name="submit" class="btn" type="submit">Changer de mot de passe</button>
                        </form>
                        <div class="social-icons">
                            <p>Revenir<a href="login-mls.php">Connexion</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src="../js.js"></script>
    <script>
        $(document).ready(function (c) {
            $('.alert-close').on('click', function (c) {
                $('.main-mockup').fadeOut('slow', function (c) {
                    $('.main-mockup').remove();
                });
            });
        });
    </script>

</body>

</html>