<?php
error_reporting(0);
include_once "db.php";


$sql = "SELECT I . * , U.f_name AS ifname, U.l_name AS ilname
FROM invites I
INNER JOIN user U ON I.invited_by = U.user_id
WHERE invite_sent =0";
$invites = $db->get_results($sql);
foreach ( $invites as $invite)
{
	echo "<br>Email : ". $invite->email;
//	echo "<br>Name : ". $invite->fname. " ". $invite->lname;
//	echo "<br>Gender: ". $invite->gender;
	echo "<br>Invited by: ". $invite->invited_by. " Name : ". $invite->ifname. " ". $invite->ilname;
	echo "<br>Sent : ". $invite->invite_sent;
	$invited_by = $invite->ifname. " ". $invite->ilname;
	$genurl = base64_encode($invite->email."&".$invite->code."&".$invite->fname."&".$invite->lname."&".$invite->gender);
	$subject = "$invited_by has invited you to a Murder Mystery Party!";
	$email = $invite->email;
	echo "<br>subject : $subject";

$message = "<html>
<head></head>
<body>
<p>On Saturday, October 15th - just in time for Hallowe'en - join over fifty of your closest 
friends at Ottawa's biggest and only free-form Murder Mystery Party.  There will be prizes, 
music and dancing, and, oh yeah, a murder!
</p>
";

$message .= "<p> 
    The concept is simple.  Everyone gets a character with clues, and the party begins the moment you arrive.  It's not like the 'out of the box' parties you may have attended in the past.  There is no scripting, and no actors.  Everyone plays in their own way.  You simply mingle with other guests to try and discover what they know, and at the end of the evening, guests vote on who they think figured the whole thing out.  The winner receives a prize.  There are also prizes for best costume, best character and more.
</p>";
$message .= "<p>
    This is the fifth time we've planned a party like this, using our unique free-form system.  This year, our theme is dead historical figures, and for the first time, you get to pick your own character.  Thanks to the support of the Awesome Ottawa foundation, this year's party will be bigger and better than ever.  We're renting a space at the SAW gallery to accommodate more guests, and adding tons of new features and prizes.  There will be food available free of charge to guests.  Unfortunately, the terms of our liquor license prohibit us from telling you whether alcoholic beverages will be available for sale.
</p>
";
$message .= "<p>
    To help off-set the costs, we are charging guests $10.00 for tickets.  Your ticket secures your space and gets you in the door.  Custom characters are written for each guest, so it's important we know who is coming in advance.  The party is completely non-profit though - any money raised will be used to cover the costs of the party.  Additional money left over will be donated to the Ottawa Food Bank, to help those less fortunate.  Help is particularly needed around Thanksgiving, and we want to do our part and have a great time in the process.
</p>";

$message .= "<pre>
LOCATION:  SAW Gallery, 67 Nicholas Street, Ottawa
TIME:  8 PM - 2 AM
TICKETS:  $10.00 by invitation only
</pre>
";

$message .= "<p>Due to capacity considerations at the SAW gallery, we need to cap invited guests at eighty.  
We expect  demand will exceed available spaces, so we encourage you to confirm your spot today.  
How do you do that?  Simple.  Register at http://www.mysteryparty.net using the URL below.";

$message .= "<p><a href='http://mysteryparty.net/register.php?code=$genurl'>Register Now</a>";

$message .= "<br>Or if that link doesn't work, simply go to http://mysteryparty.net/register.php and fill in the required details and use the invite code below</p>";
$message .= "<h3>".$invite->code."</h3>";
$message .= "<p>
    If you want to bring a guest, there is a function on the website to request a space for your guest.  If we have room, we'll be happy to add them.  Remember that your invite code is unique to you, if you give it to someone else you will not be able to register yourself!
</p>
<p>
    Confirm your space today!  We hope to see you on October 15th!
</p>
<p>
The Murder Mystery Party Organizing Committee
</p>";


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
		$sql = "update invites set invite_sent=1 where code='".$invite->code."'";
		$db->query($sql);
		sleep(1);
		echo "<BR><HR>";
    } else {
        //$data['mail_sent'] = false;
		echo "Mail not sent to : ". $email;
    }

}
/*$email = "deric@digawonk.com";
$f_name  = "Deric";
$pass = "Notreally";

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
      password : '. $pass. '
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
    $headers .= 'cc: "Murder Mystery Admin" <dericpr@mysteryparty.net>' . "\r\n";
	$headers .= '"X-Mailer: PHP 4.x"';

    // Mail it
    $mail_sent = mail($to, $subject, $message, $headers);
    if ( $mail_sent )
    {
        //$data['mail_sent'] = true;
		echo "FUCK YES YES YES LOVE IT<BR>";
    } else {
        //$data['mail_sent'] = false;
		echo "FUCK YOU SUCK ASS<BR>";
    }
*/
?>
