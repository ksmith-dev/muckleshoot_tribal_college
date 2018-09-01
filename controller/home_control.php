<?php

/**
 * Created by PhpStorm.
 * User: kevinsmith
 * Date: 4/21/17
 * Time: 11:18 AM
 */
class HomeControl
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

    public function viewHome()
    {
        $database = new Database();
        $events = $database->getAllCurrentEvents();
        $alerts = $database->getAllActiveAlerts();
        $resources = $database->getAllActiveResources();
        $eventSize = sizeof($events);
        $eventArray = array();
        $resourceArray = array();
        $activeAlert = array();
        $i = 1;

        foreach ($events as $event) {
            if(strlen($event['Description']) > 249)
            {
                $first250 = substr($event['Description'], 0, 250);
                $description = $first250."...";
                $currentEvent = new Events($event['EventID'], $event['EventName'], $event['Category'], $description, $event['DateEnd'],
                    $event['DateStart'], $event['Times'], $event['Location'], $event['PhotoFilePath'], $event['priority'], $event['is_active']);
                $eventArray[$i] = $currentEvent;

                $i += 1;
            } else {
                $currentEvent = new Events($event['EventID'], $event['EventName'], $event['Category'], $event['Description'], $event['DateEnd'],
                    $event['DateStart'], $event['Times'], $event['Location'], $event['PhotoFilePath'], $event['priority'], $event['is_active']);
                $eventArray[$i] = $currentEvent;

                $i += 1;
            }
        }

        /*
         * If there are no events the carousel will collapse. To insure this never happens, this event will be created
           You can modify this if you wish but be careful not to leave any blanks empty.
         * If no text is required just put "" in that field.
         *  Also this "event" when clicked will route the user to the history page of the college
            To change this go to the home.php file
        */
        if(sizeof($events) == 0)
        {
            //var_dump($events);
            $eventSize =1;
            $eventArray[1] = new Events("","Welcome to Muckleshoot Tribal College", "","Click here to learn more about Muckleshoot Tribal College", "",
                "", "", "", "asset/img/carousel_3.jpg",1, 1);
        }

        if($alerts != null)
        {
            $activeAlert = new Alert($alerts['alertId'], $alerts['alertName'], $alerts['alertMessage'], $alerts['active']);
        }
        foreach ($resources as $resource) {
            if(strlen($resource['Description']) > 249)
            {
                $first250 = substr($resource['Description'], 0, 250);
                $description = $first250."...";
                $availableResource = new Resource($resource['ResourceID'], $resource['ResourceName'], $description, $resource['ContactName'], $resource['ContactEmail'],
                $resource['ContactPhone'], $resource['Link'], $resource['Active']);
                array_push($resourceArray, $availableResource);
            } else {
                $availableResource = new Resource($resource['ResourceID'], $resource['ResourceName'], $resource['Description'], $resource['ContactName'], $resource['ContactEmail'],
                    $resource['ContactPhone'], $resource['Link'], $resource['Active']);
                array_push($resourceArray, $availableResource);
            }
        }

        $this->_f3->set('resources', $resourceArray);
        $this->_f3->set('alert', $activeAlert);
        $this->_f3->set('alertSize', sizeof($activeAlert));
        $this->_f3->set('events', $eventArray);
        $this->_f3->set('eventSize', $eventSize);
        
        echo Template::instance()->render('view/include/head.php');
        echo Template::instance()->render('view/include/top-nav.php');
        if (true) {
            echo Template::instance()->render('view/include/alert.php');
        }
        echo Template::instance()->render('view/home.php');
        echo Template::instance()->render('view/include/footer.php');
    }

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