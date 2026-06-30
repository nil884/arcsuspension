<?php include("includes/configuration.php"); include("classes/product.php"); $urltitle = $_GET['urltitle'];
$prod = new Product(); $categorydetails = $prod->getcategoryDetails($urltitle); $where = 'sub_cat='.$categorydetails[0]['id']; $pagetitle = $categorydetails[0]['page_title']; $bread = $prod-> getBreadcrumb("sub_cat",$categorydetails[0]['id']); $actual_link = ($_SERVER['HTTPS'] == 'on'?"https://":"http://").$_SERVER[HTTP_HOST]."".$_SERVER[REQUEST_URI]; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=($pagetitle!=""?$pagetitle." : ".SITE_TITLE:$bread['parent']." - ".$bread['master']." : ".SITE_TITLE); ?></title>
    <meta name="description" content="<?=($categorydetails[0]['metadescription']!=""?$categorydetails[0]['metadescription']:METADESCRIPTION); ?>">
    <meta name="keyword" content="<?=($categorydetails[0]['keywords']!=""?$categorydetails[0]['keywords']:METAKEYWORDS); ?>">
    <link rel="canonical" href="<?="https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>" >
    <!--Open Graph / Facebook-->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo $actual_link; ?>">
    <meta property="og:title" content="<?=($pagetitle!=""?$pagetitle." : ".SITE_TITLE:$bread['parent']." - ".$bread['master']." - ".$bread['sub']." : ".SITE_TITLE); ?>">
    <meta property="og:description" content="<?=($categorydetails[0]['metadescription']!=""?$categorydetails[0]['metadescription']:METADESCRIPTION); ?>">
    <meta property="og:image" content="<?=(OGIMAGE!=""?SITEURL."/img/ogimage/".OGIMAGE:SITEURL."/img/projectimage/".(LOGO != ""?LOGO:"default_logo.png")); ?>">
    <!--Twitter-->
    <meta property="twitter:card" content="<?=(OGIMAGE!=""?SITEURL."/img/ogimage/".OGIMAGE:SITEURL."/img/projectimage/".(LOGO != ""?LOGO:"default_logo.png")); ?>">
    <meta property="twitter:url" content="<?php echo $actual_link; ?>">
    <meta property="twitter:title" content="<?=($pagetitle!=""?$pagetitle." : ".SITE_TITLE:$bread['parent']." - ".$bread['master']." - ".$bread['sub']." : ".SITE_TITLE); ?>">
    <meta property="twitter:description" content="<?=($categorydetails[0]['metadescription']!=""?$categorydetails[0]['metadescription']:METADESCRIPTION); ?>">
    <meta property="twitter:image" content="<?=(OGIMAGE!=""?SITEURL."/img/ogimage/".OGIMAGE:SITEURL."/img/projectimage/".(LOGO != ""?LOGO:"default_logo.png")); ?>">
    <?php include "commoncss.php" ?>
    <link rel="stylesheet" href="<?=SITEURL; ?>/css/jquery-ui.css">
</head>
<body>
<div class="main-wrap pb-4">
    <?php include "menu.php" ?>
    <div class="container"><ol class="breadcrumb mb-0 pl-0 pb-0 mb-3"><li class="breadcrumb-item"><a href="<?=SITEURL; ?>" hreflang="en">Home</a></li><li class="breadcrumb-item"><?=$bread['master']; ?></li></ol></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="mb-2 mb-md-0"><h1 class="mb-3 h3"><?=$categorydetails[0]['cat_name']; ?></h1></div>
                <div class="row mr-0 categ-list-sec">
                <? $parent = selectQuery(PRODCAT,"cat_name,img_name,id,type,url_title","type='Sub' AND isActive='1' AND parent_id=".$categorydetails[0]['id']." order by priority");
                if(count($parent)){ ?>
                    <?php $catpath = getimgconfigpaths('category');
                    for($p=0;$p<count($parent);$p++){
                    if($parent[$p]['img_name']!=""){
                    $src = SITEURL.'/'.$catpath[0]['imgs_location'].'/'.$parent[$p]['img_name'];
                    } else{ $src=SITEURL."/img/projectimage/no_image_available.jpg"; }
                    $parenttype = $parent[$p]['type']; $parentid=$parent[$p]['id']; ?>
                    <div class="col-4 col-sm-4 col-md-4 col-lg-2 mb-3 text-center pr-0"><a href="<?=SITEURL.'/'.getUrl("Sub",$parentid)?>" hreflang="en"><div class="pro-cat-tumb pro-cat-tumb categ-item position-relative shop-by-cat d-flex flex-wrap align-content-center card rounded-top p-2 p-md-3"><img src="<?=$src; ?>" alt="<?php echo $parent[$p]['cat_name'] ?>" class="mw-100 m-auto rounded"></div>
                        <div class="h6 category-head text-center mb-0 rounded-bottom d-flex flex-wrap align-content-center justify-content-center cc-primary-back"><div class="my-1"><?php echo $parent[$p]['cat_name'] ?></div></div></a></div>
                    <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
</body>
</html>