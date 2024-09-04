<?php

session_start();
if ($_SESSION["logedin"] === true && isset($_SESSION["logedin"])) {
    echo "

<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Operations</title>
    <link rel='stylesheet' href='..//Assets/Styles/styles.css'>

    <link rel='icon' href='../Assets/Images/profile.png' type='image/png'>
    <link rel='stylesheet' href='https://cdn.datatables.net/2.1.4/css/dataTables.dataTables.min.css'>
    <script src='https://code.jquery.com/jquery-3.7.1.min.js'
        integrity='sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=' crossorigin='anonymous'></script>
    <script src='https://cdn.datatables.net/2.1.4/js/dataTables.min.js'></script>
    
    
</head>

<body>
    <div class='container'>
        <!-- Sidebar -->";

    require('../Bars/SideBar.php');
    echo "
        <!-- Main Content -->
        <div class='rightSlider'> ";
    require('../Bars/TopBar.php');
    require('../Pages/Toaster.php');

    echo "
            <!-- Main Content -->

            <div class='main' id='main'>


                <div class='users' id='pages'>

                    <div class='page-header'>
                        <h3>Operations List</h3>

                    </div>

                    <!-- Datepicker popup container -->
                    <div id='datepickerPopup' class='datepicker-popup'>
                        <input type='text' id='datepicker' class='input-date' name='date'>
                        <div class='popup-buttons'>
                            <button class='saveBtn' id='saveDate'>Apply</button>
                            <button class='cancel-btn' id='cancelDatepicker'>Cancel</button>
                        </div>
                    </div>
                    <!-- Email popup container -->
                    <div id='email-sort' class='email-sort'>
                        <h3>Email</h3>
                        <input type='text' id='email-input' class='email-input' name='email-input' placeholder='Email'>
                        <div class='popup-buttons'>
                            <button class='saveBtn' id='saveEmail'>Apply</button>
                            <button class='cancel-btn' id='cancelEmailSort'
                                onclick='closeEmailSortPopup()'>Cancel</button>
                        </div>
                    </div>

                    <!-- Order status popup container -->
                    <div id='order-status-sort' class='order-status-sort'>
                        <h3>Select Order Status</h3>
                        <div class='status-buttons'>
                            <button>Completed</button>
                            <button>Pending</button>
                        </div>
                        <div class='status-buttons'>
                            <button>Rejected</button>
                            <button>On Hold</button>
                        </div>
                        <p>*You can select multiple order status</p>
                        <div class='popup-buttons'>
                            <button class='saveBtn' id='saveOrderStatus'>Apply</button>
                            <button class='cancel-btn' id='cancelOrderStatus'
                                onclick='closeOrderStatusPopup()'>Cancel</button>
                        </div>
                    </div>
                    <!-- Table Latest Deposits-->
                    <div class='table table-deposit'>
                        <table id='myTable'>
                            <thead>
                                <tr>
                                    <th style='text-align:left;' class='table-head-start'>ID</th>
                                    <th style='text-align:left;'>Name</th>
                                    <th style='text-align:left;'>Email</th>
                                    <th style='text-align:left;'>Date</th>
                                    <th style='text-align:left;'>Crypto</th>
                                    <th style='text-align:left;'>Exchange</th>
                                    <th style='text-align:left;'>Amount</th>
                                    <th style='text-align:left;'>ROI</th>
                                    <th style='text-align:left;'>Status</th>
                                    <th style='text-align:left;' class='table-head-end'>Action</th>
                                </tr>
                            </thead>
                            <tbody>
";
    require('../Connections/Db.php');
    $sql = 'SELECT Operation.Email,Operation.ID,Operation.Date,Operation.Amount,Operation.Status,User.Name,Operation.ROI,Operation.Crypto,Operation.Exchange FROM Operation INNER JOIN User ON Operation.Email=User.Email ';
    $result = mysqli_query($connection, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                                        <td style='text-align:left;'>" . $row["ID"] . "</td>
                                        <td style='text-align:left;'>" . $row["Name"] . "</td>
                                        <td style='text-align:left;'>" . $row["Email"] . "</td>
                                        <td style='text-align:left;'>" . $row["Date"] . "</td>
                                        <td style='text-align:left;'>$" . $row["Crypto"] . "</td>
                                        <td style='text-align:left;'>$" . $row["Exchange"] . "</td>
                                        <td style='text-align:left;'>$" . $row["Amount"] . "</td>
                                        <td style='text-align:left;'> $" . $row["ROI"] . "</td>
                                        <td style='text-align:left;'><span class='status " . strtolower($row["Status"]) . "'>" . $row["Status"] . "</span></td>
                                        <td style='text-align:left;'>  <div>
                                        <a href='./profile.php?user=" . $row["Email"] . "' title='Visit Profile'>
                                        <svg xmlns='http://www.w3.org/2000/svg'
                                            height='25' width='25' fill='white'
                                                viewBox='0 0 448 512'>
                                                <path
                                                    d='M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z' />
                                            </svg>
                                        </a>
                                        </div></td>
                                    </tr>";
        }

    }



    echo "</tbody>
                        </table>
                    </div>
                </div>
                <!-- Flatpickr JS -->
                <script src='https://cdn.jsdelivr.net/npm/flatpickr'></script>
                <script>
                    document.getElementById('openDatepicker').addEventListener('click', function () {
                        document.getElementById('datepickerPopup').style.display = 'block';
                        createOverlay();
                        // Initialize Flatpickr on the date input with calendar view open by default
                        flatpickr('#datepicker', {
                            inline: true, // Display the calendar inline
                            dateFormat: 'Y-m-d',
                            defaultDate: 'today',
                        });
                    });

                    document.getElementById('cancelDatepicker').addEventListener('click', function () {
                        document.getElementById('datepickerPopup').style.display = 'none';
                        removeOverlay();
                    });

                    document.getElementById('saveDate').addEventListener('click', function () {
                        const selectedDate = document.getElementById('datepicker').value;
                        console.log('Selected Date: ', selectedDate);
                        document.getElementById('datepickerPopup').style.display = 'none';
                        removeOverlay();
                    });

                    function createOverlay() {
                        const overlay = document.createElement('div');
                        overlay.className = 'popup-overlay';
                        overlay.id = 'popupOverlay';
                        overlay.addEventListener('click', function () {
                            document.getElementById('datepickerPopup').style.display = 'none';
                            removeOverlay();
                        });
                        document.body.appendChild(overlay);
                    }

                    function removeOverlay() {
                        const overlay = document.getElementById('popupOverlay');
                        if (overlay) {
                            document.body.removeChild(overlay);
                        }
                    }
                </script>
                <script>
                    function closePopups() {
                        closeEmailSortPopup()
                        closeOrderStatusPopup()
                        closeTransDetailsPopup()
                    }
                    function closeTransDetailsPopup() {
                        const popup = document.querySelector('.trans-details-popup');
                        const overlay = document.querySelector('.popup-overlay');
                        popup.style.display = 'none';
                        overlay.style.display = 'none';
                    }
                    function showTransDetailsPopup() {
                        const popup = document.querySelector('.trans-details-popup');
                        const overlay = document.querySelector('.popup-overlay');
                        popup.style.display = 'block';
                        overlay.style.display = 'block';
                    }
                    function closeEmailSortPopup() {
                        const popup = document.querySelector('.email-sort');
                        const overlay = document.querySelector('.popup-overlay');
                        popup.style.display = 'none';
                        overlay.style.display = 'none';
                    }
                    function closeOrderStatusPopup() {
                        const popup = document.querySelector('.order-status-sort');
                        const overlay = document.querySelector('.popup-overlay');
                        popup.style.display = 'none';
                        overlay.style.display = 'none';
                    }
                    function openEmailSortPopup() {
                        const popup = document.querySelector('.email-sort');
                        const overlay = document.querySelector('.popup-overlay');
                        popup.style.display = 'block';
                        overlay.style.display = 'block';
                    }
                    function openOrderStatusPopup() {
                        const popup = document.querySelector('.order-status-sort');
                        const overlay = document.querySelector('.popup-overlay');
                        popup.style.display = 'block';
                        overlay.style.display = 'block';
                    }
                </script>
                <script>
                    let table = new DataTable('#myTable');
                </script>
            </div>
        </div>
    </div>
</body>

</html>";
} else {
    header("location:../index.php");
}



?>