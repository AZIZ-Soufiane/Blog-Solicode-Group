# 📄 Spécifications Fonctionnelles : Articles

**Référence Code :** `Article` (Diagramme de Classes)
**Maquettes Cibles :** `articles/index.html`, `articles/form.html`

---

## 1. Modèle de Données (Champs)

### Identifiants
*   **`slug`** (String) : Unique. Auto-généré depuis le titre.
    *   *UI Form :* Champ text (Editable).
    *   *UI Liste :* Non affiché.

### Contenu Principal
*   **`title`** (String) : Obligatoire (Max 255).
    *   *UI Form :* Input Text principal.
    *   *UI Liste :* Affiché en **Gras**.
*   **`content`** (Text) : Contenu de l'article.
    *   *UI Form :* Éditeur Riche (**WYSIWYG**).
*   **`image`** (String) : URL ou chemin du fichier.
    *   *UI Form :* Zone d'upload (Drag & Drop).
    *   *UI Liste :* Miniature (Avatar carré ou rond).

### Métadonnées & Statuts
*   **`status`** (Enum : `DRAFT`, `PUBLISHED`, `ARCHIVED`)
    *   *UI Form :* Boutons d'action ou Select.
    *   *UI Liste :* **Badge** coloré (Gris: Brouillon, Vert: Publié, Rouge: Archivé).
*   **`view_count`** (Integer) : Compteur de vues (Défaut: 0).
    *   *UI Liste :* Badge discret ou icône `lucide-eye`.
*   **`is_featured`** (Boolean) : Mis en avant (Défaut: False).
    *   *UI Form :* Toggle Switch.
    *   *UI Liste :* Icône `lucide-star` (plein) si actif.
*   **`created_at`** (DateTime) : Date de création.
    *   *UI Liste :* Format `JJ/MM/AAAA`.

---

## 2. Règles d'Interface

### A. Liste (`index.html`)
*   **Filtres obligatoires :**
    *   Recherche par Titre.
    *   Filtre par **Catégorie** (Relation `Category`).
    *   Filtre par **Statut**.
*   **Ordre par défaut :** Plus récent (`created_at` DESC).

### B. Formulaire (`form.html`)
*   **Layout :**
    *   **Zone Principale (Gauche) :** Titre, Slug, Content.
    *   **Sidebar (Droite) :**
        *   **Publication :** Statut, Date.
        *   **Taxonomie :** Select Catégorie (Obligatoire), Select Tags (Multiple).
        *   **Médias :** Image à la une.
        *   **Options :** Toggle "A la une" (`is_featured`).

---

## 3. Comportements Spéciaux
*   **Suppression :** Confirmation modale requise ("Êtes-vous sûr ?").
*   **Slug :** Doit se mettre à jour en JS si on change le titre (sauf si l'article est déjà publié).
