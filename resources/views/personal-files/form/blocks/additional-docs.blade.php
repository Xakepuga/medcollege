<div class="row mb-5 gy-3"> {{-- ДОПОЛНИТЕЛЬНЫЕ ДОКУМЕНТЫ --}}
    <div class="col-3">
        <label for="pension-insurance-1" class="form-label">Номер СНИЛС (без пробелов)</label>
        <input id="pension-insurance-1"
               class="form-control @error('pensionInsurance') is-invalid @enderror"
               name="pensionInsurance"
               value="{{ old('pensionInsurance') ?? $pensionInsurance->number ?? '' }}"
               type="text"
               placeholder="XXX-XXX-XXX-XX">
        @error('pensionInsurance')
        <div id="pension-insurance-1-validation" class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>
