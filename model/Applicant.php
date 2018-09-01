<?php
/**
 * Class representation of a potential student
 * who applies to the college.
 *
 * @author Edward Mendoza <edcmendoza94@gmail.com>
 * @copyright 2017
 */
    class Applicant
    {
        //Class fields
        private $_id;
        private $_firstName;
        private $_lastName;
        private $_email;
        private $_birthdate;

        /**
         * Class constructor
         *
         * @param int id - Applicant ID number--database
         * only
         * @param String firstName - Applicant's first name
         * @param String lastName - Applicant's last name
         * @param String email - Applicant's e-mail address
         * @param String birthdate - When the applicant was
         * born
         */
        function __construct($id, $firstName, $lastName,
                             $email, $birthdate)
        {
            $this->_id = $id;
            $this->_firstName = $firstName;
            $this->_lastName = $lastName;
            $this->_email = $email;
            $this->_birthdate = $birthdate;
        }

        //Getters only
        /**
         * Retrieve an applicant's ID number
         * as it appears in the database
         *
         * @return int
         */
        public function getID()
        {
            return $this->_id;
        }

        /**
         * Retrieve an applicant's first name
         *
         * @return String
         */
        public function getFirstName()
        {
            return $this->_firstName;
        }

        /**
         * Retrieve an applicant's last name
         *
         * @return String
         */
        public function getLastName()
        {
            return $this->_lastName;
        }

        /**
         * Retrieve an applicant's e-mail address
         *
         * @return String
         */
        public function getEmail()
        {
            return $this->_email;
        }

        /**
         * Retrieve an applicant's birthdate
         *
         * @return String
         */
        public function getBirthDate()
        {
            return $this->_birthdate;
        }
    }
?>