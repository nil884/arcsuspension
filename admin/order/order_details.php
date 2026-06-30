<? include("../../includes/configuration.php");
include("../../classes/order.php"); require_once('../../classes/user.php'); require_once('../../classes/product.php');
$prod = new Product(); $user = new User(); $order = new Order($prod,$user);
$conf=$getconfigdetails[0]; 
if($conf['fraud_detection']=='1'&&($conf['fraud_apikey']!=''&&$conf['fraud_apisecrete']!='')){$verifyfraud=1;}else{$verifyfraud=0;}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo SITE_TITLE; ?> : Orders Details</title>
    <? include "../commoncss.php"; ?>
    <link rel="stylesheet" href="<?php echo SITEURL; ?>/css/dataTable/dataTables.bootstrap4.min.css">
</head>
<body>
<div class="page-body-wrapper">
    <? include '../header.php'; ?>
    <? include '../sidebar.php'; ?>
    <div class="main-panel"> 
        <div class="dashbody" id="dashbody">
           <!-- <div class="card card-body">
                <div class="alert alert-info mb-0">Failed — Payment failed or was declined by the payment gateway (unpaid)</div>
            </div>-->
            <?php $txnid = $_GET['transid'];
            $orderdata = $order->getOrderFullDetails($txnid);
           
            $all_item_detail = ""; $free_ship = "";
            $item_detail = $order->getVendororder_item($orderdata['id']); ?>
            <div class="card">
                <div class="card-header sec-card-head justify-content-between align-items-center py-2">
                    <div><h5 class="card-head-title">Order Details</h5></div>
                    <div class="btn-actions-pane-right"><button onclick="goBack()" class="btn btn-secondary btn-sm">Back</button></div>                    
                </div>
                <div class="card-body p-0">
                    <div class="row m-0">
                        <div class="ord-short-det-col border-right px-0">
                            <div class="p-3">
                                <div class="cc-fw-5 text-primary">Order Date</div>
                                <div><?php echo date("d M Y h:i A",strtotime($orderdata['order_date'])); ?></div>
                            </div>
                        </div>  
                        <div class="ord-short-det-col border-right px-0">
                            <div class="p-3">
                                <div class="cc-fw-5 text-primary">Order ID</div>
                                <div><?=$orderdata['order_id'];?></div>
                            </div>
                        </div>  
                        <div class="ord-short-det-col border-right px-0">
                            <div class="p-3">
                                <div class="cc-fw-5 text-primary">Payment Mode</div>
                                <div><?=$orderdata['payment_mode']; ?></div>
                            </div>
                        </div>
                        <div class="ord-short-det-col border-right px-0">
                            <div class="p-3">
                                <div class="cc-fw-5 text-primary">Payment ID</div>
                                <div><?=($orderdata['payment_mode']!="COD"?$orderdata['payment_id']:"-");?></div>
                            </div>
                        </div>
                        <div class="ord-short-det-col border-right px-0">
                            <div class="p-3">
                                <div class="cc-fw-5 text-primary">Transaction ID</div>
                                <div><?=$orderdata['transaction_id'];?></div>
                            </div>
                        </div>                            
                        <div class="ord-short-det-col border-right px-0">
                            <div class="p-3">
                                <div class="cc-fw-5 text-primary">Total Amount</div>
                                <div><?=$orderdata['payable_amount'];?></div>
                            </div>
                        </div>
                        
                        <div class="ord-short-det-col px-0">
                            <div class="p-3">
                                <div class="cc-fw-5 text-primary">Payment Status</div>
                                <div><?=($orderdata['payment_mode']=="COD"?"COD":$orderdata['payment_status']); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12 col-xl-3 pr-xl-0">
                    <div class="card mb-3">
                        <div class="card-body border-bottom">
                            <h6 class="cc-fw-5 mb-2 text-primary">Buyer Detail</h6>
                            <? if($orderdata['user_id']!=0){?> <a href="<?=ADMINURL; ?>buyer/buyersdetails.php?u_id=<?=base64_encode($orderdata['user_id']) ?>" target="_blank"> <? } ?>
                            <div class="mb-1 cc-font-weight-5"> <?php echo $orderdata['u_fname'].' '.$orderdata['u_lname'];?></div><div class="mb-2"><?=$orderdata['u_email'];?></div>
                            <? if($orderdata['user_id']!=0){?></a> <?}?>
                            <div class="cc-font-weight-5">Phone Number</div>
                            <div class="mb-1"><?=$orderdata['u_mobile']; ?></div>
                            <? if($verifyfraud==1){?><div class="fraud1"><button type="button" class="btn btn-sm btn-outline-dark fbtn1" onclick="verifyfraud('<?=$orderdata['u_mobile'];?>','fraud1','fbtn1')">Verify Fraud</button></div> <? } ?>
                            <?php if($orderdata['company_name'] != "") {echo "<div class='cc-font-weight-5'>Company name</div><div class='mb-2'>".$orderdata['company_name']."</div>"; } ?> 
                            <?php if($orderdata['tax_no'] != "") {echo "<div class='cc-font-weight-5'>GST NO</div><div >".$orderdata['tax_no']."</div>"; }  ?>
                        </div>
                        <div class="card-body">
                            <h6 class="cc-fw-5 mb-2 text-primary">Shipping  Detail</h6>
                            <div class="mb-1 cc-fw-5"><?php echo $orderdata['shipping_name'].' ('.$orderdata['shipping_type'].')';?></div>
                            <div class="cc-font-weight-5">Phone Number</div>
                            <div class="mb-1"><?=$orderdata['shipping_mobile'];?></div>
                            <? if($verifyfraud==1){?><div class="fraud2"><button type="button" class="btn btn-sm btn-outline-dark fbtn2" onclick="verifyfraud('<?=$orderdata['shipping_mobile'];?>','fraud2','fbtn2')">Verify Fraud</button></div> <? } ?>
                            <div class="pt-2"><?=$orderdata['address'].' '.$orderdata['landmark']."  ".$orderdata['city']." ".$orderdata['state'].", ".$orderdata['country']." ".$orderdata['pincode']; ?>.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-12 col-xl-9">
                    <!--<div><? echo $all_item_detail ?></div>-->
                    <? for($i=0;$i<count($item_detail);$i++){
                    $order_item = $item_detail[$i]; 
                   //echo "<pre>"; print_r($order_item);
                   $getprodid=selectQuery(PRODINFO,"parent_id","id=".$order_item['product_id']);
                   $pid=($getprodid[0]['parent_id']!=0?$getprodid[0]['parent_id']:$order_item['product_id']);
                    $itemid=$order_item['item_id'];
                    $status=$order_item['order_current_Status'];
                    if($order_item['product_image']){
                        $img = SITEURL."/img/order_img/".$order_item['product_image'];
                    }else{
                        $img = SITEURL."/img/projectimage/product-default.png";
                    }
                    if($order_item['isFreeShipping'] ==1  && $order_item['shipping_charges'] != 0 ){ $free_ship = " <div class='my-1'><div class='alert alert-success my-1 mb-0 py-1 px-2 d-inline-block'>".$orderdata['Freeshippingreason']."</div> </div>"; } ?>
                
                    <div class="card border-bottom order-succ-row">
                        <div class="card-header sec-card-head justify-content-between align-items-center py-2">
                            <div class="mb-2 mb-sm-0"><?=$order_item['purchase_order_id'];?></div>
                           <div><div class="text-md-right pl-0">
                           <? if($order_item['is_returned']==0&&!in_array($order_item['order_current_Status'],array("Initiated","Delivered","Canceled","failure"))){?>
                                 <button type="button" class="btn btn-primary btn-sm mb-2 mb-sm-0" onclick="updateorder('<?=$order_item['item_id']; ?>','<?=$order_item['purchase_order_id']; ?>','<?=$order_item['shipping_by']; ?>','<?=SITENAME; ?>')">Update Order Status</button> 
                           <?} ?>
                           <? if($orderdata['payment_status']!="failure"){?><a class="btn btn-primary btn-sm mb-2 mb-sm-0" href="<?=SITEURL;?>/print/generate_invoice.php?auth=<?=base64_encode("admin");?>&bill=<?=base64_encode("purchase");?>&inv=<?=base64_encode($order_item['item_id']); ?>" target="_blank">Print Purchase Invoice</a> <a class="btn btn-primary btn-sm mb-2 mb-sm-0" href="<?=SITEURL;?>/print/generate_invoice.php?auth=<?=base64_encode("admin");?>&bill=<?=base64_encode("sale");?>&inv=<?=base64_encode($order_item['item_id']); ?>" target="_blank">Print Sale Invoice</a><?} ?></div></div>
                        </div>
                        <div class='row mx-0'>
                            <div class='col-sm-2 col-lg-2 py-3 del-suc-data-col'><img src='<?=$img;?>' alt="order-det-thumb" height="120" class="mw-100 img-thumbnail"></div>
                            <div class='col-sm-10 col-lg-10 py-3 del-suc-data-col'>
                                <div class='row'>
                                    <div class='col-sm-7 col-lg-7'>
                                    <? if(count($getprodid)){?><span class='cc-fw-5'><a href="<?=ADMINURL; ?>product/view-details.php?prod_id=<?=base64_encode($pid); ?>" target="_blank"><?=$order_item['product_name'];?></a><br> (<a href="<?=SITEURL."/".getUrl("Product",$order_item['product_id']); ?>" target="_blank">Store Preview</a>)</span>    
                                     <?}else{?><span class='cc-fw-5'><?=$order_item['product_name'];?><br> (Deleted Product)</span><?} ?>
                                        
                                       <?=$free_ship;?>
                                        <div class="mb-1">Quantity : <?=$order_item['quantity'];?></div>
                                        <div class="mb-1">HSN Code : <? if($order_item['hsn_code'] == "") { echo "NA"; } else { echo $order_item['hsn_code']; }?></div>
                                        <div class="mb-1">SKU Code : <? if($order_item['sku'] == "") { echo "NA";} else { echo $order_item['sku']; } ?></div>
                                        <div class="mb-2">Vendor Name : <?=$order_item['vendor_name']; ?></div>
                                        <? if($order_item['discount_code']!=""){ ?>
                                        <div class='alert alert-success mb-2 mb-sm-0 py-2 px-3 d-inline-block small'>
                                        Promocode '<?=$order_item['discount_code'];?>' Applied</div>
                                        <? } ?>
                                        
                                        <?php if ($status == "Canceled"){ ?>
                                                <div class="mb-2"> Cancel Reason : <?php echo $order_item['cancel_reason'] ?>  </div>
                                                <div class="mb-2"> Cancelled by : <?php echo $order_item['cancelled_by'] ?>  </div>
                                              <?php }  ?>  

                                    </div>
                                    <div class='col-sm-5 col-lg-5 tot-amt-tab'>
                                      
                                        <table>
                                            <tr><td class="pb-1 pr-4">Taxable</td><td class="pb-1"><i class="fa fa-inr"></i> <?=$order_item['taxable_without_gst'];?></td></tr>
                                            <? if($order_item['discount_code']!=""){ ?>
                                            <tr><td class="pb-1">Discount </td><td class="pb-1"><i class="fa fa-inr"></i> -<?=$order_item['discount_amount'];?></td></tr>
                                            <? } if($order_item['cgst1']!="0.00"){
                                            ?><tr><td class="pb-1 pr-4">CGST <small>(<?=$order_item['cgst1'];?>% )</small></td><td class="pb-1"><i class="fa fa-inr"></i> <?=$order_item['cgst2'];?></td></tr>
                                            <tr><td class="pb-1 pr-4">SGST <small>(<?=$order_item['sgst1'];?>%)</small></td><td class="pb-1"><i class="fa fa-inr"></i> <?=$order_item['sgst2'];?></td></tr>
                                            <? } else{
                                            ?><tr><td class="pb-1 pr-4">IGST <small>(<?=$order_item['igst1'];?>%)</small></td><td class="pb-1"><i class="fa fa-inr"></i> <?=$order_item['igst2'];?></td></tr>
                                            <? } ?>
                                            <tr><td class="pb-1 pr-4">Shipping Charges </td><td class="pb-1"><i class="fa fa-inr"></i> <? if($order_item['isFreeShipping'] == 1 && $order_item['shipping_charges'] != 0 ) { echo "0"; echo "<del>".$order_item['shipping_charges']."</del>"; } else{ echo $order_item['shipping_charges']; };?></td></tr>
                                            <tr class="<?=(isset($order_item['cod_charges'])||$order_item['cod_charges']!=0.00?'':'d-none'); ?>"><td class="pb-1 pr-4">COD Charges </td><td class="pb-1"><i class="fa fa-inr"></i> <? echo $order_item['cod_charges']; ?></td></tr>
                                            <tr><td class="pr-4">Total <?=($orderdata['payment_mode']=="COD"?"Payable":"Paid"); ?> </td><td><i class="fa fa-inr"></i> <?=$order_item['total_payable'];?></td></tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border-top">  
                            <div class="col-md-12 py-2 order-status-col">
                                <div class="mt-1 mb-2">
                                <? if($order_item['is_returned']==0&&!in_array($order_item['order_current_Status'],array("Initiated","Delivered","Canceled","failure"))){ ?>
                                <? if($order_item['tracking_id']!=""){?><span class="d-block d-sm-inline-block mb-1 mb-sm-0"><span class="cc-font-weight-6">Courier By -</span><span class="mr-1"> <? echo $order_item['selected_courier_name']; ?> </span></span><? } ?>
                                <? if($order_item['tracking_location']!=""){?><span class="d-block d-sm-inline-block mb-1 mb-sm-0"><span class="cc-font-weight-6">Current Location -</span><span class="mr-1"> <? echo $order_item['tracking_location']; ?> </span></span><? } ?>
                                <? if($order_item['tracking_id']!=""){?><span class="d-block d-sm-inline-block mb-1 mb-sm-0"><span class="cc-font-weight-6">Tracking No -</span><span class="mr-1"> <?=$order_item['tracking_id'];?> </span></span><? } ?>
                                <? if($order_item['tracking_link']!=""){?><span class="d-block d-sm-inline-block"><span class="cc-font-weight-6">Tracking Link -</span><span> <a href="<?=$order_item['tracking_link'];?>" target="_blank">Click To Track</a></span></span><?} ?>
                                <? } ?>
                                 </div>
                                 <span class="mr-2">Current Status - <?=$order_item['order_current_Status'];?></span>
                                <? if($order->getOrderItemDetatils($itemid,"return_request_date")==""){?><button type="button" class="track-ord-status btn btn-link btn-xs p-0 text-link" onclick="track('<?=$order_item['shipping_shipment_id']; ?>','tracking-details<?=$i;?>')">View More</button><?}
                                else{?><button type="button" class="track-ord-status btn btn-link btn-xs p-0 text-link" onclick="trackReturn('<?=$order_item['return_shipment_id']; ?>','tracking-details<?=$i;?>')">View More</button><?} ?>
                            </div>
                            <div id="tracking-details<?=$i;?>" class="tracking-details col-md-12 px-0 border-top cc-display-none"></div>
                            <div> <? if($order->getOrderItemDetatils($itemid,"refund_status")=="1"){ ?> <div class="alert success">Amount of Rs <?=(($orderdata['payment_mode']!="COD"&&$order_item['order_current_Status']=="Canceled")||$order_item['order_current_Status']!="Canceled"?$order->getOrderItemDetatils($itemid,"refundable_amount"):0.00); ?> Initiated <?=($order->getOrderItemDetatils($itemid,"refund_id")!=""?"with refund ID ".$order->getOrderItemDetatils($itemid,"refund_id"):""); ?><?=($order->getOrderItemDetatils($itemid,"refund_date")!="0000-00-00 00:00:00"?" on ".date("d M Y H:i:s",strtotime($order->getOrderItemDetatils($itemid,"refund_date"))):""); ?> <?=($order->getOrderItemDetatils($itemid,"refund_id")!=""?"<b>(Refund Status: ".$order->getOrderItemDetatils($itemid,"refund_response").")</b>":""); ?></div> <? } ?> </div>

                        </div>
                    </div>     
                    <? } ?>
                </div>
            </div>
        </div>
        <? include "../footer.php"; ?>
    </div>
