// let inactivityTimeout;

// Function to reset the inactivity timer
// function resetInactivityTimer() {
//     clearTimeout(inactivityTimeout);
//     inactivityTimeout = setTimeout(logoutUser, 10000); // 5 minutes
// }

// Function to log out the user
// function logoutUser() {
//     fetch('/destroy-session', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/json',
//             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
//         },
//     })
//     .then(response => {
//         if (response.ok) {
//             // Redirect to the login page
//             window.location.href = '/login';
//         }
//     })
//     .catch(error => console.error('Error:', error));
// }

// // Reset the timer on keyboard activity
// document.addEventListener('keypress', resetInactivityTimer);
// document.addEventListener('keyup', resetInactivityTimer);
// document.addEventListener('keydown', resetInactivityTimer);
// document.addEventListener('scroll', resetInactivityTimer);
// document.addEventListener('click', resetInactivityTimer);

// // Initialize the timer
// resetInactivityTimer();