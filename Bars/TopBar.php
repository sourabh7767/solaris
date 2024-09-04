<link rel="stylesheet" href="../Assets/Styles/styles.css">
<link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>




<link rel="icon" href="../Assets/Images/profile.png" type="image/x-icon">


<div class="header">

    <div class="search-bar">
        <span class="search-icon"></span>
        <input type="text" placeholder="Search...">
    </div>
    <div class="dropdown-container">
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

        <!-- User Dropdown -->
        <div class="user-btn-container">
            <button class="user-btn">
                <img src="../Assets/Images/user-icon.png" alt="Admin" class="user-btn-icon">
                <span class="user-btn-text">Admin</span>
            </button>
        </div>
    </div>
</div>

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