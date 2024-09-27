@if(session('notification'))
    <script>
        const notificationType = '{{ session('notification.type') }}';
        const message = '{{ session('notification.message') }}';

        const notificationConfig = {
            error: {
                iconClass: "notification-tab__icon--alert",
                title: "¡Error!",
                color: "#D82626"
            },
            success: {
                iconClass: "notification-tab__icon--check",
                title: "¡Correcto!",
                color: "#26D826"
            },
            info: {
                iconClass: "notification-tab__icon--information",
                title: "¡Información!",
                color: "#007BFF"
            }
        };

        const config = notificationConfig[notificationType] || {
            iconClass: "notification-tab__icon--default",
            title: "¡Notificación!",
            color: "#000000"
        };

        newToastMessage({
            iconClass: config.iconClass,
            title: config.title,
            body: "<p>" + message + "</p>",
            color: config.color,
            displayTime: 3000
        });
    </script>
@endif