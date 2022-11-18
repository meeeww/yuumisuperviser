<?php
session_start();
include_once '../includes/user.php';
include_once '../includes/user_session.php';
if (!$_SESSION["logged"]) {
  header('Location: /yuumisuperviser');
}
$userSession = new UserSession();
$user = new User();
$user->setUser($userSession->getCurrentUser());

?>

<!DOCTYPE html>
<!-- Coding by CodingLab | www.codinglabweb.com -->
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!----======== CSS ======== -->
  <link rel="stylesheet" href="../styles/smurf.css">


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
          <span class="name">Welcome</span>
          <span class="rol" style="color: 
          <?php
          switch ($user->getRol()) {
            case 0:
              echo "#edbec2";
              break;
            case 1:
              echo "#ed8c94";
              break;
            case 2:
              echo "#eb50a2";
              break;
            case 3:
              echo "#f72d37";
              break;
            case 4:
              echo "#fa000c";
              break;
            case 5:
              echo "#6e0308";
              break;
            case 6:
              echo "#26bda1";
              break;
            case 7:
              echo "#148ff5";
              break;
            default:
              echo "#edbec2";
              break;
          }
          ?>;">
            <?php
            switch ($user->getRol()) {
              case 0:
                echo "Free";
                break;
              case 1:
                echo "Verified";
                break;
              case 2:
                echo "Member";
                break;
              case 3:
                echo "Player";
                break;
              case 4:
                echo "Coach";
                break;
              case 5:
                echo "Team";
                break;
              case 6:
                echo "Tester";
                break;
              case 7:
                echo "Admin";
                break;
              default:
                echo "Free";
                break;
            }
            ?>
          </span>
          <span class="profession"><?php echo $user->getNombre(); ?></span>
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
              <i class='bx bxs-search-alt-2 icon'></i>
              <span class="text nav-text">Tracker</span>
            </a>
          </li>

          <li class="nav-link">
            <a href="src/vistas/analyze.php">
              <i class='bx bxs-analyse icon'></i>
              <span class="text nav-text">Analysis</span>
            </a>
          </li>

          <li class="nav-link">
            <a href="#">
              <i class='bx bxs-injection icon'></i>
              <span class="text nav-text">Smurfs</span>
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
          <a href="src/includes/logout.php">
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
      <div class="container" id="container">
        <div class="card" id="card1">
          <div class="left-column background1-left-column">
            <h6>Paid</h6>
            <h2>Smurf Tracker</h2>
            <i class="fa fa-github"></i>
          </div>

          <div class="right-column">
            <div>
              <h4>Smurf Tracker</h4>
              <h6>v 0.1</h6>

            </div>
            <h2>Player's alternative accounts</h2>
            <p>We will find suspicious accounts that can be pottencially smurfs.
            </p>
            <button class="button background1-left-column" onclick="cards()">Begin</button>
          </div>
        </div>


      </div>
      <div class="box" id="cajita" style="display:none">
        <div class="inputBox">
          <input type="usuario" id="summoner" class="input" name="summoner" required="required">
          <span>Summoner's Name</i></span>
          <i></i>
        </div>
        <div class="inputBox">
          <input type="number" max="100" min="1" value="10" id="partidas" class="input" name="partidas" required="required">
          <span>Number of matches (0-100)</i></span>
          <i></i>
        </div>
        <div class="inputBox">
          <input type="number" max="60" min="0" value="10" id="minutosPartida" class="input" name="partidas" required="required">
          <span>Max. Minutes of game</i></span>
          <i></i>
        </div>
        <div class="inputBox">
          <select class="form-select" type="text" name="position" id="position" value="TOPLANE">
            <option value="TOP">Toplaner</option>
            <option value="JUNGLE">Jungler</option>
            <option value="MIDDLE">Midlaner</option>
            <option value="BOTTOM">ADC</option>
            <option value="UTILITY">Support</option>
          </select>
        </div>
        <div class="inputBox">
          <select class="form-select" type="text" name="position" id="tipoPartidas" value="TOPLANE">
            <option value="ranked">Solo And Flex Ranked</option>
            <option value="normal">Draft Pick</option>
            <option value="tourney">Tourney (MAY NOT WORK PROPERLY)</option>
          </select>
        </div>
        <div class="inputBox">
          <select class="form-select" type="text" name="position" id="region" value="TOPLANE">
            <option value="EUW1">Europe West</option>
            <option value="EUN1">Europe North & East</option>
            <option value="NA1">North America</option>
            <option value="BR1">Brasil</option>
            <option value="JP1">Japan</option>
            <option value="LA1">North LATAM</option>
            <option value="LA2">South LATAM</option>
            <option value="OC1">Oceania</option>
            <option value="RU">Russia</option>
            <option value="TR1">Turkey</option>
            <option value="KR">Korea</option>
          </select>
        </div>
        <button type="botoncito" class="botoncito" onclick="analyze()">Begin</button>
        

      </div>

      <div class="loader" id="cargando" style="display:none">
        <span id="serverTime">Starting...</span>
      </div>





      </div>
      <div class="range" id="range" style="display:none">
        <div class="sliderValue">
          <span id="spanId">0</span>
        </div>
        <div class="field">
          <div class="value left">
            1</div>
          <input type="range" min="0" max="200" value="0" steps="1" id="inputId">
          <div class="value right" id="value right">
            10</div>
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
  const slideValue = document.getElementById("spanId");
  const inputSlider = document.getElementById("inputId");
  inputSlider.oninput = (() => {
    let value = inputSlider.value;
    slideValue.textContent = value;
    slideValue.style.left = (value / 2) + "%";
    slideValue.classList.add("show");
  });
  inputSlider.onblur = (() => {
    slideValue.classList.remove("show");
  });
</script>
<script type="text/javascript" src="http://d3js.org/d3.v3.min.js"></script>
<script src="../heatmap/analyze.js"></script>
<script src="../heatmap/zergen.js"></script>

</body>

</html>