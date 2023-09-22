
<ul class="list-group" id="videos"></ul>


<script type="text/javascript">
	$.ajax({
		url:`${base_url}/apis/videos.php`,
		method:"GET",
		headers,
		success:(data, status)=>{
			console.log(data)
			let po = ''
			for(let k of data.videos){
				po+=`<li>${k.video_name}<button class='btn btn-small btn-danger left'>Remove</button></li>`
			}
			$('#videos').html(po);
		}
	})
</script>


