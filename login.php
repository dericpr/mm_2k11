<?php
error_reporting(0);
session_start();
include_once "shared/ez_sql_core.php";
include_once "ez_sql.php";
$db = new ezSQL_mysql('mm_user','yeradeadman232','mm_2k11','localhost');

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
            $_SESSION['f_name'] = $user->f_name;
            $_SESSION['l_name'] = $user->l_name;
            $_SESSION['email'] = $user->email;
            $_SESSION['level'] = $user->access_level;
            $data['login'] = true;
            $data['user'] = true;
            $data['success'] = true;
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
