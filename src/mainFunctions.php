
<?php


    /* ACCES A UNE FICHE DE COURS */
function getRequestedCourseType(string $requestedCourse) : string { // renvoie le type de cours demandé pour savoir où chercher dans le tableau d'index
    if(str_contains($requestedCourse, "basics")) return "Les bases du web";
    if(str_contains($requestedCourse, "html")) return "HTML";
    if(str_contains($requestedCourse, "css")) return "CSS";
    if(str_contains($requestedCourse, "js")) return "JS";
    if(str_contains($requestedCourse, "php")) return "PHP";

    return "null";
}


function doesCourseExist(string $requestedCourse, string $type, array $indexCourses) : bool {
    // vérifie si un cours existe bien dans l'index
    return isset($indexCourses[$type][$requestedCourse]);
}



?>
