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

$gf_name=htmlspecialchars($_POST['gf_name'],ENT_QUOTES);
$gl_name=htmlspecialchars($_POST['gl_name'],ENT_QUOTES);
$gemail=htmlspecialchars($_POST['gemail'],ENT_QUOTES);
$ggender=$_POST['ggender'];

$pass=sha1($_POST['password']);
$gpass=sha1($email);
//get the posted values
$user_name=htmlspecialchars($_POST['email'],ENT_QUOTES);
$invite=htmlspecialchars($_POST['invite_code'], ENT_QUOTES);

// check if the invite code is valid.
//
$check_code = "SELECT code from invite_codes";
$invite_codes = $db->get_results($check_code);
$codes = array("");
foreach ($invite_codes as $code )
{
   array_push($codes, $code->code);
}

if ( !in_array($invite,  $codes, false)) {
    $data['message'] .= "Invalid invite code supplied, please try again with a valid invite code";
    $data['registered'] = false;

    // stuff the error into the error table
    $err_message = "Invalid invite code supplied for user ".$email. " -  ". $invite;
    $error_data = base64_encode($err_message);
    $time = time();
    $sql = "INSERT INTO error(error,date) values(\"$error_data\", $time)";
    $db->query($sql);
    $data['error_id'] = $db->insert_id;
   
    $db->close;
    echo json_encode($data);
} else {

//now validating the username and password
$sql = "INSERT into user(f_name,l_name,email,password,gender) VALUES(\"$f_name\", \"$l_name\", \"$email\", \"$pass\", $gender)";
$users = $db->query($sql);

if ( $db->rows_affected > 0 ) {
    $data['registered'] = true;
    $data['message'] = "Successfully added user $email";

    //now validating the guest username and password
    if ( strlen($gemail) > 0 ) {
        $sql = "INSERT into user(f_name,l_name,email,password,gender) VALUES(\"$gf_name\", \"$gl_name\", \"$gemail\",\"$gpass\", $ggender)";
        $users = $db->query($sql);
        if ( $db->rows_affected > 0 ) {
            $data['message'] .= "<br>Successfully added guest user : $gemail";
        } else {
            $data['message'] .= "<br>Failed to add guest user : $gemail";
        }
    }
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
      <br>
      password : '. $password. '
      <br>';
    
    if ( strlen($gemail) > 0 ) {
        $message .= "You indicated that you will be bringing a guest.  Please pass along the following information to them so they can login and participate.
            <br>
            login : $gemail
            password : $email
            <br>
            ";
    }

     $message .= ' <p>
      Your Murder Mystery Team
      </p>
    </body>
    </html>
    ';

    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    // Additional headers
    $headers .= 'To: '.$f_name.' <'.$email.'>' . "\r\n";
    $headers .= 'From: Murder Mystery Admin <admin@mysteryparty.net>' . "\r\n";
    $headers .= 'Bcc: dericpr@gmail.com' . "\r\n";

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
    $err_message = "Unable to insert user with the following sql <BR><BR> ".
    $err_message .= $sql;
    $error_data = base64_encode($err_message);
    $time = time();
    $sql = "INSERT INTO error(error,date) values(\"$error_data\", $time)";
    $db->query($sql);
    $data['error_id'] = $db->insert_id;
    $message = "Failed to register user $email : Please contact dericpr@gmail.com and provide the following info<br> Error Reference id : $db->insert_id";
    $data['message'] = $message;    
}

$db->close;
echo json_encode($data);
}
?>
