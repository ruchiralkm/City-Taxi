
<?php
//SMS code 
use Infobip\Configuration;
use Infobip\Api\SmsApi;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;
use Infobip\Model\SmsAdvancedTextualRequest;

require __DIR__."/vendor/autoload.php";

if ($_POST['provider']==="infobip")
{
    $base_url = "yp38nj.api.infobip.com";
    $api_key = "4d4ebaa847243310c7874735c9056a6d-42d5c4b0-873b-414e-816e-bc06d4d38eff";

    $configuration = new Configuration(host: $base_url, apiKey: $api_key);
     $api = new SmsApi(config: $configuration);
     $destination = new SmsDestination(to: $passengerMobile);
     $message = new SmsTextualMessage(
        destinations:[$destination],
        text: $message
     );
     $request = new SmsAdvancedTextualRequest(message:[$message]);

     $response = $api->sendSmsMessage($request);
}

echo "message sent";
?>

//to send SMS
$query = "SELECT regNo, firstName, lastName FROM driver WHERE driverID = $driverID";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Fetch the data
    $row = $result->fetch_assoc();
    $regNo = $row['regNo'];
    $firstName = $row['firstName'];
    $lastName = $row['lastName'];
    
    echo "Now, you have $regNo, $firstName, and $lastName $passengerMobile that you can use for SMS";
} else {
    echo "No driver found with the given driverID.";
}
