<?php
if(!isset($_POST['enterEmail']) and !isset($_POST['enterPassword'])) Header("Location: /");
require_once "Clases.php";
$user = new User();
$userid = $user->checkUser(htmlspecialchars($_POST['enterEmail']),
                           htmlspecialchars($_POST['enterPassword']));
//echo $userid;
if (!$userid== 0)
{
    session_start();
    $_SESSION['userid'] = $userid;
    echo json_encode(['enterEmail' => 'ok']);
} else {
    echo json_encode(['enterEmail' => 'invalid_email']);
}
?>