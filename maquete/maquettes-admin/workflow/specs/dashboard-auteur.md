# 📄 Spécifications Fonctionnelles : Dashboard Auteur

**Maquette Cible :** `dashboard-auteur.html`
**Rôle :** Auteur

---

## 1. Vue d'Ensemble (KPIs Personnels)
Affiche uniquement les statistiques liées à l'utilisateur connecté (`me`).

*   **Mes Articles**
    *   *Donnée :* Count(Articles WHERE author_id = me)
    *   *Icône :* `lucide-file-text`
*   **Mes Vues**
    *   *Donnée :* Sum(Article.view_count WHERE author_id = me)
    *   *Icône :* `lucide-eye`

---

## 2. Actions Rapides (Comportement différent)
*   **Bouton Principal (CTA) :** "Écrire un nouvel article".
*   **"Mes derniers brouillons" :** Liste simplifiée de ses propres articles en cours de rédaction.

## 3. Navigation Restreinte
*   Masquage des menus `Utilisateurs`, `Catégories`, `Tags` (selon droits).
*   L'auteur ne voit que ce qui le concerne.
