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


  .form,
  .field {
    /* background: #1A1B25;
     */
    background-image: url('background.jpg');
    background-size: cover;
    background-repeat: no-repeat;
    color: #e0e0e0;
    font-family: Arial, sans-serif;
    overflow: hidden;
  }

  .form.signup {
    /* background-color: #1A1B25;
     */
    background-image: url('background.jpg');
    box-shadow: 0 0 20px rgba(0, 0, 0, 10);
    border-radius: 10px;

  }

  .form.signup header {
    color: #e0e0e0;
  }

  .form.signup label {
    color: #e0e0e0;
  }

  .form.signup input[type="text"],
  .form.signup input[type="password"],
  .form.signup input[type="file"] {
    background-color: #222;
    color: #fff;
    border: 1px solid #444;
  }

  .form.signup input[type="submit"] {
    background-color: #007bff;
    color: #fff;
    border: none;
  }

  .form.signup input[type="submit"]:hover {
    background-color: #0056b3;
  }

  .form.signup .link {
    color: #fff;
  }

  .form.signup .link a {
    color: #007bff;
    text-decoration: none;
  }

  .form.signup .link a:hover {
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
    font-size: 40px;
    animation: fadeIn 0.8s ease;
    /* Changed animation duration to 0.8s */
  }
</style>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap">

<body>
  <div class="wrapper">
    <section class="form signup">
      <header>ConvoConnect | chat App</header>
      <form action="php/signup.php" method="post" enctype="multipart/form-data">
        <div class="error-text">This is error msg!!!</div>
        <div class="name-details">
          <div class="field input">
            <label>First Name</label>
            <input type="text" name="fname" placeholder="First Name" required>
          </div>
          <div class="field input">
            <label>Last Name</label>
            <input type="text" name="lname" placeholder="Last Name" required>
          </div>
        </div>
        <div class="field input">
          <label>Email Adress</label>
          <input type="text" name="email" placeholder="Enter your Email" required>
        </div>
        <div class="field input">
          <label>password</label>
          <input type="password" name="password" placeholder="Enter new password">
          <i class="fas fa-eye"></i>
        </div>
        <div class="field image">
          <label>Select Image</label>
          <input type="file" name="image" required>
        </div>
        <div class="field button">
          <input type="submit" value="continue to chat">
        </div>
      </form>
      <div class="link">Already signed up? <a href="login.php">Login now</a></div>
    </section>
  </div>
  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/signup.js"></script>
</body>

</html>