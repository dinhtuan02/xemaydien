document.addEventListener('DOMContentLoaded', function () {
    initImagePreview();
    initConfirmButtons();
    initAutoHideAlert();
});

function initImagePreview() {
    const inputs = document.querySelectorAll('.image-input');

    inputs.forEach((input) => {
        input.addEventListener('change', function (e) {
            const previewSelector = input.dataset.preview;
            if (!previewSelector) return;

            const preview = document.querySelector(previewSelector);
            if (!preview) return;

            const file = e.target.files[0];
            if (!file) {
                preview.classList.add('d-none');
                preview.src = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = function (event) {
                preview.src = event.target.result;
                preview.classList.remove('d-none');
            };
            reader.readAsDataURL(file);
        });
    });
}

function initConfirmButtons() {
    document.querySelectorAll('[data-confirm]').forEach((btn) => {
        btn.addEventListener('click', function (e) {
            const message = btn.dataset.confirm || 'Bạn có chắc chắn muốn thực hiện thao tác này?';
            if (!confirm(message)) {
                e.preventDefault();
            }
        });
    });
}

function initAutoHideAlert() {
    const alerts = document.querySelectorAll('.alert');
    if (!alerts.length) return;

    setTimeout(() => {
        alerts.forEach(alert => {
            if (alert.classList.contains('show')) {
                alert.classList.remove('show');
            }
        });
    }, 3000);
}