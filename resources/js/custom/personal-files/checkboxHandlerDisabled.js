export default function checkboxHandlerDisabled(flag) {

    let checkboxes = document.querySelectorAll('.custom-fn-input-original-docs');

    for (let item of checkboxes) {
        if (flag === 1 && !item.hasAttribute('checked')) {
            item.setAttribute('disabled', 'disabled');
        } else if (flag === 0) {
            item.removeAttribute('disabled');
        }
    }
}
