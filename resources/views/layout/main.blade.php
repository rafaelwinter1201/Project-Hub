<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Sway Hub</title>
    @livewireStyles
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/icon.ico') }}" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.0.1/dist/css/multi-select-tag.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
</head>

<body data-bs-theme="{{ $theme }}">
    @include('partials.navigator')
    <main>
        @yield('content')
    </main>
    @include('partials.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DAQUI PRA BAIXO É SÓ TRISTEZA -->
    <script>
        // Funções de Utilidade
        const Utils = {
            ajaxRequest: function(url, method, data, onSuccess, onError) {
                $.ajax({
                    url: url,
                    method: method,
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: onSuccess,
                    error: onError
                });
            },

            updateTable: function(data) {
                $('#orders-table-body').html(data);
            },

            updateTheme: function(theme) {
                $('body').attr('data-bs-theme', theme);
                var imgSrc = theme === 'dark' ?
                    '{{ asset('images/sun.png') }}' : '{{ asset('images/moon.png') }}';
                $('#theme-toggle img').attr('src', imgSrc);
            }
        };

        // Manipuladores de Eventos
        const EventHandlers = {
            themeToggleClick: function(e) {
                e.preventDefault();
                Utils.ajaxRequest('{{ route('theme') }}', 'POST', {
                        _token: '{{ csrf_token() }}'
                    },
                    function(response) {
                        Utils.updateTheme(response.theme);
                    }
                );
            },

            statusChange: function() {
                var selectedValue = this.value;
                if (selectedValue !== "") {
                    var newOptionSpan = document.createElement("span");
                    newOptionSpan.className = "selected-option";
                    newOptionSpan.textContent = selectedValue;

                    var deleteBtn = document.createElement("span");
                    deleteBtn.className = "delete-btn";
                    deleteBtn.innerHTML =
                        '<img src="{{ asset('images/close.png') }}" alt="delete" class="brilho-close">';
                    deleteBtn.onclick = function() {
                        var selectedOptionsDiv = document.getElementById("selectedOptions");
                        selectedOptionsDiv.removeChild(newOptionSpan);
                        hiddenInput.remove();

                        // Re-add the option to the select
                        var option = document.createElement("option");
                        option.value = selectedValue;
                        option.textContent = selectedValue;
                        document.getElementById("status").appendChild(option);
                    };

                    newOptionSpan.appendChild(deleteBtn);
                    document.getElementById("selectedOptions").appendChild(newOptionSpan);

                    // Add a hidden input to the form
                    var hiddenInput = document.createElement("input");
                    hiddenInput.type = "hidden";
                    hiddenInput.name = "selectedOptions[]";
                    hiddenInput.value = selectedValue;
                    document.getElementById("filtro").appendChild(hiddenInput);

                    // Remove the selected option from the select
                    this.options[this.selectedIndex].remove();
                    // Reset the select value
                    this.value = "";
                }
            }
        };

        // Inicialização
        $(document).ready(function() {
            // Tema
            $('#theme-toggle').on('click', EventHandlers.themeToggleClick);

            // Filtro de Status
            document.getElementById("status").addEventListener("change", EventHandlers.statusChange);

            // Tooltips
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
            tooltipTriggerList.forEach(function(tooltipTriggerEl) {
                new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });

        // Função de exemplo para inicializar o estado inicial ou outros elementos
        function initializeApp() {
            var selectedOptions = {!! !empty($filtros['selectedOptions']) ? json_encode($filtros['selectedOptions']) : '[]' !!}; // Mudando de '""' para '[]'

            // Verifica se selectedOptions é um array
            if (!Array.isArray(selectedOptions)) {
                selectedOptions = []; // Inicializa como array vazio se não for
            }

            selectedOptions.forEach(function(optionValue) {
                var newOptionSpan = document.createElement("span");
                newOptionSpan.className = "selected-option";
                newOptionSpan.textContent = optionValue;

                var deleteBtn = document.createElement("span");
                deleteBtn.className = "delete-btn";
                deleteBtn.innerHTML =
                    '<img src="{{ asset('images/close.png') }}" alt="delete" class="brilho-close">';
                deleteBtn.onclick = function() {
                    var selectedOptionsDiv = document.getElementById("selectedOptions");
                    selectedOptionsDiv.removeChild(newOptionSpan);
                    hiddenInput.remove();

                    // Re-add the option to the select
                    var option = document.createElement("option");
                    option.value = optionValue;
                    option.textContent = optionValue;
                    document.getElementById("status").appendChild(option);
                };

                newOptionSpan.appendChild(deleteBtn);
                document.getElementById("selectedOptions").appendChild(newOptionSpan);

                // Add a hidden input to the form
                var hiddenInput = document.createElement("input");
                hiddenInput.type = "hidden";
                hiddenInput.name = "selectedOptions[]";
                hiddenInput.value = optionValue;
                document.getElementById("filtro").appendChild(hiddenInput);

                // Remove the selected option from the select
                Array.from(document.getElementById("status").options).forEach(function(option) {
                    if (option.value === optionValue) {
                        option.remove();
                    }
                });
            });
        }
        $(document).ready(function() {
            // Evento para o botão de filtrar
            $('#filtro').on('submit', function(e) {
                e.preventDefault(); // Evita o envio normal do formulário
                var formData = $(this).serialize(); // Serializa os dados do formulário

                // Envia o formulário via AJAX usando a função Utils
                Utils.ajaxRequest('{{ route('filter') }}', 'POST', formData, function(response) {
                    // Lógica de sucesso - MEXER AQUI EM CASO DE SUCESSO
                    console.log(response)
                    Utils.updateTable(response);
                }, function(xhr, status, error) {
                    // Lógica de erro
                    console.error(xhr.responseText);
                });
            });

            // Evento para o botão de navegação "Anterior"
            $('#botaoAnterior').on('click', function(e) {
                e.preventDefault(); // Evita o comportamento padrão do link
                $('#buttonPressed').val('botaoAnterior'); // Define o valor no campo oculto
                console.log('Botão pressionado:', $('#buttonPressed').val()); // Verifica o valor
                $('#filtro').submit(); // Envia o formulário
            });

            // Evento para o botão de navegação "Próximo"
            $('#botaoProximo').on('click', function(e) {
                e.preventDefault(); // Evita o comportamento padrão do link
                $('#buttonPressed').val('botaoProximo'); // Define o valor no campo oculto
                console.log('Botão pressionado:', $('#buttonPressed').val()); // Verifica o valor
                $('#filtro').submit(); // Envia o formulário
            });

            $('#page').on('blur', function() {
                $('#filtro').submit(); // Envia o formulário
            });

            // Evento para o botão de navegação "Próximo"
            $('#filtrar').on('click', function() {
                $('#filtro').submit(); // Envia o formulário
            });

            // Evento para o filtro de data de criação
            $('#startDate').on('change', function() {
                // Verifica se há uma data válida no startDate
                if ($(this).val()) {
                    // Se houver, habilita o campo endDate
                    $('#endDate').removeClass('disabled').prop('disabled', false);
                } else {
                    // Se não houver data, desabilita o campo endDate
                    $('#endDate').addClass('disabled').prop('disabled', true);
                }
            });
        });


        // Inicialização da aplicação
        document.addEventListener("DOMContentLoaded", initializeApp);
    </script>
    <script>
        function limparCampos() {
            // Limpa os campos de entrada
            document.getElementById("search").value = "";
            document.getElementById("status").value = "";
            document.getElementById("fornecedor").value = "";
            document.getElementById("startDate").value = "";
            document.getElementById("endDate").value = "";

            // Limpa selectedOptionsDiv
            var selectedOptionsDiv = document.getElementById("selectedOptions");
            while (selectedOptionsDiv.firstChild) {
                selectedOptionsDiv.removeChild(selectedOptionsDiv.firstChild);
            }

            $('#endDate').addClass('disabled').prop('disabled', true);

            // Remove todos os inputs ocultos
            var hiddenInputs = document.querySelectorAll('input[name="selectedOptions[]"]');
            hiddenInputs.forEach(function(input) {
                input.remove();
            });
            // Re-adiciona todas as opções removidas ao select status
            var selectElement = document.getElementById("status");
            var selectedOptions = ""; // Adapte isso conforme necessário
            selectedOptions.forEach(function(optionValue) {
                var option = document.createElement("option");
                option.value = optionValue;
                option.textContent = optionValue;
                selectElement.appendChild(option);
            });
        };
        // Seleciona todos os itens de dropdown com a classe 'copy-text'
        const dropdownItems = document.querySelectorAll(".copy-text");

        // Adiciona um listener de evento de clique para cada item de dropdown
        dropdownItems.forEach((item) => {
            item.addEventListener("click", function(event) {
                // Previne o comportamento padrão do link
                event.preventDefault();

                // Obtém o texto do atributo 'data-text'
                const textToCopy = this.getAttribute("data-text");

                // Cria um elemento de texto temporário
                const tempTextarea = document.createElement("textarea");
                tempTextarea.value = textToCopy;

                // Adiciona o elemento de texto temporário ao DOM
                document.body.appendChild(tempTextarea);

                // Seleciona todo o texto no elemento de texto temporário
                tempTextarea.select();

                // Copia o texto para a área de transferência
                document.execCommand("copy");

                // Remove o elemento de texto temporário do DOM
                document.body.removeChild(tempTextarea);

                // Exibe o toast de sucesso
                const copyToast = new bootstrap.Toast(
                    document.getElementById("copyToast")
                );
                copyToast.show();
            });
        });
    </script>
    @livewireScripts

</body>

</html>
