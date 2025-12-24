import './bootstrap';

import "preline";
import { createIcons, icons } from "lucide";

// --- Lucide Icons ---
const initLucide = () => {
    createIcons({ icons });
};

// Expose globally if needed
window.createLucideIcons = initLucide;

// --- DOMContentLoaded ---
document.addEventListener("DOMContentLoaded", () => {
    initLucide(); // Icons on page load

    // Re-init icons when Preline loads dynamic components
    document.addEventListener("preline:ready", initLucide);
});