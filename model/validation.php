<?php
/**
 * Form validation file.
 *
 * @author Lucas Harlor
 * @author Kevin Smith
 * @author Stacie Mashnitskaya
 * @author Edward Mendoza
 */

/**
 * Verify if a user has entered a valid
 * username and password
 *
 * @return loginTest if the user-entered
 * credentials are not valid
 * @return errors if the user did not enter
 * a username and password
 */
function loginValidation() {
    $database = new Database();
    if(isset($_POST['username']) && !($_POST['username'] == "")) {
        $loginTest = $database->verifyUser($_POST['username'], $_POST['password']);
        if ($loginTest === true) {
            //save to session & redirect
            $_SESSION['user'] = $_POST['username'];

            return true;
        } else {
            return $loginTest;
        }
    } else {
        $errors = 'Please enter a username and password';
        return $errors;
    }
}

/**
 * Verify if the user has entered a valid
 * e-mail and a question
 */
function footerEmailValidation() {
    // define variables and set to empty values
    $errors = array();
    $email =  $questions = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (!isset($_POST["email"]) || $_POST['email'] == "") {
            array_push($errors, "** An email is required **");
        } else if (!filter_var(test_input($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "** Invalid email format **");
        }else {
            $email = test_input($_POST["email"]);
        }

        if (!isset($_POST["question"]) || $_POST['question'] == "") {
            array_push($errors, "** A question is required **");
        } else {
            $questions = test_input($_POST["question"]);
        }
    }

    return $errors;
}

/**
 * Verify if information for a new contact or
 * contact being edited is valid
 *
 * @return errors if even one field contains
 * invalid information
 */
function contactValidation()
{
    
    // define variables and set to empty values
    $errors = array();
    $name = $email = $phone = $questions = $ext = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!isset($_POST["name"]) || $_POST['name'] == "") {

            array_push($errors, "** A name is required **");

        } else if (!preg_match("/^[a-zA-Z ]*$/",test_input($_POST["name"]))) {
            array_push($errors, "** Name: Only letters and white space allowed **");
        } else {
            $name = test_input($_POST["name"]);
        }

        if (!isset($_POST["phone"]) || $_POST['phone'] == "") {
            $phone = "";
        } else {
            if(isset($_POST["phone"]) && $_POST['phone'] != "") {
                $changed = true;
                if (!preg_match("/^\s*(?:\+?(\d{1,3}))?([-. (]*(\d{3})[-. )]*)?((\d{3})[-. ]*(\d{2,4})(?:[-.x ]*(\d+))?)\s*$/", $_POST['phone'])) {
                    array_push($errors, "Please use valid phone number format. Example: (333) 333-3333");
                }
            } else {
                $phone = test_input($_POST["phone"]);
            }
        }

        if (!isset($_POST["ext"]) || $_POST['ext'] == "") {
            $ext = "";
        } else {
            $ext = test_input($_POST["ext"]);
        }

        if (!isset($_POST["email"]) || $_POST['email'] == "") {
            array_push($errors, "** An email is required **");
        } else if (!filter_var(test_input($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "** Invalid email format **");
        }else {
            $email = test_input($_POST["email"]);
        }

        if (!isset($_POST["questions"]) || $_POST['questions'] == "") {
            array_push($errors, "** A comment is required **");
        } else {
            $questions = test_input($_POST["questions"]);
        }
    }

    return $errors;

}

/**
 * Verify if the information being entered
 * for a new user is valid
 *
 * @return errors if even one piece of information
 * is invalid
 */
function usersValidation()
{
    $accessVal = array("Alerts", "Events", "Programs", "Partners","FinancialAid", "Resources", "Staff", "StudentWork","Users");
    // define variables and set to empty values
    $errors = array();
    $stringAccessLevel = "";
    $userName = $password = $confirmPassword = $accessLevel = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $userName = test_input($_POST["userName"]);
        $password = test_input($_POST["password"]);
        $confirmPassword = test_input($_POST["confirmPassword"]);
        $accessLevel = $_POST["accessLevel"];
        $database = new Database();

        $go = $database->getAdminByUsername($userName);

        /* username validation */
        if (!isset($_POST["userName"]) || $_POST['userName'] == "") {

            array_push($errors, "** A username is required **");

        } else if (gettype($go) != 'boolean') {

            array_push($errors, "** User Name is already taken **");

        } else if (!preg_match("/^[a-zA-Z]*$/", $userName)) {

            array_push($errors, "** Only letters are allowed in the username **");

        } else if (!preg_match("#.*^(?=.{5,15}).*$#", $userName)) {

            array_push($errors, "** User Name must be between 5 and 15 letters**");

        } else {


        }
        /* Password validation */
        if (!isset($_POST["password"]) || $_POST['password'] == "") {

            array_push($errors, "** A password is required **");

        } else if (!($password == $confirmPassword)) {

            array_push($errors, "** Passwords does not match **");

        } else if (!preg_match("#.*^(?=.{8,15})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$#", $password)) {
            array_push($errors, "** Password must contain at least 8 characters, but no more than 15.
            At least one lowercase letter, one uppercase letter, and one number **");

        } else {

        }

        /* Access level validation */
        if (!isset($_POST["accessLevel"]) || $_POST['accessLevel'] == "") {
            //Some thing is really wrong if this message shows, this value is set by radio buttons
            array_push($errors, "** An access level is required **");

        } else {
            $check = true;
            foreach ($accessLevel as $value) {
                if (!in_array( $value, $accessVal)) {
                    $check = false;
                }

            }
            if (!$check) {
                array_push($errors, "** Invalid access level **");
            } else {
                $stringAccessLevel = implode(",",$accessLevel);
            }

        }

    }
    if (sizeof($errors) <= 0) {
        $hash = password_hash($password, PASSWORD_BCRYPT, array("cost" => 10));
        while (!password_verify($password, $hash)) {
            $hash = password_hash($password, PASSWORD_BCRYPT);
        }


        $database->insertIntoUsers($userName,
            $hash,
            $stringAccessLevel,
            1);
    }
    return $errors;

}

