<?php
session_start();
/**
 * Index manages all routing done on the site
 *
 * PHP Version 5
 *
 * @author Lucas Harlor <lharlor@mail.greenriver.edu>
 * @version 1.0
 */
    //referencing my autoloader and retrieving our router
    require_once 'vendor/autoload.php';
    require_once 'model/validation.php';
            
    $f3 = require('vendor/bcosca/fatfree-core/base.php');
    
    //error handling
    $f3->set('DEBUG', 3);
    
    //define our routes
    $f3->route('GET /', function($f3, $params)
    {
        $controller = new HomeControl($f3, $params);
        $controller->getAdmin();
        $controller->viewHome();
    });
    
    $f3->route('GET /Admin/add-events', function($f3, $params){
        $controller = new eventsControl($f3, $params);
        $controller->isLoggedIn();
        $controller->viewAddEvents();
    });
    
    $f3->route('GET /Admin/edit-events/@id', function($f3, $params)
    {
        $controller = new eventsControl($f3, $params);
        $controller->isLoggedIn();
        $controller->viewEditEvents();
    });

    $f3->route('POST /Admin/edit-events/@id', function($f3, $params)
    {
        $controller = new eventsControl($f3, $params);
        $controller->isLoggedIn();
        $controller->editEvents();
    });

    $f3->route('POST /Admin/add-events', function($f3, $params){
        $controller = new eventsControl($f3, $params);
        $controller->isLoggedIn();
        $controller->addEvent();
    });
    
    $f3->route('GET /Admin/delete-events/@id', function($f3, $params){
       $controller = new eventsControl($f3, $params);
       $controller->isLoggedIn();
       $controller->removeEvent();
    });

    $f3->route('GET /Admin/reactivate-events/@id', function($f3, $params){
        $controller = new eventsControl($f3, $params);
        $controller->isLoggedIn();
        $controller->reactivateEvent();
    });
    
    $f3->route('GET /Apply', function($f3, $params)
    {
        $controller = new ApplyControl($f3, $params);
        $controller->getAdmin();
        $controller->viewApply();
    });
    
    $f3->route('POST /Apply', function($f3, $params)
    {
        $controller = new ApplyControl($f3, $params);
        $controller->getAdmin();
        $controller->viewAddApplicant();
    });
    
    $f3->route('GET /Applied', function($f3, $params)
    {
        $controller = new ApplyControl($f3, $params);
        $controller->isLoggedIn();
        $controller->showApplicants();
    });
    
    $f3->route('GET /Staff', function($f3, $params)
    {
        $controller = new StaffControl($f3, $params);
        $controller->getAdmin();
        $controller->viewStaff();
    });

    $f3->route('GET /partners', function($f3, $params)
    {
        $controller = new PartnerControl($f3, $params);
        $controller->getAdmin();
        $controller->viewPartners();
    });

    $f3->route('GET /Admin/add-partner', function($f3, $params)
    {
        $controller = new PartnerControl($f3, $params);
        $controller->getAdmin();
        $controller->viewAddPartner();
    });

    $f3->route('POST /Admin/add-partner', function($f3, $params)
    {
        $controller = new PartnerControl($f3, $params);
        $controller->isLoggedIn();
        $controller->addPartner();
    });

    $f3->route('GET /Admin/edit-partner/@id', function($f3, $params)
    {
        $controller = new PartnerControl($f3, $params);
        $controller->isLoggedIn();
        $controller->viewEditPartner();
    });

    $f3->route('GET /Admin/edit-partner/@id/@editResult', function($f3, $params)
    {
        $controller = new PartnerControl($f3, $params);
        $controller->isLoggedIn();
        $controller->viewEditPartner();
    });

    $f3->route('POST /Admin/edit-partner/@id', function($f3, $params)
    {
        $controller = new PartnerControl($f3, $params);
        $controller->isLoggedIn();
        $controller->postPartnerFormEdits();
    });

    $f3->route('GET /Admin/delete-partner/@id', function($f3, $params)
    {
        $controller = new PartnerControl($f3, $params);
        $controller->isLoggedIn();
        $controller->deletePartner();
    });

    $f3->route('GET /Admin/reactivate-partner/@id', function($f3, $params)
    {
        $controller = new PartnerControl($f3, $params);
        $controller->isLoggedIn();
        $controller->reactivatePartner();
    });

    $f3->route('GET /programs', function($f3, $params)
    {
        $controller = new ProgramControl($f3, $params);
        $controller->getAdmin();
        $controller->canEditFaq();
        $controller->viewPrograms();
    });

    $f3->route('GET /Admin/add-program', function($f3, $params)
    {
        $controller = new ProgramControl($f3, $params);
        $controller->isLoggedIn();
        $controller->viewAddProgram();
    });

    $f3->route('POST /Admin/add-program', function($f3, $params)
    {
        $controller = new ProgramControl($f3, $params);
        $controller->isLoggedIn();
        $controller->addProgram();
    });

    $f3->route('GET /Admin/edit-program/@id', function($f3, $params)
    {
        $controller = new ProgramControl($f3, $params);
        $controller->isLoggedIn();
        $controller->viewEditProgram();
    });

    $f3->route('GET /Admin/edit-program/@id/@editResult', function($f3, $params)
    {
        $controller = new ProgramControl($f3, $params);
        $controller->isLoggedIn();
        $controller->viewEditProgram();
    });

    $f3->route('POST /Admin/edit-program/@id', function($f3, $params)
    {
        $controller = new ProgramControl($f3, $params);
        $controller->isLoggedIn();
        $controller->postProgramFormEdits();
    });

    $f3->route('GET /Admin/delete-program/@id', function($f3, $params)
    {
        $controller = new ProgramControl($f3, $params);
        $controller->isLoggedIn();
        $controller->deleteProgram();
    });

    $f3->route('GET /Admin/reactivate-program/@id', function($f3, $params)
    {
        $controller = new ProgramControl($f3, $params);
        $controller->isLoggedIn();
        $controller->reactivateProgram();
    });

    $f3->route('POST /update-faq-table', function($f3, $params)
    {
        $controller = new ProgramControl($f3, $params);
        $controller->updateFAQTable();
    });


    $f3->route('GET /Advising', function($f3, $params)
    {
        $controller = new AdvisingControl($f3, $params);
        $controller->getAdmin();
        $controller->viewAdvising();

    });
    
    $f3->route('GET /Admin/add-financial-aid', function($f3, $params){
        $controller = new FinancialAidControl($f3, $params);
        $controller->isLoggedIn();
        $controller->viewAddFinancialAid();
    });

    $f3->route('POST /Admin/add-financial-aid', function($f3, $params){
        $controller = new FinancialAidControl($f3, $params);
        $controller->isLoggedIn();
        $controller->addFinancialAid();
    });
    
    $f3->route('GET /Financial_Aid', function($f3, $params)
    {
        $controller = new FinancialAidControl($f3, $params);
        $controller->getAdmin();
        $controller->viewFinancialAid();
    });
    
    $f3->route('GET /Admin/edit-financial-aid/@id', function($f3, $params)
    {
       $controller = new FinancialAidControl($f3, $params);
       $controller->isLoggedIn();
       $controller->viewEditFinancialAid();
    });
    
    $f3->route('POST /Admin/edit-financial-aid/@id', function($f3, $params)
    {
       $controller = new FinancialAidControl($f3, $params);
       $controller->isLoggedIn();
       $controller->editFinancialAid();
    });
    
    $f3->route('GET /Admin/delete-financial-aid/@id', function($f3, $params){
        $controller = new FinancialAidControl($f3, $params);
        $controller->isLoggedIn();
        $controller->removeFinancialAid();
    });

    $f3->route('GET /Admin/reactivate-financial-aid/@id', function($f3, $params){
        $controller = new FinancialAidControl($f3, $params);
        $controller->isLoggedIn();
        $controller->reactivateFinancialAid();
    });

    $f3->route('GET /Contact_Us', function($f3, $params)
    {
        $controller = new ContactusControl($f3, $params);
        $controller->getAdmin();
        $controller->viewContactus();
    });
    $f3->route('POST /Contact_Us', function($f3, $params)
    {
        $controller = new ContactusControl($f3, $params);
        $controller->getAdmin();
        $controller->postContactus();
    });
    
    $f3->route('GET /History', function($f3, $params)
    {
        $controller = new HistoryControl($f3, $params);
        $controller->getAdmin();
        $controller->viewHistory();
    });
    
    $f3->route('GET /Login', function($f3, $params)
    {
        $controller = new LoginControl($f3, $params);
        $controller->viewLogin();
    });

    $f3->route('POST /Login', function($f3, $params)
    {
        $controller = new LoginControl($f3, $params);
        $controller->validateLogin();
    });
    
    $f3->route('GET /Admin', function($f3, $params)
    {
        $controller = new AdminControl($f3, $params);
        $controller->isLoggedIn();
        $controller->viewAdmin();
    });
    
    $f3->route('GET /Admin/edit-staff/@id', function($f3, $params)
    {
        $controller = new StaffControl($f3, $params);
        $controller->isLoggedIn();
        $controller->viewEditStaff();
    });

    $f3->route('POST /Admin/edit-staff/@id', function($f3, $params)
    {
        $controller = new StaffControl($f3, $params);
        $controller->isLoggedIn();
        $controller->postEditStaff();
    });

    $f3->route('GET /Admin/add-staff', function($f3, $params)
    {
        $controller = new StaffControl($f3, $params);
        $controller->isLoggedIn();
        $controller->viewAddStaff();
    });

    $f3->route('POST /Admin/add-staff', function($f3, $params)
    {
        $controller = new StaffControl($f3, $params);
        $controller->isLoggedIn();
        $controller->postAddStaff();
    });
    
    $f3->route('GET /Admin/delete-staff/@id', function($f3, $params)
    {
        $controller = new StaffControl($f3, $params);
        $controller->isLoggedIn();
        $controller->deleteStaff();
    });

    $f3->route('GET /Admin/reactivate-staff/@id', function($f3, $params)
    {
        $controller = new StaffControl($f3, $params);
        $controller->isLoggedIn();
        $controller->reactivateStaff();
    });

    $f3->route('GET /Admin/add-users', function($f3, $params)
    {

        $controller = new userControl($f3, $params);
        $controller->isLoggedIn();
        $controller->viewAddUsers();
    });

    $f3->route('POST /Admin/add-users', function($f3, $params)
    {
        $controller = new userControl($f3, $params);
        $controller->isLoggedIn();
        $controller->postAddUsers();
    });

    $f3->route('GET /Admin/edit-users/@id', function($f3, $params)
    {
        $controller = new userControl($f3, $params);
        $controller->isLoggedIn();
        $controller->viewEditUsers();
    });
    $f3->route('POST /Admin/edit-users/@id', function($f3, $params)
    {
        $controller = new userControl($f3, $params);
        $controller->isLoggedIn();
        $controller->postEditUsers();
    });

    $f3->route('GET /Admin/delete-users/@id', function($f3, $params)
    {
        $controller = new userControl($f3, $params);
        $controller->isLoggedIn();
        $controller->deleteUser();
    });

    $f3->route('GET /Admin/reactivate-users/@id', function($f3, $params)
    {
        $controller = new userControl($f3, $params);
        $controller->isLoggedIn();
        $controller->reactivateUser();
    });

    $f3->route('GET /Admin/delete-alert/@id', function($f3, $params)
    {
        $controller = new AlertControl($f3, $params);
        $controller->isLoggedIn();
        $controller->deleteAlert();
    });

    $f3->route('GET /Admin/reactivate-alert/@id', function($f3, $params)
    {
        $controller = new AlertControl($f3, $params);
        $controller->isLoggedIn();
        $controller->reactivateAlert();
    });

    $f3->route('GET /Admin/add-alert', function($f3, $params)
    {
        $controller = new AlertControl($f3, $params);
        $controller->isLoggedIn();
        $controller->viewAddAlert();
    });

    $f3->route('GET /Admin/activate-alert/@id', function($f3, $params)
    {
        $controller = new AlertControl($f3, $params);
        $controller->isLoggedIn();
        $controller->activateAlert();
    });

    $f3->route('POST /Admin/add-alert', function($f3, $params)
    {
        $controller = new AlertControl($f3, $params);
        $controller->isLoggedIn();
        $controller->postAddAlert();
    });

    $f3->route('GET /Admin/edit-alert/@id', function($f3, $params)
    {
        $controller = new AlertControl($f3, $params);
        $controller->isLoggedIn();
        $controller->viewEditAlert();
    });
    $f3->route('POST /Admin/edit-alert/@id', function($f3, $params)
    {
        $controller = new AlertControl($f3, $params);
        $controller->isLoggedIn();
        $controller->postEditAlert();
    });

    $f3->route('GET /Student_Work', function($f3, $params)
    {
        $controller = new StudentWorkControl($f3, $params);
        $controller->getAdmin();
        $controller->viewStudentWork();
    });

    $f3->route('GET /Admin/delete-student-work/@id', function($f3, $params)
    {
        $controller = new StudentWorkControl($f3, $params);
        $controller->isLoggedIn();
        $controller->deleteStudentWork();
    });

    $f3->route('GET /Admin/reactivate-student-work/@id', function($f3, $params)
    {
        $controller = new StudentWorkControl($f3, $params);
        $controller->isLoggedIn();
        $controller->reactivateStudentWork();
    });

    $f3->route('GET /Admin/add-student-work', function($f3, $params)
    {
        $controller = new StudentWorkControl($f3, $params);
        $controller->isLoggedIn();
        $controller->viewAddStudentWork();
    });

    $f3->route('POST /Admin/add-student-work', function($f3, $params)
    {
        $controller = new StudentWorkControl($f3, $params);
        $controller->isLoggedIn();
        $controller->postAddStudentWork();
    });

    $f3->route('GET /Admin/edit-student-work/@id', function($f3, $params)
    {
        $controller = new StudentWorkControl($f3, $params);
        $controller->isLoggedIn();
        $controller->viewEditStudentWork();
    });

    $f3->route('POST /Admin/edit-student-work/@id', function($f3, $params)
    {
        $controller = new StudentWorkControl($f3, $params);
        $controller->isLoggedIn();
        $controller->postEditStudentWork();
    });

    $f3->route('POST /footerEmail', function($f3, $params)
    {
        $controller = new footerEmailControl($f3, $params);
        $controller->getAdmin();
        $controller->postFooterEmail();
    });
    $f3->route('GET /footerEmail', function($f3, $params)
    {
        $controller = new footerEmailControl($f3, $params);
        $controller->isLoggedIn();
        $controller->getAdmin();
        $controller->viewFooterEmail();
    });
    $f3->route('GET /events/@id', function($f3, $params)
    {
        $controller = new eventsControl($f3, $params);
        $controller->getAdmin();
        $controller->viewEventID();
    });
    $f3->route('GET /events', function($f3, $params)
    {
        $controller = new eventsControl($f3, $params);
        $controller->getAdmin();
        $controller->viewEventHome();
    });

    $f3->route('GET /Admin/add-resources', function($f3, $params)
    {
        $controller = new resourceControl($f3, $params);
        $controller->isLoggedIn();
        $controller->viewAddResources();
    });

    $f3->route('GET /Admin/edit-resources/@id', function($f3, $params)
    {
        $controller = new resourceControl($f3, $params);
        $controller->isLoggedIn();
        $controller->viewEditResources();
    });

    $f3->route('POST /Admin/add-resources', function($f3, $params)
    {
        $controller = new resourceControl($f3, $params);
        $controller->isLoggedIn();
        $controller->postAddResource();
    });

    $f3->route('POST /Admin/edit-resources/@id', function($f3, $params)
    {
        $controller = new resourceControl($f3, $params);
        $controller->isLoggedIn();
        $controller->postEditResources();
    });

    $f3->route('GET /Admin/delete-resources/@id', function($f3, $params)
    {
        $controller = new resourceControl($f3, $params);
        $controller->isLoggedIn();
        $controller->deleteResource();
    });

    $f3->route('GET /Admin/reactivate-resources/@id', function($f3, $params)
    {
        $controller = new resourceControl($f3, $params);
        $controller->isLoggedIn();
        $controller->reactivateResource();
    });

    $f3->route('GET /resources', function($f3, $params)
    {
        $controller = new resourceControl($f3, $params);
        $controller->getAdmin();
        $controller->viewResources();
    });

    $f3->route('GET /logout', function($f3, $params)
    {
        $controller = new LoginControl($f3, $params);
        $controller->logout();
        $f3->reroute('/ ');
    });
    $f3->run();
