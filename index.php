<?php
    include './init/init.php';
    $user =loggedInUser() ;
    include $_SERVER['DOCUMENT_ROOT'] . '/G19BCSY3A/includes/header.inc.php'; //this absolute path
    include '/xampp/htdocs/g19bcsy3a/includes/navbar.inc.php'; //this is also absolute path
    
    
        // $pages = ["login","register", "dashboard"];
        // if(isset($_GET['page'])){
        //     $page =  $_GET['page'];
        //     if(in_array($page, $pages)){
        //         include $_SERVER['DOCUMENT_ROOT'] . '/G19BCSY3A/pages/'.$_GET['page'].'.php';
        //     }else{
        //         echo '<h1>Error 404</h1>';
        //     }
             
        // }else{
        //     echo '<h1>HOME Page</h1>';    
        // }
        $aviable_pages = ['login','register','dashboard','logout','profile'];
        $logged_in_pages = ['dashboard','profile'];
        $non_logged_in_pages = ['login','register'];
        
        $page = '';
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        if(in_array($page, $logged_in_pages) && empty(($user))){
            header("Location: ./?page=login");
        }
        if(in_array($page, $non_logged_in_pages) && !empty(($user))){
            header("Location: ./?page=dashboard");
        }

        
        if(in_array($page, $aviable_pages)){
            include './pages/' .$page. '.php';
        }else{
            header('Location: ./?page=dashboard'); // this will throw the query string to url(become to uri)

            //include './pages/' .'dashboard'. '.php'; // this also open the direction file but it never throw somethings to our url
                                                        // that why it will not go back to check the condition above again
        }
    

    include $_SERVER['DOCUMENT_ROOT'] . '/G19BCSY3A/includes/footer.inc.php';
?>