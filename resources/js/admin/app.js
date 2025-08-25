import '../bootstrap';

// dashboard-user-dropdows
document.addEventListener('click', function(event) {
    const dropdowns = document.querySelectorAll('.relative.inline-block');
    dropdowns.forEach(dropdown => {
        const button = dropdown.querySelector('button');
        const menu = dropdown.querySelector('div[role="menu"]');
        if (!dropdown.contains(event.target)) {
            menu.classList.add('hidden');
        }
    });
});
