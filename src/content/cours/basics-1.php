<div class="course_content">
<h1>Le fonctionnement du web</h1>

<p>
    Dans ce chapitre, on va se concentrer sur quelques points techniques d'internet, 
    pour comprendre vraiment comment fonctionne le web, l'accès à internet, etc. et 
    disposer de notions qui permettront par la suite de coder efficacement en comprenant 
    ce qu'il se passe dans ton navigateur.
</p>


<h2 class="subtitle blue">Qu'est-ce qui se passe lorsque je souhaite accéder à une page web ?</h2>

<p>
    On va revenir sur le processus étape par étape, puis on clarifiera certains termes :

    <ol>
        <li>
            <span class="bold uppercase">Entrée de l'adresse du site</span><br>
            Lorsque tu souhaites accéder à google.com par com, tu vas taper cette adresse dans ta barre de navigation.
        </li>

        <li>
            <span class="bold uppercase">Recherche de l'adresse du site (DNS)</span><br>
            Là, ton navigateur va envoyer ce qu'on appelle une requête HTTP à un serveur DNS, pour lui 
            demander où sont stockés les fichiers qui permettent d'accéder à google.com 
            (l'adresse IP du serveur qui héberge ces fichiers). Le serveur renvoie alors l'info à ton navigateur.
        </li>

        <li>
            <span class="bold uppercase">Demande du fichier au bon serveur</span><br>
            Maintenant que ton navigateur sait à qui s'adresser (le serveur qui héberge google.com), il 
            envoie une autre requête HTTP à ce serveur pour lui demander la page que tu veux afficher.
        </li>

        <li>
            <span class="bold uppercase">Préparation de la réponse côté serveur</span><br>
            S'il s'agit d'une page statique, le serveur l'envoie en l'état. Si la page dépend de code 
            back (PHP, Python, Node, etc.), il exécute ce code (qui peut modifier le contenu de ta page), 
            puis génère le code statique qu'il renvoie à ton navigateur.
        </li>

        <li>
            <span class="bold uppercase">Analyse de la réponse</span><br>
            Ton navigateur lit le code transmis, et regarde s'il a tous les éléments. S'il voit 
            qu'il a par exemple besoin d'afficher une image, d'utiliser un fichier de code CSS ou 
            JavaScript en plus, il renvoie autant de requêtes que de fichier qui lui manque afin de tout récupérer.
        </li>

        <li>
            <span class="bold uppercase">Assemblage et affiche de la page</span><br>
            Quand le navigateur a tous les éléments nécessaires, il assemble le tout et affiche la page demandée.
        </li>

    </ol>

</p>


<p>
    Maintenant, revenons sur quelques termes :
</p>

<table>
    <thead>
        <tr>
            <th>Terme</th>
            <th>Explication</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td>Serveur 🔌</td>
            <td>Ordinateur puissant dont le rôle est de stocker des ressources 
            et de les transmettre aux clients. Pour cela, il doit être en permanence allumé 
            et connecté au réseau. Un même serveur peut contenir les données de différents sites.</td>
        </tr>
        <tr>
            <td>Requête ❔</td>
            <td>Ensemble de données formatées qui permettent de communiquer 
            entre un client (ici, ton navigateur) et un serveur. 
            Le client demande à accéder à une ressource (via une requête) et le serveur lui renvoie 
            un message (une réponse).</td>
        </tr>
        <tr>
            <td>HTTP 💻</td>
            <td>Acronyme de HyperText Transfer Protocol (protocole de transfert hypertexte). 
            C'est un protocole, donc un ensemble de règles qui régissent la manière dont communiquent 
            entre eux différentes machines, pour demander et envoyer des fichiers hypertextes 
            (du texte, des médias comme des images, etc.).</td>
        </tr>
        <tr>
            <td>HTTPS 🔐</td>
            <td>Variation de ce protocole de transfert, plus sécurisé, qui permet de 
            certifier que les données échangées ne sont pas modifiées lors de leur envoi ou 
            interceptées par un tiers.</td>
        </tr>
        <tr>
            <td>Serveur DNS 🔍</td>
            <td>Un peu comme un annuaire téléphonique : c'est un service 
            informatique qui relie les noms des sites et les adresses IP des serveurs qui les hébergent.</td>
        </tr>
        <tr>
            <td>Adresse IP 🌐</td>
            <td>Numéro d'identification qui permet d'identifier ta source 
            d'accès à internet, par exemple ta box internet si tu es en Wi-Fi.<br>
            Sur internet, tous tes appareils connectés à cette box sont considérés comme ayant 
            la même adresse IP (ce qu'on appelle une adresse IP publique), et chez toi, chacun 
            de ces appareils dispose de sa propre adresse IP que seule ta box sait différencier (ton IP privé).</td>
        </tr>
        <tr>
            <td>Code front et back 🧑‍💻</td>
            <td>Pour faire simple, le code front correspond à ce que tu vois du 
            site et le code back à ce que tu ne vois pas (une vérification auprès du serveur que le 
            mot de passe que tu entres pour te connecter est bien le bon par exemple). Sur ce sujet, 
            ainsi que sur le CSS et le JavaScript, tu trouveras plus d'informations dans ce chapitre : 
            <a href="<?= BASE_URL ?>?cours=basics-2" class="underline">Comprendre la différence entre le front et le back</a></td>
        </tr>
    </tbody>
</table>



<h2 class="subtitle blue">Comment découper et analyser l'adresse d'un site web ?</h2>

<p>
    Une autre notion importante à comprendre va être la notion d'URL.<br>
    Une URL (Uniform Resource Locator, en français une localisation uniformisée de ressource), 
    c'est la localisation d'une ressource : une page web, un fichier de code, une image, etc. 
    C'est ce qu'on appelle communément une adresse web. Son écriture est standardisée et on 
    peut donc comprendre facilement ce qu'elle indique :
</p>

    <img src="https://fneto-prod.fr/next-dev/public/img/nd-url-composition.png" alt="Schéma de la composition d'une URL">

<p>
    Dans le schéma ici :

    <ul>
        <li>
        <span class="bold">https:// → C'est le protocole utilisé pour accéder à la ressource, ici le protocole HTTPS.</span>
        </li>

        <li>
        <span class="bold">fneto-prod.fr → c'est le nom de domaine du site, c'est le nom public de l'emplacement où 
        sont stockées les ressources.</span><br>
        Il est composé d'une chaîne de caractère (fneto-prod) 
        et d'une extension (.fr). Chaque nom de domaine est unique.
        </li>

        <li>
        <span class="bold">/next-dev/ → c'est le chemin vers la ressource, au sein du nom de domaine.</span><br>
        Cela veut dire qu'ici, le fichier qui permet d'accéder à cette page se trouve dans 
        le nom de domaine fneto-prod.fr, dans un sous-dossier nommé "next-dev".
        </li>

        <li>
        <span class="bold">?cours=basics-1 → quand quelque chose se trouve en fin d'URL et débute par un "?" 
        comme cela, c'est ce qu'on appelle un paramètre d'URL.</span><br>
        C'est simplement une donnée supplémentaire, une information en plus donnée au serveur 
        qui peut s'en servir dans certains cas. Ici, on indique au serveur qu'il y a une 
        variable "cours" dont la valeur est "basics-1".<br>
        C'est notamment beaucoup utilisé pour le tracking d'URL, qui permet à des services 
        analytics comme Google Analytics de savoir que vous arrivez sur une page web 
        depuis un lien dans un email ou une publication sur un réseau social par exemple.
        </li>

    </ul>
</p>


</div>

