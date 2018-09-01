<?php
/**
 * Class representation of contact methods for
 * an organization behind a program being offered
 * at the college.
 *
 * @author Kevin Smith <Kevin Smith's e-mail>
 * @copyright 2017
 */
class Contact extends Program
{
    //Class fields
    private $_contact_name;
    private $_contact_title;
    private $_contact_desc;
    private $_contact_phone;
    private $_contact_email;

    //Setters and getters
    /**
     * Obtain a contact's name
     *
     * @return mixed
     */
    public function getContactName()
    {
        return $this->_contact_name;
    }

    /**
     * Assign a contact's name
     *
     * @param mixed $contact_name
     */
    public function setContactName($contact_name)
    {
        //Ensure a contact's name is not empty
        if($contact_name != '')
        {
            $this->_contact_name = $contact_name;
        }
    }

    /**
     * @return mixed
     */
    public function getContactTitle()
    {
        return $this->_contact_title;
    }

    /**
     * @param mixed $contact_title
     */
    public function setContactTitle($contact_title)
    {
        if($contact_title != '')
        {

        }
        $this->_contact_title = $contact_title;
    }

    /**
     * @return mixed
     */
    public function getContactDesc()
    {
        return $this->_contact_desc;
    }

    /**
     * @param mixed $contact_desc
     */
    public function setContactDesc($contact_desc)
    {
        if($contact_desc != '')
        {
            $this->_contact_desc = $contact_desc;
        }
    }

    /**
     * @return mixed
     */
    public function getContactPhone()
    {
        return $this->_contact_phone;
    }

    /**
     * @param mixed $contact_phone
     */
    public function setContactPhone($contact_phone)
    {
        if($contact_phone != '')
        {
            $this->_contact_phone = $contact_phone;
        }
    }

    /**
     * @return mixed
     */
    public function getContactEmail()
    {
        return $this->_contact_email;
    }

    /**
     * @param mixed $contact_email
     */
    public function setContactEmail($contact_email)
    {
        if($contact_email != '')
        {
            $this->_contact_email = $contact_email;
        }
    }
}