<?php
  session_start();
  if(!$_SESSION["logged"]){
    header('Location: ' . base_url());
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
            <a href="#">
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
        <li class="">
          <a href="#">
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

      <div class="card">
          <div class="left-column background1-left-column">
            <h6>Positioning Map</h6>
            <h2>Individual</h2>
            <i class="fa fa-github"></i>
          </div>

          <div class="right-column">
            <div>
              <h4>Cooldown</h4>
              <h6>10 Minutes</h6>

            </div>
            <h2>Player's positioning</h2>
            <p>With this script you will be able to find out where the player positions the most
              to determine the player pathing.
            </p>
            <button class="button background1-left-column">Begin</button>
          </div>

        </div>
<div class="card">
          <div class="left-column background1-left-column">
            <h6>Positioning Map</h6>
            <h2>Individual</h2>
            <i class="fa fa-github"></i>
          </div>

          <div class="right-column">
            <div>
              <h4>Cooldown</h4>
              <h6>10 Minutes</h6>

            </div>
            <h2>Player's positioning</h2>
            <p>With this script you will be able to find out where the player positions the most
              to determine the player pathing.
            </p>
            <button class="button background1-left-column">Begin</button>
          </div>

        </div>
        <div class="card">
          <div class="left-column background2-left-column">
            <h6>Programación</h6>
            <h2>Android</h2>
            <i class="fa fa-android" aria-hidden="true"></i>
          </div>

          <div class="right-column">
            <div>
              <h4>Dificultad</h4>
              <h6>Media - Alta</h6>
            </div>
            <h2>Flutter en 1 año</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum, sintLorem ipsum dolor sit amet,
              consectetur adipisicing elit. Harum, sint??</p>
            <button class="button background2-left-column">Empezar</button>
          </div>
          

        </div>
      </div>

      <div id="map">
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
<script type="text/javascript" src="../heatmap/analyze.js"></script>
</body>

</html>