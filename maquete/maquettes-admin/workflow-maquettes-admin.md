# 🎨 Maquettes Admin (Back-Office)

Ce dossier contient les ressources et le code source des interfaces pour le Back-Office du projet Solicode.

## 🛠️ Stack Technique
*   **Structure :** HTML5 Semantique.
*   **Style :** Tailwind CSS (Load Via CDN pour le prototypage).
*   **UI Kit :** [Preline UI](https://preline.co/) (Composants modernes et accessibles).
*   **Interactivité :** Vanilla JS (Minimaliste).

## 📅 Méthodologie de Création

Nous suivons une approche modulaire pour garantir la cohérence du design :

1.  **Phase 1 : Identification & Architecture**
    *   Liste macro des écrans cibles dans [`maquettes-admin.md`](./maquettes-admin.md).
    *   Validation de la structure de fichiers (Arborescence).

2.  **Phase 2 : Spécifications Détaillées**
    *   **Règle d'Or :** Une fiche technique pour **CHAQUE** maquette ou module (Login, Dashboard, Articles...).
    *   **Contenu :** Liste exhaustive des champs, règles de validation, états visuels et interactions.

3.  **Phase 3 : Composants (Design System)**
    *   Inventaire des briques UI réutilisables dans [`composants-admin.md`](./composants-admin.md).
    *   Développement unitaire des composants (Sidebar, Navbar, Tables).

4.  **Phase 4 : Intégration (Pages)**
    *   Assemblage des composants pour construire les écrans finaux.
    *   Respect strict des champs définis en Phase 2.
