<script type="text/javascript" src="/assets/js/jquery.multiple-upload.js"></script>
<div id="drive">
        <div class="row">
              <div class="col-md-4" style="background-color:green; height:75%">
                      <?php include_once "incs/side-ad.php";?>
              </div>
                <div class="col-md-8" style="height: 75%;">
         

        <video id="videoPlayer" autoplay autobuffer controls>
                <!-- <source  type="video/mp4" id=""> -->
        </video>
        </div>
</div>
        </div>
   

    <div class="row">
        <div class="col-12" style="background-color:red; height: 20%;">
        <?php include_once "incs/botton-ad.php";?>
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


<div id="modal_region"></div>
<style>
      video{
       /* width: 720px; 
        height: 480px;*/
        width:100%;
        height: 100%;
/*        border: 1px solid #666;*/
float: right;
      }
    </style>

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
                                list_ads();
                        }
                })
        })

        logged_in();
        title('Home')
        const list_ads = () =>{
                        $.ajax({
                        url:`${base_url}/apis/ads.php`,
                        method:'get',
                        headers,
                        success:(data, status)=>{
                                console.log(data)
                                let g  = ''
                                for(var k of data.ads){
                                        g += `<li class='list-group-item'>${k.name}<button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#ad${k.id}" style='float:right'>Add Image(s)</button></li>`
                                       
                                }
                                $('#ads').html(g)
                                
                        }
                        })
                }

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
                        videoPlayer.src = `${nextVideo[0]['video_url']}`;
                        videoPlayer.onended = function(){ 
                        if(curVideo == 0){ 
                                videoPlayer.src = `${nextVideo[1]}`; 
                                curVideo = 1; 
                        } else if(curVideo == 1){ 
                                videoPlayer.src = nextVideo[0]; curVideo = 0; 
                        } 
                        } 
                }
                })
                list_ads()
        }else{
                $('#drive').hide()
                list_ads()
                
        }
        
        

        const add_image =(i,x)=>{
                console.log(i)
                
        }
        


</script>




<?php 
$cv = make_query("select * from ad");
foreach($cv->fetchAll() as $c){
?>
<div class="modal fade" id="ad<?php echo $c['id'];?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"  role="dialog" aria-labelledby="adLabel<?php echo $c['id'];?>" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="adLabel<?php echo $c['id'];?>"><?php echo $c['name']; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/upload.php?ad_photo" method="post">
                <input type='hidden' name='ad_id' value='<?php echo $c['id'];?>'>
                <div class='form-group mb-2'>
                <input type='file' name='the_file' class='form-control' accept="image/png,image/jpg,image/jpeg">
                </div>
                <input type='submit' class="btn btn-primary btn-sm" value='Submit' name='submit'/>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>
<?php 
}
?>