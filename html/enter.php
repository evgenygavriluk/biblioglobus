<?php
require_once "Clases.php";
$user = new User();
$userid = $user->checkUser($_POST['registerEmail'], $_POST['registerPassword']);

if (!$userid== 0)
{
    session_start();
    $_SESSION['userid'] = $userid;
    echo json_encode(['user_enter' => 'ok']);
} else {
    echo json_encode(['enterEmail' => 'invalid_email']);
}
?>