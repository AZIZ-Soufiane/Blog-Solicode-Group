import './bootstrap';
import "preline";
import { createIcons, icons } from "lucide";
import './form.js';

import { initScrollToTop } from './scroll-to-top.js';

const initLucide = () => {
    createIcons({ icons });
};

window.createLucideIcons = initLucide;

document.addEventListener("DOMContentLoaded", () => {
    initLucide();
    initScrollToTop();

    // Re-init icons when Preline updates DOM (e.g. tabs, accordion)
    document.addEventListener("preline:ready", initLucide);

    // Navbar Categories Dropdown Logic
    const dropdownBtn = document.getElementById('categoriesDropdownBtn');
    const dropdown = document.getElementById('categoriesDropdown');
    const chevron = document.getElementById('categoriesChevron');

    if (dropdownBtn && dropdown) {
        // Toggle on click
        dropdownBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            const isHidden = dropdown.classList.contains('hidden');

            if (isHidden) {
                dropdown.classList.remove('hidden');
                if (chevron) chevron.classList.add('rotate-180');
            } else {
                dropdown.classList.add('hidden');
                if (chevron) chevron.classList.remove('rotate-180');
            }
        });

        // Close on click outside
        document.addEventListener('click', function (e) {
            if (!dropdown.contains(e.target) && !dropdownBtn.contains(e.target)) {
                if (!dropdown.classList.contains('hidden')) {
                    dropdown.classList.add('hidden');
                    if (chevron) chevron.classList.remove('rotate-180');
                }
            }
        });

        // Close on Escape key
        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && !dropdown.classList.contains('hidden')) {
                dropdown.classList.add('hidden');
                if (chevron) chevron.classList.remove('rotate-180');
            }
        });
    }

    // Mobile Navbar Toggle Logic
    const navToggle = document.getElementById('navbar-toggle');
    const navCollapse = document.getElementById('navbar-collapse');

    if (navToggle && navCollapse) {
        navToggle.addEventListener('click', function () {
            navCollapse.classList.toggle('hidden');

            // Toggle hamburger/close icons inside the button
            const svgs = navToggle.querySelectorAll('svg');
            svgs.forEach(svg => svg.classList.toggle('hidden'));
        });
    }
});
