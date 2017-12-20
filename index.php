<?php

$region = "eu-central-1";
$key = "AKIAJU4DSS6KS4I6L3JQ";
$secret = "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";
putenv('AWS_DEFAULT_REGION=' . $region);
putenv('AWS_ACCESS_KEY_ID=' . $key);
putenv('AWS_SECRET_ACCESS_KEY=' . $secret);

$GLOBALS['salida'] = shell_exec("/usr/bin/aws ec2 describe-instances --instance-ids i-0d1b835cb2cd70ea2 --output text | grep -w STATE | awk '{print $3}'");
$GLOBALS['subject'] =  htmlspecialchars($_POST['subject']);

  if ($GLOBALS['subject'] == 'start') {
     shell_exec("/usr/bin/aws ec2 start-instances --instance-ids i-07841f41780b1cbff --output text | grep -w CURRENTSTATE | awk '{print $3}'");
      //action for update here
  } else if ($GLOBALS['subject'] == 'stop') {
       shell_exec("/usr/bin/aws ec2 stop-instances --instance-ids i-07841f41780b1cbff --output text | grep -w CURRENTSTATE | awk '{print $3}'");    
  } else {
    // None
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <h1>Hello, world!</h1>
    <h1><?php echo $GLOBALS['salida']; ?></h1>
<form action="index.php" method="post">
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Instance ID</th>
      <th scope="col">Status</th>
      <th scope="col">Start</th>
      <th scope="col">Stop</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>i-07841f41780b1cbff</td>
      <td><span class="badge badge-warning"><?php echo $GLOBALS['salida']; ?></spam></td>
      <td><button type="submit" class="btn btn-primary" name="subject" value="start">Start</button></td>
      <td><button type="submit" class="btn btn-primary" name="subject" value="stop">Stop</button></td>
    </tr>

  </tbody>
</table>
</form>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
