//js for home pages

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
                        g += `<li class='list-group-item'>${k.name}<div style='float:right;'><button type="button" class="btn btn-warning btn-sm m-1" data-bs-toggle="modal" data-bs-target="#ad${k.id}" >Add Image(s)</button><button type="button" class="btn btn-danger btn-sm m-1" onclick='delete_ad(${k.id})'>Remove</button></div></li>`
                       
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

                // do{
                        var videoPlayer = document.getElementById('videoPlayer'); 
                        videoPlayer.src = `${nextVideo[0]['video_url']}`;
                        videoPlayer.onended = function(){ 
                        if(curVideo <= data.videos.length){ 
                                videoPlayer.src = `${nextVideo[curVideo+1]['video_url']}`; 
                                curVideo += 1; 
                        }else{
                                curVideo = 0;
                        }
                }
                // }while(1);
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
        
const delete_ad =(i)=>{
  let c = confirm("Are sure you want to delete this add?")
  if(c){
    $.ajax({
      url:`${base_url}/apis/ads.php?id=${i}`,
      method:'delete',
      headers,
      success:(data, status)=>{
        list_ads();
      }
    })
  }
}

$(document).ready(()=>{
  $.ajax({
  url:`${base_url}/apis/ads.php`,
  method:'get',
  headers,
  success:(data,status)=>{
    console.log(data)
    let g = ''
    if(data.ads.ad_type == 1){
      console.log(data.ads.pics)
      g += `<div class="mySlides fade">
  
  <img src="${data.ads.pics.uri}" style="width:100%">
  <div class="text">Caption Text</div>
</div>`
    }
    $('#bottom-add').html(g)
  }
})
})