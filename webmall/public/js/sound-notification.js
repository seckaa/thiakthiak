// public/js/sound-notification.js
document.addEventListener('DOMContentLoaded', function () {
    // You can customize the sound file path here
    const soundPath = '/sounds/notification.mp3';

    // Play sound on page load
    const audio = new Audio(soundPath);
    // alert("audio shoule play");
    audio.play();

    // Additional logic for triggering the sound on specific events if needed
});
