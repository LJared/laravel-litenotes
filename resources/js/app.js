import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Get both the light and dark toggle icons
var themeToggleDarkIcon = document.getElementById("theme-toggle-dark-icon");
var themeToggleLightIcon = document.getElementById("theme-toggle-light-icon");

// Apply the correct theme when the page loads.
// If the user has set a preferred theme in localStorage, use that. Otherwise, use the OS preference.
if (localStorage.getItem("color-theme") === "dark") {
    document.documentElement.classList.add("dark");
    themeToggleLightIcon.classList.remove("hidden");
} else if (localStorage.getItem("color-theme") === "light") {
    document.documentElement.classList.remove("dark");
    themeToggleDarkIcon.classList.remove("hidden");
} else if (window.matchMedia("(prefers-color-scheme: dark)").matches) {
    // If no preference is stored, use the system's default theme
    document.documentElement.classList.add("dark");
    themeToggleLightIcon.classList.remove("hidden");
} else {
    document.documentElement.classList.remove("dark");
    themeToggleDarkIcon.classList.remove("hidden");
}

var themeToggleBtn = document.getElementById("theme-toggle");

themeToggleBtn.addEventListener("click", function () {
    // Toggle icons
    themeToggleDarkIcon.classList.toggle("hidden");
    themeToggleLightIcon.classList.toggle("hidden");

    // Switch the theme and save the current preference
    if (document.documentElement.classList.contains("dark")) {
        document.documentElement.classList.remove("dark");
        localStorage.setItem("color-theme", "light");
    } else {
        document.documentElement.classList.add("dark");
        localStorage.setItem("color-theme", "dark");
    }
});