/**
 * Verify if the information being entered
 * for a registered user is valid
 * @param  the id of the user being edited
 *
 * @return errors if even one piece of information
 *
 * is invalid
 */
function usersEditValidation($id)
{
    $accessVal = array("Alerts", "Events", "Programs", "Partners","FinancialAid", "Resources", "Staff", "StudentWork","Users");

    // define variables and set to empty values
    $errors = array();

    $userName = $password = $confirmPassword = $accessLevel = $active= "";
    $userName = test_input($_POST["userName"]);
    $password = test_input($_POST["password"]);
    $confirmPassword = test_input($_POST["confirmPassword"]);
    $accessLevel = $_POST["accessLevel"];
    $active = test_input($_POST["active"]);

    $database1 = new Database();

    $oldAdmin = $database1->getAdminById($id);

    $stringAccessLevel ="";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        /* username validation */
        if ($oldAdmin['username'] != $userName) {
            $testing = $database1->getAdminByUsername($userName);
            if (!isset($_POST["userName"]) || $_POST['userName'] == "") {

                array_push($errors, "** A username is required **");

            } else if (gettype($testing) != 'boolean') {

                array_push($errors, "** User Name is already taken **");

            } else if (!preg_match("/^[a-zA-Z]*$/", $userName)) {

                array_push($errors, "** Only letters are allowed in the username **");

            } else if (!preg_match("#.*^(?=.{5,15}).*$#", $userName)) {

                array_push($errors, "** User Name must be between 5 and 15 letters**");

            }
        }



        /* Password validation */
        if (!($password == "")) {

            if (!($password == $confirmPassword)) {

                array_push($errors, "** Passwords does not match **");

            } else if (password_verify($password,$oldAdmin['password'])) {
                array_push($errors, "** Password cannot be reused**");

            }else if (!preg_match("#.*^(?=.{8,15})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$#", $password)) {
                array_push($errors, "** Password must contain at least 8 characters, but no more than 15.
            At least one lowercase letter, one uppercase letter, and one number **");

            }
        }
        /* Access level validation */
        if (!(!isset($_POST["accessLevel"]) || $_POST['accessLevel'] == "")) {
            $check = true;
            foreach ($accessLevel as $value) {
                if (!in_array( $value, $accessVal)) {
                    $check = false;
                }

            }
            if(!$check) {
                array_push($errors, "** Invalid access level **");
            } else {
                $stringAccessLevel = implode(",",$accessLevel);
            }

        } else {
            array_push($errors, "** Please select access levels **");
        }
    }
    //array_push($errors, $_POST["accessLevel"]);
    if (sizeof($errors ) <=0)
    {

        if($password!="") {
            $hash = password_hash($password, PASSWORD_BCRYPT, array("cost" => 10));
            while(!password_verify($password, $hash)) {
                $hash = password_hash($password, PASSWORD_BCRYPT);
            }
            $password = $hash;
        }



        $database1->updateUsers( $id,
            $userName,
            $password,
            $stringAccessLevel,
            1);

    }

    return $errors;

}

/**
 * Remove any special characters the user
 * might have added to prevent data tampering
 */
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

/**
 * Verify if the information being entered
 * for a current staff member is valid
 *
 * @return errors if even one piece of
 * information is invalid
 */
