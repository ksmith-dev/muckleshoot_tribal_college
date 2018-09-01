<?php
session_start();
/**
 * User: Lucas
 * Date: 4/26/17
 */
class AdminControl
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

    public function viewAdmin()
    {
        $database = new Database();

        $activeStaff = $database->getAllActiveStaff();
        $activeAdmins = $database->getAllActiveAdmins();
        $activeEvents = $database->getAllActiveEvents();
        $activeFinancials = $database->getAllActiveFinancialAid();
        $activePrograms = $database->getAllActivePrograms();
        $activePartners = $database->getAllActivePartners();
        $activeAlerts = $database->getAllActiveAlerts();
        $activeStudentWork = $database->GetAllActiveStudentWork();
        $activeResources = $database->getAllActiveResourcesNoLimit();

        $inactiveStaff = $database->getAllInactiveStaff();
        $inactiveAdmins = $database->getAllInactiveAdmins();
        $inactiveEvents = $database->getAllInactiveEvents();
        $inactiveFinancials = $database->getAllInactiveFinancialAid();
        $inactivePrograms = $database->getAllInactivePrograms();
        $inactivePartners = $database->getAllInactivePartners();
        $inactiveAlerts = $database->getAllInactiveAlerts();
        $inactiveStudentWork = $database->GetAllInactiveStudentWork();
        $inactiveResources = $database->getAllInactiveResources();

        $activeStaffArray = array();
        $activeAdminArray = array();
        $activeEventArray = array();
        $activeFinancialArray = array();
        $activePartnersArray = array();
        $activeProgramsArray = array();
        $activeAlertArray = array();
        $activeStudentWorkArray = array();
        $activeResourceArray = array();

        $inactiveStaffArray = array();
        $inactiveAdminArray = array();
        $inactiveEventArray = array();
        $inactiveFinancialArray = array();
        $inactivePartnersArray = array();
        $inactiveProgramsArray = array();
        $inactiveAlertArray = array();
        $inactiveStudentWorkArray = array();
        $inactiveResourceArray = array();

        $char_remove = array('(', ')', ' ', '-');


        if($activeAlerts != null)
        {
            $message = new Alert($activeAlerts['alertId'], $activeAlerts['alertName'], $activeAlerts['alertMessage'],
                $activeAlerts['active']);

            array_push($activeAlertArray, $message);
        }

        if($inactiveAlerts != null)
        {
            foreach ($inactiveAlerts as $alert)
            {
                $message = new Alert($alert['alertId'], $alert['alertName'], $alert['alertMessage'],
                    $alert['active']);

                array_push($inactiveAlertArray, $message);
            }
        }

        if($activeResources != null)
        {
            foreach ($activeResources as $resource)
            {
                $availableResource = new Resource($resource['ResourceID'], $resource['ResourceName'], $resource['Description'], $resource['ContactName'], $resource['ContactEmail'],
                    $resource['ContactPhone'], $resource['Link'], $resource['Active']);
                array_push($activeResourceArray, $availableResource);
            }
        }


        if($inactiveResources != null)
        {
            foreach ($inactiveResources as $resource)
            {
                $availableResource = new Resource($resource['ResourceID'], $resource['ResourceName'], $resource['Description'], $resource['ContactName'], $resource['ContactEmail'],
                    $resource['ContactPhone'], $resource['Link'], $resource['Active']);
                array_push($inactiveResourceArray, $availableResource);
            }
        }


        if($activeStaff != null)
        {
            foreach ($activeStaff as $member)
            {
                $person = new Staff($member['BioID'], $member['Title'], $member['LastName'], $member['FirstName'], $member['JobTitle'], $member['Organization'],
                    $member['Credential'], $member['Department'], $member['Description'], $member['DateHired'], $member['Location'],
                    $member['Email'], $member['PhoneNumber'], $member['PhotoFilePath']);

                array_push($activeStaffArray, $person);
            }
        }


        if($inactiveStaff != null)
        {
            foreach ($inactiveStaff as $member)
            {
                $person = new Staff($member['BioID'], $member['Title'], $member['LastName'], $member['FirstName'], $member['JobTitle'], $member['Organization'],
                    $member['Credential'], $member['Department'], $member['Description'], $member['DateHired'], $member['Location'],
                    $member['Email'], $member['PhoneNumber'], $member['PhotoFilePath']);

                array_push($inactiveStaffArray, $person);
            }
        }

        if($activeAdmins != null)
        {
            foreach ($activeAdmins as $admin)
            {
                $user = new Admin($admin['adminId'], $admin['username'], $admin['adminLevel'], $admin['active']);

                array_push($activeAdminArray, $user);
            }
        }


        if($inactiveAdmins != null)
        {
            foreach ($inactiveAdmins as $admin)
            {
                $user = new Admin($admin['adminId'], $admin['username'], $admin['adminLevel'], $admin['active']);

                array_push($inactiveAdminArray, $user);
            }
        }

        if($activeEvents != null)
        {
            foreach ($activeEvents as $event)
            {
                $currentEvent = new Events($event['EventID'], $event['EventName'], $event['Category'], $event['Description'], $event['DateEnd'],
                    $event['DateStart'], $event['Times'], $event['Location'], $event['PhotoFilePath'], $event['priority'], $event['is_active']);
                array_push($activeEventArray, $currentEvent);
            }
        }


        if($inactiveEvents != null)
        {
            foreach ($inactiveEvents as $event)
            {
                $currentEvent = new Events($event['EventID'], $event['EventName'], $event['Category'], $event['Description'], $event['DateEnd'],
                    $event['DateStart'], $event['Times'], $event['Location'], $event['PhotoFilePath'], $event['priority'], $event['is_active']);
                array_push($inactiveEventArray, $currentEvent);
            }
        }


        if($activeStudentWork != null)
        {
            foreach ($activeStudentWork as $projects)
            {
                $project = new StudentWork($projects['projectId'], $projects['studentName'], $projects['projectName'],
                    $projects['projectDescription'], $projects['projectFilePath']);

                array_push($activeStudentWorkArray, $project);
            }
        }


        if($inactiveStudentWork != null)
        {
            foreach ($inactiveStudentWork as $projects)
            {
                $project = new StudentWork($projects['projectId'], $projects['studentName'], $projects['projectName'],
                    $projects['projectDescription'], $projects['projectFilePath']);

                array_push($inactiveStudentWorkArray, $project);
            }
        }

        if($activePrograms != null)
        {
            foreach($activePrograms as $result)
            {
                $program = new Program();

                $program->setId($result['id']);
                $program->setTitle($result['title']);
                $program->setSubTitle($result['sub_title']);
                $program->setDescHead($result['desc_head']);
                $program->setDescBody($result['desc_body']);
                $program->setDescListHead($result['desc_list_head']);
                $program->setDescListData($result['desc_list_data']);
                $program->setDescFooterHead($result['desc_footer_head']);
                $program->setDescFooterBody($result['desc_footer_body']);
                $program->setInfoHead($result['info_head']);
                $program->setInfoBody($result['info_body']);
                $program->setInfoListHead($result['info_list_head']);
                $program->setInfoListData($result['info_list_data']);
                $program->setInfoFooterHead($result['info_footer_head']);
                $program->setInfoFooterBody($result['info_footer_body']);
                $program->setFooterHead($result['footer_head']);
                $program->setFooterBody($result['footer_body']);
                $program->setFooterListHead($result['footer_list_head']);
                $program->setFooterListData($result['footer_list_data']);
                if(strpos($result['contact_name'], '+'))
                {
                    $name_array = explode('+', $result['contact_name']);
                    $title_array = explode('+', $result['contact_title']);
                    $desc_array = explode('+', $result['contact_desc']);
                    $phone_array = explode('+', $result['contact_phone']);
                    $email_array = explode('+', $result['contact_email']);

                    for($i=0;$i<sizeof($name_array);$i++)
                    {
                        $program->addContact($name_array[$i], $title_array[$i], $desc_array[$i], $phone_array[$i], $email_array[$i]);
                    }
                }
                else
                {
                    $program->addContact($result['contact_name'], $result['contact_title'],$result['contact_desc'], $result['contact_phone'], $result['contact_email']);
                }

                $program->setImgPath($result['img_path']);
                $program->setLink($result['link']);

                array_push($activeProgramsArray, $program);
            }
        }

        if($inactivePrograms != null)
        {
            foreach($inactivePrograms as $result)
            {
                $program = new Program();

                $program->setId($result['id']);
                $program->setTitle($result['title']);
                $program->setSubTitle($result['sub_title']);
                $program->setDescHead($result['desc_head']);
                $program->setDescBody($result['desc_body']);
                $program->setDescListHead($result['desc_list_head']);
                $program->setDescListData($result['desc_list_data']);
                $program->setDescFooterHead($result['desc_footer_head']);
                $program->setDescFooterBody($result['desc_footer_body']);
                $program->setInfoHead($result['info_head']);
                $program->setInfoBody($result['info_body']);
                $program->setInfoListHead($result['info_list_head']);
                $program->setInfoListData($result['info_list_data']);
                $program->setInfoFooterHead($result['info_footer_head']);
                $program->setInfoFooterBody($result['info_footer_body']);
                $program->setFooterHead($result['footer_head']);
                $program->setFooterBody($result['footer_body']);
                $program->setFooterListHead($result['footer_list_head']);
                $program->setFooterListData($result['footer_list_data']);
                if(strpos($result['contact_name'], '+'))
                {
                    $name_array = explode('+', $result['contact_name']);
                    $title_array = explode('+', $result['contact_title']);
                    $desc_array = explode('+', $result['contact_desc']);
                    $phone_array = explode('+', $result['contact_phone']);
                    $email_array = explode('+', $result['contact_email']);

                    for($i=0;$i<sizeof($name_array);$i++)
                    {
                        $program->addContact($name_array[$i], $title_array[$i], $desc_array[$i], $phone_array[$i], $email_array[$i]);
                    }
                }
                else
                {
                    $program->addContact($result['contact_name'], $result['contact_title'],$result['contact_desc'], $result['contact_phone'], $result['contact_email']);
                }

                $program->setImgPath($result['img_path']);
                $program->setLink($result['link']);

                array_push($inactiveProgramsArray, $program);
            }
        }



        if($activePartners != null)
        {
            foreach($activePartners as $result)
            {
                $partner = new Partner();

                $partner->setId($result['id']);
                $partner->setTitle($result['title']);
                $partner->setSubTitle($result['sub_title']);
                $partner->setDescHead($result['desc_head']);
                $partner->setDescBody($result['desc_body']);
                $partner->setDescListHead($result['desc_list_head']);
                $partner->setDescListData($result['desc_list_data']);
                $partner->setDescFooterHead($result['desc_footer_head']);
                $partner->setDescFooterBody($result['desc_footer_body']);
                $partner->setInfoHead($result['info_head']);
                $partner->setInfoBody($result['info_body']);
                $partner->setInfoListHead($result['info_list_head']);
                $partner->setInfoListData($result['info_list_data']);
                $partner->setInfoFooterHead($result['info_footer_head']);
                $partner->setInfoFooterBody($result['info_footer_body']);
                $partner->setFooterHead($result['footer_head']);
                $partner->setFooterBody($result['footer_body']);
                $partner->setFooterListHead($result['footer_list_head']);
                $partner->setFooterListData($result['footer_list_data']);
                if(strpos($result['contact_name'], '+'))
                {
                    $name_array = explode('+', $result['contact_name']);
                    $title_array = explode('+', $result['contact_title']);
                    $desc_array = explode('+', $result['contact_desc']);
                    $phone_array = explode('+', $result['contact_phone']);
                    $email_array = explode('+', $result['contact_email']);
                    for($i=0;$i<sizeof($name_array);$i++)
                    {
                        $partner->addContact($name_array[$i], $title_array[$i], $desc_array[$i], $phone_array[$i], $email_array[$i]);
                    }
                }
                else
                {
                    $partner->addContact($result['contact_name'], $result['contact_title'],$result['contact_desc'], $result['contact_phone'], $result['contact_email']);
                }
                $partner->setImgPath($result['img_path']);
                $partner->setLink($result['link']);
                array_push($activePartnersArray, $partner);
            }
        }


        if($inactivePartners != null) {
            foreach($inactivePartners as $result)
            {
                $partner = new Partner();

                $partner->setId($result['id']);
                $partner->setTitle($result['title']);
                $partner->setSubTitle($result['sub_title']);
                $partner->setDescHead($result['desc_head']);
                $partner->setDescBody($result['desc_body']);
                $partner->setDescListHead($result['desc_list_head']);
                $partner->setDescListData($result['desc_list_data']);
                $partner->setDescFooterHead($result['desc_footer_head']);
                $partner->setDescFooterBody($result['desc_footer_body']);
                $partner->setInfoHead($result['info_head']);
                $partner->setInfoBody($result['info_body']);
                $partner->setInfoListHead($result['info_list_head']);
                $partner->setInfoListData($result['info_list_data']);
                $partner->setInfoFooterHead($result['info_footer_head']);
                $partner->setInfoFooterBody($result['info_footer_body']);
                $partner->setFooterHead($result['footer_head']);
                $partner->setFooterBody($result['footer_body']);
                $partner->setFooterListHead($result['footer_list_head']);
                $partner->setFooterListData($result['footer_list_data']);
                if(strpos($result['contact_name'], '+'))
                {
                    $name_array = explode('+', $result['contact_name']);
                    $title_array = explode('+', $result['contact_title']);
                    $desc_array = explode('+', $result['contact_desc']);
                    $phone_array = explode('+', $result['contact_phone']);
                    $email_array = explode('+', $result['contact_email']);
                    for($i=0;$i<sizeof($name_array);$i++)
                    {
                        $partner->addContact($name_array[$i], $title_array[$i], $desc_array[$i], $phone_array[$i], $email_array[$i]);
                    }
                }
                else
                {
                    $partner->addContact($result['contact_name'], $result['contact_title'],$result['contact_desc'], $result['contact_phone'], $result['contact_email']);
                }
                $partner->setImgPath($result['img_path']);
                $partner->setLink($result['link']);
                array_push($inactivePartnersArray, $partner);
            }
        }


        if($activeFinancials != null)
        {
            foreach($activeFinancials as $resource) {
                $currentResource = new FinancialAid($resource['resource_id'],
                    $resource['resource_name'],
                    $resource['resource_info'],
                    $resource['resource_link'],
                    $resource['is_active']);

                array_push($activeFinancialArray, $currentResource);
            }
        }


        if($inactiveFinancials != null) {
            foreach($inactiveFinancials as $resource) {
                $currentResource = new FinancialAid($resource['resource_id'],
                    $resource['resource_name'],
                    $resource['resource_info'],
                    $resource['resource_link'],
                    $resource['is_active']);

                array_push($inactiveFinancialArray, $currentResource);
            }
        }


        if($database->getErrors())
        {
            foreach ($database->getErrors() as $error)
            {
                echo $error;
            }
        }

        $this->_f3->set('activeResources', $activeResourceArray);
        $this->_f3->set('activeAlerts', $activeAlertArray);
        $this->_f3->set('activePartners', $activePartnersArray);
        $this->_f3->set('activePrograms', $activeProgramsArray);
        $this->_f3->set('activeStaff', $activeStaffArray);
        $this->_f3->set('activeAdmins', $activeAdminArray);
        $this->_f3->set('activeEvents', $activeEventArray);
        $this->_f3->set('activeAid', $activeFinancialArray);
        $this->_f3->set('activeProjects', $activeStudentWorkArray);

        $this->_f3->set('inactiveResources', $inactiveResourceArray);
        $this->_f3->set('inactiveAlerts', $inactiveAlertArray);
        $this->_f3->set('inactivePartners', $inactivePartnersArray);
        $this->_f3->set('inactivePrograms', $inactiveProgramsArray);
        $this->_f3->set('inactiveStaff', $inactiveStaffArray);
        $this->_f3->set('inactiveAdmins', $inactiveAdminArray);
        $this->_f3->set('inactiveEvents', $inactiveEventArray);
        $this->_f3->set('inactiveAid', $inactiveFinancialArray);
        $this->_f3->set('inactiveProjects', $inactiveStudentWorkArray);

        echo Template::instance()->render('view/include/head.php');
        echo Template::instance()->render('view/include/top-nav.php');
        echo Template::instance()->render('view/admin.php');
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
        if(isset($_SESSION['user']) === true && $admin->getActive() == 1) {
            $adminLevels = array(Alerts, Events, Programs, Partners, FincancialAid, Staff, StudentWork, Users);
            $accessCount = 0;
            $pieces = explode(",", $admin->getAdminLevel());

            for ($i = 0; $i <= sizeof($pieces); $i++) {
                if(in_array($pieces[$i], $adminLevels)) {
                    $accessCount++;
                }
            }
            $testLogin = true;
        } else {
            $_SESSION['login'] = false;
            session_unset();
            session_destroy();
            $this->_f3->reroute('/Login');
        }
        $this->_f3->set('accessCount', $accessCount);
        $this->_f3->set('login', $testLogin);
        $this->_f3->set('admin', $admin);
    }
}