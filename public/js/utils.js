
const showToast = (message, type) => {
    const toastElement = document.getElementById('toast');
    const toastMessage = document.getElementById('toastMessage');

    switch (type) {
        case 'error':
            toastElement.classList.remove('bg-success', 'bg-primary');
            toastElement.classList.add('bg-danger');
            break;
        case 'success':
            toastElement.classList.remove('bg-danger', 'bg-primary');
            toastElement.classList.add('bg-success');
            break;
        default:
            toastElement.classList.remove('bg-success', 'bg-danger');
            toastElement.classList.add('bg-primary');
            break;
    }

    toastMessage.innerHTML = message;
    const toast = new bootstrap.Toast(toastElement);
    toast.show();
}

const quickUnauthenticatedUser = () => {
    window.addEventListener('load', () => {
        const user = JSON.parse(localStorage.getItem('user'));

        if (!user) {
            window.location.href = 'auth';
        }
    });
}


const clearForm = (formId) => {
    const form = document.getElementById(formId);
    const inputs = form.getElementsByTagName('input');
    const texts = form.getElementsByTagName('textarea');

    for (let i = 0; i < inputs.length; i++) {
        if (inputs[i].name !== '_token') {
            inputs[i].value = "";
        }
    }

    for (let i = 0; i < texts.length; i++) {
        if (texts[i].name !== '_token') {
            texts[i].value = "";
        }
    }
}

const getGravatar = (email, size) => {
    const hash = md5(email.trim().toLowerCase());
    const url = 'https://www.gravatar.com/avatar/' + hash + '?s=' + size;

    return url;
}


export { showToast, clearForm, quickUnauthenticatedUser, getGravatar };
