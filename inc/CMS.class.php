<?php
// access to the base class
require_once(__DIR__ . '/Base.class.php');
// class for CMS table
class CMS extends Base {
    // assign tablename to CMS class
    var $tableName = "cms";
    
    // assign url column name for cms table
    var $keyField = "cms_id"; // changed to url

    var $columnArray = array("page_title", "meta_tags", "h1", "content", "url_key");

    // assign a image file name for CMS class
    var $imageFilename = "cms_banner"; 
    
    function sanitize($dataArray){
        if (!empty($dataArray['page_title'])){
            $dataArray['page_title'] = filter_var($dataArray['page_title'], FILTER_SANITIZE_STRING);
        }
        if (!empty($dataArray['meta_tags'])){ 
            $dataArray['meta_tags'] = filter_var($dataArray['meta_tags'], FILTER_SANITIZE_STRING);
        }
        if (!empty($dataArray['h1'])){    
            $dataArray['h1'] = filter_var($dataArray['h1'], FILTER_SANITIZE_STRING); 
        }
        if (!empty($dataArray['content'])){    
            $dataArray['content'] = filter_var($dataArray['content'], FILTER_SANITIZE_STRING); 
        }
        if (!empty($dataArray['url_key'])){    
            $dataArray['url_key'] = filter_var($dataArray['url_key'], FILTER_SANITIZE_STRING); 
        }    
        return $dataArray;
    }// end of sanitize()

    function validate(){

        $isValid = true;

        if (empty($this->dataArray['page_title'])){
            $this->errors['page_title'] = "Page Title is required";
            $isValid = false;
        }
        if (empty($this->dataArray['meta_tags'])){
            $this->errors['meta_tags'] = "Descriptive tags are required";
            $isValid = false;
        }
        if (empty($this->dataArray['h1'])){
            $this->errors["h1"] = "H1 content is required";
            $isValid = false;
        }
        if (empty($this->dataArray['content'])){
            $this->errors["content"] = "Body content is required";
            $isValid = false;
        }
        if (empty($this->dataArray['url_key'])){
            $this->errors["url_key"] = "A Url key is required";
            $isValid = false;
        }  
        return $isValid;
    }// end of validate()

    function import($filename) {
		$success = false;
		
		if (is_file($filename)) {
			
			$importFileHandle = fopen($filename, "r");
			
			if ($importFileHandle) {
				while (feof($importFileHandle) === false) {
					$rowData = fgetcsv($importFileHandle);
					
					if (is_array($rowData)) { 
						$rowData = array_combine(
							[$this->keyField, "page_title", "meta_tags", "content", "h1", "url_key"],
							$rowData
						);
						
						if (isset($rowData[$this->keyField]) && $rowData[$this->keyField] > 0) {
							$this->load($rowData[$this->keyField]);
						}
						
						$this->set($rowData);
						
						if ($this->validate()) {
							$this->save();
						} else {
							// handle errors 
							
						}		
					}
				}
				fclose($importFileHandle);				
				$success = true;
			}					
		}
		return $success;
	}// end of import()
}

?>