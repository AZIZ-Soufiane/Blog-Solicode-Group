# 📖 Spécifications : Détail Article

> **Fichier :** `article.html`
> **Rôle :** Page de lecture immersive. Doit être lisible et inciter à l'interaction.

## 1. Structure de la Page

### A. En-tête de l'Article (Header)
*   **Breadcrumb/Badge :** Catégorie (ex: "Dev Web") en haut à gauche.
*   **Titre :** H1 Large (3xl-5xl).
*   **Méta-données (Author Block) :**
    *   Avatar Auteur (Rond).
    *   Nom Auteur.
    *   Date de publication & Temps de lecture estimé.

### B. Média (Cover)
*   **Image :** Grande largeur, coins arrondis (`rounded-xl`), ombre légère.
*   **Légende :** (Optionnel) Texte gris sous l'image.

### C. Corps du Texte (Content)
*   **Typographie :** Utilisation du plugin standard `prose` (Tailwind Typography).
*   **Styles supportés :**
    *   Paragraphes (Texte gris foncé `text-gray-700`).
    *   Titres H2, H3.
    *   Blockquotes (Citations).
    *   Code Blocks (`<pre><code>`).
    *   Listes à puces.

### D. Pied de l'Article
*   **Tags :** Liste horizontale de badges gris (`#Laravel`, `#Backend`).

### E. Zone Commentaires (`comment-section.html`)
*   **Titre :** H3 "Commentaires (N)".
*   **Formulaire :**
    *   Textarea ("Votre avis...").
    *   Bouton "Publier" (Aligné à droite).
*   **Liste :**
    *   Avatar, Nom, Date (ex: "Il y a 2 heures").
    *   Contenu du commentaire.
    *   Réponses (Indentation/Encadré gris pour la réponse de l'auteur).

## 2. Règles d'Interaction
*   **Images :** Doivent être responsive et garder le ratio.
*   **Formulaire Commentaire :** Bouton désactivé si champ vide (optionnel).
*   **Liens Tags :** Clic sur un Tag -> Redirige vers `search.html?tag=XYZ`.