function validateStaffEdit($id) {
    $errors = array();
    if(!($_POST['staffName'] == null || $_POST['staffName'] == '')) {
        $split = explode(" ", $_POST['staffName']);
        $firstName = $split[0];
        $lastName = $split[1];
    } else {
        array_push($errors,"Please enter a name");
    }
    if(!($_POST['staffJobTitle'] == null) || !($_POST['staffJobTitle'] == '')) {
        $staffJobTitle = $_POST['staffJobTitle'];
    } else {
        array_push($errors,"Please enter a job title");
    }
    if(!($_POST['staffOrganization'] == null) || !($_POST['staffOrganization'] == '')) {
        $staffOrganization = $_POST['staffOrganization'];
    } else {
        array_push($errors,"Please enter a job organization");
    }
    if(!($_POST['staffCredentials'] == null) || !($_POST['staffCredentials'] == '')) {
        $staffCredentials = $_POST['staffCredentials'];
    } else {
        array_push($errors,"Please enter a job credentials");
    }
    if(!($_POST['staffDepartment'] == null) || !($_POST['staffDepartment'] == '')) {
        $staffDepartment = $_POST['staffDepartment'];
    } else {
        array_push($errors,"Please enter a job department");
    }
    if(!($_POST['staffContact'] == null) || !($_POST['staffContact'] == '')) {
        if(strpos($_POST['staffContact'], '/') == false) {
            if(strpos($_POST['staffContact'], '@') == false)
            {
                $phone = $_POST['staffContact'];
                $email = "";
            } else {
                $email = $_POST['staffContact'];
                $phone= "";
            }
        } else {
            $split = explode('/', $_POST['staffContact']);
            if(strpos($split[0], '@') !== false) {
                $email = $split[0];
                $phone = $split[1];
            } else {
                $email = $split[1];
                $phone= $split[0];
            }
        }
    } else {
        array_push($errors,"Please enter a form of contact");
    }
    if(!($_POST['staffDescription'] == null) || !($_POST['staffDescription'] == '')) {
        $staffDescription = $_POST['staffDescription'];
    } else {
        array_push($errors,"Please enter a description");
    }
    if(!($_FILES['fileToUpload']['name'] == null))
    {
        $image = validateImage($_FILES['fileToUpload']);
        if(is_array($image)) {
            array_merge($errors,$image);
        }
        if(!(sizeof($errors) == 0))
        {
            return $errors;
        } else {
            $database = new Database();
            $database->updateStaff($id, $_POST['staffTitle'], $lastName, $firstName, $staffCredentials, $staffOrganization, $staffDepartment,
                $staffJobTitle, $staffDescription, $_POST['staffHiredDate'], $_POST['staffLocation'], $email, $phone, $image, 1);
            return true;
        }
    } else {
        if(!(sizeof($errors) == 0))
        {
            return $errors;
        } else {
            $database = new Database();
            $database->updateStaffNoPic($id, $_POST['staffTitle'], $lastName, $firstName, $staffCredentials, $staffOrganization, $staffDepartment,
                $staffJobTitle, $staffDescription, $_POST['staffHiredDate'], $_POST['staffLocation'], $email, $phone, 1);
            return true;
        }
    }
}

/**
 * Verify if the information being entered
 * for a new staff member is valid
 *
 * @return errors if even one piece of
 * information is invalid
 */
function validateStaffAdd() {
    $errors = array();
    if(!($_POST['staffName'] == null || $_POST['staffName'] == '')) {
        $split = explode(" ", $_POST['staffName']);
        $firstName = $split[0];
        $lastName = $split[1];
    } else {
        array_push($errors,"Please enter a name");
    }
    if(!($_POST['staffJobTitle'] == null) || !($_POST['staffJobTitle'] == '')) {
        $staffJobTitle = $_POST['staffJobTitle'];
    } else {
        array_push($errors,"Please enter a job title");
    }
    if(!($_POST['staffOrganization'] == null) || !($_POST['staffOrganization'] == '')) {
        $staffOrganization = $_POST['staffOrganization'];
    } else {
        array_push($errors,"Please enter a job organization");
    }
    if(!($_POST['staffCredentials'] == null) || !($_POST['staffCredentials'] == '')) {
        $staffCredentials = $_POST['staffCredentials'];
    } else {
        array_push($errors,"Please enter a job credentials");
    }
    if(!($_POST['staffDepartment'] == null) || !($_POST['staffDepartment'] == '')) {
        $staffDepartment = $_POST['staffDepartment'];
    } else {
        array_push($errors,"Please enter a job department");
    }
    if(!($_POST['staffContact'] == null) || !($_POST['staffContact'] == '')) {
        if(strpos($_POST['staffContact'], '/') == false) {
            if(strpos($_POST['staffContact'], '@') == false)
            {
                $phone = $_POST['staffContact'];
                $email = "";
            } else {
                $email = $_POST['staffContact'];
                $phone= "";
            }
        } else {
            $split = explode('/', $_POST['staffContact']);
            if(strpos($split[0], '@') == false && strpos($split[1], '@' == true)) {
                $email = $split[1];
                $phone = $split[0];
            } else {
                $email = $split[0];
                $phone= $split[1];
            }
        }
    } else {
        array_push($errors,"Please enter a form of contact");
    }
    if(!($_FILES['fileToUpload']['name'] == null))
    {
        $image = validateImage($_FILES['fileToUpload']);
        if(is_array($image)) {
            array_merge($errors,$image);
        }
    } else {
        $image = 'asset/img/bioPlaceHolder.jpg';
    }
    if(!($_POST['staffDescription'] == null) || !($_POST['staffDescription'] == '')) {
        $staffDescription = $_POST['staffDescription'];
    } else {
        array_push($errors,"Please enter a description");
    }
    if(!(sizeof($errors) == 0))
    {
        return $errors;
    } else {
        $database = new Database();
        $database->addStaff($_POST['staffTitle'], $lastName, $firstName, $staffCredentials, $staffOrganization, $staffDepartment,
            $staffJobTitle, $staffDescription, $_POST['staffHiredDate'], $_POST['staffLocation'], $email, $phone, $image, 1);
        return true;
    }
}

