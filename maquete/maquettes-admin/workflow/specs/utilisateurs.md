# 📄 Spécifications Fonctionnelles : Utilisateurs

**Référence Code :** `User` (Diagramme de Classes)
**Maquette Cible :** `utilisateurs/index.html`

---

## 1. Modèle de Données (Champs)

*   **`avatar`** (String/Url) : Optionnel.
    *   *UI Liste :* **Image Ronde** (40x40px) ou Initiale.
*   **`name`** (String) : Obligatoire.
    *   *UI Liste :* **Gras**.
*   **`email`** (String) : Unique + Format Email.
    *   *UI Liste :* En gris, sous le nom ou colonne dédiée.
*   **`role`** (Relation) : `ADMIN`, `AUTHOR`, `USER`.
    *   *UI Liste :* **Badge** (Rouge: Admin, Bleu: Auteur, Gris: User).
*   **`bio`** (Text) : Optionnel.
    *   *UI Liste :* Non affiché (Visible en fiche détail uniquement).
*   **`created_at`** (DateTime) : Date d'inscription.
    *   *UI Liste :* "Inscrit le..."

---

## 2. Règles d'Interface & Actions

### A. Liste (`index.html`)
*   **Affichage :** Table classique.
*   **Filtres :** Recherche par Nom/Email.
*   **Pas de création :** L'admin ne crée pas de comptes manuellement (inscription front-office).

### B. Gestion des Rôles (Feature Clé)
*   **Mécanisme :**
    *   Soit une **Modale** "Changer le rôle".
    *   Soit un **Select direct** dans la ligne du tableau (ex: Flowbite Dropdown).
*   **Règles :**
    *   Un Admin ne peut pas se rétrograder lui-même (sécurité).
    *   Le changement de rôle doit être confirmé.

---

## 3. Sécurité
*   Les mots de passe ne sont JAMAIS affichés.
*   Suppression d'utilisateur = **Soft Delete** (désactivation) recommandé, ou suppression avec confirmation forte.
