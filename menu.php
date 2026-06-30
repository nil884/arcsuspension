<?php $body_script = selectQuery(FOOTERSCRIPT,"script","add_here='body' AND isActive= '1' order by priority"); 
for($i=0;$i<count($body_script);$i++){
   echo $body_script[$i]['script'];
} ?>
<div class="progress"><div class="prog-overlap bg-primame-highlight"></div><div class="indeterminate bg-primame-highlight"></div></div>
<?php $loguser="";
if( isset($_SESSION['reguser'])){
    $loguser = $_SESSION['reguser'];
    $getbuyer_details=selectQuery(BUYER,"*","u_id=".$loguser);
    $logUsername = $getbuyer_details[0]['u_fname'];
    $logUserMail = $getbuyer_details[0]['u_email'];
}
if( isset($_SESSION['wishitems'])){ $item_array_id= array_column($_SESSION['wishitems'] ,"prod_id" );} else{ $_SESSION['wishitems']= array();  }
if(isset($_SESSION['shopping_cart'])){ $cart_item_array_id= array_column($_SESSION['shopping_cart'] ,"prod_id" );} else { $_SESSION['shopping_cart']= array(); }
if($_SERVER['REQUEST_URI']!="/checkout"){ unset($_SESSION['userPincode']); unset($_SESSION['shippingAdrId']); }
$Notification1 = selectQuery(NOTIFICATION,"notificationico,notificationlink,notification"," isActive ='1' and show_on_all = '1' and show_on_homepage ='0' and myaccount ='0' ");
if(count($Notification1)) { ?>
<div class="notification-toggle pr-4 px-md-5 py-2"><div class="container"><div class="row"><div class="col-md-12 marquee">
    <div class="marq-notif"><img src="<?=SITEURL; ?>/img/projectimage/<?=$Notification1[0]['notificationico']; ?>" alt="<?=$Notification1[0]['notificationico']; ?>" width="20" height="20" class="mt-1 mt-md-0 mr-2"/><a href="<?=($Notification1[0]['notificationlink']!=""?$Notification1[0]['notificationlink']:SITEURL); ?>" target="_blank" class="d-inline-block" hreflang="en"><?=$Notification1[0]['notification']; ?></a></div></div></div></div><span class="close-notif position-absolute d-inline-block"><i class="fa fa-times"></i></span>
</div>
<?php } ?>
<div class="head-contact position-relative">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="list-unstyled mb-0 float-right">
                    <?php if(CONTACTUSNO != ""){ $contarr=explode(",",CONTACTUSNO); ?><li class="hd-cont-link"><? for($i=0;$i<count($contarr);$i++){?><a href="tel:<?=$contarr[$i]; ?>" target="_blank"><i class="fa fa-phone mr-1" aria-hidden="true"></i> <?=$contarr[$i]; ?></a><?} ?></li><?php } ?>
                    <?php if(EMAIL_FOOTER != ""){ ?> <li class="d-none d-sm-inline-block"><a href="mailto:<?=EMAIL_FOOTER; ?>" target="_blank"><i class="fa fa-envelope mr-1" aria-hidden="true"></i><?=EMAIL_FOOTER; ?></a></li><?php } ?>
                    <!--<li><a href="<?=VENDORURL;?>" target="_blank" hreflang="en"><i class="fa fa-user mr-1" aria-hidden="true"></i>Vendor Login</a></li> -->
                    <li class="d-none d-sm-inline-block"><a href="<?=SITEURL;?>/contact" hreflang="en"><i class="fa fa-map-marker mr-1" aria-hidden="true"></i> Contact</a></li>
                </ul>                    
            </div>
        </div>
    </div>
