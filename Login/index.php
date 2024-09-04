<?php

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    require("../Connections/Db.php");
    $email = $_POST["email"];
    $password = $_POST["password"];
    $sql = "SELECT * FROM `admin_login` WHERE admin_login.Email='$email'";
    $result = mysqli_query($connection, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // password_verify($password, $row["Password"])
            if (true) {
                $_SESSION["logedin"] = true;
                header("location:../index.php");


            } else {
                $_SESSION["invalidUser"] = "Invalid credentials";

            }
        }
    } else {

        $_SESSION["invalidUser"] = "Invalid user details";
    }

    // $password_verify = password_verify($password,);



}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - SolarisBot</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="../Assets/Styles/styles.css">
    <link rel="icon" href="images/profile.png?v=2" type="image/x-icon">
</head>

<body>
    <?php
    require("../Pages/ErrorToaster.php");
    ?>

    <div class="container">
        <div class="left-section">
            <img src="images/cover.svg" alt="SolarisBot Logo" class="logo">
            <div class="phone-image">
                <img src="images/rocket.png" alt="App Preview">
            </div>
        </div>

        <div class="right-section">
            <!-- Language Dropdown -->
            <div class="dropdown language-dropdown">
                <button class="dropdown-btn">
                    <img src="../Assets/Images/united-kingdom-flag.png" alt="English" class="dropdown-icon">
                    <span class="dropdown-text">English</span>
                    <span>▾</span>
                </button>
                <div class="dropdown-content">
                    <a href="#" data-value="Spanish" data-icon="images/spain-flag.png">
                        <img src="../Assets/Images/united-kingdom-flag.png" alt="Spanish" class="dropdown-icon"> English
                    </a>
                    <a href="#" data-value="English" data-icon="images/united-kingdom-flag.png">
                        <img src="../Assets/Images/spain-flag.png" alt="Selected Language" class="selected-icon">

                        <span class="dropdown-text">Spanish</span>
                    </a>
                </div>
            </div>
            <div class="login-box">
                <h2>Sign In</h2>
                <form action="index.php" method="post">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="loginInput">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="loginInput">
                    <div class="viewPassword">
                        <input type='checkbox' id='viewPassword' style="margin: 0;" />
                        <label for="viewPassword">Show Password</label>
                    </div>
                    <p>*Password can be changed from only admin pannel</p>
                    <button type="submit" name="login">Login</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        let viewPassword = document.getElementById("viewPassword");
        let password = document.getElementById("password");
        viewPassword.addEventListener("change", (e) => {
            if (e.target.checked) {
                password.type = "text"
            } else {
                password.type = "password"
            }
        })
    </script>
    <script>

        const dropdowns = document.querySelectorAll('.dropdown');

        dropdowns.forEach(dropdown => {
            const btn = dropdown.querySelector('.dropdown-btn');
            const content = dropdown.querySelector('.dropdown-content');
            const btnIcon = btn.querySelector('.selected-icon');
            const btnText = btn.querySelector('.dropdown-text');

            btn.addEventListener('click', () => {
                // Close any open dropdowns
                dropdowns.forEach(d => {
                    if (d !== dropdown) {
                        d.querySelector('.dropdown-content').style.display = 'none';
                    }
                });

                // Toggle current dropdown
                content.style.display = content.style.display === 'block' ? 'none' : 'block';
            });

            content.querySelectorAll('a').forEach(option => {
                option.addEventListener('click', (event) => {
                    event.preventDefault();
                    const selectedValue = option.getAttribute('data-value');
                    const selectedIcon = option.getAttribute('data-icon');
                    const selectedText = option.textContent.trim(); // Get the text of the selected option

                    // Update button icon and text
                    btnIcon.src = selectedIcon;
                    btnIcon.alt = selectedValue;
                    btnText.textContent = selectedText; // Update button text

                    content.style.display = 'none'; // Hide dropdown
                });
            });
        });

        // Hide dropdowns if clicking outside
        document.addEventListener('click', (event) => {
            if (!event.target.closest('.dropdown')) {
                dropdowns.forEach(dropdown => {
                    dropdown.querySelector('.dropdown-content').style.display = 'none';
                });
            }
        });
    </script>

    <?php
    
    if (isset($_SESSION["invalidUser"])) {
        echo " <script>
let loginInput=document.getElementsByClassName('loginInput')
loginInput[0].setAttribute('style','border:2px solid red;')
loginInput[1].setAttribute('style','border:2px solid red;')

</script>";
    }
    ?>
</body>

</html>