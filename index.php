<?php 
session_start();
if(empty(($_SESSION['mail']))){
    echo("Redirection...");
    header('Location: login.php?rd=index.php');
}
echo $_SESSION['connection'];
$imap_connect = $_SESSION['connection'];
$mails = imap_search($imap_connect, 'ALL');
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Boite <?=$_SESSION['email_addr']?></title>
    </head>
    <body>
        <a href="logout.php">Se déconnecter</a>

    </body>
</html>