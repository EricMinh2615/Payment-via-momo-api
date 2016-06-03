<?php

if(@$_POST['submit']){

$Amount	= 100;
$client =237678059719;


//The client phone number ( compulsory )
$phone	= (isset($_POST['phone-num']))? $_POST['phone-num'] : 0;

//Make the client name compulsory
$clientname		= (isset($_POST['client-name']))? $_POST['client-name'] : 0;

$Phonenumber	= '237'.$phone;	

	
$url = 'http://momoapi.iceteck.com/index.php/requestpayment';

$data = array(
		'client_name'=> $clientname,
		'client'=>$client,
		'customer'=>$Phonenumber,
		'amount'=>$Amount
);
/*
$postString = 'client_name='.$clientname. '&'.
              'client ='.$client. '&'.
			  'customer ='.$Phonenumber. '&'.
			  'amount ='.$Amount;
*/


//send request:
$curl = curl_init($url);

$curlOptions = array(	
								CURLOPT_FRESH_CONNECT => TRUE,
								CURLOPT_HEADER => FALSE,
								CURLOPT_POST => TRUE,
								CURLOPT_POSTFIELDS => $data,
								CURLOPT_RETURNTRANSFER => TRUE,
								CURLOPT_TIMEOUT => 200 );

							
// SET CURL OPTIONS
curl_setopt_array($curl,$curlOptions);


// PROCESS TRANSACTION - GET RESPONSE
$Response = curl_exec($curl);

// CLOSE CURL RESOURCE
//curl_close($curl);

//decode:
$Result = json_decode($Response);

if($Result->Status==200){
echo "Success";
}
else {
echo "an error occurred.";
}
}
?>
