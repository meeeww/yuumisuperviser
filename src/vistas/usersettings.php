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
  <link rel="stylesheet" href="../styles/usersettings.css">


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
    <div class="text">Settings</div>

    <body>
      <div class="container" id="container">
        <section class="py-5 my-5">
          <div class="container">
            <div class="bg-white shadow rounded-lg d-block d-sm-flex" style="height:87%;">
              <div class="profile-tab-nav border-right">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical" style="margin-top: 3%">
                  <button class="button" id="account-tab" onclick="settings('account')">
                    Account
                  </button>
                  <button class="button" id="account-tab" onclick="settings('password')">
                    Password
                  </button>
                  <button class="button" id="account-tab" onclick="settings('security')">
                    Security
                  </button>
                  <button class="button" id="account-tab" onclick="settings('application')">
                    Application
                  </button>
                  <button class="button" id="account-tab" onclick="settings('notification')">
                    <i class="fa fa-bell text-center mr-1"></i>
                    Notification
                  </button>
                </div>
              </div>
              <div class="tab-content p-4 p-md-5" id="v-pills-tabContent">
                <!---account--->
                <div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab" style="margin-left:5%">
                  <h3 class="mb-4">Account Settings</h3>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" value="Kiran">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" value="Acharya">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" value="kiranacharya287@gmail.com">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Phone number</label>
                        <input type="text" class="form-control" value="+91 9876543215">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Company</label>
                        <input type="text" class="form-control" value="Kiran Workspace">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Designation</label>
                        <input type="text" class="form-control" value="UI Developer">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Bio</label>
                        <textarea class="form-control" rows="4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore vero enim error similique quia numquam ullam corporis officia odio repellendus aperiam consequatur laudantium porro voluptatibus, itaque laboriosam veritatis voluptatum distinctio!</textarea>
                      </div>
                    </div>
                  </div>
                  <div>
                    <button class="btn btn-primary">Update</button>
                    <button class="btn btn-light">Cancel</button>
                  </div>
                </div>
                <!---password--->
                <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab" style="margin-left:5%;display:none">
                  <h3 class="mb-4">Password Settings</h3>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Old password</label>
                        <input type="password" class="form-control">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>New password</label>
                        <input type="password" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Confirm new password</label>
                        <input type="password" class="form-control">
                      </div>
                    </div>
                  </div>
                  <div>
                    <button class="btn btn-primary">Update</button>
                    <button class="btn btn-light">Cancel</button>
                  </div>
                </div>
                <!---security--->
                <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab" style="margin-left:5%;display:none">
                  <h3 class="mb-4">Security Settings</h3>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Login</label>
                        <input type="text" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Two-factor auth</label>
                        <input type="text" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="recovery">
                          <label class="form-check-label" for="recovery">
                            Recovery
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div>
                    <button class="btn btn-primary">Update</button>
                    <button class="btn btn-light">Cancel</button>
                  </div>
                </div>
                <!---application--->
                <div class="tab-pane fade" id="application" role="tabpanel" aria-labelledby="application-tab" style="margin-left:5%;display:none">
                  <h3 class="mb-4">Application Settings</h3>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="app-check">
                          <label class="form-check-label" for="app-check">
                            App check
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
                          <label class="form-check-label" for="defaultCheck2">
                            Lorem ipsum dolor sit.
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div>
                    <button class="btn btn-primary">Update</button>
                    <button class="btn btn-light">Cancel</button>
                  </div>
                </div>
                <!---notification--->
                <div class="tab-pane fade" id="notification" role="tabpanel" aria-labelledby="notification-tab" style="margin-left:5%;display:none">
                  <h3 class="mb-4">Notification Settings</h3>
                  <div class="form-group">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="" id="notification1">
                      <label class="form-check-label" for="notification1">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum accusantium accusamus, neque cupiditate quis
                      </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="" id="notification2">
                      <label class="form-check-label" for="notification2">
                        hic nesciunt repellat perferendis voluptatum totam porro eligendi.
                      </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="" id="notification3">
                      <label class="form-check-label" for="notification3">
                        commodi fugiat molestiae tempora corporis. Sed dignissimos suscipit
                      </label>
                    </div>
                  </div>
                  <div>
                    <button class="btn btn-primary">Update</button>
                    <button class="btn btn-light">Cancel</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
  </section>
  </div>

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
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="http://d3js.org/d3.v3.min.js"></script>
  <script src="../heatmap/zergen.js"></script>

</body>

</html>