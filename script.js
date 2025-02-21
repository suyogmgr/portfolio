
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