</div>
<div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title" id="exampleModalLabel">Update Order Status <span class="orderId"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form>
        <div class="modal-body">
          <div class="form-group">
            <label for="orderstatus">Order Status</label>
            <input type="hidden" class="form-control" id="itemId" >
            <select class="form-control orderstatus" id="orderstatus"><option value="In Transit">In Transit</option><option value="Delivered">Delivered</option></select>
          </div>
          <div class="form-group">
            <label for="tracking_location">Current Location Of Courier</label>
            <input type="text" class="form-control" id="tracking_location" placeholder="Current Location Of Courier" maxlength="100">
          </div>
          <div class="form-group">
            <label for="courier">Courier Company</label>
            <input type="text" class="form-control" id="courier" placeholder="Courier Company">
          </div>
          <div class="form-group">
            <label for="tracking">Tracking No</label>
            <input type="text" class="form-control" id="tracking" placeholder="Tracking Id" maxlength="50">
          </div>
          <div class="form-group">
            <label for="tracking_link">Tracking Link</label>
            <input type="text" class="form-control" id="tracking_link" placeholder="Tracking Link" maxlength="500">
          </div>

        </div>
        <div class="col-md-12 modalmsg"></div>
        <div class="modal-footer border-top-0 d-flex justify-content-center">
          <button type="button" class="btn btn-success" onclick="updatestatus()">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php include 'order_common.php'; ?>
