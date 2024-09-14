<div class="row mb-5 gy-3"> {{-- ПАСПОРТНЫЕ ДАННЫЕ: БЛОК 1 --}}
    <div class="col-3">
        <label for="lastName-1" class="form-label">Фамилия<span class="custom-st-required-field">*</span></label>
        <input id="lastName-1"
               class="form-control custom-fn-capslock @error('surname') is-invalid @enderror"
               name="surname"
               value="{{ old('surname') ?? $student->surname ?? '' }}"
               type="text"
               required>
        @error('surname')
        <div id="lastName-1-validation" class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="col-3 offset-1">
        <label for="firstName-1" class="form-label">Имя<span class="custom-st-required-field">*</span></label>
        <input id="firstName-1"
               class="form-control custom-fn-capslock @error('name') is-invalid @enderror"
               name="name"
               value="{{ old('name') ?? $student->name ?? '' }}"
               type="text"
               required>
        @error('name')
        <div id="firstName-1-validation" class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="col-3 offset-1">
        <label for="patronymic-1" class="form-label">Отчество</label>
        <input id="patronymic-1"
               class="form-control custom-fn-capslock @error('patronymic') is-invalid @enderror"
               name="patronymic"
               value="{{ old('patronymic') ?? $student->patronymic ?? '' }}"
               type="text">
        @error('patronymic')
        <div id="patronymic-1-validation" class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="col-4">
        <p>Пол</p>
        <div class="form-check form-check-inline">
            <input id="genderMale-1"
                   class="form-check-input custom-st-fix-circle"
                   name="gender"
                   value="male"
                   type="radio"
                   checked>
            <label for="genderMale-1" class="form-check-label">Мужской</label>
        </div>
        <div class="form-check form-check-inline">
            <input id="genderFemale-1"
                   class="form-check-input custom-st-fix-circle"
                   name="gender"
                   value="female"
                   type="radio"
                   @if (old('gender') == 'female' || (isset($passport) && ($passport->gender) == 'female')) checked @endif>
            <label for="genderFemale-1" class="form-check-label">Женский</label>
        </div>
    </div>
    <div class="col-2">
        <label for="birthday-1" class="form-label">Дата рождения<span class="custom-st-required-field">*</span></label>
        <input id="birthday-1"
               class="form-control @error('birthday') is-invalid @enderror"
               name="birthday"
               value="{{ old('birthday') ?? $passport->birthday ?? '' }}"
               type="date"
               min="1923-01-01" max="2023-01-01"
               required>
        @error('birthday')
        <div id="birthday-1-validation" class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="col-2 offset-2">
        <label for="nationality-1" class="form-label">Гражданство<span class="custom-st-required-field">*</span></label>
        <select id="nationality-1" class="form-select" name="nationality" required style="min-width: 170px;">
            <option
                value="" @if(!old('nationality') || !isset($passport)) selected @endif>Выберите...
            </option>
            @if(isset($nationality))
                @foreach($nationality as $item)
                    <option
                        value="{{ $item->id }}"
                        @if($item->id == old('nationality') || (isset($passport) && ($passport->nationality_id) == $item->id))
                            selected
                        @endif>
                        {{ $item->name }}
                    </option>
                @endforeach
            @endif
        </select>
    </div>
    <div class="col-8">
        <label for="birthplace-1" class="form-label">Место рождения<span
                class="custom-st-required-field">*</span></label>
        <input id="birthplace-1"
               class="form-control custom-fn-capslock @error('birthplace') is-invalid @enderror"
               name="birthplace"
               value="{{ old('birthplace') ?? $passport->birthplace ?? '' }}"
               type="text"
               required>
        @error('birthplace')
        <div id="birthplace-validation" class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>

<div class="row mb-5 gy-3"> {{-- ПАСПОРТНЫЕ ДАННЫЕ: БЛОК 2 --}}
    <div class="col-3">
        <label for="passport-number-1" class="form-label">Серия и номер паспорта<span
                class="custom-st-required-field">*</span></label>
        <input id="passport-number-1"
               class="form-control @error('passportNumber') is-invalid @enderror"
               name="passportNumber"
               value="{{ old('passportNumber') ?? $passport->number ?? '' }}"
               type="text"
               placeholder="Т-АТZ0825000"
               required>
        @error('passportNumber')
        <div id="passport-number-1-validation" class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="col-2 offset-1">
        <label for="issue-date-passport-1" class="form-label">Дата выдачи<span class="custom-st-required-field">*</span></label>
        <input id="issue-date-passport-1"
               class="form-control @error('issueDatePassport') is-invalid @enderror"
               name="issueDatePassport"
               value="{{ old('issueDatePassport') ?? $passport->issue_date ?? '' }}"
               type="date"
               min="1900-01-01" max="2030-01-01"
               required>
        @error('issueDatePassport')
        <div id="issue-date-passport-1-validation" class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="col-8">
        <label for="issue-by-1" class="form-label">Паспорт выдан<span class="custom-st-required-field">*</span></label>
        <input id="issue-by-1"
               class="form-control @error('issueBy') is-invalid @enderror"
               name="issueBy"
               value="{{ old('issueBy') ?? $passport->issue_by ?? '' }}"
               type="text"
               required>
        @error('issueBy')
        <div id="issue-by-1-validation" class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>

<div class="row mb-5 gy-3"> {{-- ПАСПОРТНЫЕ ДАННЫЕ: БЛОК 3 --}}
    <div class="col-8">
        <label for="address-registered-1" class="form-label">Адрес по прописке<span
                class="custom-st-required-field">*</span></label>
        <input id="address-registered-1"
               class="form-control custom-fn-capslock @error('addressRegistered') is-invalid @enderror"
               name="addressRegistered"
               value="{{ old('addressRegistered') ?? $passport->address_registered ?? '' }}"
               type="text"
               required>
        @error('addressRegistered')
        <div id="address-registered-1-validation" class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="col-8">
        <label for="address-residential-1" class="form-label">Адрес проживания<span
                class="custom-st-required-field">*</span></label>
        <input id="address-residential-1"
               class="form-control custom-fn-capslock @error('addressResidential') is-invalid @enderror"
               name="addressResidential"
               value="{{ old('addressResidential') ?? $passport->address_residential ?? '' }}"
               type="text"
               required>
        @error('addressResidential')
        <div id="address-residential-1-validation" class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>
