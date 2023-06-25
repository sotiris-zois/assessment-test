import Echo from 'laravel-echo';

window.Echo = new Echo({
  broadcaster: 'websocket',
  host: window.location.hostname + ':3000',
});
