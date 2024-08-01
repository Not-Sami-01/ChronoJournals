"use strict";
$('#login').on('submit',(e)=>{
  e.preventDefault();
  console.log('Submit clicked')
})
$('.showPassword').on('change', (e)=>{
  const password = $('.password');
  password.attr('type', e.target.checked? 'text' : 'password');
})

document.addEventListener('DOMContentLoaded', () => {
  // Check if the page was reloaded
  if (performance.navigation.type === performance.navigation.TYPE_RELOAD && window.location.pathname !== '/signup') {
      // Notify the server to destroy the session
      fetch('/destroy-session', {
          method: 'POST',
          headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          },
      })
      .then(response => {
          if (response.ok) {
              // Redirect to the login component or page
              window.location.href = '/login';
          }
      })
      .catch(error => console.error('Error:', error));
  }
});