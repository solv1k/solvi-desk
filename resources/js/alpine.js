import Alpine from 'alpinejs';

window.Alpine = Alpine;

import Timer from './alpine/code-timer';

const smsCodeTimer = new Timer(180);

Alpine.store('code', { timer: smsCodeTimer });

Alpine.start();