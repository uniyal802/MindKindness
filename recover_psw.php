<?php session_start() ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <title>Rest-Password Form</title>
    <link href="css/resest_password.css" rel="stylesheet" type="text/css">
</head>
<body>    
<style>
        body{
            background: url("img/password.jpg");
        }
        </style>        
    <div id="form">
    <h1>Recover Password</h1>
    <hr class="style1">
    <br> <form action="" method="POST" >
<div>
         <input type="text" id="email_address" class="form-control" name="username" placeholder = "Enter email address" required autofocus>
                                
                            </div>

                            <br>
                                <button type="submit" value="Recover" name="recover">Recover</button>
                            </div> 
                      
                            </div>
                    </div>
                    </form>
                </div>
                    
                </body>
</html>
<?php 
    if(isset($_POST["recover"])){
        include('config.php');
        $username = $_POST['username'];

        $sql = mysqli_query($conn, "SELECT * FROM register WHERE username ='$username'");
        $query = mysqli_num_rows($sql);
  	    $fetch = mysqli_fetch_assoc($sql);

        if(mysqli_num_rows($sql) <= 0){
            ?>
            <script>
                alert("<?php  echo "Sorry, no username exists "?>");
            </script>
           
           <?php
        }else{
            // generate token by binaryhexa 
            $otp = rand(100000,999999);
                    $_SESSION['otp'] = $otp;
                    $_SESSION['mail'] = $username;
                    require "login-system-main/Mail/phpmailer/PHPMailerAutoload.php";
                    $mail = new PHPMailer;
    
                    $mail->isSMTP();
                    $mail->Host='smtp.gmail.com';
                    $mail->Port=587;
                    $mail->SMTPAuth=true;
                    $mail->SMTPSecure='tls';
    
                    $mail->Username='mycrm2022@gmail.com';
                    $mail->Password='Gendustem';
    
                    $mail->setFrom('mycrm2022@gmail.com', 'OTP Verification');
                    $mail->addAddress($_POST["username"]);
    
                    $mail->isHTML(true);
                    $mail->Subject="Your verify code";
                    $mail->Body="<p>Dear user, </p> <h3>Your verify OTP code is $otp <br></h3>
                    <br><br>
                    <p>With regrads,</p>
                    <b>CRM</b>
                    https://www.youtube.com/channel/UCKRZp3mkvL1CBYKFIlxjDdg";
    
                            if(!$mail->send()){
                                ?>
                                    <script>
                                        alert("<?php echo " something went wrong, Please try again!!! "?>");
                                    </script>
                                <?php
                            }else{
                                ?>
                                <script>
                                    alert("<?php echo " OTP sent to " . $username ?>");
                                    window.location.replace('verification.php');
                                </script>
                              <?php
            }
        }
    }


?>  
                            