<div class="row pt-3 border-top-0">
    <strong>Data de criação</strong>
    <div class="mx-4 mb-5">
        <small>
            <b>inicio</b>
        </small>
        <input type="date" id="startDate" name="startDate" class="form-control w-10"
            value="{{ isset($response['filtros']['startDate']) ? $response['filtros']['startDate'] : '' }}"
            min="2000-01-01" max="{{ date('Y-m-d') }}" wire:model="startDate" />
        <small>
            <b>fim</b>
        </small>
        <input type="date" id="endDate" name="endDate" class="form-control w-10"
            value="{{ isset($response['filtros']['endDate']) ? $response['filtros']['endDate'] : '' }}" min="2000-12-01"
            max="{{ date('Y-m-d') }}" data-error="Data inválida." title="Data inválida."
            oninvalid="this.setCustomValidity('Data inválida.')" wire:model="endDate"
            @if ($endDateDisabled) disabled @endif />
    </div>
</div>

<script>
    document.addEventListener('livewire:load', function() {
        Livewire.on('updatedStartDate', function(startDate) {
            console.log("Data Início atualizada: ", startDate);
        });
    });
</script>
