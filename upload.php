<?php

include "func.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $subtext = $_POST["subtext"];
    $target_dir = "videos/";
    $target_file = $target_dir . basename($_FILES["video"]["name"]);
    $uploadOk = 1;
    $videoFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    // Check if file is a actual video or fake video
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["video"]["tmp_name"]);
        if($check !== false) {
            echo "File is a video - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not a video.";
            $uploadOk = 0;
        }
    }
    
    // Check file size
    if ($_FILES["video"]["size"] > 50000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($videoFileType != "mp4") {
        echo "Sorry, only MP4 files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    
    // if everything is ok, try to upload file
    } else {
        $url=$target_dir.$title.'.mp4';
        $con=mysqli_connect("localhost","root","","myhmsdb");
        $pid = $_SESSION['pid'];
        $email = $_SESSION['email'];
        $result = mysqli_query($con,"INSERT INTO vidlib( title, context, url) VALUES ('$title','$subtext','$url');");
        if ($result){
        if (move_uploaded_file($_FILES["video"]["tmp_name"], $target_dir . $title . ".mp4")) {
            echo "The file ". htmlspecialchars( basename( $_FILES["video"]["name"])). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    else{
        echo "Sorry, there was an error uploading your file. Mysql error :". mysqli_error($con);
    }
    }
    
    
}
?>