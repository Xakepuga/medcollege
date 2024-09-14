<div class="row mb-5 gy-3"> {{-- ИНФОРМАЦИЯ О РОДСТВЕННИКАХ --}}
    <p class="mb-0 mt-3 fw-bold">Отец</p>
    <div class="col-3">
        <label for="father-surname-1" class="form-label">Фамилия</label>
        <input id="father-surname-1"
               class="form-control custom-fn-capslock @error('fatherSurname') is-invalid @enderror"
               name="fatherSurname"
               value="{{ old('fatherSurname') ?? $studentsParentFather->surname ?? '' }}"
               type="text">
        @error('fatherSurname')
        <div id="father-surname-1-validation" class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="col-3 offset-1">
        <label for="father-name-1" class="form-label">Имя</label>
        <input id="father-name-1"
               class="form-control custom-fn-capslock @error('fatherName') is-invalid @enderror"
               name="fatherName"
               value="{{ old('fatherName') ?? $studentsParentFather->name ?? '' }}"
               type="text">
        @error('fatherName')
        <div id="father-name-1-validation" class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="col-3 offset-1">
        <label for="father-patronymic-1" class="form-label">Отчество</label>
        <input id="father-patronymic-1"
               class="form-control custom-fn-capslock @error('fatherPatronymic') is-invalid @enderror"
               name="fatherPatronymic"
               value="{{ old('fatherPatronymic') ?? $studentsParentFather->patronymic ?? '' }}"
               type="text">
        @error('fatherPatronymic')
        <div id="father-patronymic-1-validation" class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="col-3 mb-2">
        <label for="father-phone-1" class="form-label">Телефон (только цифры)</label>
        <input id="father-phone-1"
               class="form-control @error('fatherPhone') is-invalid @enderror"
               name="fatherPhone"
               value="{{ old('fatherPhone') ?? $studentsParentFather->phone ?? '' }}"
               type="tel"
               placeholder="7XXXXXXXXXX">
        @error('fatherPhone')
        <div id="father-phone-1-validation" class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <p class="mb-0 mt-4 fw-bold">Мать</p>
    <div class="col-3">
        <label for="mother-surname-1" class="form-label">Фамилия</label>
        <input id="mother-surname-1"
               class="form-control custom-fn-capslock @error('motherSurname') is-invalid @enderror"
               name="motherSurname"
               value="{{ old('motherSurname') ?? $studentsParentMother->surname ?? '' }}"
               type="text">
        @error('motherSurname')
        <div id="mother-surname-1-validation" class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="col-3 offset-1">
        <label for="mother-name-1" class="form-label">Имя</label>
        <input id="mother-name-1"
               class="form-control custom-fn-capslock @error('motherName') is-invalid @enderror"
               name="motherName"
               value="{{ old('motherName') ?? $studentsParentMother->name ?? '' }}"
               type="text">
        @error('motherName')
        <div id="mother-name-1-validation" class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="col-3 offset-1">
        <label for="mother-patronymic-1" class="form-label">Отчество</label>
        <input id="mother-patronymic-1"
               class="form-control custom-fn-capslock @error('motherPatronymic') is-invalid @enderror"
               name="motherPatronymic"
               value="{{ old('motherPatronymic') ?? $studentsParentMother->patronymic ?? '' }}"
               type="text">
        @error('motherPatronymic')
        <div id="mother-patronymic-1-validation" class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="col-3">
        <label for="mother-phone-1" class="form-label">Телефон (только цифры)</label>
        <input id="mother-phone-1"
               class="form-control @error('motherPhone') is-invalid @enderror"
               name="motherPhone"
               value="{{ old('motherPhone') ?? $studentsParentMother->phone ?? '' }}"
               type="tel"
               placeholder="7XXXXXXXXXX">
        @error('motherPhone')
        <div id="mother-phone-1-validation" class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>
