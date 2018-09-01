<?php
/**
 * File used for communicating with
 * the college website's database.
 *
 * @author Lucas Harlor
 * @author Kevin Smith
 * @author Stacie Mashnitskaya
 * @author Edward Mendoza
 */
include "model/password.php";
class Database
{
    private $errors = array();
    
    /**
     * Display errors that may have occurred
     * while attempting to communicate with
     * the database
     *
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }
    
    /**
     * Create a connection with the database
     *
     * @return
     */
    private function getConnection()
    {
        $server_name = 'localhost';
        $db_name = ''; /** db_config.php has this data **/
        $db_usr = ''; /** db_config.php has this data **/
        $db_pass = ''; /** db_config.php has this data **/

        require "../../db_config.php";

        try
        {
            //var_dump(phpinfo());
            $connection = new PDO("mysql:host=$server_name;dbname=$db_name", $db_usr, $db_pass);
            // set the PDO error mode to exception
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return  $connection;
        }
        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    /**
     * Grab all the tables in the database
     *
     * @param $table
     * @return mixed
     */
    public function selectAll($table) {
        $pdo =  $this->getConnection();
        $select = 'SELECT * :table';
        //prep the query
        $statement = $pdo->prepare($select);
        //bind inputs
        $statement->bindValue(':table', $table, PDO::PARAM_STR);
        //execute query
        $statement->execute();
        // get the data back from the query
        $results = $statement->fetchAll();
        return $results;
    }
    
    /**
     * Grab only a certain number of events
     * that have not yet ended or are about
     * to end
     */
    public function getFiniteAmountEvents($numberOfEvents) {
        $pdo =  $this->getConnection();
        $select = 'SELECT * FROM events WHERE DateEnd >= CURDATE() AND
                   is_active = 1 ORDER BY DateStart, Priority LIMIT :amount';
        //prep the query
        $statement = $pdo->prepare($select);
        //bind inputs
        $statement->bindValue(':amount', $numberOfEvents, PDO::PARAM_INT);
        //execute query
        $statement->execute();
        // get the data back from the query
        $results = $statement->fetchAll();
        return $results;
    }

    /**
     * Obtain all events that have not yet
     * ended or are about to end
     */
    public function getAllCurrentEvents() {
        $pdo =  $this->getConnection();
        $select = 'SELECT * FROM events WHERE DateEnd >= CURDATE() AND
                   is_active = 1 ORDER BY DateStart;';
        $rows = $pdo->query($select);
        return $rows->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Add a new event to the table "events"
     */
    public function insertIntoEvents($EventName, $Category, $Description, $DateEnd, $DateStart, $Times,
                                     $Location, $PhotoFilePath,$Priority, $IsActive) {
        $pdo =  $this->getConnection();
        $select = 'INSERT INTO events (EventName, Category, Description, DateEnd, DateStart, Times, 
      Location, PhotoFilePath, priority, is_active) VALUES (:EventName, :Category, :Description, :DateEnd, :DateStart,
      :Times, :Location, :PhotoFilePath, :priority, :is_active)';
        $statement = $pdo->prepare($select);
        //bind inputs
        $statement->bindValue(':EventName', $EventName, PDO::PARAM_STR);
        $statement->bindValue(':Category', $Category, PDO::PARAM_STR);
        $statement->bindValue(':Description', $Description, PDO::PARAM_STR);
        $statement->bindValue(':DateEnd', $DateEnd, PDO::PARAM_STR);
        $statement->bindValue(':DateStart', $DateStart, PDO::PARAM_STR);
        $statement->bindValue(':Times', $Times, PDO::PARAM_STR);
        $statement->bindValue(':Location', $Location, PDO::PARAM_STR);
        $statement->bindValue(':PhotoFilePath', $PhotoFilePath, PDO::PARAM_STR);
        $statement->bindValue(':priority', $Priority, PDO::PARAM_STR);
        $statement->bindValue(':is_active', $IsActive, PDO::PARAM_STR);
        //execute query
        $results = $statement->execute();
        return $results;
    }

    /**
     * Edit an event that has a photo
     */
    public function updateEventsWPic($EventID, $EventName, $Category, $Description, $DateEnd, $DateStart, $Times,
$Location, $PhotoFilePath,$Priority, $active) {
        $pdo =  $this->getConnection();
        $update = 'UPDATE events SET EventName=:EventName,Category=:Category, Description=:Description, 
        DateEnd=:DateEnd, DateStart=:DateStart,Times=:Times, Location=:Location, PhotoFilePath=:PhotoFilePath,Priority=:Priority, is_active=:is_active 
        WHERE EventID=:EventID';

        $statement = $pdo->prepare($update);
        //bind inputs
        $statement->bindValue(':EventID', $EventID, PDO::PARAM_INT);
        $statement->bindValue(':EventName', $EventName, PDO::PARAM_STR);
        $statement->bindValue(':Category', $Category, PDO::PARAM_STR);
        $statement->bindValue(':Description', $Description, PDO::PARAM_STR);
        $statement->bindValue(':DateEnd', $DateEnd, PDO::PARAM_STR);
        $statement->bindValue(':DateStart', $DateStart, PDO::PARAM_STR);
        $statement->bindValue(':Times', $Times, PDO::PARAM_STR);
        $statement->bindValue(':Location', $Location, PDO::PARAM_STR);
        $statement->bindValue(':PhotoFilePath', $PhotoFilePath, PDO::PARAM_STR);
        $statement->bindValue(':Priority', $Priority, PDO::PARAM_STR);
        $statement->bindValue(':is_active', $active, PDO::PARAM_STR);


        //execute query
        $statement->execute();
    }

    /**
     * Edit an event that does not have
     * a photo
     */
    public function updateEventsNPic($EventID, $EventName, $Category, $Description, $DateEnd, $DateStart, $Times,
                                     $Location,$Priority, $Active) {
        $pdo =  $this->getConnection();
        $update = 'UPDATE events SET EventName=:EventName,Category=:Category, Description=:Description, 
        DateEnd=:DateEnd, DateStart=:DateStart,Times=:Times, Location=:Location, Priority=:Priority , is_active=:is_active 
        WHERE EventID=:EventID';

        $statement = $pdo->prepare($update);
        //bind inputs
        $statement->bindValue(':EventID', $EventID, PDO::PARAM_INT);
        $statement->bindValue(':EventName', $EventName, PDO::PARAM_STR);
        $statement->bindValue(':Category', $Category, PDO::PARAM_STR);
        $statement->bindValue(':Description', $Description, PDO::PARAM_STR);
        $statement->bindValue(':DateEnd', $DateEnd, PDO::PARAM_STR);
        $statement->bindValue(':DateStart', $DateStart, PDO::PARAM_STR);
        $statement->bindValue(':Times', $Times, PDO::PARAM_STR);
        $statement->bindValue(':Location', $Location, PDO::PARAM_STR);
        $statement->bindValue(':Priority', $Priority, PDO::PARAM_STR);
        $statement->bindValue(':is_active', $Active, PDO::PARAM_STR);
        $statement->execute();
    }
    
    /**
     * Make an event inactive so it does
     * not appear on the main page carousel
     */
    public function deleteEvent($EventID)
    {
        $pdo = $this->getConnection();
        
        $delete = "UPDATE events SET is_active=0 WHERE EventID=:EventID";
        
        $statement = $pdo->prepare($delete);

        $statement->bindParam(':EventID', $EventID, PDO::PARAM_INT);

        $statement->execute();
    }

    /**
     * Edit a partner's info
     */
    public function updatePartner($input_array, $id)
    {
        $set_string = '';
        $key_array = array_keys($input_array);
        for($i=0;$i<sizeof($input_array);$i++)
        {
            if($i == sizeof($input_array)-1 )
            {
                $set_string .= $key_array[$i] . '=:' . $key_array[$i];
            }
            else
            {
                $set_string .= $key_array[$i] . '=:' . $key_array[$i] . ', ';
            }
        }
        try
        {
            $connection = $this->getConnection();
            extract($input_array);
            $query = "UPDATE partners SET $set_string WHERE id = $id";
            $query = $connection->prepare($query);
            //bind parameters to the prepared statement
            foreach($input_array as $key => $value)
            {
                $query->bindValue(":" . $key, ${$key}, PDO::PARAM_STR);
            }
            $query->execute();
        }
        catch(PDOException $e)
        {
            array_push($this->errors, "PDOException: " . $e->getMessage());
            return false;
        }
        $connection = null;

        return true;
    }
    
    /**
     * Add new data to a table
     */
    public function insertIntoDatabase($table, $input_array)
    {
        $processed_input_array = array();

        foreach ($input_array as $key => $value)
        {
            if(isset($value))
            {
                $processed_input_array[$key] = $value;
            }
        }
        $columns_string = '';
        $values_string = '';
        $key_array = array_keys($processed_input_array);
        for($i=0;$i<sizeof($processed_input_array);$i++)
        {
            if(isset($processed_input_array[$key_array[$i]]))
            {
                if($i == sizeof($processed_input_array)-1 )
                {
                    $columns_string .= $key_array[$i];
                    $values_string .= ':' . $key_array[$i];
                }
                else
                {
                    $columns_string .= $key_array[$i] . ', ';
                    $values_string .= ':' . $key_array[$i] . ', ';
                }
            }
        }
        try
        {
            $connection = $this->getConnection();
            extract($processed_input_array);
            $query = "INSERT INTO $table ($columns_string) VALUES ($values_string);";
            $query = $connection->prepare($query);
            //bind parameters to the prepared statement
            foreach($processed_input_array as $key => $value)
            {
                $query->bindValue(":" . $key, ${$key}, PDO::PARAM_STR);
            }
            $query->execute();
        }
        catch(PDOException $e)
        {
            array_push($this->errors, "PDOException: " . $e->getMessage());
            return false;
        }
        return true;
        $connection = null;
    }
    
    /**
     * Obtain all programs the college offers
     */
    public function getAllPrograms() {
        $connection = $this->getConnection();
        $query = "SELECT * FROM programs";
        try
        {
            $stmt = $connection->prepare($query);
            $stmt->execute();
            if($stmt->setFetchMode(PDO::FETCH_ASSOC))
            {
                $results = $stmt->fetchAll();
            }
            else
            {
                array_push($this->errors, "setFetchMode: Failed");
            }
        }
        catch (PDOException $e)
        {
            array_push($this->errors, "SQL Error: " . $e->getMessage());
        }
        $connection = null;
        return $results;
    }
    
    /**
     * Obtain all frequently asked questions
     */
    public function getAllFAQ() {
        $connection = $this->getConnection();
        $query = "SELECT * FROM faq";
        try
        {
            $stmt = $connection->prepare($query);
            $stmt->execute();
            if($stmt->setFetchMode(PDO::FETCH_ASSOC))
            {
                $results = $stmt->fetchAll();
            }
            else
            {
                array_push($this->errors, "setFetchMode: Failed");
            }
        }
        catch (PDOException $e)
        {
            array_push($this->errors, "SQL Error: " . $e->getMessage());
        }
        $connection = null;
        return $results;
    }

    /**
     * Update the entirety of table "faq"
     */
    public function updateFAQTable($input_array, $id)
    {
        $set_string = '';
        $key_array = array_keys($input_array);
        for($i=0;$i<sizeof($input_array);$i++)
        {
            if($i == sizeof($input_array)-1)
            {
                $set_string .= $key_array[$i] . '=:' . $key_array[$i];
            }
            else
            {
                $set_string .= $key_array[$i] . '=:' . $key_array[$i] . ', ';
            }
        }
        try
        {
            $connection = $this->getConnection();
            extract($input_array);
            $query = "UPDATE faq SET $set_string WHERE id = $id";
            $query = $connection->prepare($query);
            //bind parameters to the prepared statement
            foreach($input_array as $key => $value)
            {
                $query->bindValue(":" . $key, ${$key}, PDO::PARAM_STR);
            }
            $query->execute();
        }
        catch(PDOException $e)
        {
            array_push($this->errors, "PDOException: " . $e->getMessage());
            return false;
        }
        $connection = null;
        return true;
    }

    /**
     * Obtain from a table the item with
     * the highest ID number
     */
    public function getNextId($table)
    {
        $connection = $this->getConnection();
        $query = "SELECT * FROM $table ORDER BY ID DESC LIMIT 1";
        try
        {
            $stmt = $connection->prepare($query);
            $stmt->execute();
            if($stmt->setFetchMode(PDO::FETCH_ASSOC))
            {
                $results = $stmt->fetchAll();
            }
            else
            {
                array_push($this->errors, "setFetchMode: Failed");
            }
        }
        catch (PDOException $e)
        {
            array_push($this->errors, "SQL Error: " . $e->getMessage());
        }
        $connection = null;

        $id = intval($results[0]['id']);
        $id = $id + 1;

        return $id;
    }

    /**
     * Obtain a single program
     */
    public function getProgramWhere($id)
    {
        $connection = $this->getConnection();
        $query = "SELECT * FROM programs WHERE id=$id";
        try
        {
            $stmt = $connection->prepare($query);
            $stmt->execute();
            if($stmt->setFetchMode(PDO::FETCH_ASSOC))
            {
                $results = $stmt->fetchAll();
            }
            else
            {
                array_push($this->errors, "setFetchMode: Failed");
            }
        }
        catch (PDOException $e)
        {
            array_push($this->errors, "SQL Error: " . $e->getMessage());
        }
        $connection = null;
        return $results;
    }

    /**
     * Edit a program's info
     */
    public function updateProgram($input_array, $id)
    {
        $set_string = '';
        $key_array = array_keys($input_array);
        for($i=0;$i<sizeof($input_array);$i++)
        {
            if($i == sizeof($input_array)-1 )
            {
                $set_string .= $key_array[$i] . '=:' . $key_array[$i];
            }
            else
            {
                $set_string .= $key_array[$i] . '=:' . $key_array[$i] . ', ';
            }
        }
        try
        {
            $connection = $this->getConnection();
            extract($input_array);
            $query = "UPDATE programs SET $set_string WHERE id = $id";
            $query = $connection->prepare($query);
            //bind parameters to the prepared statement
            foreach($input_array as $key => $value)
            {
                $query->bindValue(":" . $key, ${$key}, PDO::PARAM_STR);
            }
            $query->execute();
        }
        catch(PDOException $e)
        {
            array_push($this->errors, "PDOException: " . $e->getMessage());
            return false;
        }
        $connection = null;
        return true;
    }

    /**
     * Obtain all partners
     */
    public function getAllPartners() {
        $connection = $this->getConnection();
        $query = "SELECT * FROM partners";
        try
        {
            $stmt = $connection->prepare($query);
            $stmt->execute();
            if($stmt->setFetchMode(PDO::FETCH_ASSOC))
            {
                $results = $stmt->fetchAll();
            }
            else
            {
                array_push($this->errors, "setFetchMode: Failed");
            }
        }
        catch (PDOException $e)
        {
            array_push($this->errors, "SQL Error: " . $e->getMessage());
        }
        $connection = null;
        return $results;
    }

    /**
     * Obtain all staff members
     */
    public function getAllStaff() {
        $pdo = $this->getConnection();
        $select = "Select * from Bio order by LastName";
        try
        {
            $statement = $pdo->prepare($select);
            $statement->execute();

            if($statement->setFetchMode(PDO::FETCH_ASSOC))
            {
                $results = $statement->fetchAll();
            }
            else
            {
                array_push($this->errors, "setFetchMode: Failed");
            }
        }
        catch (PDOException $e)
        {
            array_push($this->errors, "SQL Error: " . $e->getMessage());
        }
        $connection = null;
        return $results;
    }

    /**
     * Obtain all current staff members
     */
    public function getAllActiveStaff() {
        $pdo = $this->getConnection();
        $select = "Select * from Bio where active = 1 order by LastName";
        try
        {
            $statement = $pdo->prepare($select);
            $statement->execute();

            if($statement->setFetchMode(PDO::FETCH_ASSOC))
            {
                $results = $statement->fetchAll();
            }
            else
            {
                array_push($this->errors, "setFetchMode: Failed");
            }
        }
        catch (PDOException $e)
        {
            array_push($this->errors, "SQL Error: " . $e->getMessage());
        }
        $connection = null;
        return $results;
    }

    /**
     * Ensure user-entered credentials exist
     * in the table "users"
     */
    function verifyUser($username, $password)
    {   $loginError = array();
        $pdo = $this->getConnection();

        //query for select row
        $select = "SELECT password from users WHERE username=:username &&  active = 1";
        $statement = $pdo->prepare($select);

        //bind inputs
        $statement->bindValue(':username', $username, PDO::PARAM_STR);

        //execute query
        $statement->execute();

        //retrieve a single row
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if($row == false)
        {
            $loginError[] = 'Incorrect username or password';
            return $loginError;
        } else {
            $hash = $row['password'];

            if(password_verify($password, $hash) == false)
            {
                $loginError[] = 'Incorrect username or password';
                return $loginError;
            } else {
                return true;
            }
        }
    }

    /**
     * Obtain a single partner
     */
    public function getPartnerWhere($id)
    {
        $connection = $this->getConnection();
        $query = "SELECT * FROM partners WHERE id=$id";
        try
        {
            $stmt = $connection->prepare($query);
            $stmt->execute();

            if($stmt->setFetchMode(PDO::FETCH_ASSOC))
            {
                $results = $stmt->fetchAll();
            }
            else
            {
                array_push($this->errors, "setFetchMode: Failed");
            }
        }
        catch (PDOException $e)
        {
            array_push($this->errors, "SQL Error: " . $e->getMessage());
        }

        $connection = null;

        return $results;
    }

    /**
     * Obtain a single staff member
     */
    public function getStaffById($id)
    {
        $connection = $this->getConnection();
        $query = "SELECT * FROM Bio WHERE BioId = $id";
        try
        {
            $stmt = $connection->prepare($query);
            $stmt->execute();

            if($stmt->setFetchMode(PDO::FETCH_ASSOC))
            {
                $results = $stmt->fetch();
            }
            else
            {
                array_push($this->errors, "setFetchMode: Failed");
            }
        }
        catch (PDOException $e)
        {
            array_push($this->errors, "SQL Error: " . $e->getMessage());
        }

        $connection = null;

        return $results;
    }

    /**
     * Make a staff member inactive so they
     * will not be displayed in the Staff page
     */
    public function deleteStaff($id)
    {
        $connection = $this->getConnection();
        $query = "Update Bio
        Set active = 0 where BioId = :id";

        $statement = $connection->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $connection = null;

        return true;
    }

    /**
     * Make a user inactive
     */
    public function deleteUser($id)
    {
        $connection = $this->getConnection();
        $query = "Update users
        Set active = 0 where adminId = :id";

        $statement = $connection->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $connection = null;

        return true;
    }

    /**
     * Obtain a single user with the given
     * username
     */
    public function getAdminByUsername($username)
    {
        $connection = $this->getConnection();
        $query = "Select * from users where username = :username";

        $statement = $connection->prepare($query);
        $statement->bindValue(':username', $username, PDO::PARAM_STR);
        $statement->execute();
        $results = $statement->fetch();
        $connection = null;

        return $results;
    }

    /**
     * Obtain a single user with the
     * given ID number
     */
    public function getAdminById($id)
    {
        $connection = $this->getConnection();
        $query = "Select * from users where adminId = :id";

        $statement = $connection->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_STR);
        $statement->execute();
        $results = $statement->fetch();
        return $results;
    }

