<?php

require '../inc/dbcon.php';

function error422($message){
	
$data = [
'status' => 422,
'message' => $message,
];

header("HTTP/1.0 422 Unprocessable Entity");
echo json_encode($data);
exit();

}


function storeCustomer($customerInput){

global $conn;

$hw_account = mysqli_real_escape_string($conn, $customerInput['hw_account']);
$balance = mysqli_real_escape_string($conn, $customerInput['balance']);
$resets = mysqli_real_escape_string($conn, $customerInput['resets']);
$cr_ratio = mysqli_real_escape_string($conn, $customerInput['cr_ratio']);
$round_trades = mysqli_real_escape_string($conn, $customerInput['round_trades']);
$prev_balance = mysqli_real_escape_string($conn, $customerInput['prev_balance']);

if(empty(trim($hw_account))){
	return error422('Enter Valid Account Number');
}
elseif(empty(trim($balance))){
	return error422('Enter Your Balance');
}
elseif(empty(trim($resets))){
	return error422('Enter Resets');
}
elseif(empty(trim($cr_ratio))){
	return error422('Enter Cr Ratio');
}
elseif(empty(trim($round_trades))){
	return error422('Enter Round Trades');
}
elseif(empty(trim($prev_balance))){
	return error422('Mention Previous Balance if any');
}
else
{
	$query = "INSERT INTO account_info (hw_account, balance, resets, cr_ratio, round_trades, prev_balance) VALUES ('$hw_account', '$balance', '$resets', '$cr_ratio', '$round_trades', '$prev_balance')";
    $result = mysqli_query($conn, $query);
	
	if($result){
		$data = [
        'status' => 201,
        'message' => 'Customer Created Successfully',
       ];

header("HTTP/1.0 201 Created");
echo json_encode($data);
		
		
	}
	else{
		
		$data = [
'status' => 500,
'message' => 'Internal Server Error',
];

header("HTTP/1.0 500 Internal Server Error");
echo json_encode($data);
		
	}
	
	
	
}


}


function getCustomerList(){
	
	global $conn;
	$query = "SELECT * FROM account_info";
	$query_run = mysqli_query($conn, $query);
	
	if($query_run){
		
		if(mysqli_num_rows($query_run) > 0){
			$res = mysqli_fetch_all($query_run, MYSQLI_ASSOC);
			
			$data = [
'status' => 200, 
'message' => 'Customer List Fetched Successfully', 
'data' => $res,
];

header("HTTP/1.0 200 Customer List Fetched Successfully");
return json_encode($data);
		}
		else {
			
			$data = [
'status' => 404,
'message' => 'No Customer Found',
];

header("HTTP/1.0 404 No Customer Found");
return json_encode($data);
			
		}
		
	}
	else
	{
		$data = [
'status' => 500,
'message' => 'Internal Server Error',
];

header("HTTP/1.0 500 Internal Server Error");
return json_encode($data);
	
	
}

}

?>