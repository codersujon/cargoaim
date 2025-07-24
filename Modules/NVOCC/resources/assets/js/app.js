document.addEventListener("DOMContentLoaded", () => {
    const tabLinks = document.querySelectorAll(".tab-link");
    const tabContents = document.querySelectorAll(".tab-content");
    const indicator = document.querySelector(".tab-indicator");

    function activateTab(tabBtn) {
        const tabId = tabBtn.dataset.tab;

        // Remove all active classes
        tabLinks.forEach(btn => {
            btn.classList.remove("active");
            // ✅ Remove this line ↓
            // btn.style.background = "none";
        });
        tabContents.forEach(content => content.classList.remove("active"));

        // Add active classes
        tabBtn.classList.add("active");
        document.getElementById(tabId)?.classList.add("active");

        // Move tab indicator
        indicator.style.width = `${tabBtn.offsetWidth}px`;
        indicator.style.left = `${tabBtn.offsetLeft}px`;
    }

    // Attach click events
    tabLinks.forEach(tab => {
        tab.addEventListener("click", () => activateTab(tab));
    });

    // Initial activation
    const initial = document.querySelector(".tab-link.active") || tabLinks[0];
    if (initial) activateTab(initial);
});

