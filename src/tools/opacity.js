export default class Opacity {
    constructor(dom, to, duration) {
        this.dom = dom;
        if (this.dom === null) {
            return;
        }
        this.from = parseFloat(window.getComputedStyle(this.dom, null).getPropertyValue('opacity'));
        this.to = to;
        this.duration = duration;
        this.startTime = -1;

        this.start();
    }
    start() {
        if (this.startTime < 0) {
            this.startTime = Date.now();
        }
        const currentTime = Date.now() - this.startTime;

        if (this.dom === null) {
            return;
        }

        if (currentTime >= this.duration) {
            this.dom.style.opacity = this.to;
            return;
        }
        this.dom.style.opacity = `${this.from + (this.to - this.from) * (currentTime / this.duration)}`;

        requestAnimationFrame(this.start.bind(this));
    }
}