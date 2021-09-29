<?php

$data = json_decode(file_get_contents('php://input'), true);

if(!$data)
	echo 'No data';
else {
	echo 'Payload received', $data;
}

file_put_contents('./payload.log', date("F j, Y, g:i a").PHP_EOL, FILE_APPEND);

// Log payload data from GitHub
//file_put_contents('./payload.log', print_r($data, true), FILE_APPEND);

// Repository name
//echo($data['repository']['name']);

if($data) {
    if ($data['repository']['name'] == 'rcd-spaces') {
        echo 'From RCD Spaces'; // + $data['repository']['name'];

        // execute update script, and record its output
        //ob_start();
        //passthru("git pull");
        //$output = ob_end_contents();
        //ob_end_clean();

        // Run git pull
        $url = 'http://dev.matmor.unam.mx/rcd-spaces/gitpull.php';
        // Create a new cURL resource
        $ch = curl_init($url);
        // Return response instead of outputting
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Execute the POST request
        $result = curl_exec($ch);
        // Close cURL resource
        curl_close($ch);

        print_r($result);
        file_put_contents('./payload.log', $result, FILE_APPEND);
    }

    if ($data['repository']['name'] == '10aniversario') {
        echo 'From 10 aniversario'; // + $data['repository']['name'];

        // Run git pull
        $url = 'http://matmor.unam.mx/10-aniversario/gitpull.php';

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        print_r($result);
        file_put_contents('./payload.log', $result, FILE_APPEND);
    }
}
