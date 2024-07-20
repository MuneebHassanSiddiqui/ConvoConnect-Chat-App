<?php session_start();
if (!isset($_SESSION['unique_id'])) {
  header("location: login.php");
}
?>
<?php include_once "header.php";
?>
<style>
  body {
    background-image: url('blue-pink-20-pct.png');
    background-size: cover;
    background-repeat: no-repeat;
  }

  .users {
    background: #1A1B25;
    color: #e0e0e0;
    font-family: Arial, sans-serif;
    overflow: hidden;
  }

  .content .details span {
    color: #e0e0e0;
  }

  .content .details p {
    color: #ccc;
  }

  .status-dot {
    color: #ccc;
  }

  .users {
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 10);
  }

  @keyframes slideIn {
    0% {
      transform: translateY(-50px);
      opacity: 0;
    }

    100% {
      transform: translateY(0);
      opacity: 1;
    }
  }

  h1 {
    color: #fff;
    /* White text color */
    padding: 20px;
    text-align: center;
    font-family: 'Satisfy', cursive;
    /* Google Font */
    font-size: 30px;
    position: relative;
    /* Add relative positioning */
    animation: slideIn 0.4s ease forwards;
    /* Slide in animation */

  }
</style>

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap">

<body>
  <div class="wrapper">
    <section class="users">
      <H1>ConvoConnect | chat App</H1>
      <header>
        <?php
        include "php/config.php";
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = '{$_SESSION['unique_id']}'");
        if (mysqli_num_rows($sql)) {
          $row = mysqli_fetch_assoc($sql);
        }
        ?>
        <div class="content">
          <img src="php/imagesfolder/<?php echo $row['img'] ?>" />
          <div class="details">
            <span><?php echo $row['fname'] . " " . $row['lname'] ?></span>
            <p><?php echo $row['status']   ?></p>
          </div>
        </div>
        <a href="php/logout.php?logout_id=<?php echo $row['unique_id'] ?>" class="logout">Logout</a>
      </header>
      <div class="search">
        <span class="text"> Select an user To start chat </span>
        <input type="text" placeholder="Enter name to search....." />
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="user-list">


      </div>
    </section>
  </div>
  <script src="javascript/search.js"></script>
  <script src="javascript/users.js"></script>
</body>

</html>