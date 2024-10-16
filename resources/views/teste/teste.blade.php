@php 
    $boss = rand(1,3);
    switch ($boss) {
        case '1':
            $url = 'https://www.youtube.com/embed/dQw4w9WgXcQ';
            break;
        
        case '2':
            $url = 'https://www.youtube.com/embed/BpmWTyKt3hk';
            break;
        case '3' :
            $url = 'https://www.youtube.com/embed/7caT5jhPcLc';
            break;
    }
@endphp

<iframe style="width: 100%; height:100%" src="{{ $url }}"
    title="YouTube video player" frameborder="0"
    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>


    <script>
        $(document).ready(function() {
            $('#theme-toggle').on('click', function(e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ route('theme') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('body').attr('data-bs-theme', response.theme);
                        var imgSrc = response.theme === 'dark' ?
                            '{{ asset('images/sun.png') }}' : '{{ asset('images/moon.png') }}';
                        $('#theme-toggle img').attr('src', imgSrc);
                    }
                });
            });

            // Função para enviar o POST via AJAX
            function updateTable(data) {
                // Substituir o conteúdo do tbody com a nova view parcial
                $('#orders-table-body').html(data);
            }

            function sendPageRequest() {
                var page = $('#page').val();
                if (page) {
                    $.ajax({
                        url: '/filter',
                        type: 'POST',
                        data: {
                            page: page
                        },
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            $('#page').val(page);
                            updateTable(response);
                        },
                        error: function(xhr) {
                            console.error('Error:', xhr.responseText);
                        }
                    });
                }
            }

            // Enviar o POST quando o usuário clicar fora do input (blur)
            $('#page').on('blur', function() {
                console.log('Success:');
                sendPageRequest();
            });

            // Enviar o POST quando o usuário pressionar Enter
            $('#page').on('keydown', function(event) {
                if (event.key === 'Enter') {
                    console.log('Success:');
                    event.preventDefault(); // Evita o comportamento padrão do Enter
                    sendPageRequest();
                }
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            var statusElement = document.getElementById("status");
            var selectedOptionsDiv = document.getElementById("selectedOptions");
            var filtroForm = document.getElementById("filtro");

            if (statusElement && selectedOptionsDiv && filtroForm) {
                statusElement.addEventListener("change", function() {
                    var selectedValue = this.value;
                    if (selectedValue !== "") {
                        var newOptionSpan = document.createElement("span");
                        newOptionSpan.className = "selected-option";
                        newOptionSpan.textContent = selectedValue;

                        var deleteBtn = document.createElement("span");
                        deleteBtn.className = "delete-btn";
                        deleteBtn.innerHTML = '<img src="{{ asset('images/close.png') }}" alt="delete">';
                        deleteBtn.onclick = function() {
                            selectedOptionsDiv.removeChild(newOptionSpan);
                            hiddenInput.remove();

                            // Re-add the option to the select
                            var option = document.createElement("option");
                            option.value = selectedValue;
                            option.textContent = selectedValue;
                            statusElement.appendChild(option);
                        };

                        newOptionSpan.appendChild(deleteBtn);
                        selectedOptionsDiv.appendChild(newOptionSpan);

                        // Add a hidden input to the form
                        var hiddenInput = document.createElement("input");
                        hiddenInput.type = "hidden";
                        hiddenInput.name = "selectedOptions[]";
                        hiddenInput.value = selectedValue;
                        filtroForm.appendChild(hiddenInput);

                        // Remove the selected option from the select
                        this.options[this.selectedIndex].remove();
                        // Reset the select value
                        this.value = "";
                    }
                });
            }
        });
        // Espera até que o documento esteja completamente carregado
        document.addEventListener("DOMContentLoaded", function() {
            // Selecione todos os elementos com o atributo data-bs-toggle="tooltip"
            const tooltipTriggerList = document.querySelectorAll(
                '[data-bs-toggle="tooltip"]'
            );
            // Inicialize os tooltips para cada elemento
            tooltipTriggerList.forEach(function(tooltipTriggerEl) {
                new bootstrap.Tooltip(tooltipTriggerEl);
            });
            // Adicionando a lógica para habilitar/desabilitar input2
            const input1 = document.getElementById("input1");
            const input2 = document.getElementById("input2");

            input1.addEventListener("input", () => {
                if (input1.value) {
                    input2.disabled = false;
                } else {
                    input2.disabled = true;
                }
            });
        });
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
        document.getElementById('startDate').addEventListener('change', function() {
            var startDate = this.value;
            var endDateInput = document.getElementById('endDate');

            if (startDate) {
                endDateInput.disabled = false;
                endDateInput.min = startDate; // Opcional: define o mínimo da data de fim como a data de início
            } else {
                endDateInput.disabled = true;
                endDateInput.value = ''; // Opcional: limpa o valor da data de fim se a data de início for removida
            }
        });

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
        }
    </script>