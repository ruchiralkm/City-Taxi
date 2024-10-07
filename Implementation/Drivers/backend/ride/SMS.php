<?php

// to send SMS
$queryDriver = "SELECT regNo, firstName, lastName FROM driver WHERE driverID = $driverID";
$result = $conn->query($queryDriver);

if ($result->num_rows > 0) {
    // Fetch the data
    $row = $result->fetch_assoc();
    $regNo = $row['regNo'];
    $firstName = $row['firstName'];
    $lastName = $row['lastName'];    
    echo "Now, you have $regNo, $firstName, and $lastName that you can use for SMS";
} 
else {
    echo "No driver found with the given driverID.";
}

require __DIR__ . '/vendor/autoload.php';

$request = new HTTP_Request2();
$request->setUrl('https://yp38nj.api.infobip.com/sms/2/text/advanced');
$request->setMethod(HTTP_Request2::METHOD_POST);
$request->setConfig(array(
    'follow_redirects' => TRUE
));
$request->setHeader(array(
    'Authorization' => 'App 4d4ebaa847243310c7874735c9056a6d-42d5c4b0-873b-414e-816e-bc06d4d38eff',
    'Content-Type' => 'application/json',
    'Accept' => 'application/json'
));

$notification_message = "Your ride with ID " . $rideID . " has been accepted by " . $firstName . " with the vehicle No " . $regNo . ".";
$request->setBody('{"messages":[{"destinations":[{"to":"94723328246"}],"from":"447491163443","text":"'.$notification_message.'"}]}');

try {
    $response = $request->send();
    if ($response->getStatus() == 200) {
        echo $response->getBody();
    }
    else {
        echo 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .
        $response->getReasonPhrase();
    }
}
catch (HTTP_Request2_Exception $e) {
    echo 'Error: ' . $e->getMessage();
}

?>
