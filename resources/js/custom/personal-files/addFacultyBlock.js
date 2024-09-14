import addFacultyBlockCounter from './addFacultyBlockCounter';

export default function addFacultyBlock() {

    let button = document.querySelector('.custom-fn-add-faculty');

    let facultyBlockParent = document.querySelector('.custom-fn-faculty-block-parent');
    let facultyBlockChild = document.querySelector('.custom-fn-faculty-block-child');

    let counter = 0;

    function handler() {

        // Объявляем массив искомых тегов
        let searchedTags = ['label', 'select', 'input'];

        // Объявляем массив искомых атрибутов
        let searchedAttributes = ['for', 'id', 'name'];

        // Объявляем массив для найденных тегов
        let foundTags = [];

        // Клонируем элемент и удаляем унаследованный от родителя класс
        let facultyBlockChildClone = facultyBlockChild.cloneNode(true);
        facultyBlockChildClone.classList.remove('d-none');

        // У клонированного элемента находим нужные теги, преобразовываем каждую HTML-коллекцию
        // в обычный массив, а затем добавляем в ранее объявленный общий массив foundTags.
        for (let searchedTagsItem of searchedTags) {
            for (let item of [...facultyBlockChildClone.getElementsByTagName(searchedTagsItem)]) {
                foundTags.push(item);
            }
        }

        // Функция для подсчёта значения счётчика
        counter = addFacultyBlockCounter(facultyBlockParent, counter);

        // У каждого тега из массива searchedTags проверяем наличие нужного атрибута
        // из массива searchedAttributes. Если атрибут есть, то изменяем его значение.
        foundTags.forEach((foundTagsItem) => {
            for (let searchedAttributesItem of searchedAttributes) {
                if (foundTagsItem.hasAttribute(searchedAttributesItem)) {

                    let attributeValuesFoundTags = foundTagsItem.getAttribute(searchedAttributesItem);

                    foundTagsItem.setAttribute
                    (
                        searchedAttributesItem, attributeValuesFoundTags.replace('block_1', `block_${counter}`)
                    );
                }
            }
        });

        // Добавляем клона в вёрстку, в конец родителя
        facultyBlockParent.appendChild(facultyBlockChildClone);
    }

    button.addEventListener("click", handler);
};
