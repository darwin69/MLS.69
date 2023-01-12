<?php

session_start();
include "config.php";

if(isset($_POST['submit'])){
    $email = ($_POST['email']);
    $pass = md5($_POST['password']);
    // $pass = mysqli_real_escape_string($conn , md5($_POST['password']));
    $select = mysqli_query($conn , "SELECT * FROM `info_utilisateur` WHERE email='$email' AND password = '$pass'") or die ('query failed');

    if(mysqli_num_rows($select) > 0){
        $message[] = 'Ce nom est déjà pris.';
        $row = mysqli_fetch_assoc($select);
        $_SESSION['user_id'] = $row ['id'];
        header('location:home.php');
    }else{
        $message[] = 'le mot de passe ou le nom d`utilisateur est incorrect !';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <div class="form-container">
        <form action="" method="post" enctype="multipart/form-data">
            <h3>Connexion</h3>
            <?php
                if(isset($message)){
                    foreach($message as $message){
                        echo '<div class="message">'.$message.'</div>';
                    }
                }
            ?>
            <input type="text" name="email" placeholder="Entrez votre email" class="box" required>
            <input type="password" name="password" placeholder="Entrez votre mot de passe" class="box" required>
            <a class="link-pass" href="change-password.php">Mot de passe oublié ?</a><br>
            <input type="submit" name="submit" value="Connexion" class="btn">
            <p>Vous n'avez pas encore de compte ?<br><a href="register.php">Créez votre compte !</a></p>
        </form>
    </div>
   <style>
    :root{
    --blue: #3498db;
    --dark-blue: #2980b9;
    --red: brown;
    --dark-red: #c0392b;
    --black: #333;
    --white: #fff;
    --light-bg: #eee;
    --box-shadow: 0 5px 10px rgba(0,0,0,0.1);
}
body{
    backdrop-filter: blur(10px);
}
.link-pass{
    float: right;
    text-decoration: none;
    color: brown;
}
.link-pass:hover{
    color: brown;
    text-decoration: underline;
}
.forpass{
    float: right;
    color: var(--red);
    text-decoration: none;
    padding-bottom: 10px;
}
.forpass:hover{
    text-decoration: underline;
}
.btn , .delete-btn {
    width: 100%;
    border-radius: 5px;
    padding: 10px 30px;
    color: var(--white);
    display: block;
    text-align: center;
    cursor: pointer;
    font-size: 20px;
    margin-top: 10px;
    text-decoration: none;
}
.btn {
    background-color: var(--blue);
}
.btn:hover {
    background-color: var(--dark-blue);
}
.delete-btn {
    background-color: var(--red);
}
.delete-btn:hover {
    background-color: var(--dark-red);
}
.message {
    margin: 5px -10px;
    width: 100%;
    border-radius: 5px;
    padding: 10px;
    text-align: center;
    background-color: var(--red);
    color: var(--white);
    font-size: 20px;
}
.form-container {
    min-height: 100vh;
    background-color: var(--light-bg);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}
.form-container form{
    padding: 20px;
    background-color: var(--white);
    box-shadow: var(--box-shadow);
    text-align: center;
    width: 500px;
    border-radius: 5px;
}
.form-container form h3{
    margin-bottom: 10px;
    font-size: 30px;
    color: var(--black);
    text-transform: uppercase;

}
.form-container form .box{
    width: 100%;
    border-radius: 5px;
    padding: 12px 0px;
    font-size: 18px;
    color: var(--black);
    margin: 10px 0;
    background-color: var(--light-bg);
}
.form-container form p{
    margin-top: 15px;
    font-size: 20px;
    color: var(--black);
}
.form-container form p a{
    color: var(--red); 
    text-decoration: none;
}
.form-container form p a:hover{
    text-decoration: underline;
}
.container {
    min-height: 100vh;
    background-color: var(--light-bg);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;   
}
.container .profile {
    padding: 20px;
    background-color: var(--white);
    box-shadow: var(--box-shadow);
    text-align: center;
    width: 400px;
    border-radius: 5px;
}
.container .profile img{
    height: 150px;
    width: 150px;
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 5px;
}
.container .profile h3 {
    margin: 5px 0;
    font-size: 20px;
    color: var(--black);
}
.container .profile p {
    margin-top: 20px;
    color: var(--black);
    font-size: 20px;
}
.container .profile p a{
    color: var(--red);
}
.container .profile p a:hover {
    text-decoration: underline;
}
.update-profile {
    min-height: 100vh;
    background-color: var(--light-bg);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;  
}
.update-profile form {
    padding: 20px;
    background-color: var(--white);
    box-shadow: var(--box-shadow);
    text-align: center;
    width: 700px;
    text-align: center;
    border-radius: 5px;
}
.update-profile form img {
    height: 200px;
    width: 200px;
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 5px;
}
.update-profile form .flex{
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
    gap: 15px;
}
.update-profile form .flex .inputbox {
    width: 49%;
}
.update-profile form .flex .inputbox span{
    text-align: left;
    display: block;
    margin-top: 15px;
    font-size: 17px;
    color: var(--black);
}
.update-profile form .flex .inputbox .box{
    width: 100%;
    border-radius: 5px;
    background-color: var(--light-bg);
    padding: 12px 14px;
    font-size: 17px;
    color: var(--black);
    margin-top: 10px;
}
@media (max-width: 650px) {
    .update-profile form .flex{
        flex-wrap: wrap;
        gap: 0;
    }
    .update-profile form .inputbox .flex {
        width: 100%;
    }
}
    </style>
</body>
</html>