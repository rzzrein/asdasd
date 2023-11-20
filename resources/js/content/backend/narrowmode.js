$(function () {
    $('#narrow_mode').on('change', (e) => {
        e.preventDefault()
        e.stopImmediatePropagation()
        let t = $(this)
        $.ajax({
            type: "PUT",
            url: "/admin/narrow-mode",
            data: {
                narrow : $('#narrow_mode').is(':checked')
            },
            success: function (response) {
                setTimeout(() => {
                    window.location.reload()
                }, 1000)        
            }
        })
    })
})