/**
 * Verify if the information being edited
 * for an alert is valid
 *
 * @return errors if even one piece of
 * information is invalid
 */
function validateAlertEdit($id) {
    $errors = array();
    $database = new Database();

    if(!($_POST['alertName'] == null || $_POST['alertName'] == '')) {
        $alertName = $_POST['alertName'];

    } else {
        array_push($errors,"Please enter an alert name");
    }

    if(!($_POST['alertMessage'] == null) || !($_POST['alertMessage'] == '')) {
        $alertMessage = $_POST['alertMessage'];
    } else {
        array_push($errors,"Please enter a message for the alert");
    }

    if(!(sizeof($errors) == 0))
    {
        return $errors;
    } else {
        $database->updateAlert($id, $alertName, $alertMessage);
        return true;
    }
}

/**
 * Verify if the information being entered
 * for a new alert is valid
 *
 * @return errors if even one piece of
 * information is invalid
 */
function validateAlertAdd() {
    $errors = array();
    $database = new Database();

    if(!($_POST['alertName'] == null || $_POST['alertName'] == '')) {
        $alertName = $_POST['alertName'];

    } else {
        array_push($errors,"Please enter an alert name");
    }

    if(!($_POST['alertMessage'] == null) || !($_POST['alertMessage'] == '')) {
        $alertMessage = $_POST['alertMessage'];
    } else {
        array_push($errors,"Please enter a message for the alert");
    }

    if(!(sizeof($errors) == 0))
    {
        return $errors;
    } else {
        $database->addAlert($alertName, $alertMessage, 1);
        return true;
    }
}

/**
 * Verify if the information being entered
 * for a new piece of student work is valid
 *
 * @return errors if even one piece of
 * information is invalid
 */
function validateStudentWorkAdd() {
    $errors = array();
    $database = new Database();
    if(!($_POST['studentName'] == null || $_POST['studentName'] == '')) {
        $studentName = $_POST['studentName'];
    } else {
        array_push($errors,"Please enter a student's name");
    }
    if(!($_POST['projectName'] == null) || !($_POST['projectName'] == '')) {
        $projectName = $_POST['projectName'];
    } else {
        array_push($errors,"Please enter a project name");
    }
    if(!($_POST['projectDescription'] == null) || !($_POST['projectDescription'] == '')) {
        $projectDescription = $_POST['projectDescription'];
    } else {
        array_push($errors,"Please enter a project description");
    }

    if($_FILES['fileToUpload']['name'] == null || $_FILES['fileToUpload']['name'] == '')
    {
        array_push($errors, "Please enter a project file");
    } else {
        $file = validateFile($_FILES['fileToUpload']);
        if(is_array($file)) {
            array_merge($errors,$file);
        }
    }

    if(!(sizeof($errors) == 0))
    {
        return $errors;
    } else {
        $database->addStudentWork($studentName, $projectName, $projectDescription, $file);
        return true;
    }
}

/**
 * Verify if the information being edited
 * for a piece of student work is valid
 *
 * @return errors if even one piece of
 * information is invalid
 */
function validateStudentWorkEdit($id) {
    $errors = array();
    $database = new Database();
    if(!($_POST['studentName'] == null || $_POST['studentName'] == '')) {
        $studentName = $_POST['studentName'];
    } else {
        array_push($errors,"Please enter a student's name");
    }
    if(!($_POST['projectName'] == null) || !($_POST['projectName'] == '')) {
        $projectName = $_POST['projectName'];
    } else {
        array_push($errors,"Please enter a project name");
    }
    if(!($_POST['projectDescription'] == null) || !($_POST['projectDescription'] == '')) {
        $projectDescription = $_POST['projectDescription'];
    } else {
        array_push($errors,"Please enter a project description");
    }
    if($_FILES['fileToUpload'] == null || $_FILES['fileToUpload'] == '') {
        if(!(sizeof($errors) == 0))
        {
            return $errors;
        } else {
            $database->updateStudentWorkNFile($id, $studentName, $projectName, $projectDescription);
            return true;
        }
    } else {
        $file = validateFile($_FILES['fileToUpload']);

        if(is_array($file)) {
            array_merge($errors,$file);
        }
        if(!(sizeof($errors) == 0))
        {
            return $errors;
        } else {
            $database->updateStudentWorkWFile($id, $studentName, $projectName, $projectDescription, $file);
            return true;
        }
    }
}

