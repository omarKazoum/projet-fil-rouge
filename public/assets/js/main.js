const alertSalon=(type,title,message)=> {
    Swal.fire({
        icon: type,
        title: title,
        text: message,
        footer: ''
    });
}