import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import VMasker from 'vanilla-masker'
VMasker(document.querySelectorAll('.money-mask')).maskMoney();
