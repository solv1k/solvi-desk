import Alpine from 'alpinejs';

window.Alpine = Alpine;

import Timer from './alpine/timer';

const smsCodeTimer = new Timer;

Alpine.store('common', { smsCodeTimer: smsCodeTimer });

Alpine.start();