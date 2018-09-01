<?php

/**
 * Created by PhpStorm.
 * User: staciemashnitskaya
 * Date: 4/21/17
 * Time: 1:17 PM
 */
class HistoryControl
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
     * viewHistory
     * renders the history page
     */
    public function viewHistory()
    {
        echo Template::instance()->render('view/include/head.php');
        echo Template::instance()->render('view/include/top-nav.php');
        echo Template::instance()->render('view/history.php');
        echo Template::instance()->render('view/include/footer.php');
    }

    /*
     * Verifies that someone trying to access the admin page has logged in. If that someone
     * is not login it  will route them to the login page
     *
     */
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