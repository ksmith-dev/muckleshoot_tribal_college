<?php
/**
 * Alert class that allows the creation of Alert objects
 *
 * PHP Version 5
 *
 * @author Lucas Harlor <lharlor@mail.greenriver.edu>
 * @version 1.0
 */
class Alert
{
    //fields
    private $_alertId;
    private $_alertName;
    private $_alertMessage;
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
    public function __construct($alertId, $alertName, $alertMessage, $active)
    {
        $this->_alertId = $alertId;
        $this->_alertName = $alertName;
        $this->_alertMessage = $alertMessage;
        $this->_active = $active;

    }

    //methods

    /**
     *Getter for the alert id
     *
     *@access public
     *
     *@return int the alert id
     */
    public function getAlertId()
    {
        return $this->_alertId;
    }

    /**
     *Getter for the alert name
     *
     *@access public
     *
     *@return string the alert name
     */
    public function getAlertName()
    {
        return $this->_alertName;
    }

    /**
     *Getter for the alert message
     *
     *@access public
     *
     *@return int the alert message
     */
    public function getAlertMessage()
    {
        return $this->_alertMessage;
    }

    /**
     *Getter for the alert active state
     *
     *@access public
     *
     *@return boolean if the alert is active
     */
    public function getActive()
    {
        return $this->_active;
    }
}
?>