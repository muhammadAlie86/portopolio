const animatedScrollObserver = new IntersectionObserver(
    (entries, observer) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add("enter-animation");
                observer.unobserve(entry.target);
            }
        });
    }
);

export default {
    mounted(el) {
        el.classList.add("before-animation");
        animatedScrollObserver.observe(el);
    }
}