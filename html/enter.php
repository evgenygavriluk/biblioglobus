<?php
require_once "Clases.php";
$user = new User();
$userid = $user->checkUser($_POST['enterEmail'], $_POST['enterPassword']);
echo $userid;
if (!$userid== 0)
{
    session_start();
    $_SESSION['userid'] = $userid;
    echo json_encode(['enterEmail' => 'ok']);

} else {
    echo json_encode(['enterEmail' => 'invalid_email']);
}
?>