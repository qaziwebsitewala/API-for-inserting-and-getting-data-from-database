<?php

header('Access-Control-Allow-origin:*');
header('Content-TYpe: application/json');
header('Access-Control-Allow-Method: Get');
header('Access-Control-Allow-headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With');

include('function.php');

$requestMethod = $_SERVER["REQUEST_METHOD"];

if($requestMethod == "GET"){
	
	$customerList = getCustomerList();
	echo $customerList;
	
}
else
{
$data = [
'status' => 405,
'message' => $requestMethod. 'Method Not Allowed',
];

header("HTTP/1.0 405 Method Not Allowed");
echo json_encode($data);
}


?>