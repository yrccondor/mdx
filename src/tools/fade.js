export default (doms, direction, duration) => {
    for (let i = 0; i < doms.length; i++) {
        let dom = doms[i];
        if (direction === 'in') {
            dom.style.opacity = '0';
            dom.style.display = 'block';
            dom.style.transition = `opacity ${duration / 1000}s`;
            setTimeout(() => {
                dom.style.opacity = '1';
            }, 0);
            setTimeout(() => {
                dom.style.display = 'block';
                dom.style.transition = '';
                dom.style.opacity = '1';
            }, duration);
        } else {
            dom.style.opacity = '1';
            dom.style.display = 'block';
            dom.style.transition = `opacity ${duration / 1000}s`;
            dom.style.opacity = '0';
            setTimeout(() => {
                dom.style.display = 'none';
                dom.style.transition = '';
                dom.style.opacity = '0';
            }, duration);
        }
    };
}