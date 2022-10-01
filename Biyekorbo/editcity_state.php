<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// Include config file
require_once "database.php";

// Define variables and initialize with empty values
$new_city = $new_state = "";
$new_city_err = $new_state_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate new first name
    if(empty(trim($_POST["new_city"]))){
        $new_city_err = "Please enter a name.";
    } elseif(!preg_match("/^[a-zA-Z-' ]*$/",$new_city)){
        $new_city_err = "Only letters and white space allowed";
    } else{
        $new_city = trim($_POST["new_city"]);
    }

    // Validate new last name
    if(empty(trim($_POST["new_state"]))){
        $new_state_err = "Please enter a name.";
    } elseif(!preg_match("/^[a-zA-Z-' ]*$/",$new_state)){
        $new_state_err = "Only letters and white space allowed";
    } else{
        $new_state = trim($_POST["new_state"]);
    }

    // Check input errors before updating the database
    if(empty($new_city_err) && empty($new_state_err)){
        // Prepare an update statement
        $sql = "UPDATE user SET city = ? , state = ? WHERE user_id = '". $_SESSION['id']."'";
        echo 1;
        if($stmt = $connection->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ss", $param_new_fcity, $param_new_fstate);

            // Set parameters
            $param_new_fcity = $new_city;
            $param_new_fstate = $new_state;

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Name updated successfully.

                header("location:profile.php?id=". $_SESSION['id']);
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }

    // Close connection
    $connection->close();
}
?>

<!doctype html>
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

    <title>Dating Sites</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/jumbotron.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<nav class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="homepage.php"><img src="images/logo.png"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">


            <form class="form-inline mt-2 mt-md-0 navbar-form navbar-right" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get" >
                <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" name="search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                <a href="logout.php"><button type="button" id="formButton" class="btn btn-success">Sign Out</button></a>
                <a href="profile.php?id=<?php echo $_SESSION['id']; ?>"><button type="button" id="formButton" class="btn btn-success">My Profile</button></a>
            </form>

            <!--<a href="logout.php" class="btn btn-outline-success my-2 my-sm-0">
                Sign Out</a>
            <a href="profile.php?id=<?php echo $_SESSION['id']; ?>" class="btn btn-outline-success my-2 my-sm-0">
                My profile</a>-->

        </div><!--/.navbar-collapse -->
    </div>
</nav>
<div class="container">
    <div class="col-md-4"></div>
<div class="col-md-4 view-user-bg profile-form">
    <h2>Change Name</h2>
    <p>Please fill out this form to change your name.</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group <?php echo (!empty($new_city_err)) ? 'has-error' : ''; ?>">
            <label class="color-bg">New City Name</label>
            <input type="text" name="new_city" class="form-control" value="<?php echo $new_city; ?>">
            <span class="help-block"><?php echo $new_city_err; ?></span>
        </div>

        <div class="form-group <?php echo (!empty($new_state_err)) ? 'has-error' : ''; ?>">
            <label class="color-bg">New State Name</label>
            <input type="text" name="new_state" class="form-control">
            <span class="help-block"><?php echo $new_state_err; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit">

        </div>
    </form>

</div>
</div>


    <?php
    require_once('footer.php');
    ?>
</body>
</html>