</div>
<header class="sticky-top">
    <div class="inner-header">
        <div class="container">
            <div class="row">
                <div class="col-5 col-sm-4 col-md-3 col-lg-2 order-lg-1 d-flex align-items-center">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar" aria-label="navbar-toggle"><svg version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 384.97 384.97" xml:space="preserve" width="20" height="20"><g><g id="Menu"><path d="M12.03,84.212h360.909c6.641,0,12.03-5.39,12.03-12.03c0-6.641-5.39-12.03-12.03-12.03H12.03C5.39,60.152,0,65.541,0,72.182C0,78.823,5.39,84.212,12.03,84.212z"></path><path d="M372.939,180.455H12.03c-6.641,0-12.03,5.39-12.03,12.03s5.39,12.03,12.03,12.03h360.909c6.641,0,12.03-5.39,12.03-12.03S379.58,180.455,372.939,180.455z"></path><path d="M372.939,300.758H12.03c-6.641,0-12.03,5.39-12.03,12.03c0,6.641,5.39,12.03,12.03,12.03h360.909c6.641,0,12.03-5.39,12.03-12.03C384.97,306.147,379.58,300.758,372.939,300.758z"></path></g><g></g><g></g><g></g><g></g><g></g><g></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg></button>
                    <div class="logo-flex"><h1 class="h6 mb-0" title="<?=SITE_TITLE ?>"><a href="<?=SITEURL ?>" hreflang="en"><img src="<?=SITEURL; ?>/img/projectimage/<?=(LOGO != ""?LOGO:"default_logo.png"); ?>" alt="<?=SITE_TITLE ?>" class="img-fluid logo"/></a></h1></div>
                </div>            
                <div class="col-7 col-md-9 col-lg-4 order-lg-3 align-self-center user-cont log-member pl-0">
                    <ul class="list-unstyled mb-0"> 
                        <li><?php if($loguser==""){ ?><a href="<?=SITEURL; ?>/login" hreflang="en" aria-label="User-login"><svg enable-background="new 0 0 551.13 551.13" height="20" viewBox="0 0 551.13 551.13" width="20" xmlns="http://www.w3.org/2000/svg"><path d="m275.565 275.565c-75.972 0-137.783-61.81-137.783-137.783s61.811-137.782 137.783-137.782 137.783 61.81 137.783 137.783-61.811 137.782-137.783 137.782zm0-241.119c-56.983 0-103.337 46.353-103.337 103.337s46.353 103.337 103.337 103.337 103.337-46.354 103.337-103.337-46.354-103.337-103.337-103.337z"></path><path d="m499.461 551.13h-447.793c-9.52 0-17.223-7.703-17.223-17.223v-118.558c0-17.795 9.099-34.513 23.732-43.663 129.339-80.682 305.554-80.665 434.759-.017 14.649 9.166 23.749 25.885 23.749 43.679v118.558c0 9.521-7.703 17.224-17.224 17.224zm-430.57-34.445h413.348v-101.336c0-6.004-2.893-11.555-7.552-14.464-118.256-73.819-279.905-73.87-398.26.017-4.642 2.893-7.535 8.443-7.535 14.448z"></path></svg> <span class="d-none d-sm-inline-block">Login</span></a><?php } ?></li>
                        <?php if($loguser!=""){ ?>
                        <li class="dropdown">  
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" hreflang="en"><svg enable-background="new 0 0 551.13 551.13" height="20" viewBox="0 0 551.13 551.13" width="20" xmlns="http://www.w3.org/2000/svg"><path d="m275.565 275.565c-75.972 0-137.783-61.81-137.783-137.783s61.811-137.782 137.783-137.782 137.783 61.81 137.783 137.783-61.811 137.782-137.783 137.782zm0-241.119c-56.983 0-103.337 46.353-103.337 103.337s46.353 103.337 103.337 103.337 103.337-46.354 103.337-103.337-46.354-103.337-103.337-103.337z"></path><path d="m499.461 551.13h-447.793c-9.52 0-17.223-7.703-17.223-17.223v-118.558c0-17.795 9.099-34.513 23.732-43.663 129.339-80.682 305.554-80.665 434.759-.017 14.649 9.166 23.749 25.885 23.749 43.679v118.558c0 9.521-7.703 17.224-17.224 17.224zm-430.57-34.445h413.348v-101.336c0-6.004-2.893-11.555-7.552-14.464-118.256-73.819-279.905-73.87-398.26.017-4.642 2.893-7.535 8.443-7.535 14.448z"></path></svg><span class="d-none d-sm-inline-block loger-name ml-1"><? if($loguser!=""){ echo (trim($logUsername)!=""?$logUsername:$logUserMail); } ?></span><span class="mem-cart-count-badge head-sec-back d-inline-block text-center rounded-circle d-inline-block d-sm-none"><?=($logUsername!=""?substr($logUsername,0,1):""); ?></span></a>
                            <ul class="dropdown-menu border-0 cc-shadow-2">
                                <a class="dropdown-item" href="<?=SITEURL ?>/account/" hreflang="en">My Account</a>
                                <a class="dropdown-item" href="<?php echo SITEURL; ?>/account/bankdetails" hreflang="en">Bank Details</a>
                                <a class="dropdown-item" href="<?php echo SITEURL; ?>/account/taxation" hreflang="en">TAX Details</a>
                                <a class="dropdown-item" href="<?php echo SITEURL; ?>/account/myreviews" hreflang="en">Product Review</a>
                                <a class="dropdown-item" href="<?php echo SITEURL; ?>/account/myorders" hreflang="en">Recent Order</a>
                                <a class="dropdown-item" href="<?php echo SITEURL; ?>/account/myaddresses" hreflang="en">Order Address</a>
                                <div class="dropdown-divider my-1"></div>
                                <a class="dropdown-item" href="<?=SITEURL ?>/logout" hreflang="en">Logout</a>
                            </ul>
                        </li>
                        <?php } ?>
                        <li><a href="<?php echo SITEURL ?>/wishview" hreflang="en"><svg version="1.1" id="Capa_2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve" width="20" height="20"><g><g><path d="M474.644,74.27C449.391,45.616,414.358,29.836,376,29.836c-53.948,0-88.103,32.22-107.255,59.25
                        c-4.969,7.014-9.196,14.047-12.745,20.665c-3.549-6.618-7.775-13.651-12.745-20.665c-19.152-27.03-53.307-59.25-107.255-59.25c-38.358,0-73.391,15.781-98.645,44.435C13.267,101.605,0,138.213,0,177.351c0,42.603,16.633,82.228,52.345,124.7c31.917,37.96,77.834,77.088,131.005,122.397c19.813,16.884,40.302,34.344,62.115,53.429l0.655,0.574
                        c2.828,2.476,6.354,3.713,9.88,3.713s7.052-1.238,9.88-3.713l0.655-0.574c21.813-19.085,42.302-36.544,62.118-53.431
                        c53.168-45.306,99.085-84.434,131.002-122.395C495.367,259.578,512,219.954,512,177.351
                        C512,138.213,498.733,101.605,474.644,74.27z M309.193,401.614c-17.08,14.554-34.658,29.533-53.193,45.646c-18.534-16.111-36.113-31.091-53.196-45.648C98.745,312.939,30,254.358,30,177.351c0-31.83,10.605-61.394,29.862-83.245C79.34,72.007,106.379,59.836,136,59.836c41.129,0,67.716,25.338,82.776,46.594c13.509,19.064,20.558,38.282,22.962,45.659
                        c2.011,6.175,7.768,10.354,14.262,10.354c6.494,0,12.251-4.179,14.262-10.354c2.404-7.377,9.453-26.595,22.962-45.66c15.06-21.255,41.647-46.593,82.776-46.593c29.621,0,56.66,12.171,76.137,34.27C471.395,115.957,482,145.521,482,177.351
                        C482,254.358,413.255,312.939,309.193,401.614z"></path></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg> <span class="mem-cart-count-badge head-sec-back d-inline-block text-center rounded-circle" id="wishlist-count"><?php echo count($_SESSION['wishitems']);?></span></a></li>
                        <li><a class="rounded-circle" href="<?php echo SITEURL ?>/cartview" hreflang="en"><svg height="20" viewBox="0 -31 512.00026 512" width="20" xmlns="http://www.w3.org/2000/svg"><path d="m164.960938 300.003906h.023437c.019531 0 .039063-.003906.058594-.003906h271.957031c6.695312 0 12.582031-4.441406 14.421875-10.878906l60-210c1.292969-4.527344.386719-9.394532-2.445313-13.152344-2.835937-3.757812-7.269531-5.96875-11.976562-5.96875h-366.632812l-10.722657-48.253906c-1.527343-6.863282-7.613281-11.746094-14.644531-11.746094h-90c-8.285156 0-15 6.714844-15 15s6.714844 15 15 15h77.96875c1.898438 8.550781 51.3125 230.917969 54.15625 243.710938-15.941406 6.929687-27.125 22.824218-27.125 41.289062 0 24.8125 20.1875 45 45 45h272c8.285156 0 15-6.714844 15-15s-6.714844-15-15-15h-272c-8.269531 0-15-6.730469-15-15 0-8.257812 6.707031-14.976562 14.960938-14.996094zm312.152343-210.003906-51.429687 180h-248.652344l-40-180zm0 0"></path><path d="m150 405c0 24.8125 20.1875 45 45 45s45-20.1875 45-45-20.1875-45-45-45-45 20.1875-45 45zm45-15c8.269531 0 15 6.730469 15 15s-6.730469 15-15 15-15-6.730469-15-15 6.730469-15 15-15zm0 0"></path><path d="m362 405c0 24.8125 20.1875 45 45 45s45-20.1875 45-45-20.1875-45-45-45-45 20.1875-45 45zm45-15c8.269531 0 15 6.730469 15 15s-6.730469 15-15 15-15-6.730469-15-15 6.730469-15 15-15zm0 0"></path></svg> <span class="mem-cart-count-badge head-sec-back d-inline-block text-center rounded-circle" id="cart-count"><?php echo count($_SESSION['shopping_cart']); ?></span></a></li>
                    </ul>
                </div>
                <div class="col-12 col-md-12 col-lg-6 order-lg-2 align-self-center">
                    <div class="search-product position-relative">
                        <form  action="<?=SITEURL; ?>/search"  id="searchform"  method="get" >
                            <div class="input-group">
                                <input type="text" class="form-control border-right-0" id="search_box" name="search" placeholder="Search Products" autocomplete="off" aria-label="Search">
                                <div class="input-group-append"><span class="input-group-text border-0 px-3 search1 head-sec-back"><i class="fa fa-search"></i></span></div>
                            </div>
                        </form> 
                        <div class="ser-result rounded-sm shadow border position-absolute bg-white w-100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<nav class="navbar navbar-expand-sm mega-menu cat-nav p-0 cc-shadow-1">
    <div class="back-category p-3 d-block d-lg-none shadow cc-primary-back col-md-12 cc-cursor-pointer text-white cc-fw-6"><i class="fa fa-arrow-left mr-2" aria-hidden="true"></i> ALL CATEGORIES</div>
    <div class="container position-relative">
        <ul class="navbar-nav">
            <li class="nav-item d-none d-md-block"><a class="nav-link home-link" href="<?=SITEURL;?>" hreflang="en" aria-label="Home"><i class="fa fa-home"></i></a></li>
            <?php $parent = selectQuery(PRODCAT,"cat_name,id,type","parent_id=0 and isActive='1' order by priority");
            for($p=0;$p<count($parent);$p++){
            $parentname = $parent[$p]['cat_name']; $parenttype=$parent[$p]['type']; $parentid=$parent[$p]['id']; ?>
            <li class="nav-item">
                <a class="dropdown-toggle" hreflang="en" href='<?=SITEURL;?>/<?=getUrl($parenttype,$parentid);?>'><?=$parentname; ?></a><span class="caret"></span>
                <ul class="mega-drop-menu p-0 p-lg-3 shadow list-unstyled rounded-bottom">
                    <?php $prod_cat=selectQuery(PRODCAT,"cat_name,id,type","parent_id=".$parentid." and isActive='1' order by priority");
                    $menu1="";$menu2="";$menu3="";$menu4="";$menu5="";
                    for($i=0;$i<count($prod_cat);$i++){
                        $masterid = $prod_cat[$i]['id'];$mastername = $prod_cat[$i]['cat_name'];$mastertype = $prod_cat[$i]['type'];       
                        $str='<div class="catblock"><div class="menu-cat-head mb-0 mb-lg-1 position-relative"><a class="cc-primary-color" href="'.SITEURL.'/'.getUrl($mastertype,$masterid).'" hreflang="en">'.$mastername.'</a><span class="caret"></span></div>';
                        $que1=selectQuery(PRODCAT,"cat_name,id,type","parent_id=".$masterid." and isActive='1'  order by priority");
                        if(count($que1)){
                            $str.= '<ul class="list-unstyled text-muted mb-2">';
                            for($j=0;$j<count($que1);$j++){
                                $subid = $que1[$j]['id'];$subname = $que1[$j]['cat_name'];$subtype = $que1[$j]['type'];
                                $str.= '<li><a href="'.SITEURL.'/'.getUrl($subtype,$subid).'" class="point1" hreflang="en">'.$subname.'</a></li>';
                            }
                            $str.='</ul>';
                        }
                        $str.='</div>';
                        $strarr=array(strlen($menu1),strlen($menu2),strlen($menu3),strlen($menu4),strlen($menu5));
                        $minlength=(min($strarr));
                        if($minlength==strlen($menu1)){ $menu1.= $str; }
                        else if($minlength==strlen($menu2)){ $menu2.= $str;}
                        else if($minlength==strlen($menu3)){ $menu3.= $str;}
                        else if($minlength==strlen($menu4)){ $menu4.= $str;}
                        else if($minlength==strlen($menu5)){$menu5.= $str;}
                    } ?>
                    <li class="menu-cat-col <?=($menu1==""?'d-none':''); ?>"><?=$menu1; ?></li>
                    <li class="menu-cat-col <?=($menu2==""?'d-none':''); ?>"><?=$menu2; ?></li>
                    <li class="menu-cat-col <?=($menu3==""?'d-none':''); ?>"><?=$menu3; ?></li>
                    <li class="menu-cat-col <?=($menu4==""?'d-none':''); ?>"><?=$menu4; ?></li>
                    <li class="menu-cat-col <?=($menu5==""?'d-none':''); ?>"><?=$menu5; ?></li>
                </ul>
            </li>
            <? } $offcnts = selectQuery( OFFER, "offer_name,img,offer_link", "isActive='1'  " ) ;
            if(count($offcnts)){ ?>
            <li class="nav-item"><a href="<?php echo SITEURL ?>/offer" hreflang="en">Offers</a></li>
            <?php } ?>
        </ul>
    </div>
</nav> 