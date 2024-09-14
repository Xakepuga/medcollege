@if(session('success'))
    <div class="alert alert-success d-flex justify-content-between align-items-center mb-4" role="alert">
        <div class="#">
            @include('icons.session-message.alert-success')
            <span>{{ session('success') }}</span>
        </div>
        <button type="button" class="btn-close custom-btn-fn-close" aria-label="Закрыть"></button>
    </div>
@elseif(session('error'))
    <div class="alert alert-danger d-flex justify-content-between align-items-center mb-4" role="alert">
        <div class="#">
            @include('icons.session-message.alert-danger')
            <span>{{ session('error') }}</span>
        </div>
        <button type="button" class="btn-close custom-btn-fn-close" aria-label="Закрыть"></button>
    </div>
@endif
