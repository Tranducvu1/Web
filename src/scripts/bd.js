document.addEventListener('DOMContentLoaded', function() {
    const bgElement = document.querySelector('.container');

    window.addEventListener('scroll', function() {
        const container = document.querySelector('.container');
        const containerRect = container.getBoundingClientRect();
        
        if (containerRect.top < window.innerHeight && containerRect.bottom >= 0) {
            bgElement.classList.add('l');
        } else {
            bgElement.classList.remove('l');
        }
    });
});
