<?php
if(!isset($_POST['registerEmail']) and !isset($_POST['registerPassword'])) Header("Location: /");
require_once "Clases.php";
$user = new User();

if ($user->addNewUser(htmlspecialchars($_POST['registerEmail']),
                      htmlspecialchars($_POST['registerPassword']),
                      htmlspecialchars($_POST['registerFirstName']),
                      htmlspecialchars($_POST['registerLastName'])) != 0)
{
  echo json_encode(['user_registration' => 'ok']);
} else {
  echo json_encode(['registerEmail' => 'invalid_email']);
}
?>