    /**
     * Obtain all users
     */
    public function getAllAdmins() {
        $pdo = $this->getConnection();
        $select = "Select adminId, username, adminLevel, active from users order by adminLevel";
        try
        {
            $statement = $pdo->prepare($select);
            $statement->execute();

            if($statement->setFetchMode(PDO::FETCH_ASSOC))
            {
                $results = $statement->fetchAll();
            }
            else
            {
                array_push($this->errors, "setFetchMode: Failed");
            }
        }
        catch (PDOException $e)
        {
            array_push($this->errors, "SQL Error: " . $e->getMessage());
        }
        $connection = null;
        return $results;
    }
    
    /**
     * Obtain a user to change their
     * editing permissions
     */
    public function getAdminForEdit($adminId)
    {
        $connection = $this->getConnection();
        $query = "Select username, adminLevel, active from users where adminId = :adminId";

        $statement = $connection->prepare($query);
        $statement->bindValue(':adminId', $adminId, PDO::PARAM_STR);
        $statement->execute();
        $results = $statement->fetch();
        $connection = null;

        return $results;
    }
    
    /**
     * Make a user active/inactive
     */
    public function deReactivateAdminByUsername($adminId, $active)
    {
        $pdo = $this->getConnection();
        $select = 'UPDATE users SET active=:active WHERE adminId =:adminId';
        $statement = $pdo->prepare($select);
        //bind inputs
        $statement->bindValue(':active', $active, PDO::PARAM_STR);
        $statement->bindValue(':username', $adminId, PDO::PARAM_STR);

        //execute query
        $results = $statement->execute();
        $connection = null;
    }
    
