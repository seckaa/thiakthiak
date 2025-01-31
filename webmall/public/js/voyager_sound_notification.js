// public/js/voyager_sound_notification.js
document.addEventListener('DOMContentLoaded', function () {
    const soundPath = '/sounds/notification.mp3';

    // Function to play the notification sound
    function playNotificationSound() {
        const audio = new Audio(soundPath);
        audio.play();
    }

    // Example: Play the sound when a new record is added
    document.addEventListener('voyager.addedRecord', function () {
        playNotificationSound();
    });

    // Add more event listeners based on your requirements
});
