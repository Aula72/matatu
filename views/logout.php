<?php

unset($_COOKIE['user_key']);
?>
<script type="text/javascript">
	
	localStorage.removeItem('auth');
	localStorage.removeItem('type');
	localStorage.clear();

	$.ajax({
		url:`${base_url}/apis/user.php`,
		method:'POST',
		headers,
		success:(data, status)=>{
			window.location = '/login'
		}
	})
</script>

<!-- header('location: /login'); -->
