@php
$inputTestingName = isset($facultiesBlocks) && isset($blockName) ? "data[$blockName][testing]" : 'data[block_1][testing]';
$inputTestingError = isset($facultiesBlocks) && isset($blockName) ? "data.$blockName.testing" : 'data.block_1.testing';
@endphp

<div class="row my-3 custom-fn-faculty-block-child">
    <div class="col-6">
        <label for="{{ isset($facultiesBlocks) && isset($blockName) ? "faculty_$blockName" : 'faculty_block_1' }}"
               class="form-label">
            Специальность<span class="custom-st-required-field">*</span>
        </label>

        <select id="{{ isset($facultiesBlocks) && isset($blockName) ? "faculty_$blockName" : 'faculty_block_1' }}"
                class="form-select"
                name="{{ isset($facultiesBlocks) && isset($blockName) ? "data[$blockName][faculty_id]" : 'data[block_1][faculty_id]' }}"
                required>

            <option value=""
                    @if(isset($facultiesBlocks) && isset($blockContent) && !$blockContent['faculty_id']) selected @endif>
                Выберите...
            </option>

            @if(isset($faculties))
                @foreach($faculties as $item)
                    <option value="{{ $item->id }}"
                            @if(isset($facultiesBlocks) && isset($blockContent) && ($item->id == $blockContent['faculty_id'])) selected @endif>
                        {{ $item->name }}
                    </option>
                @endforeach
            @endif
        </select>

        <div class="form-check">
            <input
                id="{{ isset($facultiesBlocks) && isset($blockName) ? "original_docs_$blockName" : 'original_docs_block_1' }}"
                type="hidden"
                name="{{ isset($facultiesBlocks) && isset($blockName) ? "data[$blockName][is_original_docs]" : 'data[block_1][is_original_docs]' }}"
                value="0">

            <input
                id="{{ isset($facultiesBlocks) && isset($blockName) ? "original_docs_$blockName" : 'original_docs_block_1' }}"
                class="form-check-input custom-fn-input-original-docs"
                name="{{ isset($facultiesBlocks) && isset($blockName) ? "data[$blockName][is_original_docs]" : 'data[block_1][is_original_docs]' }}"
                value="1"
                type="checkbox"
                @if (isset($facultiesBlocks) && isset($blockContent) && ($blockContent['is_original_docs'] == '1')) checked @endif>

            <label
                for="{{ isset($facultiesBlocks) && isset($blockName) ? "original_docs_$blockName" : 'original_docs_block_1' }}"
                class="form-check-label">
                Оригиналы документов
            </label>
        </div>
    </div>

    <div class="col-3 pe-0">
        <label for="{{ isset($facultiesBlocks) && isset($blockName) ? "financing_$blockName" : 'financing_block_1' }}"
               class="form-label">
            Финансирование<span class="custom-st-required-field">*</span>
        </label>

        <select id="{{ isset($facultiesBlocks) && isset($blockName) ? "financing_$blockName" : 'financing_block_1' }}"
                class="form-select"
                name="{{ isset($facultiesBlocks) && isset($blockName) ? "data[$blockName][financing_type_id]" : 'data[block_1][financing_type_id]' }}"
                required style="max-width: 200px;">

            <option value=""
                    @if(isset($facultiesBlocks) && isset($blockContent) && !$blockContent['financing_type_id']) selected @endif>
                Выберите...
            </option>

            @if(isset($financing))
                @foreach($financing as $item)
                    <option value="{{ $item->id }}"
                            @if(isset($facultiesBlocks) && isset($blockContent) && ($item->id == $blockContent['financing_type_id'])) selected @endif>
                        {{ $item->name }}
                    </option>
                @endforeach
            @endif
        </select>
    </div>

    <div class="col-2 ps-0">
        <label for="{{ isset($facultiesBlocks) && isset($blockName) ? "testing_$blockName" : 'testing_block_1' }}"
               class="form-label">Тестирование
        </label>
        <input id="{{ isset($facultiesBlocks) && isset($blockName) ? "testing_$blockName" : 'testing_block_1' }}"
               class="form-control @error($inputTestingError) is-invalid @enderror"
               name="{{ $inputTestingName }}"
               value="{{ old($inputTestingName) ?? $blockContent['testing'] ?? '' }}"
               type="text"
               min="0" max="10">
        @error($inputTestingError)
        <div id="{{ $inputTestingError }}" class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="col-1
                d-flex
                justify-content-center
                align-items-center
                custom-fn-remove-cart
                custom-fn-remove-during-view">
        <span class="custom-st-trashbasket-icon" title="Удалить строку">
            @include('icons.other.trashbasket')
        </span>
    </div>
</div>
