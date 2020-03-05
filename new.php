<?php

session_start();
?>
<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
<?php 
	$_SESSION["mob"]=$_POST["mob"];
	$_SESSION["address"]=$_POST["address"];
	print_r($_SESSION);

	
	echo $_SESSION["name"]."<br>";
	echo $_SESSION["email"]."<br>";
	echo $_SESSION["date"]."<br>";
	echo $_SESSION["mob"]."<br>";
	echo $_SESSION["address"]."<br>";
	
	
	$filename=$_SESSION["name"].".txt";
	$myfile = fopen($filename, "w") or die("Unable to open file!");
				
	$txt = "Name :".$_SESSION["name"]."\n";
	fwrite($myfile, $txt);
				
	$txt = "Email :".$_SESSION["email"]."\n";
	fwrite($myfile, $txt);
				
	$txt = "Date of Birth :". $_SESSION["date"]."\n";
	fwrite($myfile, $txt);
				
	$txt = "Mobile :". $_SESSION["mob"]."\n";
	fwrite($myfile, $txt);
				
	$txt = "Address :". $_SESSION["address"]."\n";
	fwrite($myfile, $txt);
				
	fclose($myfile);
	
	echo "file created";
?>
<img src="<?php echo $target_file; ?>" height="300px"/>;