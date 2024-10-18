<div class="col-auto pt-3 px-5">
    <div class="inline-block">
        <div class="px-2 no-wrap inline-block">
            <input type="text" value="{{ $actualpage }}" class="form-control w-3_5 text-center inline-block"
                pattern="[0-9]*" maxlength="3" name="page" id="page" required>
            <p class="no-wrap inline-block">
                de 
                <label id="total-page">{{ $totalpage }}</label>
            </p>
        </div>
        <ul class="pagination inline-block">
            <li class="page-item inline-block">
                <a class="page-link {{ $actualpage == 1 ? 'disabled' : '' }}" aria-label="Previous" id="botaoAnterior">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <li class="page-item inline-block">
                <a class="page-link {{ $actualpage == $totalpage ? 'disabled' : '' }}" aria-label="Next" id="botaoProximo">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </div>
</div>

@if ($messageerror)
    <div id="errorToast" class="toast align-items-center text-bg-danger z-3 position-fixed bottom-0 end-0"
        role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                Número de página inválido
            </div>
            <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast"
                aria-label="Close"></button>
        </div>
    </div>
@endif
