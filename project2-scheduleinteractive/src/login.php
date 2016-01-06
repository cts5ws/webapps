
<div style="text-align: center;">--enter your credentials to login to the scheduling system--</div>
<p></p>

<?php

session_start();

if(isset($_SESSION["error"])){
    $error_message = $_SESSION['error'];
    echo "<div style='text-align: center'> $error_message</div>";
}
echo "<div style=\"text-align: center;\">
        <form method='POST' action='handle_login.php'>
         <p><input name='email' placeholder='email'>
           <input name='password' type='password' placeholder='password'></p>
           <a href='forgot_login_info.php'> Forgot Password </a>
         <p><input type='submit'></p>
        </form>
       </div>";
?>