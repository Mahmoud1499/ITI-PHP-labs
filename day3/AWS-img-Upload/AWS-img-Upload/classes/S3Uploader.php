<?php

use Aws\S3\S3Client;


class S3Uploader
{
    private $s3;


    public function __construct()
    {
        // Instantiate an Amazon S3 client
        $this->s3 = new S3Client([
            'version' => 'latest',
            'region'  => AWS_REGION,
            'credentials' => [
                'key'    => AWS_ACCESS_KEY_ID,
                'secret' => AWS_SERCRET_ACCESS_KEY,
            ],
        ]);
    }

    public function uploadFile()
    {
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

                            $file_Path = __DIR__ . '/uploads/' . $filename;
                            $key = basename($file_Path);
                            try {
                                $result = $s3->putObject([
                                    'Bucket' => AWS_REGION,
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
    }
}
