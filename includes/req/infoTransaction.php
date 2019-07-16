<?php
header('Content-Type: application/json');

require_once '../../conf/config.php';
require_once '../../conf/lydiaApi.php';
require_once '../../conf/bdd.php';

$uuid = $_POST['uuid'];
$result = array();

$state = [
    '1' => 'Request accepted',
    '0' => 'Waiting to be accepted',
    '5' => 'Refused by the payer',
    '6' => 'Cancelled by the owner',
    '-1' => 'Unknown'
];

	
if(isset($uuid) && $uuid != '')
{
    $param = [
        'request_uuid' => $uuid,
        'vendor_token' => LYDIA_VENDOR
    ];

    $lydia = new lydiaApi();
    $resp = $lydia->post('/api/request/state', $param);


    if($resp->error >= 1)
    {
        $result['error'] = 1;
        $result['message'] = (string) $resp->message;
    	

    }
    else
    {
    	$result['error'] = 0;
        $result['message'] = $state[(string) $resp->state];
        $result['uuid'] = $uuid;
    }   

}
else
{
	$result['error'] = 1;
    $result['message'] = 'a field is empty';
} 

echo json_encode($result);

?>