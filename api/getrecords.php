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

$digitalocean = new DigitalOceanV2($adapter);
 $domainName=$obj['sitename'];
 $parse = parse_url($domainName);
 $domain=str_replace("www.","",$parse['host']);
 $domainRecord = $digitalocean->domainRecord();
 $created1 = $domainRecord->getAll($domain);
 $array = json_decode( json_encode($created1), true);
 echo json_encode($array);
?>