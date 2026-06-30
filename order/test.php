<?
include "../includes/configuration.php";
$getords=selectQuery(ORDER,"id,order_id","order_id<>''");
for($i=0;$i<count($getords);$i++){
    $or=explode("-",$getords[$i]['order_id']);
    $data=array("ordseq"=>$or[0],"ordno"=>$or[1]);
    updateQuery(ORDER,$data,"id=".$getords[$i]['id']);
}
?>