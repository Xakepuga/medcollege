// Скрывает иконку корзины у первого потомка блока 'custom-faculty-block-parent'

export default function hideTrashBasketIcon() {

    let facultyBlockParent = document.querySelector('.custom-fn-faculty-block-parent');
    let firstElem = facultyBlockParent.firstElementChild.querySelector('.custom-fn-remove-cart');

    if (firstElem !== null) {
        firstElem.classList.add('d-none');
    }
};
