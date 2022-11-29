function errorfunction(errorvar){
	Swal.fire({
	  position: 'center',
	  icon: 'error',
	  text: errorvar,
	  showConfirmButton: false,
	  allowOutsideClick: false,
	  timer: 2000,
	  allowEscapeKey: false
	})
}

function warningfunction(warningvar){
	Swal.fire({
	  position: 'center',
	  icon: 'warning',
	  text: warningvar,
	  showConfirmButton: false,
	  allowOutsideClick: true,
	  timer: 1000,
	  allowEscapeKey: true
	})
}

function successfunction(successVar){
	
	Swal.fire({
	customClass: {
		confirmButton: 'btn btn-success  ',
	},
	  position: 'center',
	  icon: 'success',
	  title: 'Success',
	  text: successVar,
	  showConfirmButton: false,
	  allowOutsideClick: false,
	  showConfirmButton: true,
	  confirmButtonColor: '#003e21',
	  confirmButtonText: 'OK',
	  
	}).then((result) => {
		if (result.isConfirmed) {
			location.reload();
		}
	});
}




function crud(){
	Swal.fire({
		/*put inside the functions*/
	  position: 'center',
	  icon: 'question',
	  text: 'Do you want to D/U/S!',
	  showConfirmButton: true,
	  showCancelButton: true,
	  confirmButtonColor: 'green',
	  confirmButtonText: 'CONFIRM',
	  cancelButtonColor: 'red',
	  cancelButtonText: 'CANCEL',
	  timer: 0
	}).then((result) => {
		if (result.isConfirmed) {
			return false;
		  }
	});

}

function success(detailsvar){
 
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3500,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'success',
  title: detailsvar/*,
  text:'aw',
  footer: '<a href="">Why do I have this issue?</a>'*/
})
}

function loading(){
 
	Swal.fire({
		showConfirmButton: false,
		imageUrl: 'sweetalert/loadinggif.gif',
		backgroundColor:false,
		allowOutsideClick: false,
		allowEscapeKey: false,
		customClass: {
			popup: 'my-swal'
		 },
	})
}