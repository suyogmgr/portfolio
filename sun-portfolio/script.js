const close = document.getElementById('close-icon');
const open = document.getElementById('menu-icon');
// const sidebar = document.getElementsByTagName('aside')[0];
const sidebar = document.getElementById('sidebar');


close.addEventListener('click', function(){
    sidebar.classList.toggle('hide');
    sidebar.classList.remove('show');
})

open.addEventListener('click', function(){
    sidebar.classList.toggle('show');
    sidebar.classList.remove('hide');
})

