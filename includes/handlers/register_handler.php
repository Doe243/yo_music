<?php

function sanitizeFormPassword($inputText)
{
    $inputText = strip_tags($inputText);

    return $inputText;
}


function sanitizeFormUsername($inputText)
{
    $inputText = strip_tags($inputText);
    $inputText = str_replace(" ", "", $inputText);

    return $inputText;
}


function sanitizeFormString($inputText)
{
    $inputText = strip_tags($inputText);
    $inputText = str_replace(" ", "", $inputText);
    $inputText = ucfirst(strtolower($inputText));

    return $inputText;
}

if (isset($_POST['registerButton'])) {

    //Si le bouton s'enregitrer est pressé

    $username = sanitizeFormUsername($_POST['registerUsername']);
    
    $firstname = sanitizeFormString($_POST['firstName']);

    $lastname = sanitizeFormString($_POST['lastName']);

    $email = sanitizeFormString($_POST['email']);

    $email2 = sanitizeFormString($_POST['email2']);

    $password = sanitizeFormPassword($_POST['registerPassword']);

    $password2 = sanitizeFormPassword($_POST['registerPassword2']);

    $wasSuccessful = $account->register($username, $firstname, $lastname, $email, $email2, $password, $password2);

    if ($wasSuccessful == true) 
    {
        $_SESSION['userLoggedIn'] = $username;
        
        header("Location: index.php");
    }
    
}