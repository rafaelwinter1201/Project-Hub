<tr>
    <td colspan="11" class="text-center">
        <img src="{{ asset('images/moon_table.png') }}" alt="Descanso de Lua" class="w-5">
        <p>Não encontramos nenhum pedido com estes filtros... </p>
    </td>
</tr>

<script>
    console.log('{{ $response['x-total-items'] }}');
    document.getElementById('total-page').textContent = '{{ $response['x-total-pages'] }}';
    document.getElementById('Total').textContent = '{{ $response['x-total-items'] }}';
</script>
