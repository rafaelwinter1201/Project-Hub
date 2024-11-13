<div class="container mt-3">
    <!-- Título do Status -->
    <h3 class="pb-2" style="text-align: left !important">Status da entrega: {{ $statusAtual }}</h3>

    <!-- Barra de Progresso -->
    <div class="progress-container">
        <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: {{ $percentualProgresso }}%;"
                aria-valuenow="{{ $percentualProgresso }}" aria-valuemin="0" aria-valuemax="100"></div>
        </div>

        <!-- Waypoints (bolinhas sobre a barra) -->
        <div class="waypoints">
            @foreach ($statuses as $status)
                @php
                    $isActive = $statusProgresso[$status] <= $percentualProgresso;
                    $waypointClass = $isActive ? 'waypoint active' : 'waypoint';
                @endphp
                <div class="{{ $waypointClass }}"></div>
            @endforeach
        </div>
    </div>

    <!-- Labels dos Status (abaixo da barra) -->
    <div class="labels-container d-flex justify-content-between mt-2">
        @foreach ($statuses as $status)
            <div class="waypoint-label no-wrap">{{ $status }}</div>
        @endforeach
    </div>
</div>
