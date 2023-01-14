<?php

if(!function_exists('alert')){
    function alert($type, $message){
        return "<div class='alert alert-$type'>$message</div>";
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
        $check = getimagesize($imageTmpName);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
            return ['uploadOk' => $uploadOk, 'message' => alert("warning","File is not an image.")];
        }


        // Check if file already exists
        if (file_exists($target_file)) {
            $uploadOk = 0;
            return ['uploadOk' => $uploadOk, 'message' => alert("warning","Sorry, file already exists.")];
        }

        // Check file size
        if ($imageSize > 500000) {
            $uploadOk = 0;
            return ['uploadOk' => $uploadOk, 'message' => alert("warning","Sorry, your file is too large.")];
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
            $uploadOk = 0;
            return ['uploadOk' => $uploadOk,
                'message' => alert("warning","Sorry, only JPG, JPEG, PNG & GIF files are allowed.")];
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            return ['uploadOk' => $uploadOk, 'message' => alert("warning","Sorry, your file was not uploaded.")];
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($imageTmpName, $target_file)) {
                return ['uploadOk' => $uploadOk, 'message' => alert("success","Image Uploaded Successfully.")];
            } else {
                return ['uploadOk' => $uploadOk,
                    'message' => alert("danger","Sorry, there was an error uploading your file.")];
            }
        }
    }
}

if(!function_exists('card')){
    function card(string $image_path, string $image_alt = null, string $title = null, string $desc = null, string $link = null){

        $html  = '<div class="card" style="width: 18rem;">';
        $html .= '<img class="card-img-top" src="'.$image_path.'" alt="'.$image_alt.'" height="240px;">';
        $html .= '<div class="card-body">';
        $html .= '<h5 class="card-title">'.$title.'</h5>';
        $html .= '<p class="card-text">'.$desc.'</p>';
        if(!empty($link)){
            $html .= '<a href="'.$link.'" class="btn btn-primary">More</a>';
        }
        $html .= '</div>';
        $html .= '</div>';

        return $html;
    }
}