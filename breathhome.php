
<?php
    $hitfrom = "";
    $hitfrom = "";
    if ( !empty( $_SERVER["HTTP_CLIENT_IP"] ) ) {
        //check for ip from share internet
        $ip = $_SERVER["HTTP_CLIENT_IP"];
    } elseif ( !empty( $_SERVER["HTTP_X_FORWARDED_FOR"] ) ) {
        // Check for the Proxy User
        $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
    } else {
        $ip = $_SERVER["REMOTE_ADDR"];
    }
    /* $agent = $_SERVER['HTTP_USER_AGENT'];  */
    if (!isset( $_SERVER['HTTP_USER_AGENT'] ) ) {$agent = "none";} else { $agent = $_SERVER['HTTP_USER_AGENT'];}
    $browser = 'NA';
    if (( preg_match( '/MSIE/i', $agent ) || preg_match( '/Trident/i', $agent ) || ( preg_match( '/Trident/i', $agent ) && stristr( $agent, 'Windows Phone' ))) && !preg_match( '/Opera/i', $agent )) {
        $browser = 'Internet Explorer';
        $ub = "MSIE";
    } elseif ( preg_match( '/Windows NT 10/i', $agent ) && preg_match( '/Edge/i', $agent ) ) {
        $browser = 'Microsoft Edge';
        $ub = "Edge";
    } elseif ( preg_match( '/Firefox/i', $agent ) && !preg_match( '/Iceweasel/i', $agent ) ) {
        $browser = 'Mozilla Firefox';
        $ub = "Firefox";
    } elseif ( preg_match( '/Chrome/i', $agent ) ) {
        $browser = 'Google Chrome';
        $ub = "Chrome";
    } elseif ( preg_match( '/Safari/i', $agent ) ) {
        $browser = 'Apple Safari';
        $ub = "Safari";
    } elseif ( preg_match( '/Opera/i', $agent ) ) {
        $browser = 'Opera';
        $ub = "Opera";
    } elseif ( preg_match( '/Netscape/i', $agent ) ) {
        $browser = 'Netscape';
        $ub = "Netscape";
    } elseif ( preg_match( '/Iceweasel/i', $agent ) && preg_match( '/Firefox/i', $agent ) ) {
        $browser = 'Iceweasel';
        $ub = "Iceweasel";
    }
    $device = '';
    if ( stristr( $agent, 'ipad' )){
        $device = "ipad";
    } else if (  ( stristr( $agent, 'iphone' ) || strstr( $agent, 'iphone' ) ) && stristr( $agent, 'Windows Phone' ) === false ) {
        $device = "iphone";
    } else if ( stristr( $agent, 'Windows Phone' )) {
        $device = "Windows Phone";
    } else if ( stristr( $agent, 'blackberry' )) {
        $device = "blackberry";
    } else if ( stristr( $agent, 'android' )) {
        $device = "android";
    } else if ( stristr( $agent, 'Windows NT 10.0' )) {
        $device = "Windows 10";
    } else if ( stristr( $agent, 'Windows NT 6.1' )) {
        $device = "Windows 7";
    } else if ( preg_match( '/linux/i', $agent )) {
        $device = "Linux";
    }
    $hitfrom      = $_SERVER['HTTP_REFERER'];
    $cookie_name  = 'visit';
    $cookie_value = '1111';
    setcookie( $cookie_name, $cookie_value, time() + 600 );
    // include "includes/configuration.php";
    if ( !isset( $_COOKIE[$cookie_name] ) ) {
        /* print 'Cookie with name "' . $cookie_name . '" does not exist...';*/
        $datalog = array(
            'ip' => $ip,
            'device' => $device,
            'browser' => $browser,
            'details' => $agent,
            'time' => date( 'd/m/Y H:i:s' ),
        );
        $s = insertQuery( VLIST, $datalog );
    } else {
    }
    /* unset($_SESSION["orderid"]);*/
    $key = $path_info['call_parts'][0];
    if ( $key != "" ) {
        if ( $key != "home" ) {
            $chkshort = selectQuery( MSTPROD, "mp_id", "url='" . $key . "'" );
            if ( count( $chkshort ) ) {
                $masterprodtable = selectQuery( MSTPROD, "prod_table,prod_mod_id", "mp_id=" . $chkshort[0]['mp_id'] );
                $prodsubtable    = selectQuery( $masterprodtable[0]['prod_table'], "product_name", "prod_id=" . $masterprodtable[0]['prod_mod_id'] );

                $prodname        = selectQuery( PROD, "category,subcategory,prod_name", "prod_name='" . $prodsubtable[0]['product_name'] . "' and isDel='0'");

                $category        = selectQuery( PRODCAT, "category_name", "pc_id=" . $prodname[0]['category'] );
                $subcategory     = selectQuery( PRODSUBCAT, "subcat_name", "psc_id=" . $prodname[0]['subcategory'] );
                $redirect = SITEURL . "/products/" . cleantext( $category[0]['category_name'] ) . "-" . encodenumber( $prodname[0]['category'] ) . "/" . cleantext( $subcategory[0]['subcat_name'] ) . "-" . encodenumber( $prodname[0]['subcategory'] ) . "/" . cleantext( $prodname[0]['prod_name'] ) . "-" . encodenumber( $chkshort[0]['mp_id'] );
                if ( $hitfrom != "" ) {
                    $thirdhit = array(
                        'hit_from' => $hitfrom,
                        'hit_url' => $key,
                        'product_master_id' => $chkshort[0]['mp_id'],
                        'product_name' => $prodsubtable[0]['product_name'],
                        'hit_date' => date( 'd/m/Y H:i:s' ),
                    );
                    $hit = insertQuery( THIRDHIT, $thirdhit );
                } ?>
                <script>
                    var loc = "<?=$redirect;?>";
                    window.location = loc;
                </script>
                <?php
            }
        }
    } else {}
    ?>
