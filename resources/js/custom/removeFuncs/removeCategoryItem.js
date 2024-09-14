export default function removeCategoryItem() {

    const buttons = document.querySelectorAll('.custom-fn-remove');

    async function send(url) {
        let response = await fetch(url, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
        });

        /*let result = await response.json();
        return result.ok;*/
    }

    buttons.forEach((item) => {
        item.addEventListener('click', () => {

            let id = item.dataset.itemId;
            let tableId = item.dataset.tableId;

            if (confirm('Вы подтверждаете удаление?')) {
                send(`${location.origin}/admin/manage/categories/category/item/${id}/delete?id=${tableId}`).then(() => {
                    location.reload();
                });
            }
        });
    });
}
