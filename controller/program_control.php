<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 4/22/2017
 * Time: 8:35 PM
 */
class ProgramControl
{
    private $_f3;
    private $_params;
    private $_errors;
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
    public function viewPrograms()
    {
        $database = new Database();
        $results = $database->getAllPrograms();
        $programs = array();
        $char_remove = array('(', ')', ' ', '-');

        foreach($results as $result)
        {
            $program = new Program();
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

            $contacts_name = $this->explodeStringOnTilde($result['contact_name']);
            $contacts_title = $this->explodeStringOnTilde($result['contact_title']);
            $contacts_desc = $this->explodeStringOnTilde($result['contact_desc']);
            $contacts_phone = $this->explodeStringOnTilde($result['contact_phone']);
            $contacts_email = $this->explodeStringOnTilde($result['contact_email']);

            $sizeof_array = array();

            array_push($sizeof_array, sizeof($contacts_name));
            array_push($sizeof_array, sizeof($contacts_title));
            array_push($sizeof_array, sizeof($contacts_desc));
            array_push($sizeof_array, sizeof($contacts_phone));
            array_push($sizeof_array, sizeof($contacts_email));

            $largest_array_count = $this->getLargestNumber($sizeof_array);

            if($largest_array_count>0)
            {
                for ($i=0; $i<$largest_array_count; $i++)
                {
                    $contact = new Contact();
                    $contact_exists = false;
                    if($contacts_name[$i] != null)
                    {
                        $contact_exists = true;
                        $contact->setContactName($contacts_name[$i]);
                    }
                    if($contacts_title[$i] != null)
                    {
                        $contact_exists = true;
                        $contact->setContactTitle($contacts_title[$i]);
                    }
                    if($contacts_desc[$i] != null)
                    {
                        $contact_exists = true;
                        $contact->setContactDesc($contacts_desc[$i]);
                    }
                    if($contacts_phone[$i] != null)
                    {
                        $contact_exists = true;
                        $contact->setContactPhone($contacts_phone[$i]);
                    }
                    if($contacts_email[$i] != null)
                    {
                        $contact_exists = true;
                        $contact->setContactEmail($contacts_email[$i]);
                    }
                    if($contact_exists)
                    {
                        $program->addContact($contact);
                    }
                }
            }

            $program->setImgPath($result['img_path']);
            $program->setLink($result['link']);
            $program->setLinkText($result['link_text']);
            $program->setActive($result['active']);
            array_push($programs, $program);
        }

        $database = new Database();
        $results = $database->getAllFAQ();
        $faq_array = array();

        foreach($results as $result)
        {
            $array['id'] = $result['id'];
            $array['question'] = htmlspecialchars_decode($result['question']);
            $array['answer'] = htmlspecialchars_decode($result['answer']);

            array_push($faq_array, $array);
        }

        $this->_f3->set('faq_array', $faq_array);
        $this->_f3->set('programs', $programs);
        $this->_f3->set('char_remove', $char_remove);

        echo Template::instance()->render('view/include/head.php');
        echo Template::instance()->render('view/include/top-nav.php');
        echo Template::instance()->render('view/programs.php');
        echo Template::instance()->render('view/include/footer.php');
    }

