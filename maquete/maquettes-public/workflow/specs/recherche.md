# 🔍 Spécifications : Recherche & Liste

> **Fichier :** `search.html`
> **Rôle :** Permettre de trouver du contenu via mots-clés ou filtres thématiques.

## 1. Structure de la Page

### A. En-tête de Recherche (Search Header)
*   **Titre :** H1 "Explorer les ressources".
*   **Barre de Recherche (Composant Principal) :**
    *   Input Large avec icône loupe à gauche.
    *   Placeholder : "Rechercher...".
    *   Focus state : Ring bleu.
*   **Filtres (Badges) :**
    *   Liste horizontale de boutons/badges.
    *   État Actif : Fond Bleu clair (`bg-blue-100`), Texte Bleu.
    *   État Inactif : Fond Blanc, Bordure transparente ou grise.
    *   *Valeurs :* Tous, Laravel, PHP, Android, Kotlin.

### B. Grille de Résultats
*   **Layout :** Identique à la page d'accueil (Grid 3 cols).
*   **Comportement :** Liste tous les articles correspondants.
*   **Cards :** Composant `card-article` standard.

## 2. Règles d'Interaction
*   **Filtres :** Au clic sur un badge, la grille se met à jour (simulation ou rechargement).
*   **Input :** La recherche se lance à `Enter` ou au clic sur l'icône loupe (si bouton présent).
*   **Pagination :** (Non visible sur la maquette actuelle, mais implicite pour le dev futures).
