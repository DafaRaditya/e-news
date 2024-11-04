setTimeout(function(){
    let alertBox = document.getElementById('alert-box')
    if(alertBox) {
        let alert = new bootstrap.Alert(alertBox)
        alert.close(); 
    }
}, 2500)


function toggleNavbar() {
    const navbarContent = document.getElementById('navbarContent');
    const mobileNavbarContent = document.getElementById('mobileNavbarContent');
    navbarContent.classList.toggle('hidden');
    mobileNavbarContent.classList.toggle('hidden');
  }