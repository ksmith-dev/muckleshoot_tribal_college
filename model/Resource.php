<?php
/**
 * Events class that allows the creation of resource objects
 *
 * PHP Version 5
 *
 * @author Lucas Harlor <lharlor@mail.greenriver.edu>
 * @author Stacie Mashnitskaya <smashnitskaya@mail.greenriver.edu>
 * @version 1.0
 */
class Resource
{
    //fields
    private $_resourceID;
    private $_resourceName;
    private $_description;
    private $_contactName;
    private $_contactEmail;
    private $_contactPhone;
    private $_link;
    private $_active;

    //constructor
    /**
     * Creates a new esource object
     *
     *@access public
     *@param int $resourceID the id of the resource
     *@param string $resourceName the name of the resource
     *@param string $desciption the event resource
     *@param int $active the state of the resource

     *
     */
    public function __construct($resourceID, $resourceName, $description,
                                $contactName, $contactEmail,$contactPhone,$link, $active)
    {
        $this->_resourceID = $resourceID;
        $this->_resourceName = $resourceName;
        $this->_description = $description;
        $this->_contactName = $contactName;
        $this->_contactEmail = $contactEmail;
        $this->_contactPhone = $contactPhone;
        $this->_link = $link;
        $this->_active= $active;
    }

    //methods


    /**
     *Getter for the Resource id
     *
     *@access public
     *
     *@return int the Resource id
     */
    public function getResourceId()
    {
        return $this->_resourceID;
    }

    /**
     *Getter for the Resource name
     *
     *@access public
     *
     *@return string the Resource name
     */
    public function getResourceName()
    {
        return $this->_resourceName;
    }

    /**
     *Getter for the Resource ContactName
     *
     *@access public
     *
     *@return string the Resource ContactName
     */
    public function getResourceContactName()
    {
        return $this->_contactName;
    }
    /**
     *Getter for the Resource ContactEmail
     *
     *@access public
     *
     *@return string the Resource nContactEmail
     */
    public function getResourceContactEmail()
    {
        return $this->_contactEmail;
    }
    /**
     *Getter for the Resource ContactPhone
     *
     *@access public
     *
     *@return string the Resource ContactPhone
     */
    public function getResourceContactPhone()
    {
        return $this->_contactPhone;
    }
    /**
     *Getter for the Resource Link
     *
     *@access public
     *
     *@return string the Resource Link
     */
    public function getResourceLink()
    {
        return $this->_link;
    }

    /**
     *Getter for the Resource description
     *
     *@access public
     *
     *@return string the Resource description
     */
    public function getResourceDescription()
    {
        return $this->_description;
    }

    /**
     *Getter for the Resource status
     *
     *@access public
     *
     *@return string the Resource status
     */
    public function getResourceActive()
    {
        return $this->_active;
    }


}
?>