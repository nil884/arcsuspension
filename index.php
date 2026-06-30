<?php include("includes/configuration.php"); include("classes/product.php"); include("visitor.php");
$prod = new Product(); $imgtype = "product"; include("getimgpath.php"); $trendingcount = $prod->getProductsGroupCount("trending_now=1"); $newarrivalcount = $prod->getProductsGroupCount("new_arrival=1");
$actual_link = ($_SERVER['HTTPS'] == 'on'?"https://":"http://").$_SERVER['HTTP_HOST']."".$_SERVER['REQUEST_URI']; ?>
<!DOCTYPE html>
<html lang="en">
<head><title>Home : <?php echo SITE_TITLE; ?></title><meta name="description" content="<?php echo METADESCRIPTION; ?>"><meta name="keywords" content="<?php echo METAKEYWORDS; ?>"><link rel="canonical" href="<?="https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>" >
<!--Open Graph / Facebook-->
<meta property="og:type" content="website">
<meta property="og:url" content="<?php echo $actual_link; ?>">
<meta property="og:title" content="Home : <?php echo SITE_TITLE; ?>">
<meta property="og:description" content="<?php echo METADESCRIPTION; ?>">
<meta property="og:image" content="<?=(OGIMAGE!=""?SITEURL."/img/ogimage/".OGIMAGE:SITEURL."/img/projectimage/".(LOGO != ""?LOGO:"default_logo.png")); ?>">
<!--Twitter-->
<meta property="twitter:card" content="<?=(OGIMAGE!=""?SITEURL."/img/ogimage/".OGIMAGE:SITEURL."/img/projectimage/".(LOGO != ""?LOGO:"default_logo.png")); ?>">
<meta property="twitter:url" content="<?php echo $actual_link; ?>">
<meta property="twitter:title" content="Home : <?php echo SITE_TITLE; ?>">
<meta property="twitter:description" content="<?php echo METADESCRIPTION; ?>">
<meta property="twitter:image" content="<?=(OGIMAGE!=""?SITEURL."/img/ogimage/".OGIMAGE:SITEURL."/img/projectimage/".(LOGO != ""?LOGO:"default_logo.png")); ?>">
<?php include "commoncss.php" ?>
<link rel="stylesheet" href="<?=SITEURL;?>/css/thumb-slider/owl.carousel.min.css" />
</head>
<body>
<div class="main-wrap">
<?php $Notification_home = selectQuery(NOTIFICATION,"notificationico,notificationlink,notification","isActive ='1' and show_on_homepage= '1' and show_on_all = '0' ");
if(count($Notification_home)) { ?>
<div class="notification-toggle pr-4 px-md-5 py-2">
    <div class="container">
        <div class="row">
            <div class="col-md-12 marquee"><div class="marq-notif"><img src="<?=SITEURL; ?>/img/projectimage/<?=$Notification_home[0]['notificationico']; ?>" alt="<?=$Notification_home[0]['notificationico']; ?>" width="20" height="20" class="mt-1 mt-md-0 mr-2"/><a href="<?=($Notification_home[0]['notificationlink']!=""?$Notification_home[0]['notificationlink']:SITEURL); ?>" target="_blank" class="d-inline-block" hreflang="en" ><?=$Notification_home[0]['notification']; ?></a></div></div>
        </div>
    </div>
    <span class="close-notif position-absolute d-inline-block"><i class="fa fa-times"></i></span>
</div>
<?php } ?>
<?php include "menu.php";
$slider = selectQuery(MAIN_SLIDER,"btn_link,img_name","1 order by priority ASC");
if(count($slider)){
$sliderpath = getimgconfigpaths('main slider'); ?>
<div id="demo" class="carousel slide home-banner" data-ride="carousel">
    <!--<ul class="carousel-indicators">
        <?php for($i=0;$i<count($slider);$i++){ ?>
        <li data-target="#demo" data-slide-to="<?=$i?>" class="<?php if($i == "0"){ echo "active";} ?>"></li>
        <?php } ?>
      </ul>-->
    <div class="owl-carousel owl-theme owl-banner">
        <?php for($i=0;$i<count($slider);$i++){ ?>
        <div class="item hm-slider-item">
            <a hreflang="en" href="<? if($slider[$i]['btn_link'] == ""){ echo SITEURL;} else { echo $slider[$i]['btn_link'];} ?>" target="_blank"><img src="<?=SITEURL.'/'.$sliderpath[0]['imgs_location'].'/'.$slider[$i]['img_name']; ?>" alt="Main Slider Image" class="img-fluid"></a> 
        </div>
        <?php } ?>
    </div>
</div>
<?php } ?>
<?php $parent = selectQuery(PRODCAT,"cat_name,img_name,id,type","type='Parent' AND isActive='1' and img_name <> '' order by priority");
if(count($parent)){ ?>
<div class="shop-by-category pb-2 pt-4 py-md-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12 pl-0 pl-md-3">
                <div class="hm-sec-head mb-2 mb-md-3"><h2 class="mb-0 pb-2 hm-sec-font-size hm-sec-text-color cc-fw-5 text-center">Select Your Vehicle</h2></div>
                <div class="owl-carousel owl-theme owl-shop-category row owl-row-zero-margin owl-vertically">
                    <?php $catpath = getimgconfigpaths('category');
                    for($p=0;$p<count($parent);$p++){
                    $parenttype = $parent[$p]['type']; $parentid=$parent[$p]['id'];
                    $checksub = selectQuery(PRODCAT,"count(id) as sub","type='Master' AND isActive='1' AND parent_id=".$parentid." AND img_name<>''");
                    if($checksub[0]['sub']){ $urlsrc=SITEURL."/m/".getUrl($parenttype,$parentid); }
                    else{$urlsrc=SITEURL.'/'.getUrl("Parent",$parentid);} ?>
                    <div class="item col-4 col-sm-4 col-md-4 col-lg-12 pr-0 px-lg-0 mb-3 mb-lg-0 text-center"><a href="<?=$urlsrc;?>" hreflang="en"><div class="categ-item position-relative shop-by-cat d-flex flex-wrap align-content-center card rounded-top p-2 p-md-3"><img src="<?=SITEURL.'/'.$catpath[0]['imgs_location'].'/'.$parent[$p]['img_name']; ?>" alt="<?php echo $parent[$p]['cat_name'] ?>" class="mw-100 m-auto rounded"></div>
                        <div class="h6 category-head text-center mb-0 rounded-bottom d-flex flex-wrap align-content-center justify-content-center cc-primary-back"><div class="my-1"><?php echo $parent[$p]['cat_name'] ?></div></div></a></div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<?php $offcnts = selectQuery( OFFER, "offer_name,img,offer_link", "isActive='1' and showonhomepage ='1' order by priority " ); $offerpath = getimgconfigpaths('offer');
if(count( $offcnts ) != 0){ ?>
<div class="home-offer-sldier pb-2 pb-md-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="owl-carousel owl-theme owl-offer row owl-row-zero-margin owl-vertically">
                    <?php for( $i = 0; $i < count( $offcnts ); $i++ ){?>
                    <div class="item col-12 col-sm-6 col-lg-12 pr-0 px-lg-0 mb-3 mb-sm-0">
                        <div class="offer-col">
                            <a href="<? if($offcnts[$i]['offer_link'] != ""){ echo $offcnts[$i]['offer_link'];} else { echo SITEURL; } ?>" target="_blank" hreflang="en" class="w-100 h-100 d-block d-flex flex-wrap align-content-center" aria-label="offer-slider">  
                            <img class="mw-100 mh-100 bg-light" src="<?php echo SITEURL."/".$offerpath[0]['imgs_location']."/".$offcnts[$i]['img']; ?>" alt="<?=$offcnts[$i]['offer_name'];?>">
                            <!--<?php if( $offcnts[$i]['offer_name'] != ""){ ?>
                            <h4><?php if ( strlen( $offcnts[$i]['offer_name']) > 50){
                                $arr = str_split( $offcnts[$i]['offer_name']);
                                $str = "";
                                for ( $j = 0; $j < 55; $j++ ) {$str = $str . "" . $arr[$j];}
                                echo $str . "...";
                            } else{ echo $offcnts[$i]['offer_name']; }
                            ?></h4><?php } ?>-->
                            </a>  
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<? if($trendingcount){
$productids = $prod->getProductsByGroup("p.trending_now=1"); ?>
<div class="home-prod-carousel pb-2 pb-md-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="hm-sec-head mb-2 mb-md-3"><h3 class="mb-0 pb-2 hm-sec-font-size hm-sec-text-color cc-fw-5 text-center">Trending Now</h3></div>
                <div class="owl-carousel owl-theme owl-newarrival row owl-row-zero-margin owl-vertically">
                <? for($i=0;$i<count($productids);$i++){ ?>
                <? include("product-view.php"); ?>
                <? } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<? } if($newarrivalcount){
$productids = $prod->getProductsByGroup("p.new_arrival=1"); ?>
<div class="home-prod-carousel pb-2 pb-md-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="hm-sec-head mb-2 mb-md-3"><h3 class="mb-0 pb-2 hm-sec-font-size hm-sec-text-color cc-fw-5 text-center">New Arrival</h3></div>
                <div class="owl-carousel owl-theme owl-newarrival row owl-row-zero-margin owl-vertically"><? for($i=0;$i<count($productids);$i++){ include("product-view.php"); } ?></div>
            </div>
        </div>
    </div>
</div>
<? } ?>
<?php $brands = selectQuery( BRAND, "target_link,brand_name,img", "isActive='1' order by priority " );
if(count( $brands ) != 0){ 
$brandpath = getimgconfigpaths('brand'); ?>
<div class="brand_slide pb-2 pb-md-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="hm-sec-head mb-2 mb-md-3"><h3 class="mb-0 pb-2 hm-sec-font-size hm-sec-text-color cc-fw-5 text-center">Show Some Brand Love</h3></div>
                <div class="owl-carousel owl-theme owl-brand row owl-row-zero-margin owl-vertically">
                    <?php for($i = 0; $i < count($brands); $i++){ ?>
                    <div class="item col-6 col-sm-4 col-lg-12 pr-0 px-lg-0 mb-3 mb-lg-0">
                        <div class="product-thumb photo-grid"><a hreflang="en" target="_blank" href = <?php if($brands[$i]['target_link'] != "" ){ echo $brands[$i]['target_link']; } else{ echo "#"; } ?>><div class="brand-thumb d-flex flex-wrap align-content-center"><img src="<?php echo SITEURL."/".$brandpath[0]['imgs_location']."/".$brands[$i]['img'];?>" alt="<? if(trim($brands[$i]['brand_name']) == ""){ echo "Brand"; } else{ echo $brands[$i]['brand_name']; } ?>" class="img-fluid" height="200"/></div></a> 
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php }?>
<?php $gettestimonials = selectQuery( TESTIMONIALS, "product_name,testimonials,client_name,img_name", "isActive='1'order by priority  " );
if(count($gettestimonials) != 0){ 
$testimonial_path = getimgconfigpaths('testimonials'); ?>
<div class="testinomial">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="hm-sec-head mb-2 mb-md-3"><h3 class="mb-0 pb-2 hm-sec-font-size hm-sec-text-color cc-fw-5 text-center">What Our Happy Customers Say</h3></div>
                <div class="owl-carousel owl-theme owl-testimonial">
                    <?php for($i = 0; $i < count( $gettestimonials ); $i++ ){ ?>
                    <div class="pb-3 item<?php if ( $i == 1 ) {echo "active";}?>">
                        <div class="card p-4 textm-item">
                            <div class="test-info mb-2"><?php if(strlen($gettestimonials[$i]['testimonials']) > 180){ $arr = str_split( $gettestimonials[$i]['testimonials'] ); $str = ""; for($j = 0; $j < 145; $j++){ $str = $str . "" . $arr[$j]; } echo $str . "..."; } else{echo $gettestimonials[$i]['testimonials'];} ?></div>
                            <div class="test-user-thumb rounded-circle mb-2 mx-auto"><img class="img-fluid" src="<?php echo SITEURL."/".$testimonial_path[0]['imgs_location']."/".$gettestimonials[$i]['img_name']; ?>" alt="Testimonial-thumb" width="80" height="80"></div>
                            <?php if($gettestimonials[$i]['client_name']!= "" ){ ?>
                            <div class="h6 mb-1 text-primary" title="<?php echo $gettestimonials[$i]['client_name']; ?>"><?php if(strlen($gettestimonials[$i]['client_name']) > 18){ $arr = str_split( $gettestimonials[$i]['client_name'] ); $str = ""; for($j = 0; $j < 20; $j++){$str = $str . "" . $arr[$j];} echo $str . "..."; } else{echo $gettestimonials[$i]['client_name'];} ?></div>
                            <?php } ?>
                            <p class="small mb-0 d-none">
                                <?php if(strlen($gettestimonials[$i]['product_name']) > 33){
                                $arr = str_split($gettestimonials[$i]['product_name']);
                                $str = "";
                                for($j = 0; $j < 35; $j++){ $str = $str . "" . $arr[$j]; }
                                echo $str . "...";
                                } else{ echo $gettestimonials[$i]['product_name']; } ?>
                            </p>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>
</div>
<?php include "footer.php"; ?>
<script>siteurl = "<?php echo SITEURL; ?>";</script>
<script src="<?=SITEURL;?>/js/thumb-slider/owl.carousel.min.js"></script>
<script src="<?=SITEURL;?>/js/product.js"></script>
<script>
var owl = $('.owl-banner');
owl.owlCarousel({items:1, nav: false, dots:true, loop: true, autoplay:true, autoplayTimeout:4000, autoplayHoverPause:true });
var owl = $('.owl-testimonial');
owl.owlCarousel({loop: false,nav: true,margin: 16,dots:false,responsive: { 0: {items: 1},500: {items: 2},800: {items: 3},1000: {items: 4}}});    
$(document).ready(function(){
    if($(window).width() > 992 ){ startCarousel(); } else{ $('.owl-vertically').removeClass('owl-carousel'); $(".pro-thumb-col").each(function(){ $(this).wrap("<div class='col-6 col-md-4 p-0'></div>"); }); }
});
$(window).resize(function(){ if($(window).width() > 992){ startCarousel(); } else{ stopCarousel(); } });
function startCarousel(){
    var owl = $('.owl-offer');
    owl.owlCarousel({loop: false,nav: false,margin: 16,dots:true,autoplay:true, autoplayTimeout:4000, autoplayHoverPause:true,responsive: { 0: {items: 1},600: {items: 2},960: {items: 2}}});
    var owl = $('.owl-newarrival');
    owl.owlCarousel({loop: false,nav: true,margin: 16,dots:false,autoplay:true, autoplayTimeout:4000, autoplayHoverPause:true,responsive: { 0: {items: 2},600: {items: 3},960: {items: 4}}});    
    var owl = $('.owl-brand');
    owl.owlCarousel({loop: false,nav: true,margin: 16,dots:false,autoplay:true, autoplayTimeout:4000, autoplayHoverPause:true,responsive: { 0: {items: 2},600: {items: 3},960: {items: 5}}});
    var owl = $('.owl-shop-category');
    owl.owlCarousel({loop: false,nav: true,margin: 16,dots:false,autoplay:true, autoplayTimeout:4000, autoplayHoverPause:true,responsive: { 0: {items: 2},600: {items: 3},960: {items: 6}}});
}
function stopCarousel(){
    var owl = $('.owl-vertically'); owl.trigger('destroy.owl.carousel'); owl.removeClass('owl-carousel');
}
    if($('.home-banner img').length == 1){
    $('.hm-slide-handler').hide();
}
</script>
</body>
</html> 