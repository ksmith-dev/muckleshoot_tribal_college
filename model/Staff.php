<?php
/**
* Staff class that allows the creation of staff objects
*
* PHP Version 5
*
* @author Lucas Harlor <lharlor@mail.greenriver.edu>
* @version 1.0
*/
    class Staff
    {
        //fields
        private $_bioID;
        private $_title;
        private $_firstName;
        private $_lastName;
        private $_jobTitle;
        private $_organization;
        private $_department;
        private $_credentials;
        private $_description;
        private $_dateHired;
        private $_location;
        private $_email;
        private $_phoneNumber;
        private $_photoFilePath;

        //constructor
        /**
         * Creates a new user object
         *
         *@access public
         *@param string $username the name of a user
         *@param string $photo the link to a user's photo
         *@param string $bio the user's bio
         *@param string $totalBlogs the number of blogs a user has posted
         *
         */
        public function __construct($bioID, $title, $lastName, $firstName, $jobTitle, $organization, $credentials, $department, $description, $dateHired,
                                    $location, $email, $phoneNumber, $photoFilePath)
        {
            $this->_bioID = $bioID;
            $this->_title = $title;
            $this->_firstName = $firstName;
            $this->_lastName = $lastName;
            $this->_jobTitle = $jobTitle;
            $this->_organization = $organization;
            $this->_credentials = $credentials;
            $this->_description = $description;
            $this->_department = $department;
            $this->_dateHired = $dateHired;
            $this->_location = $location;
            $this->_email = $email;
            $this->_phoneNumber = $phoneNumber;
            $this->_photoFilePath = $photoFilePath;
        }
    
        //methods
        
        /**
         *Getter for the staff members bio id
         *
         *@access public
         *
         *@return int the staff members bio id
         */
        public function getBioID()
        {
            return $this->_bioID;
        }
        
        /**
         *Getter for the staff members first name
         *
         *@access public
         *
         *@return string the staff members first name
         */
        public function getFirstName()
        {
            return $this->_firstName;
        }
        
        /**
         *Getter for the staff members last name
         *
         *@access public
         *
         *@return string the staff members last name
         */
        public function getLastName()
        {
            return $this->_lastName;
        }
        
        /**
         *Getter for the staff members title
         *
         *@access public
         *
         *@return string the staff members title
         */
        public function getTitle()
        {
            return $this->_title;
        }
        
        /**
         *Getter for the staff members job title
         *
         *@access public
         *
         *@return string the staff members job title
         */
        public function getJobTitle()
        {
            return $this->_jobTitle;
        }
        
        /**
         *Getter for the staff members organization
         *
         *@access public
         *
         *@return string the staff members organization
         */
        public function getOrganization()
        {
            return $this->_organization;
        }
        
        /**
         *Getter for the staff members credentials
         *
         *@access public
         *
         *@return string the staff members credentials
         */
        public function getCredentials()
        {
            return $this->_credentials;
        }
        
        /**
         *Getter for the staff members description
         *
         *@access public
         *
         *@return string the staff members description
         */
        public function getDescription()
        {
            return $this->_description;
        }
        
        /**
         *Getter for the staff members department
         *
         *@access public
         *
         *@return string the staff members department
         */
        public function getDepartment()
        {
            return $this->_department;
        }
        
        /**
         *Getter for the staff members hiring date
         *
         *@access public
         *
         *@return date the staff members hiring date
         */
        public function getDateHired()
        {
            return $this->_dateHired;
        }
        
        /**
         *Getter for the staff members location
         *
         *@access public
         *
         *@return string the staff members location
         */
        public function getLocation()
        {
            return $this->_location;
        }
        
        /**
         *Getter for the staff members email
         *
         *@access public
         *
         *@return string the staff members email
         */
        public function getEmail()
        {
            return $this->_email;
        }
        
        /**
         *Getter for the staff members location
         *
         *@access public
         *
         *@return string the staff members location
         */
        public function getPhoneNumber()
        {
            return $this->_phoneNumber;
        }
        
        /**
         *Getter for the staff members location
         *
         *@access public
         *
         *@return date the staff members location
         */
        public function getPhotoPath()
        {
            return $this->_photoFilePath;
        }
    }
?>