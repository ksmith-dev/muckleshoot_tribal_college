<?php
/**
 * Created by PhpStorm.
 * User: staciemashnitskaya
 * Date: 4/23/17
 * Time: 11:19 PM
 */

class ContactusControl
{
    private $_f3;
    private $_params;

    /**
     * Contact us Control constructor.
     * @param $_f3
     * @param $_params
     */
    public function __construct($_f3, $_params)
    {
        $this->_f3 = $_f3;
        $this->_params = $_params;
    }
    /*
     * Renders the contact us page
     */
    public function viewContactus()
    {
        echo Template::instance()->render('view/include/head.php');
        echo Template::instance()->render('view/include/top-nav.php');

        echo Template::instance()->render('view/contactus.php');
        echo Template::instance()->render('view/include/footer.php');
    }
    /*
     * Post, Validation, and send emails
     */
    public function postContactus()
    {
        
        $errors = contactValidation();

        if(sizeOf($errors) >= 1) {
            //is any errors in the form the email will not be sent and render the errors to the web page
            $this->_f3->set('errors', $errors);
            echo Template::instance()->render('view/include/head.php');
            echo Template::instance()->render('view/include/top-nav.php');
            echo Template::instance()->render('view/contactus.php');
            echo Template::instance()->render('view/include/footer.php');
        } else {
            /***********************************************************************************
             * This is the email all questions submitted from the Contact Us will be sent *
             ***********************************************************************************/
            $emailToSendTo = "stacie_mash@outlook.com";
            //sends the email and web page displays a thank you 
           contactusEmails($emailToSendTo );
            echo Template::instance()->render('view/include/head.php');
            echo Template::instance()->render('view/include/top-nav.php');
            echo Template::instance()->render('view/contactus_thank_you.php');
            echo Template::instance()->render('view/include/footer.php');
        }


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
