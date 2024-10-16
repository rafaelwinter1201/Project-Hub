<div class="row gx-0">
    <div class="col">
        <p class="d-inline-flex gap-1 pt-3">
            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
                aria-controls="offcanvasExample">
                <img src="{{ asset('images/filter.png') }}" alt="refresh" class="h-1_2" />
                <spam class="text-pt-9">
                    Filtros
                </spam>
            </button>
        </p>
    </div>

    <div class="col-auto pt-3 px-5">
        <div class="inline-block">
            <div class="px-2 no-wrap inline-block">
                <input type="text" value="{{ $actualpage }}" class="form-control w-3_5 text-center inline-block"
                    pattern="[0-9]*" maxlength="3" name="page" id="page" required>
                <p class="no-wrap inline-block">de {{ $totalpage }}</p>
            </div>
            <ul class="pagination inline-block">
                <li class="page-item inline-block">
                    <a class="page-link {{ $actualpage == 1 ? 'disabled' : '' }}"
                        aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li class="page-item inline-block">
                    <a class="page-link {{ $actualpage == $totalpage ? 'disabled' : '' }}"
                        aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

@if ($messageerror)
    <div id="errorToast" class="toast align-items-center text-bg-danger z-3 position-fixed bottom-0 end-0"
        role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                Número de página inválido
            </div>
            <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
@endif
