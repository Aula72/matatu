const base_url = window.origin;


var headers  = {
	"auth":localStorage.getItem('auth'),
}

const toast = (message) =>{
	return `<div class="toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true">
  <div class="d-flex">
    <div class="toast-body">
      ${message}
    </div>
    <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
</div>`
}


const logged_in =() =>{
	if(localStorage.getItem('auth')==='' || localStorage.getItem('auth')===null){
		window.location = '/logout'
	}
}

const title = (t) =>{
	document.title = `${t} - Matatu`;
}

$(document).ready((e)=>{
	let k = localStorage.getItem('type')

	if(k==1){
		$('#nav_drive').hide()
	}else{
		$('#nav_admin').hide()
	}
})