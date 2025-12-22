# Liste et Spécifications des Maquettes Admin

Ce document liste les écrans à produire pour l'interface d'administration, en lien avec les spécifications fonctionnelles et les composants graphiques à utiliser.

### 🔐 Login Admin (`./index.html`)
Page de connexion sécurisée.
*   **Objectif :** Authentification des administrateurs et auteurs.
*   **Specs :** [`specs/login.md`](specs/login.md)
*   **Composants à utiliser :**
    *   `forms/input-group.html` (Email, Mot de passe)
    *   `feedback/alert.html` (Messages d'erreur)

### 📊 Dashboard Admin (`./dashboard-admin.html`)
Vue d'ensemble globale.
*   **Objectif :** Pilotage de la plateforme.
*   **Specs :** [`specs/dashboard-admin.md`](specs/dashboard-admin.md)
*   **Composants à utiliser :**
    *   `layout/sidebar.html`
    *   `layout/navbar.html`
    *   `data/kpi-card.html` (x4 stats)
    *   `widgets/recent-articles.html`
    *   `widgets/activity-list.html`

### 📈 Dashboard Auteur (`./dashboard-auteur.html`)
Espace personnel.
*   **Objectif :** Suivi de ma production.
*   **Specs :** [`specs/dashboard-auteur.md`](specs/dashboard-auteur.md)
*   **Composants à utiliser :**
    *   `layout/sidebar.html`
    *   `layout/navbar.html`
    *   `data/kpi-card.html` (Mes stats)
    *   `widgets/activity-list.html` (Mes activités)

### 📝 Articles - Liste (`./articles/index.html`)
Gestion du contenu.
*   **Objectif :** Lister, filtrer et gérer les statuts des articles.
*   **Specs :** [`specs/articles.md`](specs/articles.md)
*   **Composants à utiliser :**
    *   `layout/sidebar.html`
    *   `layout/navbar.html`
    *   `data/table.html` (Liste avec colonnes Image, Titre, Auteur, Statut, Date)
    *   `data/status-badge.html` (Badge Statut)
    *   `forms/select.html` (Filtres)

### ✍️ Articles - Formulaire (`./articles/form.html`)
Éditeur de contenu.
*   **Objectif :** Création et modification complète d'un article.
*   **Specs :** [`specs/articles.md`](specs/articles.md)
*   **Composants à utiliser :**
    *   `layout/sidebar.html`
    *   `layout/navbar.html`
    *   `forms/input-group.html` (Titre, Slug)
    *   `forms/select.html` (Catégories)
    *   `forms/file-upload.html` (Couverture)
    *   `forms/rich-editor.html` (Contenu)
    *   `feedback/alert.html` (Validation)

### 🏷️ Catégories (`./categories/index.html`)
Gestion de la structure.
*   **Objectif :** CRUD hiérarchique des catégories.
*   **Specs :** [`specs/categories.md`](specs/categories.md)
*   **Composants à utiliser :**
    *   `layout/sidebar.html`
    *   `layout/navbar.html`
    *   `data/table.html`
    *   `feedback/modal.html` (Création/Édition)
    *   `forms/input-group.html` (Dans la modale)

### #️⃣ Tags (`./tags/index.html`)
Gestion des mots-clés.
*   **Objectif :** CRUD simple des étiquettes.
*   **Specs :** [`specs/tags.md`](specs/tags.md)
*   **Composants à utiliser :**
    *   `layout/sidebar.html`
    *   `layout/navbar.html`
    *   `data/table.html`
    *   `feedback/modal.html` (Création/Édition)
    *   `forms/input-group.html` (Dans la modale)

### 👥 Utilisateurs (`./utilisateurs/index.html`)
Gestion des membres.
*   **Objectif :** Liste des inscrits et modération.
*   **Specs :** [`specs/utilisateurs.md`](specs/utilisateurs.md)
*   **Action clé :** Attribution des Rôles (Admin/Auteur).
*   **Composants à utiliser :**
    *   `layout/sidebar.html`
    *   `layout/navbar.html`
    *   `data/table.html`
    *   `data/status-badge.html` (Rôle)
    *   `feedback/modal.html` (Édition Rôle)

# 📂 Architecture des Dossiers

Ce document valide la structure des fichiers à créer pour la Phase 1, en respectant la convention `kebab-case`.

## Arborescence

```bash
maquettes-admin/
│
├── index.html              # 🔐 Connexion 
├── dashboard-admin.html    # 📊 Dashboard Administrateur
├── dashboard-auteur.html   # 📊 Dashboard Auteur
│
├── articles/               # 📝 Gestion Articles
│   ├── index.html          # Liste des articles
│   └── form.html           # Création / Édition
│
├── categories/             # 🏷️ Gestion Catégories
│   └── index.html          # Liste + Modale
│
├── tags/                   # #️⃣ Gestion Tags
│   └── index.html          # Liste + Modale
│
├── utilisateurs/           # 👥 Gestion Utilisateurs
│   └── index.html          # Liste + Modale Rôle
│
└── assets/                 # Ressources statiques
    ├── css/
    │   └── style.css       # Styles personnalisés (si besoin)
    ├── js/
    │   └── script.js       # Scripts globaux
    └── img/
        └── logo.svg        # Logos et placeholders
```

## Conventions
*   **Dossiers :** Pluriel (`articles`, `categories`).
*   **Fichiers Liste :** Toujours `index.html`.
*   **Fichiers Formulaire :** `form.html` (ou `create.html`/`edit.html` si distincts, mais ici unifié).
*   **Noms :** Tout en minuscule, séparé par des tirets (`kebab-case`).
