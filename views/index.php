<div id="drive">
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

        <video id="videoPlayer" src="https://youtu.be/VETeteonCec" autoplay autobuffer controls />
        </div>
    </div>
        <div class="row" style="background-color:red; height: 25%;">
        bottom adds
    </div>    
</div>
</div>

<div id="admin" class="m-2">
       <div class="row mt-2 mb-2" >
                <div class="col-md-8">Available Ads</div>
                <div class="col-md-4">
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#staticAd">
                                Add New Ad
                        </button>
                        
                </div>
        </div> 

        <div class="row">
                <ul class="list-group" id='ads'></ul>
        </div>

</div>

           




<style type="text/css">
        html, body {
                margin: 0; 
                height: 100%; 
                overflow: hidden
        }
</style>

<script> 
        logged_in();
        title('Home')
        if(localStorage.getItem('type') == 2){
                $('#admin').hide()

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
        }else{
                $('#drive').hide()
                $.ajax({
                        url:`${base_url}/apis/ads.php`,
                        method:'get',
                        headers,
                        success:(data, status)=>{
                                console.log(data)
                                let g = ''
                                for(var k of data.ads){
                                        g += `<li class='list-group-item'>${k.name}<button class='btn btn-sm btn-warning' style='float:right;' onclick='add_image(${k.id})'>Add Image(s)</button></li>`
                                }
                                $('#ads').html(g)
                        }
                })
        }
        
        

        const add_image =(i)=>{
                console.log(i)
        }
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
                <input type="file" class="form-control" name="the_file" accept="video/mp4,video/mov,video/mpeg" id="the_file" /> 
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
                <input type="file" class="form-control" name="the_file" accept="audio/m4a,audio/mp3"  id="the_file" /> 
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


<div class="modal fade" id="staticAd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Create New Ad</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id='createAdd'>
                <div class="form-group mb-2">
                        <input type="text" class="form-control" id='name' placeholder="Advert Name" name="">
                </div>
                <div class="form-group mb-2">
                        <select class="form-control" id="p_id">

                        <?php 
                                $g = make_query("select * from ad_packages");
                                foreach($g->fetchAll() as $r){
                                        echo "<option value='".$r['id']."'>".$r['name']."</option>";
                                }
                        ?>
                        </select>
                </div>

                <input type="hidden" id='ad_status' value='1' name="">

                <div class="form-group mb-2">
                        <select id='ad_type' class="form-control">
                                <option value="1">Bottom Ad</option>
                                <option value="0">Left Side Ad</option>
                        </select>
                </div>
                
                <button type="submit"  class="btn btn-sm btn-secondary">Submit</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Understood</button> -->
      </div>
    </div>
  </div>
</div>



<script type="text/javascript">
        $('#createAdd').on('submit', (e)=>{
                e.preventDefault()

                let data = {
                        "ad_status":$('#ad_status').val(),
                        "p_id":$('#p_id').val(),
                        "name":$('#name').val(),
                        "ad_type":$('#ad_type').val(),
                }

                $.ajax({
                        url:`${base_url}/apis/ads.php`,
                        method: 'POST',
                        headers,
                        data:JSON.stringify(data),
                        success:(data, status)=>{
                                console.log(data)
                        }
                })
        })
</script>