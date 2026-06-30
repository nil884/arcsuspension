<? require_once("../includes/configuration.php");
if($action=="getTaxAndShipping"){
    require_once('../classes/product.php');
    require_once "../classes/shiprocket.php";
    $username = SHIPUSER; $pasword=SHIPPWD;
    $ship = new shiprocket($username,$pasword);
    $prod = new Product();

    /* authenticate shiprocket */
    $token = $ship->authenticate();
    $adminpin = $getconfigdetails[0]['pincode']; $isFreeShipping = $getconfigdetails[0]['free_shipping_on_order']; $freeShippingOn = $getconfigdetails[0]['free_shipping_on_order_cost'];
    $prodid = $_POST['prodid']; $price = $_POST['price']; $pincode = $_POST['pincode'];  $perUnitPrice = $_POST['perUnitPrice']; $vendorId = $_POST['vendorId']; $tax = $_POST['tax']; $quantities=$_POST['quantities'];
    $discount = $_POST['discount'];
    $discountType = $_POST['discountType'];
    $discountValue = $_POST['discountValue'];
    $basic_taxable = $perUnitPrice *$quantities;
    if($discount!=0){
        if($discountType=="Price"){$disc = $discountValue*$quantities; $total_price = $basic_taxable-$disc;}
        else{
            $disc = round(($basic_taxable/100)*$discountValue);
            $total_price = $basic_taxable-$disc;
        }
    }else{ $disc = 0; $total_price = $basic_taxable;}

    $taxamount=round(($total_price/100)* $tax);
    $withgst = $total_price+ $taxamount;
    $deliverydetails = $prod->getDeliverydetails($prodid);
    $vendor = "v".$deliverydetails[0]['vendor'];   $weight=$deliverydetails[0]['weight'];
    $weight = ($weight!=0.000?$weight:0.500)* $quantities;
    $pickups = $ship->getPickups($token);
    $pickupid = array_search($vendor, array_column($pickups, 'pickup_location'));
    $pickupdetails = $pickups[$pickupid];

      $userpincode = $pincode;
    $dataUserPin = array("postcode"=>$userpincode);
    $resUPin = $ship->getPincodeData($token,$dataUserPin);  $pinResUser= $resUPin['postcode_details'];
    $UserState = $pinResUser['state'];
    $data = array("postcode"=>$adminpin);
    $res = $ship->getPincodeData($token,$data); $pinRes = $res['postcode_details']; $adminState=$pinRes['state'];
    $cgst1=0;$sgst1=0;$igst1=0; $cgst2=0;$sgst2=0;$igst2=0;
    if($UserState==$adminState){
        $cgst1=round($tax/2,2);$sgst1=round($tax/2,2); $cgst2=round($taxamount/2,2);$sgst2=round($taxamount/2,2);
    }else{$igst1=$tax; $igst2=$taxamount;}
    //$withgstval= $price+ $cget2+$sget2+$iget2;
    $data = array("pickup_postcode"=>$pickupdetails['pin_code'],"delivery_postcode"=>$pincode, "cod"=>0,"declared_value"=>$withgst,"weight"=>$weight,"is_return"=>0);
    $rate = $ship->getServiceability($token,$data);
    if($rate['status']==404){
        $finalpayable= $total_price+ $cgst2+$sgst2+$igst2+($isFreeShipping==1?0:0);
        $resdata=array("status"=>"fail","product"=>$prodid,"message"=>$rate['message'],"basic_taxable"=>$basic_taxable,"taxable"=>$total_price,"discount"=>$disc,"cgst1"=>$cgst1, "sgst1"=>$cgst1, "igst1"=>$igst1, "cgst2"=>$cgst2, "sgst2"=>$sgst2, "igst2"=>$igst2,"isFreeShip"=>$isFreeShipping,"freeShippingOn"=>$freeShippingOn,"finalPayable"=>$finalpayable );
    }else{
       $recoment=$rate['data']['shiprocket_recommended_courier_id'];
        $avail = $rate['data']['available_courier_companies'];
        $id = array_search($recoment, array_column($avail, 'courier_company_id'));
        $shipdata = $avail[$id]; $rate=  $shipdata['rate'];  $deliverydate=$shipdata['etd'];
        $finalpayable = $total_price+ $cgst2+$sgst2+$igst2+($isFreeShipping==1?0:round($rate, 2));
        $resdata = array("status"=>"success","product"=>$prodid,"basic_taxable"=>$basic_taxable,"taxable"=>$total_price,"discount"=>$disc,"deliveryDate"=>$deliverydate,"shippingCharges"=>round($rate, 2),
           "cgst1"=>$cgst1, "sgst1"=>$sgst1, "igst1"=>$igst1, "cgst2"=>$cgst2, "sgst2"=>$sgst2, "igst2"=>$igst2,"isFreeShip"=>$isFreeShipping,"freeShippingOn"=>$freeShippingOn,"finalPayable"=>$finalpayable
        );
    }
    echo json_encode($resdata);
}
if($action=="getshipingdetails"){
    require_once "../classes/user.php"; $user = new User(); $shipping=$_POST['shipping'];
    $dhippingdata = $user-> getShippingDetails($shipping);
    $data = array("adress_type" => $dhippingdata[0]['address_type'],"name"=>$dhippingdata[0]['address_name'],"address"=>$dhippingdata[0]['address'],"landmark"=>$dhippingdata[0]['landmark'],"city"=>$dhippingdata[0]['city'],"state"=>$dhippingdata[0]['state'],"pincode"=>$dhippingdata[0]['pincode'],"mobile"=>$dhippingdata[0]['mobile_number'],"country"=> $dhippingdata[0]['country']);
    echo json_encode($data);
}

