export default function downloadReport() {

    const buttonExcel = document.querySelector('.custom-fn-button-excel');
    const buttonGenerate = document.querySelector('.custom-fn-button-generate');
    const buttonDownload = document.querySelector('.custom-fn-button-download');

    async function send(url) {
        let response = await fetch(url, {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
        });
    }

    buttonExcel.addEventListener('click', () => {

        let reportName = buttonExcel.dataset.reportName;

        send(`${location.origin}/reporting/universal-report/export-list?report=${reportName}`)
            .then(() => {
                console.log('Generate report started');
            });

        buttonExcel.setAttribute('hidden', 'hidden');
        buttonGenerate.removeAttribute('hidden');

        setTimeout(() => {
            buttonGenerate.setAttribute('hidden', 'hidden');
            buttonDownload.removeAttribute('hidden');
        }, 120000);

    });
}
