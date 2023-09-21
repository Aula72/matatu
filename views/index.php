<div class="col-md-4">side adss</div>
<div class="col-md-8" style="height: 75%;">
        
            <script type="text/javascript">

// var nextVideo = "https://matatu.keberaorganics.com/uploads/user-videos/569e87cb50cb09d7d6ee4a1f46632f06.mp4";
// var videoPlayer = document.getElementById('videoPlayer');
// videoPlayer.onended = function(){
//     videoPlayer.src = nextVideo;
// }
</script>
<video id="videoPlayer" src="https://matatu.keberaorganics.com/uploads/avatars/a8b0fab10d5b220e3c7afb0236e926e6.mp4" autoplay autobuffer controls />
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
        var nextVideo = ["https://matatu.keberaorganics.com/uploads/user-videos/569e87cb50cb09d7d6ee4a1f46632f06.mp4","https://matatu.keberaorganics.com/uploads/user-videos/2d58a8efd15e9e70569c36a1d9b32cfb.mp4"]; 
        var curVideo = 0; 
        var videoPlayer = document.getElementById('videoPlayer'); 
        videoPlayer.onended = function(){ 
        if(curVideo == 0){ 
                videoPlayer.src = nextVideo[1]; 
                curVideo = 1; 
        } else if(curVideo == 1){ 
                videoPlayer.src = nextVideo[0]; curVideo = 0; 
        } 
        } 
</script>
