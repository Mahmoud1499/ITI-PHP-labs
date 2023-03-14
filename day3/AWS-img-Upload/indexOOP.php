<?php

require 'vendor/autoload.php';



require_once("./views/upload.php");

//var_dump($_FILES);
$uploader = new S3Uploader(AWS_ACCESS_KEY_ID, AWS_SERCRET_ACCESS_KEY, 'us-east-1', 'iti-lab3');
if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] == 0) { {
        $uploader->uploadFile();
    }
}