    /**
     * Add a new user to the table "users"
     */
    public function insertIntoUsers($username, $password, $adminLevel, $active) {
        $pdo =  $this->getConnection();
        $select = 'INSERT INTO users (username, password, adminLevel,active) VALUES (:username, :password, :adminLevel, :active)';
        $statement = $pdo->prepare($select);
        //bind inputs
        $statement->bindValue(':username', $username, PDO::PARAM_STR);
        $statement->bindValue(':password', $password, PDO::PARAM_STR);
        $statement->bindValue(':adminLevel', $adminLevel, PDO::PARAM_STR);
        $statement->bindValue(':active', $active, PDO::PARAM_STR);
        //execute query
        $results = $statement->execute();
        $connection = null;
        return $results;
    }
    
    /**
     * Edit a user's information
     */
    public function updateUsers($adminId, $username, $password, $adminLevel, $active) {
        $pdo =  $this->getConnection();
        $select = 'UPDATE users SET ';
        $moreThanOne = false;
        if(!($username == "")) {
            $select .= ' username=:username ';
            $moreThanOne = true;
        }
        if(!($password == "")) {
            if($moreThanOne == true) {
                $select .= ', ' ;
            }
            $select .= ' password =:password ';
            $moreThanOne = true;
        }
        if(!($adminLevel == "")) {
            if($moreThanOne == true) {
                $select .= ', ' ;
            }
            $select .= 'adminLevel =:adminLevel';
        }
        if(!($active == "")) {
            if($moreThanOne == true) {
                $select .= ', ' ;
            }
            $select .= 'active =:active';
        }
        $select .= ' WHERE adminId =:adminId';
        $statement = $pdo->prepare($select);
        //bind inputs
        $statement->bindValue(':adminId', $adminId, PDO::PARAM_STR);
        if(!($username == "")) {
            $statement->bindValue(':username', $username, PDO::PARAM_STR);
        }
        if(!($password == "")) {
            $statement->bindValue(':password', $password, PDO::PARAM_STR);
        }

        if(!($adminLevel == "")) {
            $statement->bindValue(':adminLevel', $adminLevel, PDO::PARAM_STR);
        }
        if(!($active == "")) {
            $statement->bindValue(':active', $active, PDO::PARAM_STR);
        }
        //execute query
        $results = $statement->execute();
        return $results;
    }
    
