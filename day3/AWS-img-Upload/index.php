<?php
require_once("vendor/autoload.php");
// require_once implode(DIRECTORY_SEPARATOR, [__DIR__, 'vendor/composer', 'vendor/autoload.php']);
require_once('./backEnd/AWSconnect.php');


use Aws\S3\S3Client;


if (!empty($_FILES)) {
    if ($_FILES["fileToUpload"]["size"] > 3000000) {
        die("file is too big");
    } elseif (!strstr($_FILES["fileToUpload"]["type"], 'image')) {
        die("file type is not supported ");
    } else {
        // move_uploaded_file($_FILES["fileToUpload"]['tmp_name'], "uploads/$id");

        try {
            $id = uniqid();
            $s3->upload('iti-lab3', $id, fopen("aa.txt", "r+"));
        } catch (Aws\S3\Exception\S3Exception $e) {
            echo "There was an error uploading the file.\n";
        }

        die("file uploaded successfully");
    }
}



try {
    $id = uniqid();
    $s3->upload('iti-lab3', $id, fopen("aa.txt", "r+"));
    // echo "Uploaded.\n";
} catch (Aws\S3\Exception\S3Exception $e) {
    echo "There was an error uploading the file.\n";
}

require_once('./views/upload.php');
