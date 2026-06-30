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

$domainName=$obj['domain'];  $type=$obj['type']; $host=$obj['host']; $val=$obj['val'];
$priority=$obj['priority']; $port=$obj['port']; $weight=$obj['weight']; $flags=$obj['flags']; $tag=$obj['tag']; $ttl=$obj['ttl'];



$digitalocean = new DigitalOceanV2($adapter);

 $domainRecord = $digitalocean->domainRecord();

 $created1 = $domainRecord->create($domainName, $type,$host, $val,$priority,$port,$weight,$flags,$tag,$ttl);
 
 echo json_encode($created1);
?>