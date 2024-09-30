<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><title>Klinik Ajwa</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>

<?php
//call file to connect to server
include("header.php"); // Fixed the nested PHP tag issue
?>

<?php
// This query inserts a record in the clinic table
// Has form been submitted?
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $error = array(); // Initialize an error array

    // Check for a Firstname
    if (empty($_POST['FirstName_P'])) {
        $error[] = 'You forgot to enter your first name.';
    } else {
        $n = mysqli_real_escape_string($connect, trim($_POST['FirstName_P']));
    }

    // Check for a LastName
    if (empty($_POST['LastName_P'])) {
        $error[] = 'You forgot to enter your last name.';
    } else {
        $l = mysqli_real_escape_string($connect, trim($_POST['LastName_P']));
    }

    // Check for an Insurance Number
    if (empty($_POST['Insurance_Number'])) {
        $error[] = 'You forgot to enter your insurance number.';
    } else {
        $i = mysqli_real_escape_string($connect, trim($_POST['Insurance_Number']));
    }

    // Check for a Diagnose
    if (empty($_POST['Diagnose'])) {
        $error[] = 'You forgot to enter your diagnose.';
    } else {
        $d = mysqli_real_escape_string($connect, trim($_POST['Diagnose']));
    }

    // Register the user in the database
    // Make the query:
    if (empty($error)) { // Only run query if there are no errors
        $q = "INSERT INTO pesakit (ID_P, FirstName_P, LastName_P, InsuranceNumber, Diagnose)
              VALUES (NULL, '$n', '$l', '$i', '$d')";
        $result = @mysqli_query($connect, $q); // Run the query

        if ($result) { // If it runs
            echo '<h1>Thank you</h1>'; // Fixed the closing tag for <h1>
            exit();
        } else { // If it did not run
            // Message
            echo '<h1>System error</h1>';

            // Debugging message
            echo '<p>' . mysqli_error($connect) . '<br><br>Query: ' . $q . '</p>'; // Fixed string concatenation issue
        }
        mysqli_close($connect); // Close the database connection
        exit();
    } else {
        // If there are errors, display them
        echo '<h1>Error!</h1><p>The following error(s) occurred:<br />';
        foreach ($error as $msg) { // Print each error
            echo " - $msg<br />";
        }
        echo '</p><p>Please try again.</p>';
    }
}
?>

<h2> Register </h2>
<h4> * required field </h4>
<form action="register.php" method="post">

<p><label class="label" for="FirstName_P"> First Name : *</label>
<input id="FirstName_P" type="text" name="FirstName_P" size="30" maxlength="150" 
value="<?php if (isset($_POST['FirstName_P'])) echo $_POST['FirstName_P']; ?>" /> </p>

<p><label class="label" for="LastName_P"> Last Name : *</label>
<input id="LastName_P" type="text" name="LastName_P" size="30" maxlength="60" 
value="<?php if (isset($_POST['LastName_P'])) echo $_POST['LastName_P']; ?>" /></p>

<p><label class="label" for="Insurance_Number"> Insurance Number : *</label>
<input id="Insurance_Number" type="text" name="Insurance_Number" size="12" maxlength="12" 
value="<?php if (isset($_POST['Insurance_Number'])) echo $_POST['Insurance_Number']; ?>" /> </p>

<p><label class="label" for="Diagnose"> Diagnose : </label></p>
<textarea name="Diagnose" rows="5" cols="40"><?php if (isset($_POST['Diagnose'])) echo $_POST['Diagnose']; ?></textarea>

<p><input id="submit" type="submit" name="submit" value="Register" /> &nbsp;&nbsp;
<input id="reset" type="reset" name="reset" value="Clear All" /></p>

</p>
</form>
<p>
<br />
<br />
<br />
</body>
</html>