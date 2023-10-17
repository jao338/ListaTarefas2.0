document.querySelector('.closeModal').addEventListener('click', () => {

    let modalMessage = document.querySelector('.card-message');

    modalMessage.style.opacity = '0';    
    modalMessage.style.display = "none";

});

