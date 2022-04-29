<?php
session_start();

require_once('../inc/User.class.php');
require_once('../inc/CMS.class.php');

// create a user object
$user = new User();

// create a userId variable
$userId = null;

// check to see if a user_id is stored in the session array, 
// if so assign it to user id var and assign user level var
if(isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $userLevel = $_SESSION['user_level'];
}

if($user->checkLogin($userId)) {
    $userArray = array();
    $errorsArray = array();

    if($user->isAdminLevel($userLevel)){
        // create a cms object
        $cms = new CMS();

        $cmsArray = array();
        $cmsErrorsArray = array();
 
        $requestArray = $cms->sanitize($_REQUEST); // $_REQUEST is both $_GET and $_POST
        
        // checks to see if there is a cms to load
        if (isset($requestArray['cms_id']) && !empty($requestArray['cms_id'])){
            $cms->load($requestArray['cms_id']);
            $cmsArray = $cms->dataArray;
        }

        // checks to see if the save button was pushed
        if (isset($requestArray["Save"])){
            
            // sanitize the data
            $requestArray = $cms->sanitize($_REQUEST); // $_REQUEST is both $_GET and $_POST
            
            // pass new data to the instance
            // set data array to the object array property
            $cms->set($requestArray);

            // validate the data
            if ($cms->validate()){
                //save
                if ($cms->save()){
                    //save image if uploaded
                    $cms->saveImage($_FILES);
                    // redirect and prevent double posting
                    header("location: ../tpl/cms-save-success.tpl.php"); 
                    exit;   // ends server processing
                }else{
                    
                }
            }else{
                //errors
                $errorsArray = $cms->errors;
                $cmsArray = $cms->dataArray;
            }
        }
        // go back to cms list view page
        if (isset($_POST['Cancel'])) {
            header("location: cms-list.php");
            exit;
        }
        // include the view
        require_once('../tpl/cms-edit.tpl.php');
    }else{
        $cms->errors = "You must be an admin cms to use this feature";
        require_once('../tpl/cms-error.tpl.php');
    }
}else{
    $cms->errors = "Invalid cms";
    header('location: index.php');
    exit;
}

?>
