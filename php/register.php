<?php

include "config.php";
if(isset($_POST['submit'])){
    $name = mysqli_real_escape_string($conn , $_POST['fname']);
    $email = mysqli_real_escape_string($conn , $_POST['email']);
    $pass = mysqli_real_escape_string($conn , md5($_POST['password']));
    $cpass = mysqli_real_escape_string($conn , md5($_POST['cpassword']));
    $image = $_FILES['image'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder ='uploaded_img/'.$image;

    $select = mysqli_query($conn , "SELECT * FROM `info_utilisateur` WHERE email = '$email' AND password = '$pass'")
    or die ('query failed');

    if(mysqli_num_rows($select) > 0){
        $message[] = 'Ce nom est déjà pris. ';
    }else{
        if($pass != $cpass){
            $message[] = 'La confirmation de votre mot de passe a échoué !';
        }elseif($image_size > 2000000){
            $message[] = 'Votre image est trop grande.';
        }else{
            $insert = mysqli_query($conn , "INSERT INTO `info_utilisateur`(name, email, password, 
            image) VALUES ('$name' ,'$email', '$pass', '$image')") or die('query failed');

            if($insert){
                move_uploaded_file($image_tmp_name, $image_folder);
                $message[] = 'Votre compte à été créer avec succès !';
                header('location:login.php');
            }else{
                $message[] = 'La création de votre compte a échoué.';
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire</title>
</head>
<body>
    <div class="form-container">
        <form action="" method="post" enctype="multipart/form-data">
            <h3> Créez votre compte</h3>
            <?php
                if(isset($message)){
                    foreach($message as $message){
                        echo '<div class="message">'.$message.'</div>';
                    }
                }
            ?>
            <input type="text" name="fname" placeholder="Entrez votre nom d'utilisateur" class="box" required maxlength="24">
            <input type="email" name="email" placeholder="Entrez votre email" class="box" required>
            <input type="password" name="password" placeholder="Entrez votre mot de passe" class="box" required min="6" maxlength="20">
            <input type="password" name="cpassword" placeholder="Confirmez votre mot de passe" class="box" required>
            <input type="file" name="image" class="box" accept="image/jpg , image/jpeg , image/png">
            <input type="submit" name="submit" value="Créez votre compte !" class="btn">
            <p>Vous avez un compte ?<a href="login.php">Connectez-vous !</a></p>
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
    margin: 5px -7px;
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
    padding: 12px 14px;
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