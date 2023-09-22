<script type="text/javascript">
	
	localStorage.removeItem('auth');
	localStorage.removeItem('type');
	localStorage.clear();
</script>
<?php

unset($_COOKIE['user_key']);

header('location: /login');
