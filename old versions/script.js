
//For hover effects on nav-links
//get all nav-links
const nav_links = document.querySelectorAll(".nav-link");

//Add click eventlisteners on them

nav_links.forEach(link => {
    /*loops through each links in nav-link*/

    link.addEventListener("click", function() {
        nav_links.forEach(link => link.classList.remove("active"));
        this.classList.add("active");
    })

});


//For menu toggle

const menuToggle = document.getElementById("menu-toggle");
const navLinks = document.getElementById("navlinks");

menuToggle.addEventListener("click", function(){
    navLinks.classList.toggle("active"); /*adds active class to navlinks*/
});



/* For abbreviation of languages */

// function noText(){

//     const replace = document.querySelectorAll(".subheading");

//     const icons = [
//         '<i class="fa-brands fa-python"></i>',
//         '<i class="fa-brands fa-js"></i>',
//         '<i class="fa-brands fa-html5"></i>',
//         '<i class="fa-brands fa-css3-alt"></i>'
//     ];

//     replace.forEach((icon, index)=> {
//         if (!icon.dataset.original){
//             icon.dataset.original = icon.innerHTML;
//         }
//         if(window.innerWidth <= 1005) {
//             icon.innerHTML = `<h1>${icons[index % icons.length]}</h1>`
//         }else{
//             icon.innerHTML = icon.dataset.original; 
//         }
//     });
// }


// window.addEventListener("resize",noText);
// noText();