import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

// Make Pusher available globally
window.Pusher = Pusher;

// Initialize Echo with Reverb configuration
// window.Echo = new Echo({
//     broadcaster: 'reverb',
//     key: import.meta.env.VITE_REVERB_APP_KEY,
//     wsHost: import.meta.env.VITE_REVERB_HOST ?? '127.0.0.1',
//     wsPort: import.meta.env.VITE_REVERB_PORT ?? 8080,
//     wssPort: import.meta.env.VITE_REVERB_PORT ?? 8080,
//     forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
//     // No authEndpoint needed for Reverb - it uses Laravel's built-in broadcasting auth
// });
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '6201f3891c7b046d5b0d',
    cluster: 'ap2',
    forceTLS: false
  });

console.log('Laravel Echo initialized with Reverb');
console.log('Reverb config:', {
    key: import.meta.env.VITE_REVERB_APP_KEY,
    host: import.meta.env.VITE_REVERB_HOST,
    port: import.meta.env.VITE_REVERB_PORT,
});