<!doctype html>
<html  lang="en">
<head>
    <title><?=SITE_TITLE;?></title>
    <meta charset='UTF-8'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="<?=METAKEYWORDS;?>"  >
    <meta name="description" content ="<?=METADESCRIPTION;?>">
    <!-- Google / Search Engine Tags -->
    <meta itemprop="name" content="<?=SITE_TITLE;?>">
    <meta itemprop="description" content="<?=METADESCRIPTION;?>">
    <meta itemprop="image" content="<?=SITEURL;?>/img/projectimage/logo.png">
    <!-- Facebook Meta Tags -->
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?=SITE_TITLE;?>"/>
    <meta property="og:description" content="<?=METADESCRIPTION;?>"/>
    <meta property="og:img" content="<?=SITEURL;?>/img/projectimage/logo.png">
    <meta property="og:url" content="<?=SITEURL;?>/<?=$_SERVER['REQUEST_URI']; ?>"/>
    <meta property="og:site_name" content="<?php echo SITENAME; ?>" />
    <!-- Twitter Meta Data -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@<?=preg_replace('/^www\./','',$_SERVER['HTTP_HOST']);  ?>">
    <meta name="twitter:title" content="<?=SITE_TITLE;?>">
    <meta name="twitter:description" content="<?=METADESCRIPTION;?>">
    <meta name="twitter:image" content="<?=SITEURL;?>/img/projectimage/logo.png ">
    <meta name="twitter:url" content="<?=SITEURL;?>/<?=$_SERVER['REQUEST_URI']; ?>">
    <link rel="canonical" href="<?=SITEURL;?>/<?=$_SERVER['REQUEST_URI']; ?>" />
    <link rel="dns-prefetch" href="<?=SITEURL;?>" />
    <?php include 'commoncss.php';?>
    <?php if ( $_SESSION['cmpcnt'] ) { ?>
    <style>.showcmpcnt{display: block;}</style>
    <?php } else {?>
    <style>.showcmpcnt{ display: none;}.showcmpcnt a { color:white;}</style>
    <?php } ?>
