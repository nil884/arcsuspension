<?php include("../../includes/configuration.php");
    include("../../classes/order.php"); require_once('../../classes/user.php'); require_once('../../classes/product.php');
    $prod = new Product();  $user = new User(); $order = new Order($prod,$user);

    if($action == "get_order_item_detail"){ $orderdata= $order->getVendor_seprate_order($itemid);

     ?>
<div class="modal-header">
                <h5 class="mb-0"><?php

                    echo $orderdata[0]['order_current_Status'];

?> order details of <?php echo $orderdata[0]['purchase_order_id'] ?></h5>

                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class='item_detail row'>



<?php

    $variationon=$orderdata[0]['variation_on'];
    if($orderdata[0]['product_image']){
        $img = SITEURL."/img/order_img/".$orderdata[0]['product_image'];
    }else{
        $img = SITEURL."/img/projectimage/product-default.png";
    }
    if($orderdata[0]['order_current_Status'] == "Canceled") { $refund = "<div class='mb-1 text-danger border border-danger py-1 px-2 rounded d-inline-block'>Cancel Reason : ".$orderdata[0]['cancel_reason']."</div><br><div class='mb-1'> Cancelled by : ".$orderdata[0]['cancelled_by']."</div>" ;  } else { $refund = ""; }
   if($orderdata[0]['isFreeShipping'] ==1  && $orderdata[0]['shipping_charges'] != 0 ){ $free_ship = "<div class='alert alert-success my-1 mb-0 py-1 px-2 d-inline-block'>".$orderdata[0]['Freeshippingreason']."</div>"; } else { $free_ship = ""; }




    echo "<div class='col-md-12 col-lg-8'><div class='row'><div class='col-md-3 col-lg-3'><img src='".$img."' class='img-fluid img-thumbnail'></div>
    <div class='col-md-9 col-lg-9 mt-3 mt-md-0'>
    <h6 class='text-primary'>".$orderdata[0]['display_product_name'];
    if($variationon!=""){
        $variationonarr=explode("|",$variationon);
        $variativaluearr=explode("|",$orderdata[0]['variation_values']);
        for($v=0;$v<count($variationonarr);$v++){ ?>
        <span> <?=$variationonarr[$v]; ?>:<?=$variativaluearr[$v]; ?> </span> <? }
    }; echo"</h6>";

    echo "<div class='mb-1'>Order Status : ".$orderdata[0]['order_current_Status']."</div>".$refund;
    echo "<div class='mb-1'>Order Date : "; echo date("d M Y h:i A",strtotime($orderdata[0]['purchase_date']))."</div>";
       if($orderdata[0]['order_current_Status'] == "Delivered"&&$orderdata[0]['delivered_on']!=""&&$orderdata[0]['delivered_on']!="0000-00-00 00:00:00"){
      echo "<div class='mb-1'>Delivery Date : ".date("d M Y h:i A",$orderdata[0]['delivered_on'])." </div>";
      }

      echo $free_ship;
    echo "<div class='mb-1'>Quantity : ".$orderdata[0]['quantity']."</div>";

    ?>
        <? if($orderdata[0]['discount_code']!=""){ ?>
                <div class='alert alert-success mt-2 mb-0 py-2 px-3 d-inline-block small'>
                Promocode '<?=$orderdata[0]['discount_code'];?>' Applied</div>
         <? } ?>
        <table>
        <tr><td class="pb-1 pr-4">Taxable</td><td class="pb-1"><i class="fa fa-inr"></i> <?=$orderdata[0]['taxable_without_gst'];?></td></tr>
       <? if($orderdata[0]['discount_code']!=""){ ?>
          <tr><td class="pb-1">Discount </td><td class="pb-1"><i class="fa fa-inr"></i> -<?=$orderdata[0]['discount_amount'];?></td></tr>
        <? } if($orderdata[0]['cgst1']!="0.00"){ ?>

          <tr><td class="pb-1 pr-4">CGST <small>(<?=$orderdata[0]['cgst1'];?>% )</small></td><td class="pb-1"><i class="fa fa-inr"></i> <?=$orderdata[0]['cgst2'];?></td></tr>
          <tr><td class="pb-1 pr-4">SGST <small>(<?=$orderdata[0]['sgst1'];?>%)</small></td><td class="pb-1"><i class="fa fa-inr"></i> <?=$orderdata[0]['sgst2'];?></td></tr>
        <? } else{
        ?><tr><td class="pb-1 pr-4">IGST <small>(<?=$orderdata[0]['igst1'];?>%)</small></td><td class="pb-1"><i class="fa fa-inr"></i> <?=$orderdata[0]['igst2'];?></td></tr>
        <? } ?>
        <tr><td class="pb-1 pr-4">Shipping Charges </td><td class="pb-1"><i class="fa fa-inr"></i> <? if($orderdata[0]['isFreeShipping'] == 1 && $orderdata[0]['shipping_charges'] != 0 ) { echo "0"; echo "<del>".$orderdata[0]['shipping_charges']."</del>"; } else{ echo $orderdata[0]['shipping_charges']; };?></td></tr>
        <tr class="<?php ($orderdata[0]['cod_charges']!=0?'':'d-none'); ?>"><td class="pb-1 pr-4">COD Charges </td><td class="pb-1"><i class="fa fa-inr"></i> <? echo $orderdata[0]['cod_charges']; ?></td></tr>
        <tr><td class="pr-4">Total <?=($orderdata[0]['payment_mode']=="COD"?"Payable":"Paid"); ?> </td><td><i class="fa fa-inr"></i> <?=$orderdata[0]['total_payable'];?></td></tr>
         </table>

  <?php  echo "</div></div></div>";

            echo "<div class='col-md-12 col-lg-4 mt-3 mt-lg-0'><h6 class='text-primary'>Shipping Address</h6>".$orderdata[0]['shippingAddr_type'].'<div>'.$orderdata[0]['shippingAddr_address'].' '.$orderdata[0]['shippingAddr_landmark'].",".$orderdata[0]['shippingAddr_city'].", ".$orderdata[0]['shippingAddr_state'].", ".$orderdata[0]['shippingAddr_country']." - ".$orderdata[0]['shippingAddr_pincode']."</div><div class='mt-1'>Phone Number - ".$orderdata[0]['shippingAddr_mobile']."</div></div>";

        "</div></div>";

        }

        if($action=="updateTrackingDetails"){
            $itemId=$_POST['itemId'];$orderstatus=$_POST['orderstatus'];$courier=$_POST['courier'];$tracking_no=$_POST['tracking_no'];$tracking_link=$_POST['tracking_link'];$tracking_location=$_POST['tracking_location'];
            $getsub=selectQuery(ORDERSUB,"shipping_by,order_current_Status,selected_courier_name,tracking_id,tracking_link,tracking_location,disbustment_days,return_days,shipping_order_id","item_id=".$itemId);
            $shippingBy = $getsub[0]['shipping_by'];
            $shippingOrderId = $getsub[0]['shipping_order_id'];
            $data=array("order_current_Status"=>$orderstatus);
    
           if($orderstatus!="Delivered"){
               if($tracking_no!=""&&($getsub[0]['tracking_id']==""||$getsub[0]['tracking_id']!=$tracking_no)){
                 $data['tracking_id']=$tracking_no;
                }
                 if($tracking_link!=""&&($getsub[0]['tracking_link']==""||$getsub[0]['tracking_link']!=$tracking_link)){
                    $data['tracking_link']=addslashes($tracking_link);
                }
                if($tracking_no!=""&&($getsub[0]['tracking_id']==""||$getsub[0]['tracking_id']!=$tracking_no)){
                 $data['tracking_id']=$tracking_no;
                }
                 if($tracking_link!=""&&($getsub[0]['tracking_link']==""||$getsub[0]['tracking_link']!=$tracking_link)){
                    $data['tracking_link']=addslashes($tracking_link);
                }
                $data['tracking_location']=$tracking_location;
                if($courier!=""&&($getsub[0]['selected_courier_name']==""||$getsub[0]['selected_courier_name']!=$courier)){
                  $data['selected_courier_name']=$courier;
                }
            }
             if($orderstatus=="Delivered"){
                $disbustment_days=($getsub[0]['disbustment_days']!=""?$getsub[0]['disbustment_days']:VENDOR_DISBURSMENT_DAYS); $return_days=($getsub[0]['return_days']?$getsub[0]['return_days']:0);
                $dis_final=$return_days+ $disbustment_days;
                if($tracking_no!=""){
                 $data['tracking_id']=$tracking_no;
                }
                 if($tracking_link!=""){
                    $data['tracking_link']=addslashes($tracking_link);
                }
                if($tracking_no!=""){
                 $data['tracking_id']=$tracking_no;
                }
                 if($tracking_link!=""){
                    $data['tracking_link']=addslashes($tracking_link);
                }
                $data['tracking_location']=$tracking_location;
                if($courier!=""&&($getsub[0]['selected_courier_name']==""||$getsub[0]['selected_courier_name']!=$courier)){
                  $data['selected_courier_name']=$courier;
                }
                $data['delivered_on']=date("Y-m-d H:i:s");
                if($return_days!=0){  $data['return_valid_till']=date('Y-m-d', strtotime(' +'.$return_days.' days'));}  $data['disbustment_date']=date('Y-m-d', strtotime(' +'.$dis_final.' days'));
            }
              if($shippingBy!=SITENAME){
                require_once "../../classes/shiprocket.php";
                $username = SHIPUSER; $pasword=SHIPPWD;
                $ship = new shiprocket($username,$pasword);
                $token = $ship->authenticate();
                if($shippingOrderId!=""){
                   $data0 = array("ids"=>array($shippingOrderId));
                  $ship-> cancelOrder($token,$data0);
                }
                 $data['shipping_by']=SITENAME;
            }
            $up = updateQuery(ORDERSUB,$data,"item_id=".$itemId);
            if($up && $shippingBy!=SITENAME && $shippingOrderId!=""){
               require_once "../../classes/shiprocket.php";
                $username = SHIPUSER; $pasword=SHIPPWD;
                $ship = new shiprocket($username,$pasword);
                $token = $ship->authenticate();
                    
                $data0 = array("ids"=>array($shippingOrderId));
                $ship-> cancelOrder($token,$data0);
            }
            echo 1;
        }

    if($action=="getTrackingDetails"){
        $itemId=$_POST['itemId'];
        $getsub=selectQuery(ORDERSUB,"shipping_by,order_current_Status,selected_courier_name,tracking_id,tracking_link,tracking_location","item_id=".$itemId);
        $data=array("order_current_Status"=>$getsub[0]['order_current_Status']);

         $data['tracking_id']=$getsub[0]['tracking_id'];
         $data['tracking_link']=$getsub[0]['tracking_link'];
          $data['courier_name']=$getsub[0]['selected_courier_name'];
          $data['tracking_location']=$getsub[0]['tracking_location'];

        echo json_encode($data);
    }
   
?>