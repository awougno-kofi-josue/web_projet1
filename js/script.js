document.addEventListener("DOMContentLoaded", () => {
        const toggle = document.getElementById("menu-toggle");
        const nav = document.getElementById("main-nav");

        toggle.addEventListener("click", () => {
        nav.classList.toggle("show");
    });
});

function toggleForm(id) {
    const form = document.getElementById("form_" + id);
    form.style.display = form.style.display === "none" ? "block" : "none";
}
document.getElementById('tb').addEventListener("click", () => {
    const el = document.getElementById("repos");

    // toggle display
    if (el.style.display === "block") {
        el.style.display = "none";
    } else {
        el.style.display = "block";
    }
});