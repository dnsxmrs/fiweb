
// Import the Echo library in main blade file
<script src="{{ asset('js/real-time.js') }}"></script>

import Echo from "laravel-echo";

const echo = new Echo({
    broadcaster: 'pusher',
    key: 'your-pusher-key',
    cluster: 'mt1',
    forceTLS: true
});

echo.channel('menu-updates')
    .listen('MenuUpdated', (event) => {
        console.log("Menu updated:", event.item);
    });
