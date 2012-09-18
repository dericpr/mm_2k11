<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

include_once "db.php";

$sql = "SELECT I.* , U.f_name AS ifname, U.l_name AS ilname FROM invites I INNER JOIN user U ON I.invited_by = U.user_id WHERE invite_sent =0 and code_used=0";
$invites = $db->get_results($sql);
if ( $invites )
{
foreach ( $invites as $invite)
{
	echo "<br>Email : ". $invite->email;
	echo "<br>Name : ". $invite->fname. " ". $invite->lname;
	echo "<br>Gender: ". $invite->gender;
	echo "<br>Invited by: ". $invite->invited_by. " Name : ". $invite->ifname. " ". $invite->ilname;
	echo "<br>Sent : ". $invite->invite_sent;
	$invited_by = $invite->ifname. " ". $invite->ilname;
	$genurl = base64_encode($invite->email."&".$invite->code."&".$invite->fname."&".$invite->lname."&".$invite->gender);
	$subject = "Murder Mystery Party 2012 - Save the Date.";
	$email = $invite->email;
	echo "<br>subject : $subject";

$message = "<p>Ottawa Crew and Extended Friends,
<br><br>
<p>
It is almost that time of year again. Fall colours, cooler weather, and Halloween, are just around the corner.  It's also almost time for Ottawa's biggest Halloween event!  On Saturday, November 3rd, almost-just-in-time for Hallowe'en, the sixth somewhat annual Murder Mystery Extravaganza is back, and this year we're inviting all our closest friends and friends of friends back to party with us.
</p>
<p>
If you attended past parties, you'll know this is a great way to meet new people, get dressed up and have an awesome time. If you've never been and always wondered what the fuss is about, now is your chance to find out.  
</p><p>
This email is to let you know to save the date - Saturday, November 3rd.  Our theme this year will be heroes and villains. Like last year, you can choose your own character, so you'll have a chance to dress as the super- hero, or super-villain you've always wanted to be. As always, there will be prizes, drinks for sale, and hopefully. fantastic costumes. Tickets will be $10, same as last year, and we will once again use an online payment system so you can easily secure your spot.
</p><p>
So if you're coming, or thinking of coming, do nothing!  You will receive a formal invitation soon. If you know you can't make it, or want to be removed from this list, just reply to this email and we won't bother you with anymore details.
</p><p>
Check out www.mysteryparty.net for more details, including how the event works and how the evening will unfold.  Where is this party?  Well, we're not sure yet but you can be certain it will be somewhere downtown. Details to follow.
</p><p>
It seems like a long way off, but Halloween, and November 3rd, are actually just around the corner. Save the date, and start channelling your inner hero or villain.
</p><p>
Hope to see you Saturday, November 3rd,
</p><p>
Your Murder Mystery Planning Team</p>
<p>
PS:  We hate spam too!  If you would prefer not to receive these emails anymore please just reply to this message and let us know, you will be removed from the list and not receive further updates.
</p>";
	//echo "<br>$message";
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    // Additional headers
    $headers .= 'From: Murder Mystery Admin <admin@mysteryparty.net>' . "\r\n";
    $headers .= 'cc: "Murder Mystery Admin" <dericpr@mysteryparty.net>' . "\r\n";
	$headers .= '"X-Mailer: PHP 4.x"';

    // Mail it
if ($invite->code_used == 0 )
{   
	$mail_sent = mail($email, $subject, $message, $headers);
} else {
	$mail_sent = mail($email, $ubject_reg, $mesage_reg, $headers);
}
    if ( $mail_sent )
    {
        //$data['mail_sent'] = true;
		echo "Mail sent to: ". $invite->fname. " ". $invite->lname. "(".$invite->email.")";
		$sql = "update invites set invite_sent=1 where email='".$invite->email."'";
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
