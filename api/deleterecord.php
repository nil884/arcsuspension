<?
include("../includes/configuration.php");
 include "../cpanel-uapi/cpaneluapi.class.php";
 require '../DigitalOceanAPI/vendor/autoload.php';
 use DigitalOceanV2\Adapter\BuzzAdapter;
 use DigitalOceanV2\DigitalOceanV2;
 $uapi = new cpanelAPI(CPUSER, CPPWD, CPHOST);
 $adapter = new BuzzAdapter(BUZZADAPTER);
 $json = file_get_contents('php://input');

$obj = json_decode($json,true);

 $domainName=$obj['domain'];  $id=$obj['id'];
$digitalocean = new DigitalOceanV2($adapter);

 $domainRecord = $digitalocean->domainRecord();
 $created1 = $domainRecord->delete($domainName,$id);
 echo json_encode($created1);
?>