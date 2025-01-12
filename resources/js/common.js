export function showErrorMessage(message) {
    if (!document.querySelector('.error-message-container')) {
        return;
    }

    document.querySelector('.error-message-container').style.display = 'block';
    document.querySelector('.error-message-container span').innerHTML = message;
}

export function showSuccessMessage(message) {
    if (!document.querySelector('.success-message-container')) {
        return;
    }

    document.querySelector('.success-message-container').style.display = 'block';
    document.querySelector('.success-message-container span').innerHTML = message;
}
