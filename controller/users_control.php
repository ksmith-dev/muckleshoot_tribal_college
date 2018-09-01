<?php
/**
 * Created by PhpStorm.
 * User: staciemashnitskaya
 * Date: 4/23/17
 * Time: 11:19 PM
 */
include "model/password.php";
class userControl
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
    /*
     * viewAddUsers
     * renders the form to add new users
     */
    public function viewAddUsers()
    {
        echo Template::instance()->render('view/include/head.php');
        echo Template::instance()->render('view/include/top-nav.php');
        echo Template::instance()->render('view/edit-users.php');
        echo Template::instance()->render('view/include/footer.php');
    }
    /*
     * viewEditUsers
     * Loads a specific user into a form and renders the form
     */
    public function viewEditUsers()
    {
        $database = new Database();
        $id = $this->_params['id'];

        $results = $database->getAdminForEdit($id);

        $admin = new Admin($results['adminId'], $results['username'], $results['adminLevel'], $results['active']);
        $this->_f3->set('Admin', $admin);


        echo Template::instance()->render('view/include/head.php');
        echo Template::instance()->render('view/include/top-nav.php');
        echo Template::instance()->render('view/edit-users.php');
        echo Template::instance()->render('view/include/footer.php');
    }
    /*
     * postAddUsers
     * If the user's form passes the validation, the user will be added to the DB.
     * If the user's form does not pass the validation, it reloads the form page with error messages
     */
    public function postAddUsers()
    {

        $errors = usersValidation();

        if(sizeOf($errors) >= 1) {

            $this->_f3->set('errors', $errors);
            echo Template::instance()->render('view/include/head.php');
            echo Template::instance()->render('view/include/top-nav.php');
            echo Template::instance()->render('view/edit-users.php');
            echo Template::instance()->render('view/include/footer.php');
        } else {

            $this->_f3->reroute('/Admin');
        }

    }

    /*
     * postEditUsers
     * If the user's form passes the validation, the users info will be updated in the DB.
     * If the user's form does not pass the validation, it reloads the form page with error messages
     */
    public function postEditUsers()
    {


        $database = new Database();
        $id = $this->_params['id'];

        $results = $database->getAdminForEdit($id);

        $admin = new Admin($results['adminId'], $results['username'], $results['adminLevel'], $results['active']);
        $this->_f3->set('Admin', $admin);


        $errors = usersEditValidation($id);

        if(sizeOf($errors) >= 1) {

            $this->_f3->set('errors', $errors);
            echo Template::instance()->render('view/include/head.php');
            echo Template::instance()->render('view/include/top-nav.php');
            echo Template::instance()->render('view/edit-users.php');
            echo Template::instance()->render('view/include/footer.php');
        } else {
            $loggedIn = $database->getAdminByUsername($_SESSION['user']);
            if($loggedIn['adminId'] == $id) {
                $this->_f3->reroute('/Logout');
            } else {
                $this->_f3->reroute('/Admin');
            }


        }

    }
    /*
     * deleteUser
     * Deactivates a user. Does not delete user from the DB
     */
    public function deleteUser()
    {
        $database = new Database();
        $id = $this->_params['id'];
        $database->deleteUser($id);
        $loggedIn = $database->getAdminById($_SESSION['id']);
        


        if($loggedIn['adminId'] == $id) {
            $this->_f3->reroute('/Logout');
        } else {
            if( $_SESSION['id'] == $loggedIn['adminId']) {
                unset($_SESSION['adminId']);
            }
            $this->_f3->reroute('/Admin');
        }
        
    }
    /*
     * reactivateUser
     * Reactivates user
     */
    public function reactivateUser()
    {
        $database = new Database();
        $id = $this->_params['id'];
        $database->reactivateUser($id);
        $this->_f3->reroute('/Admin');
    }
    /*
     * isLoggedIn
     * Checks to see if a "user" is logged in and has access to resource loading edit/add resources page
     */
    public function isLoggedIn()
    {
        $database = new Database();
        $loggedIn = $database->getAdminByUsername($_SESSION['user']);
        $admin = new Admin($loggedIn['adminId'], $loggedIn['username'], $loggedIn['adminLevel'], $loggedIn['active']);
        if(isset($_SESSION['user']) === true && strpos($admin->getAdminLevel(), Users) !== false && $admin->getActive() == 1) {
            $testLogin = true;
        } else {
            $this->_f3->reroute('/Login');
        }
        $this->_f3->set('login', $testLogin);
        $this->_f3->set('admin', $admin);
    }
}
