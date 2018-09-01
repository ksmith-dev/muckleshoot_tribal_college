<?php
/**
* Admin class that allows the creation of Admin objects
*
* PHP Version 5
*
* @author Lucas Harlor <lharlor@mail.greenriver.edu>
* @version 1.0
*/
    class Admin
    {
        //fields
        private $_adminId;
        private $_username;
        private $_adminLevel;
        private $_active;

        //constructor
        /**
         * Creates a new admin object
         *
         *@access public
         *@param int $adminId the id of the admin
         *@param string $username the username of the admin
         *@param int $adminLevel the admins athority level
         *@param boolean $active if the admin account is currently active
         *
         */
        public function __construct($adminId, $username, $adminLevel, $active)
        {
            $this->_adminId = $adminId;
            $this->_username = $username;
            $this->_adminLevel = $adminLevel;
            $this->_active = $active;

        }
    
        //methods
        
        /**
         *Getter for the admin id
         *
         *@access public
         *
         *@return int the admin id
         */
        public function getAdminId()
        {
            return $this->_adminId;
        }
        
        /**
         *Getter for the admin username
         *
         *@access public
         *
         *@return string the admin name
         */
        public function getAdminUsername()
        {
            return $this->_username;
        }
        
        /**
         *Getter for the admin authority level
         *
         *@access public
         *
         *@return int the admin authority level
         */
        public function getAdminLevel()
        {
            return $this->_adminLevel;
        }
        
        /**
         *Getter for the admin active state
         *
         *@access public
         *
         *@return boolean if the admin account is active
         */
        public function getActive()
        {
            return $this->_active;
        }
    }
?>