<div class="row mb-5 gy-3"> {{-- КОНТАКТНАЯ ИНФОРМАЦИЯ --}}
    <div class="col-3">
        <label for="phone-1" class="form-label">Телефон (только цифры)</label>
        <input id="phone-1"
               class="form-control @error('phone') is-invalid @enderror"
               name="phone"
               value="{{ old('phone') ?? $student->phone ?? '' }}"
               type="tel"
               placeholder="7XXXXXXXXXX">
        @error('phone')
        <div id="phone-1-validation" class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="col-3">
        <label for="email-1" class="form-label">Электронная почта</label>
        <input
            id="email-1"
            class="form-control custom-fn-capslock @error('email') is-invalid @enderror"
            name="email"
            value="{{ old('email') ?? $student->email ?? '' }}"
            type="email"
            placeholder="">
        @error('email')
        <div id="email-1-validation" class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>
