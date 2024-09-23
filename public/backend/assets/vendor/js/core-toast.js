( function ( $ ) {
    'use strict';

    const toastTrigger = document.getElementById('liveToastBtn')
    const toastLiveExample = document.getElementById('liveToast')
    if (toastTrigger) {
        toastTrigger.addEventListener('click', () => {
            const toast = new bootstrap.Toast(toastLiveExample)

            toast.show()
        })
    }

    const toastPlacementTrigger = document.getElementById('selectToastPlacementBtn')
    const toastPlacementContent = document.getElementById('selectToastPlacementContent')

    if (toastPlacementTrigger) {
        toastPlacementTrigger.addEventListener('click', () => {
            const toast = new bootstrap.Toast(toastPlacementContent)

            toast.show()
        })
    }

    let toastClass = 'toast-container p-3 ';
    $('#selectToastPlacement').on('change', function () {
        $('#toastPlacement').removeClass().addClass(toastClass + $(this).val())
    })
}(jQuery))