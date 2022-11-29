<?php
    include("model/studentPortalModel.php");
    $student = new studentPortal();

    if(isset($_POST["studentNumber"],$_POST["confirmPassword"])){
        $received = $student->resetPassword($_POST["studentNumber"],$_POST['confirmPassword']);
        if($received == 1)echo '1';   
        
    }
?>
