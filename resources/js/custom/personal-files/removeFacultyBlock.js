import checkboxHandlerFlag from './checkboxHandlerFlag';
export {clickHandler, removeFacultyBlock};

function clickHandler() {
    document.querySelector('.custom-fn-add-faculty').addEventListener("click", removeFacultyBlock);
}

function removeFacultyBlock() {

    let trashBaskets = document.querySelectorAll('.custom-fn-remove-cart');

    trashBaskets.forEach((item) => {
        item.addEventListener('click', () => {
            item.closest('.custom-fn-faculty-block-child').remove();
            checkboxHandlerFlag();
        })
    });
}
