document.addEventListener('DOMContentLoaded', () => {
    const blocks = document.querySelectorAll('.simple-banner');

    blocks.forEach(block => {
        block.addEventListener('click', () => {
            block.classList.toggle('active');
        });
    });
});