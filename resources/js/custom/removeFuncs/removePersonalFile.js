export default function removePersonalFile() {

    const buttons = document.querySelectorAll('.custom-fn-remove');
    let redirectUrl = `${location.origin}/personal-files/manage/personal-file/search`;

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
                send(`${location.origin}/personal-files/manage/personal-file/${id}/delete`).then(() => {
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
