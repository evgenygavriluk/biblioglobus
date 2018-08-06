<?php
require_once "Clases.php";
$user = new User();

if ($user->addNewUser($_POST['registerEmail'], $_POST['registerPassword'], $_POST['registerFirstName'], $_POST['registerLastName']) != 0)
{
  echo json_encode(['user_registration' => 'ok']);
} else {
  echo json_encode(['registerEmail' => 'invalid_email']);
}
?>