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
    echo 'From degustaciones';
    // execute update script, and record its output
    ob_start();
    passthru("git pull");
    $output = ob_end_contents();
    ob_end_clean();

    print_r($output);
    file_put_contents('./payload.log', $output, FILE_APPEND);
}
