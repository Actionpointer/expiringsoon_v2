<script src="https://js.pusher.com/7.2.0/pusher.min.js"></script>
    <script>
        Pusher.logToConsole = true;
        var pusher = new Pusher('30f7e5194b874bf1230b', {
            cluster: 'eu',
            wsHost: 'expiringsoon.test',
            wsPort: 6001,
            wssPort: 6001,
            forceTLS: false,
            enabledTransports: ['ws'],
            debug: true
        });
        var channel = pusher.subscribe('ourneworder');
        channel.bind('TestBroadcast', function(data) {
            console.log('Received event:', data);
        });
    </script>