function walidacjaEmail(){
    let email = document.getElementById('email').value;
    let wzorEmail = /^[0-9a-zA-Z_.-]+@[0-9a-zA-Z.-]+\.[a-zA-Z]{2,3}$/;
    let trescBleduEmail = document.getElementById('trescBleduEmail');
    if (email == "" || email == " "){
        trescBleduEmail.innerText = "To okno jest puste";
    }
    else if (wzorEmail.test(email)==false){
        trescBleduEmail.innerText = "email jest niepoprawny";
    }
    else {
        trescBleduEmail.innerText = "";
    }
}
function walidacjaTelefon(){
    let telefon = document.getElementById('telefon').value;
    let wzorTelefon = /^[0-9]{0,9}$/;
    let trescBleduTelefon = document.getElementById('trescBleduTelefon');
    if (telefon == "" || email == " "){
        trescBleduTelefon.innerText = "To okno jest puste";
    }
    else if (wzorTelefon.test(telefon)==false){
        trescBleduTelefon.innerText = "numer telefonu powinien składać się wyłącznie z cyfr";
    }
    else if (telefon.length<9){
        trescBleduTelefon.innerText = "numer telefonu powinien składać się z 9 cyfr";
    }
    else {
        trescBleduTelefon.innerText = "";
    }
}