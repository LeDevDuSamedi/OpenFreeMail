<?php
session_start(); 
if(!empty($_SESSION['mail'])){
    if($_GET['rd']){
        $rd = $_GET['rd'];
        header('Location: '.$rd);
    }else{
        header('Location: index.php');
    }
}
$error = "";
if(isset($_POST['valider'])){
    if(!empty($_POST['email'] && !empty($_POST['mdp']))){
        $user = $_POST['email'];
            $password = $_POST['mdp'];
            $boite = stristr($user, "@");
            $boites = array(
                "@outlook.fr" => "outlook.office365.com",
                "@outlook.com" => "outlook.office365.com",
                "@hotmail.fr" => "outlook.office365.com",
                "@hotmail.com" => "outlook.office365.com",
                "@gmail.com" => "imap.gmail.com"
                );
            $boite = $boites[$boite];
            echo($boite);
            $host = '{'.$boite.':993/imap/ssl/novalidate-cert/norsh}INBOX';
            /* Your gmail credentials */
            
  
            /* Establish a IMAP connection */
            $imap_connect = imap_open($host, $user, $password) or die('unable to connect mailbox: ' . imap_last_error());
            $_SESSION['email_addr'] = $user;
            $_SESSION['email_serv'] = $boite;
            $_SESSION['email_pass'] = $password;
            $_SESSION['mail'] = true;
            $_SESSION['connection'] = $imap_connect;
            sleep(2);
            header("Location: index.php");
    }else{
        $error = "Veuillez remplir tout les champs";
    }
}
?>
<form style="text-align:center;" method="POST">
    <input type="email"name="email" placeholder="Adresse Email">
    <input type="password"name="mdp" placeholder="Mot de passe">
    <button name="valider">Se connecter à la boite mail</button>
</form>
<p style="text-align:center;"><?=$error?></p>
