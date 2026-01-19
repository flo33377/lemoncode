<?php

    // debogger

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

    // dependancies
include('mainFunctions.php');
$index_cours = include_once('envir/index-cours.php'); // index des cours
$descriptions_courses = include_once('envir/descriptions_courses.php'); // description des sommaires de cours

    // Session
session_set_cookie_params(86400); // durée du cookie de session = 24h
session_start();
/* unset($_SESSION['access_granted']); */


    // Constantes

// base_url = lien vers la HP basé sur le serveur utilisé 
define("BASE_URL", ($_SERVER["SERVER_PORT"] === "5000") ? "http://localhost:5000/" : "https://fneto-prod.fr/next-dev/");

// Home = Page d'accueil
define("HOME", __DIR__ . "/content/home.php");

// Summary_course = Page sommaire des différents cours
define("SUMMARY_COURSE", __DIR__ . "/content/summary_course.php");

// E404 = Page d'erreur
define("E404", __DIR__ . "/content/404.php");



    // Variables de pages

    // setting des param par défaut
$page = "home"; // chemin du routeur par défaut => cas HP
$content = HOME; // const du contenu de la page par défaut

$title = null; // par défaut, pas de title seo imposé
$prev = null; $next = null; // par défaut, pas de cours précédent/suivant


    // Routeur

// récupération de la méthode de requête utilisée
$method = $_SERVER['REQUEST_METHOD'];

// switch routeur
switch ($method) {
    case "POST":
        if (!empty($_POST)) {
            //if(isset($_POST['post_authenticate'])) $page = "check_authenticate"; // input caché post_authenticate
        }
        break;

    case "GET":
        if(isset($_GET['cours']) && ($_GET['cours'] != null)) { // tentative d'accès à un cours
            $page = "display_courses" ;
            $requested_course = $_GET['cours'];
        }
        if(isset($_GET['summary']) && ($_GET['summary'] != null)) { // tentative d'accès au sommaire d'un cours
            $page = "display_summary" ;
            $requested_course = $_GET['summary'];
        }
        break;
}



    // Roads
switch($page){
    case "home" : // cas par défaut => HP du site
        $content = HOME;
        break;
    
    case "display_courses" : // => user essaie d'accéder à un cours
        $type = getRequestedCourseType($requested_course);

        // si type de cours non reconnu => erreur 404
        if ($type == "null") {
            http_response_code(404);
            $content = E404;
            break;
        }

        if (!doesCourseExist($requested_course, $type, $index_cours)) {
            // si cours non-renseigné dans l'index => erreur 404
            http_response_code(404);
            $content = E404;
            break;

        } else {

            $title = $index_cours[$type][$requested_course]['title_seo'];
        
            $courseFile = __DIR__ . '/' . $index_cours[$type][$requested_course]['file'];
        
            if (!is_file($courseFile)) { 
                // si listé dans l'index mais pas de fichier correspondant => erreur 404
                http_response_code(404);
                $content = E404;
                break;
            }
        
            $content = $courseFile;
        
            // pagination
            $keys = array_keys($index_cours[$type]);
            $index = array_search($requested_course, $keys);
            $prev = $keys[$index - 1] ?? null;
            $next = $keys[$index + 1] ?? null;
        }
        
        break;
    case "display_summary" : // => user essaie d'accéder au sommaire d'un cours
        $summaryType = getRequestedCourseType($requested_course);

        // si type de cours non reconnu => erreur 404
        if ($summaryType == "null") {
            http_response_code(404);
            $content = E404;
            break;
        }

        $content = SUMMARY_COURSE;

        break;

}



?>