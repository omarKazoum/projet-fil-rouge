document.querySelectorAll('.confirm').forEach((btn) => {
    btn.addEventListener('click', (e) => {
        e.preventDefault();
        Swal.fire({
            icon: 'warning',
            title: e.target.dataset.confirmMsg!=null?e.target.dataset.confirmMsg:'Do you want to delete this item?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Yes!',
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                window.location.href = e.target.href;
            }
        })
    })

})