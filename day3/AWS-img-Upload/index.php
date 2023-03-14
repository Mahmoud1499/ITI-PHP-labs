<?php
require_once("vendor/autoload.php");
// require_once implode(DIRECTORY_SEPARATOR, [__DIR__, 'vendor/composer', 'vendor/autoload.php']);
require_once('./backEnd/AWSconnect.php');

use Aws\S3\S3Client;


// if (!empty($_FILES)) {
//     if ($_FILES["fileToUpload"]["size"] > 3000000) {
//         die("file is too big");
//     } elseif (!strstr($_FILES["fileToUpload"]["type"], 'image')) {
//         die("file type is not supported ");
//     } else {
//         // move_uploaded_file($_FILES["fileToUpload"]['tmp_name'], "uploads/$id");

//         try {
//             $id = uniqid();
//             $s3->upload('iti-lab3', $id, fopen("aa.txt", "r+"));
//         } catch (Aws\S3\Exception\S3Exception $e) {
//             echo "There was an error uploading the file.\n";
//         }

//         die("file uploaded successfully");
//     }
// }

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if file was uploaded without errors
    if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] == 0) {
        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename = $_FILES["fileToUpload"]["name"];
        $filetype = $_FILES["fileToUpload"]["type"];
        $filesize = $_FILES["fileToUpload"]["size"];
        // Validate file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");
        // Validate file size - 3MB maximum
        $maxsize = 3 * 1024 * 1024;
        if ($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");
        // Validate type of the file
        if (in_array($filetype, $allowed)) {
            // Check whether file exists before uploading it
            if (file_exists("upload/" . $filename)) {
                echo $filename . " is already exists.";
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "uploads/" . $filename)) {
                    $bucket = 'iti-lab3';
                    $file_Path = __DIR__ . '/uploads/' . $filename;
                    $key = basename($file_Path);
                    try {
                        $result = $s3->putObject([
                            'Bucket' => $bucket,
                            'Key'    => $key,
                            'Body'   => fopen($file_Path, 'r'),
                            'ACL'    => 'public-read', // make file 'public'
                        ]);
                        echo "Image uploaded successfully. Image path is: " . $result->get('ObjectURL');
                    } catch (Aws\S3\Exception\S3Exception $e) {
                        echo "There was an error uploading the file.\n";
                        echo $e->getMessage();
                    }
                    echo "Your file was uploaded successfully.";
                } else {
                    echo "File is not uploaded";
                }
            }
        } else {
            echo "Error: There was a problem uploading your file. Please try again.";
        }
    } else {
        echo "Error: " . $_FILES["fileToUpload"]["error"];
    }
}






require_once('./views/upload.php');