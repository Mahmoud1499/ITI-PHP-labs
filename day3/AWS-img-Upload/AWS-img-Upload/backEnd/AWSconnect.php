<?php

use Aws\S3\S3Client;

$s3 = S3Client::factory([
    'version' => 'latest',
    'region' => AWS_REGION,
    'credentials' => array(
        'key' => AWS_ACCESS_KEY_ID,
        'secret' => AWS_SERCRET_ACCESS_KEY,
    )
]);
