$(function () {
    $('.logout').on('click', (e) => {
        e.preventDefault()
        e.stopImmediatePropagation()
        Swal.fire({
            title: 'Are you sure you want to sign out?',
            showDenyButton: true,
            confirmButtonText: 'Yes',
            denyButtonText: `No`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "/logout",
                    success: function (response) {
                        location.reload()                        
                    }
                })
            }
        })        
    })
});