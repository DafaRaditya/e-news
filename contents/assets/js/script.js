setTimeout(function(){
    let alertBox = document.getElementById('alert-box')
    if(alertBox) {
        let alert = new bootstrap.Alert(alertBox)
        alert.close(); 
    }
}, 2500)