    /**
     * Obtain all active events
     */
    public function getAllEvents() {
        $pdo = $this->getConnection();
        $select = "Select * from events WHERE is_active = 1";
        try
        {
            $statement = $pdo->prepare($select);
            $statement->execute();

            if($statement->setFetchMode(PDO::FETCH_ASSOC))
            {
                $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            }
            else
            {
                array_push($this->errors, "setFetchMode: Failed");
            }
        }
        catch (PDOException $e)
        {
            array_push($this->errors, "SQL Error: " . $e->getMessage());
        }
        $connection = null;
        return $results;
    }

    /**
     * Obtain a single event
     */
    public function getEventByID($id)
    {
        $connection = $this->getConnection();
        $select = "SELECT * FROM events WHERE EventID = :id";

        $statement = $connection->prepare($select);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $event = $statement->fetch();

        return $event;
    }

    /**
     * Add a new staff member to the database
     * table "Bio"
     */
    function addStaff($title, $lastName, $firstName, $credentials, $organization, $department,
                      $jobTitle, $description, $dateHired, $location, $email, $phoneNumber, $photoFilePath, $active)
    {
        $pdo = $this->getConnection();

        $update = 'Insert into Bio (Title, lastName, firstName, Credential, Organization, Department, JobTitle, Description,
        DateHired, Location, Email, PhoneNumber, PhotoFilePath, active) Values (:title, :lastName, :firstName, :credentials,
          :organization, :department, :jobTitle, :description, :dateHired, :location, :email, :phoneNumber,
           :photoFilePath, :active);';

