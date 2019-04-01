<?php
include_once "includes/config.php";
include_once "includes/classes/Account.php";
include_once "includes/classes/Constants.php";

$account = new Account($con);

include_once "includes/handlers/register_handler.php";

include_once "includes/handlers/login_handler.php";

//Cette fonction nous permet de vérifier si la valeur d'un champ (input) est définie

function getInputValue($name)
{
    if (isset($_POST[$name])) {
        
        echo $_POST[$name];
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/register.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    <script src="assets/js/register.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"> 
   
    
    <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">-->
    <title>Yo! Musik</title>
</head>
<body>
    <?php
    if(isset($_POST['registerButton']))
    {
        echo ' <script>
        $(document).ready(function() { 
            $("#loginForm").hide();
            $("#registerForm").show();
            });
            </script>';
        }
        else {
            echo ' <script>
            $(document).ready(function() { 
                $("#loginForm").show();
                $("#registerForm").hide();
                });
                </script>';
            }
            ?>
            <div id="background">
                <div id="loginContainer">
                    <div id="inputContainer">
                        <h2><img src="assets/images/icons/Yo!_app_icon.png" alt="logo_yo_music" width=80> Musik</h2>
                        <hr>
                        <form id="loginForm" action="register.php" method="POST">
                            <h2>Connectez-vous à Yo! Musik</h2>
                            <p>
                                <?= $account->getMessageError(Constants::$loginFailed); ?>

                                <label for="loginUsername">Nom d'utilisateur</label>

                                <input class="form-control" id="loginUsername" name="loginUsername" type ="text" placeholder="ex: homerSimpson" required>
                            </p>
                            <p>
                                <label for="loginPassword">Mot de passe</label>

                                <input class="form-control" id="loginpassword" name="loginPassword" type ="password" placeholder="Votre mot de passe" required>
                            </p>

                            <button type="submit" class="btn btn-primary" name="loginButton">Se connecter</button>

                            <div class="hasAccountText">
                                <span id="hideLogin">Vous n'avez pas encore un compte? Inscrivez-vous ici.</span>
                            </div>
                        </form>
                        

                        
                        <form id="registerForm" action="register.php" method="POST">
                            <h2>Créer un compte</h2>
                            <p>
                                <?= $account->getMessageError(Constants::$userNameCharacters); ?>

                                <?= $account->getMessageError(Constants::$usernameTaken); ?>

                                <label for="registerUsername">Nom d'utilisateur</label>

                                <input class="form-control" id="registerUsername" name="registerUsername" type ="text" value="<?= getInputValue('registerUsername'); ?>" placeholder="ex: homerSimpson" required>
                            </p>

                            <p>
                                <?= $account->getMessageError(Constants::$firstNameCharacters); ?>

                                <label for="firstName">Nom</label>

                                <input class="form-control" id="firstName" name="firstName" type ="text" value="<?= getInputValue('firstName'); ?>" placeholder="ex: homer" required>
                            </p>

                            <p>
                                <?= $account->getMessageError(Constants::$lastNameCharacters); ?>

                                <label for="lastName">Prénom</label>

                                <input class="form-control" id="lastName" name="lastName" type ="text" value="<?= getInputValue('lastname'); ?>" placeholder="ex: Simpson" required>
                            </p>

                            <p>
                                <?= $account->getMessageError(Constants::$emailInvalid); ?>

                                <?= $account->getMessageError(Constants::$emailDonotMatch); ?>

                                <?= $account->getMessageError(Constants::$emailTaken); ?>

                                <label for="email">Adresse email</label>

                                <input class="form-control" id="email" name="email" type ="email" value="<?= getInputValue('email'); ?>" placeholder="ex: homerSimpson@yahoo.com" required>
                            </p>

                            <p>
                                <label for="email2">Confirmation email</label>

                                <input class="form-control" id="email2" name="email2" type ="email" value="<?= getInputValue('email2'); ?>" placeholder="ex: homerSimpson@yahoo.com" required>
                            </p>

                            <p>
                                <?= $account->getMessageError(Constants::$passwordCharacters); ?>

                                <?= $account->getMessageError(Constants::$passwordNotAlphaNumeric); ?>

                                <?= $account->getMessageError(Constants::$passwordDonotMatch); ?>

                                <label for="registerPassword">Mot de passe</label>

                                <input class="form-control" id="registerpassword" name="registerPassword" type ="password" placeholder="Votre mot de passe" required>
                            </p>

                            <p>
                                <label for="registerPassword2">Confirmation du mot de passe</label>

                                <input class="form-control" id="registerpassword2" name="registerPassword2" type ="password" placeholder="Votre mot de passe" required>
                            </p>

                            <button type="submit" class="btn btn-primary" name="registerButton">S'enregistrer</button>
                            
                            <div class="hasAccountText">
                                <span id="hideRegister">Avez-vous déjà un compte? Se connecter ici.</span>
                            </div>

                        </form>
                    </div>

                    <div id="loginText">
                        <h1>Ecouter de la bonne musique dès maintenant</h1>
                        <h2>Des milliers des musiques gratuits</h2>
                        <ul>
                            <li><img src="assets/images/icons/icon-check.png" alt=""width=50>Decouvrez de la bonne musique</li>
                            <li><img src="assets/images/icons/icon-check.png" alt=""width=50>Créer vos propres playlists</li>
                            <li><img src="assets/images/icons/icon-check.png" alt=""width=50>Suivez vos artistes préférés et pleins d'autres</li>
                        </ul>
                    </div>
                </div>
            </div>
            
    <!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>-->
</body>
</html>