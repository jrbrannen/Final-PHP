<?php
// access to the base class
require_once(__DIR__ . '/Base.class.php');
class NewsArticles extends Base{
  
    // class table name
    var $tableName = "news_articles";
    
    // class primary key
    var $keyField = "article_id";
    
    // class db column names
    var $columnArray = array("article_title", "article_content", "article_author", "article_date");
    
    function sanitize($dataArray){
        if (!empty($dataArray['article_title'])){
            $dataArray['article_title'] = filter_var($dataArray['article_title'], FILTER_SANITIZE_STRING);
        }
        if (!empty($dataArray['article_author'])){ 
            $dataArray['article_author'] = filter_var($dataArray['article_author'], FILTER_SANITIZE_STRING);
        }
        if (!empty($dataArray['article_content'])){    
            $dataArray['article_content'] = filter_var($dataArray['article_content'], FILTER_SANITIZE_STRING); 
        }
        return $dataArray;
    }

    function validate(){

        $isValid = true;

        if (empty($this->dataArray['article_title'])){
            $this->errors['article_title'] = "Title is required";
            $isValid = false;
        }
        if (empty($this->dataArray['article_author'])){
            $this->errors['article_author'] = "Author is required";
            $isValid = false;
        }
        if (empty($this->dataArray['article_content'])){
            $this->errors["article_content"] = "Content is required";
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