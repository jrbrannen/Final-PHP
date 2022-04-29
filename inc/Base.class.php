<?php
// class for a table
class Base {
    // assign generic variable to database name
    var $tableName = "";
    
    // assign generic variable to table primary key
    var $keyField = ""; 

    // assign generic variable to filename for SaveImage()
    var $imageFilename = "";

    // data stored in array for new cms
    var $dataArray = array();

    // list of errors stored in array
    var $errors = array();

    // default array for class columns
    var $columnArray = array();

    // database connection
    var $db = null;

    function __construct(){  // magic function make db connection
        $this->db = new PDO('mysql:host=localhost;dbname=wdv441;charset=utf8', 
            'user', 'wdv441');// change this db connection
    }// end of construct()
    
    // store the data array to the class property (dataArray)
    function set($dataArray){
        $this->dataArray = $dataArray;
        if (isset($dataArray['password'])){
            $this->dataArray['password'] = $this->passTheSalt($this->dataArray['password']);
        }
    }// end of set()

    // fuction stub ~ class specific
    function sanitize($dataArray){
        return $dataArray;
    }// end of sanitize()

    // hashes password when saved the to database
    function passTheSalt($password) {
        // password salt
        define("PASSWORD_SALT", "C0dingP#P!sS0S@MuchF()N");
        // hash password and store in variable
        $password = hash("sha256", $password . PASSWORD_SALT);
        return $password;
    }

    function load($id){
        // tracking flag to see if the data was loaded 
        $isLoaded = false;

        // load from the database with a prepared statement
        $stmt = $this->db->prepare("SELECT * FROM " . $this->tableName . " WHERE " . $this->keyField . " = ?");
        
        // execute the statement using the id as parameter for the cms we want to load
        $stmt->execute(array($id));
        
        // check to see if the article was sucessfully loaded
        if ($stmt->rowCount() == 1){
            // if cms is loaded fetch the data as an assoc array
            $dataArray = $stmt->fetch(PDO::FETCH_ASSOC);
            // set the data to internal class property
            $this->set($dataArray);
            // set the flag to be true
            $isLoaded = true;
        }

        // return load success or failure
        return $isLoaded;
    }// end of load()

    // this function dynamically counts the number of columns stored in the 
    //$dataArray variable and creates a string of "?"s for a sql query 
    function sqlValueCountString(){
        $valueString = "";
        $valueCount = count($this->dataArray);
            for ($i = 1; $i <= $valueCount; $i++) {
                if ($i < $valueCount){
                    $valueString .= "?, ";
                }
                elseif ($i = $valueCount){
                    $valueString .= "?";
                }   
            }
        return $valueString;
    }// end of sqlValueCountString()

    // saves a class from inserts and updates ~ built dynamically so any class
    // that inherits Base class can be saved to it's database table ($this->tableName)
    function save() {
        // flag to see if save is successful 
        $isSaved = false;
        
        // determine if save is an insert or an update based of on the article id
        // true condition save data from the (dataArray) property to the database
        if (empty($this->dataArray[$this->keyField])){
            // pop the dataArray twice to remove unwanted fields (" ", and "Save")
            array_pop($this->dataArray);
            array_pop($this->dataArray);
             
            // dynamically prepare a sql statement to insert the data into the table
            $stmt = $this->db->prepare(
                "INSERT INTO " . $this->tableName . 
                "(" . 
                implode(", ",$this->columnArray) .
                ")" .
                " VALUES (" . 
                $this->sqlValueCountString() . 
                ")"
            );

            // execute the insert statement, passing the data into the insert
            $isSaved = $stmt->execute(array_values($this->dataArray));

            // if the execute returns true, then store the new id back into the data property
            // this gets the newly assigned id number and stores it into the (dataArray) property
            if ($isSaved){
                $this->dataArray[$this->tableName] = $this->db->lastInsertId();
            }
        }else{
            // if this is an update of an existing record, creates a prepare statement using a sql update
            
            // pop $dataArray to remove "Save" key/value pair
            array_pop($this->dataArray);

            // dynamically prepare the sql statement
            $stmt = $this->db->prepare(
                "UPDATE " . $this->tableName . " SET " .
                implode(" = ?, ",$this->columnArray) .
                " = ? WHERE " . $this->keyField . " = ?"      
            );
            // execute the update statement, passing the data into the update
            $isSaved = $stmt->execute(array_values($this->dataArray));
        }
        // return success flag
        return $isSaved;
    }// end of save()

