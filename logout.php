<div id="logoutPopup" class="popup">
  <div class="popup-content">
    <span class="close-btn">&times;</span>
    <h2>Are you sure you want to logout?</h2>
    <button id="confirmLogout">Yes, Logout</button>
    <button id="cancelLogout">Cancel</button>
  </div>
</div>

<script>
  const logoutBtn = document.getElementById('logoutBtn');
  const logoutPopup = document.getElementById('logoutPopup');
  const closeBtn = document.querySelector('.close-btn');
  const cancelLogout = document.getElementById('cancelLogout');

            logoutBtn.onclick = function() {
                logoutPopup.style.display = 'flex';
            }

            closeBtn.onclick = function() {
                logoutPopup.style.display = 'none';
            }

            cancelLogout.onclick = function() {
                logoutPopup.style.display = 'none';
            }

            window.onclick = function(event) {
                if (event.target === logoutPopup) {
                    logoutPopup.style.display = 'none';
                }
            }

            const redirectUrl = 'signout.php'; // Replace with your target page

                document.getElementById('confirmLogout').onclick = function() {
                    // Redirect to another page
                    window.location.href = redirectUrl; 
                }
        </script>