if($action=="getTaxAndShippingBulk"){
    require_once('../classes/product.php'); require_once "../classes/shiprocket.php";
    $username = SHIPUSER; $pasword=SHIPPWD;
    $ship = new shiprocket($username,$pasword); $prod = new Product();
    $token = $ship->authenticate();
    $adminpin = $getconfigdetails[0]['pincode']; $isFreeShipping = $getconfigdetails[0]['free_shipping_on_order'];  $freeShippingOn = $getconfigdetails[0]['free_shipping_on_order_cost'];
    $jsondata = $_POST['jsondata'];  $dataarr=json_decode($jsondata,true);
    $alldata = array();
    /*user pincode data*/
    $userpincode = $_POST['pincode'];  $dataUserPin = array("postcode"=>$userpincode);
    $resUPin = $ship->getPincodeData($token,$dataUserPin);  $pinResUser = $resUPin['postcode_details'];
    $UserState = $pinResUser['state'];
    /* end of user pincode data */
    for($i=0;$i<count($dataarr);$i++){
        $prodid=$dataarr[$i]['productid']; $quantities=$dataarr[$i]['quantities']; $perUnitPrice=$dataarr[$i]['perUnitPrice']; $tax=$dataarr[$i]['tax'];  $vendorId=$dataarr[$i]['vendorId'];
        $deliverydetails = $prod->getDeliverydetails($prodid);
        /* get vendor warehouse pickup loaction */
        $vendor="v".$deliverydetails[0]['vendor']; $weight = $deliverydetails[0]['weight'];
        $total_price = $perUnitPrice *$quantities;
        $taxamount=round(($total_price/100)* $tax);
        $withgst = $total_price+ $taxamount;
        $weight = ($weight!=0.000?$weight:0.500)*$quantities;
        $pickups = $ship->getPickups($token);
        $pickupid = array_search($vendor, array_column($pickups, 'pickup_location'));
        $pickupdetails = $pickups[$pickupid];

        $data = array("postcode"=>$adminpin);
        $res=$ship->getPincodeData($token,$data);  $pinRes= $res['postcode_details']; $adminState=$pinRes['state'];
        $cgst1=0;$sgst1=0;$igst1=0;  $cgst2=0;$sgst2=0;$igst2=0;
        if($UserState==$adminState){
            $cgst1=round($tax/2,2);$sgst1=round($tax/2,2); $cgst2=round($taxamount/2,2);$sgst2=round($taxamount/2,2);
        }else{$igst1=$tax; $igst2=$taxamount;}
        $data = array("pickup_postcode"=>$pickupdetails['pin_code'],"delivery_postcode"=>$userpincode, "cod"=>0,"declared_value"=>round($withgst,2),"weight"=>$weight,"is_return"=>0);
        $rate=$ship->getServiceability($token,$data);
        if($rate['status']==404){
        $finalpayable= $total_price+ $cgst2+$sgst2+$igst2+($isFreeShipping==1?0:0);
        $resdata=array("status"=>"fail","product"=>$prodid,"message"=>$rate['message'],"taxable"=>$total_price,"cgst1"=>$cgst1, "sgst1"=>$cgst1, "igst1"=>$igst1, "cgst2"=>$cgst2, "sgst2"=>$sgst2, "igst2"=>$igst2,"isFreeShip"=>$isFreeShipping,"freeShippingOn"=>$freeShippingOn,"finalPayable"=>$finalpayable );
        } else{
            $recoment = $rate['data']['shiprocket_recommended_courier_id'];
            $avail = $rate['data']['available_courier_companies'];
            if($recoment){
                $id = array_search($recoment, array_column($avail, 'courier_company_id'));
                $shipdata = $avail[$id]; $rate=  $shipdata['rate']; $deliverydate=$shipdata['etd'];
                $courier_company_id = $shipdata['courier_company_id']; $courier_name=$shipdata['courier_name'];
                $finalpayable = $total_price+ $cgst2+$sgst2+$igst2+($isFreeShipping==1?0:round($rate, 2));
                $resdata=array("status"=>"success","product"=>$prodid,"taxable"=>$total_price,"deliveryDate"=>$deliverydate,"shippingCharges"=>round($rate, 2), "courierId"=> $courier_company_id,"courierName"=> $courier_name,
                "cgst1"=>$cgst1, "sgst1"=>$cgst1, "igst1"=>$igst1, "cgst2"=>$cgst2, "sgst2"=>$sgst2, "igst2"=>$igst2,"isFreeShip"=>$isFreeShipping,"freeShippingOn"=>$freeShippingOn,"finalPayable"=>$finalpayable
                );
            }else{
                  $resdata=array("status"=>"fail","product"=>$prodid,"message"=>$rate['message'],"taxable"=>$total_price,"cgst1"=>$cgst1, "sgst1"=>$cgst1, "igst1"=>$igst1, "cgst2"=>$cgst2, "sgst2"=>$sgst2, "igst2"=>$igst2,"isFreeShip"=>$isFreeShipping,"freeShippingOn"=>$freeShippingOn,"finalPayable"=>$finalpayable );
            }

        }
        array_push($alldata,$resdata);
    }
   echo json_encode($alldata);
} ?>