/**
 * Verify if a file being uploaded is of
 * the right file format and has not already
 * been uploaded
 *
 * @return errors if even one piece of
 * information entered is invalid
 */
function validateFile($file) {
    $database = new Database();
    $number = $database->getNumberOfFiles() + 1;
    $target_dir = "asset/files/";
//creates file path
    $target_file = $target_dir . $number . basename($file["name"]);
//set errors
    $errors = array();
    $fileType = pathinfo($target_file,PATHINFO_EXTENSION);

// Check if file already exists
    if (file_exists($target_file)) {
        array_push($errors,"Sorry, file already exists.");
    }

// Allow certain file formats
    if($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg" && $fileType != "pdf" && $fileType != "doc"
        && $fileType != "docx" && $fileType != "txt") {
        array_push($errors,'Only JPG, PNG, JPEG, PDF, DOC, DOCX, or TXT files can be uploaded');
    }
// Check if $errors is set to 1 by an error
    if (sizeof($errors) > 0) {
        return $errors;
// Try to upload the image
    } else {

        if (move_uploaded_file($file['tmp_name'], $target_file)) {
            return $target_file;
        } else {
            return $errors;
        }
    }
}

/**
 * Verify if a file being uploaded is an image,
 * is not too large, and is of the right format
 *
 * @return errors if even one of the criteria
 * above is not met
 */
function validateImage($image) {
    $target_dir = "asset/img/";

    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

//set errors
    $errors = array();
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

// Check if image file is an actual image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            array_push($errors,"File is an image - " . $check["mime"] . ".");
            $errors = 0;
        } else {
            array_push($errors,"File is not an image.");
        }
    }

// Check file size
    if ($_FILES["fileToUpload"]["size"] > 7500000) {
        array_push($errors,"Sorry, your file is too large.");
    }

// Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "JPEG"
        && $imageFileType != "JPG") {
        array_push($errors,"Sorry, only JPG, JPEG and PNG files are allowed.");
    }

    // Check if $errors is set to 1 by an error
    if (sizeof($errors) > 0) {
        return $errors;
// Try to upload the image
    } else {
        if (move_uploaded_file($image["tmp_name"], $target_file)) {
            return $target_file;
        }
    }
}

/**
 * Verify if information being entered in
 * the form at the footer is valid
 *
 * @return errors if one of the fields has
 * invalid information
 */
function validateMessageFooter() {
    $errors = array();
    $email = $questions= "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!isset($_POST["email"]) || $_POST['email'] == "") {

            array_push($errors, "** A name is required **");

        } else if (!preg_match("/^[a-zA-Z ]*$/",test_input($_POST["name"]))) {
            array_push($errors, "** Name: Only letters and white space allowed **");
        } else {
            $name = test_input($_POST["name"]);
        }

        if (!isset($_POST["phone"]) || $_POST['phone'] == "") {
            $phone = "";
        } else {
            $phone = test_input($_POST["phone"]);
        }

        if (!isset($_POST["ext"]) || $_POST['ext'] == "") {
            $ext = "";
        } else {
            $ext = test_input($_POST["ext"]);
        }

        if (!isset($_POST["email"]) || $_POST['email'] == "") {
            array_push($errors, "** An email is required **");
        } else if (!filter_var(test_input($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "** Invalid email format **");
        }else {
            $email = test_input($_POST["email"]);
        }

        if (!isset($_POST["questions"]) || $_POST['questions'] == "") {
            array_push($errors, "** A comment is required **");
        } else {
            $questions = test_input($_POST["questions"]);
        }
    }

    return $errors;

}

/**
 * Verify if information entered in the
 * apply online form is valid
 *
 * @return errors if even one field has
 * invalid information
 */
