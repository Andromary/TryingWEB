
// проверку на пустое поле, на длину пароля и
// на содержание символа @в адресе электронной почты.



const form = document.querySelector('form');
let submit = document.querySelector('form button');

// First name

let firstName = form[0];
let firstNamePlaceholder = firstName.getAttribute('placeholder');
console.log(firstName);
let errorFirstName = document.querySelector('#fname-p');

form.addEventListener('submit', function (event) {
    if (firstName.value.length < 1){
        event.preventDefault();
        errorFirstName.textContent = `${firstNamePlaceholder} cannot be empty`;
        console.log(errorFirstName.textContent);
    }else{
        if (firstName.value.length < 2) {
            event.preventDefault();
            console.log('Имя менее двух символов');
            errorFirstName.textContent = `${firstNamePlaceholder} cannot be less than two letters`;
        } else {
            console.log('Имя подходит');
            error.textContent = '';
        }
    }

});

firstName.addEventListener('blur', function () {

    if (firstName.value.length < 2) {
        console.log('Имя менее двух символов');
        errorFirstName.textContent = `${firstNamePlaceholder} cannot be less than two letters`;
    } else {
        console.log('Имя подходит');
        errorFirstName.textContent = '';
    }
});

// Last name

let lastName = form[1];
let lastNamePlaceholder = lastName.getAttribute('placeholder');
console.log(lastName);
let errorLastName = document.querySelector('#lname-p');

form.addEventListener('submit', function (event) {
    if (lastName.value.length < 1) {
        event.preventDefault();
        errorLastName.textContent = `${lastNamePlaceholder} cannot be empty`;
        console.log(errorLastName.textContent);
    }else{
        if (lastName.value.length < 2) {
            event.preventDefault();
            console.log('Имя менее двух символов');
            errorLastName.textContent = `${lastNamePlaceholder} cannot be less than two letters`;
        } else {
            console.log('Имя подходит');
            errorLastName.textContent = '';
        }
    }

});

lastName.addEventListener('blur', function () {

    if (lastName.value.length < 2) {
        console.log('Фамилия менее двух символов');
        errorLastName.textContent = `${lastNamePlaceholder} cannot be less than two letters`;
    } else {
        console.log('Фамилия подходит');
        errorLastName.textContent = '';
    }
});


// Email

// Метод indexOf() возвращает индекс первого вхождения указанного
// значения в строковый объект String, на котором он был вызван,
// начиная с индекса fromIndex.Возвращает - 1, если значение не найдено.


let email = form[2];
let emailPlaceholder = email.getAttribute('placeholder');
console.log(email);
let errorEmail = document.querySelector('#email-p');

form.addEventListener('submit', function (event) {
    if (email.value.length < 1) {
        event.preventDefault();
        errorEmail.textContent = `${emailPlaceholder} cannot be empty`;
        console.log(errorEmail.textContent);
    } else {
        if (email.value.length < 6) {
            event.preventDefault();
            errorEmail.textContent = `${emailPlaceholder} is too short`;
        } else {

            if (email.value.indexOf('.') == -1) {
                event.preventDefault();
                errorEmail.textContent = 'Looks life this is not an e-mail';
                return false
            }else{
                errorEmail.textContent = '';
            }

            if (email.value.indexOf('@') == -1) {
                event.preventDefault();
                errorEmail.textContent = 'Looks life this is not an e-mail';
                return false
            } else {
                errorEmail.textContent = '';
            }

        }
    } 

});
console.log(email.value.length);
email.addEventListener('blur', function () {

    if (email.value.length < 6) {
        console.log(email.value.length);
        console.log('email is too short');
        errorEmail.textContent = `${emailPlaceholder} cannot be less than 6 letters`;
    } else{
        
        if (email.value.indexOf('.') == -1) {
            errorEmail.textContent = 'Looks life this is not an e-mail';
            return false
        } else {
            errorEmail.textContent = '';
        }

        if (email.value.indexOf('@') == -1) {
            errorEmail.textContent = 'Looks life this is not an e-mail';
            return false
        } else {
            errorEmail.textContent = '';
        }
    }
    
    
});


// Password

let password = form[3];
let passwordPlaceholder = password.getAttribute('placeholder');
console.log(password);
let errorPassword = document.querySelector('#pword-p');

form.addEventListener('submit', function (event) {
    if (password.value.length < 1) {
        event.preventDefault();
        errorPassword.textContent = `${passwordPlaceholder} cannot be empty`;
        console.log(errorPassword.textContent);
    } else {
        if (password.value.length < 6) {
            event.preventDefault();
            console.log('Пароль менее шести символов');
            errorPassword.textContent = `${passwordPlaceholder} cannot be less than six letters`;
        } else {
            console.log('Пароль подходит');
            errorPassword.textContent = '';
        }
    }

});

password.addEventListener('blur', function () {

    if (password.value.length < 6) {
        console.log('Пароль менее шести символов');
        errorPassword.textContent = `${passwordPlaceholder} cannot be less than six letters`;
    } else {
        console.log('Пароль подходит');
        errorPassword.textContent = '';
    }
});



// /^[\w]{1}[\w-\.]*@[\w-]+\.[a-z]{2,4}$/i

// function ValidMail() {
//     var re = /^[\w-\.]+@[\w-]+\.[a-z]{2,4}$/i;
//     var myMail = document.getElementById('email').value;
//     var valid = re.test(myMail);
//     if (valid) output = 'Адрес эл. почты введен правильно!';
//     else output = 'Адрес электронной почты введен неправильно!';
//     document.getElementById('message').innerHTML = output;
//     return valid;
// }


// вариант проверки е-mail. При исправлении ошибки надпись не убиралась :'(
// let rule = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
            // let valid = rule.test(email.value);
            // console.log(email.value);
            // if (valid) {
            //     errorEmail.textContent = '';

            // }
            // errorEmail.textContent = 'Looks life this is not an e-mail';
            // event.preventDefault();
            // return false