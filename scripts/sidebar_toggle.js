// Ha a menu-toggle gomba megnyomásra kerül a sidebar-hoz hozzáadódik az active class. Ha rajta van akkor pedig kiveszi az active class-t.

document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.querySelector('.menu-toggle');
    const sidebar = document.querySelector('.sidebar');

    menuToggle.addEventListener('click', function() {
        sidebar.classList.toggle('active');
        });
    });