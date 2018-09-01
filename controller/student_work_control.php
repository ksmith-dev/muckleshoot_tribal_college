<?php

/**
 * Created by PhpStorm.
 * User: Lucas Harlor
 * Date: 4/21/17
 * Time: 11:18 AM
 */
class StudentWorkControl
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

    public function viewStudentWork()
    {
        $database = new Database();
        $studentWork = $database->getAllActiveStudentWork();
        $studentWorkArray = array();

        foreach ($studentWork as $projects)
        {
            $project = new StudentWork($projects['projectId'], $projects['studentName'], $projects['projectName'],
                $projects['projectDescription'], $projects['projectFilePath']);

            array_push($studentWorkArray, $project);
        }

        $this->_f3->set('projects', $studentWorkArray);

        echo Template::instance()->render('view/include/head.php');
        echo Template::instance()->render('view/include/top-nav.php');
        echo Template::instance()->render('view/student-work.php');
        echo Template::instance()->render('view/include/footer.php');
    }

    public function viewEditStudentWork()
    {
        $database = new Database();
        $id = $this->_params['id'];

        $results = $database->getProjectById($id);

        $project = new StudentWork($results['projectId'], $results['studentName'], $results['projectName'],
            $results['projectDescription'], $results['projectFilePath']);
        $this->_f3->set('project', $project);

        echo Template::instance()->render('view/include/head.php');
        echo Template::instance()->render('view/include/top-nav.php');
        echo Template::instance()->render('view/edit-student-work.php');
        echo Template::instance()->render('view/include/footer.php');
    }

    public function viewAddStudentWork()
    {
        echo Template::instance()->render('view/include/head.php');
        echo Template::instance()->render('view/include/top-nav.php');
        echo Template::instance()->render('view/edit-student-work.php');
        echo Template::instance()->render('view/include/footer.php');
    }

    public function postEditStudentWork()
    {
        $id = $this->_params['id'];
        $errors = validateStudentWorkEdit($id);

        if(!($errors === true))
        {

            $database = new Database();
            $id = $this->_params['id'];

            $results = $database->getProjectById($id);

            $project = new StudentWork($results['projectId'], $results['studentName'], $results['projectName'],
                $results['projectDescription'], $results['projectFilePath']);
            $this->_f3->set('project', $project);
            $this->_f3->set('errors', $errors);
            echo Template::instance()->render('view/include/head.php');
            echo Template::instance()->render('view/include/top-nav.php');
            echo Template::instance()->render('view/edit-student-work.php');
            echo Template::instance()->render('view/include/footer.php');
        } else {

            $this->_f3->reroute('/Admin');
        }
    }

    public function postAddStudentWork()
    {
        $errors = validateStudentWorkAdd();

        if(!($errors === true))
        {
            $this->_f3->set('errors', $errors);
            echo Template::instance()->render('view/include/head.php');
            echo Template::instance()->render('view/include/top-nav.php');
            echo Template::instance()->render('view/edit-student-work.php');
            echo Template::instance()->render('view/include/footer.php');
        } else {
            $this->_f3->reroute('/Admin');
        }
    }

    public function deleteStudentWork()
    {
        $database = new Database();
        $id = $this->_params['id'];
        $database->deleteStudentWork($id);
        $this->_f3->reroute('/Admin');
    }

    public function reactivateStudentWork()
    {
        $database = new Database();
        $id = $this->_params['id'];
        $database->reactivateStudentWork($id);
        $this->_f3->reroute('/Admin');
    }

    public function isLoggedIn()
    {
        $database = new Database();
        $loggedIn = $database->getAdminByUsername($_SESSION['user']);
        $admin = new Admin($loggedIn['adminId'], $loggedIn['username'], $loggedIn['adminLevel'], $loggedIn['active']);
        if(isset($_SESSION['user']) === true && strpos($admin->getAdminLevel(), StudentWork) !== false && $admin->getActive() == 1) {
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