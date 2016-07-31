<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">

<link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">

<link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">

<link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">

<link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">

<link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">

<link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">

<link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">

<link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">

<link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">

<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">

<link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">

<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">

<link rel="manifest" href="/manifest.json">

<meta name="msapplication-TileColor" content="#ffffff">

<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">

<meta name="theme-color" content="#ffffff">

    <title>Machine Art by FutureTee</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="jumbotron-narrow.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
<body style="background-image:url('bg.jpg');">
    <div class="container" style="background-color:'white';">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation"><a href="myimages.php">My Images</a></li>
            <li role="presentation" class="active"><a href="index.html">Home</a></li>
            <li role="presentation"><a href="about.html">About</a></li>
            <li role="presentation"><a href="contact.html">Contact</a></li>
          </ul>
        </nav>
        <h3 class="text-muted"><img src="https://cdn.shopify.com/s/files/1/1210/1588/t/20/assets/logo.png?3388914896091068191" style="width:100px;"></h3>
      </div>

      <div class="jumbotron">
        <h1>Processing...</h1><br><p>we have received your image.
        <p class="lead"><html><hr>
<body>
<center>
<?php
$email = $_POST["email"];
$style = $_POST["style"];
$target_dir = "uploads/";
mkdir("/var/www/html/uploads/".$email);
$target_file = $target_dir . $email . "/" . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["email"])) {
	  $emailErr = "Email is required";
	} else {
	  $email = test_input($_POST["email"]);
	  // check if e-mail address is well-formed
	  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	    $emailErr = " Invalid email format"; 
	    echo $emailErr;
	  }
	}
	if !isset($_POST['style'])){
	  $styleErr = " Style is required.";
	  echo $styleErr;
	} else {
	  $style = test_input($_POST["style"]);
	}
}
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo " File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo " Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 10000000) {
    echo " Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo " Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo " Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
	mkdir("/var/www/html/processed/".$email);
	$content_image = '/var/www/html/uploads/'.["name"];
        echo " The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.<br><br><b>You will be redirected to 'My Images' where you can use your email to view your art!</b>";
	$command = escapeshellcmd('python resizescript.py '.$email.' '.basename($_FILES["fileToUpload"]["name"]).' '.$style);
	$output = shell_exec($command);
	echo "<br><br>".$output."to process!";
	header("refresh:10; url=myimages.php");
	} else {
        	echo " Sorry, there was an error uploading your file.";
    }
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
unset($email);
unset($style);
unset($target_file);
?>
</body>
</html></p>
      </div>

      <div class="row marketing">
        <div class="col-lg-6">
          <h4><span class="glyphicon glyphicon-upload" aria-hidden="true"></span> 1. Upload your image</h4>
          <p>The first step is to upload any jpg, gif, or png image</p>

          <h4><span class="glyphicon glyphicon-console" aria-hidden="true"></span> 2. Powerful Algorithms Process</h4>
          <p>Advanced machine learning technology will apply the art style you chose to your image.</p>

          <h4><span class="glyphicon glyphicon-hourglass" aria-hidden="true"></span> 3. Wait</h4>
          <p>There is approximately a 10 second wait for the processing to finish.</p>
        </div>

        <div class="col-lg-6">
          <h4><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> 4. Finished!</h4>
          <p>Once the server is done with your request, the page will refresh and you can now see your work of art!</p>

          <h4><span class="glyphicon glyphicon-hdd" aria-hidden="true"></span> 5. Save</h4>
          <p>Feel free to come back and just use your email to see your past works of art.</p>

          <h4><span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span> 6. Buy</h4>
          <p>We offer a huge selection of prints and accessories with your generated art on it.</p>
        </div>
      </div>

      <footer class="footer">
        <p>&copy; 2016 FutureTees, Inc.</p>
      </footer>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
