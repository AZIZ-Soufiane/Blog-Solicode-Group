# 📄 Spécifications Fonctionnelles : Authentification (Login)

**Référence Code :** `User` (Table)
**Maquette Cible :** `login.html` (ou `index.html`)

---

## 1. Modèle & Règles

*   **`email`** (String) : Obligatoire + Format Email
    *   *UI :* Input avec icône `lucide-mail` ou `lucide-at-sign`
*   **`password`** (String) : Obligatoire (Min 8 chars)
    *   *UI :* Input type="password" avec bouton toggle (`lucide-eye` / `lucide-eye-off`)
*   **`remember_me`** (Boolean) : Optionnel
    *   *UI :* Checkbox "Se souvenir de moi"

---

## 2. Règles d'Interface

### Layout
*   **Centré :** Carte (Card) centrée verticalement et horizontalement sur l'écran.
*   **Design :** Logo Solicode au-dessus ou à gauche (Split screen).

### Actions
*   **Se connecter (Submit) :**
    *   *Succès :* Redirection vers `dashboard.html`.
    *   *Erreur :* Message alerte rouge ("Email ou mot de passe incorrect").
*   **Mot de passe oublié :** Lien simple vers une page "Reset Password" (hors scope immédiat, lien mort ou modale).

---

## 3. Sécurité (Rappel)
*   Aucun mot de passe en clair.
*   Protection CSRF.
