const navLinks = document.querySelectorAll('.navbar .right-section a');

navLinks.forEach(navLink => {
    navLink.addEventListener('click', function(){
        document.querySelector('.active')?.classList.remove('active');
        this.classList.add('active');
    })
})