document.querySelectorAll('.sidebar nav ul li').forEach(item => {
    item.addEventListener('click', () => {
        const dropdown = item.querySelector('ul');
        if (dropdown) dropdown.classList.toggle('show');
    });
});
