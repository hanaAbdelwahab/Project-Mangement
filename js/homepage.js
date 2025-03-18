document.addEventListener("DOMContentLoaded", function() {
    const circle = document.querySelector('.circle');
    const line = document.querySelector('.line');
    const circlev = document.querySelector('.circle-v');
    const linev = document.querySelector('.line-v');
    const circleh = document.querySelector('.circle-h');
    const lineh = document.querySelector('.line-h');
    const circleh3 = document.querySelector('.circle-h3');
    const lineh3 = document.querySelector('.line-h3');
    const circlev3 = document.querySelector('.circle-v3');
    const linev3 = document.querySelector('.line-v3');

    function updateCirclePosition() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        const scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        const scrollPercentage = scrollTop / scrollHeight;

        // Horizontal circle movement (for .line)
        const lineWidth = line.offsetWidth;
        const circleWidth = circle.offsetWidth;
        const maxPosition = lineWidth - circleWidth;
        const newPosition = Math.min(scrollPercentage * maxPosition, maxPosition);
        circle.style.left = newPosition + 'px';

        // Vertical circle movement (for .line-v)
        const lineHeightv = linev.offsetHeight * 1.6;
        const maxPositionv = lineHeightv - circlev.offsetHeight;
        const newPositionv = Math.min(scrollPercentage * maxPositionv, maxPositionv);
        circlev.style.top = newPositionv + 'px';

        // Horizontal circle movement (for .line-h)
        const lineHeighth = lineh.offsetWidth * 1.8;
        const maxPositionh = lineWidth - circleh.offsetWidth;
        const newPositionh = Math.max((1 - scrollPercentage) * maxPositionh, 0);
        circleh.style.left = newPositionh + 'px';

        // Horizontal circle movement (for .line-h3)
        const lineWidthh3 = lineh3.offsetWidth; // Use the width of .line-h3
        const maxPositionh3 = lineWidthh3 - circleh3.offsetWidth;
        const newPositionh3 = Math.max((1 - scrollPercentage) * maxPositionh3, 0); // Update circle position based on scroll
        circleh3.style.right = newPositionh3 + 'px'; // Use left instead of right

        // Vertical circle movement (for .line-v3)
        const lineHeightv3 = linev3.offsetHeight;
        const maxPositionv3 = lineHeightv3 - circlev3.offsetHeight;
        const newPositionv3 = Math.min(scrollPercentage * maxPositionv3, maxPositionv3);
        circlev3.style.top = newPositionv3 + 'px';
    }

    // Initial position update
    updateCirclePosition();

    // Update position on scroll
    window.addEventListener('scroll', updateCirclePosition);
});
