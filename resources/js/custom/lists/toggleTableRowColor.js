export default function toggleTableRowColor() {

    let tags = document.querySelectorAll('.custom-fn-toggle-row-color');

    tags.forEach((item) => {

        let select = item.querySelector('.custom-fn-decree-select');

        select.addEventListener("change", () => {

            if (!select.value) {
                item.classList.replace('table-success', 'table-danger');
            } else if (select.value && item.className !== 'table-success') {
                item.classList.replace('table-danger', 'table-success');
            }
        });
    });
}
