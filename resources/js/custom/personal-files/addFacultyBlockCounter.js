export default function addFacultyBlockCounter(facultyBlockParent, counter) {

    // Получаем предпоследнего потомка блока 'custom-faculty-block-parent'
    let penultimateChild = facultyBlockParent.children[facultyBlockParent.children.length - 1];

    // Достаём номер блока из значения атрибута 'for' тега 'label' и увеличиваем его на единицу
    for (let item of [...penultimateChild.getElementsByTagName('label')]) {

        let str = item.getAttribute('for');
        counter = Number(str.slice((str.lastIndexOf('_')) + 1)) + 1;
        break;
    }

    return counter;
};
