export default class ScrollTo {
    constructor(dom) {
        this.dom = dom;
        if (this.dom === null) {
            return;
        }
        this.destination = this.scrollTop;
        this.duration = 0;
        this.startTime = -1;
    }
    to(destination, duration) {
        if (this.dom === null) {
            return;
        }
        this.destination = destination;
        this.duration = duration;
        this.from = this.dom.scrollTop;
        this.startTime = Date.now();
        this.doScroll();
    }
    doScroll() {
        if (this.startTime < 0) {
            return;
        }
        const currentTime = Date.now() - this.startTime;

        if (this.dom === null) {
            return;
        }

        if (currentTime >= this.duration) {
            this.dom.scrollTop = this.destination;
            return;
        }
        this.dom.scrollTop = this.from + (this.destination - this.from) * (Math.pow((currentTime / this.duration - 1), 3) + 1);

        requestAnimationFrame(this.doScroll.bind(this));
    }
}