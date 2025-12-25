import './bootstrap';
import "preline";
import { createIcons, icons } from "lucide";
import './form.js';

const initLucide = () => {
    createIcons({ icons });
};

window.createLucideIcons = initLucide;

document.addEventListener("DOMContentLoaded", () => {
    initLucide();

    document.addEventListener("preline:ready", initLucide);
});