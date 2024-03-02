// SHOW HIDDEN - PASSWORD
const showHiddenPass = (loginPass, loginEye) => {
    const input = document.getElementById(loginPass),
        iconEye = document.getElementById(loginEye);

    iconEye.addEventListener('click', () => {
        // Toggle password visibility
        input.type = input.type === 'password' ? 'text' : 'password';

        // Toggle eye icon
        iconEye.classList.toggle('ri-eye-line');
        iconEye.classList.toggle('ri-eye-off-line');
    });
}

showHiddenPass('login-pass', 'login-eye');

// TOGGLE BETWEEN LOGIN AND SIGNUP
const formTitle = document.getElementById('form-title');
const registerLink = document.getElementById('register-link');
const loginButton = document.getElementById('login-button');
const forgotLink = document.getElementById('forgot-link');
const fullNameInput = document.getElementById('full-name-input');

const toggleForm = () => {
    // Toggle form title
    formTitle.innerText = formTitle.innerText === 'Login' ? 'Sign Up' : 'Login';

    // Toggle register link text
    registerLink.innerHTML = formTitle.innerText === 'Login' ?
        "Don't have an account? <a href='#' id='register-btn'>Register</a>" :
        "Already have an account? <a href='#' id='register-btn'>Login</a>";

    // Toggle login button text
    loginButton.innerText = formTitle.innerText === 'Login' ? 'Login' : 'Sign Up';

    // Toggle forgot password visibility
    forgotLink.style.display = formTitle.innerText === 'Login' ? 'block' : 'none';

    // Toggle full name input visibility
    fullNameInput.style.display = formTitle.innerText === 'Login' ? 'none' : 'flex';
}

// Add click event listener to register button
registerLink.addEventListener('click', toggleForm);

// Initial setup on page load
toggleForm();
