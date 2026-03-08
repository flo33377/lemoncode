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
$subjectSlug = null; // set par défaut le sujet du cours comme étant null


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
        $found = findCourseInIndex($requested_course, $index_cours);

        // ❌ Pas trouvé dans l'index
        if ($found === null) {
            http_response_code(404);
            $content = E404;
            break;
        }
    
        $courseData = $found['course'];
        $title = $courseData['title_seo'];
    
        $courseFile = __DIR__ . '/' . $courseData['file'];
    
        // ❌ Listé mais fichier manquant
        if (!is_file($courseFile)) {
            http_response_code(404);
            $content = E404;
            break;
        }
    
        // ✅ OK → on affiche le cours
        $content = $courseFile;


        // Lien back
            // casse $requested_course au niveau du - et 
            // assigne les valeurs dans une variable
            // => comme ici une seule variable => que le 1er élément qui est stocké
        [$subjectSlug] = explode('-', $requested_course);

        // Pagination
        $flatCourses = [];
        
            // nav dans le tableau pour trouver les cours associés au sein du même sujet
        foreach ($index_cours as $subjectName => $chapters) {
            foreach ($chapters as $chapterName => $courses) {
                foreach ($courses as $key => $course) {
                    // pour chaque cours, s'il commence par le même slug (basics, html, etc.)
                    // que celui du cours courant --> le stocke dans le tableau, sinon ne le prend pas
                    if (str_starts_with($key, $subjectSlug . '-')) {
                        $flatCourses[] = $key;
                    }
                }
            }
        }

        $index = array_search($requested_course, $flatCourses, true);
    
        $prev = $flatCourses[$index - 1] ?? null;
        $next = $flatCourses[$index + 1] ?? null;
    
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