function validateApplicant() {
    $errors = array();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!isset($_POST["fname"]) || $_POST['fname'] == "") {

            array_push($errors, "** First name is required **");

        } else if (!preg_match("/^[a-zA-Z ]*$/",test_input($_POST["fname"]))) {
            array_push($errors, "** Only letters and white space allowed **");
        } else {
            $fname = test_input($_POST["fname"]);
        }

        if (!isset($_POST["lname"]) || $_POST['lname'] == "") {

            array_push($errors, "** Last name is required **");

        } else if (!preg_match("/^[a-zA-Z ]*$/",test_input($_POST["lname"]))) {
            array_push($errors, "** Only letters and white space allowed **");
        } else {
            $lname = test_input($_POST["lname"]);
        }

        if (!isset($_POST["email"]) || $_POST['email'] == "") {
            array_push($errors, "** e-mail address is required **");
        } else if (!filter_var(test_input($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "** Invalid email format **");
        }else {
            $email = test_input($_POST["email"]);
        }

        if (!isset($_POST["birthdate_m"]) && !isset($_POST["birthdate_d"]) &&
            !isset($_POST["birthdate_y"])) {
            array_push($errors, "** Complete birthdate is required **");
        } else {
            $birthdate_m = test_input($_POST["birthdate_m"]);
            $birthdate_d = test_input($_POST["birthdate_d"]);
            $birthdate_y = test_input($_POST["birthdate_y"]);
        }

        if(!(sizeof($errors) == 0))
        {
            return $errors;
        } else {
            $database = new Database();
            $database->addApplicant($fname, $lname, $email, $birthdate_m."/".$birthdate_d."/".$birthdate_y);
            return true;
        }
    }
}

/**
 * Verify if information entered
 * for a new event is valid
 *
 * @return errors if there is invalid
 * information
 */
function validateEventAdd()
{
    $db = new Database();

    $errors = array();
    $priorityLevel = array("1", "2","3");
    if(!($_POST['eventName'] == null) || !($_POST['eventName'] == "")) {
        $eventName = $_POST['eventName'];
    } else {
        array_push($errors,"Please enter an event name");
    }

    if(!($_POST['description'] == null) || !($_POST['description'] == "")) {
        $description = $_POST['description'];
    } else {
        array_push($errors,"Please enter an event description");
    }

    if(!($_POST['dateStart'] == null) || !($_POST['dateStart'] == "")) {
        $dateStart = $_POST['dateStart'];
    } else {
        array_push($errors,"Please enter a starting date");
    }

    if(!($_POST['dateEnd'] == null) || !($_POST['dateEnd'] == "")) {
        $dateEnd = $_POST['dateEnd'];
    } else {
        array_push($errors,"Please enter an ending date");
    }

    if(!($_POST['Times'] == null) || !($_POST['Times'] == "")) {
        $times = $_POST['Times'];
    } else {
        array_push($errors,"Please enter event times");
    }

    if ((isset($_POST['priority']) || $_POST['priority'] == "")) {

        $check = true;

            if (!in_array( $_POST['priority'], $priorityLevel))  {
                $check = false;
            }


        if(!$check) {
            array_push($errors, "Invalid Priority level");
        } else {
            $priority = test_input($_POST['priority']);
        }


    } else {
        array_push($errors,"Please select a priority");
    }

    if(!($_FILES['fileToUpload']['name'] == null) || !($_FILES['fileToUpload']['name'] == ""))

    {
        $image = validateImage($_FILES['fileToUpload']);
        if(is_array($image)) {
            array_push($errors,  implode($image) );
        }
    } else {
        $number = rand(1, 3);
        $image = 'asset/img/carousel_' . $number . '.jpg';
    }

    if(sizeof($errors) > 0) {

        return $errors;
    } else {


        $db->insertIntoEvents($eventName, $_POST['Category'], $description,
            $dateEnd, $dateStart, $times, $_POST['Location'],
            $image,$priority, 1);

        return true;
    }
}

/**
 * Verify if information entered
 * for an event being edited is valid
 *
 * @return errors if there is invalid
 * information
 */
function validateEventUpdate($id)
{
    $db = new Database();

    $errors = array();
    $priorityLevel = array("1", "2","3");
    if(!($_POST['eventName'] == null) || !($_POST['eventName'] == "")) {
        $eventName = $_POST['eventName'];
    } else {
        array_push($errors,"Please enter an event name");
    }

    if(!($_POST['description'] == null) || !($_POST['description'] == "")) {
        $description = $_POST['description'];
    } else {
        array_push($errors,"Please enter an event description");
    }

    if(!($_POST['dateStart'] == null) || !($_POST['dateStart'] == "")) {
        $dateStart = $_POST['dateStart'];
    } else {
        array_push($errors,"Please enter a starting date");
    }

    if(!($_POST['dateEnd'] == null) || !($_POST['dateEnd'] == "")) {
        $dateEnd = $_POST['dateEnd'];
    } else {
        array_push($errors,"Please enter an ending date");
    }

    if(!($_POST['Times'] == null) || !($_POST['Times'] == "")) {
        $times = $_POST['Times'];
    } else {
        array_push($errors,"Please enter event times");
    }

    if ((isset($_POST['priority']) || $_POST['priority'] == "")) {

        $check = true;

        if (!in_array( $_POST['priority'], $priorityLevel))  {
            $check = false;
        }


        if(!$check) {
            array_push($errors, "Invalid Priority level");
        } else {
            $priority = test_input($_POST['priority']);
        }


    } else {
        array_push($errors,"Please select a priority");
    }

    if(!($_FILES['fileToUpload']['name'] == null))
    {

        $image = validateImage($_FILES['fileToUpload']);

        if(is_array($image)) {
            array_push($errors, implode( $image));
        }

        if(!(sizeof($errors) == 0))
        {
            return $errors;
        } else {

            $db->updateEventsWPic($id, $eventName, $_POST['Category'], $description,
                $dateEnd, $dateStart, $times, $_POST['Location'], $image, $priority, 1);

            return true;
        }
    }else {
        if (!(sizeof($errors) == 0)) {
            return $errors;
        } else {

            $db->updateEventsNPic($id, $eventName, $_POST['Category'], $description,
                $dateEnd, $dateStart, $times, $_POST['Location'],$priority, 1);
            return true;
        }
    }
}

