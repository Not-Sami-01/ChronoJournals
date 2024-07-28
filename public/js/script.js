"use strict";
$('#login').on('submit',(e)=>{
  e.preventDefault();
  console.log('Submit clicked')
})
$('.showPassword').on('change', (e)=>{
  const password = $('.password');
  password.attr('type', e.target.checked? 'text' : 'password');
})


// $('#signup').on('submit',(e)=>{
//   e.preventDefault();
//   console.log('Submit clicked')
// })