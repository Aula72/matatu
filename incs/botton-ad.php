<div class="bt-container">
        <!-- Full-width images with caption text -->
        <?php 
        $t=0;
        $bt = make_query("select * from ad");
        foreach($bt->fetchAll(PDO::FETCH_ASSOC) as $b){
            $im = make_query("select * from ad_img where ad_id=:id",[':id'=>$b['id']]);
            if($b['ad_type']==1){
            foreach($im->fetchAll(PDO::FETCH_ASSOC) as $i){
                ?>
                <div class="bt-image-sliderfade bt-fade">
            <img src="<?php echo $i['uri'];?>"
                 style="width: 100%" />
            <div class="bt-text"><?php echo $b['name']; ?></div>
        </div>
            <?php 
            $t++;}
        }
        }
        ?>
        
 
        
    </div>
    <br />
 
    <!-- The dots/circles -->
    <div style="text-align: center">
        <?php for($v=0;$v<=$t;$v++){?>
        <span class="bt-dot"></span>
        <?php } ?>
    </div>

<style>
    .image-sliderfade {
    display: none;
}
 
img {
    vertical-align: middle;
}
 
/* Slideshow container */
.bt-container {
    height: 45vh; 
    width:100wh
    position: relative;
    margin: auto;
}
 
/* Caption text */
.bt-text {
    color: #f2f2f2;
    font-size: 15px;
    padding: 20px 15px;
    position: absolute;
    right: 10px;
    bottom: 10px;
    width: 40%;
    background: rgba(0, 0, 0, 0.7);
    text-align: left;
}
 
/* The dots/bullets/indicators */
.bt-dot {
    height: 15px;
    width: 15px;
    margin: 0 2px;
    background-color: transparent;
    border-color: #ddd;
    border-width: 5 px;
    border-style: solid;
    border-radius: 50%;
    display: inline-block;
    transition: border-color 0.6s ease;
}
 
.bt-active {
    border-color: #666;
}
 
/* Animation */
.bt-fade {
    -webkit-animation-name: fade-image;
    -webkit-animation-duration: 1.5s;
    animation-name: fade-image;
    animation-duration: 1.5s;
}
 
@-webkit-keyframes bt-fade-image {
    from {
        opacity: 0.4;
    }
    to {
        opacity: 1;
    }
}
 
@keyframes bt-fade-image {
    from {
        opacity: 0.4;
    }
    to {
        opacity: 1;
    }
}
 
/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
    .bt-text {
        font-size: 11px;
    }
}
</style>

<script>
    let slideIndex_bt = 0;
showSlides_bt(); // call showslide method

function showSlides_bt() {
    let i;

    // get the array of divs' with classname image-sliderfade
    let slides = document.getElementsByClassName("bt-image-sliderfade");

    // get the array of divs' with classname dot
    let dots = document.getElementsByClassName("bt-dot");

    for (i = 0; i < slides.length; i++) {
        // initially set the display to
        // none for every image.
        slides[i].style.display = "none";
    }

    // increase by 1, Global variable
    slideIndex_bt++;

    // check for boundary
    if (slideIndex_bt > slides.length) {
        slideIndex_bt = 1;
    }

    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }

    slides[slideIndex_bt - 1].style.display = "block";
    dots[slideIndex_bt - 1].className += " active";

    // Change image every 2 seconds
    setTimeout(showSlides_bt, 3000);
}

</script>