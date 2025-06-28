<?php
include('connection.php');
 $username = "";
    if(isset($_POST["reset"])){
        // include('config.php');
        $psw = $_POST["password"];

        // $token = $_SESSION['token'];
        $username = $_POST['username'];

        $hash = password_hash( $psw , PASSWORD_DEFAULT );

        $sql = mysqli_query($conn, "SELECT * FROM register WHERE username='$username'");
        $query = mysqli_num_rows($sql);
  	    $fetch = mysqli_fetch_assoc($sql);

        if($username){
            $new_pass = $hash;
            mysqli_query($conn, "UPDATE register SET password='$new_pass' WHERE username='$username' ");
            ?>
            <script>
                window.location.replace("login_page.php");
                alert("<?php echo "your password has been succesfully reset"?>");
            </script>
            <?php
        }else{
            ?>
            <script>
                alert("<?php echo "Please try again"?>");
            </script>
            <?php
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password page</title>
</head>
<body>
    <h1>MindKindness </h1>   
    <h3>Change Password</h3>  
    <div class="mainDiv">
        <div class="cardStyle">                          
    <form action="" method="post" >

        <div class="box">
            <br>
    Email-Id: <input type="email" name="username">
    </div>

    <div class="box">
            <br>
    New Password: <input type="password" name="password">
    </div>

    <div class="box"> <br>
    Confirm Password: <input type="password" name="cpassword">
   </div>
   <div>
       <br>
       <div class="buttonWrapper">
        <button type="submit" id="submitButton1"  class="submitButton" name="reset">
          <span>Confirm</span>
        </button>
      </div>
    </div>
</form>
        </div>
    </div>
<style>
body{
    background: url("img/15_mei_8.jpg");
    background-repeat: no-repeat;
    background-size: cover;
    background-attachment: fixed;
    background-position: center ;
   }
.mainDiv {
    display: flex;
    min-height: 100%;
    align-items: center;
    justify-content: center;
  }
 .cardStyle {
    width: 500px;
    height: 250px;
    border-color: white;
    background:white;
    padding: 36px 0;
    border-radius: 4px;
    margin: 30px 0;
  }

  .box {
    font-family: Georgia, 'Times New Roman', Times, serif;
    width: 70%;
    display: flex;
    flex-direction: column;
    margin: auto;
  }

  h1{position: relative;
   color:black;
   /* align-items: center; */
     text-align:center;
     /* justify-content: center; */
    font-size: 40px;
    /* display: flex; */
    font-family: Georgia, 'Times New Roman', Times, serif;
    color:black;
}

  h3{
  font-size: 30px;
  font-family: Georgia, 'Times New Roman', Times, serif;
  margin-top: 20px;
  color:black;
  text-align: center;
}

.buttonWrapper {
  margin-top: 30px;
}
  .submitButton {
    width: 70%;
    height: 40px;
    margin: auto;
    display: block;
    color: black;
    background-color:lightpink;
    border-color:black;
    border-radius: 4px;
    font-family: Georgia, 'Times New Roman', Times, serif;
    font-size: 18px;
    cursor: pointer;
  }

</style>
</body>
</html>