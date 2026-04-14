document.addEventListener('DOMContentLoaded', function () {
    initImagePreview();
    initQtyButtons();
    initAutoHideAlert();
    initConfirmLinks();
});

/**
 * Preview ảnh khi chọn file
 */
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

/**
 * Nút tăng giảm số lượng
 */
function initQtyButtons() {
    document.querySelectorAll('.qty-wrapper').forEach(wrapper => {
        const input = wrapper.querySelector('.qty-input');
        const minusBtn = wrapper.querySelector('.qty-minus');
        const plusBtn = wrapper.querySelector('.qty-plus');

        if (!input) return;

        if (minusBtn) {
            minusBtn.addEventListener('click', function () {
                let value = parseInt(input.value || 1, 10);
                value = Math.max(1, value - 1);
                input.value = value;
            });
        }

        if (plusBtn) {
            plusBtn.addEventListener('click', function () {
                let value = parseInt(input.value || 1, 10);
                input.value = value + 1;
            });
        }
    });
}

/**
 * Tự ẩn alert sau vài giây
 */
function initAutoHideAlert() {
    const alerts = document.querySelectorAll('.alert');
    if (!alerts.length) return;

    setTimeout(() => {
        alerts.forEach(alert => {
            if (alert.classList.contains('show')) {
                alert.classList.remove('show');
            }
        });
    }, 3500);
}

/**
 * Confirm delete/link
 */
function initConfirmLinks() {
    document.querySelectorAll('[data-confirm]').forEach(element => {
        element.addEventListener('click', function (e) {
            const message = element.getAttribute('data-confirm') || 'Bạn có chắc chắn?';
            if (!confirm(message)) {
                e.preventDefault();
            }
        });
    });
}