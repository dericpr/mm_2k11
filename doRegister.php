<?php
$data['registered'] = false;

error_reporting(0);
session_start();
include_once "shared/ez_sql_core.php";
include_once "ez_sql.php";
$db = new ezSQL_mysql('mm_user','yeradeadman232','mm_2k11','localhost');
$db->hide_errors();
$f_name=htmlspecialchars($_POST['f_name'],ENT_QUOTES);
$l_name=htmlspecialchars($_POST['l_name'],ENT_QUOTES);
$email=htmlspecialchars($_POST['email'],ENT_QUOTES);
$gender=$_POST['gender'];
$pass=sha1($_POST['password']);
//get the posted values
$user_name=htmlspecialchars($_POST['email'],ENT_QUOTES);
$pass=sha1($_POST['password']);
//now validating the username and password
$sql = "INSERT into user(f_name,l_name,email,password,gender) VALUES(\"$f_name\", \"$l_name\", \"$email\", \"$pass\", $gender)";
$users = $db->query($sql);

if ( $db->rows_affected > 0 ) {
    $data['registered'] = true;
    $data['message'] = "Successfully added user $email";
     // multiple recipients
    $to  = $email;
    // subject
    $subject = 'Registration Complete, waiting for approval.';

    // message
    $message = '
    <html>
    <head>
      <title>Congratulations '. $f_name. '!  You are now registered.</title>
    </head>
    <body>
      <p>Now we just need to wait for one of the admins to login and turn some knobs and push some buttons to get your account all setup.
      In the meantime, you may want to start thinking about what historical figure you\'d like to play and planning your costume for the big event
      You will receive another email when your registration has been processed.  Thanks for signing up!
      <br>
      <br>
      for the record here is a copy of your password in case you ever forget it.<br>
      password : '. $_POST['password']. '
      <p>
      Your Murder Mystery Team
      </p>
    </body>
    </html>
    ';

    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    // Additional headers
    $headers .= 'From: Murder Mystery Admin <admin@mysteryparty.net>' . "\r\n";
    $headers .= 'cc: Murder Mystery Admin <dericpr@gmail.com>' . "\r\n";

    // Mail it
    $mail_sent = mail($to, $subject, $message, $headers);
    if ( $mail_sent )
    {
        $data['mail_sent'] = true;
    } else {
        $data['mail_sent'] = false;
    }
   
} else {
    // no user with that name
    $data['registered'] = false;
   
    // stuff the error into the error table
    $error_data = base64_encode($sql);
    $time = time();
    $sql = "INSERT INTO error(error,date) values(\"$error_data\", $time)";
    print("SQL : $sql<BR>\n");
    $db->query($sql);
    $data['error_id'] = $db->insert_id;
    $message = "Failed to register user $email : Please contact dericpr@gmail.com and reference id : $db->insert_id";
    $data['message'] = $message;    
}
$db->close;
echo json_encode($data);

?>
