<?php
/**
 * Class that allows creation of financial aid
 * objects.
 *
 * @author Edward Mendoza <edcmendoza94@gmail.com>
 * @version 1.0
 */

class FinancialAid
{
    //Class fields
    private $_resourceID;
    private $_resourceName;
    private $_resourceInfo;
    private $_resourceLink;
    private $_activeState;
    
    //Class constructor
    public function __construct($resourceID, $resourceName,
                                $resourceInfo, $resourceLink,
                                $activeState)
    {
        $this->_resourceID = $resourceID;
        $this->_resourceName = $resourceName;
        $this->_resourceInfo = $resourceInfo;
        $this->_resourceLink = $resourceLink;
        $this->_activeState = $activeState;
        
    }
    
    //Setters and getters
    /**
     * Assign a name to a financial aid resource
     *
     * @param String $resourceName
     */
    public function setResourceName($resourceName)
    {
        $this->_resourceName = $resourceName;
    }
    
    
    /**
     * Assign a description to a financial aid
     * resource
     *
     * @param String $resourceInfo
     */
    public function setResourceInfo($resourceInfo)
    {
        $this->_resourceInfo = $resourceInfo;
    }
    
    /**
     * Assign a link to a financial aid resource
     *
     * @param String $resourceLink
     */
    public function setResourceLink($resourceLink)
    {
        $this->_resourceLink = $resourceLink;
    }
    
    /**
     * Obtain the ID of a resource
     *
     * @return int - a resource's ID
     */
    public function getResourceID()
    {
        return $this->_resourceID;
    }
    
    /**
     * Obtain the name of a resource
     *
     * @return string - a resource's name
     */
    public function getResourceName()
    {
        return $this->_resourceName;
    }
    
    /**
     * Obtain the description for a
     * resource
     *
     * @return string - a resource's
     * description
     */
    public function getResourceInfo()
    {
        return $this->_resourceInfo;
    }
    
    /**
     * Obtain the URL for a resource
     *
     * @return string - a URL that
     * points to the resource's website
     */
    public function getResourceLink()
    {
        return $this->_resourceLink;
    }
    
    /**
     * Obtain a resource's active state
     *
     * @param int $activeState - 1 if
     * a resource is active, 0 otherwise
     */
    public function getActiveState()
    {
        var_dump($this->_activeState);
        
        return $this->_activeState;
    }
}
?>