<?php

// session_start();

// require("db.php");

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

  if (!$msg) {
    $msg_err = "Message is required";
  } else if (strlen($msg) < 8) {
    $msg_err = "Message must be 8 characters long";
  }


  if (empty($username_err) && empty($email_err) && empty($msg_err)) {
    $sql = "INSERT INTO users (user, email, msg) VALUES (?, ?, ?)";

    try {

      // $stmt = mysqli_prepare($conn, $sql);
      $stmt = mysqli_prepare($conn, $sql);
      if ($stmt === false) {
        die('SQL error: ' . mysqli_error($conn));
      }
      mysqli_stmt_bind_param($stmt, "sss", $username, $email, $msg);
      mysqli_stmt_execute($stmt);

      session_destroy();
      //$_SERVER = []; unset insted destroy
    } catch (mysqli_sql_exception $e) {
      echo "Something went wrong: " . $e->getMessage();
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
</head>

<body>
  <div class="root">
    <div class="grid-cont">
      <!-- SIDEBAR -->
      <!-- <aside id="sidebar">
          <ul>
              <li>
                <div class="toggle">
                  <button id="toggle-btn" onclick="toggleSidebar()">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M440-240 200-480l240-240 56 56-183 184 183 184-56 56Zm264 0L464-480l240-240 56 56-183 184 183 184-56 56Z"/></svg>
                  </button>
                </div>
              </li>
      
              <li>
                <div class="prof">
                  <img width="150px" src="../assets/__zani_wuthering_waves_drawn_by_elyzerda__b8e0d2f917970cfeb9a38022f55f9ae1.jpg" alt="prof-img">
                </div>
                <div class="prof-text">
                  <h2>SUYOG RANA MAGAR</h2>
                  <span>
                    Web Designer & Developer
                    Excited abou creating 
                    beautiful and functional
                    designs.
                  </span>
                </div>
              </li>
      
              <li>
                <button class="dropdown" id="dropdown" onclick="toggleMenu(this)">
                  <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="m300-300 280-80 80-280-280 80-80 280Zm180-120q-25 0-42.5-17.5T420-480q0-25 17.5-42.5T480-540q25 0 42.5 17.5T540-480q0 25-17.5 42.5T480-420Zm0 340q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q133 0 226.5-93.5T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 133 93.5 226.5T480-160Zm0-320Z"/></svg>
                  <span>Explore</span>
                  <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M480-344 240-584l56-56 184 184 184-184 56 56-240 240Z"/></svg>
                </button>
                <ul class="submenu">
                  <div>
                    <li>
                      <a href="#">Projects</a>
                      <a href="#">About</a>
                      <a href="#">Contact</a>
                    </li>
                  </div>
                </ul>
              </li>
      
              <li>
                <button id="dropdown" onclick="toggleMenu(this)">
                  <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M240-80v-172q-57-52-88.5-121.5T120-520q0-150 105-255t255-105q125 0 221.5 73.5T827-615l52 205q5 19-7 34.5T840-360h-80v120q0 33-23.5 56.5T680-160h-80v80h-80v-160h160v-200h108l-38-155q-23-91-98-148t-172-57q-116 0-198 81t-82 197q0 60 24.5 114t69.5 96l26 24v208h-80Zm254-360Zm-54 80h80l6-50q8-3 14.5-7t11.5-9l46 20 40-68-40-30q2-8 2-16t-2-16l40-30-40-68-46 20q-5-5-11.5-9t-14.5-7l-6-50h-80l-6 50q-8 3-14.5 7t-11.5 9l-46-20-40 68 40 30q-2 8-2 16t2 16l-40 30 40 68 46-20q5 5 11.5 9t14.5 7l6 50Zm40-100q-25 0-42.5-17.5T420-520q0-25 17.5-42.5T480-580q25 0 42.5 17.5T540-520q0 25-17.5 42.5T480-460Z"/></svg>
                  <span>Skills</span>
                  <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M480-344 240-584l56-56 184 184 184-184 56 56-240 240Z"/></svg>
                </button>
                <ul class="submenu">
                  <div>
                    <li>
                      <a href="#">Placeholder</a>
                      <a href="#">Placeholder</a>
                      <a href="#">Placeholder</a>
                      <a href="#">Placeholder</a>
                    </li>
                  </div>
                </ul>
              </li>
      
              <li>
                <div class="connect-con">
                  <span>Let's Connect</span>
                </div>
                <div class="connect">
                  <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 0 50 50"
                  >
                    <path
                      d="M41,4H9C6.24,4,4,6.24,4,9v32c0,2.76,2.24,5,5,5h32c2.76,0,5-2.24,5-5V9C46,6.24,43.76,4,41,4z M17,20v19h-6V20H17z M11,14.47c0-1.4,1.2-2.47,3-2.47s2.93,1.07,3,2.47c0,1.4-1.12,2.53-3,2.53C12.2,17,11,15.87,11,14.47z M39,39h-6c0,0,0-9.26,0-10c0-2-1-4-3.5-4.04h-0.08C27,24.96,26,27.02,26,29c0,0.91,0,10,0,10h-6V20h6v2.56c0,0,1.93-2.56,5.81-2.56c3.97,0,7.19,2.73,7.19,8.26V39z"
                    />
                  </svg></a>
                  <a href="#"><svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title>GitHub</title><path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"/></svg></a>
                  <a href="#"><svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title>Facebook</title><path d="M9.101 23.691v-7.98H6.627v-3.667h2.474v-1.58c0-4.085 1.848-5.978 5.858-5.978.401 0 .955.042 1.468.103a8.68 8.68 0 0 1 1.141.195v3.325a8.623 8.623 0 0 0-.653-.036 26.805 26.805 0 0 0-.733-.009c-.707 0-1.259.096-1.675.309a1.686 1.686 0 0 0-.679.622c-.258.42-.374.995-.374 1.752v1.297h3.919l-.386 2.103-.287 1.564h-3.246v8.245C19.396 23.238 24 18.179 24 12.044c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.628 3.874 10.35 9.101 11.647Z"/></svg></a>
                  <a href="#"><svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title>Instagram</title><path d="M7.0301.084c-1.2768.0602-2.1487.264-2.911.5634-.7888.3075-1.4575.72-2.1228 1.3877-.6652.6677-1.075 1.3368-1.3802 2.127-.2954.7638-.4956 1.6365-.552 2.914-.0564 1.2775-.0689 1.6882-.0626 4.947.0062 3.2586.0206 3.6671.0825 4.9473.061 1.2765.264 2.1482.5635 2.9107.308.7889.72 1.4573 1.388 2.1228.6679.6655 1.3365 1.0743 2.1285 1.38.7632.295 1.6361.4961 2.9134.552 1.2773.056 1.6884.069 4.9462.0627 3.2578-.0062 3.668-.0207 4.9478-.0814 1.28-.0607 2.147-.2652 2.9098-.5633.7889-.3086 1.4578-.72 2.1228-1.3881.665-.6682 1.0745-1.3378 1.3795-2.1284.2957-.7632.4966-1.636.552-2.9124.056-1.2809.0692-1.6898.063-4.948-.0063-3.2583-.021-3.6668-.0817-4.9465-.0607-1.2797-.264-2.1487-.5633-2.9117-.3084-.7889-.72-1.4568-1.3876-2.1228C21.2982 1.33 20.628.9208 19.8378.6165 19.074.321 18.2017.1197 16.9244.0645 15.6471.0093 15.236-.005 11.977.0014 8.718.0076 8.31.0215 7.0301.0839m.1402 21.6932c-1.17-.0509-1.8053-.2453-2.2287-.408-.5606-.216-.96-.4771-1.3819-.895-.422-.4178-.6811-.8186-.9-1.378-.1644-.4234-.3624-1.058-.4171-2.228-.0595-1.2645-.072-1.6442-.079-4.848-.007-3.2037.0053-3.583.0607-4.848.05-1.169.2456-1.805.408-2.2282.216-.5613.4762-.96.895-1.3816.4188-.4217.8184-.6814 1.3783-.9003.423-.1651 1.0575-.3614 2.227-.4171 1.2655-.06 1.6447-.072 4.848-.079 3.2033-.007 3.5835.005 4.8495.0608 1.169.0508 1.8053.2445 2.228.408.5608.216.96.4754 1.3816.895.4217.4194.6816.8176.9005 1.3787.1653.4217.3617 1.056.4169 2.2263.0602 1.2655.0739 1.645.0796 4.848.0058 3.203-.0055 3.5834-.061 4.848-.051 1.17-.245 1.8055-.408 2.2294-.216.5604-.4763.96-.8954 1.3814-.419.4215-.8181.6811-1.3783.9-.4224.1649-1.0577.3617-2.2262.4174-1.2656.0595-1.6448.072-4.8493.079-3.2045.007-3.5825-.006-4.848-.0608M16.953 5.5864A1.44 1.44 0 1 0 18.39 4.144a1.44 1.44 0 0 0-1.437 1.4424M5.8385 12.012c.0067 3.4032 2.7706 6.1557 6.173 6.1493 3.4026-.0065 6.157-2.7701 6.1506-6.1733-.0065-3.4032-2.771-6.1565-6.174-6.1498-3.403.0067-6.156 2.771-6.1496 6.1738M8 12.0077a4 4 0 1 1 4.008 3.9921A3.9996 3.9996 0 0 1 8 12.0077"/></svg></a>
                </div>
              </li>
      
              <li>
                <div class="connect-con">
                  <span>Contact Me</span>
                  <p>mgrsuyog6@gmail.com</p>
                  <p>Phone: 9788888888</p>
                </div>
              </li>
          </ul>
        </aside> -->

      <!-- NAVBAR -->
      <nav>
        <div class="nav-text">
          <h1 class="logo">SUYOG<span style="color: #fff;">.</span></h1>
        </div>

        <div class="nav-links">
          <ul>
            <li><a href="#">H</a></li>
            <li><a href="#">A</a></li>
            <li><a href="#">P</a></li>
            <li><a href="#">E</a></li>
            <li><a href="#">C</a></li>
          </ul>
        </div>
      </nav>

      <!--MAINAREA-->
      <main>
        <!-- HOME SECTION -->

        <div id="home" class="hero-content">
          <div class="text">
            <div class="location">
              <span>
                BASED IN KATHMANDU, NEPAL
              </span>
            </div>
            <div class="hero-title">
              <div class="title-letter">C</div>
              <div class="title-letter">S</div>
              <div class="title-letter">&nbsp;</div>
              <div class="title-letter">S</div>
              <div class="title-letter">T</div>
              <div class="title-letter">U</div>
              <div class="title-letter">D</div>
              <div class="title-letter">E</div>
              <div class="title-letter">N</div>
              <div class="title-letter">T</div>
            </div>
            <div class="hero-subtitle">
              <span>
                Hi, I'm Suyog Rana Magar
                A student at St.Lawrence college currently studying BSc.CSIT.
              </span>
            </div>
          </div>
          <div class="hero-btn">
            <a href="#" class="resume">Download Resume</a>
          </div>
          <div class="social-icons">
            <a href="#" data-socials="Instagram" style="--accent-icon: #ff0069">
              <svg
                role="img"
                viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <title>Instagram</title>
                <path
                  d="M7.0301.084c-1.2768.0602-2.1487.264-2.911.5634-.7888.3075-1.4575.72-2.1228 1.3877-.6652.6677-1.075 1.3368-1.3802 2.127-.2954.7638-.4956 1.6365-.552 2.914-.0564 1.2775-.0689 1.6882-.0626 4.947.0062 3.2586.0206 3.6671.0825 4.9473.061 1.2765.264 2.1482.5635 2.9107.308.7889.72 1.4573 1.388 2.1228.6679.6655 1.3365 1.0743 2.1285 1.38.7632.295 1.6361.4961 2.9134.552 1.2773.056 1.6884.069 4.9462.0627 3.2578-.0062 3.668-.0207 4.9478-.0814 1.28-.0607 2.147-.2652 2.9098-.5633.7889-.3086 1.4578-.72 2.1228-1.3881.665-.6682 1.0745-1.3378 1.3795-2.1284.2957-.7632.4966-1.636.552-2.9124.056-1.2809.0692-1.6898.063-4.948-.0063-3.2583-.021-3.6668-.0817-4.9465-.0607-1.2797-.264-2.1487-.5633-2.9117-.3084-.7889-.72-1.4568-1.3876-2.1228C21.2982 1.33 20.628.9208 19.8378.6165 19.074.321 18.2017.1197 16.9244.0645 15.6471.0093 15.236-.005 11.977.0014 8.718.0076 8.31.0215 7.0301.0839m.1402 21.6932c-1.17-.0509-1.8053-.2453-2.2287-.408-.5606-.216-.96-.4771-1.3819-.895-.422-.4178-.6811-.8186-.9-1.378-.1644-.4234-.3624-1.058-.4171-2.228-.0595-1.2645-.072-1.6442-.079-4.848-.007-3.2037.0053-3.583.0607-4.848.05-1.169.2456-1.805.408-2.2282.216-.5613.4762-.96.895-1.3816.4188-.4217.8184-.6814 1.3783-.9003.423-.1651 1.0575-.3614 2.227-.4171 1.2655-.06 1.6447-.072 4.848-.079 3.2033-.007 3.5835.005 4.8495.0608 1.169.0508 1.8053.2445 2.228.408.5608.216.96.4754 1.3816.895.4217.4194.6816.8176.9005 1.3787.1653.4217.3617 1.056.4169 2.2263.0602 1.2655.0739 1.645.0796 4.848.0058 3.203-.0055 3.5834-.061 4.848-.051 1.17-.245 1.8055-.408 2.2294-.216.5604-.4763.96-.8954 1.3814-.419.4215-.8181.6811-1.3783.9-.4224.1649-1.0577.3617-2.2262.4174-1.2656.0595-1.6448.072-4.8493.079-3.2045.007-3.5825-.006-4.848-.0608M16.953 5.5864A1.44 1.44 0 1 0 18.39 4.144a1.44 1.44 0 0 0-1.437 1.4424M5.8385 12.012c.0067 3.4032 2.7706 6.1557 6.173 6.1493 3.4026-.0065 6.157-2.7701 6.1506-6.1733-.0065-3.4032-2.771-6.1565-6.174-6.1498-3.403.0067-6.156 2.771-6.1496 6.1738M8 12.0077a4 4 0 1 1 4.008 3.9921A3.9996 3.9996 0 0 1 8 12.0077" />
              </svg>
            </a>
            <a href="#" data-socials="GitHub" style="--accent-icon: #232121;">
              <svg
                role="img"
                viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <title>GitHub</title>
                <path
                  d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12" />
              </svg>
            </a>
            <a href="#" data-socials="LinkedIn" style="--accent-icon: #0288d1">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink"
                viewBox="0 0 50 50">
                <path
                  d="M41,4H9C6.24,4,4,6.24,4,9v32c0,2.76,2.24,5,5,5h32c2.76,0,5-2.24,5-5V9C46,6.24,43.76,4,41,4z M17,20v19h-6V20H17z M11,14.47c0-1.4,1.2-2.47,3-2.47s2.93,1.07,3,2.47c0,1.4-1.12,2.53-3,2.53C12.2,17,11,15.87,11,14.47z M39,39h-6c0,0,0-9.26,0-10c0-2-1-4-3.5-4.04h-0.08C27,24.96,26,27.02,26,29c0,0.91,0,10,0,10h-6V20h6v2.56c0,0,1.93-2.56,5.81-2.56c3.97,0,7.19,2.73,7.19,8.26V39z" />
              </svg>
            </a>
          </div>
        </div>

        <!-- ABOUT SECTION -->
        <div class="about-section" id="about">
          <div class="title">
            <h1>About Me</h1>
            <div class="about-me-section">
              <div class="profile">
                <img src="./assets/suyog 2.jpg" alt="profole-picture" loading="lazy">
              </div>
              <div class="about-text">
                <p>Hi, I'm Suyog Rana Magar</p>
                <span>
                  A developer with experience in building projects using vanilla <strong>JavaScript, CSS, HTML, PHP, Python, and Java</strong>. I enjoy crafting clean, efficient code and bringing ideas to life through well-structured and functional applications.
                  With a strong foundation in both frontend and backend development, I focus on creating seamless user experiences while optimizing performance. Whether it's designing dynamic web applications, working with databases, or solving complex programming challenges,
                  I'm always eager to learn and improve my skills.
                  <br><strong>Let's connect and build something amazing!</strong>
                </span>
              </div>
            </div>
          </div>

        </div>

        <!-- SKILLS SECTION -->
        <div id="skills" class="skills-section">
          <div class="title">
            <h1>My Skills</h1>
          </div>

          <div class="skills-content-des">
            <span>I have experience working on projects using the following programming languages.</span>
          </div>

          <div class="skills-item">
            <div data-socials="HTML5" style="--accent-icon:#E34F26;" class="item">
              <svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <title>HTML5</title>
                <path d="M1.5 0h21l-1.91 21.563L11.977 24l-8.564-2.438L1.5 0zm7.031 9.75l-.232-2.718 10.059.003.23-2.622L5.412 4.41l.698 8.01h9.126l-.326 3.426-2.91.804-2.955-.81-.188-2.11H6.248l.33 4.171L12 19.351l5.379-1.443.744-8.157H8.531z" />
              </svg>
              <div class="lang">
                <h2>HTML5</h2>
                <span>Markup Language</span>
              </div>
            </div>

            <div data-socials="CSS" style="--accent-icon:#663399;" class="item">
              <svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <title>CSS</title>
                <path d="M0 0v20.16A3.84 3.84 0 0 0 3.84 24h16.32A3.84 3.84 0 0 0 24 20.16V3.84A3.84 3.84 0 0 0 20.16 0Zm14.256 13.08c1.56 0 2.28 1.08 2.304 2.64h-1.608c.024-.288-.048-.6-.144-.84-.096-.192-.288-.264-.552-.264-.456 0-.696.264-.696.84-.024.576.288.888.768 1.08.72.288 1.608.744 1.92 1.296q.432.648.432 1.656c0 1.608-.912 2.592-2.496 2.592-1.656 0-2.4-1.032-2.424-2.688h1.68c0 .792.264 1.176.792 1.176.264 0 .456-.072.552-.24.192-.312.24-1.176-.048-1.512-.312-.408-.912-.6-1.32-.816q-.828-.396-1.224-.936c-.24-.36-.36-.888-.36-1.536 0-1.44.936-2.472 2.424-2.448m5.4 0c1.584 0 2.304 1.08 2.328 2.64h-1.608c0-.288-.048-.6-.168-.84-.096-.192-.264-.264-.528-.264-.48 0-.72.264-.72.84s.288.888.792 1.08c.696.288 1.608.744 1.92 1.296.264.432.408.984.408 1.656.024 1.608-.888 2.592-2.472 2.592-1.68 0-2.424-1.056-2.448-2.688h1.68c0 .744.264 1.176.792 1.176.264 0 .456-.072.552-.24.216-.312.264-1.176-.048-1.512-.288-.408-.888-.6-1.32-.816-.552-.264-.96-.576-1.2-.936s-.36-.888-.36-1.536c-.024-1.44.912-2.472 2.4-2.448m-11.031.018c.711-.006 1.419.198 1.839.63.432.432.672 1.128.648 1.992H9.336c.024-.456-.096-.792-.432-.96-.312-.144-.768-.048-.888.24-.12.264-.192.576-.168.864v3.504c0 .744.264 1.128.768 1.128a.65.65 0 0 0 .552-.264c.168-.24.192-.552.168-.84h1.776c.096 1.632-.984 2.712-2.568 2.688-1.536 0-2.496-.864-2.472-2.472v-4.032c0-.816.24-1.44.696-1.848.432-.408 1.146-.624 1.857-.63" />
              </svg>
              <div class="lang">
                <h2>CSS</h2>
                <span>Markup Language</span>
              </div>
            </div>

            <div data-socials="JavaScript" style="--accent-icon:#F7DF1E;" class="item">
              <svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <title>JavaScript</title>
                <path d="M0 0h24v24H0V0zm22.034 18.276c-.175-1.095-.888-2.015-3.003-2.873-.736-.345-1.554-.585-1.797-1.14-.091-.33-.105-.51-.046-.705.15-.646.915-.84 1.515-.66.39.12.75.42.976.9 1.034-.676 1.034-.676 1.755-1.125-.27-.42-.404-.601-.586-.78-.63-.705-1.469-1.065-2.834-1.034l-.705.089c-.676.165-1.32.525-1.71 1.005-1.14 1.291-.811 3.541.569 4.471 1.365 1.02 3.361 1.244 3.616 2.205.24 1.17-.87 1.545-1.966 1.41-.811-.18-1.26-.586-1.755-1.336l-1.83 1.051c.21.48.45.689.81 1.109 1.74 1.756 6.09 1.666 6.871-1.004.029-.09.24-.705.074-1.65l.046.067zm-8.983-7.245h-2.248c0 1.938-.009 3.864-.009 5.805 0 1.232.063 2.363-.138 2.711-.33.689-1.18.601-1.566.48-.396-.196-.597-.466-.83-.855-.063-.105-.11-.196-.127-.196l-1.825 1.125c.305.63.75 1.172 1.324 1.517.855.51 2.004.675 3.207.405.783-.226 1.458-.691 1.811-1.411.51-.93.402-2.07.397-3.346.012-2.054 0-4.109 0-6.179l.004-.056z" />
              </svg>
              <div class="lang">
                <h2>JavaScript</h2>
                <span>Programming Language</span>
              </div>
            </div>

            <div data-socials="Java" style="--accent-icon: #DB380E;" href="#" class="item">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 502.632 502.632">
                <g>
                  <path d="M240.864 269.894s-28.02-53.992-26.985-93.445c0.755-28.193 64.324-56.062 89.281-96.529C328.074 39.431 300.054 0 300.054 0s6.234 29.077-10.376 59.147c-16.609 30.113-77.914 47.779-101.749 99.679s52.935 111.068 52.935 111.068z"></path>
                  <path d="M345.741 105.869s-95.494 36.347-95.494 77.849c0 41.545 25.928 55.027 30.113 68.509 4.142 13.525-7.269 36.347-7.269 36.347s37.361-25.95 31.105-56.062c-6.234-30.113-35.29-39.475-18.659-69.544 15.9-30.75 65.995-67.68 65.995-67.68z"></path>
                  <path d="M230.51 324.748c88.246-3.149 120.43-30.997 120.43-30.997-57.076 15.553-208.654 14.539-209.711 3.128-1.014-11.411 46.701-20.773 46.701-20.773s-74.721 0-80.955 18.68c-6.234 18.68 35.354 32.046 123.536 28.961z"></path>
                  <path d="M358.187 368.494s86.369-18.421 77.827-65.338c-10.354-57.119-70.58-24.936-70.58-24.936s42.602 0 46.722 25.928c4.12 25.928-53.013 64.324-53.013 64.324z"></path>
                  <path d="M315.628 343.601s-21.765 5.716-54.013 9.34c-43.228 4.853-95.494 1.014-99.657-6.256-4.098-7.269 7.269-11.411 7.269-11.411-51.921 12.468-23.512 34.233 37.339 38.418 52.158 3.559 129.791-15.574 129.791-15.574z"></path>
                  <path d="M181.738 388.943s-23.555 0.669-24.936 13.137c-1.359 12.382 14.496 23.512 72.65 26.964 58.133 3.451 98.988-15.898 98.988-15.898l-26.295-15.962s-16.631 3.494-42.236 6.946c-25.626 3.473-78.173-2.783-80.243-7.593-2.07-4.81 2.115-7.549 2.115-7.549z"></path>
                  <path d="M407.994 445.005c8.995-9.707-2.783-17.321-2.783-17.321s4.142 4.853-1.337 10.376c-5.544 5.522-56.084 19.349-137.061 23.512-80.955 4.163-168.856-7.615-171.639-17.99-2.696-10.376 45.018-18.659 45.018-18.659-5.522 0.69-71.96 2.071-74.074 20.082-2.071 17.968 29.056 32.507 153.67 32.507 97.645 0 152.348-22.844 161.3-32.486z"></path>
                  <path d="M359.568 485.817c-54.682 11.044-220.734 4.077-220.734 4.077s107.919 25.626 231.109 4.185c58.888-10.268 62.318-38.763 62.318-38.763s-17.011 23.58-72.693 34.689z"></path>
                </g>
              </svg>
              <div class="lang">
                <h2>Java</h2>
                <span>Programming Language</span>
              </div>
            </div>
            <div data-socials="Python" style="--accent-icon:#3776AB;" class="item">
              <svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <title>Python</title>
                <path d="M14.25.18l.9.2.73.26.59.3.45.32.34.34.25.34.16.33.1.3.04.26.02.2-.01.13V8.5l-.05.63-.13.55-.21.46-.26.38-.3.31-.33.25-.35.19-.35.14-.33.1-.3.07-.26.04-.21.02H8.77l-.69.05-.59.14-.5.22-.41.27-.33.32-.27.35-.2.36-.15.37-.1.35-.07.32-.04.27-.02.21v3.06H3.17l-.21-.03-.28-.07-.32-.12-.35-.18-.36-.26-.36-.36-.35-.46-.32-.59-.28-.73-.21-.88-.14-1.05-.05-1.23.06-1.22.16-1.04.24-.87.32-.71.36-.57.4-.44.42-.33.42-.24.4-.16.36-.1.32-.05.24-.01h.16l.06.01h8.16v-.83H6.18l-.01-2.75-.02-.37.05-.34.11-.31.17-.28.25-.26.31-.23.38-.2.44-.18.51-.15.58-.12.64-.1.71-.06.77-.04.84-.02 1.27.05zm-6.3 1.98l-.23.33-.08.41.08.41.23.34.33.22.41.09.41-.09.33-.22.23-.34.08-.41-.08-.41-.23-.33-.33-.22-.41-.09-.41.09zm13.09 3.95l.28.06.32.12.35.18.36.27.36.35.35.47.32.59.28.73.21.88.14 1.04.05 1.23-.06 1.23-.16 1.04-.24.86-.32.71-.36.57-.4.45-.42.33-.42.24-.4.16-.36.09-.32.05-.24.02-.16-.01h-8.22v.82h5.84l.01 2.76.02.36-.05.34-.11.31-.17.29-.25.25-.31.24-.38.2-.44.17-.51.15-.58.13-.64.09-.71.07-.77.04-.84.01-1.27-.04-1.07-.14-.9-.2-.73-.25-.59-.3-.45-.33-.34-.34-.25-.34-.16-.33-.1-.3-.04-.25-.02-.2.01-.13v-5.34l.05-.64.13-.54.21-.46.26-.38.3-.32.33-.24.35-.2.35-.14.33-.1.3-.06.26-.04.21-.02.13-.01h5.84l.69-.05.59-.14.5-.21.41-.28.33-.32.27-.35.2-.36.15-.36.1-.35.07-.32.04-.28.02-.21V6.07h2.09l.14.01zm-6.47 14.25l-.23.33-.08.41.08.41.23.33.33.23.41.08.41-.08.33-.23.23-.33.08-.41-.08-.41-.23-.33-.33-.23-.41-.08-.41.08z" />
              </svg>
              <div class="lang">
                <h2>Python</h2>
                <span>Programming Language</span>
              </div>
            </div>
            <div data-socials="PHP" style="--accent-icon:#777BB4;" class="item">
              <svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <title>PHP</title>
                <path d="M7.01 10.207h-.944l-.515 2.648h.838c.556 0 .97-.105 1.242-.314.272-.21.455-.559.55-1.049.092-.47.05-.802-.124-.995-.175-.193-.523-.29-1.047-.29zM12 5.688C5.373 5.688 0 8.514 0 12s5.373 6.313 12 6.313S24 15.486 24 12c0-3.486-5.373-6.312-12-6.312zm-3.26 7.451c-.261.25-.575.438-.917.551-.336.108-.765.164-1.285.164H5.357l-.327 1.681H3.652l1.23-6.326h2.65c.797 0 1.378.209 1.744.628.366.418.476 1.002.33 1.752a2.836 2.836 0 0 1-.305.847c-.143.255-.33.49-.561.703zm4.024.715l.543-2.799c.063-.318.039-.536-.068-.651-.107-.116-.336-.174-.687-.174H11.46l-.704 3.625H9.388l1.23-6.327h1.367l-.327 1.682h1.218c.767 0 1.295.134 1.586.401s.378.7.263 1.299l-.572 2.944h-1.389zm7.597-2.265a2.782 2.782 0 0 1-.305.847c-.143.255-.33.49-.561.703a2.44 2.44 0 0 1-.917.551c-.336.108-.765.164-1.286.164h-1.18l-.327 1.682h-1.378l1.23-6.326h2.649c.797 0 1.378.209 1.744.628.366.417.477 1.001.331 1.751zM17.766 10.207h-.943l-.516 2.648h.838c.557 0 .971-.105 1.242-.314.272-.21.455-.559.551-1.049.092-.47.049-.802-.125-.995s-.524-.29-1.047-.29z" />
              </svg>
              <div class="lang">
                <h2>PHP</h2>
                <span>Programming Language</span>
              </div>
            </div>
          </div>
        </div>

        <!-- PROJECTS -->
        <div id="project" class="project-section">
          <div class="title">
            <h1>My Personal Projects</h1>
          </div>
          <div class="project-cont">
            <div class="project-card">
              <div class="project-img">
                <img src="./assets/wallhaven-l855xr_1920x1080.png" alt="project" loading="lazy">
              </div>
              <div class="project-desc">
                <h2>Project Name</h2>
                <span>Project Description</span>
              </div>
              <div class="sub-cont">
                <div class="project-tags">
                  <p>Python</p>
                  <p>CSS</p>
                  <p>HTML5</p>
                </div>
                <div class="project-links">
                  <a href="#" id="code">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3">
                      <path d="M320-240 80-480l240-240 57 57-184 184 183 183-56 56Zm320 0-57-57 184-184-183-183 56-56 240 240-240 240Z" />
                    </svg>
                  </a>
                  <a href="#" id="live">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3">
                      <path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h560v-280h80v280q0 33-23.5 56.5T760-120H200Zm188-212-56-56 372-372H560v-80h280v280h-80v-144L388-332Z" />
                    </svg>
                  </a>
                </div>
              </div>
            </div>
            <div class="project-card">
              <div class="project-img">
                <img src="./assets/wallhaven-l855xr_1920x1080.png" alt="project" loading="lazy">
              </div>
              <div class="project-desc">
                <h2>Project Name</h2>
                <span>Project Description</span>
              </div>
              <div class="sub-cont">
                <div class="project-tags">
                  <p>Python</p>
                  <p>CSS</p>
                  <p>HTML5</p>
                </div>
                <div class="project-links">
                  <a href="#" id="code">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3">
                      <path d="M320-240 80-480l240-240 57 57-184 184 183 183-56 56Zm320 0-57-57 184-184-183-183 56-56 240 240-240 240Z" />
                    </svg>
                  </a>
                  <a href="#" id="live">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3">
                      <path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h560v-280h80v280q0 33-23.5 56.5T760-120H200Zm188-212-56-56 372-372H560v-80h280v280h-80v-144L388-332Z" />
                    </svg>
                  </a>
                </div>
              </div>
            </div>
            <div class="project-card">
              <div class="project-img">
                <img src="./assets/wallhaven-l855xr_1920x1080.png" alt="project" loading="lazy">
              </div>
              <div class="project-desc">
                <h2>Project Name</h2>
                <span>Project Description</span>
              </div>
              <div class="sub-cont">
                <div class="project-tags">
                  <p>Python</p>
                  <p>CSS</p>
                  <p>HTML5</p>
                </div>
                <div class="project-links">
                  <a href="#" id="code">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3">
                      <path d="M320-240 80-480l240-240 57 57-184 184 183 183-56 56Zm320 0-57-57 184-184-183-183 56-56 240 240-240 240Z" />
                    </svg>
                  </a>
                  <a href="#" id="live">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3">
                      <path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h560v-280h80v280q0 33-23.5 56.5T760-120H200Zm188-212-56-56 372-372H560v-80h280v280h-80v-144L388-332Z" />
                    </svg>
                  </a>
                </div>
              </div>
            </div>
            <div class="project-card">
              <div class="project-img">
                <img src="./assets/wallhaven-l855xr_1920x1080.png" alt="project" loading="lazy">
              </div>
              <div class="project-desc">
                <h2>Project Name</h2>
                <span>Project Description</span>
              </div>
              <div class="sub-cont">
                <div class="project-tags">
                  <p>Python</p>
                  <p>CSS</p>
                  <p>HTML5</p>
                </div>
                <div class="project-links">
                  <a href="#" id="code">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3">
                      <path d="M320-240 80-480l240-240 57 57-184 184 183 183-56 56Zm320 0-57-57 184-184-183-183 56-56 240 240-240 240Z" />
                    </svg>
                  </a>
                  <a href="#" id="live">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3">
                      <path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h560v-280h80v280q0 33-23.5 56.5T760-120H200Zm188-212-56-56 372-372H560v-80h280v280h-80v-144L388-332Z" />
                    </svg>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- CONTACE ME -->
        <div id="contact" class="contact-section">
          <div class="title">
            <h1>Message Me</h1>
          </div>
          <div class="contact-form">
            <form class="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
              <label for="username">Full Name<span>*</span></label>
              <input type="text" id="username" name="username" required>
              <span><?php echo $username_err; ?></span>

              <label for="email">Email Address<span>*</span></label>
              <input type="email" id="email" name="email" required>
              <span><?php echo $email_err; ?></span>

              <label for="message">Message<span>*</span></label>
              <!-- <textarea name="message" id="message" required></textarea> -->
              <input type="textarea" id="message" name="message" required>
              <span><?php echo $msg_err; ?></span>


              <div class="submit-btn">
                <input type="submit" name="submit" value="submit">
              </div>
            </form>
          </div>
        </div>
      </main>

      <footer id="footer">
        <div class="title">
          <h1>Suyog</h1>
        </div>
        <div class="footer-links">
          <h2>Follow Me</h2>
          <div class="socials">
            <a href="#">
              <svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <title>Facebook</title>
                <path d="M9.101 23.691v-7.98H6.627v-3.667h2.474v-1.58c0-4.085 1.848-5.978 5.858-5.978.401 0 .955.042 1.468.103a8.68 8.68 0 0 1 1.141.195v3.325a8.623 8.623 0 0 0-.653-.036 26.805 26.805 0 0 0-.733-.009c-.707 0-1.259.096-1.675.309a1.686 1.686 0 0 0-.679.622c-.258.42-.374.995-.374 1.752v1.297h3.919l-.386 2.103-.287 1.564h-3.246v8.245C19.396 23.238 24 18.179 24 12.044c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.628 3.874 10.35 9.101 11.647Z" />
              </svg>
            </a>

            <a href="#">
              <svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <title>Instagram</title>
                <path d="M7.0301.084c-1.2768.0602-2.1487.264-2.911.5634-.7888.3075-1.4575.72-2.1228 1.3877-.6652.6677-1.075 1.3368-1.3802 2.127-.2954.7638-.4956 1.6365-.552 2.914-.0564 1.2775-.0689 1.6882-.0626 4.947.0062 3.2586.0206 3.6671.0825 4.9473.061 1.2765.264 2.1482.5635 2.9107.308.7889.72 1.4573 1.388 2.1228.6679.6655 1.3365 1.0743 2.1285 1.38.7632.295 1.6361.4961 2.9134.552 1.2773.056 1.6884.069 4.9462.0627 3.2578-.0062 3.668-.0207 4.9478-.0814 1.28-.0607 2.147-.2652 2.9098-.5633.7889-.3086 1.4578-.72 2.1228-1.3881.665-.6682 1.0745-1.3378 1.3795-2.1284.2957-.7632.4966-1.636.552-2.9124.056-1.2809.0692-1.6898.063-4.948-.0063-3.2583-.021-3.6668-.0817-4.9465-.0607-1.2797-.264-2.1487-.5633-2.9117-.3084-.7889-.72-1.4568-1.3876-2.1228C21.2982 1.33 20.628.9208 19.8378.6165 19.074.321 18.2017.1197 16.9244.0645 15.6471.0093 15.236-.005 11.977.0014 8.718.0076 8.31.0215 7.0301.0839m.1402 21.6932c-1.17-.0509-1.8053-.2453-2.2287-.408-.5606-.216-.96-.4771-1.3819-.895-.422-.4178-.6811-.8186-.9-1.378-.1644-.4234-.3624-1.058-.4171-2.228-.0595-1.2645-.072-1.6442-.079-4.848-.007-3.2037.0053-3.583.0607-4.848.05-1.169.2456-1.805.408-2.2282.216-.5613.4762-.96.895-1.3816.4188-.4217.8184-.6814 1.3783-.9003.423-.1651 1.0575-.3614 2.227-.4171 1.2655-.06 1.6447-.072 4.848-.079 3.2033-.007 3.5835.005 4.8495.0608 1.169.0508 1.8053.2445 2.228.408.5608.216.96.4754 1.3816.895.4217.4194.6816.8176.9005 1.3787.1653.4217.3617 1.056.4169 2.2263.0602 1.2655.0739 1.645.0796 4.848.0058 3.203-.0055 3.5834-.061 4.848-.051 1.17-.245 1.8055-.408 2.2294-.216.5604-.4763.96-.8954 1.3814-.419.4215-.8181.6811-1.3783.9-.4224.1649-1.0577.3617-2.2262.4174-1.2656.0595-1.6448.072-4.8493.079-3.2045.007-3.5825-.006-4.848-.0608M16.953 5.5864A1.44 1.44 0 1 0 18.39 4.144a1.44 1.44 0 0 0-1.437 1.4424M5.8385 12.012c.0067 3.4032 2.7706 6.1557 6.173 6.1493 3.4026-.0065 6.157-2.7701 6.1506-6.1733-.0065-3.4032-2.771-6.1565-6.174-6.1498-3.403.0067-6.156 2.771-6.1496 6.1738M8 12.0077a4 4 0 1 1 4.008 3.9921A3.9996 3.9996 0 0 1 8 12.0077" />
              </svg>
            </a>

            <a href="#">
              <svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <title>GitHub</title>
                <path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12" />
              </svg>
              <a>
          </div>
          <div class="final-words">
            <span>
              Copyright © 2024 | Suyog Rana Magar
              All rights reserved</span>
          </div>
      </footer>
    </div>
  </div>
</body>

</html>