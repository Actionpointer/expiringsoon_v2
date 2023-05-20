<script src="https://js.pusher.com/7.2.0/pusher.min.js"></script>
<script>
    let user = @json(auth()->id());
    let url = window.location.origin;
    if(user){
        Pusher.logToConsole = true;
        var pusher = new Pusher('30f7e5194b874bf1230b', {
            cluster: 'eu',
            wsHost: 'expiringsoon.test',
            wsPort: 6001,
            wssPort: 6001,
            forceTLS: false,
            enabledTransports: ['ws'],
            debug: true,
            authEndpoint: url+'/broadcasting/auth', // The URL of your Laravel app's auth endpoint
            auth: {
                headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include the CSRF token if CSRF protection is enabled
                }
            }
        });
        var channel = pusher.subscribe('private-users.'+user);
        channel.bind('Illuminate\\Notifications\\Events\\BroadcastNotificationCreated', function(data) {
            console.log('Received event:', data);
            
        });
    
    }
    
</script>