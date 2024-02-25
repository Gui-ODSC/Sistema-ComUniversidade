var style = document.createElement('style');
style.innerHTML = 
`.fade-out {
    opacity: 0;
    transition: opacity 0.5s ease-out;
    box-shadow: black 10px;
}

.msg-erro {
    margin-top: 3px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(90deg, rgba(201,39,12,1) 0%, rgba(255,199,0,1) 100%);
    border-radius: 10px;
    padding: 3px;
}

.msg-erro p {
    height: 100%;
    color: black;
    font-size: 17px;
    margin-bottom: 0px;
}`;
document.head.appendChild(style);

var errorMessages = document.querySelectorAll('.alert, .fade-effect-error');

errorMessages.forEach(function(errorMessage) {
    setTimeout(function() {
        errorMessage.classList.add('fade-out');
        setTimeout(function() {
            errorMessage.style.display = 'none'; 
        }, 500); 
    }, 8000);
});
