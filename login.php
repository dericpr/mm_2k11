<?php
error_reporting(0);
session_start();
include_once "db.php";

//get the posted values
$user_name=htmlspecialchars($_POST['email'],ENT_QUOTES);
$pass=sha1($_POST['password']);
//now validating the username and password
$users = $db->get_results("SELECT * FROM user where email = '$user_name'");
if ( $users ) {
    foreach ( $users as $user )
    {
        if ( $user->password == $pass )
        {
           
            $data['login'] = true;
            $data['user'] = true;
            if ($user->access_level == 0 ) {
                $data['registered'] = true;
                $data['success'] = true;
                //$data['message'] = "S is still <a class='pending' href='locked.php' onclick=>locked</a>,<br> you will be notified by email<br> when sig is open.";

            }  else {
                $_SESSION['f_name'] = $user->f_name;
                $_SESSION['l_name'] = $user->l_name;
                $_SESSION['email'] = $user->email;
                $_SESSION['level'] = $user->access_level;
                $_SESSION['id'] = $user->user_id;
				$_SESSION['char_sel'] = $user->character_selected;
				$_SESSION['paid'] = $user->paid;
                $data['registered'] = true;
                $data['success'] = true;
            }
            if ($user->access_level > 7) {
                $data['redirect'] = 'admin_dashboard.php';
            } else {
                $data['redirect'] = 'dashboard.php';
            }

            // set last-login to current date/time;

        } else {
            $data['login'] = false;
            $data['user'] = true;
            $data['message'] = "Login Incorrect";
        }
    }
} else {
    // no user with that name
    $data['login'] = false;
    $data['user'] = false;
    $data['message'] = "Not a registered user, please <a href='register.php'>Register</a>";
}
echo json_encode($data);

?>
