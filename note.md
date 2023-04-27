////////////// Symfony encore, utilisatin du javascript de maniere dynamique avec WEBPACK ////////////////
Webpack : est un framwork qui nous  permet de modulariser notre code (cender le code en morceau qu'on peut require comme en php), et a la fin lors de l'integration des fichier dans le DOM il les compressent pour en faire qu'un seul fichier JS.
le system de Webpack est similariser dans symfony avec le module <Symfony-webpack-concore>.
- il va generer des dossiers et fichiers.
= /assets => est le dossier qui contiendra les sources JS et CSS
= webpack.config.js => contient la configuration de webpack
= /build => lorsqu'il va generer les fichiers compresser js et css il seront stocker a l'interieur
= /build/manifest.json => contient les chemin pour require les fichier compresser app.js et app.css et creer des chemins absolu qui vont etre utiliser dans lors de la rendu vue twig.

- pour lancer le server webpack apres avoir intaller les dependence: npm install 
- command: npm run dev-server

- ajouter select2 pour les input de type select avec: npm install select2
- puis on le require selement dans <asset/app.js> et il sera automatiquement charger dans le DOM

## NB: une error s'affichera dans webpack disant qu'il ne connait pas Jquery
- pour resoudre le probleme on utilise les externals qui permet de defire une variable global, en modifiant un peu le
fichier webpack.config.js ensuite redemarer webpack

----------------------------------------------------------------------------------------
                            note creation du site peintre
-----------------------------------------------------------------------------------------

- dans ce projet on a pas envoyer directement les mail, mais on les a enregistrer dans la DB pour les envoyer automatiquement apres avec un script, cela permet de ne pas envoyer directement le mail des que le user envoyer le form-concat et aussi pour que les donnees soient pas perdu.

# NB:
la command creer est le script qui permetra d'envoyer les mail au users, la command exteds a un objet de symfony.

--------------------------
# php bin/phpunit --coverage-html test-coverage:
# NB: il ne faut specifier de chemin just ecrire le nom du directory
cette command nous permet de generer un rapport detailler des tests sous format html qui peut etre
ouvert dans le nagivateur pour etre visioner.
ce rapport nous permet de savoir quels sont les parties du code qui sont sous soumit au test unitaire ou pas pour ameliorer les tests.


