<script>
function updateorder(itemId,orderId,shippingMode,sitename){
      var info = {itemId:itemId,action:"getTrackingDetails"};
    $.ajax({
        type: "POST",
        url: "<?=SITEURL; ?>/admin/order/ajaxdata.php",
        data: info,
        success: function(response){
            json=JSON.parse(response)
               $("#itemId").val(itemId);   $(".orderId").html(orderId);
                  $("#courier").val(json['courier_name']);
                  $("#tracking").val(json['tracking_id']);
                  $("#tracking_link").val(json['tracking_link']);
                  $("#tracking_location").val(json['tracking_location']);
                if(shippingMode!=sitename){
                  $(".modalmsg").html("(On update order will transfer to manual shipping mode)");
                }else{
                    $(".modalmsg").html("");
                }
                $("#form").modal("show");

        }
    });

}

function updatestatus(){
   itemId=$("#itemId").val();
   courier=$("#courier").val();
   tracking_no=$("#tracking").val();
   tracking_link=$("#tracking_link").val();
   tracking_location=$("#tracking_location").val();
   orderstatus=$("#orderstatus option:selected").val();
     var info = {itemId:itemId,orderstatus:orderstatus,courier:courier,tracking_no:tracking_no,tracking_link:tracking_link,tracking_location:tracking_location,action:"updateTrackingDetails"};
    $.ajax({
        type: "POST",
        url: "<?=SITEURL; ?>/admin/order/ajaxdata.php",
        data: info,
        success: function(response){
            if(response){
                if(response==1){
                      $('.alert_msgs').fadeIn().removeClass("failactionmsg").addClass("successactionmsg").html("Order Status Updated").delay(3000).fadeOut();
                      $("#form").modal("hide");
                      $("#courier,#tracking,#tracking_link,#tracking_location").val("");
                     location.reload();
                }
            }
        }
    });
}

function verifyfraud(mnumber,spanclass,btnclass){
    $(".btnclass").html("Verifying").attr("disabled",true);
    $.ajax({
        type: "POST",
        url: "<?=SITEURL; ?>/admin/verifyfraud.php",
        data: {m:mnumber},
        success: function(response){
           json = JSON.parse(response);
           if(json['status']=="success"){
            $("."+spanclass).html("<div class='alert p-2 mb-0 alert-"+(json['isFraud']==1?"danger":"success")+"'>"+json['message']+" By <a href='https://www.hellofraud.com/' target='_blank'>HelloFraud</a>");
           }else{
            $("."+spanclass).html('<div class="alert alert-danger p-2">'+json['message']+' By <a href="https://www.hellofraud.com/" target="_blank">HelloFraud</a></div>');
           }
        }
    });  
}
</script>
</body>
</html>