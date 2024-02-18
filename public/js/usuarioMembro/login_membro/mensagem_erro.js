var errorMessageEmail = document.getElementById('error-message-email');

setTimeout(function() {
    errorMessageEmail.classList.add('fade-out');
    setTimeout(function() {
        errorMessageEmail.style.display = 'none'; 
    }, 500); 
}, 5000); 


var errorMessagePassword = document.getElementById('error-message-password');

setTimeout(function() {
    errorMessagePassword.classList.add('fade-out');
    setTimeout(function() {
        errorMessagePassword.style.display = 'none'; 
    }, 500); 
}, 5000);
