# 📄 Spécifications Fonctionnelles : Catégories

**Référence Code :** `Category` (Diagramme de Classes)
**Maquette Cible :** `categories/index.html`

---

## 1. Modèle de Données

Les catégories sont la structure hiérarchique principale du site.

*   **`name`** (String) : Obligatoire (Unique).
    *   *UI Liste :* **Gras**.
    *   *UI Modale :* Champ Text.
*   **`slug`** (String) : Auto-généré depuis le Nom.
    *   *UI Liste :* Affiché en `code-gris`.
*   **`description`** (String) : Optionnel.
    *   *UI Liste :* Texte tronqué...
    *   *UI Modale :* Textarea.
*   **`image`** (String) : Optionnel.
    *   *UI Liste :* Avatar rond.
    *   *UI Modale :* Upload Zone.
*   **`article_count`** (Int - Agrégat) : Nombre d'articles liés.
    *   *UI Liste :* Badge (ex: "12").
*   **`created_at`** (DateTime) : Date de création.
    *   *UI Liste :* Format court.

---

## 2. Interface de Gestion (`index.html`)

### A. Vue Liste
*   **Type :** Liste simple (ou tableau).
*   **Colonnes clés :** Image, Nom, Slug, Compteur Articles.

### B. Actions
*   **Création :** Bouton "Nouvelle Catégorie" -> Ouvre une **Modale**.
*   **Édition :** Modale pré-remplie.
*   **Suppression :** Interdit si la catégorie contient des articles (ou demande de réaffectation).
