<?php 
session_start();
require_once("config.php");
$username = $_POST['username'];
//echo "username is". $username;

$login_statement = $conn->prepare("SELECT id,username FROM login WHERE  username = ?");
$login_statement->bind_param('s',$username); 
$login_statement->execute();
$login_statement->bind_result($id, $username);
$login_statement->store_result();
if($login_statement->num_rows > 0)  //To check if the row exists
        {
        $login_statement->fetch();
        $ematched ='email_matched';
        echo $ematched; //for sending response in ajax field so redirect to dashboard
        
            //header("location:dashboard.php");
         if(isset($_POST['user_password'])){
           $ematched = "";
            $user_password = md5($_POST['user_password']);

            $login_statement1 = $conn->prepare("SELECT id,username,user_password FROM login WHERE  username = ? AND user_password = ?");
$login_statement1->bind_param('ss',$username,$user_password); 
$login_statement1->execute();
$login_statement1->bind_result($id, $username,$user_password);
$login_statement1->store_result();
if($login_statement1->num_rows > 0) {
      $login_statement1->fetch();
     echo 'Login';
        $_SESSION['username'] = $username;
         $_SESSION['userid'] = $id;


}
 else {
        echo "password_not_matched";
        
    }

         }
         
           

    }
    else {
        echo "email_not_matched";
        
    }
    $login_statement->close();


?>