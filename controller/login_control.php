<?php
session_start();
/**
 * User: Lucas
 * Date: 4/26/17
 */
class LoginControl
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

    public function viewLogin()
    {
        if($_SESSION['login'] === true)
        {
            $this->_f3->reroute('/Admin');
        } else {
            echo Template::instance()->render('view/include/head.php');
            echo Template::instance()->render('view/include/top-nav.php');
            echo Template::instance()->render('view/login.php');
            echo Template::instance()->render('view/include/footer.php');
        }
    }
    
    public function validateLogin()
    {
        $errors = loginValidation();
        
        if(!($errors === true))
        {
            $this->_f3->set('errors', $errors);
            echo Template::instance()->render('view/include/head.php');
            echo Template::instance()->render('view/include/top-nav.php');
            echo Template::instance()->render('view/login.php');
            echo Template::instance()->render('view/include/footer.php');
        } else {
            $_SESSION['login'] = true;
            $this->_f3->reroute('/Admin ');
        }
    }
    
    /**
    *Unsets a current session and destroys it. f3 login is also set to false so the correct sidebar is shown
    *
    *@access public
    */
   public function logout()
   {
       $_SESSION['login'] = false;
       session_unset();
       session_destroy();
   }
}