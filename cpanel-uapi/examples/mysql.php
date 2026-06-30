<?php

include "../cpaneluapi.class.php"; //include the class file
$uapi = new cpanelAPI('easiesyk', 'Askangel16@#', 'easierdesk.com'); //instantiate the object

$database = 'testdb';
$databaseuser = 'testuser';
$databasepass = 'testuser';

// $response = $uapi->uapi->Mysql->get_server_information();
//var_dump($response);

/* ******************************* create databaase ********************************** */
//$response = $uapi->uapi->Mysql->create_database(['name' => $uapi->user.'_myDatabase']);
//var_dump($response);

/* ******************************* create dbuser ********************************** */
$response = $uapi->uapi->Mysql->create_user(['name' => $uapi->user.'_utest','password'=>'>?CsUf1#Ws']);
 echo $response->status;

 /* ******************************* create dbuser ********************************** */
//$response = $uapi->uapi->Mysql->get_privileges_on_database(['user' => $uapi->user.'_dbuser','database'   => $uapi->user.'_MyDatabase']);
 //var_dump($response);
 /* ******************************* set dbuser privilages********************************** */
//$response = $uapi->uapi->Mysql->set_privileges_on_database(['user' => $uapi->user.'_dbuser','database'   => $uapi->user.'_myDatabase','privileges' => 'ALL PRIVILEGES']);
 //var_dump($response);

 /* ******************************* create subdomain ********************************** */
//$response = $uapi->uapi->SubDomain->addsubdomain(['domain' => 'deepika','rootdomain'=> 'easierdesk.com','dir'=> '/deepika.easierdesk.com', 'disallowdot' => '1',]);
//var_dump($response);
//$status= $response->status;

/*if($status=="1")
{

}
else
{

}*/
//$response2=json_decode($response,true);
//  $response2=json_decode($get_userdata,true);

//  $json = '{"a":1,"b":2,"c":3,"d":4,"e":5}';
 //   var_dump(json_decode($json));



  ?>