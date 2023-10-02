import { showToast, clearForm } from './utils.js';


window.addEventListener('load', () => {
    const user = JSON.parse(localStorage.getItem('user'));

    if (user) {
        window.location.href = 'home';
    }
});

let currentFormState = 'login';

const email = document.getElementById('email');
const pass = document.getElementById('pass');
const confirmPass = document.getElementById('confirmPass');
const name = document.getElementById('name');
const lastname = document.getElementById('lastname');

document.addEventListener('DOMContentLoaded', () => {
    const toggleStateButton = document.getElementById('toggleStateButton');
    const form = document.getElementById('form');

    form.addEventListener('submit', (event) => {
        event.preventDefault();
        event.target.checkValidity();

        const formData = {
            email: $("#email").val(),
            name: $("#name").val(),
            last_name: $("#lastname").val(),
            password: $("#pass").val(),
            confirmPassword: $("#confirmPass").val(),
            type: currentFormState,
        };

        const formDataInstance = new FormData(form);
        formDataInstance.append('type', currentFormState);

        if (validateForm(formData)) {
            fetch(form.action, {
                method: 'POST',
                body: formDataInstance,
            })
                .then((response) => response.json()) // Assuming the server returns JSON
                .then((data) => {
                    if (data.status === 'error') {
                        showToast(data.message, 'error');
                    } else {
                        if (currentFormState === 'register') {
                            showToast('Usuário cadastrado com sucesso', 'success');
                            clearForm('form');

                        } else {
                            showToast('Login efetuado com sucesso', 'success');
                            localStorage.setItem('user', JSON.stringify(data.user));
                            window.location.href = 'home';
                        }

                        clearForm('form');
                    }
                })
                .catch((error) => {
                    console.error('Error:', error);
                    if (currentFormState === 'register') {
                        if (error.message === '23505') {
                            showToast('Email já cadastrado', 'error');
                        } else {
                            showToast('Erro desconhecido', 'error');
                        }
                    } else {
                        showToast('Verifique seu email e senha e tente novamente', 'error');
                    }
                });
        }
    }, false);

    toggleStateButton.addEventListener('click', (event) => {
        const submitButton = document.getElementById('submitButton');
        const elementsToToggleVisiblity = [document.getElementById('nameContainer'), document.getElementById('lastNameContainer'), document.getElementById('confirmPassContainer')];

        for (const element of elementsToToggleVisiblity) {
            if (element.style.display === 'none' || element.style.display === '') {
                element.style.display = 'block';
                toggleStateButton.innerHTML = "Já tenho uma conta";
                submitButton.innerHTML = "Registrar"
                currentFormState = 'register';
            } else {
                element.style.display = 'none';
                toggleStateButton.innerHTML = "Não tenho uma conta";
                submitButton.innerHTML = "Entrar"
                currentFormState = 'login';
            }

            email.classList.remove('is-invalid');
            pass.classList.remove('is-invalid');
            confirmPass.classList.remove('is-invalid');
            name.classList.remove('is-invalid');
            lastname.classList.remove('is-invalid');
            clearForm('form');
        }
    }, false);
});


/////////////
//FUNCTIONS//
////////////

const validateForm = (formData) => {
    let valid = true;

    if (!formData.email || !formData.email.includes('@')) {
        const emailErrorMessage = document.getElementById('emailErrorMessage');
        emailErrorMessage.innerHTML = 'Email inválido'
        email.classList.add('is-invalid');
        valid = false;
    } else {
        email.classList.remove('is-invalid');
    }

    const passErrorMessage = document.getElementById('passErrorMessage');
    const confirmPassErrorMessage = document.getElementById('confirmPassErrorMessage');

    if (formData.password && formData.confirmPassword) {
        if (formData.password !== formData.confirmPassword) {
            pass.classList.add('is-invalid');
            confirmPass.classList.add('is-invalid');
            confirmPassErrorMessage.innerHTML = 'As senhas fornecidas são diferentes'
            valid = false;
        } else {
            pass.classList.remove('is-invalid');
            confirmPass.classList.remove('is-invalid');
            confirmPassErrorMessage.innerHTML = '';
            passErrorMessage.innerHTML = '';
        }
    } else {
        if (!formData.password) {
            pass.classList.add('is-invalid');
            passErrorMessage.innerHTML = 'Informe uma senha';
            valid = false;
        } else {
            pass.classList.remove('is-invalid');
            passErrorMessage.innerHTML = '';
        }

        if (currentFormState === 'register') {
            if (!formData.confirmPassword) {
                confirmPass.classList.add('is-invalid');
                confirmPassErrorMessage.innerHTML = 'Confirme a sua senha';
                valid = false;
            } else {
                confirmPass.classList.remove('is-invalid');
                confirmPassErrorMessage.innerHTML = '';
            }
        }
    }

    if (currentFormState === 'register') {
        const nameErrorMessage = document.getElementById('nameErrorMessage');

        if (!formData.name) {
            name.classList.add('is-invalid');
            nameErrorMessage.innerHTML = 'Digite seu primeiro nome';
            valid = false;
        } else {
            name.classList.remove('is-invalid');
        }

        const lastnameErrorMessage = document.getElementById('lastnameErrorMessage');

        if (!formData.last_name) {
            lastname.classList.add('is-invalid');
            lastnameErrorMessage.innerHTML = 'Digite seu sobrenome';
            valid = false;
        } else {
            lastname.classList.remove('is-invalid');
        }
    }
    return valid;
}

