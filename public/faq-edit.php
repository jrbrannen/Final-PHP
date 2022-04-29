<?php
session_start();

require_once('../inc/User.class.php');
require_once('../inc/Faq.class.php');

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
        // create a faq object
        $faq = new Faq();

        $faqArray = array();
        $faqErrorsArray = array();
 
        $requestArray = $faq->sanitize($_REQUEST); // $_REQUEST is both $_GET and $_POST
        
        // checks to see if there is a faq to load
        if (isset($requestArray['faq_id']) && !empty($requestArray['faq_id'])){
            $faq->load($requestArray['faq_id']);
            $faqArray = $faq->dataArray;
        }

        // checks to see if the save button was pushed
        if (isset($requestArray["Save"])){
            
            // sanitize the data
            $requestArray = $faq->sanitize($_REQUEST); // $_REQUEST is both $_GET and $_POST
            
            // pass new data to the instance
            // set data array to the object array property
            $faq->set($requestArray);

            // validate the data
            if ($faq->validate()){
                //save
                if ($faq->save()){
                    //save image if uploaded
                    $faq->saveImage($_FILES);
                    // redirect and prevent double posting
                    header("location: ../tpl/faq-save-success.tpl.php"); 
                    exit;   // ends server processing
                }else{
                    
                }
            }else{
                //errors
                $errorsArray = $faq->errors;
                $faqArray = $faq->dataArray;
            }
        }
        // go back to faq list view page
        if (isset($_POST['Cancel'])) {
            header("location: faq-list.php");
            exit;
        }
        // include the view
        require_once('../tpl/faq-edit.tpl.php');
    }else{
        $user->errors = "You must be an admin faq to use this feature";
        require_once('../tpl/faq-error.tpl.php');
    }
}else{
    $user->errors = "Invalid faq";
    header('location: index.php');
    exit;
}

?>
