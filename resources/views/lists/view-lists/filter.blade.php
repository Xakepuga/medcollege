<div class="col-6">
    <label for="faculty-id-1" class="form-label fw-bold">Специальность</label>
    <select id="faculty-id-1" class="form-select" name="faculty_id">
        <option class="custom-fn-reset-filter" value="">Выберите...</option>
        @if(isset($faculties))
            @foreach($faculties as $item)
                <option
                    class="custom-fn-reset-filter"
                    value="{{ $item->id }}"
                    @if(request()->input('faculty_id') == $item->id)
                        selected
                    @endif>
                    {{ $item->name }}
                </option>
            @endforeach
        @endif
    </select>
</div>
<div class="col-2">
    <p class="fw-bold mb-1">Тип финансирования</p>
    <div class="form-check">
        <input id="financing-types-budget-1"
               class="form-check-input custom-fn-reset-filter"
               name="financing_types[budget]"
               value="1"
               type="checkbox"
               @if(request()->input('financing_types.budget')) checked @endif>
        <label for="financing-types-budget-1"
               class="form-check-label">бюджет</label>
    </div>
    <div class="form-check">
        <input id="financing-types-contract-1"
               class="form-check-input custom-fn-reset-filter"
               name="financing_types[contract]"
               value="2"
               type="checkbox"
               @if(request()->input('financing_types.contract')) checked @endif>
        <label for="financing-types-contract-1"
               class="form-check-label">договор</label>
    </div>
    <div class="form-check">
        <input id="financing-types-contract-possible-1"
               class="form-check-input custom-fn-reset-filter"
               name="financing_types[contract_possible]"
               value="3"
               type="checkbox"
               @if(request()->input('financing_types.contract_possible')) checked @endif>
        <label for="financing-types-contract-possible-1"
               class="form-check-label">возможен договор</label>
    </div>
</div>
<div class="col-2 border-start border-white border-3">
    <p class="fw-bold mb-1">Статус абитуриента</p>
    <div class="form-check">
        <input id="student-statuses-enrolled-1"
               class="form-check-input custom-fn-reset-filter"
               name="student_statuses[enrolled]"
               value="1"
               type="checkbox"
               @if(request()->input('student_statuses.enrolled') === '1') checked @endif>
        <label for="student-statuses-enrolled-1"
               class="form-check-label">зачислен</label>
    </div>
    <div class="form-check">
        <input id="student-statuses-not-enrolled-1"
               class="form-check-input custom-fn-reset-filter"
               name="student_statuses[not_enrolled]"
               value="0"
               type="checkbox"
               @if(request()->input('student_statuses.not_enrolled') === '0') checked @endif>
        <label for="student-statuses-not-enrolled-1"
               class="form-check-label">не зачислен</label>
    </div>
</div>
<div class="col-2 border-start border-white border-3">
    <p class="fw-bold mb-1">Тип документов</p>
    <div class="form-check">
        <input id="docs-types-originals-1"
               class="form-check-input custom-fn-reset-filter"
               name="docs_types[originals]"
               value="1"
               type="checkbox"
               @if(request()->input('docs_types.originals') === '1') checked @endif>
        <label for="docs-types-originals-1"
               class="form-check-label">оригиналы</label>
    </div>
    <div class="form-check">
        <input id="docs-types-copies-1"
               class="form-check-input custom-fn-reset-filter"
               name="docs_types[copies]"
               value="0"
               type="checkbox"
               @if(request()->input('docs_types.copies') === '0') checked @endif>
        <label for="docs-types-copies-1"
               class="form-check-label">копии</label>
    </div>
</div>
<div class="col-12">
    <button class="col-2 btn btn-success me-3" type="submit">Поиск</button>
    <a class="col-2 btn btn-secondary"
       href="{{ route('students-lists.index') }}"
       role="button">Очистить
    </a>
</div>
