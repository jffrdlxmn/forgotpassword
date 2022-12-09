<?php
  include("model/employeePortalModel.php");
  $check = new employeePortal();
  $token = $_GET['token'];
  $email =  $_GET['email'];


  if(!isset($token,$email))header("location:404.php");
  $checkToken =  $check->checkToken($token,$email);
  if($checkToken == "2")  header("location:expiredToken.php");
  elseif($checkToken == "0")  header("location:404.php");
  



?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport"  http-equiv="Content-Type" content="width=device-width, initial-scale=1">
  <title>CvSU-CCAT | FACULTY INFORMATION SYSTEM</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  
   <!-- MY CSS -->
   <link rel="stylesheet" href="dist/css/style.css">

</head>

<body id="login-background" class="hold-transition login-page">


<div class="login-box">
 
  <div class="card login-card">
    <div class="card-header text-center mt-1 text-success">
			<h2>Reset Password</h2>
     
		</div>
    <div class="card-body ">
      <span id="message"></span>

      <div> 
            
        <p class="text-white mb-0">New Password</p>     
        <input type="password" class="form-control "  id="newPassword"  placeholder="New Password " onkeydown="if (event.keyCode == 13){resetPassword();}">
        <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password" id="showNewPass"></span>
        <p class="text-white mb-0">Confirm Password</p>     
        <input type="password" class="form-control "  id="confirmPassword"  placeholder="Confrim Password " onkeydown="if (event.keyCode == 13){resetPassword();}">
        <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password" id="showCFPass"></span>
            
      </div>
          <button class="btn btn-success mt-2 mb-5 w-100 btn-login" onclick="resetPassword();"  >Continue</button><br>
      </div>
    
   

    </div>
    <!-- /.change password-card-body -->
  </div>
</div>
<!-- /.change password-box -->













<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- Sweet Alert -->
<script src="dist/sweetalert/sweetalert_library.js"></script>
<script src="dist/sweetalert/sweet_alert.js"></script>

<script>
$('#showNewPass').on('click', function(){
      $(this).toggleClass("fa-eye fa-eye-slash");
      var passInput=$("#newPassword");
      if(passInput.attr('type')==='password')
        {
          passInput.attr('type','text');
      }else{
         passInput.attr('type','password');
      }
})
$('#showCFPass').on('click', function(){
      $(this).toggleClass("fa-eye fa-eye-slash");
      var passInput=$("#confirmPassword");
      if(passInput.attr('type')==='password')
        {
          passInput.attr('type','text');
      }else{
         passInput.attr('type','password');
      }
})






</script>
<script>
function resetPassword()
{

  var email = "<?php echo $email; ?>";
  var token = "<?php echo $token; ?>";
  if( $('#newPassword').val() == "" || $('#confirmPassword').val() == "") 
  {
  $('#message').html( "<i class='fas fa-exclamation-circle'> </i> Please fill up all fields.");
  return false;
  }


  if ($('#newPassword').val().length < 6)
  {
    $('#message').html( "<i class='fas fa-exclamation-circle'> </i>Password must be 6 characters and above."); 
    return false;
  }
  if( $('#newPassword').val() !=  $('#confirmPassword').val()) 
  {
    $('#message').html("<i class='fas fa-exclamation-circle'> </i> New password and Confirm password does not match."); 
    return false;
  }

  $.ajax({
    url: "resetPassword.php",
    type: "POST",
    cache: false,
    data:{
      email: email,
      token: token,
      confirmPassword: $('#confirmPassword').val()
    },
    success: function(data){
        if(data == 1)
        {

            $('#message').html("<i class='fas fa-check-circle' text-success> </i> Your password has been change successfully."); 
            $('#newPassword').val('');
            $('#confirmPassword').val('');
        }
        else{
            $('#message').html("<i class='fas fa-check-circle' text-success> </i> Password Resettng Failed!") +data; 
        }
    }
  });
}
</script>

</body>
</html>
