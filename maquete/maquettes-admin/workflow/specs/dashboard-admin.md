# 📄 Spécifications Fonctionnelles : Dashboard Admin

**Maquette Cible :** `dashboard-admin.html`
**Rôle :** Administrateur uniquement

---

## 1. Vue d'Ensemble (KPIs)
Affiche les statistiques globales de la plateforme.

*   **Total Articles**
    *   *Donnée :* Count(Articles)
    *   *Icône :* `lucide-file-text`
*   **Total Vues**
    *   *Donnée :* Sum(Article.view_count)
    *   *Icône :* `lucide-eye`
*   **Utilisateurs**
    *   *Donnée :* Count(Users)
    *   *Icône :* `lucide-users`
*   **Commentaires** (Optionnel MVP)
    *   *Donnée :* Count(Comments)
    *   *Icône :* `lucide-message-square`

---

## 2. Widgets d'Activité
*   **"Derniers Articles" :** Tableau simplifié (Top 5).
    *   Colonnes : Titre, Auteur, Date, Statut.
    *   Clic : Redirige vers la validation.

## 3. Navigation
*   Accès complet à toutes les entrées de la Sidebar (Articles, Users, Categories, Tags).
