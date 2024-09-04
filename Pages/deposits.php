<?php
session_start();
if (!isset($_SESSION["logedin"])) {
    header("location:../index.php");
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deposits</title>
    <link rel="stylesheet" href="https://admin.solarisbot.ai/Assets/Styles/styles.css">
    <link rel="icon" href="../Assets/Images/profile.png" type="image/png">

    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.dataTables.min.css">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.min.js"></script>





</head>

<body>
    <div class="container">
        <?php require("../Bars/SideBar.php"); ?>
        <div class="rightSlider">
            <?php
            require("./Toaster.php");
            require("../Bars/TopBar.php");
            ?>

            <div class="main" id="main">

                <div class="users" id="pages">

                    <div class="page-header">
                        <h3>Deposit List</h3>
                    </div>

                    <!-- popup -->
                    <div class="popup-overlay" onclick="closePopups()"></div>
                    <div class="trans-details-popup">
                        <form action="../Editable Utils/deposit.php" method="POST">
                            <div class="form-group">
                                <div class="form-group-pair">
                                    <label for="transaction-id">Transaction ID</label>
                                    <input type="text" id="transaction-id" name="tid" readonly
                                        class="editWithdrawalInput">
                                </div>
                                <div class="form-group-pair">
                                    <label for="amount">Amount</label>
                                    <input type="number" id="amount" name="amount" readonly class="editWithdrawalInput">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group-pair">
                                    <label for="address">Wallet Address</label>
                                    <input type="text" value="" id="address" readonly name="address"
                                        class="editWithdrawalInput">
                                </div>

                                <div class="form-group-pair">
                                    <label for="email">Email</label>
                                    <input type="text" id="email" value="" name="email" readonly
                                        class="editWithdrawalInput">
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="form-group-pair">
                                    <label for="grid">Network</label>
                                    <input type="text" value="" id="grid" readonly name="grid"
                                        class="editWithdrawalInput">
                                </div>

                                <div class="form-group-pair">
                                    <label for="crypto">Currency</label>
                                    <input type="text" id="crypto" value="" name="crypto" readonly
                                        class="editWithdrawalInput">
                                </div>

                            </div>

                            <div class="form-group">
                                <div class="form-group-pair">
                                    <label for="date">Date</label>
                                    <input type="text" id="date" name="date" value="" readonly
                                        class="editWithdrawalInput">
                                </div>
                                <div class="form-group-pair">
                                    <label for="userstatus">Status</label>
                                    <select name="status" id="userstatus" class="editWithdrawalInput">
                                        <option value="Pendiente">Pendiente</option>
                                        <option value="Completado">Completado </option>
                                        <option value="Rechazado ">Rechazado</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group-pair">
                                    <label for="hash">Hash</label>
                                    <input type="text" id="hash" name="hash" value="" class="editWithdrawalInput"
                                        readonly>
                                </div>
                                <div class="form-group-pair" id="cHash">
                                    <label for="chash">Confirm Hash</label>
                                    <input type="text" id="chash" name="chash" value="" class="editWithdrawalInput">
                                </div>
                            </div>
                            <p id="modalerrorInput"></p>
                            <p>*NB: If require to change personal info please go to users section</p>
                            <div class="btn-container">
                                <button type="submit" name="deposit" disabled id="withdrawalSubmmitBtn">Save</button>
                                <button type="button" onclick="closeTransDetailsPopup()"
                                    class="cancel-btn">Cancel</button>
                            </div>
                        </form>
                    </div>


                    <!-- Table Latest Deposits-->

                    <div class="table">
                        <h2>Pending Deposits</h2>
                        <table id="pendingTable">
                            <thead>
                                <tr style="cursor:text !important;">
                                    <th style="text-align:left;cursor:text !important;" class="table-head-start">ID</th>
                                    <th style="text-align:left;cursor:text !important;">Name</th>
                                    <th style="text-align:left;cursor:text !important;">Email</th>
                                    <th style="text-align:left;cursor:text !important;">Date</th>
                                    <th style="text-align:left;cursor:text !important;">Amount</th>
                                    <th style="text-align:left;cursor:text !important;">Hash</th>
                                    <th style="text-align:left;cursor:text !important;">Status</th>
                                    <th style="text-align:left;cursor:text !important;" class="table-head-end">Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                require("../Connections/Db.php");
                                $sql = "SELECT
                                User.Name,Deposit.ID,Deposit.Email,Deposit.Date,Deposit.Amount,Deposit.Status,Deposit.Hash,Deposit.Address,Deposit.Grid,Deposit.Crypto
                                FROM Deposit INNER JOIN User ON Deposit.Email=User.Email WHERE
                                Deposit.Status='Pendiente'";
                                $query = mysqli_query($connection, $sql);

                                while ($row = mysqli_fetch_assoc($query)) {
                                    $id = $row["ID"];
                                    $name = $row["Name"];
                                    $email = $row["Email"];
                                    $date = $row["Date"];
                                    $amount = $row["Amount"];
                                    $status = $row["Status"];
                                    $hash = $row["Hash"];
                                    $output = json_encode($row);
                                    echo "<tr>
                                    <td style='text-align:left;'>$id</td>
                                    <td style='text-align:left;'>$name</td>
                                    <td style='text-align:left;'>$email</td>
                                    <td style='text-align:left;'>$date</td>
                                    <td style='text-align:left;'>$ $amount</td>
                                    <td style='text-align:left;'>$hash</td>
                                    <td style='text-align:left;'><span class='status $status'>$status</span></td>
                                    <td style='text-align:left;'>
                                        <div>
                                        
                                            <button onclick='showTransDetailsPopup($output)' title='Edit'>
                                                <svg xmlns='http://www.w3.org/2000/svg' fill='white'
                                                    viewBox='0 0 512 512' width='25' height='25'>
                                                    <path
                                                        d='M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160L0 416c0 53 43 96 96 96l256 0c53 0 96-43 96-96l0-96c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 96c0 17.7-14.3 32-32 32L96 448c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l96 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 64z' />
                                                </svg>
                                            </button>
                                            <a href='./profile.php?user=$email' title='Visit Profile'>
                                                <svg xmlns='http://www.w3.org/2000/svg' height='25' width='25'
                                                    fill='white' viewBox='0 0 448 512'>
                                                    <path
                                                        d='M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z' />
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>";
                                }



                                ?>
                            </tbody>
                        </table>
                    </div>

                    <div class='table'>
                        <h2>Processed Deposits</h2>
                        <table id='myTable'>
                            <thead>
                                <tr>
                                    <th style='text-align:left;' class='table-head-start'>ID</th>
                                    <th style='text-align:left;'>Name</th>
                                    <th style='text-align:left;'>Email</th>
                                    <th style='text-align:left;'>Date</th>
                                    <th style='text-align:left;'>Amount</th>
                                    <th style='text-align:left;'>Hash</th>
                                    <th style='text-align:left;'>Status</th>
                                    <th style='text-align:left;' class='table-head-end'>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php


                                require("../Connections/Db.php");
                                $sql = "SELECT User.Name,Deposit.ID,Deposit.Email,Deposit.Date,Deposit.Amount,Deposit.Status,Deposit.Hash
                                FROM Deposit INNER JOIN User ON Deposit.Email=User.Email WHERE
                                Deposit.Status!='Pendiente'";
                                $query = mysqli_query($connection, $sql);

                                while ($row = mysqli_fetch_assoc($query)) {
                                    $id = $row["ID"];
                                    $name = $row["Name"];
                                    $email = $row["Email"];
                                    $date = $row["Date"];
                                    $amount = $row["Amount"];
                                    $status = $row["Status"];
                                    $hash = $row["Hash"];
                                    $output = json_encode($row);
                                    echo "<tr>
                                    <td style='text-align:left;'>$id</td>
                                    <td style='text-align:left;'>$name</td>
                                    <td style='text-align:left;'>$email</td>
                                    <td style='text-align:left;'>$date</td>
                                    <td style='text-align:left;'>$ $amount</td>
                                    <td style='text-align:left;'>$hash</td>
                                    <td style='text-align:left;'><span class='status $status'>$status</span></td>
                                    <td style='text-align:left;'>
                                        <div>
                                            <a href='./profile.php?user=$email' title='Visit Profile'>
                                                <svg xmlns='http://www.w3.org/2000/svg' height='25' width='25'
                                                    fill='white' viewBox='0 0 448 512'>
                                                    <path
                                                        d='M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z' />
                                                </svg>
                                            </a>
                                    </td>
                    </div>
                    </tr>";
                                }





                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
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

                </script>
                <script>
                    let table = new DataTable('#myTable');
                    let table2 = new DataTable('#pendingTable');
                    document.getElementById('chash').addEventListener('input', () => {
                        const chash = document.getElementById('chash')
                        const hash = document.getElementById('hash')
                        const modalerrorInput = document.getElementById('modalerrorInput')
                        const withdrawalSubmmitBtn = document.getElementById('withdrawalSubmmitBtn')
                        if (chash.value != hash.value) {
                            modalerrorInput.innerHTML = 'Hash does\'t match';
                            withdrawalSubmmitBtn.disabled = true;
                        } else {
                            modalerrorInput.innerHTML = '';
                            withdrawalSubmmitBtn.disabled = false;

                        }
                    })
                </script>
                <script src='../Assets/Scripts/deposit.js'></script>
            </div>
        </div>
    </div>

</body>

</html>