    // function stub ~ class specific
    function validate(){

        $isValid = true;
        return $isValid;
    }// end of validate()

    // get a list of data for a class as an array    
    function getList() {
        $dataList = array();

        // load from the database with a prepared statement
        $stmt = $this->db->prepare("SELECT * FROM " . $this->tableName . " ");
        // execute the statement
        $stmt->execute(array());
         
        // check row count and store data in an array
        if ($stmt->rowCount() > 0){
            // if article is loaded fetch the data as an assoc array
            $dataList = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }       
        // return the list of cms
        return $dataList;       
    }// end of getList()

    // returns a list based off of filter parameters inputted
    function getListFiltered(
		$searchColumn = null, 
		$searchFor = null, 
		$sortColumn = null, 
		$sortDirection = null,
		$page = null,
        $howManyPerPage = null
	    ) {
		
		$dataList = array();
		$searchColumn = filter_var($searchColumn, FILTER_SANITIZE_STRING);
		$sortColumn = filter_var($sortColumn, FILTER_SANITIZE_STRING);
		$sortDirection = filter_var($sortDirection, FILTER_SANITIZE_STRING);
		$page = filter_var($page, FILTER_SANITIZE_NUMBER_INT);
		$howManyPerPage = filter_var($howManyPerPage, FILTER_SANITIZE_NUMBER_INT);

		$sql = "SELECT * FROM " . $this->tableName . " ";
		// check we received search parameters
		if (!is_null($searchColumn) && !empty($searchColumn) && !is_null($searchFor) && !empty($searchFor)) {
			$sql .= " WHERE " . $searchColumn . " LIKE ? ";
		}

		if (!is_null($sortColumn) && !empty($sortColumn) && !is_null($sortDirection) && !empty($sortDirection)) {
			$sql .= " ORDER BY " . $sortColumn . " " . $sortDirection;
		}
		
		// setup paging if passed
		//$how_many_on_page = 3;
		
		if (!is_null($page) && is_numeric($page)) {
			$sql .= " LIMIT " . (($howManyPerPage * $page - 1) - 1) . ", " . $howManyPerPage;
		}
        // prepare statment
		$stmt = $this->db->prepare($sql);
        
        // execute the statement
		$stmt->execute((is_null($searchFor) || empty($searchFor) ? null : array(
			'%' . $searchFor . '%'
		)));
		
        if ($stmt->rowCount() > 0) {
            $dataList = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }		
		
		return $dataList;
	}// end of getListFiltered()

    // function to export all data from the news articles table to a file
	function export($filename) {
		$success = false;
		
		// get the list of data to export
		$dataListArray = $this->getList();
		
		// create the file to put the data in
		$outputFileHandle = fopen(__DIR__ . '/../' . $filename, 'x');
		
		// if the file was created successfully
		if ($outputFileHandle) {
			
			// if we have data, loop each row and write to the file
			if (is_array($dataListArray)) {
				foreach ($dataListArray as $rowData) {
					fputcsv($outputFileHandle, $rowData);
				}
			}
			
			// close the file
			fclose($outputFileHandle);
			// change sucess flag to true
			$success = true;
		}
		return $success;
	}// end of export()

    // imports images function stub ~ class specific
    function import($filename){
        $success = false;
        
        return $success;
    }// end of import()

    // save images to a image folder
    function saveImage($fileArray){
        // make file name generic by making it a property
        
        if (isset($fileArray["upload_image"])) {
            move_uploaded_file($fileArray["upload_image"]['tmp_name'], __DIR__ . 
                "/../public/images/" . $this->dataArray[$this->keyField] . "_" . $this->imageFileName . ".jpg");
        }
    }// end of saveImage()
}

?>