    public function viewEditProgram()
    {
        $database = new Database();
        $results = $database->getProgramWhere($this->_params['id']);
        if(sizeof($results)==1)
        {
            $result = $results[0];

            foreach($result as $key => $value)
            {
                $results[$key] = htmlspecialchars_decode($value);
            }

            $program = new Program();
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
            $program->setImgPath($result['img_path']);
            $program->setLink($result['link']);
            $program->setLinkText($result['link_text']);
            $program->setActive($result['active']);

            $contacts_name = $this->explodeStringOnTilde($result['contact_name']);
            $contacts_title = $this->explodeStringOnTilde($result['contact_title']);
            $contacts_desc = $this->explodeStringOnTilde($result['contact_desc']);
            $contacts_phone = $this->explodeStringOnTilde($result['contact_phone']);
            $contacts_email = $this->explodeStringOnTilde($result['contact_email']);

            $sizeof_array = array();

            array_push($sizeof_array, sizeof($contacts_name));
            array_push($sizeof_array, sizeof($contacts_title));
            array_push($sizeof_array, sizeof($contacts_desc));
            array_push($sizeof_array, sizeof($contacts_phone));
            array_push($sizeof_array, sizeof($contacts_email));

            $largest_array_count = $this->getLargestNumber($sizeof_array);

            if($largest_array_count>0)
            {
                for ($i=0; $i<$largest_array_count; $i++)
                {
                    $contact = new Contact();
                    $contact_exists = false;
                    if($contacts_name[$i] != null)
                    {
                        $contact_exists = true;
                        $contact->setContactName($contacts_name[$i]);
                    }
                    if($contacts_title[$i] != null)
                    {
                        $contact_exists = true;
                        $contact->setContactTitle($contacts_title[$i]);
                    }
                    if($contacts_desc[$i] != null)
                    {
                        $contact_exists = true;
                        $contact->setContactDesc($contacts_desc[$i]);
                    }
                    if($contacts_phone[$i] != null)
                    {
                        $contact_exists = true;
                        $contact->setContactPhone($contacts_phone[$i]);
                    }
                    if($contacts_email[$i] != null)
                    {
                        $contact_exists = true;
                        $contact->setContactEmail($contacts_email[$i]);
                    }
                    if($contact_exists)
                    {
                        $program->addContact($contact);
                    }
                }
            }

            $this->_f3->set('editResult', $this->_params['editResult']);
            $this->_f3->set('id', $this->_params['id']);
            $this->_f3->set('program', $program);
            $this->_f3->set('desc_list_data', $result['desc_list_data']);
            $this->_f3->set('info_list_data', $result['info_list_data']);
            $this->_f3->set('footer_list_data', $result['footer_list_data']);
            $this->_f3->set('contact_name', $result['contact_name']);
            $this->_f3->set('contact_title', $result['contact_title']);
            $this->_f3->set('contact_desc', $result['contact_desc']);
            $this->_f3->set('contact_phone', $result['contact_phone']);
            $this->_f3->set('contact_email', $result['contact_email']);

            echo Template::instance()->render('view/include/head.php');
            echo Template::instance()->render('view/include/top-nav.php');
            echo Template::instance()->render('view/edit-program.php');
            echo Template::instance()->render('view/include/footer.php');
        }
    }

    public function postProgramFormEdits()
    {
        // define variables and set to empty values
        $input_array = array();
        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $input_array['title'] = $this->test_input($_POST['title']);
            $input_array['sub_title'] = $this->test_input($_POST['sub-title']);
            $input_array['desc_head'] = $this->test_input($_POST['desc-head']);
            $input_array['desc_body'] = $this->test_input($_POST['desc-body']);
            $input_array['desc_list_head'] = $this->test_input($_POST['desc-list-head']);
            $input_array['desc_list_data'] = $this->test_input($_POST['desc-list-data']);
            $input_array['desc_footer_head'] = $this->test_input($_POST['desc-footer-head']);
            $input_array['desc_footer_body'] = $this->test_input($_POST['desc-footer-body']);
            $input_array['info_head'] = $this->test_input($_POST['info-head']);
            $input_array['info_body'] = $this->test_input($_POST['info-body']);
            $input_array['info_list_head'] = $this->test_input($_POST['info-list-head']);
            $input_array['info_list_data'] = $this->test_input($_POST['info-list-data']);
            $input_array['info_footer_head'] = $this->test_input($_POST['info-footer-head']);
            $input_array['info_footer_body'] = $this->test_input($_POST['info-footer-body']);
            $input_array['footer_head'] = $this->test_input($_POST['footer-head']);
            $input_array['footer_body'] = $this->test_input($_POST['footer-body']);
            $input_array['footer_list_head'] = $this->test_input($_POST['footer-list-head']);
            $input_array['footer_list_data'] = $this->test_input($_POST['footer-list-data']);
            $input_array['contact_name'] = $this->test_input($_POST['contact-name']);
            $input_array['contact_title'] = $this->test_input($_POST['contact-title']);
            $input_array['contact_desc'] = $this->test_input($_POST['contact-desc']);
            $input_array['contact_phone'] = $this->test_input($_POST['contact-phone']);
            $input_array['contact_email'] = $this->test_input($_POST['contact-email']);

            if(!empty($_FILES["usr-file-upload"]["name"]))
            {
                $img_path = $this->fileUpload();

                if(!is_array($img_path))
                {
                    $input_array['img_path'] = $img_path;
                }
                else
                {
                    $this->_errors = $img_path;
                }
            }
            else
            {
                $input_array['img_path'] = $this->test_input($_POST['img-path']);
            }
            $input_array['link'] = $this->test_input($_POST['link']);
            $input_array['link_text'] = $this->test_input($_POST['link-text']);
        }

