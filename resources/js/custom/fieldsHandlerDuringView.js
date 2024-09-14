export default function fieldsHandlerDuringView() {

    let tagsForDisable = document.getElementsByTagName('fieldset');
    let tagsForRemove = document.querySelectorAll('.custom-fn-remove-during-view');

    for (let item of tagsForDisable) {
        item.setAttribute("disabled", "disabled");
    }

    for (let item of tagsForRemove) {
        item.remove();
    }
}
