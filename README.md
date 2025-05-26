# Origin - Projet de fin de formation Développeur Web Full-Stack

Ce projet est un site de recrutement pour une guilde de joueurs de World of Warcraft de haut niveau

## 🚀 Installation

1. **Clonez le dépôt :**

git clone https://github.com/Nicolas-Fa/origin-site.git

2. **Configurez la base de données sur votre serveur local :**

Importez le fichier origin.sql dans votre base de données

3. **Installer les dépendances :**

Installer Composer -npm init -composer install

4. **Créez un fichier .env à la racine de votre projet et ajoutez y les variables nécessaires :**

DB_NAME="" : le nom de votre base de données
DB_HOST="" : l'adresse de l'hôte de votre base de données
DB_PWD="" : le mot de passe utilisé pour vous connecter à votre base de données
DB_LOGIN="" : l'identifiant utilisé pour vous connecter à votre base de données

5. **Enregistrez vous pour utiliser l'API Blizzard :**

Rendez-vous sur https://develop.battle.net/access/clients afin d'y créer un compte et un client :
![alt text](image.png)

Vous y récupèrerez votre "Client ID" et "Client Secret", ces informations sont à renseigner dans le fichier /public/js/vars.js

6. **Créez un compte Admin dans votre serveur local :**

Allez sur la page d'inscription et renseignez les champs :
Pseudo : le pseudo qui apparaîtra 
email : votre adresse mail, utilisée pour vous connecter par la suite au site
mot de passe

Allez sur votre serveur local (XAMPP ou autre) puis modifiez votre rôle en "Admin" directement dans la base de données

7. **Gestion des rôles :**

Un utilisateur connecté a le rôle "Membre"
Un utilisateur connecté dont la candidature a été validée a son rôle qui passe de "Membre" à "Titan"
Un utilisateur connecté peut devenir "Moderateur", cela se fait via un entretien vocal.

Les modérateurs sont des managers de la communauté, le rôle est donc à distribuer avec parcimonie.
