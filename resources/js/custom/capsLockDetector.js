export default function capsLockDetector() {

    const inputs = document.querySelectorAll('.custom-fn-capslock');
    const message = 'Пожалуйста, отключите CapsLock';

    inputs.forEach((item) => {
        item.addEventListener('keyup', (e) => {
            if (e.getModifierState('CapsLock')) {
                alert(message);
            }
        })
    });
}
