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
$check_code = "SELECT code,used from invite_codes where code='$invite'";
$invite_codes = $db->get_row($check_code);

if ( $invite_codes->used == 1 || $invite_codes->code == NULL ) {

   
    $data['registered'] = false;

    // stuff the error into the error table
  
    $error_data = base64_encode($err_message);
    $time = time();
    $sql = "INSERT INTO error(error,date) values(\"$error_data\", $time)";
    $db->query($sql);
    $data['error_id'] = $db->insert_id;
 if ( $invite_codes->used == 1 ) {
    $data['message'] .= "That invite code has already been used.  If you feel this is an error, please send an email with your invitiation details to
        <a href='mailto:dericpr@gmail.com?subject=Error%20registering%20with%20already%20used%20code&body=ErrorNumber:".$data['error_id']." '>Dericpr at gmail dot com</a>";
    $err_message = "Already used invite code supplied for user ".$email. " -  ". $invite;

} else if ( $invite_codes->code == NULL ) {
    $data['message'] .= "An invalid Invite code was supplied, please try again and copy the invite code exactly as found in your email";
    $err_message = "Invalid invite code supplied for user ".$email. " -  ". $invite;
}
   
    $db->close;
    echo json_encode($data);
} else {
//now validating the username and password

$sql = "INSERT into user(f_name,l_name,email,password,gender) VALUES(\"$f_name\", \"$l_name\", \"$email\", \"$pass\", $gender)";
$users = $db->query($sql);

if ( $db->rows_affected > 0 ) {
    $data['registered'] = true;
    $data['message'] = "Successfully added user $email";
    // mark that code as used
    $sql = "update invite_codes set used=1 where code = '". $invite."'";
    $code_mark = $db->query($sql);

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
    $subject = 'Murder Mystery Party 2011 Registration Complete.';

    // message
    $message = '
    <html>
    <head>
      <title>Congratulations '. $f_name. '!  You are now registered.</title>
    </head>
    <body>
      <p>We will be processing registrations over the next few days and you will be contacted at this email address again when we have finalized everything.
      At that time you will need to login and select your character and confirm your attendance by paying the registration fee.
      <br>
      <br>
      for the record here is a copy of your registration in case you ever forget it.<br>
      login : '. $email. '<br>
      password : '. $_POST['password']. '
      <br><br>';
    
    if ( strlen($gemail) > 0 ) {
        $message .= "You indicated that you will be bringing a guest.  Please pass along the following information to them so they can login and participate.
            <br>
            login : $gemail
            <br>
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
