# 📄 Spécifications Fonctionnelles : Tags

**Référence Code :** `Tag` (Diagramme de Classes)
**Maquette Cible :** `tags/index.html`

---

## 1. Modèle de Données

Les tags sont des étiquettes transversales optionnelles.

*   **`name`** (String) : Obligatoire (Unique).
    *   *UI Liste :* **Badge #** ou Pillule.
    *   *UI Modale :* Champ Text.
*   **`slug`** (String) : Auto.
*   **`article_count`** (Int - Agrégat) : Nombre d'articles liés.
    *   *UI Liste :* Badge.

---

## 2. Interface de Gestion (`index.html`)

### A. Vue Liste
*   **Type :** Table très compacte.
*   **Colonnes clés :** Nom (Badge), Slug, Compteur.

### B. Actions
*   **Création :** Modale minimaliste (juste le Nom).
*   **Usage :** Création à la volée souvent possible depuis le formulaire Article.