</head>
<body class="home-head">
<?php $Notification = selectQuery( Notification, "*", "isDel='0' and  isActive ='1' and show_on_homepage= '1' and show_on_all = '0' " );
if (count($Notification)) {?>
<div class="notification">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="text-center">
                    <div class="notification-icon">
                        <div class="alertdescription">
                        <img src="<?=SITEURL;?>/img/projectimage/<?=$Notification[0]['notificationico'];?>" alt="<?=$Notification[0]['notificationico'];?>" class="alertthumb" width="32" height="32"/>
                        <a href="<?=$Notification[0]['notificationlink'];?>" class="text-white pull-letf">  <?=$Notification[0]['notification'];?> </a>
                    </div>
                    </div>
                </div>
                <span class="fa fa-times" id="close_notification"> </span>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<?php include 'menu.php';?>
<div class="main-wrap">
<?php include 'slider.php';?>


<!--<?php $brands = selectQuery( BRAND, "*", "isdel='0' and isActive='1' order by br_id DESC" );
if ( count( $brands ) != 0 ) { ?>
<div class="brand_slide cc-prod-list-sec">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="owl-carousel owl-theme featured-brand" id="owl-carousel1">
                            <?php for ( $i = 0; $i < count( $brands ); $i++ ) { ?>
                            <div class="item">
                                <div class="product-thumb photo-grid shadown">
                                <?php  if($brands[$i]['target_link'] != "" ) {  ?>
                                    <a target="_blank"  href = <?php echo  $brands[$i]['target_link'] ?> >  <?php  } ?>
                                        <div class="brand-thumb">
                                            <img src="img/brands/<?=$brands[$i]['img'];?>" alt="<? if(trim($brands[$i]['brand_name']) == "") {  echo "Brand"; } else { echo $brands[$i]['brand_name']; } ?>" class="img-responsive" width="1302" height="30"/>
                                        </div>
                                        <?php  if($brands[$i]['target_link'] != "" ) {  ?> </a>  <?php  } ?>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php }?>-->


<!--<?php $prod_cat=selectQuery(PRODCAT,"pc_id,category_name,img,parent_cat","isDel='0' and isActive='1'");
if(count($prod_cat) != 0){ ?>
<div class="product-category cc-prod-list-sec dot-pattern cate-wise-prod">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="cc-margin-0 text-center"><span>Shop By Category</span></h2>
                <p class="lead text-muted cc-margin-bottom-25 text-center">Shop featured products form royal fashion of rajput's</p>
                <div class="owl-carousel owl-theme owl-product-category">


                    <?php for($i=0;$i<count($prod_cat);$i++){
                        $parent=selectQuery(PARENT,"*"," isDel='0' and isActive='1'  and pc_id = ".$prod_cat[$i]['parent_cat']);?>
                    <div class="item card cc-cursor-pointer">
                    <a href="<?php echo SITEURL ?>/maincategoryproduct/<?php echo cleantext($prod_cat[$i]['category_name']) ?>-<?php echo encodenumber($prod_cat[$i]['pc_id']) ?>">     <img src="<?php  if($prod_cat[$i]['img'] != ""){ echo "img/mastercategory/".$prod_cat[$i]['img']; } else { echo 'img/projectimage/category-not-availabel.png';  } ?>"  alt= "<?php echo $prod_cat[$i]['category_name'] ?>" style="height: 212px;">  </a>
                        <div class="card-body">
                            <div class="title_count_block cc-positio-rel">
                                <p class="cc-primary-color cc-margin-bottom-0"><?php  echo $parent[0]['parentcat_name'] ?></p>
                                <h4 class="cc-margin-0"> <?php echo '<a href="'.SITEURL.'/maincategoryproduct/'.cleantext($prod_cat[$i]['category_name'])."-".encodenumber($prod_cat[$i]['pc_id']).'">'.$prod_cat[$i]['category_name'].'</a> ' ?></h4>
                            </div>
                        </div>
                    </div>

                       <?php } ?>
                       </div>
                </div>
            </div>
        </div>
    </div>
<?php   } ?> -->

<?php $getprodtable=selectQuery(MSTPROD,"mp_id,prod_table,prod_mod_id,extra_attrib","show_on_homepage='1' and isDel='0' and active='1' order by mp_id DESC");
if(count($getprodtable)!=0){ ?>
<div class="shop-cate cc-prod-list-sec">
    <div class="container">
        <div class="section-title text-center">
            <h2 class="cc-margin-0 heading">Our Products</h2>
            <p class="text-center section-subhead text-muted">Natural & Organic Makeup & Skin Care Brands Your Face Will Love You For</p>
        </div>

        <div class="card">
                <div class="owl-carousel owl-theme ouproducts">
                <?php if(count($getprodtable)!=0){
                for($i=0;$i<count($getprodtable);$i++){
                $img=selectQuery(MOD_IMG,"img_name","mod_id=".$getprodtable[$i]['mp_id']." and isDel='0' ORDER BY img_id ASC  LIMIT 2");
                $prod=selectQuery($getprodtable[$i]['prod_table'],"product_name","prod_id=".$getprodtable[$i]['prod_mod_id']);
                $prod1=selectQuery(PROD,"prod_id,category,subcategory","prod_name='". $prod[0]['product_name']."' and isDel='0'");
                $cat=selectQuery(PRODCAT,"category_name","pc_id='". $prod1[0]['category']."'");
                $subcat=selectQuery(PRODSUBCAT,"subcat_name","psc_id='". $prod1[0]['subcategory']."'");
                $masterid = $getprodtable[$i]['mp_id'];
                if(DEALERPRIORITY=="MANUAL"){
                    $querypart="and priority='1' and isApproved='1' and seller_plan_expired='0'";
                }
                else{
                    $querypart="and quantity-sold<>0 and isApproved='1' and seller_plan_expired='0' order by final_price ASC";
                }
                $inv=selectQuery(INV,"quantity,sold,sp,cp,final_price,inv_no","prod_id=".$prod1[0]['prod_id']." and isDel='0' ".$querypart);
                $qty=$inv[0]['quantity']-$inv[0]['sold'];
                if($qty==0){
                if(DEALERPRIORITY=="MANUAL"){
                    $querypart="and priority='1' and isApproved='1' and seller_plan_expired='0'";
                }
                else{
                    $querypart="and isApproved='1' and seller_plan_expired='0' order by final_price ASC";
                }
                $inv=selectQuery(INV,"quantity,sold,sp,cp,final_price,inv_no, variant_name1, variant_value1,  variant_name2, variant_value2 ","prod_id=".$prod1[0]['prod_id']." and isDel='0' ".$querypart);
                }
                $totalquantity = 0;
                $totalsold =0;
                for($k=0;$k<count($inv);$k++){
                    $totalquantity = $totalquantity + $inv[$k]['quantity'];
                    $totalsold = $totalsold + $inv[$k]['sold'];
                }
                $qty=$totalquantity-$totalsold;
                if((SHOWOUTOFSTOCK=="ON"||(SHOWOUTOFSTOCK=="OFF" && $qty!=0))&&count($inv)!=0){ ?>
                <div class="productthumb">
                    <div class="prothumb">
                        <input type ="hidden" id="selected_quant_our_prod-<? echo $masterid  ?>"  value="1" >
                        <?php if($getprodtable[$i]['extra_attrib']!=""){ ?>
                        <div class="pn1"><?=$getprodtable[$i]['extra_attrib']; ?></div>
                        <? } else{ ?>
                        <div class="pull-right atrr"></div>
                        <?php } ?>
                        <a href="<?=SITEURL; ?>/products/<?=cleantext($cat[0]['category_name'])."-".encodenumber($prod1[0]['category']); ?>/<?=cleantext($subcat[0]['subcat_name'])."-".encodenumber($prod1[0]['subcategory']); ?>/<?=cleantext($prod[0]['product_name'])."-".encodenumber($getprodtable[$i]['mp_id']); ?>" class="black">
                            <img src="<?=SITEURL; ?>/img/modelimg/thumb300x300/<?=(count($img)?$img[0]['img_name']:"No_image_available.png"); ?>" alt="<?=$prod[0]['product_name']; ?>" class="img-responsive" height="170">
                        </a>
                        <div class="add-product-cart hidden-xs">
                            <div class="prod-hover-btn-group text-center">
                                <div class="filter btn cc-primary-back cc-border-radius-50 compare_div<?php echo $masterid ?> <? if($_SESSION['cmp1']==$masterid||$_SESSION['cmp2']==$masterid||$_SESSION['cmp3']==$masterid||$_SESSION['cmp4']==$masterid){?> compareselect <?} ?>">
                                    <div class="addtocampare checkbox">
                                        <label>
                                           <input type="checkbox" data-id="<?php echo $masterid; ?>" data-id1="<?php echo $prod1[0]['subcategory']; ?>" id="compare<?php echo $masterid."ourproduct".$a; ?>" onchange="compare('compare<?php echo $masterid."ourproduct".$a; ?>')" class="compare checkbox-hey compare<?php echo $masterid ?>" <? if($_SESSION['cmp1']==$masterid||$_SESSION['cmp2']==$masterid||$_SESSION['cmp3']==$masterid||$_SESSION['cmp4']==$masterid){?> checked <?} ?> > <i class="fa fa-random" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                <button class="like-btn cc-border-radius-50 btn btn-sm <?  if(in_array($inv[0]['inv_no'],$item_array_id )) {echo "wishlist-active";}else{ echo "cc-primary-back";} ?> addtowishliostbtn-<?php echo $masterid; ?>" onclick="addtowishlist('<?=$masterid;?>','<?=$getprodtable[$i]['prod_mod_id'];?>','<?=$inv[0]['final_price'];?>','<?=$inv[0]['inv_no'];?>','<?=$inv[0]['quantity']-$inv[0]['sold'] ?>','selected_quant_our_prod-<? echo $masterid  ?>')" <? if(in_array($inv[0]['inv_no'],$item_array_id )){echo "disabled";} ?>>
                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                </button>
                            </div>

                            <?php if($inv[0]['variant_name1'] != "" && $inv[0]['variant_value1'] != ""){ echo "<div class='cc-height-15'><b>" .$finv[0]['variant_name1']."</b> : ".$finv[0]['variant_value1']."</div>";}
                            if($inv[0]['variant_name2'] != "" && $inv[0]['variant_value2'] != ""){ echo "<div class='cc-height-22'><b>" .$finv[0]['variant_name2']."</b> : ".$finv[0]['variant_value2']."</div>";} ?>
                        </div>
                    </div>
                    <? if($qty==0){?><button class="btn btn-danger btn-sm outstock">Out Of Stock</button><?php }?>
                    <div class="prod-item-figcaption cc-position-rel">
                        <div class="prodName">
                            <h2 title="<?=$prod[0]['product_name'] ?>">
                            <?=(strlen($prod[0]['product_name'])>30?substr($prod[0]['product_name'],0,30)."..":$prod[0]['product_name']); ?>
                            </h2>
                        </div>
                        <div class="completeprice">
                            <?php if($inv[0]['sp']!=0&&$inv[0]['sp']!="") { ?>
                            <span class="product-final-price"><?=money_format("<i class='fa fa-inr'></i> %!.0n", $inv[0]['final_price']).""; ?></span>
                            <?php if($inv[0]['sp']!=0&&$inv[0]['sp']!=""){ ?>
                            <span class="midline discount-price"><?=money_format("<i class='fa fa-inr'></i>%!.0n", $inv[0]['cp']).""; ?></span>
                            <? } ?>
                            <?php } else {?>
                            <span class="product-final-price"><?=money_format("<i class='fa fa-inr'></i> %!.0n", $inv[0]['final_price']).""; ?></span>
                            <?php } ?>
                        </div>
                         <?php if($qty != 0 ) {
                                if($display_button == 1) {
                                if($_SESSION['reguser'] ==""){ ?>
                                <button class="btn btn-default btn-sm cartbtn-<?php echo $masterid; if(in_array($inv[0]['inv_no'],$cart_item_array_id )){echo " cart-active";} ?>" onclick="addtotempcart('<?=$getprodtable[$i]['mp_id'];?>','<?php echo $getprodtable[$i]['prod_mod_id'];?>','<?php echo $inv[0]['final_price'];?>','<?php echo  $inv[0]['inv_no'];?>','<?php echo $inv[0]['quantity']-$inv[0]['sold'] ?>', 'selected_quant_our_prod-<? echo $masterid  ?>')" <? if(in_array($inv[0]['inv_no'],$cart_item_array_id )){echo "disabled";} ?>>
                                    <? if(in_array($inv[0]['inv_no'],$cart_item_array_id )){echo "ADD TO CART";} else  { echo "ADD TO CART"; } ?>
                                </button>
                                <?php  } else {
                                $checkincart = selectQuery(ADDTOCART,"id","u_id='".$_SESSION['reguser']."' and m_id = '".$masterid."' and inv_id = '".$inv[0]['inv_no']."'  AND checkedout=0"); ?>
                                <button class="btn btn-default btn-sm cartbtn-<?php echo $masterid; if(count($checkincart) ) { echo " cart-active"; } ?>  " onclick="addtocart('<?=$getprodtable[$i]['mp_id'];?>','<?php echo $getprodtable[$i]['prod_mod_id'];?>','<?php echo $inv[0]['final_price'];?>','<?php echo  $inv[0]['inv_no'];?>','<?php echo $inv[0]['quantity']-$inv[0]['sold'] ?>','selected_quant_our_prod-<? echo $masterid  ?>')"   <? if(count($checkincart) ) { echo " disabled"; } ?>>
                                    <? if(count($checkincart)) { echo "ADD TO CART"; } else { echo "ADD TO CART"; }?>
                                </button>
                                <?php } } }?>
                    </div>
                </div>
                <? } } } ?>
                </div>
        </div>
    </div>
</div>
<?php } ?>

<div class="container">
    <div class="home-section-intro">
        <div class="row">

            <div class="col-md-6">
                <div class="home-intro-right-col">
             <h2 class="cc-margin-top-0">About Breathe Botanicals</h2>
             <p class="lead">Chemical Free, Natural Handmade Skin Care Lines</p>
             <p class="hm-default-text">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. </p>
            <p class="hm-default-text">The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters</p>
                </div>
            </div>
              <div class="col-md-6">
            </div>
        </div>
    </div>
</div>
    
<?php $fgetprodtable = selectQuery( MSTPROD, "mp_id,prod_table,prod_mod_id,extra_attrib", "featured='1' and isDel='0' and active='1' ORDER BY mp_id DESC" );
if (count($fgetprodtable ) != 0 ) { ?>
<div class="new-arrival cc-prod-list-sec">
    <div class="container">
        <div class="section-title"><h2 class="cc-margin-0 heading text-center">New Arrival</h2>
        <p class="text-center section-subhead text-muted">Natural & Organic Makeup & Skin Care Brands Your Face Will Love You For</p>
        </div>
        <div class="product-list-tiles">
            <div class="owl-carousel owl-theme newarrival">
                <?php for($i = 0; $i < count($fgetprodtable); $i++) {
                    $fimg = selectQuery( MOD_IMG, "img_name", "mod_id=" . $fgetprodtable[$i]['mp_id'] . "  and isDel = '0' ORDER BY img_id ASC LIMIT 1" );
                    $fprod = selectQuery( $fgetprodtable[$i]['prod_table'], "product_name", "prod_id=" . $fgetprodtable[$i]['prod_mod_id'] );
                    $fprod1 = selectQuery( PROD, "prod_id,category,subcategory", "prod_name='" . $fprod[0]['product_name'] . "' and isDel='0'" );
                    $fcat = selectQuery( PRODCAT, "category_name", "pc_id='" . $fprod1[0]['category'] . "'" );
                    $fsubcat = selectQuery( PRODSUBCAT, "subcat_name", "psc_id='" . $fprod1[0]['subcategory'] . "'" );
                    $masterid = $fgetprodtable[$i]['mp_id'];
                    if ( DEALERPRIORITY == "MANUAL" ) {
                       $querypart = "and priority='1' and isApproved='1' and seller_plan_expired='0'";
                    } else {
                        $querypart = "and quantity-sold<>0  and isApproved='1'  and seller_plan_expired='0' order by final_price ASC";
                    }
                    $finv = selectQuery( INV, "quantity,sold,sp,cp,final_price,inv_no , variant_name1 , variant_value1 ,  variant_name2, variant_value2", "prod_id=" . $fprod1[0]['prod_id'] . " and isDel='0' " . $querypart );
                    $qty = $finv[0]['quantity'] - $finv[0]['sold'];
                    if($qty==0){
                        if(DEALERPRIORITY=="MANUAL"){
                            $querypart="and priority='1' and isApproved='1' and seller_plan_expired='0'";
                        }
                        else{
                            $querypart="and isApproved='1' and seller_plan_expired='0' order by final_price ASC";
                        }
                        $finv = selectQuery( INV, "quantity,sold,sp,cp,final_price,inv_no , variant_name1 , variant_value1 ,  variant_name2, variant_value2  ", "prod_id=" . $fprod1[0]['prod_id'] . " and isDel='0' " . $querypart );
                    }
                    $totalquantity = 0;
                    $totalsold =0;
                    for($k=0;$k<count($finv);$k++){
                        $totalquantity = $totalquantity + $finv[$k]['quantity'];
                        $totalsold = $totalsold + $finv[$k]['sold'];
                    }
                    $qty=$totalquantity-$totalsold;
                     if ( ( SHOWOUTOFSTOCK == "ON" || ( SHOWOUTOFSTOCK == "OFF" && $qty != 0 ) ) && count( $finv ) != 0 ) {    ?>
                        <div class="trend-now-list productthumb card">
                             <div class="prothumb">
                                    <input type ="hidden" id="selected_quant_Arrival-<?php echo $masterid; ?>"  value="1" >
                                    <?php   if ( $fgetprodtable[$i]['extra_attrib'] != "" ) {  ?>
                                    <div class="latest-avail"><?=$fgetprodtable[$i]['extra_attrib'];?></div>
                                    <?php } else { ?>
                                    <div class="pull-right atrr"></div>
                                    <?php }  ?>
                                    <a href="<?=SITEURL;?>/products/<?=cleantext( $fcat[0]['category_name'] ) . "-" . encodenumber( $fprod1[0]['category'] );?>/<?=cleantext( $fsubcat[0]['subcat_name'] ) . "-" . encodenumber( $fprod1[0]['subcategory'] );?>/<?=cleantext( $fprod[0]['product_name'] ) . "-" . encodenumber( $fgetprodtable[$i]['mp_id'] );?>" class="black"><img src="<?=SITEURL;?>/img/modelimg/thumb300x300/<?=( count( $fimg ) ? $fimg[0]['img_name'] : "No_image_available.png" );?>" alt="<?=$fprod[0]['product_name'];?>"  class="img-responsive" height="170"></a>

                                 <div class="add-product-cart text-center hidden-xs">
                                               <div class="prod-hover-btn-group">
                                        <div class="filter btn btn-sm cc-primary-back cc-border-radius-50 compare_div<?php echo $masterid; ?><?php
                                            if ( $_SESSION['cmp1'] == $masterid || $_SESSION['cmp2'] == $masterid || $_SESSION['cmp3'] == $masterid || $_SESSION['cmp4'] == $masterid ) {?> compareselect<?php }
                                            ?>">
                                            <div class="addtocampare checkbox">
                                                <label>
                                       <input type="checkbox"  data-id="<?php echo $masterid; ?>" data-id1="<?php echo $fprod1[0]['subcategory']; ?>" id="compare<?php echo $masterid . "newarrival" . $a; ?>" onchange="compare('compare<?php echo $masterid . "newarrival" . $a; ?>')" class="compare checkbox-hey compare<?php echo $masterid; ?>"   <?php if ($_SESSION['cmp1'] == $masterid || $_SESSION['cmp2'] == $masterid || $_SESSION['cmp3'] == $masterid || $_SESSION['cmp4'] == $masterid ) { echo "checked"; } ?> > <i class="fa fa-random" aria-hidden="true"></i>
                                                </label>
                                            </div>
                                        </div>
                                       <button class="like-btn cc-border-radius-50 btn btn-sm <?php if ( in_array( $finv[0]['inv_no'], $item_array_id ) ) {echo "wishlist-active";} else {echo "cc-primary-back";} ?> addtowishliostbtn-<?php echo $masterid; ?>" onclick="addtowishlist('<?=$masterid;?>','<?=$fgetprodtable[$i]['prod_mod_id'];?>','<?=$finv[0]['final_price'];?>','<?=$finv[0]['inv_no'];?>','<?=$finv[0]['quantity'] - $finv[0]['sold'];?>','selected_quant_Arrival-<?php echo $masterid; ?>')"<?php if ( in_array( $finv[0]['inv_no'], $item_array_id ) ) {echo "disabled";}?>><i class="fa fa-heart" aria-hidden="true"></i></button>

                                    </div>
               <!--                                <div>
    <?php
    if ( $finv[0]['variant_name1'] != "" && $finv[0]['variant_value1'] != "" ) { echo "<div class='cc-height-15'><b>" . $finv[0]['variant_name1'] . "</b> : " . $finv[0]['variant_value1'] . "</div>"; }
    if ( $finv[0]['variant_name2'] != "" && $finv[0]['variant_value2'] != "" ) { echo "<div class='cc-height-22'><b>" . $finv[0]['variant_name2'] . "</b> : " . $finv[0]['variant_value2'] . "</div>";}
   ?>
              </div>-->

                                    </div>

                                </div>
                                    <?php  if ( $qty == 0 ) {?><div class="outstock">Out Of Stock</div><?php } ?>
                                 <div class="prod-item-figcaption cc-position-rel">
                                   <div class="prodName">
                                       <h2 title="<?=$fprod[0]['product_name'];?>"><?=( strlen( $fprod[0]['product_name'] ) > 30 ? substr( $fprod[0]['product_name'], 0, 30 ) . ".." : $fprod[0]['product_name'] );?></h2>
                                    </div>
                                    <div class="completeprice">
                                        <?php if ( $finv[0]['sp'] != 0 && $finv[0]['sp'] != "" ) {  ?>
                                        <span class="lastpro product-final-price">
                                        <?=money_format( "<i class='fa fa-inr'></i> %!.0n", $finv[0]['final_price'] ) . ""; ?>
                                        </span>
                                        <span class="lastpro">
                                        <?php if ( $finv[0]['sp'] != 0 && $finv[0]['sp'] != "" ) { ?>
                                        <span class="midline discount-price">
                                        <?=money_format( "<i class='fa fa-inr'></i> %!.0n", $finv[0]['cp'] ) . ""; ?>
                                        </span>
                                        <?php } ?>
                                        </span>
                                        <?php } else { ?>
                                        <span class="lastpro product-final-price">
                                        <?=money_format( "<i class='fa fa-inr'> </i> %!.0n", $finv[0]['final_price'] ) . "";?>
                                        </span>
                                        <?php } ?>
                                        </div>


                                                                                  <?php
                                    if ( $qty != 0 ) {?>
    <?php

                        if ( $display_button == 1 ) {
                            if ( $_SESSION['reguser'] == "" ) {
                            ?>
                            <button class="btn btn-default btn-sm cartbtn-<?php echo $masterid; if ( in_array( $finv[0]['inv_no'], $cart_item_array_id ) ) {echo " cart-active";} ?>" onclick="addtotempcart('<?=$fgetprodtable[$i]['mp_id'];?>','<?=$fgetprodtable[$i]['prod_mod_id'];?>','<?=$finv[0]['final_price'];?>','<?=$finv[0]['inv_no'];?>','<?=$finv[0]['quantity'] - $finv[0]['sold'];?>','selected_quant_Arrival-<?php echo $masterid; ?>')"<?php if ( in_array( $finv[0]['inv_no'], $cart_item_array_id ) ) {echo "disabled";}?>>
                                <?php if ( in_array( $finv[0]['inv_no'], $cart_item_array_id ) ) {echo "ADD TO CART";} else {echo "ADD TO CART";} ?>
                            </button>
                            <?php } else {
                            $checkincart = selectQuery( ADDTOCART, "id", "u_id='" . $_SESSION['reguser'] . "' and m_id = '" . $masterid . "'  and inv_id = '" . $finv[0]['inv_no'] . "'  AND checkedout=0" );
                            ?>
                            <button class="btn btn-default btn-sm ccartbtn-<?php echo $masterid; if ( count( $checkincart ) ) {echo " cart-active";} ?>" onclick="addtocart('<?=$fgetprodtable[$i]['mp_id'];?>','<?=$fgetprodtable[$i]['prod_mod_id'];?>','<?=$finv[0]['final_price'];?>','<?=$finv[0]['inv_no'];?>','<?=$finv[0]['quantity'] - $finv[0]['sold'];?>','selected_quant_Arrival-<?php echo $masterid; ?>')"<?php if ( count( $checkincart ) ) {echo " disabled";}?>>
                            <?php if ( count( $checkincart ) ) {echo "ADD TO CART";} else {echo "ADD TO CART";}?>
                            </button>
                            <?php }
                            }
                        }
    ?>

                              </div>

                        </div>
                  <?php   }    // out of stock end
               }  // for loop end ?>
       </div>
    </div>
</div>
</div>
<?php }  // if loomp end?>

<?php $offcnts = selectQuery( OFFER, "*", "isdel='0' and isActive='1' and showonhomepage ='1' " );
if ( count( $offcnts ) != 0 ) { ?>
<section class="home-offer-sldier">
    <div class="container">
        <div class="row">
            <div class="owl-carousel owl-theme owl-offer col-md-12">
                <?php for ( $i = 0; $i < count( $offcnts ); $i++ ) {?>
                <div class="item">
                    <div class="offer-col">
                        <a href="<?=SITEURL;?>/offers">
                            <img class="img-responsive img-rounded" src="<?=SITEURL;?>/img/offer/<?php if ( $offcnts[$i]['img'] != "" ) {echo $offcnts[$i]['img'];} else {echo "No_image_available.png";}?>" alt="<?=$offcnts[$i]['offer_name'];?>">
                            <div class="offer-overlap-body">
                                <div class="offer-title cc-margin-bottom-15">
                                    <?php
                                    $offName=$offcnts[$i]['offer_name'];
                                     echo (strlen( $offName ) > 50 ?substr($offName,0,50)."..":$offName);
                                    ?>
                                </div>
                                <div class="offer-descript"><?=$offcnts[$i]['offer_info']; ?></div>
                            </div>
                        </a>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div> 
    </div>
</section>
<?php } ?>

<?php $getblog = selectQuery( BLOG, "id,title", "isdel='0' and isActive='1' and showonhomepage ='1' " );
if ( count( $getblog ) != 0 ) { ?>
<div class="home-section-blogpost cc-prod-list-sec">
    <div class="container">
        <div class="section-title"><h2 class="cc-margin-top-0 heading text-center">Latest News & Updates</h2></div>
        <div class="row">
            <div class="top-slider">
                <div class="owl-carousel owl-theme owlblog col-md-12">
                    <?php for ( $i = 0; $i < count( $getblog ); $i++ ) {
                    $blogidimg = selectQuery( BLOGIMG, "img_name", "blogid='" . $getblog[$i]['id'] . "' and isDel='0'" );
                    ?>
                    <div class="item text-center">
                        <div class="blog-box">
                            <figure>
                                <a href="<?=SITEURL;?>/blog/<?=cleantext( $getblog[$i]['title'] ) . "-" . encodenumber( $getblog[$i]['id'] );?>" class="blog-col-thumb" style="background-image:url(<?=SITEURL;?>/<?php if ( $blogidimg[0]['img_name'] != "" ) {echo "img/blog/" . $blogidimg[0]['img_name'];} else {echo "img/projectimage/No_image_available.png";}?>"  alt="<?=$getblog[$i]['title'];?>)">
                                </a>
                            </figure>
                            <div class="blog-body">
                                <h3 class="blog-title cc-margin-top-0 cc-font-thick-400" title="<?=$getblog[$i]['title'];?>"><?=$getblog[$i]['title'];?></h3>
                                <a href="<?=SITEURL;?>/blog/<?=cleantext( $getblog[$i]['title'] ) . "-" . encodenumber( $getblog[$i]['id'] );?>" class="btn btn-default btn-sm">
                                    Read More
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<? } ?>

<?php $gettestimonials = selectQuery( TESTIMONIALS, "*", "isDel='0' and isActive='1' " );
if ( count( $gettestimonials ) != 0 ) { ?>
<section class="testinomial cc-prod-list-sec">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="cc-margin-top-0 cc-margin-bottom-30 text-center">What Our Happy Customers Say</h3>
                <div class="owl-carousel owl-theme owl-testinomials owl-box-slider">
                    <?php for ( $i = 0; $i < count( $gettestimonials ); $i++ ) { ?>
                    <div class="item<?php if ( $i == 1 ) {echo "active";}?>">
                        <div class=" testinomialsbox card text-center">
                            <div class="panel-body">
                                <p class="text-muted">
                                <?php if ( strlen( $gettestimonials[$i]['testimonials'] ) > 180 ) {
                                    $arr = str_split( $gettestimonials[$i]['testimonials'] );
                                    $str = "";
                                    for ( $j = 0; $j < 145; $j++ ) {$str = $str . "" . $arr[$j];}
                                        echo $str . "...";
                                    } else {echo $gettestimonials[$i]['testimonials'];}
                                    ?>
                                </p>
                                <h5 class="cc-primary-color cc-margin-bottom-0"><?php echo $gettestimonials[$i]['client_name']; ?></h5>
                                <p>
                                    <?php if ( strlen( $gettestimonials[$i]['tour_name'] ) > 33 ) {
                                    $arr = str_split( $gettestimonials[$i]['tour_name'] );
                                    $str = "";
                                    for ( $j = 0; $j < 35; $j++ ) {$str = $str . "" . $arr[$j];}
                                        echo $str . "...";
                                    } else {echo $gettestimonials[$i]['tour_name'];}
                                ?>
                                </p>
                                <!--<h6 class="text-muted">(<?php echo $gettestimonials[$i]['tour_name']; ?> )</h6>   -->
                                <img class="img-circle" src="<?php echo SITEURL; ?>/img/testimonials/<?php echo $gettestimonials[$i]['test_image']; ?>" alt="Testimonial">
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } ?>
</div>
<div id="cartmsgs" class="alert-toast cartmsgs"></div>
<div class="showcmpcnt">
    <a href="<?php echo SITEURL; ?>/compare/compare.php" target="_blank"><b><i class="fa fa-filter"></i> Compare (<?php echo $_SESSION['cmpcnt']; ?>)</b></a>
    <button type="button" class="clearcompbtn" onclick="clearcmp()"><i class="fa fa-times" aria-hidden="true"></i></button>
</div>
<?php include 'footer.php';?>
<script>
    $(document).ready(function() {
        var owl = $('.owl-product-category');
        owl.owlCarousel({
            loop: false,
            nav: true,
            margin: 20,
            dots:false,
            responsive: {0: {items: 1},600: {items: 2},960: {items: 3},1200: {items: 5}}
        });


        var owl = $('.owl-offer');
        owl.owlCarousel({
            loop: false,
            nav: true,
            margin: 10,
            dots:false,
            responsive: {0: {items: 1},600: {items: 2},960: {items: 3},1200: {items: 3}}
        });

        var owl = $('.owlblog');
        owl.owlCarousel({
            loop: false,
            nav: true,
            margin: 20,
            dots:true,
            responsive: { 0: {items: 2},600: {items: 3},960: {items: 5},1200: {items: 4}}
        });

        var owl = $('.owlthumbslider');
        owl.owlCarousel({
            loop: false,
            nav: true,
            margin: 0,
            dots:false,
            autoplay:true,
            autoplayTimeout:1000,
            autoplayHoverPause:true,
            responsive: { 0: {items: 2},600: {items: 3},960: {items: 4},1200: {items: 6}}
        });

        var owl = $('.newarrival');
        owl.owlCarousel({
            loop: false,
            nav: true,
            margin: 20,
            dots:false,
            autoplay:true,
            autoplayTimeout:1000,
            autoplayHoverPause:true,
            responsive: { 0: {items: 2},600: {items: 3},960: {items: 4},1200: {items: 4}}
        });

        var owl = $('.featured-brand');
        owl.owlCarousel({
            loop: false,
            nav: true,
            margin: 20,
            dots:false,
            responsive: { 0: {items: 2},600: {items: 3},960: {items: 5},1200: {items: 6}}
        });

        var owl = $('.ouproducts');
        owl.owlCarousel({
            loop: false,
            nav: true,
            margin: 20,
            dots:false,
            responsive: { 0: {items: 2},600: {items: 3},960: {items: 5},1200: {items: 4}}
        });

        var owl = $('.owl-testinomials');
        owl.owlCarousel({
            loop: false,
            nav: true,
            margin: 30,
            dots:false,
            responsive: { 0: {items: 1},600: {items: 2},960: {items: 5},1200: {items: 3}}
        });

        if (!($('.homebanner img').length > 1)) {
            $('.slider-operat-btn').hide();
        }
    });

    $(".blog-title").text(function(index, currentText) {
        return currentText.substr(0, 40) + (currentText.length > 40 ? "..." : "");
    });

    /* Category Load More */
    $(document).ready(function(){
        $('.cate-left ul li.item-vertical').hide();
        $('.cate-left ul li.item-vertical:lt(6)').show();
        $('#showLess').hide();
        var items =  $('.cate-left ul li.item-vertical').length;
        var shown =  6;
        $('#loadMore').click(function () {
            shown = $('.cate-left ul li.item-vertical:visible').size()+5;
            if(shown< items) {$('.cate-left ul li.item-vertical:lt('+shown+')').show();}
            else {$('.cate-left ul li.item-vertical:lt('+items+')').show();
                $('#loadMore').hide();
                $('#showLess').show();
            }
        });

        $('#showLess').click(function () {
            $('.cate-left ul li.item-vertical').not(':lt(6)').hide();
            $('#loadMore').show();
            $('#showLess').hide();
        });

        $(window).scroll(function() {
            if ($(this).scrollTop()>0){
                $('.cate-left ul li.item-vertical').not(':lt(6)').hide();
                $('#loadMore').show();
                $('#showLess').hide();
            }
        });
    });
</script>
</body>
</html>