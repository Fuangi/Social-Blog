<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup | Social Blog</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <section id="form">
        <form action="" method="post" class="log-form" name="logForm">
            <!-- <h1>Signup on Social Blog</h1> -->
            <fieldset id="user-essential-details">
                <legend>User essential details</legend>
                <!-- <label for="name">Name:</label> -->
                <input type="text" name="user_name" placeholder="Enter Your Name" id="user_name" 
                required>

                <!-- <label for="dob">DOB:</label> -->
                <input type="date" name="dateOfBirth" required id="date-of-birth" required>

                <!-- <label for="gender">Gender:</label> -->
                <div>
                <input type="radio" name="gender" id="gender" value="Male">
                <label for="male">Male</label>
                </div>
                <div>
                <input type="radio" name="gender" id="gender" value="Female">
                <label for="female">Female</label><br>
                </div>

                <!-- <label for="status">Status: </label> -->
                <select name="status" id="status" required>
                    <option value="Status">Status</option>
                    <option value="Single">Single</option>
                    <option value="Married">Married</option>
                    <option value="Reserved">Prefer Not To Say</option>
                </select>

                <input type="tel" name="tel" placeholder="Contact" id="contact" required>
                <input type="button" value="Continue" id="continueOne">
            </fieldset>

            <fieldset id="user-address">
                <legend>User Address</legend>
                <!-- <label for="name">Name:</label> -->
                <input type="text" name="houseNumber" placeholder="House Number"id="house-number" required>
                <input type="text" name="streetName" placeholder="Street" id="street" required>
                <input type="text" name="city" placeholder="City" id="city" required>
                <select name="country" id="country">
                    <option value="Cameroon" name="cameroon">Cameroon</option>
                    <option value="Nigeria" name="nigeria">Nigeria</option>
                    <option value="Senegal" name="senegal">Senegal</option>
                </select>
                <input type="button" value="Continue" id="continueTwo">
            </fieldset>

            <fieldset id="login-details">
                <legend>User Login Details</legend>
                <!-- <label for="name">Name:</label> -->
                <input type="text" name="userName" placeholder="User Name"id="username" required>
                <input type="email" name="userEmail" placeholder="Email" id="email" required>
                <input type="password" name="userPassword" placeholder="Password" id="password" required>
                <input type="password" name="confirmPassword" placeholder="Confirm Password" id="password1" required>
                <input type="submit" value="Submit" id="submit-btn">
            </fieldset>
    
            <div id="form-pagination-ctn" class="pagination">
                <center>
                <a href="#user-essential=details" id="first-form-fieldset" class="active pages"></a>
                <a href="#user-address" id="second-form-fieldset" class="pages"></a>
                <a href="#login-details" id="third-form-fieldset" class="pages"></a>
                </center>
            </div>
            </form>
            </section>  

</body>
<script src="index.js"></script>
</html>