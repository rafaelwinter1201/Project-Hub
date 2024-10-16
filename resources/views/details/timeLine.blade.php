<div class="container mt-3">
    <h3 class="pb-2">Status da entrega: {{ $statusAtual }}</h3>
    <div class="progress-container">
        <div class="progress">
            <div class="progress-bar" role="progressbar" style ="width: {{ $percentualProgresso }}%;"
                aria-valuenow="{{ $percentualProgresso }}" aria-valuemin="0" aria-valuemax="100">
            </div>
        </div>
        <div class="waypoints fonte-t">

            @foreach ($statuses as $status)
                @php
                    $isActive = $statusProgresso[$status] <= $percentualProgresso;
                    $waypointClass = $isActive ? 'waypoint active' : 'waypoint';
                @endphp
                <div class="{{ $waypointClass }}"></div>
            @endforeach

        </div>
    </div>
    <div class="d-flex justify-content-between fonte-t">
        @foreach ($statuses as $status)
            <div class="waypoint-label"> {{ $status }}</div>
        @endforeach
    </div>
</div>
