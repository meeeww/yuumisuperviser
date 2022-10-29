<?php
session_start();
if (!$_SESSION["logged"]) {
  header('Location: /yuumisuperviser');
}
?>

<!DOCTYPE html>
<!-- Coding by CodingLab | www.codinglabweb.com -->
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!----======== CSS ======== -->
  <link rel="stylesheet" href="../styles/analyze.css">


  <!----===== Boxicons CSS ===== -->
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <script src="http://d3js.org/d3.v3.min.js"></script>
  <!----===== varios ===== -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.1.3/axios.min.js"></script>




  <!--<title>Dashboard Sidebar Menu</title>-->
</head>

<body>
  <nav class="sidebar close">
    <header>

      <div class="image-text">
        <span class="image">
          <img src="https://static.wikia.nocookie.net/leagueoflegendsoficial/images/7/70/YuumiSquare.png/revision/latest/smart/width/250/height/250?cb=20190511165731&path-prefix=es" alt="asd">
        </span>

        <div class="text logo-text">
          <span class="name">Yuumi Superviser</span>
          <span class="profession">LoL Scouter</span>
        </div>
      </div>

      <i class='bx bx-chevron-right toggle'></i>
    </header>


    <div class="menu-bar">
      <div class="menu">



        <ul class="menu-links">
          <li class="nav-link">
            <a href="/yuumisuperviser">
              <i class='bx bxs-home icon'></i>
              <span class="text nav-text">Home</span>
            </a>
          </li>

          <li class="nav-link">
            <a href="#">
              <i class='bx bxs-bar-chart-alt-2 icon'></i>
              <span class="text nav-text">Tier List</span>
            </a>
          </li>

          <li class="nav-link">
            <a href="#">
              <i class='bx bxs-id-card icon'></i>
              <span class="text nav-text">Tracker</span>
            </a>
          </li>

          <li class="nav-link">
            <a href="http://localhost/YuumiSuperviser/analysis">
              <i class='bx bxs-analyse icon'></i>
              <span class="text nav-text">Analysis</span>
            </a>
          </li>

          <li class="nav-link">
            <a href="#">
              <i class='bx bxs-injection icon'></i>
              <span class="text nav-text">Smurfers</span>
            </a>
          </li>

          <li class="nav-link">
            <a href="#">
              <i class='bx bxs-calculator icon'></i>
              <span class="text nav-text">Compositions</span>
            </a>
          </li>

          <li class="nav-link">
            <a href="#">
              <i class='bx bxs-shield icon'></i>
              <span class="text nav-text">Team</span>
            </a>
          </li>

          <li class="nav-link">
            <a href="#">
              <i class='bx bxs-hot icon'></i>
              <span class="text nav-text">Challenges</span>
            </a>
          </li>

        </ul>
      </div>



      <div class="bottom-content">
        <li class="">
          <a href="#">
            <i class='bx bxs-cog icon'></i>
            <span class="text nav-text">Settings</span>
          </a>
        </li>
        <li class="cerrar-sesion">
          <a href="../includes/logoutOtros.php">
            <i class='bx bxs-exit icon'></i>
            <span class="text nav-text">Logout</span>
          </a>
        </li>


        <li class="mode">
          <div class="sun-moon">
            <i class='bx bx-moon icon moon'></i>
            <i class='bx bx-sun icon sun'></i>
          </div>
          <span class="mode-text text">Dark mode</span>

          <div class="toggle-switch">
            <span class="switch"></span>
          </div>
        </li>

      </div>
    </div>

  </nav>

  <section class="home">
    <div class="text">Yuumi Superviser</div>

    <body>
      <div class="container">


        <div class="card" id="card1">
          <div class="left-column background1-left-column">
            <h6>Free</h6>
            <h2>Game Tracker</h2>
            <i class="fa fa-github"></i>
          </div>

          <div class="right-column">
            <div>
              <h4>Game Tracker</h4>
              <h6>v 0.1</h6>

            </div>
            <h2>Player's data</h2>
            <p>We will get as much data as we can and analyze it for you to be
              able to get conclussions about them.
            </p>
            <button class="button background1-left-column">Begin</button>
          </div>

        </div>

        <div class="card" id="card2">
          <div class="left-column background1-left-column">
            <h6>Paid</h6>
            <h2>Map Tracker</h2>
            <i class="fa fa-github"></i>
          </div>

          <div class="right-column">
            <div>
              <h4>Map Tracker</h4>
              <h6>v 1.0</h6>

            </div>
            <h2>Player's positioning</h2>
            <p>With this script you will be able to find out where the player positions the most
              to determine the player pathing.
            </p>
            <button class="button background1-left-column" onclick="cards()">Begin</button>
          </div>

        </div>



      </div>
      <input type="text" name="playerName" id="playerName" value="software engineer" style="display:none"><br></br>
      <input type="text" name="position" id="position" value="software engineer" style="display:none"><br></br>
      <input type="checkbox" id="cbox1" value="first_checkbox" style="display:none"><br></br>
      <button class="button background1-left-column" id="submit" style="display:none" onclick="crearMapa()">Begin</button>
      <div id="mapBlue" style="display:none"></div>
      <div id="mapRed" style="display:none"></div>
      </div>
      <div>




      </div>

    </body>



</body>
</section>

<script>
  const body = document.querySelector('body'),
    sidebar = body.querySelector('nav'),
    toggle = body.querySelector(".toggle"),
    modeSwitch = body.querySelector(".toggle-switch"),
    modeText = body.querySelector(".mode-text");


  toggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
  })

  modeSwitch.addEventListener("click", () => {
    body.classList.toggle("dark");

    if (body.classList.contains("dark")) {
      modeText.innerText = "Light mode";
    } else {
      modeText.innerText = "Dark mode";

    }
  });
</script>
<script type="text/javascript" src="http://d3js.org/d3.v3.min.js"></script>
<script src="../heatmap/analyze.js"></script>
<script src="../heatmap/zergen.js"></script>

</body>

</html>