/**
 * Verify if information entered
 * for a new financial aid resource
 * is valid
 *
 * @return errors if there is invalid
 * information
 */
function validateAddFinancialAid()
{
    $db = new Database();

    $errors = array();

    if(!($_POST['resource_name'] == null) || !($_POST['resource_name'] == "")) {
        $resource_name = $_POST['resource_name'];
    } else {
        array_push($errors,"Please enter a resource name");
    }

    if(!($_POST['resource_info'] == null) || !($_POST['resource_info'] == "")) {
        $resource_info = $_POST['resource_info'];
    } else {
        array_push($errors,"Please enter a description for this resource");
    }

    if(isset($_POST["resource_link"]) && $_POST['resource_link'] != "") {
        if (filter_var($_POST["resource_link"], FILTER_VALIDATE_URL)===false) {
            array_push($errors,"Please enter a valid link");
        } else {
            $resource_link = $_POST['resource_link'];
        }
    }

    if(sizeof($errors) > 0) {
        return $errors;
    } else {
        $active = 1;

        $db->insertIntoFinancialAid($resource_name, $resource_info,
            $resource_link, 1);

        return true;
    }
}

/**
 * Verify if information entered
 * for a financial aid resource
 * being edited is valid
 *
 * @return errors if there is invalid
 * information
 */
function validateUpdateFinancialAid($id) {
    $db = new Database();

    $errors = array();

    if(!($_POST['resource_name'] == null) || !($_POST['resource_name'] == "")) {
        $resource_name = $_POST['resource_name'];
    } else {
        array_push($errors,"Please enter a resource name");
    }

    if(!($_POST['resource_info'] == null) || !($_POST['resource_info'] == "")) {
        $resource_info = $_POST['resource_info'];
    } else {
        array_push($errors,"Please enter a description for this resource");
    }

    if(isset($_POST["resource_link"]) && $_POST['resource_link'] != "") {
        if (filter_var($_POST["resource_link"], FILTER_VALIDATE_URL)===false) {
            array_push($errors,"Please enter a valid link");
        } else {
            $resource_link = $_POST['resource_link'];
        }
    }

    if(sizeof($errors) > 0) {
        return $errors;
    } else {

        $db->updateFinancialAid($id, $resource_name, $resource_info,
            $resource_link);

        return true;
    }
}

/**
 * Verify if information entered
 * for a resource being edited is
 * valid
 *
 * @return errors if there is invalid
 * information
 */
function validateEditResource($id) {
    $db = new Database();
    $errors = array();


    $name = test_input($_POST["name"]);

    $contactName = test_input($_POST["contactName"]);
    $contactPhone = test_input($_POST["contactPhone"]);
    $contactEmail = test_input($_POST["contactEmail"]);
    $link =  test_input($_POST["link"]);
    $description = test_input($_POST["description"]);

    $changed = false;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {


        /* username validation */


        if (!isset($_POST["name"]) || $_POST['name'] == "") {

            array_push($errors, "Please enter a name for the resource");

        } else {
            $changed = true;
        }
        if(isset($_POST["contactName"]) && $_POST['contactName'] != "") {
            $changed = true;
            if (!preg_match("/^[a-zA-Z ]*$/", $contactName)) {
                array_push($errors, "Please use only letters for Contact Name");
            }
        }
//        ^\(*\+*[1-9]{0,3}\)*-*[1-9]{0,3}[-. /]*\(*[2-9]\d{2}\)*[-. /]*\d{3}[-. /]*\d{4} *e*x*t*\.* *\d{0,4}$
        if(isset($_POST["contactPhone"]) && $_POST['contactPhone'] != "") {
            $changed = true;
            if (!preg_match("/^\s*(?:\+?(\d{1,3}))?([-. (]*(\d{3})[-. )]*)?((\d{3})[-. ]*(\d{2,4})(?:[-.x ]*(\d+))?)\s*$/", $contactPhone)) {
                array_push($errors, "Please use valid phone number format. Example: (333) 333-3333");
            }
        }

        if(isset($_POST["contactEmail"]) && $_POST['contactEmail'] != "") {
            $changed = true;
            if (!filter_var(test_input($_POST["contactEmail"]), FILTER_VALIDATE_EMAIL)) {
                array_push($errors, "Please enter a valid email format");
            }
        }
        if(isset($_POST["link"]) && $_POST['link'] != "") {
            $changed = true;
            if (filter_var($link, FILTER_VALIDATE_URL)===false) {
                array_push($errors, "Please enter a valid link");
            }
        }
        if (!isset($_POST["description"]) || $_POST['description'] == "") {

            array_push($errors, "Please enter a description for the resource");

        } else {
            $changed = true;
        }

        if (sizeof($errors) > 0 )
        {
            return $errors;
        } else {
            $db->updateResources($id, $name, $description, $contactName,
                $contactPhone, $contactEmail, $link, 1);
            return true;
        }
    }
}

