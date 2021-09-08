<?php

$data = json_decode(file_get_contents('php://input'), true);

if(!$data)
	echo 'No data';
else {
	echo 'Payload received', $data;
}

file_put_contents('./payload.log', date("F j, Y, g:i a").PHP_EOL, FILE_APPEND);
file_put_contents('./payload.log', print_r($data, true), FILE_APPEND);

// Repository name
//echo($data['repository']['name']);

if($data['repository']['name'] == 'degustaciones-2021') {
    echo 'From Degustaciones'; // + $data['repository']['name'];

    // execute update script, and record its output
    //ob_start();
    //passthru("git pull");
    //$output = ob_end_contents();
    //ob_end_clean();

    $url = 'http://pccm.umich.unam.mx/dm/gitpull.php';
    // Create a new cURL resource
    $ch = curl_init($url);
    // Return response instead of outputting
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // Execute the POST request
    $result = curl_exec($ch);
    // Close cURL resource
    curl_close($ch);

    print_r($result);

    print_r($result);
    file_put_contents('./payload.log', $result, FILE_APPEND);
}
