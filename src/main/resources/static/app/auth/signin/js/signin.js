const email = document.getElementById('email');
const emailErrorContainer = document.getElementById('email-error');
const password = document.getElementById('password');
const passwordErrorContainer = document.getElementById('password-error');
const signInButton = document.getElementById('signin-button');
const API_URL = 'http://localhost:8080/auth/signin';
const form = document.getElementById('form')

async function signInUser() {
    const user = {
        email: email.value,
        password: password.value,
    };

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
                const signInResponse = await response.json();
                prepareUser(signInResponse);
                break;

            case 404: //not found
                showInputError('email', 'Email user not found');
                break;
            
            case 406: //not acceptable
                showInputError('password', 'Incorrect password');
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

function prepareUser(signInResponse) {
    localStorage.setItem('token',signInResponse.token);
    // alert(`Welcome, ${signInResponse.name}`);
    window.location.href = './../../home/index.html';
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
        default:
            return;
    }
}

form.addEventListener('submit', (event) => {
    event.preventDefault();
    signInUser();
})

email.onfocus = () => hideElement(emailErrorContainer);
password.onfocus = () => hideElement(passwordErrorContainer);
