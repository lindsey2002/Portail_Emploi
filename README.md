# 🚀 Librisky Jobs — Portail d'Emploi

> Application web de mise en relation entre recruteurs et candidats, développée avec Laravel 11.

---

## 📋 Sommaire

- [Présentation](#présentation)
- [Fonctionnalités](#fonctionnalités)
- [Stack technique](#stack-technique)
- [Installation](#installation)
- [Configuration](#configuration)
- [Structure du projet](#structure-du-projet)
- [Rôles utilisateurs](#rôles-utilisateurs)
- [Base de données](#base-de-données)
- [Captures d'écran](#captures-décran)
- [Auteur](#auteur)

---

## 📌 Présentation

**Librisky Jobs** est un portail d'emploi complet permettant à des **recruteurs** de publier des offres d'emploi et à des **candidats** de postuler en déposant leur CV (PDF) accompagné d'une lettre de motivation.

L'application gère l'intégralité du cycle de recrutement :
- Publication et gestion des offres
- Dépôt de candidatures avec CV PDF
- Calcul automatique d'un **score de matching** entre le profil du candidat et le poste
- Suivi du statut des candidatures (En cours / Accepté / Refusé)
- Notification par e-mail lors d'un changement de statut

---

## ✅ Fonctionnalités

### Côté Recruteur
- Créer un compte avec le rôle `recruiter`
- Publier des offres d'emploi (titre, entreprise, lieu, contrat, salaire, description)
- Consulter la liste des candidats par offre
- Visualiser le CV PDF de chaque candidat directement dans le navigateur
- Lire la lettre de motivation du candidat
- **Accepter ou refuser** une candidature en un clic
- Retirer une candidature de la liste

### Côté Candidat
- Créer un compte avec le rôle `candidate`
- Parcourir toutes les offres d'emploi disponibles
- Postuler à une offre en déposant son **CV au format PDF** (max 2 Mo)
- Rédiger une lettre de motivation optionnelle
- Suivre le **statut de ses candidatures** en temps réel (En cours / Accepté / Refusé)
- Recevoir une **notification e-mail** lors d'une décision du recruteur
- Annuler ou masquer une candidature

### Système de Matching
- Un **score de compatibilité** est calculé automatiquement à la soumission d'une candidature
- Le score est basé sur la correspondance entre les mots-clés du poste et le contenu de la lettre de motivation
- Affichage coloré du score : 🟢 Profil idéal (≥70%) · 🟡 Profil moyen (≥40%) · 🔴 Faible correspondance (<40%)

---

## 🛠 Stack technique

| Couche | Technologie |
|---|---|
| Backend | PHP 8.2 · Laravel 11 |
| Frontend | Blade · Tailwind CSS · CSS personnalisé |
| Base de données | MySQL |
| Authentification | Laravel Breeze |
| Stockage fichiers | Laravel Storage (local/public) |
| Envoi d'e-mails | Laravel Mail (SMTP) |
| Typo | Syne · Instrument Sans (Bunny Fonts) |

---

## ⚙️ Installation

### Prérequis

- PHP >= 8.2
- Composer
- Node.js >= 18 & npm
- MySQL
- Git

### Étapes

**1. Cloner le dépôt**
```bash
git clone https://github.com/votre-username/portail-emploi.git
cd portail-emploi
```

**2. Installer les dépendances PHP**
```bash
composer install
```

**3. Installer les dépendances JS**
```bash
npm install && npm run build
```

**4. Copier le fichier d'environnement**
```bash
cp .env.example .env
```

**5. Générer la clé d'application**
```bash
php artisan key:generate
```

**6. Configurer la base de données** (voir section suivante)

**7. Lancer les migrations**
```bash
php artisan migrate
```

**8. Créer le lien symbolique pour le stockage**
```bash
php artisan storage:link
```

**9. Démarrer le serveur de développement**
```bash
php artisan serve
```

L'application est accessible sur `http://localhost:8000`

---

## 🔧 Configuration

Ouvrez le fichier `.env` et renseignez les valeurs suivantes :

### Base de données
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=portail_emploi
DB_USERNAME=root
DB_PASSWORD=
```

### Envoi d'e-mails (SMTP)
```env
MAIL_MAILER=log
MAIL_SCHEME=null
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

> 💡 En développement, vous pouvez utiliser [Mailtrap](https://mailtrap.io) pour intercepter les e-mails sans les envoyer réellement.

### Après toute modification du `.env`
```bash
php artisan config:clear
php artisan cache:clear
```

---

## 📁 Structure du projet

```
portail-emploi/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── ApplicationController.php   # Gestion des candidatures
            ├── Controller.php              # Gestion des 
│   │       ├── ProfileController.php       # Tableau de bord (recruteur & candidat)
│   │       └── OfferController.php         # Gestion des offres
│   ├── Mail/
│   │   └── ApplicationStatusUpdated.php   # E-mail de notification
│   └── Models/
│       ├── Application.php                 # Modèle candidature
│       ├── Offer.php                       # Modèle offre d'emploi
│       └── User.php                        # Modèle utilisateur (avec rôle)
│
├── database/
│   └── migrations/
│       ├── ..._create_users_table.php
│       ├── ..._create_offers_table.php
│       ├── ..._create_applications_table.php
│       ├── ..._add_match_score_to_applications_table.php
│       └── ..._add_status_to_applications_table.php
│
├── resources/
│   └── views/
│       ├── welcome.blade.php               # Page d'accueil publique
│       ├── dashboard.blade.php             # Tableau de bord (2 espaces)
│       ├── offers/
│       │   ├── create.blade.php            # Formulaire publication offre
│       │   └── applications.blade.php      # Liste des candidats d'une offre
│       └── applications/
│           └── create.blade.php            # Formulaire de candidature
│
├── routes/
│   └── web.php                             # Toutes les routes de l'application
│
└── storage/
    └── app/public/resumes/                 # CV PDF uploadés par les candidats
```

---

## 👥 Rôles utilisateurs

L'application distingue deux rôles définis dans la colonne `role` de la table `users` :

| Rôle | Valeur | Accès |
|---|---|---|
| Recruteur | `recruiter` | Publier des offres, gérer les candidatures |
| Candidat | `candidate` | Parcourir les offres, postuler, suivre ses candidatures |

> Le rôle est choisi à l'inscription et conditionne l'affichage du tableau de bord.

---

## 🗄 Base de données

### Table `users`
| Colonne | Type | Description |
|---|---|---|
| id | bigint | Clé primaire |
| name | string | Nom complet |
| email | string | Adresse e-mail (unique) |
| password | string | Mot de passe hashé |
| role | string | `recruiter` ou `candidate` |

### Table `offers`
| Colonne | Type | Description |
|---|---|---|
| id | bigint | Clé primaire |
| user_id | FK | Recruteur propriétaire |
| title | string | Intitulé du poste |
| company_name | string | Nom de l'entreprise |
| location | string | Lieu du poste |
| contract_type | string | CDI, CDD, Stage, Alternance... |
| salary | string | Rémunération (optionnel) |
| description | text | Description du poste |

### Table `applications`
| Colonne | Type | Description |
|---|---|---|
| id | bigint | Clé primaire |
| offer_id | FK | Offre concernée |
| user_id | FK | Candidat |
| cover_letter | text | Lettre de motivation (optionnel) |
| resume_path | string | Chemin vers le CV PDF |
| match_score | integer | Score de matching (0–100) |
| status | string | `en cours`, `accepte`, `refuse` |

---

## 📸 Captures d'écran

| Page | Description |
|---|---|
| `/` | Page d'accueil avec barre de recherche et offres simulées |
| `/dashboard` | Tableau de bord adapté au rôle connecté |
| `/offers/create` | Formulaire de publication d'une offre (recruteur) |
| `/offers/{id}/applications` | Liste des candidats pour une offre |
| `/applications/{id}/create` | Formulaire de candidature avec dépôt CV |

---

## 👤 Auteur

**Projet réalisé dans le cadre d'un devoir de licence**

- Développeur : *Heredia Koumba*
- Année : 2026
- Framework : Laravel 11
- Institution : *ISI SUPTECH*

---

> *"Librisky Jobs — connecter les talents aux opportunités."*