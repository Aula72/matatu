<div class="col-md-4">side adss</div>
<div class="col-md-8" style="height: 75%;">
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
            <script type="text/javascript">

// var nextVideo = "https://matatu.keberaorganics.com/uploads/user-videos/569e87cb50cb09d7d6ee4a1f46632f06.mp4";
// var videoPlayer = document.getElementById('videoPlayer');
// videoPlayer.onended = function(){
//     videoPlayer.src = nextVideo;
// }
</script>
<video id="videoPlayer" src="https://youtu.be/VETeteonCec" autoplay autobuffer controls />
        </div>
    </div>
<div class="row" style="background-color:red; height: 25%;">
        bottom adds
    </div>


<style type="text/css">
        html, body {
                margin: 0; 
                height: 100%; 
                overflow: hidden
        }
</style>

<script> 

        $.ajax({
                url: `${base_url}/apis/videos.php`,
                method:'get',
                headers,
                success:(data, status)=>{
                        console.log(data)
                        var nextVideo = data.videos; 
                        
        
                        var curVideo = 0; 

                        var videoPlayer = document.getElementById('videoPlayer'); 
                        videoPlayer.src = `/uploads/user-videos/${nextVideo[0]['video_url']}`;
                        videoPlayer.onended = function(){ 
                        if(curVideo == 0){ 
                                videoPlayer.src = `/uploads/user-videos/${nextVideo[1]}`; 
                                curVideo = 1; 
                        } else if(curVideo == 1){ 
                                videoPlayer.src = nextVideo[0]; curVideo = 0; 
                        } 
                        } 
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
                <div class="form-group">
                       <input type="text" class="form-control" name="name" placeholder="Video Name..."> 
                </div>
                <div class="form-group">
                     <label for="file"><span>Filename:</span></label>
                <input type="file" class="form-control" name="the_file" id="the_file" /> 
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
                <div class="form-group">
                       <input type="text" class="form-control" name="name" placeholder="Video Name..."> 
                </div>
                <div class="form-group">
                     <label for="file"><span>Filename:</span></label>
                <input type="file" class="form-control" name="the_file" id="the_file" /> 
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
