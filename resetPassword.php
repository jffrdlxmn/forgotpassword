<?php
    include("model/employeePortalModel.php");
    $student = new employeePortal();

    if(isset($_POST["email"],$_POST["token"],$_POST["confirmPassword"])){
        $received = $student->resetPassword($_POST["email"],$_POST["token"],$_POST['confirmPassword']);
        if($received == 1)echo '1';   
        
    }
?>
