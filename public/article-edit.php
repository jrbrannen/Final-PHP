<?php
session_start();

require_once('../inc/User.class.php');
require_once('../inc/NewsArticles.class.php');

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
        // create object
        $newsArticle = new NewsArticles();

        $dataArray = array();
        $errorsArray = array();

        $requestArray = $newsArticle->sanitize($_REQUEST); // $_REQUEST is both $_GET and $_POST

        // checks to see if there is a record to load
        if (isset($requestArray['article_id']) && !empty($requestArray['article_id'])){
            $newsArticle->load($requestArray['article_id']);
            $dataArray = $newsArticle->dataArray;
        }

        // checks to see if the save button was pushed
        if (isset($requestArray["Save"])){
            
            // sanitize the data
            $requestArray = $newsArticle->sanitize($_REQUEST); // $_REQUEST is both $_GET and $_POST
            
            // pass new data to the instance
            // set data array to the object array property
            $newsArticle->set($requestArray);

            // validate the data
            if ($newsArticle->validate()){
                //save
                if ($newsArticle->save()){
                    header("location: ../tpl/article-save-success.tpl.php"); // prevents double posting
                    exit;   // ends server processing
                }else{
                    
                }
            }else{
                //errors
                $errorsArray = $newsArticle->errors;
                $dataArray = $newsArticle->dataArray;
            }
        }
        // go back to article list view page
        if (isset($_POST['Cancel'])) {
            header("location: article-list.php");
            exit;
        }
        // include the view
        require_once('../tpl/article-edit.tpl.php');
    }else{
        $user->errors = "You must be an admin user to use this feature";
        require_once('../tpl/user-error.tpl.php');
    }
}else{
    $user->errors = "Invalid User";
    header('location: index.php');
    exit;
}
?>