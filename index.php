
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
			<h2>Forgot Password</h2>
     
		</div>
    <div class="card-body ">
      <span id="message"></span>

      <div> 

          <p class="text-white mb-0">Enter your email address</p>
          <div class="input-group mb-3">
            <input type="email" class="form-control"  id="email"  placeholder="Email " onkeydown="if (event.keyCode == 13){verifyEmail();}">
            <div class =" input-group-append">
              <div class="input-group-text btn-login">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
            <button class="btn btn-success mt-2 mb-5 w-100 btn-login" onclick="verifyEmail();" id ="step1" >Continue</button><br>
          </div>
      </div>
    
   

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- <div class="card login-card p-0" >
	<center>
		<div class="card-header text-center mt-1 text-success">
			<h2>Forgot Password</h2>


		</div>
		<div class="card-body">
       <span id="message"></span>
       <div class ="text-left mx-4 text-white">
        <small class="text-right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Enter your email address</small>
      </div>
			<input type="email" class="form-control w-75" id="email" onkeydown="if (event.keyCode == 13){resetPassword();}"> 
      
      <button class="btn btn-success mt-2 mb-5 w-75 btn-login" onclick="resetPassword();" >Continue</button><br>
>
		</div>
	</center>
</div> -->










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


function verifyEmail()
{


  if($('#email').val() == "" ) 
  {
  $('#message').html( "<i class='fas fa-exclamation-circle'> </i> Please fill up the fields.");
  return false;
  }


  $.ajax({
    url: "checkEmailExist.php",
    type: "POST",
    cache: false,
    data:{
      email: $('#email').val(),
    },
    success: function(data){
      if(data == 1)
      {
        $.ajax({
          url: "phpmailer/index.php",
          type: "POST",
          cache: false,
          data:{
            email: $('#email').val(),
          },
          beforeSend: function(){
            
            $('#step1').prop("disabled", true);
            $('#step1').html(innerHTML= " <i class='spinner-border spinner-border-sm'></i> Sending..");
          },
          success: function(emailData){
            if(emailData == 1)
            {
              successSend("The reset password code was sent to your mail.");
              $('#email').val('');
              $('#step1').prop("disabled", false);
              $('#step1').html(innerHTML= "Continue");
            
            }
            else{ 
              $('#message').html(innerHTML= "<i class='fas fa-exclamation-circle'> </i> " + emailData);
              return false;
            }
          }
        });   
       
        
       
      }
      else{ 
        $('#message').html(innerHTML= "<i class='fas fa-exclamation-circle'> </i> " + data);
        return false;
      }
      
    }
  });   

}





// $('#showNewPass').on('click', function(){
//       $(this).toggleClass("fa-eye fa-eye-slash");
//       var passInput=$("#newPassword");
//       if(passInput.attr('type')==='password')
//         {
//           passInput.attr('type','text');
//       }else{
//          passInput.attr('type','password');
//       }
// })
// $('#showCFPass').on('click', function(){
//       $(this).toggleClass("fa-eye fa-eye-slash");
//       var passInput=$("#confirmPassword");
//       if(passInput.attr('type')==='password')
//         {
//           passInput.attr('type','text');
//       }else{
//          passInput.attr('type','password');
//       }
// })

// </script>

 <script>
// function resetPassword()
// {

//   if($('#username').val() == "" || $('#studentNumber').val() == "" || $('#newPassword').val() == "" || $('#confirmPassword').val() == "") 
//   {
//   $('#message').html( "<i class='fas fa-exclamation-circle'> </i> Please fill up all fields.");
//   return false;
//   }



//   $.ajax({
//     url: "checkStudentExist.php",
//     type: "POST",
//     cache: false,
//     data:{
//       studentNumber: $('#studentNumber').val(),
//       username: $('#username').val(),
//     },
//     success: function(data){
//       if(data == 1)
//       {
//         if ($('#newPassword').val().length < 6)
//         {
//           $('#message').html( "<i class='fas fa-exclamation-circle'> </i>Password must be 6 characters and above."); 
//           return false;
//         }
//         if( $('#newPassword').val() !=  $('#confirmPassword').val()) 
//         {
//           $('#message').html("<i class='fas fa-exclamation-circle'> </i> New password and Confirm password does not match."); 
//           return false;
//         }
//         $.ajax({
//           url: "resetPassword.php",
//           type: "POST",
//           cache: false,
//           data:{
//             studentNumber: $('#studentNumber').val(),
//             confirmPassword: $('#confirmPassword').val()
//           },
//           success: function(studentdata){
//               if(data == 1)
//               {
      
//                   $('#message').html("<i class='fas fa-check-circle' text-success> </i> Your password has been change successfully."); 
//                   $('#username').val('');
//                   $('#studentNumber').val('');
//                   $('#newPassword').val('');
//                   $('#confirmPassword').val('');
//               }
//               else{
//                   $('#message').html("<i class='fas fa-check-circle' text-success> </i> Password Resettng Failed!"); 
//               }
//           }
//         });
//       }
//       else{ 
//         $('#message').html(innerHTML= "<i class='fas fa-exclamation-circle'> </i> " + data);
//         return false;
//       }
      
//     }
//   });   	
// }


</script>

</body>
</html>
