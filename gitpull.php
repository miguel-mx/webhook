<?php

$results = shell_exec('git pull 2>&1');
echo $results;
