@extends('templates.header', ['menu' => 'admin'])

@section('conteudo')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/templates/main.css') }}">

    <a href="{{ route('mesas.index') }}" class="btn btn-primary mb-4">Gerenciador de mesas</a>
    <div class="main d-flex border justify-content-around">
        <div class="col-md-7">
            <div class="grid-container" id="grid-container">
                @foreach ($mesas as $mesa)
                    @php
                        $sizeClass = '';
                        if ($mesa->tamanho == 'Pequena') {
                            $sizeClass = 'grid-size-50';
                        } elseif ($mesa->tamanho == 'Média') {
                            $sizeClass = 'grid-size-60';
                        } elseif ($mesa->tamanho == 'Grande') {
                            $sizeClass = 'grid-size-70';
                        }
                    @endphp
                    <div class="grid-item {{ $sizeClass }} border rounded" id="mesa-{{ $mesa->id }}"
                        data-mesa-id="{{ $mesa->id }}" data-mesa-numero="{{ $mesa->numero }}"
                        onclick="showAtendimentoDetails({{ $mesa->id }}, {{ json_encode($mesa) }})">
                        {{ $mesa->numero }}
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-5 d-flex border rounded justify-content-center align-items-center ml-3">
            <div id="mesa-details" class="text-center w-100">
                <h6><-- Selecione uma mesa</h6>
            </div>
        </div>
    </div>

    <script>
        const clientes = @json($clientes);
        const atendentes = @json($atendentes);

        let mesa_id_global;

        function showAtendimentoDetails(mesa_id, mesa) {
            mesa_id_global = mesa_id;
            const detailsDiv = document.getElementById('mesa-details');

            let clientesOptions = '<option value="">Selecione um cliente</option>';
            clientes.forEach(cliente => {
                clientesOptions += `<option value="${cliente.id}">${cliente.nome}</option>`;
            });

            let atendentesOptions = '<option value="">Selecione um atendente</option>';
            atendentes.forEach(atendente => {
                atendentesOptions += `<option value="${atendente.id}">${atendente.nome}</option>`;
            });

            detailsDiv.innerHTML = `
                <h3>Mesa ${mesa.numero}</h3>
                <div class="d-flex">
                    <p><strong>Número de pessoas:</strong></p>
                    <div class="stat-minus"><i class="material-icons" alt="Minus">exposure_neg_1</i></div>
                    <input id="num_pessoas" type="number" value="1" min="1" max="12"/>
                    <div class="stat-plus"><i class="material-icons" alt="Plus">exposure_plus_1</i></div>
                </div>
                <div class="d-flex">
                    <p><strong>Cliente:</strong></p> 
                    <select class="form-control" name="cliente" id="cliente-select" placeholder="Cliente">
                        ${clientesOptions}
                    </select>
                </div>
                <div class="d-flex">
                    <p><strong>Atendente:</strong></p> 
                    <select class="form-control" name="atendente" id="atendente-select" placeholder="atendente">
                        ${atendentesOptions}
                    </select>
                </div>
                <div class="d-flex">
                    <p><strong>Comentário:</strong></p>
                    <textarea name="comentario" id="comentario" cols="30" rows="5"></textarea>
                </div>
                <button class="btn_abrir btn btn-info" onclick="abrirMesa(${mesa_id})">Abrir mesa</button>
            `;

            document.querySelector('.stat-plus').addEventListener('click', function() {
                const numberInput = document.getElementById('num_pessoas');
                let currentValue = parseInt(numberInput.value);
                if (currentValue < numberInput.max) {
                    numberInput.value = currentValue + 1;
                }
            });

            document.querySelector('.stat-minus').addEventListener('click', function() {
                const numberInput = document.getElementById('num_pessoas');
                let currentValue = parseInt(numberInput.value);
                if (currentValue > numberInput.min) {
                    numberInput.value = currentValue - 1;
                }
            });
        }

        function abrirMesa(mesa_id) {
            const num_pessoas = document.getElementById('num_pessoas').value;
            const comentario = document.getElementById('comentario').value;
            const cliente_id = document.getElementById('cliente-select').value;
            const user_id = document.getElementById('atendente-select').value;

            fetch('/atendimentos', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        num_pessoas: num_pessoas,
                        comentario: comentario,
                        cliente_id: cliente_id,
                        mesa_id: mesa_id,
                        user_id: user_id,
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Erro ao enviar a requisição: ' + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Resposta recebida:', data);
                })
                .catch(error => {
                    console.error('Erro durante a requisição:', error);
                });
        }

        function showPedidoDetails(mesa_id, mesa) {
            const detailsDiv = document.getElementById('mesa-details');
            detailsDiv.innerHTML = ` 
                <h3> Detalhes da Mesa ${mesa.numero}</h3>
                <p><strong>ID da Mesa: </strong>${mesa.id}</p>
                <p><strong>Número da Mesa: </strong>${mesa.numero}</p>
                <p><strong>Tamanho: </strong>${mesa.tamanho}</p>
                <!--Adicione mais detalhes conforme necessário-->
            `;
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
@endsection
