export default function changeEnrollmentStatus() {

    let facultyId = document.querySelector('.custom-fn-faculty-select').value;
    let tagsSelectDecree = document.querySelectorAll('.custom-fn-decree-select');

    tagsSelectDecree.forEach((item) => {
        item.addEventListener("change", () => {

            let studentId = item.dataset.studentId;
            let decreeId = item.value;

            (
                async () => {
                    const response = await fetch('change-status', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json;charset=utf-8',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        },
                        body: JSON.stringify({
                            student_id: studentId,
                            faculty_id: facultyId,
                            decree_id: decreeId,
                        })
                    });

                    let result = await response;

                    if (result.status === 200) {
                        alert('Статус зачисления успешно обновлён')
                    } else {
                        alert('Системная ошибка: не удалось изменить статус зачисления. Попробуйте еще раз')
                    }
                }
            )();
        })
    });
}
