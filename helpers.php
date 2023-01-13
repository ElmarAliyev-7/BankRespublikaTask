<?php

if(!function_exists('success')){
    function success($message){
        return "<div class='alert alert-success'>$message</div>";
    }
}

if(!function_exists('danger')){
    function danger($message){
        return "<div class='alert alert-danger'>$message</div>";
    }
}

if(!function_exists('warning')){
    function warning($message){
        return "<div class='alert alert-warning'>$message</div>";
    }
}

if(!function_exists('uploadImage')){
    function uploadImage($target_dir, $imageName, $imageTmpName, $imageSize ){
        //If folder doesn't exists create it
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $target_file = $target_dir . basename($imageName);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($imageTmpName);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                $uploadOk = 0;
                return warning("File is not an image.");
            }
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            $uploadOk = 0;
            return warning("Sorry, file already exists.");
        }

        // Check file size
        if ($imageSize > 500000) {
            $uploadOk = 0;
            return warning("Sorry, your file is too large.");
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
            $uploadOk = 0;
            return warning("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            return danger("Sorry, your file was not uploaded.");
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($imageTmpName, $target_file)) {
//                return success("Process Finished Successfully.");
            } else {
                return danger("Sorry, there was an error uploading your file.");
            }
        }
    }
}