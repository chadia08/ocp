# Instructions de déploiement - Système MEA STOCK
Ces instructions détaillent les étapes nécessaires pour déployer le projet de système de gestion de stock utilisant Laravel, Largon et MySQL. Assurez-vous de suivre ces instructions pour configurer le projet avec succès sur le serveur de déploiement.

## Prérequis
Avant de commencer le déploiement du projet, assurez-vous de respecter les prérequis suivants:

#### Laragon
Téléchargez Laragon depuis le site officiel : 
        [Lien de téléchargement de Laragon https://laragon.org/download/]

Sélectionnez la version correspondant à votre système d'exploitation (Windows).
Suivez les instructions d'installation fournies sur le site pour installer Laragon sur votre machine.

#### Serveur Web Apache
Laragon inclut le serveur web Apache. Vérifiez que le serveur Apache est en cours d'exécution une fois l'installation de Laragon terminée.

#### PHP
Laragon installe une version de PHP par défaut. Vérifiez que la version de PHP installée est compatible avec Laravel. (Vérifiez les exigences de Laravel pour connaître la version recommandée).
Si nécessaire, vous pouvez changer la version de PHP utilisée par Laragon en cliquant avec le bouton droit de la souris sur l'icône Laragon dans la barre des tâches, en sélectionnant "PHP" et en choisissant la version appropriée.

#### MySQL
Laragon inclut également le système de gestion de base de données MySQL.
Vérifiez que le service MySQL est en cours d'exécution en cliquant avec le bouton droit de la souris sur l'icône Laragon dans la barre des tâches, en sélectionnant "MySQL" et en vérifiant que le service est "Started".

Une fois que vous avez installé Laragon et vérifié que les prérequis sont satisfaits, vous êtes prêt à procéder au déploiement du projet.

## Étapes de déploiement

#### 1.Téléchargement du code source
Pour commencer, vous devez télécharger le code source du projet depuis le référentiel GitHub fourni. Suivez ces étapes :
1.Ouvrez un navigateur web et accédez au référentiel GitHub du projet :

        https://github.com/chadia08/ocp.git.

2.Sur la page du référentiel GitHub, cliquez sur le bouton vert "Code" et sélectionnez l'option "Download ZIP". Cela téléchargera une archive ZIP contenant tout le code source du projet sur votre machine locale.
GitHub Download ZIP

3.Une fois le téléchargement terminé, extrayez le contenu de l'archive ZIP dans le répertoire de votre choix. Vous obtiendrez un répertoire contenant tous les fichiers du projet.
Maintenant que vous avez téléchargé le code source du projet, vous pouvez passer à l'étape suivante pour configurer l'environnement de déploiement.