        $statement = $pdo->prepare($update);
        $statement->bindValue(':title', $title, PDO::PARAM_STR);
        $statement->bindValue(':lastName', $lastName, PDO::PARAM_STR);
        $statement->bindValue(':firstName', $firstName, PDO::PARAM_STR);
        $statement->bindValue(':credentials', $credentials, PDO::PARAM_STR);
        $statement->bindValue(':organization', $organization, PDO::PARAM_STR);
        $statement->bindValue(':department', $department, PDO::PARAM_STR);
        $statement->bindValue(':jobTitle', $jobTitle, PDO::PARAM_STR);
        $statement->bindValue(':description', $description, PDO::PARAM_STR);
        $statement->bindValue(':dateHired', $dateHired, PDO::PARAM_STR);
        $statement->bindValue(':location', $location, PDO::PARAM_STR);
        $statement->bindValue(':email', $email, PDO::PARAM_STR);
        $statement->bindValue(':phoneNumber', $phoneNumber, PDO::PARAM_STR);
        $statement->bindValue(':photoFilePath', $photoFilePath, PDO::PARAM_STR);
        $statement->bindValue(':active', $active, PDO::PARAM_STR);

        $statement->execute();
    }

    /**
     * Edit a staff member's info
     */
    function updateStaff($id, $title, $lastName, $firstName, $credentials, $organization, $department,
                         $jobTitle, $description, $dateHired, $location, $email, $phoneNumber, $photoFilePath)
    {
        $pdo = $this->getConnection();

        $update = 'UPDATE Bio SET Title=:title, lastName=:lastName, firstName=:firstName, Credential=:credentials,
          Organization=:organization, Department=:department, JobTitle=:jobTitle, Description=:description,
          DateHired=:dateHired, Location=:location, Email=:email, PhoneNumber=:phoneNumber, PhotoFilePath=:photoFilePath
          WHERE BioID=:id';

        $statement = $pdo->prepare($update);
        $statement->bindValue(':id', $id, PDO::PARAM_STR);
        $statement->bindValue(':title', $title, PDO::PARAM_STR);
        $statement->bindValue(':lastName', $lastName, PDO::PARAM_STR);
        $statement->bindValue(':firstName', $firstName, PDO::PARAM_STR);
        $statement->bindValue(':credentials', $credentials, PDO::PARAM_STR);
        $statement->bindValue(':organization', $organization, PDO::PARAM_STR);
        $statement->bindValue(':department', $department, PDO::PARAM_STR);
        $statement->bindValue(':jobTitle', $jobTitle, PDO::PARAM_STR);
        $statement->bindValue(':description', $description, PDO::PARAM_STR);
        $statement->bindValue(':dateHired', $dateHired, PDO::PARAM_STR);
        $statement->bindValue(':location', $location, PDO::PARAM_STR);
        $statement->bindValue(':email', $email, PDO::PARAM_STR);
        $statement->bindValue(':phoneNumber', $phoneNumber, PDO::PARAM_STR);
        $statement->bindValue(':photoFilePath', $photoFilePath, PDO::PARAM_STR);

        $statement->execute();
    }

    /**
     * Add a new financial aid resource
     */
    public function insertIntoFinancialAid($resource_name, $resource_info,
                                           $resource_link, $is_active)
    {
        $pdo = $this->getConnection();
        $insert = "INSERT INTO financial_aid (resource_name, resource_info,
                   resource_link, is_active) VALUES (:resource_name,
                   :resource_info, :resource_link, :is_active)";

        $statement = $pdo->prepare($insert);

        $statement->bindParam(':resource_name', $resource_name, PDO::PARAM_STR);
        $statement->bindParam(':resource_info', $resource_info, PDO::PARAM_STR);
        $statement->bindParam(':resource_link', $resource_link, PDO::PARAM_STR);
        $statement->bindParam(':is_active', $is_active, PDO::PARAM_INT);

        $statement->execute();
    }

    /**
     * Edit a staff member that does not
     * have a photo
     */
    function updateStaffNoPic($id, $title, $lastName, $firstName, $credentials, $organization, $department,
                              $jobTitle, $description, $dateHired, $location, $email, $phoneNumber)
    {
        $pdo = $this->getConnection();

        $update = 'UPDATE Bio SET Title=:title, lastName=:lastName, firstName=:firstName, Credential=:credentials,
          Organization=:organization, Department=:department, JobTitle=:jobTitle, Description=:description,
          DateHired=:dateHired, Location=:location, Email=:email, PhoneNumber=:phoneNumber WHERE BioID=:id';

        $statement = $pdo->prepare($update);
        $statement->bindValue(':id', $id, PDO::PARAM_STR);
        $statement->bindValue(':title', $title, PDO::PARAM_STR);
        $statement->bindValue(':lastName', $lastName, PDO::PARAM_STR);
        $statement->bindValue(':firstName', $firstName, PDO::PARAM_STR);
        $statement->bindValue(':credentials', $credentials, PDO::PARAM_STR);
        $statement->bindValue(':organization', $organization, PDO::PARAM_STR);
        $statement->bindValue(':department', $department, PDO::PARAM_STR);
        $statement->bindValue(':jobTitle', $jobTitle, PDO::PARAM_STR);
        $statement->bindValue(':description', $description, PDO::PARAM_STR);
        $statement->bindValue(':dateHired', $dateHired, PDO::PARAM_STR);
        $statement->bindValue(':location', $location, PDO::PARAM_STR);
        $statement->bindValue(':email', $email, PDO::PARAM_STR);
        $statement->bindValue(':phoneNumber', $phoneNumber, PDO::PARAM_STR);

        $statement->execute();
    }

    /**
     * Obtain all active financial aid resources
     */
    public function getAllFinancialAid()
    {
        $pdo = $this->getConnection();
        $select = "SELECT * FROM financial_aid WHERE is_active = 1";

        $statement = $pdo->prepare($select);

        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * Obtain a single financial aid resource
     */
    public function getFinancialAidByID($id)
    {
        $connection = $this->getConnection();
        $select = "SELECT * FROM financial_aid WHERE resource_id = :id";

        $statement = $connection->prepare($select);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $resource = $statement->fetch();

        return $resource;
    }

    /**
     * Edit the info of a financial aid resource
     */
    function updateFinancialAid($id, $resource_name, $resource_info, $resource_link)
    {
        $pdo = $this->getConnection();

        $update = 'UPDATE financial_aid SET resource_name=:resource_name,
                   resource_info=:resource_info, resource_link=:resource_link
                   WHERE resource_id=:id';

        $statement = $pdo->prepare($update);
        $statement->bindValue(':id', $id, PDO::PARAM_STR);
        $statement->bindValue(':resource_name', $resource_name, PDO::PARAM_STR);
        $statement->bindValue(':resource_info', $resource_info, PDO::PARAM_STR);
        $statement->bindValue(':resource_link', $resource_link, PDO::PARAM_STR);

        $statement->execute();
    }

    /**
     * Make a financial aid resource inactive
     */
    function deleteFinancialAid($id)
    {
        $pdo = $this->getConnection();

        $delete = 'UPDATE financial_aid SET is_active = 0 WHERE resource_id=:id';

        $statement = $pdo->prepare($delete);

        $statement->bindValue(':id', $id, PDO::PARAM_STR);

        $statement->execute();
    }

    /**
     * Add a college applicant to the
     * table "applied_persons"
     */
    public function addApplicant($fname, $lname, $email, $birthdate)
    {
        $connection = $this->getConnection();

        $insert = "INSERT INTO applied_persons (first_name,
                   last_name, email, birthdate) VALUES
                   (:first_name, :last_name, :email, :birthdate)";

        $statement = $connection->prepare($insert);

        $statement->bindParam(':first_name', $fname, PDO::PARAM_STR);
        $statement->bindParam(':last_name', $lname, PDO::PARAM_STR);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':birthdate', $birthdate, PDO::PARAM_STR);

        $statement->execute();
    }

    /**
     * Obtain all applicants
     */
    public function getAllApplicants()
    {
        $connection = $this->getConnection();

        $select = "SELECT * FROM applied_persons";

        $statement = $connection->prepare($select);

        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * Obtain all alerts
     */
    public function getAllAlerts()
    {
        $pdo = $this->getConnection();
        $select = "SELECT * FROM alerts";

        $statement = $pdo->prepare($select);

        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * Obtain a single alert
     */
    public function getAlertByID($id)
    {
        $connection = $this->getConnection();
        $select = "SELECT * FROM alerts WHERE alertId = :id";

        $statement = $connection->prepare($select);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $result = $statement->fetch();

        return $result;
    }

    /**
     * Obtain all active alerts
     */
    public function getAllActiveAlerts() {
        $pdo =  $this->getConnection();
        $select = 'SELECT * FROM alerts WHERE active = 1;';
        $statement = $pdo->prepare($select);
        $statement->execute();

        return $result = $statement->fetch();
    }

    /**
     * Make all active alerts inactive
     */
    public function disableActiveAlerts()
    {
        $pdo = $this->getConnection();
        $update = "Update alerts set active = 0";

        $statement = $pdo->prepare($update);

        $statement->execute();
    }

    /**
     * Get the ID numbers of all active alerts
     */
    public function getIdOfActive()
    {
        $pdo = $this->getConnection();

        $statement = $pdo->query('SELECT alertId FROM alerts where active = 1')->fetchColumn();

        return $statement;
    }

    /**
     * Edit an alert's info
     */
    public function updateAlert($id, $alertName, $alertMessage)
    {
        $pdo = $this->getConnection();

        $update = 'UPDATE alerts SET alertName=:alertName, alertMessage=:alertMessage, active=1
          WHERE alertId=:id';

        $statement = $pdo->prepare($update);
        $statement->bindValue(':id', $id, PDO::PARAM_STR);
        $statement->bindValue(':alertName', $alertName, PDO::PARAM_STR);
        $statement->bindValue(':alertMessage', $alertMessage, PDO::PARAM_STR);

        $statement->execute();
    }

    /**
     * Make an alert inactive
     */
    public function deleteAlert($id)
    {
        $connection = $this->getConnection();
        $query = "Update alerts
        Set active = 0 where alertId = :id";

        $statement = $connection->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $connection = null;

        return true;
    }

    /**
     * Add a new alert to the table "alerts"
     */
    public function addAlert($alertName, $alertMessage, $active)
    {
        $pdo = $this->getConnection();

        $insert = 'Insert into alerts (alertName, alertMessage, active) Values (:alertName, :alertMessage, :active);';

        $statement = $pdo->prepare($insert);
        $statement->bindValue(':alertName', $alertName, PDO::PARAM_STR);
        $statement->bindValue(':alertMessage', $alertMessage, PDO::PARAM_STR);
        $statement->bindValue(':active', $active, PDO::PARAM_STR);

        $statement->execute();
    }

    /**
     * Obtain all student work from the
     * database table "student_work"
     */
    public function getAllStudentWork() {
        $pdo = $this->getConnection();
        $select = 'SELECT * FROM student_work;';
        $rows = $pdo->query($select);
        return $rows->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtain all active student works
     */
    public function getAllActiveStudentWork() {
        $pdo = $this->getConnection();
        $select = 'SELECT * FROM student_work where active = 1;';
        $rows = $pdo->query($select);
        return $rows->fetchAll();
    }

    /**
     * Obtain a single student work
     */
    public function getProjectById($id)
    {
        $connection = $this->getConnection();
        $select = "SELECT * FROM student_work WHERE projectId = :id";

        $statement = $connection->prepare($select);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $result = $statement->fetch();

        return $result;
    }

    /**
     * Obtain a student work that has a file
     * uploaded
     */
    public function updateStudentWorkWFile($id, $studentName, $projectName, $projectDescription, $projectFilePath)
    {
        $pdo = $this->getConnection();
        $update = 'UPDATE student_work SET projectId=:id, studentName=:studentName, projectName=:projectName,
        projectDescription=:projectDescription, projectFilePath=:projectFilePath WHERE projectId=:id';
        $statement = $pdo->prepare($update);
        $statement->bindValue(':id', $id, PDO::PARAM_STR);
        $statement->bindValue(':studentName', $studentName, PDO::PARAM_STR);
        $statement->bindValue(':projectName', $projectName, PDO::PARAM_STR);
        $statement->bindValue(':projectDescription', $projectDescription, PDO::PARAM_STR);
        $statement->bindValue(':projectFilePath', $projectFilePath, PDO::PARAM_STR);
        $statement->execute();
    }
    
    /**
     * Obtain a student work that does not
     * have a file uploaded
     */
    public function updateStudentWorkNFile($id, $studentName, $projectName, $projectDescription)
    {
        $pdo = $this->getConnection();
        $update = 'UPDATE student_work SET projectId=:id, studentName=:studentName, projectName=:projectName,
        projectDescription=:projectDescription WHERE projectId=:id';
        $statement = $pdo->prepare($update);
        $statement->bindValue(':id', $id, PDO::PARAM_STR);
        $statement->bindValue(':studentName', $studentName, PDO::PARAM_STR);
        $statement->bindValue(':projectName', $projectName, PDO::PARAM_STR);
        $statement->bindValue(':projectDescription', $projectDescription, PDO::PARAM_STR);
        $statement->execute();
    }
    
    /**
     * Add a new student work
     */
    public function addStudentWork($studentName, $projectName, $projectDescription, $projectFilePath)
    {
        $pdo = $this->getConnection();
        $insert = 'Insert into student_work (studentName, projectName, projectDescription, projectFilePath, active) 
Values (:studentName, :projectName, :projectDescription, :projectFilePath, 1);';
        $statement = $pdo->prepare($insert);
        $statement->bindValue(':studentName', $studentName, PDO::PARAM_STR);
        $statement->bindValue(':projectName', $projectName, PDO::PARAM_STR);
        $statement->bindValue(':projectDescription', $projectDescription, PDO::PARAM_STR);
        $statement->bindValue(':projectFilePath', $projectFilePath, PDO::PARAM_STR);
        $statement->execute();
    }

    /**
     * Obtain the number of student works in
     * the database
     */
    public function getNumberOfFiles()
    {
        $pdo = $this->getConnection();

        $statement = $pdo->query('SELECT count(projectId) from student_work')->fetchColumn();

        return $statement;
    }

    /**
     * Make a student work inactive
     */
    public function deleteStudentWork($id) {
        $connection = $this->getConnection();
        $query = "Update student_work Set active = 0 where projectId = :id";

        $statement = $connection->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $connection = null;

        return true;
    }

    /**
     * Obtain three active resources
     */
    public function getAllActiveResources() {
        $pdo = $this->getConnection();
        $select = 'SELECT * FROM resources where Active = 1 limit 3;';
        $rows = $pdo->query($select);
        return $rows->fetchAll();
    }

    /**
     * Obtain all resources
     */
    public function getAllResources() {
        $pdo = $this->getConnection();
        $select = 'SELECT * FROM resources;';
        $rows = $pdo->query($select);
        return $rows->fetchAll();
    }

    /**
     * Obtain a single resource
     */
    public function getResourceById($id)
    {
        $connection = $this->getConnection();
        $select = "SELECT * FROM resources WHERE ResourceID = :id";

        $statement = $connection->prepare($select);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $result = $statement->fetch();

        return $result;
    }

    /**
     * Make a resource inactive
     */
    public function deleteResource($id)
    {
        $connection = $this->getConnection();
        $query = "Update resources Set active = 0 where ResourceID = :id";

        $statement = $connection->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $connection = null;

        return true;
    }

    /**
     * Make a program inactive
     */
    public function deleteProgram($id)
    {
        $connection = $this->getConnection();
        $query = "Update programs Set active = 0 where id = :id";

        $statement = $connection->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $connection = null;

        return true;
    }

    /**
     * Make a partner inactive
     */
    public function deletePartner($id)
    {
        $connection = $this->getConnection();
        $query = "Update partners Set active = 0 where id = :id";

        $statement = $connection->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $connection = null;

        return true;
    }

    /**
     * Edit a resource's info
     */
    public function updateResources($ResourceID, $ResourceName, $ResourceDescription,
                                    $ContactName, $ContactPhone, $ContactEmail,$Link, $Active)
    {
        //var_dump($Link);
        $pdo =  $this->getConnection();

        $select = 'UPDATE resources SET ResourceName=:ResourceName, Description=:Description, ContactName =:ContactName, 
          ContactPhone=:ContactPhone, ContactEmail=:ContactEmail, Link=:Link,Active=:Active WHERE ResourceID=:ResourceID';

        $statement = $pdo->prepare($select);
        //bind inputs
        $statement->bindValue(':ResourceID', $ResourceID, PDO::PARAM_STR);

            $statement->bindValue(':ResourceName', $ResourceName, PDO::PARAM_STR);


            $statement->bindValue(':Description', $ResourceDescription, PDO::PARAM_STR);



            $statement->bindValue(':ContactName', $ContactName, PDO::PARAM_STR);


            $statement->bindValue(':ContactEmail', $ContactEmail, PDO::PARAM_STR);


            $statement->bindValue(':ContactPhone', $ContactPhone, PDO::PARAM_STR);


            $statement->bindValue(':Link', $Link, PDO::PARAM_STR);


            $statement->bindValue(':Active', $Active, PDO::PARAM_STR);

        $results = $statement->execute();
        $connection = null;
        return $results;

    }

    /**
     * Add a new resource
     */
    public function addResources($ResourceName, $ResourceDescription,
                                 $ContactName, $ContactPhone, $ContactEmail,$link, $Active)
    {
        $pdo = $this->getConnection();

        $add = 'insert into resources (ResourceName, Description, ContactName,  ContactPhone, ContactEmail, Link ,Active) 
          VALUES (:ResourceName, :Description, :ContactName, :ContactPhone, :ContactEmail, :Link, :Active)';

        $statement = $pdo->prepare($add);
        $statement->bindValue(':ResourceName', $ResourceName, PDO::PARAM_STR);
        $statement->bindValue(':Description', $ResourceDescription, PDO::PARAM_STR);
        $statement->bindValue(':ContactName', $ContactName, PDO::PARAM_STR);
        $statement->bindValue(':ContactPhone', $ContactPhone, PDO::PARAM_STR);
        $statement->bindValue(':ContactEmail', $ContactEmail, PDO::PARAM_STR);
        $statement->bindValue(':Link', $link, PDO::PARAM_STR);
        $statement->bindValue(':Active', $Active, PDO::PARAM_STR);

        $statement->execute();
    }
    
    /**
     * Obtain all active resources
     */
    public function getAllActiveResourcesNoLimit() {
        $pdo = $this->getConnection();
        $select = 'SELECT * FROM resources where Active = 1;';
        $rows = $pdo->query($select);
        return $rows->fetchAll();
    }

    /**
     * Obtain all active users
     */
    public function getAllActiveAdmins() {
        $pdo = $this->getConnection();
        $select = 'SELECT * FROM users where active = 1';
        $rows = $pdo->query($select);
        return $rows->fetchAll();
    }

    /**
     * Obtain all active events
     */
    public function getAllActiveEvents() {
        $pdo = $this->getConnection();
        $select = 'SELECT * FROM events where is_active = 1';
        $rows = $pdo->query($select);
        return $rows->fetchAll();
    }

    /**
     * Obtain all active financial aid resources
     */
    public function getAllActiveFinancialAid() {
        $pdo = $this->getConnection();
        $select = 'SELECT * FROM financial_aid where is_active = 1';
        $rows = $pdo->query($select);
        return $rows->fetchAll();
    }

    /**
     * Obtain all active programs
     */
    public function getAllActivePrograms() {
        $pdo = $this->getConnection();
        $select = 'SELECT * FROM programs where active = 1';
        $rows = $pdo->query($select);
        return $rows->fetchAll();
    }

    /**
     * Obtain all active partners
     */
    public function getAllActivePartners() {
        $pdo = $this->getConnection();
        $select = 'SELECT * FROM partners where active = 1';
        $rows = $pdo->query($select);
        return $rows->fetchAll();
    }

    /**
     * Obtain five inactive staff members
     */
    public function getAllInactiveStaff() {
        $pdo = $this->getConnection();
        $select = 'SELECT * FROM Bio where active = 0 order by BioID desc limit 5';
        $rows = $pdo->query($select);
        return $rows->fetchAll();
    }

    /**
     * Obtain five inactive users
     */
    public function getAllInactiveAdmins() {
        $pdo = $this->getConnection();
        $select = 'SELECT * FROM users where active = 0 order by adminId desc limit 5';
        $rows = $pdo->query($select);
        return $rows->fetchAll();
    }

    /**
     * Obtain five inactive events
     */
    public function getAllInactiveEvents() {
        $pdo = $this->getConnection();
        $select = 'SELECT * FROM events where is_active = 0 order by EventID desc limit 5';
        $rows = $pdo->query($select);
        return $rows->fetchAll();
    }

    /**
     * Obtain five inactive financial aid
     * resources
     */
    public function getAllInactiveFinancialAid() {
        $pdo = $this->getConnection();
        $select = 'SELECT * FROM financial_aid where is_active = 0 order by resource_id desc limit 5';
        $rows = $pdo->query($select);
        return $rows->fetchAll();
    }

    /**
     * Obtain five inactive student works
     */
    public function getAllInactiveStudentWork() {
        $pdo = $this->getConnection();
        $select = 'SELECT * FROM student_work where active = 0 order by projectId desc limit 5';
        $rows = $pdo->query($select);
        return $rows->fetchAll();
    }

    /**
     * Obtain five inactive resources
     */
    public function getAllInactiveResources() {
        $pdo = $this->getConnection();
        $select = 'SELECT * FROM resources where Active = 0 order by ResourceID desc limit 5';
        $rows = $pdo->query($select);
        return $rows->fetchAll();
    }

    /**
     * Obtain five inactive alerts
     */
    public function getAllInactiveAlerts() {
        $pdo = $this->getConnection();
        $select = 'SELECT * FROM alerts where active = 0 order by alertId desc limit 5';
        $rows = $pdo->query($select);
        return $rows->fetchAll();
    }

    /**
     * Obtain five inactive programs
     */
    public function getAllInactivePrograms() {
        $pdo = $this->getConnection();
        $select = 'SELECT * FROM programs where active = 0 order by id desc limit 5';
        $rows = $pdo->query($select);
        return $rows->fetchAll();
    }

    /**
     * Obtain five inactive partners
     */
    public function getAllInactivePartners() {
        $pdo = $this->getConnection();
        $select = 'SELECT * FROM partners where active = 0 order by id desc limit 5';
        $rows = $pdo->query($select);
        return $rows->fetchAll();
    }

    /**
     * Make an alert active again
     */
    public function reactivateAlert($id) {
        $pdo = $this->getConnection();
        $query = 'Update alerts set active =1 where alertId=:id';
        $statement = $pdo->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $connection = null;

        return true;
    }

    /**
     * Make an event active again
     */
    public function reactivateEvent($id) {
        $pdo = $this->getConnection();
        $query = 'Update events set is_active =1 where EventID=:id';
        $statement = $pdo->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $connection = null;

        return true;
    }

    /**
     * Make a financial aid resource active
     * again
     */
    public function reactivateFinancialAid($id) {
        $pdo = $this->getConnection();
        $query = 'Update financial_aid set is_active =1 where resource_id=:id';
        $statement = $pdo->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $connection = null;

        return true;
    }

    /**
     * Make a resource active again
     */
    public function reactivateResource($id) {
        $pdo = $this->getConnection();
        $query = 'Update resources set Active =1 where ResourceID=:id';
        $statement = $pdo->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $connection = null;

        return true;
    }

    /**
     * Make a staff member active again
     */
    public function reactivateStaff($id) {
        $pdo = $this->getConnection();
        $query = 'Update Bio set active =1 where BioID=:id';
        $statement = $pdo->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $connection = null;

        return true;
    }

    /**
     * Make a student work active again
     */
    public function reactivateStudentWork($id) {
        $pdo = $this->getConnection();
        $query = 'Update student_work set active =1 where projectId=:id';
        $statement = $pdo->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $connection = null;

        return true;
    }

    /**
     * Make a user active again
     */
    public function reactivateUser($id) {
        $pdo = $this->getConnection();
        $query = 'Update users set active =1 where adminId=:id';
        $statement = $pdo->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $connection = null;

        return true;
    }

    /**
     * Make a program active again
     */
    public function reactivateProgram($id) {
        $pdo = $this->getConnection();
        $query = 'Update programs set active =1 where id=:id';
        $statement = $pdo->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $connection = null;

        return true;
    }

    /**
     * Make a partner active again
     */
    public function reactivatePartner($id) {
        $pdo = $this->getConnection();
        $query = 'Update partners set active =1 where id=:id';
        $statement = $pdo->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $connection = null;

        return true;
    }
}