<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Murder Mystery Party - 2011</title>
         <script src="jquery.js"></script>
    </head>
    <?php
    include_once "shared/ez_sql_core.php";
    include_once "ez_sql.php";
    $db = new ezSQL_mysql('mm_user','yeradeadman232','mm_2k11','localhost');
    ?>
    <body>
        <a href="http://jquery.com/">jQuery</a>
        <script>
         $(document).ready(function(){
           $("a").click(function(event){
             alert("Is Git working?");
             event.preventDefault();
           });
         });
        </script>
        <?php
        print("HEYLOOOOO");
        print("<BR>");
        print("Quick DB test<BR>");
        $users = $db->get_results("SELECT * FROM user");
	foreach ( $users as $user )
        {
            // Access data using object syntax
            echo "First Name : ". $user->f_name;
            echo "Last Name : ". $user->l_name;
            echo "Email : ". $user->email;
        }
        ?>
    </body>
</html>
