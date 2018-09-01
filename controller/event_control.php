<?php
/**
 * Created by PhpStorm.
 * User: staciemashnitskaya
 * Date: 4/23/17
 * Time: 11:19 PM
 */

class eventsControl
{
    private $_f3;
    private $_params;

    /**
     * eventsControl constructor.
     * @param $_f3
     * @param $_params
     */
    public function __construct($_f3, $_params)
    {
        $this->_f3 = $_f3;
        $this->_params = $_params;
    }

    public function viewEventID()
    {
        /*
         * Adjust this number to change how many events to display on the
         * the envents pages' upcoming events section
        */
        $this->_f3->clear('eventById');
        $numberOfEvents = 100;
        $database = new Database();
        $id = $this->_params['id'];
        $events = $database->getFiniteAmountEvents($numberOfEvents);
        
        $eventSize = sizeof($events);
        $eventArray = array();
        $i = 1;

        foreach ($events as $event) {
            $currentEvent = new Events($event['EventID'], $event['EventName'], $event['Category'], $event['Description'], date_format(date_create($event['DateEnd']),"F j"),
                date_format(date_create($event['DateStart']),"F j") , $event['Times'], $event['Location'],$event['PhotoFilePath'] ,$event['priority'],$event['is_active']);
            $eventArray[$i] = $currentEvent;

            $i += 1;
        }

        $this->_f3->set('eventsByActive', $eventArray);
        $this->_f3->set('eventSize', $eventSize);

        $results = $database->getEventByID($id);

        $event = new Events($results['EventId'], $results['EventName'], $results['Category'],$results['Description'],
            date_format(date_create($results['DateEnd']),"F j"),
            date_format(date_create($results['DateStart']) ,"F j") , $results['Times'], $results['Location'], $results['PhotoFilePath'],$results['priority'],$results['is_active']);
        $this->_f3->set('eventById', $event);
        
        echo Template::instance()->render('view/include/head.php');
        echo Template::instance()->render('view/include/top-nav.php');
        echo Template::instance()->render('view/event-id.php');
        echo Template::instance()->render('view/include/footer.php');
    }

    public function viewEventHome()
    {
        $this->_f3->clear('eventById');
        $database = new Database();

        $events = $database->getAllCurrentEvents();

        $eventSize = sizeof($events);
        $eventArray = array();
        $i = 1;

        foreach ($events as $event) {
            $currentEvent = new Events($event['EventID'], $event['EventName'], $event['Category'], $event['Description'],date_format(date_create($event['DateEnd']),"F j"),
                date_format(date_create($event['DateStart']) ,"F j")  , $event['Times'], $event['Location'], $event['PhotoFilePath'],$event['priority'],$event['is_active']);
            $eventArray[$i] = $currentEvent;

            $i += 1;
        }

        if($eventSize > 0) {
            $event = $eventArray[1];
            $this->_f3->set('eventById', $event);
        }
        $this->_f3->set('eventsByActive', $eventArray);
        $this->_f3->set('eventSize', $eventSize);


        echo Template::instance()->render('view/include/head.php');
        echo Template::instance()->render('view/include/top-nav.php');
        echo Template::instance()->render('view/event-id.php');
        echo Template::instance()->render('view/include/footer.php');
    }

    
    public function viewAddEvents()
    {
        echo Template::instance()->render('view/include/head.php');
        echo Template::instance()->render('view/include/top-nav.php');
        echo Template::instance()->render('view/add-events.php');
        echo Template::instance()->render('view/include/footer.php');
    }
    
    public function addEvent()
    {
        $errors = validateEventAdd();

        if(!($errors === true)) {
            //var_dump($errors);
            $this->_f3->set('errors', $errors);
            echo Template::instance()->render('view/include/head.php');
            echo Template::instance()->render('view/include/top-nav.php');
            echo Template::instance()->render('view/add-events.php');
            echo Template::instance()->render('view/include/footer.php');
        } else {
            $this->_f3->reroute('/Admin');
        }
    }
    
    public function viewEditEvents()
    {
        $id = $this->_params['id'];
        $db = new Database();
        $event = $db->getEventByID($id);


         $currentEvent = new Events($event['EventID'], $event['EventName'], $event['Category'], $event['Description'], $event['DateEnd'],
         $event['DateStart'], $event['Times'], $event['Location'], $event['PhotoFilePath'],$event['priority'],$event['is_active']);

        $this->_f3->set('id', $id);
        $this->_f3->set('Event', $currentEvent);
            
        echo Template::instance()->render('view/include/head.php');
        echo Template::instance()->render('view/include/top-nav.php');
        echo Template::instance()->render('view/add-events.php');
        echo Template::instance()->render('view/include/footer.php');
    }
    
    public function editEvents()
    {
        $id = $this->_params['id'];

        $errors = validateEventUpdate($id);

        if(!($errors === true))
        {
            $id = $this->_params['id'];
            $db = new Database();
            $event = $db->getEventByID($id);


            $currentEvent = new Events($event['EventID'], $event['EventName'], $event['Category'], $event['Description'], $event['DateEnd'],
                $event['DateStart'], $event['Times'], $event['Location'], $event['PhotoFilePath'],$event['priority'],$event['is_active']);

            $this->_f3->set('Event', $currentEvent);
            $this->_f3->set('errors', $errors);
            echo Template::instance()->render('view/include/head.php');
            echo Template::instance()->render('view/include/top-nav.php');
            echo Template::instance()->render('view/add-events.php');
            echo Template::instance()->render('view/include/footer.php');
        } else {

            $this->_f3->reroute('/Admin');
        }
    }
    
    public function removeEvent()
    {
        $id = $this->_params['id'];
        $db = new Database();
        
        $db->deleteEvent($id);
        
        $this->_f3->reroute('/Login');
    }

    public function reactivateEvent()
    {
        $database = new Database();
        $id = $this->_params['id'];
        $database->reactivateEvent($id);
        $this->_f3->reroute('/Admin');
    }

    public function isLoggedIn()
    {
        $database = new Database();
        $loggedIn = $database->getAdminByUsername($_SESSION['user']);
        $admin = new Admin($loggedIn['adminId'], $loggedIn['username'], $loggedIn['adminLevel'], $loggedIn['active']);
        if(isset($_SESSION['user']) === true && $admin->getActive() == 1) {
            $adminLevels = array(Alerts, Events, Programs, Partners, FincancialAid, Staff, StudentWork, Users);
            $accessCount = 0;
            $pieces = explode(",", $admin->getAdminLevel());

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
