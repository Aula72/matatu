
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
				po+=`<li>${k.video_name}<button class='btn btn-sm btn-danger' style='float:right;'>Remove</button></li>`
			}
			$('#videos').html(po);
		}
	})
</script>


