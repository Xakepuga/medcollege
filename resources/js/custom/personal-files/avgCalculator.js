export default function avgCalculator() {

    let button = document.querySelector('.custom-fn-avg-calc-btn');

    function handler() {

        let result = 0;
        let totalGrade = 0;

        let grade3 = Number(document.getElementById('grade-3').value);
        let grade4 = Number(document.getElementById('grade-4').value);
        let grade5 = Number(document.getElementById('grade-5').value);

        totalGrade = grade5 + grade4 + grade3;
        result = ((grade5 * 5) + (grade4 * 4) + (grade3 * 3)) / totalGrade;
        result = +result.toFixed(2);

        document.getElementById('avg-rating-1').value = result;
    }

    button.addEventListener("click", handler);
};
