export default function removeSessionAlert() {

    let button = '';

    if (document.querySelector('.custom-btn-fn-close')) {
        button = document.querySelector('.custom-btn-fn-close');
    }

    function handler() {
        button.parentNode.remove();
    }

    if (button) {
        button.addEventListener("click", handler);
    }
}
