<?php

/**
 * User: Lucas Harlor
 * Date: 4/21/17
 */
class FinancialAidControl
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
    
    public function viewAddFinancialAid()
    {
        echo Template::instance()->render('view/include/head.php');
        echo Template::instance()->render('view/include/top-nav.php');
        echo Template::instance()->render('view/add-financial-aid.php');
        echo Template::instance()->render('view/include/footer.php');
    }
    
    public function addFinancialAid()
    {
        $errors = validateAddFinancialAid();
        
        if(!($errors === true)) {

            $this->_f3->set('errors', $errors);
            echo Template::instance()->render('view/include/head.php');
            echo Template::instance()->render('view/include/top-nav.php');
            echo Template::instance()->render('view/add-financial-aid.php');
            echo Template::instance()->render('view/include/footer.php');
        } else {
            $this->_f3->reroute('/Admin');
        }
    }

    public function viewFinancialAid()
    {
        $db = new Database();
        $financialAid = $db->getAllFinancialAid();
        $financialAidSize = sizeof($financialAid);
        $financialAidArr = array();
        $i = 1;
        
        foreach($financialAid as $resource) {
            $currentResource = new FinancialAid($resource['resource_id'],
                                                $resource['resource_name'],
                                                $resource['resource_info'],
                                                $resource['resource_link'],
                                                $resource['is_active']);
            
            $financialAidArr[$i] = $currentResource;
            
            $i+=1;
        }
        
        //var_dump($financialAidArr);
        
        $this->_f3->set('resources', $financialAidArr);
        $this->_f3->set('numOfResources', $financialAidSize);
        
        echo Template::instance()->render('view/include/head.php');
        echo Template::instance()->render('view/include/top-nav.php');
        echo Template::instance()->render('view/financial_aid.php');
        echo Template::instance()->render('view/include/footer.php');
    }
    
    public function viewEditFinancialAid()
    {
        $id = $this->_params['id'];
        $db = new Database();
        $result = $db->getFinancialAidByID($id);

        $currentResource = new FinancialAid($result['resource_id'],
            $result['resource_name'],
            $result['resource_info'],
            $result['resource_link'],
            $result['is_active']);
        
        //var_dump($resource);

        $this->_f3->set('resource', $currentResource);
        
        echo Template::instance()->render('view/include/head.php');
        echo Template::instance()->render('view/include/top-nav.php');
        echo Template::instance()->render('view/add-financial-aid.php');
        echo Template::instance()->render('view/include/footer.php');
    }
    
    public function editFinancialAid()
    {
        $id = $this->_params['id'];

        $errors = validateUpdateFinancialAid($id);

        if(!($errors === true)) {
            $id = $this->_params['id'];
            $db = new Database();
            $result = $db->getFinancialAidByID($id);

            $currentResource = new FinancialAid($result['resource_id'],
                $result['resource_name'],
                $result['resource_info'],
                $result['resource_link'],
                $result['is_active']);

            $this->_f3->set('resource', $currentResource);
            $this->_f3->set('errors', $errors);
            echo Template::instance()->render('view/include/head.php');
            echo Template::instance()->render('view/include/top-nav.php');
            echo Template::instance()->render('view/add-financial-aid.php');
            echo Template::instance()->render('view/include/footer.php');
        } else {
            $this->_f3->reroute('/Admin');
        }
    }
    
    public function removeFinancialAid()
    {
        $id = $this->_params['id'];
        $db = new Database();
        
        $db->deleteFinancialAid($id);

        $this->_f3->reroute('/Admin');
    }

    public function reactivateFinancialAid()
    {
        $database = new Database();
        $id = $this->_params['id'];
        $database->reactivateFinancialAid($id);
        $this->_f3->reroute('/Admin');
    }
    
    public function isLoggedIn()
    {
        $database = new Database();
        $loggedIn = $database->getAdminByUsername($_SESSION['user']);
        $admin = new Admin($loggedIn['adminId'], $loggedIn['username'], $loggedIn['adminLevel'], $loggedIn['active']);
        if(isset($_SESSION['user']) === true && strpos($admin->getAdminLevel(), FinancialAid) !== false && $admin->getActive() == 1) {
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