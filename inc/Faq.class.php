<?php
// access to the base class
require_once(__DIR__ . '/Base.class.php');
class Faq extends Base{
  
    // class table name
    var $tableName = "faq";
    
    // class primary key
    var $keyField = "faq_id";
    
    // class db column names ~ id columns are not included ~
    var $columnArray = array("faq_question", "faq_answer");
    
    function sanitize($dataArray){
        if (!empty($dataArray['faq_question'])){
            $dataArray['faq_question'] = filter_var($dataArray['faq_question'], FILTER_SANITIZE_STRING);
        }
        if (!empty($dataArray['faq_answer'])){ 
            $dataArray['faq_answer'] = filter_var($dataArray['faq_answer'], FILTER_SANITIZE_STRING);
        }
        return $dataArray;
    }

    function validate(){

        $isValid = true;

        if (empty($this->dataArray['faq_question'])){
            $this->errors['faq_question'] = "Faq question is required";
            $isValid = false;
        }
        if (empty($this->dataArray['faq_answer'])){
            $this->errors['faq_answer'] = "Faq answer is required";
            $isValid = false;
        }
        return $isValid;
    }
}

?>