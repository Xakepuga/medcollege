export default function removeUser() {

    const buttons = document.querySelectorAll('.custom-fn-remove');
    const redirectUrl = `${location.origin}/admin/manage/users`;

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

            if (confirm('Вы подтверждаете удаление?')) {
                send(`${location.origin}/admin/manage/users/user/${id}/delete`).then(() => {
                    if (item.dataset.reloadPage) {
                        location.reload();
                    } else {
                        location.replace(redirectUrl);
                    }
                });
            }
        });
    });
}
