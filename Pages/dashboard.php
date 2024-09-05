<?php
session_start();
if ($_SESSION["logedin"] === true && isset($_SESSION["logedin"])) {
    require("../Connections/Db.php");
    echo '
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title> 
    <link rel="icon" href="../Assets/Images/profile.png" type="image/png">
    <link rel="stylesheet" href="https://admin.solarisbot.ai/Assets/Styles/styles.css">
    
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
      ';
    require("../Bars/SideBar.php");
    echo '
        <!-- Main Content -->
        <div class="rightSlider">
';

    require("../Bars/TopBar.php");

    echo '

            <!-- Main Content -->

            <div class="main" id="main">

                <div class="dashboard" id="pages">
                    <div class="page-header">
                        <h3>Dashboard</h3>
                    </div>
                    <!-- Cards -->
                    <div class="cards">
                        <div class="card">
                            <div class="card-head">
                                <h3>Total User</h3>
                                <img src="../Assets/Images/user-icon.png" alt="User" class="icon">
                            </div>

';
    $sql = "SELECT * FROM `User`";
    $result = mysqli_query($connection, $sql);
    $rows = mysqli_num_rows($result);
    echo " <p>$rows</p>";

    echo '
                           
                        </div>
                        <div class="card">
                            <div class="card-head">
                                <h3>Total Deposits</h3>
                                <img src="../Assets/Icons/deposit.svg" alt="User" class="icon">
                            </div>
                            ';
    $depositeAmount = 0;
    $sql = "SELECT * FROM `Deposit` WHERE `Deposit`.`Status`='Completado' ";
    $result = mysqli_query($connection, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $depositeAmount += $row["Amount"];
        }
        echo " <p>$ $depositeAmount</p>";
    } else {
        echo "<tr><td colspan='7'>No recent data found</td></tr>";
    }


    echo '
                        </div>
                        <div class="card">
                            <div class="card-head">
                                <h3>Total Withdraws</h3>
                                <img src="../Assets/Icons/withdraw.svg" alt="User" class="icon">
                            </div>
                            ';

    $withdrawlAmount = 0;
    $sql = "SELECT * FROM `Withdrawal` WHERE `Withdrawal`.`Status`='Completado'";
    $result = mysqli_query($connection, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $withdrawlAmount += $row["Amount"];
        }
        echo " <p>$ $withdrawlAmount</p>";
    } else {
        echo "<tr><td colspan='7'>No recent data found</td></tr>";
    }
    echo '</div>
    <div class="card">
    <div class="card-head">
        <h3>Total Balance</h3>
        <img src="../Assets/Icons/roi.svg" alt="User" class="icon">
    </div>
    ';
    $ROI = 0;
    $ROIsql = "SELECT * FROM `User`";
    $ROIresult = mysqli_query($connection, $ROIsql);
    if (mysqli_num_rows($ROIresult) > 0) {
        while ($row = mysqli_fetch_assoc($ROIresult)) {
            $ROI += $row["Total_Balance"];
        }
        echo " <p>$ $ROI</p>";
    } else {
        echo "<tr><td colspan='7'>No recent data found</td></tr>";
    }
    echo '</div></div>';
//laksh start
// active user query 
    $sql = "SELECT count(*) FROM `User` WHERE `Status` = 'Activo'";
    $result = mysqli_query($connection, $sql);
    $activeUsers = mysqli_fetch_assoc($result);
// blocked user query
    $sql = "SELECT count(*) FROM `User` WHERE `Status` = 'Inactivo'";
    $result = mysqli_query($connection, $sql);
    $blockedUser = mysqli_fetch_assoc($result); 
// transfer total
    $sql = "SELECT SUM(Operation_Balance) AS `Operation_Balance` FROM `User`";
    $result = mysqli_query($connection, $sql);
    $transactionTotal = mysqli_fetch_assoc($result); 
    // echo'<pre>';
    // print_r($transactionTotal);
    // die;
