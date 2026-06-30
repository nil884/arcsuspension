<?
    include("../includes/configuration.php");
    include_once('../easebuzz/easebuzz-lib/easebuzz_payment_gateway.php');
     include("../classes/order.php");
    require_once('../classes/user.php');
    require_once('../classes/product.php');
    include_once "../classes/shiprocket.php";
    ini_set("display_errors",1);
    $username=SHIPUSER; $pasword=SHIPPWD;
    $ship=new shiprocket($username,$pasword);
    $prod = new Product();  $user = new User(); $order = new Order($prod,$user);

      function createOrderId(){
       global $getconfigdetails;  
        $ord=selectQuery(ORDER,"order_id","order_id<>'' order by id DESC limit 1");

        $userOrderSeries=($getconfigdetails[0]['order_id']!=""?$getconfigdetails[0]['order_id']:"ORD");
        $serieslength=strlen($userOrderSeries);
        $orderstart=$userOrderSeries."-";
        $orderlength=strlen($orderstart);
        if(count($ord)==0){  $orderid=$orderstart."1"; }
        else {
            $orid=$ord[0]['order_id'];
            $numcnt=substr($orid,$orderlength);
            $a= ++$numcnt;
            $orderid= $orderstart."".$a;
        }
         $chkord=selectQuery(ORDER,"order_id","order_id='".$orderid."'");
         if(count($chkord)){  return createOrderId($txnid); }
         else{
             $ordiddata=array("order_id"=>$orderid);
             updateQuery(ORDER,$ordiddata,"transaction_id='".$txnid."'");
              return $orderid;
         }
    }
   echo createOrderId();

    exit();
     $orderdata=$order->getOrderFullDetails("bb70679bcfad1269e731");
    $ordid=10;

    /*end for remove and update block */
    $token=$ship->authenticate();

       /* 1. update stock  2. create shipment order 3. create purchase invoices*/
     $getdata=selectQuery(ORDERSUB,"*","item_id=9");
     for($i=0;$i<1;$i++){
         $idcnt=$i+1;
        $subordid="MRN-4-1";
      $productid=$getdata[$i]['product_id']; $quantity=$getdata[$i]['quantity']; $vendorid=$getdata[$i]['vendor'];
        /* update stock */
         $proddata=$prod->getselectedAttr($productid,"sold,hsn_code,weight,length,height,width,sku");
      /*  $updatestock=array("blocked"=>($proddata[0]['sold']+$quantity));
        updateQuery(PRODINFO,$updateblock,"prod_id=".$updatestock);*/
       /* update stock end*/
        /* get vendor warehouse pickup loaction */

        $vendor="vendor".$vendorid;
        $pickups=$ship->getPickups($token);
         $pickupid = array_search($vendor, array_column($pickups, 'pickup_location'));
         $pickupdetails=$pickups[$pickupid];
      $shipmentarray=array(
          "order_id"=> $subordid, "order_date"=>date("Y-m-d H:i"),
          "pickup_location"=> $pickupdetails['pickup_location'],
          "channel_id"=> "Custom", "comment"=> "",
          "billing_customer_name"=>trim($orderdata['u_fname']),"billing_last_name"=>trim($orderdata['u_lname']),
          "billing_address"=> trim($orderdata['address']),"billing_address_2"=> trim($orderdata['landmark']),
          "billing_city"=>trim($orderdata['city']),"billing_pincode"=>trim($orderdata['pincode']),
          "billing_state"=>trim($orderdata['state']), "billing_country"=> trim($orderdata['country']),
          "billing_email"=> trim($orderdata['u_email']), "billing_phone"=> trim($orderdata['u_mobile']),
          "shipping_is_billing"=> true,
          "shipping_customer_name"=> "",  "shipping_last_name"=> "","shipping_address"=> "","shipping_address_2"=> "","shipping_city"=> "", "shipping_pincode"=> "","shipping_country"=> "","shipping_state"=> "","shipping_email"=> "","shipping_phone"=> "",
          "order_items"=>array(array(
              "name"=>$getdata[$i]['display_product_name'],
              "sku"=>$proddata[0]['sku'],"units"=> $getdata[$i]['quantity'],
              "selling_price"=> $getdata[$i]['user_per_unit_withoutgst_price'],
              "discount"=>  $getdata[$i]['discount_amount'], "tax"=>$getdata[$i]['tax_percentage'],"hsn"=> ""
            ))  ,
          "payment_method"=> ($orderdata['payment_mode']=="COD"?"COD":"Prepaid"),
          "shipping_charges"=> ($getdata[$i]['isFreeShipping']==0?$getdata[$i]['shipping_charges']:0),
          "giftwrap_charges"=> 0, "transaction_charges"=> 0,"total_discount"=> $getdata[$i]['discount_amount'],
          "sub_total"=> $getdata[$i]['total_payable'],
          "length"=>($proddata[0]['length']==0.00?0.5:$proddata[0]['length']) ,"breadth"=>($proddata[0]['width']==0.00?0.5:$proddata[0]['width']) ,"height"=> ($proddata[0]['height']==0.00?0.5:$proddata[0]['height']),"weight"=> ($proddata[0]['weight']==0.000?0.5:$proddata[0]['weight'])
        );

        $shiporder= $ship->createOrder($token,$shipmentarray);
        echo "\n\r --------------------------------------------- \n\r";
         echo "<pre>"; print_r($shipmentarray);             print_r($shiporder);   echo "</pre>";
         echo "\n\r --------------------------------------------- \n\r";

        $shiporderid= $shiporder['order_id'];  $shipmentid= $shiporder['shipment_id'];  $awbcode="";
     //   $arwdata= $ship->createAWBNo($token,$jsondata);
        $shipdata=array("order_current_Status"=>"Generated","shipping_order_id"=>$shiporderid,"shipping_shipment_id"=>$shipmentid,"shipping_awb_no"=>$awbcode);
      //  updateQuery(ORDERSUB,$shipdata,"item_id=".$getdata[$i]['item_id']);


     }

?>