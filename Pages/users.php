<?php
session_start();
include("../Connections/Db.php");
?>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Users</title>
<link rel="stylesheet" href="https://admin.solarisbot.ai/Assets/Styles/styles.css">

<link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/2.1.4/js/dataTables.min.js"></script>

<link rel='icon' href='../Assets/Images/profile.png' type='image/png'>








<body>
    <div class="popupModal">
        <div class="modalBody">
            <div class="modalHeading">User Delete</div>
            <div class="modalDesc">Please Confirm Your Request</div>
            <div class="modalAction">
                <button onclick="modalConfirm(true)">Delete</button>
                <button onclick="modalCloser()">Cancel</button>
            </div>
        </div>
    </div>
    <?php require("./Toaster.php") ?>

    <div class="container">
        <!-- Sidebar -->
        <?php
        require("../Bars/SideBar.php");
        ?>
        <!-- Main Content -->
        <div class="rightSlider">

            <?php
            include("../Bars/TopBar.php");

            ?>

            <!-- Main Content -->

            <div class="main" id="main">


                <div class="users" id="pages">

                    <div class="page-header">
                        <h3>Users</h3>
                    </div>


                    <!-- Table User List-->
                    <div>
                        <table id="myTable" class="table-user table">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Balance</th>
                                    <th>Level</th>
                                    <th>Account Created</th>
                                    <th>Account Status</th>
                                    <th class="table-head-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM `User` ";
                                $query = mysqli_query($connection, $sql);
                                if (mysqli_num_rows($query)) {


                                    while ($row = mysqli_fetch_assoc($query)) {
                                        $email = $row["Email"];
                                        echo "<tr>
                                    <td><span><img src='../Assets/Images/user-icon.png' alt='DP'></span></td>
                                    <td>" . $row['Name'] . "</td>
                                    <td>" . $row['Email'] . "</td>
                                    <td>$" . $row['Total_Balance'] . "</td>
                                    <td>" . $row['Level'] . "</td>
                                    <td>" . $row['Join_Time'] . "</td>
                                    <td class='userAccountStatus' ><span class='status " . $row['Status'] . "'>" . $row['Status'] . "</span></td>
                                    <td>
                                        <div class='tableLastChild' style=' display: flex;
                                        flex-direction: row ;
                                        align-items: center;
                                        justify-content: center;
                                        gap: 0.5rem;'>

                                       
                             <a class='user-edit-btn' href='./profile.php?user=$email'>
                                   
                        <svg width='18' height='18' viewBox='0 0 18 18' fill='none'>
                                    <g opacity='0.6'>
                                        <path fill-rule='evenodd' clip-rule='evenodd'
                                            d='M9.69659 10.424L7.22192 10.778L7.57526 8.30267L13.9393 1.93867C14.525 1.35288 15.4748 1.35288 16.0606 1.93867C16.6464 2.52446 16.6464 3.47421 16.0606 4.06L9.69659 10.424Z'
                                            stroke='white' stroke-width='1.2' stroke-linecap='round'
                                            stroke-linejoin='round' />
                                        <path d='M13.2319 2.646L15.3533 4.76733' stroke='white'
                                            stroke-width='1.2' stroke-linecap='round' stroke-linejoin='round' />
                                        <path
                                            d='M13.5 10.5V15.5C13.5 16.0523 13.0523 16.5 12.5 16.5H2.5C1.94772 16.5 1.5 16.0523 1.5 15.5V5.5C1.5 4.94772 1.94772 4.5 2.5 4.5H7.5'
                                            stroke='white' stroke-width='1.2' stroke-linecap='round'
                                            stroke-linejoin='round' />
                                    </g>
                                </svg>
                            </a>
                        <a class='user-edit-btn' onclick=\"UserDeleteBtn(this,'$email')\">
                          <svg width='18' height='18' viewBox='0 0 18 16' fill='none'>
                                    <path fill-rule='evenodd' clip-rule='evenodd'
                                        d='M13.1999 15.4H4.79985C4.13711 15.4 3.59985 14.8627 3.59985 14.2V3.39999H14.3999V14.2C14.3999 14.8627 13.8626 15.4 13.1999 15.4Z'
                                        stroke='#FF867A' stroke-width='1.2' stroke-linecap='round'
                                        stroke-linejoin='round' />
                                    <path d='M7.20005 11.8V7' stroke='#FF867A' stroke-width='1.2'
                                        stroke-linecap='round' stroke-linejoin='round' />
                                    <path d='M10.7999 11.8V7' stroke='#FF867A' stroke-width='1.2'
                                        stroke-linecap='round' stroke-linejoin='round' />
                                    <path d='M1.19995 3.4H16.8' stroke='#FF867A' stroke-width='1.2'
                                        stroke-linecap='round' stroke-linejoin='round' />
                                    <path fill-rule='evenodd' clip-rule='evenodd'
                                        d='M10.8 1H7.2C6.53726 1 6 1.53726 6 2.2V3.4H12V2.2C12 1.53726 11.4627 1 10.8 1Z'
                                        stroke='#FF867A' stroke-width='1.2' stroke-linecap='round'
                                        stroke-linejoin='round' />
                                </svg>
                        </a> </div></td>
            </tr>";
                                    }
                                } else {
                                    echo "<tr>No data in this table</tr>";
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <script src="../Assets/Scripts/User.js"></script>
    <script>
        let table = new DataTable('#myTable');
        let modalConfirmation = false;
        
     
    </script>
</body>

</html>