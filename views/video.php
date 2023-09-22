
<ul class="list-group" id="videos"></ul>


<script type="text/javascript">
	$.ajax({
		url:`${base_url}/apis/videos.php`,
		method:"GET",
		headers,
		success:(data, status)=>{
			console.log(data)
		}
	})
</script>


