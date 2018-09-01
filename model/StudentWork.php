<?php
/**
 * Student Work class that allows the creation of student work objects
 *
 * PHP Version 5
 *
 * @author Lucas Harlor <lharlor@mail.greenriver.edu>
 * @version 1.0
 */
class StudentWork
{
    //fields
    private $_projectId;
    private $_studentName;
    private $_projectName;
    private $_projectDescription;
    private $_projectFilePath;

    //constructor
    /**
     * Creates a new user object
     *
     *@access public
     *@param string $projectId the id of a project
     *@param string $studentName the name of the student that worked on the project
     *@param string $projectName the name of the project
     *@param string $projectDescription the description of the project
     *@param string $projectFilePath the project file
     *
     */
    public function __construct($projectId, $studentName, $projectName, $projectDescription, $projectFilePath)
    {
        $this->_projectId = $projectId;
        $this->_studentName = $studentName;
        $this->_projectName = $projectName;
        $this->_projectDescription = $projectDescription;
        $this->_projectFilePath = $projectFilePath;
    }

    //methods

    /**
     *Getter for the project id
     *
     *@access public
     *
     *@return int the project id
     */
    public function getProjectId()
    {
        return $this->_projectId;
    }

    /**
     *Getter for the students name
     *
     *@access public
     *
     *@return string the student's name
     */
    public function getStudentName()
    {
        return $this->_studentName;
    }

    /**
     *Getter for the project name
     *
     *@access public
     *
     *@return string the project name
     */
    public function getProjectName()
    {
        return $this->_projectName;
    }

    /**
     *Getter for the project description
     *
     *@access public
     *
     *@return string the project description
     */
    public function getProjectDescription()
    {
        return $this->_projectDescription;
    }

    /**
     *Getter for the project file path
     *
     *@access public
     *
     *@return string the project file path
     */
    public function getProjectFilePath()
    {
        return $this->_projectFilePath;
    }
}
?>