<?php
// access to the base class
require_once(__DIR__ . '/Base.class.php');
class NewsArticles extends Base{
    
    // class table name
    var $tableName = "news_articles";
    // class primary key field
    var $keyField = "article_id";
    // class db column names
    var $columnArray = array("staff_first_name", "staff_last_name", "staff_title", "staff_gender");

    // sanitize user input
    function sanitize($dataArray){
        if (!empty($dataArray['staff_first_name'])){
            $dataArray['staff_first_name'] = filter_var($dataArray['staff_first_name'], FILTER_SANITIZE_STRING);
        }
        if (!empty($dataArray['staff_last_name'])){ 
            $dataArray['staff_last_name'] = filter_var($dataArray['staff_last_name'], FILTER_SANITIZE_STRING);
        }
        if (!empty($dataArray['staff_title'])){    
            $dataArray['staff_title'] = filter_var($dataArray['staff_title'], FILTER_SANITIZE_STRING); 
        }
        if (!empty($dataArray['staff_gender'])){    
            $dataArray['staff_gender'] = filter_var($dataArray['staff_gender'], FILTER_SANITIZE_STRING); 
        }
        return $dataArray;
    }

    function validate(){

        $isValid = true;

        if (empty($this->dataArray['staff_first_name'])){
            $this->errors['staff_first_name'] = "Title is required";
            $isValid = false;
        }
        if (empty($this->dataArray['staff_last_name'])){
            $this->errors['staff_last_name'] = "Author is required";
            $isValid = false;
        }
        if (empty($this->dataArray['staff_title'])){
            $this->errors["staff_title"] = "Content is required";
            $isValid = false;
        }
        if (empty($this->dataArray['article_date'])){
            $this->errors["article_date"] = "Date is required";
            $isValid = false;
        }
        return $isValid;
    }

}

?>