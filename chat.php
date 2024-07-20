<?php session_start();
if (!isset($_SESSION['unique_id'])) {
  header("location: login.php");
}
?>
<?php include_once "header.php";
?>

<style>
  body {
    /* background: #1A1B25; */
    background-image: url('blue-pink-20-pct.png');
    background-size: cover;
    background-repeat: no-repeat;
    color: #e0e0e0;
    font-family: Arial, sans-serif;
    overflow-y: auto;

  }

  .chat-area {
    box-shadow: 0 0 10px rgba(0, 0, 0, 8);
    background: #1A1B25;
    border-radius: 10px;
  }

  .chat-box {
    background-image: url('background.jpg');
    color: #e0e0e0;
    font-family: Arial, sans-serif;
    overflow-y: auto;
    background-size: cover;
    background-repeat: no-repeat;
  }

  .chat-area header .back-icon {
    color: #fff;
    font-size: 28px;
  }

  .chat-area header .back-icon:hover {
    color: #000;
  }

  .chat-area header .details {
    color: #fff;
  }

  .chat-area .typing-area .input-field {
    border: 1px solid #000;
    background-color: #555;
    border-radius: 30px 0 0 30px;
    color: #fff;
    transition: background-color 1s ease, color 3s ease;

  }

  .chat-area .typing-area .input-field:hover {
    background-color: white;
    color: #000;
    transition: 2ms;

  }

  .chat-area .typing-area button {
    border: none;
    background-color: #333;
    color: white;
    border-radius: 50%;
    transition: background-color 1s ease, color 1s ease;

  }

  .chat-area .typing-area button:hover {
    color: green;
    background-color: white;
  }
</style>

<body>
  <div class="wrapper">
    <section class="chat-area">
      <?php
      include "php/config.php";
      $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
      $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = '$user_id'");
      if (mysqli_num_rows($sql)) {
        $row = mysqli_fetch_assoc($sql);
      }
      ?>
      <header>
        <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img src="php/imagesfolder/<?php echo $row['img'] ?>" style="border-radius: 50px; width:50px;" />

        <div class="details">
          <span><?php echo $row['fname'] . " " . $row['lname'] ?></span>
          <p><?php echo $row['status']   ?></p>
        </div>

      </header>
      <div class="chat-box"></div>
      <form action="php/insert-chat.php" class="typing-area" enctype="multipart/form-data" method="POST" autocomplete="off">
        <input type="text" name="outgoing_id" value="<?php echo $_SESSION['unique_id']; ?>" hidden>
        <input type="text" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="type a message here...">
        <button><i class="fab fa-telegram-plane"></i></button>
        <button id="startRecording"><i class="ri-mic-off-fill mic-icon mic-off"></i></button>
        <button id="stopRecording" disabled><i class="ri-send-plane-2-fill sendCLass"></i></button>
        <audio id="audioPlayback" controls style="display: none;"></audio>
      </form>

    </section>
  </div>
  <script>
    let mediaRecorder;
    let audioChunks = [];

    document.getElementById('startRecording').onclick = async () => {

      let stream = await navigator.mediaDevices.getUserMedia({
        audio: true
      });
      mediaRecorder = new MediaRecorder(stream);
      mediaRecorder.ondataavailable = event => {
        audioChunks.push(event.data);
      };
      mediaRecorder.onstop = () => {
        let audioBlob = new Blob(audioChunks, {
          type: 'audio/wav'
        });
        let audioUrl = URL.createObjectURL(audioBlob);
        document.getElementById('audioPlayback').src = audioUrl;

        let formData = new FormData();
        formData.append('audio', audioBlob, 'recording.wav');

        fetch('php/save-audio.php', {
            method: 'POST',
            body: formData
          }).then(response => response.text())
          .then(data => {
            console.log(data);
            location.reload(); // Reload the page to show the new upload
          })
          .catch(error => console.error('Error:', error));
      };
      mediaRecorder.start();
      document.getElementById('startRecording').disabled = true;
      document.getElementById('stopRecording').disabled = false;
      let micIcon = document.querySelector('.mic-icon');
      micIcon.classList.remove('ri-mic-off-fill', 'mic-off');
      micIcon.classList.add('ri-mic-fill', 'mic-on');

      document.getElementById('stopRecording').onclick = () => {
        mediaRecorder.stop();
        document.getElementById('startRecording').disabled = false;
        document.getElementById('stopRecording').disabled = true;
        audioChunks = [];
        let micIcon = document.querySelector('.mic-icon');
        micIcon.classList.remove('ri-mic-fill', 'mic-on');
        micIcon.classList.add('ri-mic-off-fill', 'mic-off');
      };
    };
  </script>
  <script src="javascript/chat.js"></script>
</body>

</html>