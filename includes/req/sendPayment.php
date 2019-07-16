<?php
header('Content-Type: application/json');

require_once '../../conf/config.php';
require_once '../../conf/lydiaApi.php';
require_once '../../conf/bdd.php';

$name = $_POST['name'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$result = array();

	
if(isset($name) && $name != '' && isset($lastname) && $lastname != '' && isset($email) && $email != '')
{
    $param = [
        'amount' => '1.00',
        'vendor_token' => LYDIA_VENDOR,
        'recipient' => $email,
        'message' => 'Hello '.$name.' '.$lastname.', a small donation for a little developer. Thank you !',
        'currency' => 'EUR',
        'type' => 'email'

    ];

    $lydia = new lydiaApi();
    $resp = $lydia->post('/api/request/do', $param);


    if($resp->error == 0)
    {

    	$sql = get_db()->prepare("INSERT INTO `transaction` (`id`, `name`, `lastname`, `email`, `request_uuid`, `info`, `date_time`) VALUES ('0', :name, :lastname, :email, :uuid, :info, CURRENT_TIMESTAMP)");
  		$sql -> execute([':name' => $name, ':lastname' => $lastname, ':email' => $email, ':uuid' => $resp->request_uuid, ':info' => $resp->mobile_url]);

    	$result['error'] = 0;
    	$result['message'] = (string) $resp->message;

    }
    else
    {
    	$result['error'] = 1;
    	$result['message'] = (string) $resp->message;
    }

}
else
{
	$result['error'] = 1;
    $result['message'] = 'a field is empty';
} 

echo json_encode($result);

?>