@php
    if (old('data')) $facultiesBlocks = old('data');
@endphp

<div class="row gy-3 custom-fn-faculty-block-parent">
    @if(isset($facultiesBlocks))
        @foreach($facultiesBlocks as $blockName => $blockContent)
            @include('personal-files.form.blocks.faculty-block')
        @endforeach
    @else
        @include('personal-files.form.blocks.faculty-block')
    @endif
</div>
<div class="row mb-5 gy-3">
    <div class="col-12">
        <button type="button"
                class="btn btn-link
                       fw-bold
                       text-decoration-none
                       custom-fn-add-faculty
                       custom-fn-remove-during-view
                       p-0">Добавить ещё специальность...
        </button>
    </div>
</div>
