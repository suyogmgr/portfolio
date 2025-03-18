function toggleMenu(button){
    button.nextElementSibling.classList.toggle('show');
    button.classList.toggle('rotate');
}

const sidebarHide = document.getElementById('toggle-btn');
const sidebar = document.getElementById('sidebar');

function toggleSidebar(){
    sidebar.classList.toggle('hide');
}

