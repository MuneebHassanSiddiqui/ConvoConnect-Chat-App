<?php
session_start();
if (isset($_SESSION['unique_id'])) {
  header("location: users.php");
} ?>

<?php include_once "header.php";
?>
<style>
  body {
    background-image: url('blue-pink-20-pct.png');
    background-size: cover;
    background-repeat: no-repeat;
  }



  .form {
    background: #1A1B25;
    color: #e0e0e0;
    font-family: Arial, sans-serif;
    overflow: hidden;
  }

  .form.login {
    background-image: url('background.jpg');
    background-size: cover;
    background-repeat: no-repeat;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 10);
  }

  .form.login header {
    color: #fff;
    font-size: 24px;
    margin-bottom: 20px;
  }

  .form.login label {
    color: #fff;
  }

  .form.login input[type="text"],
  .form.login input[type="password"] {
    background-color: #222;
    color: #fff;
    border: 1px solid #444;
    border-radius: 5px;
    padding: 10px;
    margin-bottom: 10px;
    width: 100%;
  }

  .form.login input[type="submit"] {
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 10px;
    cursor: pointer;
    width: 100%;
  }

  .form.login input[type="submit"]:hover {
    background-color: #0056b3;
  }

  .form.login .link {
    margin-top: 20px;
    color: #fff;
  }

  .form.login .link a {
    color: #007bff;
    text-decoration: none;
  }

  .form.login .link a:hover {
    text-decoration: underline;
  }

  @keyframes fadeIn {
    0% {
      opacity: 0;
      transform: translateY(-10px);
    }

    100% {
      opacity: 1;
      transform: translateY(0);
    }
  }

  header {
    color: white;
    padding: 20px;
    text-align: center;
    font-family: 'Satisfy', cursive;
    /* Google Font */
    font-size: 36px;
    animation: fadeIn 0.8s ease;
    /* Changed animation duration to 0.8s */
  }
</style>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap">


<body>
  <div class="wrapper">
    <section class="form login">
      <header>ConvoConnect | chat App</header>
      <form action="#">
        <div class="error-text"></div>
        <div class="name-details">
        </div>
        <div class="field input">
          <label>Email Adress</label>
          <input type="text" name="email" placeholder="Enter your Email" />
        </div>
        <div class="field input">
          <label>password</label>
          <input type="password" name="password" placeholder="Enter your password" />
          <i class="fas fa-eye" style="color: #fff;  bottom: -8px;"></i>


        </div>

        <div class="field button">
          <input type="submit" value="continue to chat" />
        </div>
      </form>
      <div class="link">Not yet signed up? <a href="index.php">Singup now</a></div>
    </section>
  </div>
  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/login.js"></script>

</body>

</html>