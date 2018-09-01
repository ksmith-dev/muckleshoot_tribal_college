<?php
/**
 *
 * @author Stacie Mashnitskaya
 * Date: 5/30/17
 * Time: 9:39 PM
 */

class resourceControl
{
    private $_f3;
    private $_params;

    /**
     * resourceControl constructor.
     * @param $_f3
     * @param $_params
     */
    public function __construct($_f3, $_params)
    {
        $this->_f3 = $_f3;
        $this->_params = $_params;
    }
    /*
     * viewAddResources
     * Renders the add resources page
     */
    public function viewAddResources()
    {
        echo Template::instance()->render('view/include/head.php');
        echo Template::instance()->render('view/include/top-nav.php');
        echo Template::instance()->render('view/edit-resources.php');
        echo Template::instance()->render('view/include/footer.php');
    }
    /*
     * viewEditResources
     * Loads a specific resource for editing and renders the edit resources page
     */
    public function viewEditResources()
    {
        $database = new Database();
        $id = $this->_params['id'];

        $resource = $database->getResourceById($id);

        $availableResource = new Resource($resource['ResourceID'], $resource['ResourceName'], $resource['Description']
            , $resource['ContactName'] , $resource['ContactEmail'] , $resource['ContactPhone'] ,
            $resource['Link'], $resource['active']);
        $this->_f3->set('Resource', $availableResource);

        echo Template::instance()->render('view/include/head.php');
        echo Template::instance()->render('view/include/top-nav.php');
        echo Template::instance()->render('view/edit-resources.php');
        echo Template::instance()->render('view/include/footer.php');
    }
    /*
     * postAddResource
     * Checks to see if the user data is valid if so it will add it to the DB
     * if the user data is invalid will reload the add user page.
     */
    public function postAddResource()
    {

        $errors = validateAddResources();

        if(!($errors === true)) {

            $this->_f3->set('errors', $errors);
            echo Template::instance()->render('view/include/head.php');
            echo Template::instance()->render('view/include/top-nav.php');
            echo Template::instance()->render('view/edit-resources.php');
            echo Template::instance()->render('view/include/footer.php');
        } else {
            $this->_f3->reroute('/Admin');
        }

    }
    /*
     * postEditResources
     * Checks to see if the user data is valid if so it will update the DB
     * if the user data is invalid will reload the edit user page.
     */
    public function postEditResources()
    {
        $id = $this->_params['id'];

        $errors = validateEditResource($id);

        if(!($errors === true)) {
            $database = new Database();

            $resource = $database->getResourceById($id);
            /*construct($resourceID = "0", $resourceName = "Resource", $description = "Info",
                $contactName ="",$contactEmail = "",$contactPhone = "",$link = "", $active = "1" )*/
            $availableResource = new Resource($resource['ResourceID'], $resource['ResourceName'], $resource['Description']
                , $resource['ContactName'] , $resource['ContactEmail'] , $resource['ContactPhone'] ,
                $resource['Link'], $resource['Active']);
            $this->_f3->set('Resource', $availableResource);
            $this->_f3->set('errors', $errors);
            echo Template::instance()->render('view/include/head.php');
            echo Template::instance()->render('view/include/top-nav.php');
            echo Template::instance()->render('view/edit-resources.php');
            echo Template::instance()->render('view/include/footer.php');
        } else {
            // fixme add routing
            $this->_f3->reroute('/Admin');
        }

    }
    /*
     * deleteResource
     * Does not delete resource rather deactivates the resources
     */
    public function deleteResource()
    {
        $database = new Database();
        $id = $this->_params['id'];
        $database->deleteResource($id);
        $this->_f3->reroute('/Admin');
    }
    /*
     * reactivateResource
     * reactivates resources
     */
    public function reactivateResource()
    {
        $database = new Database();
        $id = $this->_params['id'];
        $database->reactivateResource($id);
        $this->_f3->reroute('/Admin');
    }
    /*
     * viewResources
     * Loads from the db all active AND current events and renders the resources page
     */
    public function viewResources()
    {
        $database = new Database();

        $resources = $database->getAllActiveResourcesNoLimit();


        $resourceArray = array();
        $i = 1;

        foreach ($resources as $resource) {
            $availableResource = new Resource($resource['ResourceID'], $resource['ResourceName'], $resource['Description']
                , $resource['ContactName'] , $resource['ContactEmail'] , $resource['ContactPhone'] ,
                $resource['Link'], $resource['active']);
            array_push($resourceArray, $availableResource);
            $i += 1;
        }
        $resourceSize = sizeof($resourceArray);
        $this->_f3->set('resourcesByActive', $resourceArray);
        $this->_f3->set('resourcesSize', $resourceSize);
        echo Template::instance()->render('view/include/head.php');
        echo Template::instance()->render('view/include/top-nav.php');
        echo Template::instance()->render('view/resources.php');
        echo Template::instance()->render('view/include/footer.php');
    }
    /*
     * WAS WRITTEN BY A TEAMMATE
     * isLoggedIn
     * Checks to see if a "user" is logged in and has access to resource loading edit/add resources page
     */
    public function isLoggedIn()
    {
        $database = new Database();
        $loggedIn = $database->getAdminByUsername($_SESSION['user']);
        $admin = new Admin($loggedIn['adminId'], $loggedIn['username'], $loggedIn['adminLevel'], $loggedIn['active']);
        if(isset($_SESSION['user']) === true && strpos($admin->getAdminLevel(), Resources) !== false && $admin->getActive() == 1) {
            $testLogin = true;
        } else {
            $this->_f3->reroute('/Login');
        }
        $this->_f3->set('login', $testLogin);
        $this->_f3->set('admin', $admin);
    }
    /*
     * WAS WRITTEN BY A TEAMMATE
     * getAdmin
     * Verifies that someone trying to access the admin page has logged in. If that someone
     * is not login it will route them to the login page
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
