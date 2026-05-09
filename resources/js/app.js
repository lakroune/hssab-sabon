import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.store('modal', {
    showCreate: false,
    showJoin: false,
});

Alpine.start();