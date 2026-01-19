<div class="course_content">
<h2 class="subtitle green">Qu'est ce que le langage front et le langage back ?</h2>

<p>Comme nous l'avons vu dans la partie précédente, lorsque vous cherchez à accéder à un site web, vous 
envoyez une requête aux serveurs pour demander à accéder à ce site.<br>
Lorsque les serveurs ont identifié le contenu auquel vous souhaitez accéder, le serveur sur lequel est 
le site va procéder par étapes :
<ul>
    <li>Il va vérifier les éléments de votre requête pour s'assurer que vous pouvez y accéder ;</li>
    <li>Puis il va faire le point sur ce dont vous avez besoin : la page peut en effet avoir besoin d'un fichier HTML, 
        d'une feuille de style CSS, d'une image, d'éxécuter un fichier PHP pour se compléter, etc.</li>
    <li>Sur tous ces éléments, il va en distinguer 2 sortes : les documents front ("devant" en anglais) et les 
        documents back ("à l'arrière"). <span class="bold">Il va exécuter les fichiers back de son côté, puis vous renvoyer une réponse à votre 
        requête qui contiendra les fichiers front, qui seront affichés par votre navigateur.</span>
    </li>
</ul>
Et là votre navigateur va pouvoir vous afficher le site grâce aux fichiers qu'il aura reçu.
</p>

<br>

<p>Pourquoi cette distinction ? Car les fichiers back sont codés dans des langages spécifiques <span class="bold"> qui ont pour 
vocation à s'éxécuter côté serveur </span>("server-side"), ils peuvent être en PHP, C#, Ruby et bien d'autres.<br>
Ils vont servir à exécuter des <span class="bold">actions silencieuses côté serveur</span> (aller vérifier que le mot de passe entré 
est bien le bon par exemple) et même à <span class="bold">modifier le contenu que vous allez recevoir et afficher.</span><br>
Par exemple si vous voulez voir votre historique d'achat sur Amazon, le serveur ne va pas vous envoyer l'intégralité 
des achats faits par tous les clients et laisser votre navigateur faire le tri : il va vérifier si vous êtes bien connecté 
et pouvez y accéder, puis se servir de vos identifiants pour retrouver vos achats et les intégrer au fichier HTML qu'il vous 
renvoie. De la même manière, cela permet aussi de ne pas avoir dans le serveur un fichier par utilisateur : le serveur a un fichier 
unique, le même pour tout le monde, et complète les informations de commande avec les vôtre pour créer votre page personnalisée.<br>
L'autre avantage est que <span class="bold">les fichiers back restent donc côté serveur</span>, ils ne sont pas renvoyé à votre navigateur et vous ne 
pouvez pas les lire en essayant d'y accéder comme cela. Cela permet de les sécuriser et de s'assurer qu'un utilisateur ne 
peut pas accéder à un contenu auquel il ne devrait pas avoir accès, pour comprendre comment il fonctionne et essayer 
de le contourner par exemple.
</p>

<p>Les fichiers front en revanche, sont <span class="bold">renvoyés entier au navigateur</span>, qui ensuite les exécute pour les afficher.<br>
Ce sont les fichiers HTML, CSS, JavaScript et les petits fichiers de ressources comme les images.
Cela veut dire que vous avez accès en clair à ces fichiers : vous pouvez les lire intégralement (utile pour apprendre 
comment refaire des modules de site !).
</p>


<h2 class="subtitle green">Quelle(s) différence entre les différents langages back ?</h2>

<p>Les différents langages back n'ont pas d'énormes différences entre eux car ils vont globalement tous servir à 
effectuer des actions côté serveur plutôt que côté client, mais ce qui va changer, c'est leur syntaxe et leur spécialité.<br>
Certains langages vont disposer de plus de commandes pour manipuler des fichiers sur le réseau, d'autres pour s'y retrouver parmi 
de très grandes quantités de données. Certains en revanche vont permettre d'effectuer des actions spécifiques que la plupart 
des langages back ne peuvent pas faire, comme créer des serveurs intégrés qui vont gérer des actions en tant réel.
</p>

<p><span class="bold">Ce qui va surtout être nécessaire de comprendre pour démarrer le développement</span>, c'est que le langage back va s'éxécuter 
côté serveur : pour le tester, il faudra par exemple simuler un comportement serveur, votre navigateur ne suffira pas, et 
ce qu'il permettra de faire sera totalement différent de ce que vont permettre de faire les langages front comme HTML.
</p>

<h2 class="subtitle green">Quelle(s) différence entre les différents langages front ?</h2>

<p>Les langages front vont eux servir à afficher le contenu du site auquel vous souhaitez accéder. Votre navigateur 
sait les lire et les exécuter, et ils sont 3 : HTML, CSS et JavaScript.<br>
Une bonne analogie pour comprendre leur rôle respectif est celle d'une recette :
<ul>
    <li>HTML (HyperText Markup Language, ou langage de balise pour l'hypertexte en français), ce sont <span class="bold">les ingrédients 
        de votre recette</span> : il vous faut des oeufs, de la farine, etc. Et bien là, HTML va lister les éléments nécessaires 
        au site : des images, des textes, des boutons, etc. Tout ce qui compose votre page web.
    </li>
    <li>CSS (Cascadind Stylesheet, ou feuille de style en cascade), ce sont <span class="bold">ce que vous allez faire avec ces ingrédients</span> : 
        battre les oeufs, ajouter la farine avant le lait, etc. Là, CSS va indiquer quoi faire avec vos éléments : 
        où les disposer sur la page, la taille qu'ils doivent faire, leur couleur, etc.
    </li>
    <li>JavaScript, ce sont <span class="bold">les interactions avec les consommateurs de votre recette</span> : si vous le souhaitez, vous pouvez 
        prolonger la cuisson, remplacer le lait par du lait végétal, etc. JavaScript va servir à ce que le site ne soit pas 
        statique et puisse intéragir avec le visiteur, en ouvrant un menu au clic sur un élément, en permettant d'utiliser 
        un bouton pour fermer une pop-up, en exécutant une animation uniquement si un utilisateur fait quelque chose etc.<br>
        Javascript est un peu particulier car il permet même d'aller beaucoup plus loin, et permet par moment de faire des 
        actions ponctuelles qui nécessiteraient un langage back, c'est un langage très puissant et polyvalent.
    </li>
</ul>
</p>


</div>