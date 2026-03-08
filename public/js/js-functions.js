
/* FONCTIONNEMENT DES POP UP */

document.addEventListener('click', (e) => {
    // écoute chaque clic sur le DOM
    const trigger = e.target.closest('[data-popup-id]');
    // quand clic, remonte les éléments du DOM au niveau du clic pour voir si
    // lui ou un parent à l'attribut data-popup-id
    if (!trigger) return;
    // si non, ne va pas plus loin

    const popupId = trigger.dataset.popupId;
    const popup = document.getElementById(popupId);
    // récup la data et trouve la popup avec

    if (!popup) {
        console.warn(`Popup introuvable : ${popupId}`);
        return;
        // si popup n'existe pas, avertissement console et stop
    }

    // si clic lié à popup et popup existe :
        popup.showModal();
        popup.style.top = `${(window.innerHeight - popup.offsetHeight) / 2}px`;
        popup.style.left = `${(window.innerWidth - popup.offsetWidth) / 2}px`;
        // ouvre la popup et la place

        document.getElementById('close_popup')?.addEventListener('click', () => {
            popup.close();
        });
        // active le bouton fermeture de la popup

        popup.addEventListener('click', (e) => {
            if (e.target === popup) {
            // dialog = si clic en dehors de la popup, considéré comme clic sur la popup
            // mais pas sur le content, donc target === popup => clic en dehors
                popup.close();
            }
        });
        // ferme la popup en cas de clic en dehors
});


/* Création dynamique du menu */

const menu = document.getElementById("burger_menu");
menu.innerHTML = "";

// Ajoute un lien accueil
const hpLink = document.createElement("a");
hpLink.textContent = "Accueil";
hpLink.href = `${BASE_URL}`;
menu.appendChild(hpLink);

// récup les infos de l'URL pour savoir où on est et le mettre en avant
const params = new URLSearchParams(window.location.search);
const currentCourse = params.get("cours");
const currentSummary = params.get("summary");

for (const subject in indexCours) {

  // slug depuis le 1er chapitre → 1er cours
  const chapters = indexCours[subject];
  const firstChapterKey = Object.keys(chapters)[0];
  const firstCourseKey = Object.keys(chapters[firstChapterKey])[0];
  const subjectSlug = firstCourseKey.split("-")[0];

  // Création du lien sujet
  const a = document.createElement("a");
  a.className = "menu_subject";
  a.textContent = subject;
  a.href = `${BASE_URL}?summary=${subjectSlug}`;

  // Par défaut => par du principe que n'est pas le lien actif
  let isActive = false;

  // Check si on est pas sur le summary du sujet, 
  // si oui, le met en avant
  if (currentSummary === subjectSlug) {
    isActive = true;
  }

  // Check si on est pas sur une page cours d'un sujet, 
  // si oui, le met en avant
  if (currentCourse && currentCourse.startsWith(subjectSlug + "-")) {
    isActive = true;
  }

  if (isActive) {
    a.classList.add("current");
  }

  menu.appendChild(a);
}


/* Affichage du menu */

let menuButton = document.getElementById("menu_button");
let burgerMenu = document.getElementById("burger_menu");
let overlay = document.getElementById("menu_overlay");
let headerContainer = document.getElementById("header");

if(menuButton) {
    menuButton.addEventListener("click", () => {
    let rect = headerContainer.getBoundingClientRect();
    burgerMenu.style.top = rect.bottom + "px";   // sous le bouton
    burgerMenu.style.left = rect.left + "px";    // aligné à gauche du bouton
    burgerMenu.classList.toggle("open");
    menuButton.classList.toggle("open");
    overlay.classList.toggle("active");
    });

    // ferme le menu en cas de clic en dehors
    document.addEventListener('click', (e) => {
        // si le menu est fermé, rien à faire
        if (!burgerMenu.classList.contains('open')) return;
    
        // si le clic est ni dans le menu ni sur le bouton -> fermer
        const clickInsideMenu   = burgerMenu.contains(e.target);
        const clickOnMenuButton = menuButton.contains(e.target);
    
        if (!clickInsideMenu && !clickOnMenuButton) {
        burgerMenu.classList.remove('open');
        menuButton.classList.toggle('open');
        overlay.classList.toggle('active');
        }
    });
    
    // fermer avec Échap (accessibilité)
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            burgerMenu.classList.remove('open');
            menuButton.classList.toggle('open');
            overlay.classList.toggle('active');
        }
    });
}


/* Gestion des contenus des pages "Sommaire" */

if(typeof summaryType !== "undefined") {
    // Titre du sujet
    const summaryCategory = document.getElementById('summary_category');
    summaryCategory.textContent = summaryType;

    // Description du sujet
    const summaryDescription = document.getElementById('summary_description');
    if (descriptionsCourses[summaryType]) {
    summaryDescription.innerHTML = descriptionsCourses[summaryType];
    }

    // Contenu
    const summaryContentBloc = document.getElementById('summary_content');
    summaryContentBloc.innerHTML = "";

    const subjectData = indexCours[summaryType];

    for (const subPart in subjectData) {

    // Sous-partie
    const subPartTitle = document.createElement("h3");
    subPartTitle.className = "summary_subpart";
    subPartTitle.textContent = subPart;
    summaryContentBloc.appendChild(subPartTitle);

    const ul = document.createElement("ul");
    ul.className = "summary_courses";

    const courses = subjectData[subPart];

    for (const courseKey in courses) {
        const course = courses[courseKey];

        const li = document.createElement("li");
        li.className = "summary_course_item";

        const a = document.createElement("a");
        a.href = `${BASE_URL}?cours=${courseKey}`;
        a.classList.add('course_module');

        const p = document.createElement("p");
        p.textContent = course.title_page;

        // SVG
        const svgNS = "http://www.w3.org/2000/svg";
        const svg = document.createElementNS(svgNS, "svg");
        svg.setAttribute("viewBox", "0 0 50 50");
        svg.setAttribute("width", "20");
        svg.setAttribute("height", "20");

        const path = document.createElementNS(svgNS, "path");
        path.setAttribute(
        "d",
        "M15.563,40.836c0.195,0.195,0.451,0.293,0.707,0.293s0.512-0.098,0.707-0.293l15-15c0.391-0.391,0.391-1.023,0-1.414l-15-15c-0.391-0.391-1.023-0.391-1.414,0s-0.391,1.023,0,1.414l14.293,14.293L15.563,39.422C15.172,39.813,15.172,40.446,15.563,40.836z"
        );

        svg.appendChild(path);

        a.appendChild(p);
        a.appendChild(svg);

        li.appendChild(a);
        ul.appendChild(li);
    }

    summaryContentBloc.appendChild(ul);
}

}




