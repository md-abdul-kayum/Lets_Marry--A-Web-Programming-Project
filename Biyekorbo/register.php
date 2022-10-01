<?php
// Include config file
require_once "database.php";

// Define variables and initialize with empty values
$email = $password = $confirm_password = $fname = $lname = $date = $fcity = $fstate = $gender = $picture = $body = $occupation = $nid = $education = $phonenumber = $height = $weight = $religion = $blood = "";
$target = "";
$email_err = $password_err = $confirm_password_err = $fname_err = $lname_err = $date_err = $fcity_err = $fstate_err = $gender_err = $picture_err = $body_err = $occupation_err = $nid_err = $education_err = $phonenumber_err = $height_err = $weight_err = $religion_err = $blood_err = "";   

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

      



    // Validate username
    

    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

    // Validating First Name
    if(empty(trim($_POST["fname"])))
    {
        $fname_err = "Enter first name";
    } elseif(!preg_match("/^[a-zA-Z-' ]*$/",$fname)){
            $fname_err = "Only letters and white space allowed";
    }else{
        $fname = trim($_POST["fname"]);
    }

    // Validating Last Name
    if(empty(trim($_POST["lname"])))
    {
        $lname_err = "Enter last name";
    } elseif(!preg_match("/^[a-zA-Z-' ]*$/",$lname)){
        $lname_err = "Only letters and white space allowed";
    }else{
        $lname = trim($_POST["lname"]);
    }



    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter a email.";
    }
    else{
        // Prepare a select statement
        $query = "SELECT user_id FROM user WHERE email = ?";

        if($stmt = $connection->prepare($query)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_email);

            // Set parameters
            $param_email = trim($_POST["email"]);

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // store result
                $stmt->store_result();

                if($stmt->num_rows == 1){
                    $email_err = "This email is already taken.";
                } else{
                    $email = trim($_POST["email"]);
                    
                }
            }
        }
    }



    // Validating Date
    if(empty(trim($_POST["date"])))
    {
        $date_err = "Enter a date";
    }
    else{
        $date = trim($_POST["date"]);
    }

    // Validating City
    if(empty(trim($_POST["fcity"])))
    {
        $fcity_err = "Please enter a city";
    } else{
        $fcity = trim($_POST["fcity"]);
    }

    // Validating City
    if(empty(trim($_POST["fstate"])))
    {
        $fstate_err = "Please enter a state";
    } else{
        $fstate = trim($_POST["fstate"]);
    }


    // Checking for gender
    if (empty($_POST["gender"])) {
        $gender_err = "Gender is required";
    } else {
        $gender = trim($_POST["gender"]);
    }

    // Checking for bodyship
    if (empty($_POST["body"])) {
        $body_err = "please select one";
    } else {
        $body = trim($_POST["body"]);
    }

    // Checking for occupation
    if (empty($_POST["occupation"])) {
        $occupation_err = "Please enter a state";
    } else {
        $occupation = trim($_POST["occupation"]);
    }

   


     if(empty(trim($_POST["nid"]))){
        $nid_err = "Please enter a nid.";
    }
    else{
        // Prepare a select statement
        $query = "SELECT user_id FROM user WHERE nid = ?";

        if($stmt = $connection->prepare($query)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_nid);

            // Set parameters
            $param_nid = trim($_POST["nid"]);

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // store result
                $stmt->store_result();

                if($stmt->num_rows == 1){
                    $nid_err = "This nid is already taken.";
                } else{
                    $nid = trim($_POST["nid"]);
                    
                }
            }
        }
    }




    if (empty($_POST["education"])) {
        $education_err = "Please enter a state";
    } else {
        $education = trim($_POST["education"]);
    }

    if (empty($_POST["phonenumber"])) {
        $phonenumber_err = "Please enter a state";
    } else {
        $phonenumber = trim($_POST["phonenumber"]);
    }
    if (empty($_POST["height"])) {
        $height_err = "Please enter a state";
    } else {
        $height = trim($_POST["height"]);
    }

    if (empty($_POST["weight"])) {
        $weight_err = "Please enter a state";
    } else {
        $weight = trim($_POST["weight"]);
    }

    if (empty($_POST["religion"])) {
        $religion_err = "Please enter a state";
    } else {
        $religion = trim($_POST["religion"]);
    }

    if (empty($_POST["blood"])) {
        $blood_err = "Please enter a state";
    } else {
        $blood = trim($_POST["blood"]);
    }

 

    //Checking for picture
    if (!isset($_FILES['picture']))
    {
        $picture_err = "Image required";
    }else {
        // Check for image file
        $allowTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
        $detectedType = exif_imagetype($_FILES['picture']['tmp_name']);
        $error = !in_array($detectedType, $allowTypes);
        if($error) {
            if(isset($_POST['Submit']))
            {
                $picture_err = "File is not an image";
            }
        }

        // Check file size
        elseif ($_FILES["picture"]["size"] > 8388608) {
            if(isset($_POST['Submit']))
            {
                $picture_err = "Sorry, your file is too large";
            }
        }
        else{
            $picture = basename($_FILES['picture']['name']);
            $target = "./images/".$picture;
        }
    }


    // Check input errors before inserting in database
    if(empty($email_err) && empty($password_err) &&
       empty($fname_err) && empty($lname_err) && empty($confirm_password_err) && empty($date_err) &&
        empty($fcity_err) && empty($fstate_err) && empty($gender_err) && empty($picture_err) && empty($body_err) && empty($occupation_err) && empty($nid_err) && empty($education_err) && empty($phonenumber_err) && empty($height_err) && empty($weight_err) && empty($religion_err) && empty($blood_err)){

        // Prepare an insert statement
        $sql = "INSERT INTO biye_korbo.user (email,password,first_name,last_name,date_of_birth,gender,city,state,picture,body,occupation,nid,education, phonenumber, height, weight, religion, blood)".
            " VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        if($stmt = $connection->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssssssssssssssssss", $param_email, $param_password, $param_fname, $param_lname, $param_dob, $param_gender, $param_fcity, $param_fstate, $param_picture, $param_body, $param_occupation, $param_nid, $param_education, $param_phonenumber, $param_height, $param_weight, $param_religion, $param_blood);

            // Set parameters
            $param_email = $email;
            $param_password = $password; // Creates a password hash
            $param_fname = $fname;
            $param_lname = $lname;
            $param_dob = $date;
            $param_gender = $gender;
            $param_fcity = $fcity;
            $param_fstate = $fstate;
            $param_picture = $picture;
            $param_body = $body;
            $param_occupation = $occupation;
            $param_nid = $nid;
            $param_education = $education;
            $param_phonenumber = $phonenumber;
            $param_height = $height;
            $param_weight = $weight;
            $param_religion = $religion;
            $param_blood = $blood;
           

            // Attempt to execute the prepared statement
            if($stmt->execute()){
            // Redirect to login page
                move_uploaded_file($_FILES["picture"]["tmp_name"],$target);
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }else{
            echo $connection->connect_error;
        }
    }

    // Close connection
    $connection->close();
}
?>

    <!DOCTYPE html>
    <html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <link rel="canonical" href="https://getbootstrap.com/docs/3.4/examples/jumbotron/">

    <title>Biye Korbo</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/jumbotron.css" rel="stylesheet">


