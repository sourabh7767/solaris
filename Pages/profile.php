<?php
session_start();
if ($_SESSION["logedin"] === true && isset($_SESSION["logedin"])) {
  include("../Connections/Db.php");
  $userData = [];
  $userDeposits = [];
  if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["user"])) {
    $_SESSION['user'] = $_GET["user"];
    $userEmail = $_GET['user'];
    $sql = "SELECT * FROM `User` WHERE `Email`='$userEmail'";
    $result = mysqli_query($connection, $sql);
    if (
      mysqli_num_rows($result) >
      0
    ) {
      while ($row = mysqli_fetch_assoc($result)) {
        $userData = $row;
      }
    }
  }
  echo "
<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='UTF-8' />
    <meta name='viewport' content='width=device-width, initial-scale=1.0' />
    <title>Profile</title>
    <link
      rel='stylesheet'
      href='https://admin.solarisbot.ai/Assets/Styles/styles.css'
    />
    
    <link rel='icon' href='../Assets/Images/profile.png' type='image/png'>
  </head>

  <body>
    <div class='container'>
      <!-- Sidebar -->
      ";
  require("../Bars/SideBar.php");
  echo '<!-- Main Content -->
      <div class="rightSlider">
        ';
  require("../Bars/TopBar.php");
  echo "
        <!-- Main Content -->

        <div class='main' id='main'>
            <div class='dashboard' id='pages'>
              <div class='page-header'>
                <h3>Profile</h3>
              </div>
              <div class='personal-info'>
                <h2>Personal Information</h2>
                <form method='post' action='./EditPersonalInfo.php'>
                  <div class='form-group'>
                    <div class='form-group-pair'>
                      <label for='name'>Name</label>
                      <input
                        type='text'
                        name='userName'
                      value='" . $userData["Name"] . "'
                    />
                  </div>

                  <div class='form-group-pair'>
                    <label for='country'>Country</label>
                    <input
                      type='text'
                      id='country'
                      name='country'
                      value='" . $userData["Country"] . "'
                    />
                  </div>
                </div>
                <div class='form-group'>
                    <div class='form-group-pair'>
                      <label for='email'>Email</label>
                      <input
                        type='email'
                        id='email'
                        name='email'
                      value='" . $userData["Email"] . "'
                    />
                  </div>
                  <div class='form-group-pair'>
                    <label for='country-code'>Country Code</label>
                    <input type='text' id='country-code' name='countrycode'
                    value='" . $userData["Country_Code"] . "'>
                  </div>
                </div>
                <div class='form-group'>
                  <div class='form-group-pair'>
                    <label for='account-created'>Account Created</label>
                    <input type='text' id='account-created' name='joindate'
                    value='" . $userData["Join_Time"] . "'>
                  </div>
                  <div class='form-group-pair'>
                    <label for='phone-number'>Phone Number</label>
                    <input type='text' id='phone-number' name='phone' value='" .
    $userData["Phone"] . "'>
                  </div>
                </div>
                <div class='form-group'>
                  <div class='form-group-pair'>
                    <label for='deviceId'>Device ID</label>
                    <input type='text' id='deviceId' name='deviceId'
                    value='" . $userData["Device_Id"] . "'>
                  </div>
                  <div class='form-group-pair'>
                    <label for='image'>Profile Picture</label>
                    <input type='text' id='image' name='image' value='" .
    $userData["Image"] . "'>
                  </div>
                </div>
                <div class='form-group'>
                <div class='form-group-pair'>
                  <label for='deviceId'>Password</label>
                  <input type='text' id='password' name='password'
                  value='" . $userData["Password"] . "'>
                </div>
                <div class='form-group-pair'>
                  <label for='image'>Pin</label>
                  <input type='text' id='pin' name='pin' value='" .
    $userData["PIN"] . "'>
                </div>
              </div>
                <div class='btn-container'>
                  <button name='personalInfo' type='submit'>Save</button>
                </div>
              </form>
            </div>

            <div class='account-info'>
              <h2>Account Information</h2>
              <form action='./EditAccountInfo.php' method='post'>
                <div class='form-group'>
                  <div class='form-group-pair'>
                    <label for='available-balance'
                      >Available Balance (in $)</label
                    >
                    <input type='text' id='available-balance'
                    name='totalbalance' value='" . $userData["Total_Balance"] .
    "'>
                  </div>
                  <div class='form-group-pair'>
                    <label for='total-refer'>Total Refer</label>
                    <input type='text' id='total-refer' name='totalrefer'
                    value='" . $userData["Total_Refer"] . "'>
                  </div>
                </div>
                <div class='form-group'>
                  <div class='form-group-pair'>
                    <label for='referral-income'>Referral Income (in $)</label>
                    <input type='text' id='referral-income' name='refincome'
                    value='" . $userData["Referral_Income"] . "'>
                  </div>
                  <div class='form-group-pair'>
                    <label for='spin'>Spin</label>
                    <input type='text' id='spin' name='spin' value='" .
    $userData["Spin"] . "'>
                  </div>
                </div>
                <div class='form-group'>
                  <div class='form-group-pair'>
                    <label for='referral-code'>Referral Code</label>
                    <input type='text' id='referral-code' name='refercode'
                    value='" . $userData["Refer_Code"] . "'>
                  </div>
                  <div class='form-group-pair'>
                    <label for='sponsor-code'>Sponsor Code</label>
                    <input type='text' id='sponsor-code' name='referby' value='"
    . $userData["Refer_by"] . "'>
                  </div>
                </div>
                <div class='form-group'>
                  <div class='form-group-pair'>
                    <label for='account-status'>Account Status</label>
                    <select
                      name='accountstatus'
                      value='" . $userData["Status"] . "'
                      id='" . $userData["Status"] . "'
                    >
                      ";
  switch ($userData["Status"]) {
    case 'Pendiente':
      echo '
    <option value="Pendiente">Pendiente</option>
    <option value="Activo">Activo</option>
    <option value="Inactivo">Inactivo</option>
    ';
      break;
    case 'Activo':
      echo '
      <option value="Activo">Activo</option>
    <option value="Pendiente">Pendiente</option>
    <option value="Inactivo">Inactivo</option>
    ';
      break;
    case 'Inactivo':
      echo '
      <option value="Inactivo">Inactivo</option>
    <option value="Pendiente">Pendiente</option>
    <option value="Activo">Activo</option>
    ';
      break;

    default:
      # code...
      break;
  }
  echo "
                    </select>
                  </div>
                  <div class='form-group-pair'>
                  <label for='account-status'>Account Level</label>
                  <select
                    name='level'
                    value='" . $userData["Level"] . "'
                    id='" . $userData["Level"] . "'
                  >
                    ";
  switch ($userData["Level"]) {
    case 'Bronze':
      echo '
      <option value="Bronze">Bronze</option>
      <option value="Gold">Gold</option>
    <option value="Silver">Silver</option>
  ';
      break;
    case 'Silver':
      echo '
      <option value="Silver">Silver</option>
      <option value="Gold">Gold</option>
    <option value="Bronze">Bronze</option>
  ';
      break;
    case 'Gold':
      echo '
    <option value="Gold">Gold</option>
  <option value="Silver">Silver</option>
  <option value="Bronze">Bronze</option>
  ';
      break;

    default:
      echo '
    <option value="Silver">Silver</option>
    <option value="Gold">Gold</option>
  <option value="Bronze">Bronze</option>
';
      break;
  }
  echo "
                  </select>
                </div>


                </div>
                <div class='btn-container'>
                  <button type='submit' name='AccountSubmit'>Save</button>
                </div>
              </form>
            </div>

            <!-- Table Recent Transactions-->

            <!-- Table Latest Deposits-->
            <div class='table'>
              <h2>Deposits History</h2>
              <table>
                <thead>
                  <tr>
                    <th class='table-head-start'>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th class='table-head-end'>Status</th>
                  </tr>
                </thead>
                <tbody>
                  ";
  $deposits_query = "SELECT * FROM `Deposit` WHERE
                  `Email`='$userEmail'";
  $deposits_result =
    mysqli_query($connection, $deposits_query);
  if (mysqli_num_rows($deposits_result) > 0) {
    while ($row = mysqli_fetch_assoc($deposits_result)) {
      $ID = $row['ID'];
      $Email = $row['Email'];
      $Date = $row['Date'];
      $Amount =
        $row['Amount'];
      $Status = $row['Status'];
      echo "
                  <tr>
                    <td>$ID</td>
                    <td>" . $userData['Name'] . "</td>
                    <td>$Email</td>
                    <td>$Date</td>
                    <td>$ $Amount</td>
                    <td>
                      <a
                        style='text-decoration: none; color: white'
                        href='./deposits.php'
                        class='status $Status'
                        >$Status</a
                      >
                    </td>
                  </tr>
                  ";
    }
  } else {
    echo "<tr><td colspan='6' style='text-align: center;'>No History Found</td></tr>";
  }
  echo "
                </tbody>
              </table>
            </div>

            <div class='table'>
              <h2>Withdrawal History</h2>
              <table>
                <thead>
                  <tr>
                    <th class='table-head-start'>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th class='table-head-end'>Status</th>
                  </tr>
                </thead>
                <tbody>
                  ";
  $withdrawal_query = "SELECT * FROM `Withdrawal` WHERE
                  `Email`='$userEmail'";
  $withdrawal_result =
    mysqli_query($connection, $withdrawal_query);
  if (mysqli_num_rows($withdrawal_result) > 0) {
    while (
      $row =
      mysqli_fetch_assoc($withdrawal_result)
    ) {
      $ID = $row['ID'];
      $Email = $row['Email'];
      $Date = $row['Date'];
      $Amount =
        $row['Amount'];
      $Status = $row['Status'];

      echo "
                  <tr>
                    <td>$ID</td>
                    <td>" . $userData['Name'] . "</td>
                    <td>$Email</td>
                    <td>$Date</td>
                    <td>$ $Amount</td>
                    <td>
                      <a
                        style='text-decoration: none; color: white'
                        href='./withdraws.php'
                        class='status $Status'>$Status</a
                      >
                    </td>
                  </tr>
                  ";
    }
  } else {
    echo "<tr><td colspan='6' style='text-align: center;'>No History Found</td></tr>";
  }
  echo "
                </tbody>
              </table>
            </div>
            <div class='table'>
              <h2>Operations History</h2>
              <table>
                <thead>
                  <tr>
                    <th class='table-head-start'>ID</th>
                    <th>Email</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>ROI</th>
                    <th class='table-head-end'>Status</th>
                  </tr>
                </thead>
                <tbody>
                  ";
  $withdrawal_query = "SELECT * FROM `Operation` WHERE `Email`='$userEmail'";
  $withdrawal_result =
    mysqli_query($connection, $withdrawal_query);
  if (mysqli_num_rows($withdrawal_result) > 0) {
    while (
      $row =
      mysqli_fetch_assoc($withdrawal_result)
    ) {
      $ID = $row['ID'];
      $Email = $row['Email'];
      $Date = $row['Date'];
      $Amount = $row['Amount'];
      $ROI = $row['ROI'];
      $Status = $row['Status'];

      echo "
                  <tr>
                    <td>$ID</td>
                    <td>$Email</td>
                    <td>$Date</td>
                    <td>$ $Amount</td>
                    <td>$ $ROI</td>
                    <td>
                      <a
                        style='text-decoration: none; color: white'
                        href='./withdraws.php'
                        class='status $Status'>$Status</a
                      >
                    </td>
                  </tr>
                  ";
    }
  } else {
    echo "<tr><td colspan='6' style='text-align: center;'>No History Found</td></tr>";
  }
  echo "
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script></script>
  </body>
</html>
";
} else {
  header("location:../index.php");
}