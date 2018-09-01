<?php
/**
* Events class that allows the creation of event objects
*
* PHP Version 5
*
* @author Lucas Harlor <lharlor@mail.greenriver.edu>
* @version 1.0
*/
    class Events
    {
        //fields
        private $_eventID;
        private $_eventName;
        private $_category;
        private $_description;
        private $_dateEnd;
        private $_dateStart;
        private $_times;
        private $_location;
        private $_photoFilePath;
        private $_priority;
        private $_activeState;

        //constructor
        /**
         * Creates a new user object
         *
         *@access public
         *@param int $eventID the id of the event
         *@param string $eventName the name of the event
         *@param string $category the category of the event
         *@param string $desciption the event description
         *@param date $dateEnd the end date of the event
         *@param date $dateStart the start date of the event
         *@param string $times the times that the event runs
         *@param string $location the location of the event
         *@param string $photoFilePath the photo location for the event
         *@param int $priority for sorting the events
         *@param int $activeState the active state of the event
         *
         */

        public function __construct($eventID, $eventName, $category, $description, $dateEnd, $dateStart,
                                    $times, $location, $photoFilePath, $priority, $activeState)
        {
            $this->_eventID = $eventID;
            $this->_eventName = $eventName;
            $this->_category = $category;
            $this->_description = $description;
            $this->_dateEnd = $dateEnd;
            $this->_dateStart = $dateStart;
            $this->_times = $times;
            $this->_location = $location;
            $this->_photoFilePath = $photoFilePath;
            $this->_priority = $priority;
            $this->_activeState = $activeState;
        }
    
        //methods
        
        /**
         * Assign a name to an event
         *
         * @param String $eventName
         */
        public function setEventName($eventName)
        {
            $this->_eventName = $eventName;
        }
        
        /**
         * Assign a description to an event
         *
         * @param String $description
         */
        public function setDescription($description)
        {
            $this->_description = $description;
        }
        
        /**
         * Assign to an event the date it begins
         *
         * @param String $dateStart
         */
        public function setEventStartDate($dateStart)
        {
            $this->_dateStart = $dateStart;
        }
        
        /**
         * Assign to an event the date it ends
         *
         * @param String $dateEnd
         */
        public function setEventEndDate($dateEnd)
        {
            $this->_dateEnd = $dateEnd;
        }
        
        /**
         *Getter for the event id
         *
         *@access public
         *
         *@return int the event id
         */
        public function getId()
        {
            return $this->_eventID;
        }
        
        /**
         *Getter for the event name
         *
         *@access public
         *
         *@return string the event name
         */
        public function getEventName()
        {
            return $this->_eventName;
        }
        
        /**
         *Getter for the event category
         *
         *@access public
         *
         *@return string the event category
         */
        public function getEventCategory()
        {
            return $this->_category;
        }
        
        /**
         *Getter for the event description
         *
         *@access public
         *
         *@return string the event description
         */
        public function getEventDescription()
        {
            return $this->_description;
        }
        
        /**
         *Getter for the event end date
         *
         *@access public
         *
         *@return string the event end date
         */
        public function getEventEndDate()
        {
            return $this->_dateEnd;
        }
        
        /**
         *Getter for the event start date
         *
         *@access public
         *
         *@return string the event start date
         */
        public function getEventStartDate()
        {
            return $this->_dateStart;
        }
        
        /**
         *Getter for the event times
         *
         *@access public
         *
         *@return string the event times
         */
        public function getEventTimes()
        {
            return $this->_times;
        }
        
        /**
         *Getter for the event location
         *
         *@access public
         *
         *@return string the event location
         */
        public function getEventLocation()
        {
            return $this->_location;
        }
        
        /**
         *Getter for the event photo
         *
         *@access public
         *
         *@return string the event photo path
         */
        public function getEventPhoto()
        {
            return $this->_photoFilePath;
        }
        /**
         * Getter for an event's priority
         *
         * @access public
         *
         * @return
         */
        public function getPriority()
        {
            return $this->_priority;
        }
        /**
         * Getter for an event's active state
         *
         * @access public
         *
         * @return 
         */
        public function getActiveState()
        {
            return $this->_activeState;
        }
    }
?>