</head>
<body>

<?php
require_once('header.php');
?>

<div class="wrapper">
    <h2>Sign Up</h2>
    <p>Please fill this form to create an account.</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
    
        
        <div class="col-md-6 form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
            <label>Password</label>
            <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
            <span class="help-block"><?php echo $password_err; ?></span>
        </div>
        <div class="col-md-6 form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
            <label>Confirm Password</label>
            <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
            <span class="help-block">* <?php echo $confirm_password_err; ?></span>
        </div>


        <div class="col-md-6 form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
            <span class="help-block"><?php echo $email_err; ?></span>
        </div>

        <div class="col-md-6 form-group <?php echo (!empty($fname_err)) ? 'has-error' : ''; ?>">
            <label>First Name</label>
            <input type="text" name="fname" class="form-control" value="<?php echo $fname; ?>">
            <span class="help-block">* <?php echo $fname_err; ?></span>
        </div>
        <div class="col-md-6 form-group <?php echo (!empty($lname_err)) ? 'has-error' : ''; ?>">
            <label>Last Name</label>
            <input type="text" name="lname" class="form-control" value="<?php echo $lname; ?>">
            <span class="help-block">* <?php echo $lname_err; ?></span>
        </div>
        <div class="col-md-6 form-group <?php echo (!empty($date_err)) ? 'has-error' : ''; ?>">
            <label>Date of birth</label>
            <input type="date" name="date" class="form-control" value="<?php echo $date; ?>">
            <span class="help-block">* <?php echo $date_err; ?></span>
        </div>
        <div class="form-group" <?php echo (!empty($gender_err)) ? 'has-error' : ''; ?>
            <label>Gender</label>
            <input type="radio" name="gender" value="female">Female
            <input type="radio" name="gender" value="male">Male
            <input type="radio" name="gender" value="other">Other
            <span class="help-block">* <?php echo $gender_err;?></span>
     
        <div class="col-md-6 form-group <?php echo (!empty($fcity_err)) ? 'has-error' : ''; ?>">
            <label>City</label>
            <input type="text" name="fcity" class="form-control" value="<?php echo $fcity; ?>">
            <span class="help-block">* <?php echo $fcity_err; ?></span>
        </div>
        <div class="col-md-6 form-group <?php echo (!empty($fstate_err)) ? 'has-error' : ''; ?>">
            <label>State</label>
            <input type="text" name="fstate" class="form-control" value="<?php echo $fstate; ?>">
            <span class="help-block"><?php echo $fstate; ?></span>
        </div>
        <div class="col-md-12 form-group" <?php echo (!empty($body_err)) ? 'has-error' : ''; ?>
            <label>Body Type</label>
            <input type="radio" name="body" value="y">Slim
            <input type="radio" name="body" value="n">Fat
            <span class="help-block">* <?php echo $body_err;?></span>
        </div>        

        <div class="col-md-12 form-group <?php echo (!empty($occupation_err)) ? 'has-error' : ''; ?>">
            <label>Occupation</label>
            <input type="text" name="occupation" class="form-control" value="<?php echo $occupation; ?>">
            <span class="help-block"><?php echo $occupation; ?></span>
        </div>
        
        <div class="col-md-12 form-group <?php echo (!empty($nid_err)) ? 'has-error' : ''; ?>">
            <label>Nid</label>
            <input type="text" name="nid" class="form-control" value="<?php echo $nid; ?>">
            <span class="help-block"><?php echo $nid; ?></span>
        </div>

        <div class="col-md-12 form-group <?php echo (!empty($education_err)) ? 'has-error' : ''; ?>">
            <label>Education</label>
            <input type="text" name="education" class="form-control" value="<?php echo $education; ?>">
            <span class="help-block"><?php echo $education; ?></span>
        </div>

        <div class="col-md-12 form-group <?php echo (!empty($phonenumber_err)) ? 'has-error' : ''; ?>">
            <label>Contact Number</label>
            <input type="text" name="phonenumber" class="form-control" value="<?php echo $phonenumber; ?>">
            <span class="help-block"><?php echo $phonenumber; ?></span>
        </div>

        <div class="col-md-6 form-group <?php echo (!empty($height_err)) ? 'has-error' : ''; ?>">
            <label>Height</label>
            <input type="text" name="height" class="form-control" value="<?php echo $height; ?>">
            <span class="help-block"><?php echo $height; ?></span>
        </div>

        <div class="col-md-6 form-group <?php echo (!empty($weight_err)) ? 'has-error' : ''; ?>">
            <label>Weight</label>
            <input type="text" name="weight" class="form-control" value="<?php echo $weight; ?>">
            <span class="help-block"><?php echo $weight; ?></span>
        </div>

        <div class="col-md-12 form-group <?php echo (!empty($religion_err)) ? 'has-error' : ''; ?>">
            <label>Religion</label>
            <input type="text" name="religion" class="form-control" value="<?php echo $religion; ?>">
            <span class="help-block"><?php echo $religion; ?></span>
        </div>

        <div class="col-md-12 form-group <?php echo (!empty($blood_err)) ? 'has-error' : ''; ?>">
            <label>Blood Group</label>
            <input type="text" name="blood" class="form-control" value="<?php echo $blood; ?>">
            <span class="help-block"><?php echo $blood; ?></span>
        </div>
     
        
        
        <div class="col-md-12 form-group" <?php echo (!empty($picture_err)) ? 'has-error' : ''; ?>
            <label>Profile picture</label>
            <input type="file" title="Upload your profile picture" id="picture"  name="picture">
            <span class="help-block"><?php echo $picture_err;?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit">
            <input type="reset" class="btn btn-default" value="Reset">
        </div>
<div class="sign-up-color"> <p>Already have an account? <a href="login.php">Login here</a></p></div>
    </form>
</div>
</div>

<?php
require_once('footer.php');
?>

</body>
</html>
