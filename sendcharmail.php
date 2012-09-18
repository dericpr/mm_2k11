<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

include_once "db.php";

$sql = "SELECT U.* FROM user U where character_selected = 0 and reminder_sent = 0";
$invites = $db->get_results($sql);
if ( $invites )
{
foreach ( $invites as $invite)
{
	echo "<br>Email : ". $invite->email;
	echo "<br>Name : ". $invite->f_name. " ". $invite->l_name;
	$subject = "Murder Mystery Party Update - select your character now online!";
	$email = $invite->email;
	echo "<br>subject : $subject";

$message = "<p>A while back, you confirmed your attendance at the Awesome Ottawa Murder Mystery Party being held October 15th at Club SAW (67 Nichols Street in the Market).  We wanted to let you know that character selection and payment options are now available online.  There are also some photos from our previous parties so you can see what all the fun is about.<br><br>";
$message .= "Visit mysteryparty.net and log in to select your character and pay your admission fee. If you've forgotten your login information, email <a href='mailto:dericpr@mysteryparty.net'>Deric</a>";
$message .= "<br><br>In order to give us lots of time to write the story, we need people to select their custom characters as soon as possible.  But don't worry - if you haven't selected your character by October 3rd, we'll assign one to you.";
$message .= "<br><br>We look forward to seeing you on October 15th.  Questions?  Email us and we'll do our best to answer them.<br><br>Your Murder Mystery Party Team (Greg, Deric, Kelly, Nick and Tabatha)";
	//echo "<br>$message";
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    // Additional headers
    $headers .= 'From: Murder Mystery Admin <admin@mysteryparty.net>' . "\r\n";
    $headers .= 'cc: "Murder Mystery Admin" <dericpr@mysteryparty.net>' . "\r\n";
	$headers .= '"X-Mailer: PHP 4.x"';

    // Mail it
	$mail_sent = mail($email, $subject, $message, $headers);
    if ( $mail_sent )
    {
        //$data['mail_sent'] = true;
		echo "Mail sent to: ". $invite->fname. " ". $invite->lname. "(".$invite->email.")";
		$sql = "update user set reminder_sent=1 where user_id='".$invite->user_id."'";
		$db->query($sql);
		echo "<BR><HR>";
    } else {
        //$data['mail_sent'] = false;
		echo "Mail not sent to : ". $email;
    }

}
} else {
echo "No messages to send<br>";
}
?>
