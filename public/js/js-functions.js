
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

for (const type in indexCours) {
  // Titre de catégorie
  const categoryTitle = document.createElement("p");
  categoryTitle.className = "menu_category";
  categoryTitle.textContent = `${type}`;

  menu.appendChild(categoryTitle);

  const div = document.createElement("div");
  div.className = "menu_course";

  for (const courseKey in indexCours[type]) {
    const course = indexCours[type][courseKey];

    const a = document.createElement("a");
    a.textContent = course.title_page;
    a.href = `${BASE_URL}?cours=${courseKey}`;

    div.appendChild(a);

  // Mise en avant du cours actuel
  const currentCourse = new URLSearchParams(window.location.search).get("cours");

  if (courseKey === currentCourse) {
    a.classList.add("current");
  }
  }

  menu.appendChild(div);
}


/* Affichage du menu */

let menuButton = document.getElementById("menu_button");
let burgerMenu = document.getElementById("burger_menu");
let headerContainer = document.getElementById("header")

if(menuButton) {
    menuButton.addEventListener("click", () => {
    let rect = headerContainer.getBoundingClientRect();
    burgerMenu.style.top = rect.bottom + "px";   // sous le bouton
    burgerMenu.style.left = rect.left + "px";    // aligné à gauche du bouton
    burgerMenu.classList.toggle("open");
    menuButton.classList.toggle("open");
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
        }
    });
    
    // fermer avec Échap (accessibilité)
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            burgerMenu.classList.remove('open');
            menuButton.classList.toggle('open');
        }
    });
}


/* Gestion des contenus des pages "Sommaire" */

if(summaryType) {
    // affichage du titre de la catégorie
    summaryCategory = document.getElementById('summary_category');
    summaryCategory.innerHTML = summaryType;

    // affichage de la description
    summaryDescription = document.getElementById('summary_description');
    if(descriptionsCourses[summaryType]) {
        summaryDescription.innerHTML = descriptionsCourses[summaryType];
    } else { console.log('Pas de description pour ce cours')};

    // affichage des cours
    let summaryContentBloc = document.getElementById('summary_content');
    for (const courseKey in indexCours[summaryType]) {
        const course = indexCours[summaryType][courseKey];

        const a = document.createElement("a");
        a.href = `${BASE_URL}?cours=${courseKey}`;
        a.classList.add('course_module');

        const div = document.createElement("div");

        const p = document.createElement("p");
        p.textContent = course.title_page;

        // SVG (namespace différent que le HTML)
        const svgNS = "http://www.w3.org/2000/svg";
        const svg = document.createElementNS(svgNS, "svg");
        svg.setAttribute("viewBox", "0 0 50 50");
        svg.setAttribute("width", "20");
        svg.setAttribute("height", "20");

        const path = document.createElementNS(svgNS, "path");
        path.setAttribute("d", "M15.563,40.836c0.195,0.195,0.451,0.293,0.707,0.293s0.512-0.098,0.707-0.293l15-15c0.391-0.391,0.391-1.023,0-1.414l-15-15c-0.391-0.391-1.023-0.391-1.414,0s-0.391,1.023,0,1.414l14.293,14.293L15.563,39.422C15.172,39.813,15.172,40.446,15.563,40.836z");
    
        svg.appendChild(path);
        a.appendChild(p);
        a.appendChild(svg);
        summaryContentBloc.appendChild(a);
    }
}


