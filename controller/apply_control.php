<?php

/**
 * User: Lucas
 * Date: 4/26/17
 */
class ApplyControl
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

    public function viewApply()
    {
        echo Template::instance()->render('view/include/head.php');
        echo Template::instance()->render('view/include/top-nav.php');
        echo Template::instance()->render('view/apply_online.php');
        echo Template::instance()->render('view/include/footer.php');
    }

    public function viewAddApplicant()
    {

        $errors = validateApplicant();

        if(!($errors === true))
        {
            $this->_f3->set('errors', $errors);
            echo Template::instance()->render('view/include/head.php');
            echo Template::instance()->render('view/include/top-nav.php');
            echo Template::instance()->render('view/apply_online.php');
            echo Template::instance()->render('view/include/footer.php');
        } else {

            echo Template::instance()->render('view/include/head.php');
            echo Template::instance()->render('view/include/top-nav.php');
            echo Template::instance()->render('view/apply_message.php');
            echo Template::instance()->render('view/include/footer.php');
        }
    }
    public function showApplicants()
    {
        $database = new Database();
        $applicants = $database->getAllApplicants();
        $applicantArr = array();

        foreach($applicants as $applicant) {
            $person = new Applicant($applicant['applied_id'], $applicant['first_name'],
                $applicant['last_name'], $applicant['email'],
                $applicant['birthdate']);

            array_push($applicantArr, $person);
        }

        $this->_f3->set('applicants', $applicantArr);

        echo Template::instance()->render('view/include/head.php');
        echo Template::instance()->render('view/include/top-nav.php');
        echo Template::instance()->render('view/applied.php');
        echo Template::instance()->render('view/include/footer.php');
    }

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
?>