        if(is_array($img_path))
        {
            echo Template::instance()->render('view/include/head.php');
            echo Template::instance()->render('view/include/top-nav.php');
            echo '<div class="container-fluid">';
            echo '<div class="alert alert-danger">';
            echo '<strong>Danger!</strong>';
            if(is_array($img_path))
            {
                foreach ($img_path as $error)
                {
                    echo '<p>' . $error . '</p>';
                }
            }
            echo '</div>';
            echo '</div>';
        }
        else
        {
            $database = new Database();

            if($database->updateProgram($input_array, $this->_params['id']))
            {
                $url = '/Admin/edit-program/' . $this->_params['id'];
                $this->_f3->reroute($url . '/success');
            }
            else
            {
                $errors = $database->getErrors();

                if(!empty($errors))
                {
                    echo Template::instance()->render('view/include/head.php');
                    echo Template::instance()->render('view/include/top-nav.php');
                    echo '<div class="container-fluid">';
                    echo '<div class="alert alert-danger">';
                    echo '<strong>Danger!</strong>';
                    foreach($errors as $error)
                    {
                        echo '<p>' . $error . '</p>';
                    }
                    echo '</div>';
                    echo '</div>';
                }
            }
        }
    }

    public function updateFAQTable()
    {
        // define variables and set to empty values
        $input_array = array();
        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $database = new Database();

            foreach ($_POST['faq-array'] as $key => $value)
            {
                foreach ($value as $inner_key => $inner_value)
                {
                    $input_array[$inner_key] = $this->test_input($inner_value);
                    //echo 'array[' . $inner_key . '] = "' . $inner_value . '"<br>';
                    $database->updateFAQTable($input_array, $key);
                }
            }
            $errors = $database->getErrors();
            if($errors)
            {
                echo Template::instance()->render('view/include/head.php');
                echo Template::instance()->render('view/include/top-nav.php');
                echo '<div class="container-fluid">';
                echo '<div class="alert alert-danger">';
                echo '<strong>Danger!</strong>';
                foreach($errors as $error)
                {
                    echo '<p>' . $error . '</p>';
                }
                echo '</div>';
                echo '</div>';
            }
            else
            {
                $this->_f3->reroute( '/Programs');
            }
        }
    }

    public function viewAddProgram()
    {
        echo Template::instance()->render('view/include/head.php');
        echo Template::instance()->render('view/include/top-nav.php');
        echo Template::instance()->render('view/add-program.php');
        echo Template::instance()->render('view/include/footer.php');
    }

    public function addProgram()
    {
        $img_path = '';
        $database = new Database();

        $next_id = $database->getNextId("programs");

        // define variables and set to empty values
        $input_array = array();
        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $input_array['title'] = $this->test_input($_POST['title']);
            $input_array['sub_title'] = $this->test_input($_POST['sub-title']);
            $input_array['desc_head'] = $this->test_input($_POST['desc-head']);
            $input_array['desc_body'] = $this->test_input($_POST['desc-body']);
            $input_array['desc_list_head'] = $this->test_input($_POST['desc-list-head']);
            $input_array['desc_list_data'] = $this->test_input($_POST['desc-list-data']);
            $input_array['desc_footer_head'] = $this->test_input($_POST['desc-footer-head']);
            $input_array['desc_footer_body'] = $this->test_input($_POST['desc-footer-body']);
            $input_array['info_head'] = $this->test_input($_POST['info-head']);
            $input_array['info_body'] = $this->test_input($_POST['info-body']);
            $input_array['info_list_head'] = $this->test_input($_POST['info-list-head']);
            $input_array['info_list_data'] = $this->test_input($_POST['info-list-data']);
            $input_array['info_footer_head'] = $this->test_input($_POST['info-footer-head']);
            $input_array['info_footer_body'] = $this->test_input($_POST['info-footer-body']);
            $input_array['footer_head'] = $this->test_input($_POST['footer-head']);
            $input_array['footer_body'] = $this->test_input($_POST['footer-body']);
            $input_array['footer_list_head'] = $this->test_input($_POST['footer-list-head']);
            $input_array['footer_list_data'] = $this->test_input($_POST['footer-list-data']);
            $input_array['contact_name'] = $this->test_input($_POST['contact-name']);
            $input_array['contact_title'] = $this->test_input($_POST['contact-title']);
            $input_array['contact_desc'] = $this->test_input($_POST['contact-desc']);
            $input_array['contact_phone'] = $this->test_input($_POST['contact-phone']);
            $input_array['contact_email'] = $this->test_input($_POST['contact-email']);

            if(!empty($_FILES["usr-file-upload"]["name"]))
            {
                $img_path = $this->fileUpload();

                if(!is_array($img_path))
                {
                    $input_array['img_path'] = $img_path;
                }
            }
            else
            {
                $input_array['img_path'] = $this->test_input($_POST['img-path']);
            }

            $input_array['link'] = $this->test_input($_POST['link']);
            $input_array['link_text'] = $this->test_input($_POST['link-text']);
        }
        $database = new Database();

        if($database->insertIntoDatabase("programs", $input_array))
        {
            if(is_array($img_path))
            {
                echo Template::instance()->render('view/include/head.php');
                echo Template::instance()->render('view/include/top-nav.php');
                echo '<div class="container-fluid">';
                echo '<div class="alert alert-danger">';
                echo '<strong>Danger!</strong>';
                foreach ($img_path as $error)
                {
                    echo '<p>' . $error . '</p>';
                }
                echo '</div>';
                echo '</div>';
                echo Template::instance()->render('view/include/footer.php');
            }
            else
            {
                $this->_f3->reroute('/Admin/edit-program/'. $next_id . '/success');
            }
        }
        else
        {
            $errors = $database->getErrors();

            echo '<div class="alert alert-danger">';
            echo '<strong>Danger!</strong>';
            foreach ($errors as $error)
            {
                echo '<p>' . $error . '</p>';
            }
            echo '</div>';
        }
    }

    private function test_input($data)
    {
        $data = $this->removeLeadingTilde($data);
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    private function fileUpload()
    {
        $errors = array();

        $target_dir = "asset/img/";
        $target_file = $target_dir . basename($_FILES["usr-file-upload"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["usr-file-upload"]["tmp_name"]);
            if($check !== false) {
                array_push($errors, "File is an image - " . $check["mime"] . ".");
                $uploadOk = 1;
            } else {
                array_push($errors, "File is not an image.");
                $uploadOk = 0;
            }
        }
        
        // Check file size
        if ($_FILES["usr-file-upload"]["size"] > 7500000) {
            array_push($errors, "Sorry, your file is too large.");
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
            array_push($errors, "Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            array_push($errors, "Sorry, your file was not uploaded.");
            // if everything is ok, try to upload file
        } else {

            if(isset($this->_params['id']))
            {
                $id = $this->_params['id'];
                if(file_exists("asset/img/".$id."_program.".$imageFileType)) unlink("asset/img/".$id."_program.".$imageFileType);
            }
            else
            {
                $database = new Database();

                $id = $database->getNextId("programs");
            }

            if (move_uploaded_file($_FILES["usr-file-upload"]["tmp_name"], $target_file))
            {
                rename($target_dir.$_FILES["usr-file-upload"]["name"], "asset/img/".$id."_program.".$imageFileType);
            }
            else
            {
                array_push($errors, "Sorry, there was an error uploading your file.");
            }
        }

        if(!empty($errors))
        {
            return $errors;
        }
        else
        {
            return "asset/img/".$id."_program.".$imageFileType;
        }
    }

    private function explodeStringOnTilde($string)
    {
        $string = $this->removeLeadingTilde($string);

        $return_array = array();

        if(strpos($string, '~'))
        {
            $array = explode("~", $string);

            for($i=0; $i<sizeof($array); $i++)
            {
                if($array[$i] != null)
                {
                    array_push($return_array, $array[$i]);
                }
            }

        }
        else
        {
            if($string != '' && $string != null)
            {
                array_push($return_array, $string);
            }
        }

        return $return_array;
    }

    private function removeLeadingTilde($string)
    {
        if(substr($string, 0 , 1) == "~")
        {
            $string = ltrim($string, "~");
        }
        return $string;
    }

    private function getLargestNumber($array)
    {
        if(sizeof($array)>0)
        {
            $largest_number = 0;

            $int_array = array();

            foreach ($array as $value)
            {
                array_push($int_array, intval($value));
            }

            foreach ($int_array as $number)
            {
                if($number>$largest_number)
                {
                    $largest_number = $number;
                }
            }

            return $largest_number;
        }
        else
        {
            return;
        }
    }

    public function deleteProgram()
    {
        $database = new Database();
        $id = $this->_params['id'];
        $database->deleteProgram($id);
        $this->_f3->reroute('/Admin');
    }

    public function reactivateProgram()
    {
        $database = new Database();
        $id = $this->_params['id'];
        $database->reactivateProgram($id);
        $this->_f3->reroute('/Admin');
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
        if(isset($_SESSION['user']) === true && strpos($admin->getAdminLevel(), Program) !== false) {
            $testLogin = true;
        } else {
            $this->_f3->reroute('/Login');
        }
        $this->_f3->set('login', $testLogin);
        $this->_f3->set('admin', $admin);
    }

    public function canEditFaq()
    {
        $database = new Database();
        $loggedIn = $database->getAdminByUsername($_SESSION['user']);
        $admin = new Admin($loggedIn['adminId'], $loggedIn['username'], $loggedIn['adminLevel'], $loggedIn['active']);
        if(isset($_SESSION['user']) === true && strpos($admin->getAdminLevel(), Program) !== false && $admin->getActive() == 1) {
            $testLogin = true;
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