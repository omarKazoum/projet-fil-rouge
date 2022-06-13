document.querySelectorAll('.salon-confirm').forEach((btn) => {
    btn.addEventListener('click', (e) => {
        e.preventDefault();
        Swal.fire({
            icon: 'warning',
            title: e.target.dataset.confirmMsg,
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Yes',
        }).then((result) => {
            if (result.isConfirmed) {
                sendSalonActionRequest(e.target);
            }
        })
    })
});
const sendSalonActionRequest= (btn) => {
    $.ajax({
        url: btn.href,
        method: 'GET',
        processData: false,
        contentType: false,
        success: function (data) {
            console.log("api response: ");
            console.table(data);
            if (data.status == '1') {
                Swal.fire({
                    icon: 'success',
                    title: '',
                    text: btn.dataset.confirmMsg,
                    footer: ''
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }

                });
            }else
                alertSalon('error','',data.message);
        }
    });
}