/**
 * Verify if information entered
 * for a new resource is valid
 *
 * @return errors if there is invalid
 * information
 */
function validateAddResources() {
    $db = new Database();
    $errors = array();

    $name = test_input($_POST["name"]);
    $contactName = test_input($_POST["contactName"]);
    $contactPhone = test_input($_POST["contactPhone"]);
    $contactEmail = test_input($_POST["contactEmail"]);
    $link = filter_var( $_POST["link"], FILTER_VALIDATE_URL);
    $description = test_input($_POST["description"]);

    $changed = false;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {


        /* username validation */


        if (!isset($_POST["name"]) || $_POST['name'] == "") {

            array_push($errors, "Please enter a name for the resource");

        } else {
            $changed == true;
            $name = $_POST["name"];
        }

        if(isset($_POST["contactName"]) && $_POST['contactName'] != "") {
            $changed == true;
            if (!preg_match("/^[a-zA-Z ]*$/", $contactName)) {
                array_push($errors, "Please use only letters for Contact Name");
            }
        }
        if(isset($_POST["contactPhone"]) && $_POST['contactPhone'] != "") {
            $changed == true;
            $changed = true;
            if (!preg_match("/^\s*(?:\+?(\d{1,3}))?([-. (]*(\d{3})[-. )]*)?((\d{3})[-. ]*(\d{2,4})(?:[-.x ]*(\d+))?)\s*$/", $contactPhone)) {
                array_push($errors, "Please use valid phone number format. Example: (333) 333-3333");
            }
        }

        if(isset($_POST["contactEmail"]) && $_POST['contactEmail'] != "") {
            $changed == true;
            if (!filter_var(test_input($_POST["contactEmail"]), FILTER_VALIDATE_EMAIL)) {
                array_push($errors, "Please enter a valid email format");
            }
        }
        if(isset($_POST["link"]) && $_POST['link'] != "") {
            $changed == true;
            if (filter_var($link, FILTER_VALIDATE_URL)===false) {
                array_push($errors, "Please enter a valid link");
            }
        }
        if (!isset($_POST["description"]) || $_POST['description'] == "") {

            array_push($errors, "Please enter a description for the resource");

        } else {
            $changed == true;
            $description = $_POST["description"];
        }
        
        if (!(sizeof($errors ) == 0))
        {
            return $errors;
        }  else {
            $db->addResources($name, $description,
                $contactName, $contactPhone, $contactEmail,$link, 1);
            return true;
        }
    }
}

function contactusEmails($emailToSendTo)
{

    // define variables and set to empty values

    $name = $email = $phone = $questions = $ext = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $emailBody = 'Name: ' . test_input($_POST['name']) . "\n";
        $emailBody .= 'Email: ' . test_input($_POST['email']) . "\n";
        if (!($_POST['phone'] == "")) {
            $emailBody .= 'Phone#: ' . test_input($_POST['phone']) . "\n";
            if (!($_POST['ext'] == "")) {
                $emailBody .= 'ext: ' . test_input($_POST['ext']) . "\n";
            }

        }
        $emailBody .= 'Comments: ' . test_input($_POST['questions']) . "\n";
        $emailBody = str_replace("\n.", "\n..", $emailBody);
        mail($emailToSendTo, "Comments/Questions", $emailBody);

    }

}
function footerEmails($emailToSendTo)
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $emailBody = 'Email: ' . test_input($_POST['email']) . "\n";
        $emailBody .= 'Question: ' . test_input($_POST['question']) . "\n";
        $emailBody = str_replace("\n.", "\n..", $emailBody);
        mail($emailToSendTo, "Comments/Questions", $emailBody);
    }
}
?>