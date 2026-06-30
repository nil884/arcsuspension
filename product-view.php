<? $productData = $productids[$i]; $variations = $productData['variations']; if($productData['image']){ $img = SITEURL."/".$thumb1_path."/".$productData['image']; }else{ $img = SITEURL."/img/projectimage/product-default.png"; } ?>
<div class="pro-thumb-col card text-center">
    <div class="prod-pic-fig position-relative d-flex flex-wrap align-content-center"><a href="<?=SITEURL;?>/<?=getUrl("Product",$productData['id']); ?>" hreflang="en"><img src="<?=$img;?>" alt="product-thumb" class="img-fluid imglazyloader" width="220" height="300"></a><?php if($productData['stock'] == 0){ echo "<div class='out-stock-flag position-absolute text-danger text-center h6 w-100 py-3 align-self-center'>Out of stock</div>"; } ?></div>
    <div class="prod-des-figcap pb-0 px-3 py-md-3 p-md-3">        
        <h2 class="prod-name h6 mb-1"><a href="<?=SITEURL;?>/<?=getUrl("Product",$productData['id']); ?>" hreflang="en"><?=(strlen($productData['name'])>40?substr($productData['name'],0,40)."..":$productData['name']); ?></a></h2>
        <div class="prod-total-price">
            <span class="mr-2 pro-actual-price"><i class="fa fa-inr"></i><?=$productData['price']; ?></span><? if($productData['off']!=0){ ?><span class="mr-1 dist-price text-muted"><del><i class="fa fa-inr"></i><?=$productData['mrp']; ?></del></span><span class="dist-per cc-primary-color small d-none">(<?=$productData['off']; ?>%OFF)</span>
            <? } ?>
        </div>
        <div class="prod-varient p-3">
            <div class="prod-over-action mb-2">
                <span class="p-0 pro-compare cc-cursor-pointer btn btn-sm thumb-hov-btn text-center cc-cursor-pointer rounded-circle <?php if((isset($_SESSION['compare'])) && (is_array($_SESSION['compare'])) && (in_array($productData['id'],$_SESSION['compare']))){ echo "btn-primary disabled"; } else{ echo "btn-primary"; } ?>" data-toggle="tooltip" data-placement="top" title="Compare"><label class="mb-0 cc-cursor-pointer"><input type="checkbox" class="compare_<?php echo $productData['id'] ?>" onchange="add_to_compare(<?=$productData['id'] ?>)" value ="<?php if((isset($_SESSION['compare'])) && (is_array($_SESSION['compare'])) && (in_array($productData['id'],$_SESSION['compare']))){ echo "1"; } else{ echo "0" ;} ?>" > <i class="fa fa-random" aria-hidden="true"></i></label></span>
                <button type="button" class="p-0 btn btn-sm thumb-hov-btn pdod-wish text-center rounded-circle wishlist_btn_<?=$productData['id'] ?> <?php if((isset($item_array_id)) && (is_array($item_array_id)) && (in_array($productData['id'],$item_array_id))){echo "btn-primary cart-active";}else{ echo "btn-primary"; } ?>" onclick="add_to_wishlist(<?=$productData['id'] ?>,1)" <?php if( (isset($item_array_id)) && (is_array($item_array_id)) && (in_array($productData['id'],$item_array_id) )){echo "disabled";} ?> data-toggle="tooltip" data-placement="top" title="Wishlist"><i class="fa fa-heart" aria-hidden="true"></i></button>
                <?php if($productData['stock'] != 0 ){ ?> <button type="button" class="p-0 btn btn-sm thumb-hov-btn text-center rounded-circle cart_btn_<?=$productData['id'] ?> <?php if(is_array($cart_item_array_id) && (in_array($productData['id'],$cart_item_array_id) )){echo " cart-active btn-primary";}else{ echo "btn-primary"; } ?>" onclick="add_to_cart(<?=$productData['id'] ?>,1)" <?php if( isset($cart_item_array_id) && is_array($cart_item_array_id) && (in_array($productData['id'],$cart_item_array_id) )){echo "disabled";} ?> data-toggle="tooltip" data-placement="top" title="Cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i></button><?php } ?>
            </div>
            <? foreach($variations as $key=>$value){ ?>
            <div class="d-none d-md-block"><a href="<?=SITEURL;?>/<?=getUrl("Product",$productData['id']); ?>" hreflang="en"><?=$key;?> : <?=implode(", ",array_unique($value));?></a></div>
            <? } ?>
        </div>        
    </div>
</div>