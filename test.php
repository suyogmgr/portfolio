
<?php



    $host = "localhost";
    $user = "randai";
    $pass = "@Suyog123";
    $db_name = "portfolio";
    $conn = "";

    $conn = mysqli_connect($host, $user, $pass, $db_name);

    if(!$conn){
        echo "Connection Falied";
    }
    
    
  session_start();

$username = $email = $msg = '';
$username_err = $email_err = $msg_err = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $username =  trim(filter_input(INPUT_POST, "username", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
  $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
  $msg = trim(filter_input(INPUT_POST, "message", FILTER_SANITIZE_FULL_SPECIAL_CHARS));


  // Name Validation
  if (!$username) { //also handeles cases for flase filter input()
    $username_err = "Username is required";
  } else  if (strlen($username) < 3) {
    $username_err = "Username must be at least 3 char long";
  }


  // Email Validation

  if (empty(trim($email))) {
    $email_err = "Emalil is required";
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $email_err = "Valid email required";
  } else {
    $email = trim($email);
  }


  // Message Verification 

  if(!$msg){
    $msg_err = "Message is required";
  }else if(strlen($msg) < 8){
    $msg_err = "Message must be 8 characters long";
  }


  if(empty($username_err) && empty($email_err) && empty($msg)){
    $sql = "INSERT INTO users(user, email, message) VALUES(?, ?, ?)";

    try{

      $stmt = mysqli_prepare($conn, $sql);
      if(!$stme){
        die('SQL error:' . mysqli_error($conn));
      }

      mysqli_stmt_bind_param($stmt, "sss", $username, $email, $msg);
      mysqli_stmt_execute($stmt);

      // session_destroy();
      $_SERVER = []; // unset insted destroy
    }catch(mysqli_sql_exception $e){
      echo "Something went wrong: ". $e->getMessage(); 
    }
  }

  mysqli_close($conn);

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Suyog Rana Magar-BSc.CSIT</title>
  <link rel="stylesheet" href="style.css">
  <link rel="icon" href="./assets/logo.png">
  <script type="text/JavaScript" src="script.js" defer></script>
  <style>

.contact-section{
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  margin: 2em;
}

.contact-form{
  background-color: #1a191c;
  height: 480px;
  width: 400px;
  padding: 2em;
  border-radius: 10px;
  position: relative;
}

.contact-form::after, .contact-form::before{
  content: '';
  background: conic-gradient(rgb(0, 255, 234), rgb(0, 255, 200));
  position: absolute;
  width: 100%;
  height: 100%;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  border-radius: 10px;
  padding: 5px;
  z-index: -1;
}

.contact-form::before{
  filter: blur(1.5em);
  opacity: 0.2;
}

.form{
  display: flex;
  flex-direction: column;
}

.form span{
  color: red;
}

.form label{
  font-size: 1em;
  color: var(--text-clr);
}

.form input{
  color: var(--text-clr);
  padding: .6em;
  border-radius: 5px;
  outline: none;
  border: 1px solid var(--line-clr);
  background-color: #3d3737;
  margin: 1em 0;
}

.form input:focus{
  border: 1px solid #c74141;
}

#message{
  padding: 4em 0;
}

.submit-btn{
  display: flex;
  justify-content: center;
  align-items: center;
  margin: 1em;
}

.submit-btn input{
  padding: .85em 1.2em;
  font-weight: 500;
  outline: none;
  border: none;
  font-size: 1em;
  letter-spacing: 1px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
  transition: 300ms ease;
}

.submit-btn input:hover{
  background-color: var(--hover-clr);
}

  </style>
</head>

<body>
  <div class="root">
    <div class="grid-cont">
     
      <!-- NAVBAR -->
     
      <!--MAINAREA-->
      <main>
        <!-- CONTACE ME -->
        <div id="contact" class="contact-section">
          <div class="title">
            <h1>Message Me</h1>
          </div>
          <div class="contact-form">
            <form class="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
              <label for="username">Full Name<span>*</span></label>
              <input type="text" id="username" value="<?php echo $username; ?>" required>
              <span><?php echo $username_err; ?></span>

              <label for="email">Email Address<span>*</span></label>
              <input type="email" id="email" value="<?php echo $email; ?>" required>
              <span><?php echo $email_err; ?></span>

              <label for="message">Message<span>*</span></label>
              <input type="text" id="message" value="<?php echo $msg; ?>" required>
              <span><?php echo $msg; ?></span>

              <div class="submit-btn">
                <input type="submit" name="submit" value="submit">
              </div>
            </form>
          </div>
        </div>
      </main>

    </div>
  </div>
</body>

</html>