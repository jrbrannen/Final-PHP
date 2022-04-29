<?php
// access to the base class
require_once(__DIR__ . '/Base.class.php');
class User extends Base{
    // class db table name
    var $tableName = "users";
    
    // class db primary key
    var $keyField = "user_id";
   
    // class db column names
    var $columnArray = array("user_name", "password", "user_level", "user_first_name", "user_last_name");
    
    // uses a session variable id to see if a user is logged in or not
    function checkLogin($userId) {
        $loggedIn = false;

        if (!empty($userId)) {
            $loggedIn = true;
        }
        return $loggedIn;
    }// end of checkLogin()

    // uses a session variable as a paramenter to check a users level
    function isAdminLevel($userLevel) {
        $isAdmin = false;

        if(!empty($userLevel) && $userLevel == "admin") {
            $isAdmin = true;
        }
        return $isAdmin;
    }// end of isAdminLevel()

    function sanitize($dataArray) {
        if (!empty($dataArray['user_name'])){
            $dataArray['user_name'] = filter_var($dataArray['user_name'], FILTER_SANITIZE_STRING);
        }
        if (!empty($dataArray['password'])) {
            $dataArray['password']= filter_var($dataArray['password'], FILTER_SANITIZE_STRING);
        } 
        if (!empty($dataArray['user_level'])) {
            $dataArray['user_level']= filter_var($dataArray['user_level'], FILTER_SANITIZE_STRING);
        } 
        if (!empty($dataArray['user_first_name'])) {
            $dataArray['user_first_name']= filter_var($dataArray['user_first_name'], FILTER_SANITIZE_STRING);
        } 
        if (!empty($dataArray['user_last_name'])) {
            $dataArray['user_last_name']= filter_var($dataArray['user_last_name'], FILTER_SANITIZE_STRING);
        } 
        return $dataArray;
    }// end of sanitize()

    function validate() {
        $isValid = true;

        if (empty($this->dataArray['user_name'])) {
            $this->errors['user_name'] = "User name is required";
            $isValid = false;
        }
        if (empty($this->dataArray['password'])) {
            $this->errors['password'] = "Password is required";
            $isValid = false;
        }
        if (empty($this->dataArray['user_level']) || $this->dataArray['user_level']  == "") {
            $this->errors['user_level'] = "User level is required";
            $isValid = false;
        }
        if (empty($this->dataArray['user_first_name'])) {
            $this->errors['user_first_name'] = "User's first name is required";
            $isValid = false;
        }
        if (empty($this->dataArray['user_last_name'])) {
            $this->errors['user_last_name'] = "User's last name is required";
            $isValid = false;
        }
        return $isValid;
    }// end of validate()

    function verifyUser($userName, $password) {
        // set verifiedUser to false, flag tracks to see if user data is loaded
        $verifiedUser = false;

        // get data from the database where user id and password match
        $stmt = $this->db->prepare("SELECT * FROM users WHERE user_name = ? and password = ?");

        // execute the statment using the userName and password as parameters
        $stmt->execute(array($userName, $password));

        // check to see if a user was sucessfully loaded
        if ($stmt->rowCount() == 1) {
            $dataArray = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->set($dataArray);
            $verifiedUser = true;
        }else{
            $this->errors['invalid'] = "User name or password is incorrect";
        }

        return $verifiedUser;
    }// end of verifyUser()
}

?>