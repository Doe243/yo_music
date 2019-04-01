<?php

class Account 
{
    private $con;
    private $errorArray;


    public function  __construct($con)
    {
        //Notre variable pour récupérer la connexion 

        $this->con = $con;

        //Les tableaux des erreurs

        $this->errorArray = [];
    }

    //Cette fonction nous permet de nous connecter

    public function login($un, $pw)
    {
        $pw = md5($pw);

        $query = mysqli_query($this->con, "SELECT * FROM users WHERE username = '$un' AND password = '$pw'");

        if(mysqli_num_rows($query) == 1)
        {
            return true;
        }
        else {
            array_push($this->errorArray, Constants::$loginFailed);

            return false;
        }

    }

    //Cette fonction nous permet d'enregistrer les utilisateurs

    public function register($un, $fn, $ln, $em, $em2, $pw, $pw2)
    {
        //Ajout des règles de validation

        $this->validateUsername($un);
        $this->validateFirstName($fn);
        $this->validateLastName($ln);
        $this->validateEmails($em, $em2);
        $this->validatePasswords($pw, $pw2);

        //On vérifie si nos champs sont vide ou pas pour l'insertion dans la bdd

        if(empty($this->errorArray) == true) 
        {    
            return $this->insertDetails($un, $fn, $ln, $em, $pw);
        }

        else 
        {
            return false;
        }
    }

    //On crée la fonction pour l'afficher à l'utilisateur

    public function getMessageError($error)
    {
        if (!in_array($error, $this->errorArray)) 
        {    
            $error = "";
        }
        return "<span class='errorMessage'>$error</span>";
    }

    private function insertDetails($un, $fn, $ln, $em, $pw)
    {
        $encryptPw = md5($pw);
        $ProfilePic = "assets/images/user_avatar.png";
        $date = date("Y-m-d");

        //echo "INSERT INTO users VALUES('', '$un', '$fn', '$ln', '$em', '$encryptPw', '$date', '$ProfilePic')";
        $result = mysqli_query($this->con, "INSERT INTO users VALUES(null, '$un', '$fn', '$ln', '$em', '$encryptPw', '$date', '$ProfilePic')");

        return $result;
    }

    private function validateUsername($un)
    {
         //On vérifie la longueur du nom d'utilisateur

        if (strlen($un) > 25 || strlen($un) < 5) 
        {
            
            array_push($this->errorArray, Constants::$userNameCharacters);
            return;
        }

        //Vérifier si le username existe

        $checkUsernameQuery = mysqli_query($this->con, "SELECT username FROM users WHERE username = '$un'");

        if (mysqli_num_rows($checkUsernameQuery) != 0) {
            
            array_push($this->errorArray, Constants::$usernameTaken);
        }
    }

    private function validateFirstName($fn)
    {
         //On vérifie la longueur du nom

        if (strlen($fn) > 25 || strlen($fn) < 2) 
        {
            
            array_push($this->errorArray, Constants::$firstNameCharacters);
            return;
        }
    }

    private function validateLastName($ln)
    {
        //On vérifie la longueur du prénom

        if (strlen($ln) > 25 || strlen($ln) < 2) 
        {
            
            array_push($this->errorArray, Constants::$lastNameCharacters);
            return;
        }
    }

    private function validateEmails($em, $em2)
    {
        //On vérifie si les mots de passe correspodent

        if ($em != $em2) {
            array_push($this->errorArray, Constants::$emailDonotMatch);
            return;
        }

        //On vérifie si l'adresse email est valide

        if (!filter_var($em, FILTER_VALIDATE_EMAIL)) {
            array_push($this->errorArray, Constants::$emailInvalid);
            return;
        }

        //Vérifier si le nom d'utilisateur n'est pas déjà utilisé

        $checkEmailQuery = mysqli_query($this->con, "SELECT email FROM users WHERE email = '$em'");

        if (mysqli_num_rows($checkEmailQuery) != 0) {
            
            array_push($this->errorArray, Constants::$emailTaken);
        }
    }

    private function validatePasswords($pw, $pw2)
    {
        //On vérifie si les deux mots de passe correspondent

        if ($pw != $pw2) {
            array_push($this->errorArray, Constants::$passwordCharacters);
            return;
        }

        //On vérifie si le mot de passe fourni ne contient que des caractères alphanumériques

        if (preg_match('/[^A-Za-z0-9]/', $pw)) {
            array_push($this->errorArray, Constants::$passwordNotAlphaNumeric);
            return;
        }

        //On vérifie la longueur du mot de passe 

        if (strlen($pw) > 30 || strlen($pw) < 5) 
        {
            array_push($this->errorArray, Constants::$passwordDonotMatch);
            return;
        }
    }
}