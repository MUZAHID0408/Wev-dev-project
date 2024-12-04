// const email = document.getElementById('userMail');
// const userName = document.getElementById('userName');
// const password = document.getElementById('inputPassword');
// const confirmPassword = document.getElementById('confirmPassword');

// const email_ariaText = document.getElementById('emailHelp');
// const userName_ariaText = document.getElementById('userNameHelp');
// const ConfirmPassword_ariaText = document.getElementById('confirmPasswordCheck');

document.addEventListener('DOMContentLoaded', () => {
    const password = document.getElementById('password');
    const passwordCheck_ariaText = document.getElementById('passwordCheck');
    const confirmPassword = document.getElementById('confirmPassword');
    const ConfirmPassword_ariaText = document.getElementById('confirmPasswordCheck');
    password.addEventListener('input', checkPasswordMatch);
    confirmPassword.addEventListener('input', checkPasswordMatch);

    function checkPasswordMatch() {
        

        if (password.value !== "" && password.value === confirmPassword.value) {
            ConfirmPassword_ariaText.innerText = "Password matched";
            ConfirmPassword_ariaText.style.color = "#008000"; 
        } else {
            ConfirmPassword_ariaText.innerText = "Passwords do not match";
            ConfirmPassword_ariaText.style.color = "red";
        }
    }


    password.addEventListener('input', () => {
        const passwordLength = password.value.length;
        if(passwordLength <=5){
            passwordCheck_ariaText.innerText = "Password must contain at least 6 character";
            passwordCheck_ariaText.style.color = "red";
        }else if(passwordLength > 5){
            passwordCheck_ariaText.innerText = "Password contains 6 characters";
            passwordCheck_ariaText.style.color = " #008000";
        }
    });
});
