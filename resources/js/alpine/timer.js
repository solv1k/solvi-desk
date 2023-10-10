class Timer {
    constructor() {
        this.$timer = document.querySelector('.code-timer');
        this.show = false;
        this.timeIsLeft = false;
    }

    updateLabel() {
        const minutes = Math.floor(this.leftSeconds / 60);
        const seconds = this.leftSeconds - minutes * 60;
        this.$timer.innerHTML = [
            minutes.toString().padStart(2, '0'),
            seconds.toString().padStart(2, '0')
        ].join(':');
    }

    reset() {
        clearInterval(this.timerInterval);
        this.timerInterval = undefined;
        this.timeIsLeft = true;
    }

    start(leftSeconds = 30) {
        if (this.timerInterval === undefined) {
            this.leftSeconds = leftSeconds;
            this.show = true;
            this.timeIsLeft = false;
            this.startTimerInterval();
        }
        this.updateLabel();
    }

    tick() {
        this.leftSeconds--;
        this.updateLabel();
        if (this.leftSeconds === 0) {
            return this.reset();
        }
    }

    startTimerInterval() {
        this.timerInterval = setInterval(() => this.tick(), 1000);
    }
}

export default Timer
