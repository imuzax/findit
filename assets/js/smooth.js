document.addEventListener('DOMContentLoaded', () => {
    // Setup Intersection Observer for smooth reveal animations
    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.1
    };

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
                observer.unobserve(entry.target); // Reveal only once
            }
        });
    }, observerOptions);

    // Grab elements that should be animated. 
    // We target large layout blocks, text blocks, and grid items from Tailwind generated DOM.
    const blocksToReveal = document.querySelectorAll(`
        section > div, 
        .grid > div, 
        form, 
        main > div
    `);

    blocksToReveal.forEach((block, index) => {
        // We only add reveal to larger blocks, to avoid animating tiny elements weirdly
        if(block.clientHeight > 20) {
            block.classList.add('reveal');
            
            // Stagger items in a grid slightly
            const delay = (index % 5) * 0.1;
            block.style.transitionDelay = `${delay}s`;
            
            observer.observe(block);
        }
    });
});
