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
            <li role="presentation" class="active"><a href="myimageshandle.php">My Images</a></li>
            <li role="presentation"><a href="index.html">Home</a></li>
            <li role="presentation"><a href="about.html">About</a></li>
            <li role="presentation"><a href="contact.html">Contact</a></li>
          </ul>
        </nav>
        <h3 class="text-muted"><img src="https://cdn.shopify.com/s/files/1/1210/1588/t/20/assets/logo.png?3388914896091068191" style="width:100px;"></h3>
      </div>

      <div class="jumbotron">
        <h1>Please enter your email</h1><br><p>it should be the one you used when you got your photos processed!
        <p class="lead"><html><hr>

<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST" enctype="multipart/form-data">
<center>
<input type="text" name="email2" class="form-control" style="width:40%;" placeholder="E-mail"><br>
<br></center>
<input type="submit" value="Retrieve" name="submit" class="btn btn-primary"><br><br>
</form>
<?php

function scanDirectoryImages($directory, array $exts = array('jpeg', 'jpg', 'gif', 'png', 'JPG', 'JPEG', 'GIF', 'PNG'))
    {

    if (substr($directory, -1) == '/') {
        $directory = substr($directory, 0, -1);
    }

    $html = '';
    if (
        is_readable($directory)
        && (file_exists($directory) || is_dir($directory))
    ) {
        $directoryList = opendir($directory);
        while($file = readdir($directoryList)) {
        if ($file != '.' && $file != '..') {
            $path = $directory . '/' . $file;
            if (is_readable($path)) {
                if (is_dir($path)) {
                    return scanDirectoryImages($path, $exts);
                }
                if (
                    is_file($path)
                    && in_array(end(explode('.', end(explode('/', $path)))),   $exts)
                ) {
                    $html .= '<a href="' . $path . '"><img src="' . $path
                        . '" style="max-height:250px;max-width:250px" />  </a>';
           }
            }
        }
        }
        closedir($directoryList);
    }
    return $html;
}
$dir = 'processed/'.$_POST['email2'];
file_put_contents('/var/www/html'.'/debuglog.txt', $dir, FILE_APPEND ); 
if(isset($_POST['submit'])) 
	echo scanDirectoryImages($dir);
?>
</body></p>
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

</html>
