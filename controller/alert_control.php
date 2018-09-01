<?php

/**
 * Created by PhpStorm.
 * User: Lucas Harlor
 * Date: 5/11/17
 * Time: 11:34 AM
 */
class AlertControl
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

    public function viewEditAlert()
    {
        $database = new Database();
        $id = $this->_params['id'];

        $results = $database->getAlertById($id);

        $alert = new Alert($results['alertId'], $results['alertName'], $results['alertMessage'],
            $results['active']);

        $this->_f3->set('alert', $alert);

        echo Template::instance()->render('view/include/head.php');
        echo Template::instance()->render('view/include/top-nav.php');
        echo Template::instance()->render('view/edit-alert.php');
        echo Template::instance()->render('view/include/footer.php');
    }

    public function viewAddAlert()
    {
        echo Template::instance()->render('view/include/head.php');
        echo Template::instance()->render('view/include/top-nav.php');
        echo Template::instance()->render('view/edit-alert.php');
        echo Template::instance()->render('view/include/footer.php');
    }

    public function postEditAlert()
    {
        $id = $this->_params['id'];
        $errors = validateAlertEdit($id);

        if(!($errors === true))
        {

            $database = new Database();
            $id = $this->_params['id'];

            $results = $database->getAlertById($id);

            $alert = new Alert($results['alertId'], $results['alertName'], $results['alertMessage'],
                $results['active']);

            $this->_f3->set('alert', $alert);
            $this->_f3->set('errors', $errors);
            echo Template::instance()->render('view/include/head.php');
            echo Template::instance()->render('view/include/top-nav.php');
            echo Template::instance()->render('view/edit-alert.php');
            echo Template::instance()->render('view/include/footer.php');
        } else {

            $this->_f3->reroute('/Admin');
        }
    }

    public function postAddAlert()
    {
        $database = new Database();
        $database->disableActiveAlerts();
        $errors = validateAlertAdd();

        if(!($errors === true))
        {
            $this->_f3->set('errors', $errors);
            echo Template::instance()->render('view/include/head.php');
            echo Template::instance()->render('view/include/top-nav.php');
            echo Template::instance()->render('view/edit-alert.php');
            echo Template::instance()->render('view/include/footer.php');
        } else {
            $this->_f3->reroute('/Admin');
        }
    }

    public function deleteAlert()
    {
        $database = new Database();
        $id = $this->_params['id'];
        $database->deleteAlert($id);
        $this->_f3->reroute('/Admin');
    }

    public function reactivateAlert()
    {
        $database = new Database();
        $id = $this->_params['id'];

        if(sizeof($database->getAllActiveAlerts()) > 0)
        {
            $database->disableActiveAlerts();
            $database->reactivateAlert($id);
            $this->_f3->reroute('/Admin');
        } else {
            $database->reactivateAlert($id);
            $this->_f3->reroute('/Admin');
        }
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
        if(isset($_SESSION['user']) === true && strpos($admin->getAdminLevel(), Alert) !== false && $admin->getActive() == 1) {
                $testLogin = true;
        } else {
            $this->_f3->reroute('/Login');
        }
        $this->_f3->set('login', $testLogin);
        $this->_f3->set('admin', $admin);
    }
}