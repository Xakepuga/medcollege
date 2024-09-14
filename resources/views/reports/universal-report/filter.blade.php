<div class="border border-3 rounded py-4 px-3 mb-3">
    <p class="fw-bold fs-5 mb-4">Назначение отчёта</p>
    <div class="form-check mb-2">
        <input id="department-1"
               class="form-check-input custom-st-fix-circle"
               name="report"
               value="department"
               type="radio"
               @if (request()->input('report') === 'department') checked @endif>
        <label for="department-1" class="form-check-label">Департамент</label>
    </div>
    <div class="form-check mb-2">
        <input id="accounting-1"
               class="form-check-input custom-st-fix-circle"
               name="report"
               value="accounting"
               type="radio"
               @if (request()->input('report') === 'accounting') checked @endif>
        <label for="accounting-1" class="form-check-label">Бухгалтерия</label>
    </div>
    <div class="form-check mb-2">
        <input id="educational-1"
               class="form-check-input custom-st-fix-circle"
               name="report"
               value="educational"
               type="radio"
               @if (request()->input('report') === 'educational') checked @endif>
        <label for="educational-1" class="form-check-label">Воспитательный отдел</label>
    </div>
    <div class="form-check mb-2">
        <input id="inclusive-1"
               class="form-check-input custom-st-fix-circle"
               name="report"
               value="inclusive"
               type="radio"
               @if (request()->input('report') === 'inclusive') checked @endif>
        <label for="inclusive-1" class="form-check-label">Инклюзивный центр</label>
    </div>
    <div class="form-check mb-2">
        <input id="committee-1"
               class="form-check-input custom-st-fix-circle"
               name="report"
               value="committee"
               type="radio"
               @if (request()->input('report') === 'committee') checked @endif>
        <label for="committee-1" class="form-check-label">Приёмная комиссия</label>
    </div>
</div>
