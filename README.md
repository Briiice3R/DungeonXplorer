# DungeonXplorer

Projet du BUT Informatiquen R3.01 Web 

## 📋 Prérequis

Avant de commencer, assurez-vous d'avoir installé :

* **PHP** (v7.4 ou supérieur recommandé)
* **Composer** (Gestionnaire de dépendances)
* **Git**

## 🚀 Installation

Voici les étapes pour récupérer le projet et installer les dépendances :

### 1. Cloner le dépôt
Récupérez les fichiers sources sur votre machine :

```bash
git clone https://github.com/Briiice3R/DungeonXplorer.git
cd DungeonXplorer
```

### 2. Installer les dépendances
C'est l'étape la plus importante. Elle va lire le fichier `composer.json`, installer **bramus/router** et générer l'autoloader pour le dossier `app/`.

```bash
composer install
```

> **Note :** Un dossier `vendor/` va être créé. Ne le modifiez jamais manuellement.

## 🏃‍♂️ Lancement

Pour lancer le projet rapidement sans configurer Apache ou Nginx, vous pouvez utiliser le serveur interne de PHP.

### Lancer le serveur
Exécutez cette commande à la racine du projet :

```bash
php -S localhost:8000
```

### Accéder au projet
Ouvrez votre navigateur et allez sur :
[http://localhost:8000](http://localhost:8000)

## 📁 Structure

* `app/` : Contient les classes du projet (Namespace `App\`).
* `vendor/` : Contient les librairies tierces (Bramus Router, etc.).
* `index.php` : Contient la gestion des routes.
* `composer.json` : Configuration des dépendances.
