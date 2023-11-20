$(function () {
    $('#change_theme').on('change', (e) => {
        e.preventDefault()
        e.stopImmediatePropagation()
        let t = $(this)
        $.ajax({
            type: "PUT",
            url: "/admin/change-theme",
            data: {
                dark : $('#change_theme').is(':checked')
            },
            success: function (response) {
                setTimeout(() => {
                    window.location.reload()
                }, 1000)        
            }
        })
    })
})