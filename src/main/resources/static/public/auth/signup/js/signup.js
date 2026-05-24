const name = document.getElementById('name');
const nameErrorContainer = document.getElementById('name-error');
const email = document.getElementById('email');
const emailErrorContainer = document.getElementById('email-error');
const password = document.getElementById('password');
const passwordErrorContainer = document.getElementById('password-error');
const confirmPassword = document.getElementById('confirm-password');
const confirmPasswordErrorContainer = document.getElementById('confirm-password-error');
const signUpButton = document.getElementById('signup-button');
const form = document.getElementById('form')

const API_URL = 'http://localhost:8080/auth/signup';

async function signUpUser() {
    const user = {
        email: email.value,
        name: name.value,
        password: password.value,
    };

    if (user.password != confirmPassword.value) {
        showInputError('confirm-password','Password does not match');
        return;
    }

    if (user.password.length < 8) {
        showInputError('password','Password may have at least 8 symbols');
        return;
    }

    try {
        const response = await fetch(API_URL, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify(user),
        });

        switch (response.status) {
            case 200: //successs
                const user = await response.json();
                alert(`Hello ${user.name}`);
                window.location = './../signin/signin.html';
                break;

            case 409: //not found
                showInputError('email', 'This email is beeing used');
                break;

            case 400: //email not valid
                showInputError('email', 'Invalid email');
                break;

            default:
                throw new Error('login error');
        }

    } catch (error) {
        alert('erro');
    }
}

function hideInputErrors() {
    passwordErrorContainer.classList.remove('input-error-visible');
    emailErrorContainer.classList.remove('input-error-visible');
}

function showElement(element) {
    element.classList.add('input-error-visible');
}

function hideElement(element) {
    element.classList.remove('input-error-visible');
}

function showInputError(input, message) {
    switch (input) {
        case 'email':
            emailErrorContainer.textContent = message;
            showElement(emailErrorContainer);
            break;
        case 'password':
            passwordErrorContainer.textContent = message;
            showElement(passwordErrorContainer);
            break;
        case 'confirm-password':
            confirmPasswordErrorContainer.textContent = message;
            showElement(confirmPasswordErrorContainer);
        default:
            return;
    }
}

form.addEventListener('submit', (event) => {
    event.preventDefault();
    signUpUser();
})

name.onfocus = () => hideElement(nameErrorContainer);
email.onfocus = () => hideElement(emailErrorContainer);
password.onfocus = () => {
    hideElement(passwordErrorContainer);
    hideElement(confirmPasswordErrorContainer);
}
confirmPassword.onfocus = () => {
    hideElement(passwordErrorContainer);
    hideElement(confirmPasswordErrorContainer);
}
