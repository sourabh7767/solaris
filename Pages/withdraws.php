<?php
session_start();
const FIVE_BUSSINESS_DAY = 1;
const THREE_BUSSINESS_DAY = 2;
const SIX_HOURS_MAX = 3;
function getNameFromConstant($value) {
    $names = [
        FIVE_BUSSINESS_DAY => 'Five Business Days',
        THREE_BUSSINESS_DAY => 'Three Business Days',
        SIX_HOURS_MAX => 'Six Hours Max'
    ];

    return isset($names[$value]) ? $names[$value] : 'Unknown';
}
if ($_SESSION["logedin"] === true && isset($_SESSION["logedin"])) {

    echo '<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Withdraws</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.dataTables.min.css">
    
<link rel="icon" href="../Assets/Images/profile.png" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.min.js"></script>
    
    
</head>

<body>
       ';
    require("./Toaster.php");
    echo '
    <div class="container">
        <!-- Sidebar -->
        ';

    require("../Bars/SideBar.php");
    echo '
        <!-- Main Content -->
        <div class="rightSlider">
';

    require("../Bars/TopBar.php");



    echo "  <!-- Main Content -->

          <div class='main' id='main'>

              <div class='users' id='pages'>

                  <div class='page-header'>
                      <h3>Withdraws List</h3>
                  </div>

                  <!-- popup -->
                  <div class='popup-overlay' onclick='closePopups()'></div>
                  <div class='trans-details-popup'>
                  <form action='../Editable Utils/Withdrawal.php' method='POST'>
                      <div class='form-group'>
                          <div class='form-group-pair'>
                              <label for='transaction-id'>Transaction ID</label>
                              <input type='text' id='transaction-id' name='tid' readonly
                                  class='editWithdrawalInput'>
                          </div>
                          <div class='form-group-pair'>
                              <label for='amount'>Amount</label>
                              <input type='text' id='amount' name='amount' readonly class='editWithdrawalInput'>
                          </div>
                      </div>
                      <div class='form-group'>
                          <div class='form-group-pair'>
                              <label for='address'>Wallet Address</label>
                              <input type='text' value='' id='address' readonly name='address'
                                  class='editWithdrawalInput'>
                          </div>

                          <div class='form-group-pair'>
                              <label for='email'>Email</label>
                              <input type='text' id='email' value='' name='email' readonly class='editWithdrawalInput'>
                          </div>

                      </div>
                      <div class='form-group'>
                          <div class='form-group-pair'>
                              <label for='grid'>Network</label>
                              <input type='text' value='' id='grid' readonly name='grid'
                                  class='editWithdrawalInput'>
                          </div>

                          <div class='form-group-pair'>
                              <label for='crypto'>Currency</label>
                              <input type='text' id='crypto' value='' name='crypto' readonly class='editWithdrawalInput'>
                          </div>

                      </div>

                      <div class='form-group'>
                          <div class='form-group-pair'>
                              <label for='date'>Date</label>
                              <input type='text' id='date' name='date' value='' readonly
                                  class='editWithdrawalInput'>
                          </div>
                          <div class='form-group-pair'>
                              <label for='userstatus'>Status</label>
                              <select name='status'  id='userstatus' class='editWithdrawalInput'>
                                  <option value='Pendiente'>Pendiente</option>
                                  <option value='Completado'>Completado </option>
                                  <option value='Rechazado '>Rechazado</option>
                              </select>
                          </div>
                       
                      </div>
                    
                      <div class='form-group'>
                          <div class='form-group-pair'>
                              <label for='address'>Transaction Duration</label>
                              <input type='text' value='' id='withdrawl_fee' readonly name='address'
                                  class='editWithdrawalInput'>
                          </div>
                       
                      </div>


                      <div class='form-group'>
                          <div class='form-group-pair' id='hashSec'>
                              <label for='hash'>Hash</label>
                              <input type='text' id='hash' name='hash' value=''
                                  class='editWithdrawalInput' >
                          </div>
                      </div>
                      <p id='modalerrorInput'></p>
                      <p>*NB: If require to change personal info please go to users section</p>
                      <div class='btn-container'>
                          <button type='submit' disabled name='withdrawl' id='withdrawalSubmmitBtn' >Save</button>
                          <button type='button' onclick='closeTransDetailsPopup()'
                              class='cancel-btn'>Cancel</button>
                      </div>
                  </form>
              </div>


                  <!-- Table Latest Deposits-->
                  <div class='table table-deposit'>
                  <h1>Pending Withdraws</h1>
                      <table id='myTable' style='overflow-x:scroll;'>
                          <thead>
                              <tr>
                                  <th class='table-head-start' style='text-align:left;'>ID</th>
                                  <th style='text-align:left;'>Name</th>
                                  <th style='text-align:left;'>Email</th>
                                  <th style='text-align:left;'>Date</th>
                                  <th style='text-align:left;'>Amount</th>
                                  <th  style='text-align:left;'>Status</th>
                                  <th class='table-head-end' style='text-align:left;'>Action</th>
                              </tr>
                          </thead>
                          <tbody>";
    require("../Connections/Db.php");
    $withdrawal_sql = "SELECT User.Name,Withdrawal.ID,Withdrawal.Email,Withdrawal.Date,Withdrawal.Amount,Withdrawal.Status,Withdrawal.Tarifa,Withdrawal.Hash,Withdrawal.Grid,Withdrawal.Crypto,Withdrawal.Address FROM Withdrawal INNER JOIN User ON Withdrawal.Email=User.Email  WHERE Withdrawal.Status='Pendiente'";
    $withdrawal_result = mysqli_query($connection, $withdrawal_sql);
    if ($withdrawal_result) {
        while ($row = mysqli_fetch_assoc($withdrawal_result)) {
            $str = json_encode($row);

            $id = $row["ID"];
            $name = $row["Name"];
            $email = $row["Email"];
            $date = $row["Date"];
            $amount = $row["Amount"];
            // $transactionFee = $row["transaction_fee"];
            $status = $row["Status"];
            echo "<tr>
                                            <td style='text-align:left;'>$id</td>
                                            <td style='text-align:left;'>$name</td>
                                            <td style='text-align:left;'>$email</td>
                                            <td style='text-align:left;'>$date</td>
                                            <td style='text-align:left;'>$ $amount</td>
                                            <td style='text-align:left;'><span class='status $status'>$status</span></td>
                                            <td style='text-align:left;'>
                                            <div>
                                            <button onclick='showTransDetailsPopup($str)' title='Edit'>
                                            <svg xmlns='http://www.w3.org/2000/svg' fill='white' viewBox='0 0 512 512' width='25' height='25'>
                                                <path
                                                    d='M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160L0 416c0 53 43 96 96 96l256 0c53 0 96-43 96-96l0-96c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 96c0 17.7-14.3 32-32 32L96 448c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l96 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 64z' />
                                            </svg>
                                            </button>
                                            <a href='./profile.php?user=$email' title='Visit Profile'>
                                            <svg xmlns='http://www.w3.org/2000/svg'
                                                height='25' width='25' fill='white'
                                                    viewBox='0 0 448 512'>
                                                    <path
                                                        d='M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z' />
                                                </svg>
                                            </a>
                                            </div>
                                            </td>
                                        </tr>";
        }


    }






    echo "

</table>
</div>
<div class='table table-deposit'>
<h1>Processed Withdraws</h1>
    <table id='processedWithdrawTable'>
        <thead>
            <tr>
                <th class='table-head-start' style='text-align:left;'>ID</th>
                <th style='text-align:left;'>Name</th>
                <th style='text-align:left;'>Email</th>
                <th style='text-align:left;'>Date</th>
                <th style='text-align:left;'>Amount</th>
                <th style='text-align:left;'>Status</th>
                <th class='table-head-end' style='text-align:left;'>Action</th>
            </tr>
        </thead>
        <tbody>";

    $withdrawal_sql = "SELECT User.Name,Withdrawal.ID,Withdrawal.Email,Withdrawal.Date,Withdrawal.Amount,Withdrawal.Status,Withdrawal.Hash,Withdrawal.Grid,Withdrawal.Crypto,Withdrawal.Address FROM Withdrawal INNER JOIN User ON Withdrawal.Email=User.Email WHERE Withdrawal.Status!='Pendiente'";
    $withdrawal_result = mysqli_query($connection, $withdrawal_sql);
    if ($withdrawal_result) {
        if (mysqli_num_rows($withdrawal_result) > 0) {
            while ($row = mysqli_fetch_assoc($withdrawal_result)) {
                $str = json_encode($row);
                $id = $row["ID"];
                $name = $row["Name"];
                $email = $row["Email"];
                $date = $row["Date"];
                $amount = $row["Amount"];
                $status = $row["Status"];
                echo "<tr>
                                                <td style='text-align:left;'>$id</td>
                                                <td style='text-align:left;'>$name</td>
                                                <td style='text-align:left;'>$email</td>
                                                <td style='text-align:left;'>$date</td>
                                                <td style='text-align:left;'>$ $amount</td>
                                                <td style='text-align:left;'><span class='status $status'>$status</span></td>
                                                <td style='text-align:left;'>
                                                <div>
                                                <a href='./profile.php?user=$email' title='Visit Profile'>
                                                <svg xmlns='http://www.w3.org/2000/svg'
                                                    height='25' width='25' fill='white'
                                                        viewBox='0 0 448 512'>
                                                        <path
                                                            d='M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z' />
                                                    </svg>
                                                </a>
                                                </div>
                                                </td>
                                            </tr>";
            }



        }
    }







    echo "
</div>
</div>

<script>
    function closePopups() {
        closeEmailSortPopup();
        closeOrderStatusPopup();
        closeTransDetailsPopup();
    }
    function closeTransDetailsPopup() {
        const popup = document.querySelector('.trans-details-popup');
        const overlay = document.querySelector('.popup-overlay');
        popup.style.display = 'none';
        overlay.style.display = 'none';
    }
    // modal opener function
    const showTransDetailsPopup = (data) => {
        console.log(data)
        const popup = document.querySelector('.trans-details-popup');
        const overlay = document.querySelector('.popup-overlay');
        popup.style.display = 'block';
        overlay.style.display = 'block';
        const editWithdrawalInput = document.querySelectorAll('.editWithdrawalInput')
        const transactionDuration = document.getElementById('withdrawl_fee')
        console.log('=============>',editWithdrawalInput);
        editWithdrawalInput[0].value = data.ID !== undefined ? data.ID : ''
        editWithdrawalInput[1].value = data.Amount !== undefined ? data.Amount : ''
        editWithdrawalInput[2].value = data.Address !== undefined ? data.Address : ''
        editWithdrawalInput[3].value = data.Email !== undefined ? data.Email : ''
        editWithdrawalInput[4].value = data.Grid !== undefined ? data.Grid : ''
        editWithdrawalInput[5].value = data.Crypto !== undefined ? data.Crypto : ''
        editWithdrawalInput[6].value = data.Date !== undefined ? data.Date : ''
        editWithdrawalInput[7].value = data.Status !== undefined ? data.Status : ''
        editWithdrawalInput[8].value = data.Hash !== undefined ? data.Hash : ''
        transactionDuration.value = data.Tarifa !== undefined ? data.Tarifa : ''

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
    let processedWithdrawTable = new DataTable('#processedWithdrawTable');
</script>

<script src='../Assets/Scripts/withdraw.js'></script>
</body>

</html>";
} else {
    header("location:../index.php");
}
?>