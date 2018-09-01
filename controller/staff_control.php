<?php

/**
 * Created by PhpStorm.
 * User: Lucas Harlor
 * Date: 4/21/17
 * Time: 11:18 AM
 */
class StaffControl
{
    private $_f3;
    private $_params;

    /**
     * ViewControl constructor.
     * @param $_f3
     * @param $_params
     */
    public function __construct($_f3, $_params)
    {
        $this->_f3 = $_f3;
        $this->_params = $_params;
    }
    
    /**
     * ViewControl constructor.
     * @param $_f3
     * @param $_params
     */
    public function viewStaff()
    {
        $database = new Database();
        $staff = $database->getAllActiveStaff();
        $staffArray = array();
        
        foreach ($staff as $member)
        {
            $person = new Staff($member['BioID'], $member['Title'], $member['LastName'], $member['FirstName'], $member['JobTitle'], $member['Organization'],
                                $member['Credential'], $member['Department'], $member['Description'], $member['DateHired'], $member['Location'],
                                $member['Email'], $member['PhoneNumber'], $member['PhotoFilePath']);
           
            array_push($staffArray, $person);
        }
        $staffsize = sizeof($staffArray);
        $this->_f3->set('staff', $staffArray);
        $this->_f3->set('staffsize', $staffsize);
        echo Template::instance()->render('view/include/head.php');
        echo Template::instance()->render('view/include/top-nav.php');
        echo Template::instance()->render('view/staff.php');
        echo Template::instance()->render('view/include/footer.php');
    }
    
    public function viewEditStaff()
    {
        $database = new Database();
        $id = $this->_params['id'];

        $results = $database->getStaffById($id);

        $staff = new Staff($results['BioID'], $results['Title'], $results['LastName'], $results['FirstName'], $results['JobTitle'], $results['Organization'],
                           $results['Credential'], $results['Department'], $results['Description'], $results['DateHired'], $results['Location'], $results['Email'],
                           $results['PhoneNumber'], $results['PhotoFilePath']);
        $this->_f3->set('Staff', $staff);
        
        echo Template::instance()->render('view/include/head.php');
        echo Template::instance()->render('view/include/top-nav.php');
        echo Template::instance()->render('view/edit-staff.php');
        echo Template::instance()->render('view/include/footer.php');
    }
    
    public function viewAddStaff()
    {
        echo Template::instance()->render('view/include/head.php');
        echo Template::instance()->render('view/include/top-nav.php');
        echo Template::instance()->render('view/edit-staff.php');
        echo Template::instance()->render('view/include/footer.php');
    }
    
    public function postEditStaff()
    {
        $id = $this->_params['id'];
        $errors = validateStaffEdit($id);

        if(!($errors === true))
        {

            $database = new Database();
            $id = $this->_params['id'];

            $results = $database->getStaffById($id);

            $staff = new Staff($results['BioID'], $results['Title'], $results['LastName'], $results['FirstName'], $results['JobTitle'], $results['Organization'],
                $results['Credential'], $results['Department'], $results['Description'], $results['DateHired'], $results['Location'], $results['Email'],
                $results['PhoneNumber'], $results['PhotoFilePath']);
            $this->_f3->set('Staff', $staff);
            $this->_f3->set('errors', $errors);
            echo Template::instance()->render('view/include/head.php');
            echo Template::instance()->render('view/include/top-nav.php');
            echo Template::instance()->render('view/edit-staff.php');
            echo Template::instance()->render('view/include/footer.php');
        } else {

            $this->_f3->reroute('/Admin');
        }
    }

    public function postAddStaff()
    {
        $errors = validateStaffAdd();

        if(!($errors === true))
        {
            $this->_f3->set('errors', $errors);
            echo Template::instance()->render('view/include/head.php');
            echo Template::instance()->render('view/include/top-nav.php');
            echo Template::instance()->render('view/edit-staff.php');
            echo Template::instance()->render('view/include/footer.php');
        } else {
            $this->_f3->reroute('/Admin');
        }
    }
    
    public function deleteStaff()
    {
        $database = new Database();
        $id = $this->_params['id'];
        $database->deleteStaff($id);
        $this->_f3->reroute('/Admin');
    }

    public function reactivateStaff()
    {
        $database = new Database();
        $id = $this->_params['id'];
        $database->reactivateStaff($id);
        $this->_f3->reroute('/Admin');
    }

    /**
     *This function checks session to see if a user is currently logged in. If they are then we retreive their current funds and set them to logged in.
     *
     *@access public
     */
    public function isLoggedIn()
    {
        $database = new Database();
        $loggedIn = $database->getAdminByUsername($_SESSION['user']);
        $admin = new Admin($loggedIn['adminId'], $loggedIn['username'], $loggedIn['adminLevel'], $loggedIn['active']);
        if(isset($_SESSION['user']) === true && strpos($admin->getAdminLevel(), Staff) !== false && $admin->getActive() == 1) {
            $testLogin = true;
        } else {
            $this->_f3->reroute('/Login');
        }
        $this->_f3->set('login', $testLogin);
        $this->_f3->set('admin', $admin);
    }

    public function getAdmin()
    {
        $database = new Database();
        $loggedIn = $database->getAdminByUsername($_SESSION['user']);
        $admin = new Admin($loggedIn['adminId'], $loggedIn['username'], $loggedIn['adminLevel'], $loggedIn['active']);
        if(isset($_SESSION['user']) === true) {
            $this->_f3->set('admin', $admin);
        }
    }
}