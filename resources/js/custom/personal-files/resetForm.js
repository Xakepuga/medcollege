export default function resetForm() {

    let form = document.querySelector('.custom-fn-form');
    let button = document.querySelector('.custom-fn-reset-form');

    function handler() {
        if (confirm('Очистить форму?')) {
            form.reset();
        }
    }

    button.addEventListener("click", handler);
}
