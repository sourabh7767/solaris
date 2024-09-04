document.addEventListener('DOMContentLoaded', function() {
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


    // List of all button IDs
    const buttonIds = [
        "dashboard-btn",
        "users-btn",
        "deposits-btn",
        "withdraws-btn",
        "operations-btn",
        "notifications-btn",
        "settings-btn",
        "logout-btn"
    ];

    let prevBtn = null; // Initialize prevBtn to null

    // Function to reset the style of the previously clicked button
    function resetButtonStyles(button) {
        if (button) {
            button.style.backgroundColor = ""; // Reset background color
            button.style.color = ""; // Reset text color
        }
    }

    // Function to change the style of the clicked button
    function handleButtonClick(event) {
        const clickedButton = event.currentTarget; // Use currentTarget to get the clicked button

        // Reset the previously clicked button's styles
        resetButtonStyles(prevBtn);

        // Apply styles to the clicked button
        clickedButton.style.backgroundColor = "#827248"; // Highlighted background color
        clickedButton.style.color = "#FFCC00"; // Text color for the highlighted button

        // Update prevBtn to the current button
        prevBtn = clickedButton;
    }

    // Attach click event listeners to all buttons
    buttonIds.forEach(id => {
        const button = document.getElementById(id);
        button.addEventListener("click", handleButtonClick);
    });

    const button = document.getElementById(buttonIds[0]);
    // Apply styles to the clicked button
    button.style.backgroundColor = "#827248"; // Highlighted background color
    button.style.color = "#FFCC00"; // Text color for the highlighted button
    prevBtn = button;

});


