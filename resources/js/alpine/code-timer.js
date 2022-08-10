class Timer {
    constructor(leftSeconds = 300) {
        this.$timer = document.querySelector('.code-timer');
        this._leftSeconds = leftSeconds;
        this.leftSeconds = leftSeconds;
        this.timerInterval = null;
        this.timeIsLeft = false;
    }

    leftSecondsLabel() {
        const minutes = Math.floor(this.leftSeconds / 60);
        const seconds = this.leftSeconds - minutes * 60;

        return minutes.toString().padStart(2, '0') + ':' + seconds.toString().padStart(2, '0');
    }

    reset() {
        clearInterval(this.timerInterval);
        this.timerInterval = null;
        this.timeIsLeft = true;
    }

    start() {
        if (this.timerInterval === null) {
            this.leftSeconds = this._leftSeconds;
            this.timeIsLeft = false;
            this.$timer.innerHTML = this.leftSecondsLabel();
            this.startTimerInterval();
        }
    }

    startTimerInterval() {
        this.timerInterval = setInterval(() => {
            this.leftSeconds--;
            if (this.leftSeconds === 0) {
                this.reset();
            }
            this.$timer.innerHTML = this.leftSecondsLabel();
        }, 1000);
    }
}

export default Timer
