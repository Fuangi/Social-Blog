//to get the form
let logForm = document.forms['logForm'];

//to get the first fieldset and its details
let userEssentialDetails = document.getElementById('user-essential-details');
let userName = document.getElementById('user_name');
let DOB = document.getElementById('date-of-birth');
let Gender = document.forms['logForm']['gender'];
let userStatus = document.getElementById('status');
let userContact = document.getElementById('contact');

//to get the second fieldset and is details
let userAddress = document.getElementById('user-address');
let street = document.getElementById('street');
let city = document.getElementById('city');
let house = document.getElementById('house-number');
let country = document.getElementById('country');

//to get the third fieldset and its details 
let userLoginDetails = document.getElementById('login-details');
let userPassword = document.getElementById('password');
let UsersName = document.getElementById('username');
let confirmPassword = document.getElementById('password1');
let userEmail = document.getElementById('email');

//to get the buttons to take to next pages and to submit
let continueOne = document.getElementById('continueOne');
let continueTwo = document.getElementById('continueTwo');
let submit = document.getElementById('submit');

//to get the pagination items to switch between pages in the form
let firstFieldset = document.getElementById('first-form-fieldset');
let secondFieldset = document.getElementById('second-form-fieldset');
let thirdFieldset = document.getElementById('third-form-fieldset');

//to remove the other two pages and leave just one to show on the web page
userEssentialDetails.style.display = "block";
userAddress.style.display = "none";
userLoginDetails.style.display ="none";

//to allow for a user to be able to come back to the first form and to add the active class
let pagination = document.getElementsByClassName("pages");
function pageOne(){
    if(userEssentialDetails.style.display == "none"){
        userEssentialDetails.style.display = "block";
        userLoginDetails.style.display = "none";
        userAddress.style.display = "none";
        firstFieldset.className = "active";
        secondFieldset.classList.remove("active");
        thirdFieldset.classList.remove("active");
    }
}
firstFieldset.addEventListener("click", pageOne, false);

//to show the second form but not the first and last and to add the active class
function pageTwo(){
    if(userAddress.style.display == "none"){
        if(userName.value == "" || DOB.value == "" || Gender.value == "" || userStatus.value == "" ||userContact.value == ""){
            alert("Please fill in all the fields to move to the next page");
        }
        else{
            userEssentialDetails.style.display = "none";
            userLoginDetails.style.display = "none";
            userAddress.style.display = "block";
            secondFieldset.className = "active";
            firstFieldset.classList.remove("active");
            thirdFieldset.classList.remove("active");
        }
    }
}
secondFieldset.addEventListener("click", pageTwo, false);
//to show the third form but not the second and first and to add the active class
function pageThree(){
    if(userLoginDetails.style.display == "none"){
        if(userName.value == "" || DOB.value == "" || Gender.value == "" || userStatus.value == "" ||userContact.value == ""){
            alert("Please fill in all the fields to move to the next page");
        }else if(house.value == "" || street.value == "" || country.value == ""){
            alert("Please fill out the second form before you can move to the third");
        }else{
            userAddress.style.display = "none";
            userEssentialDetails.style.display = "none";
            userLoginDetails.style.display = "block";
            thirdFieldset.className = "active";
            secondFieldset.classList.remove("active");
            firstFieldset.classList.remove("active");
        }
    }
}
thirdFieldset.addEventListener("click", pageThree, false);

//to check if the user has filled all th enteries in the form
function checkValue(){
    console.log(userName.value, DOB.value, Gender.value, userStatus.value, userContact.value);
    if(userName.value == "" || DOB.value == "" || Gender.value == "" || userStatus.value == "" ||userContact.value == ""){
        alert("Please fill in all the fields");
    }else{
        userAddress.style.display ="block";
        userEssentialDetails.style.display = "none";
        secondFieldset.className = "active";
        firstFieldset.classList.remove("active");
    }
}
continueOne.addEventListener("click", checkValue, false);

function checkSecond(){
    console.log(house.value, street.value, city.value, country.value);
    if(house.value == "" || street.value == "" || country.value == ""){
        alert("Please don't leave out any empty field");
    }else{
        userAddress.style.display = "none";
        userLoginDetails.style.display = "block";
        secondFieldset.classList.remove("active");
        thirdFieldset.className = "active";
    }
}
continueTwo.addEventListener("click", checkSecond, false);

//to check the last part of the form before submitting
function checkThird(){
    console.log(userName.value, userEmail.value, userPassword.value, )
}