// Transaction Total
    // $sql = "SELECT count(*) FROM `User` WHERE `Status` = 'Activo'";
    // $result = mysqli_query($connection, $sql);
    // $totalTransfer = mysqli_fetch_assoc($result); 


   echo"
   <div class='cards'>
        <div class='card'>
            <div class='card-head'>
                <h3>Blocked User</h3>
                <img src='../Assets/Images/user-icon.png' alt='User' class='icon'>
            </div>
            <p>" . $blockedUser['count(*)'] . "</p>
        </div>
        <div class='card'>
            <div class='card-head'>
                <h3>Transaction Total</h3>
                <img src='../Assets/Icons/withdraw.svg' alt='User' class='icon'>
            </div>
            <p>" . $transactionTotal['Operation_Balance'] . "</p>
        </div>
        <div class='card'>
            <div class='card-head'>
                <h3>Active Users</h3>
                <img src='../Assets/Images/user-icon.png' alt='User' class='icon'>
            </div>
            <p>" . $activeUsers['count(*)'] . "</p>
        </div>
    </div>

   ";
// laksh end 

    echo '
                    
                    <!-- Table Recent Transactions-->
                    

                    <!-- Table Latest Deposits-->
                    <div class="table">
                        <h2>Latest Pending Deposits</h2>
                        <table>
                            <thead>
                                <tr>
                                    <th class="table-head-start">ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th >Status</th>
                                    <th class="table-head-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>';


    $sql = "SELECT User.Name,Deposit.Email,Deposit.ID,Deposit.Date,Deposit.Amount,Deposit.Status FROM Deposit   INNER JOIN User ON Deposit.Email=User.Email WHERE Deposit.Status='Pendiente' ORDER BY `Date` DESC LIMIT 5 ";
    $result = mysqli_query($connection, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>" . $row["ID"] . "</td>
                    <td>" . $row["Name"] . "</td>
                    <td>" . $row["Email"] . "</td>
                    <td>" . $row["Date"] . "</td>
                    <td>$ " . $row["Amount"] . "</td>
                    <td><span class='status " . $row["Status"] . "'>" . $row["Status"] . "</span></td>
                    <td><a href='./deposits.php'>
                    <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 256 512' height='25' width='25' fill='white'>
    <path
        d='M246.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-9.2-9.2-22.9-11.9-34.9-6.9s-19.8 16.6-19.8 29.6l0 256c0 12.9 7.8 24.6 19.8 29.6s25.7 2.2 34.9-6.9l128-128z' />
</svg>
                    </a></td>
                    </tr>";

        }
    } else {
        echo "<tr><td colspan='7'>No recent data found</td></tr>";
    }
    echo '</tbody>
                        </table>
                    </div>


                    <!-- Table Latest Withdraws-->
                    <div class="table">
                        <h2>Latest Pending Withdraws</h2>
                        <table>
                            <thead>
                                <tr>
                                    <th class="table-head-start">ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th class="table-head-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               ';
    $sql = "SELECT User.Name,Withdrawal.Email,Withdrawal.ID,Withdrawal.Date,Withdrawal.Amount,Withdrawal.Status FROM Withdrawal   INNER JOIN User ON Withdrawal.Email=User.Email WHERE Withdrawal.Status='Pendiente' ORDER BY ID DESC LIMIT 5";
    $result = mysqli_query($connection, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                                               <td>" . $row["ID"] . "</td>
                                               <td>" . $row["Name"] . "</td>
                                               <td>" . $row["Email"] . "</td>
                                               <td>" . $row["Date"] . "</td>
                                               <td>$ " . $row["Amount"] . "</td>
                                               <td><span class='status " . $row["Status"] . "'>" . $row["Status"] . "</span></td>

                                               <td><a href='./withdraws.php'>
                                               <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 256 512' height='25' width='25' fill='white'>
                               <path
                                   d='M246.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-9.2-9.2-22.9-11.9-34.9-6.9s-19.8 16.6-19.8 29.6l0 256c0 12.9 7.8 24.6 19.8 29.6s25.7 2.2 34.9-6.9l128-128z' />
                           </svg>
                                               </a></td>

                                               </tr>";

        }
    }
    echo '</tbody>
                        </table>
                    </div>
                    <div class="table">
                        <h2>Latest Join Users</h2>
                        <table>
                            <thead>
                                <tr>
                                    <th class="table-head-start">Name</th>
                                    <th>Email</th>
                                    <th>Join Time</th>
                                    <th>Country</th>
                                    <th>Status</th>
                                    <th class="table-head-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               ';
    $sql = "SELECT * FROM `User`  ORDER BY `Join_Time` DESC LIMIT 5";
    $result = mysqli_query($connection, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                                               <td>" . $row["Name"] . "</td>
                                               <td>" . $row["Email"] . "</td>
                                               <td>" . $row["Join_Time"] . "</td>
                                               <td>" . $row["Country"] . "</td>
                                               <td><span class='status " . $row["Status"] . "'>" . $row["Status"] . "</span></td>

                                               <td><a href='./users.php'>
                                               <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 256 512' height='25' width='25' fill='white'>
                               <path
                                   d='M246.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-9.2-9.2-22.9-11.9-34.9-6.9s-19.8 16.6-19.8 29.6l0 256c0 12.9 7.8 24.6 19.8 29.6s25.7 2.2 34.9-6.9l128-128z' />
                           </svg>
                                               </a></td>

                                               </tr>";

        }
    }
    echo '</tbody>
                        </table>
                    </div>

                    
                    <div class="table">
                        <h2>Latest Operations</h2>
                        <table>
                            <thead>
                                <tr>
                                    <th class="table-head-start">ID</th>
                                    <th>Email</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>ROI</th>
                                    <th>Status</th>
                                    <th class="table-head-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               ';
    $sql = "SELECT * FROM `Operation`  ORDER BY `Date` DESC LIMIT 5";
    $result = mysqli_query($connection, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                                               <td>" . $row["ID"] . "</td>
                                               <td>" . $row["Email"] . "</td>
                                               <td>" . $row["Date"] . "</td>
                                               <td> $" . $row["Amount"] . "</td>
                                               <td>$" . $row["ROI"] . "</td>
                                               <td><span class='status " . $row["Status"] . "'>" . $row["Status"] . "</span></td>

                                               <td><a href='./operations.php'>
                                               <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 256 512' height='25' width='25' fill='white'>
                               <path
                                   d='M246.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-9.2-9.2-22.9-11.9-34.9-6.9s-19.8 16.6-19.8 29.6l0 256c0 12.9 7.8 24.6 19.8 29.6s25.7 2.2 34.9-6.9l128-128z' />
                           </svg>
                                               </a></td>

                                               </tr>";

        }
    }
    echo '</tbody>
                        </table>
                    </div>

                </div>




            </div>
        </div>
    </div>





    <!-- Chart.js Library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Chart Initialization -->
    <script>
        const ctx = document.getElementById("lineChart").getContext("2d");

        const lineChart = new Chart(ctx, {
            type: "line",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Users",
                    data: [1200, 1900, 3000, 5000, 2000, 3000, 2500, 4000, 3700, 4500, 3200, 3800],
                    borderColor: "#ff7700",
                    backgroundColor: "rgba(255, 119, 0, 0.1)",
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: "#ff7700",
                    pointHoverRadius: 8,
                    pointHoverBackgroundColor: "#ff7700",
                }]
            },
            options: {
                scales: {
                    x: {
                        grid: {
                            display: false,
                        }
                    },
                    y: {
                        ticks: {
                            beginAtZero: true,
                            color: "#b0b0b0",
                        },
                        grid: {
                            color: "#3c3c3c",
                        },
                    },
                },
                plugins: {
                    legend: {
                        display: false,
                    },
                    tooltip: {
                        backgroundColor: "#ff7700",
                        bodyColor: "white",
                        bodyFont: {
                            size: 16,
                        },
                        displayColors: false,
                    },
                },
            }
        });
    </script>
</body>

</html>';

} else {
    header("location:../index.php");
}