<div class="container">
<h3 class="text-center">My Videos</h3>

<ul class="list-group" id="videos"></ul>
<div class="row mt-2 mb-2" >
                <div class="col-md-6"></div>
                <div class="col-md-6">
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                Upload Video
                        </button>
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#staticAudio">
                                Upload Audio
                        </button>
                </div>
        </div>
</div>
<script type="text/javascript">
	$.ajax({
		url:`${base_url}/apis/videos.php`,
		method:"GET",
		headers,
		success:(data, status)=>{
			console.log(data)
			let po = ''
			for(let k of data.videos){
				po+=`<li class='mb-1'>${k.video_name}<button class='btn btn-sm btn-danger' style='float:right;'>Remove</button></li>`
			}
			$('#videos').html(po);
		}
	})
</script>


<!-- upload video modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Upload New Video</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/upload.php?type=user_video" method="post" enctype="multipart/form-data">
                <!-- <div class="form-group">
                       <input type="text" class="form-control" name="name" placeholder="Video Name..."> 
                </div> -->
                <div class="form-group">
                     <label for="file"><span>Filename:</span></label>
                <input type="file" class="form-control" name="the_file" accept="video/mp4,video/mov,video/mpeg" id="the_file" multiple="multiple" class="multi"/> 
                <br />   
                </div>
                
                <input type="submit" name="submit" class="btn btn-sm btn-secondary"value="Submit" />
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Understood</button> -->
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="staticAudio" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Upload New Audio</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/upload.php?type=user_audio" method="post" enctype="multipart/form-data">
                <!-- <div class="form-group">
                       <input type="text" class="form-control" name="name" placeholder="Video Name..."> 
                </div> -->
                <div class="form-group">
                     <label for="file"><span>Filename:</span></label>
                <input type="file" class="form-control" name="the_file" accept="audio/m4a,audio/mp3"  id="the_file" multiple="multiple" class="multi"/> 
                <br />   
                </div>
                
                <input type="submit" name="submit" class="btn btn-sm btn-secondary"value="Submit" />
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Understood</button> -->
      </div>
    </div>
  </div>
</div>




