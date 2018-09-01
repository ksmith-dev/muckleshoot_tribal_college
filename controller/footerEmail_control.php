<?php
/**
 * Created by PhpStorm.
 * User: staciemashnitskaya
 * Date: 4/23/17
 * Time: 11:19 PM
 */

class footerEmailControl
{
    private $_f3;
    private $_params;

    public function __construct($_f3, $_params)
    {
        $this->_f3 = $_f3;
        $this->_params = $_params;
    }
    /*
     * postFooterEmail
     * If invalid info is passed into the Footer Email and isn't caught be JS.
     * it will load a separate page. If the footer email info is valid it will send
     * an email to the designated email.
     */
    public function postFooterEmail()
    {
        $errors = footerEmailValidation();
        if(sizeof($errors) ==0) {
            /******************************************************************************
             * This is the email all questions submitted from the footer Q/A will be sent *
             ******************************************************************************/
            $emailToSendTo = "stacie_mash@outlook.com";
            footerEmails($emailToSendTo);
            echo Template::instance()->render('view/include/head.php');
            echo Template::instance()->render('view/include/top-nav.php');
            echo Template::instance()->render('view/contactus_thank_you.php');
            echo Template::instance()->render('view/include/footer.php');
        }  else {
            $this->_f3->set('errors', $errors);
            echo Template::instance()->render('view/include/head.php');
            echo Template::instance()->render('view/include/top-nav.php');
            echo Template::instance()->render('view/footerEmail.php');
            echo Template::instance()->render('view/include/footer.php');
        }
    }
    /*
     * viewFooterEmail
     * if invalid info is passed into the Footer Email and isn't caught be JS.
     * is will direct you to this page
     */
    public function viewFooterEmail()
    {

        echo Template::instance()->render('view/include/head.php');
        echo Template::instance()->render('view/include/top-nav.php');
        echo Template::instance()->render('view/footerEmail.php');
        echo Template::instance()->render('view/include/footer.php');
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
