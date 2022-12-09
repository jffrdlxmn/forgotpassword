<?php
include("model/employeePortalModel.php");

$student = new employeePortal();

if(isset($_POST['email']))
{
    $checkStudent = $student->checkExist($_POST['email']);
    if($checkStudent == 1)echo '1';   
    else echo "The email address does not exist.";
}

?>