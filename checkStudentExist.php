<?php
include("model/studentPortalModel.php");

$student = new studentPortal();

if(isset($_POST['studentNumber'],$_POST['username']))
{
    $checkStudent = $student->checkExist($_POST['studentNumber'],$_POST['username']);
    if($checkStudent == 1)echo '1';   
    else if($checkStudent == 0)echo "Student number does not exist.";
    else if($checkStudent == 2)echo "Username does not match to your student number.";

}

?>