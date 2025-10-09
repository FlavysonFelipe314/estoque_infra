@extends('layouts.default')

@section('styles')
    <link rel="stylesheet" href="{{ asset('styles/user.css') }}">
@endsection

@section('body')
    <div class="container mx-auto p-6 lg:p-8">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                <h1 class="text-2xl font-bold text-slate-700">Gerenciamento de Unidades</h1>
                <button id="addUnidadeBtn" class="w-full md:w-auto bg-blue-600 text-white px-5 py-2.5 rounded-lg font-semibold hover:bg-blue-700 transition-colors flex items-center justify-center whitespace-nowrap shadow-sm">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    Adicionar Unidade
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-slate-50 text-slate-600">
                        <tr>
                            <th class="p-4 font-semibold">ID</th>
                            <th class="p-4 font-semibold">Nome</th>
                            <th class="p-4 font-semibold">Simbolo</th>
                            <th class="p-4 font-semibold text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ( $unidades as $unidade)
                            <tr class="border-b hover:bg-slate-50">
                                <td class="p-4">{{$unidade->id}}</td>
                                <td class="p-4 font-medium">{{$unidade->nome}}</td>
                                <td class="p-4">{{$unidade->simbolo}}</td>
                                <td class="p-4 flex items-center justify-center space-x-3">
                                    <button class="text-slate-500 hover:text-slate-700" title="Visualizar"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg></button>
                                    <button class="text-blue-500 hover:text-blue-700" title="Editar"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.5L16.732 3.732z"></path></svg></button>
                                    <form action="{{ route('unidade.destroy', ['unidade'=>$unidade->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-500 hover:text-red-700" type="submit" title="Inativar"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg></button>
                                    </form>
                                </td>
                            </tr>                        
                        @empty
                            <tr><td colspan="6" class="p-4 text-center text-slate-500">Não existem Unidades cadastrados.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@if ($errors->any())
    <div class="alert alert-danger">
        <h5>Ocorreram os seguintes erros de validação:</h5>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    {{ session('success') }}
@endif
@if (session('errror'))
    {{ session('error') }}
@endif
    
    <div id="Unidade-modal" class="modal-backdrop">
        <div class="modal-content bg-white w-full max-w-2xl rounded-lg shadow-xl m-4">
            <div class="p-6 border-b">
                <div class="flex justify-between items-center">
                    <h2 id="modal-title" class="text-xl font-bold">Adicionar Nova Unidade</h2>
                    <button id="close-modal-btn-create" class="text-slate-500 hover:text-slate-800 text-3xl font-bold leading-none">&times;</button>
                </div>
            </div>
            <div class="p-6">
                <form id="Unidade-form" action="{{ route('unidade.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="Unidade_id" id="Unidade_id_create_hidden" value=""> 
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="nome" class="block text-sm font-medium text-slate-700">Nome</label>
                            <input type="text" name="nome" id="nome" class="mt-1 block w-full border border-slate-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="matricula" class="block text-sm font-medium text-slate-700">Simbolo</label>
                            <input type="text" name="simbolo" id="simbolo" class="mt-1 block w-full border border-slate-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <div class="p-6 bg-slate-50 rounded-b-lg flex justify-end space-x-3">
                        <button id="cancel-modal-btn-create" type="button" class="bg-white text-slate-700 px-4 py-2 rounded-lg border border-slate-300 hover:bg-slate-100 transition-colors">Cancelar</button>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-blue-700 transition-colors">Salvar Unidade</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div id="Unidade-modal-update" class="modal-backdrop">
        <div class="modal-content bg-white w-full max-w-2xl rounded-lg shadow-xl m-4">
            <div class="p-6 border-b">
                <div class="flex justify-between items-center">
                    <h2 id="modal-title-update" class="text-xl font-bold">Atualizar Unidade</h2>
                    <button id="close-modal-btn-update" class="text-slate-500 hover:text-slate-800 text-3xl font-bold leading-none">&times;</button>
                </div>
            </div>
            <div class="p-6">
                <form id="Unidade-form-update" action="" method="POST" class="space-y-4">
                    @csrf

                    @method('PUT')
                    <input type="hidden" name="Unidade_id" id="Unidade_id_update_hidden">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="name_update" class="block text-sm font-medium text-slate-700">Nome</label>
                            <input type="text" name="nome" id="name_update" class="mt-1 block w-full border border-slate-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="matricula_update" class="block text-sm font-medium text-slate-700">Simbolo</label>
                            <input type="text" name="simbolo" id="simbolo_update" class="mt-1 block w-full border border-slate-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <div class="p-6 bg-slate-50 rounded-b-lg flex justify-end space-x-3">
                        <button id="cancel-modal-btn-update" type="button" class="bg-white text-slate-700 px-4 py-2 rounded-lg border border-slate-300 hover:bg-slate-100 transition-colors">Cancelar</button>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-blue-700 transition-colors">Atualizar Unidade</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div id="view-modal" class="modal-backdrop">
        <div class="modal-content bg-white w-full max-w-lg rounded-lg shadow-xl m-4">
            <div class="p-6 border-b">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-bold">Detalhes do Unidade</h2>
                    <button id="close-view-modal-btn" class="text-slate-500 hover:text-slate-800 text-3xl font-bold leading-none">&times;</button>
                </div>
            </div>
            <div class="p-6 space-y-4">

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-slate-500">Nome </p>
                        <p id="view-nome" class="font-semibold text-lg"></p>
                    </div>
                    <div>
                        <p class="text-sm text-slate-500">Simbolo</p>
                        <p id="view-simbolo" class="font-semibold"></p>
                    </div>
                </div>
            </div>
            <div class="p-6 bg-slate-50 rounded-b-lg flex justify-end">
                <button id="ok-view-modal-btn" class="bg-white text-slate-700 px-4 py-2 rounded-lg border border-slate-300 hover:bg-slate-100 transition-colors">Fechar</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // 1. CARREGAMENTO E MAPEAMENTO DE DADOS (CORRIGIDO)
            const unidades = {!! json_encode($unidades) !!}; 
            
            // Mapeia o array de Unidades por ID para acesso rápido
            const unidadeDataSource = unidades.reduce((acc, Unidade) => {
                const key = Unidade.id; // Usando o ID da primeira célula da tabela
                if (key) {
                    acc[key] = Unidade;
                }
                return acc;
            }, {});
            
            // --- CONTROLES GERAIS DO MODAL ---
            function openModal(modal) {
                modal.classList.add('active');
                setTimeout(() => modal.classList.add('visible'), 10);
                document.body.style.overflow = 'hidden';
            }

            function closeModal(modal) {
                modal.classList.remove('visible');
                setTimeout(() => {
                    modal.classList.remove('active');
                    document.body.style.overflow = '';
                }, 300);
            }

            // --- SELEÇÃO DE ELEMENTOS ---
            const UnidadeModal = document.getElementById('Unidade-modal'); // Criação
            const UnidadeModalUpdate = document.getElementById('Unidade-modal-update'); // Edição
            const viewModal = document.getElementById('view-modal');
            
            const addUnidadeBtn = document.getElementById('addUnidadeBtn');
            const editUnidadeButtons = document.querySelectorAll('button[title="Editar"]');
            const viewUnidadeButtons = document.querySelectorAll('button[title="Visualizar"]');
            
            // Criação
            const UnidadeForm = document.getElementById('Unidade-form');
            const cancelModalCreateBtn = document.getElementById('cancel-modal-btn-create');
            const closeModalCreateBtn = document.getElementById('close-modal-btn-create');
            
            // Edição
            const UnidadeFormUpdate = document.getElementById('Unidade-form-update');
            const modalTitleUpdate = document.getElementById('modal-title-update');
            const UnidadeIdHiddenUpdate = document.getElementById('Unidade_id_update_hidden');
            const cancelModalUpdateBtn = document.getElementById('cancel-modal-btn-update');
            const closeModalUpdateBtn = document.getElementById('close-modal-btn-update');
            
            // Visualização
            const closeViewModalBtn = document.getElementById('close-view-modal-btn');
            const okViewModalBtn = document.getElementById('ok-view-modal-btn');

            // ------------------------------------------
            // ABRIR PARA ADICIONAR (CRIAÇÃO)
            // ------------------------------------------
            addUnidadeBtn.addEventListener('click', () => {
                UnidadeForm.reset();
                UnidadeModal.querySelector('#modal-title').textContent = 'Adicionar Novo Unidade';
                
                // Garante que o campo ID escondido está vazio para a criação
                UnidadeForm.querySelector('#Unidade_id_create_hidden').value = ''; 
                
                openModal(UnidadeModal);
            });

            // Fechar modal de Criação
            closeModalCreateBtn.addEventListener('click', () => closeModal(UnidadeModal));
            cancelModalCreateBtn.addEventListener('click', () => closeModal(UnidadeModal));


            // ------------------------------------------
            // ABRIR PARA EDITAR (ATUALIZAÇÃO)
            // ------------------------------------------
            editUnidadeButtons.forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const row = e.currentTarget.closest('tr');
                    // Pega o ID da primeira célula da tabela
                    const UnidadeId = row.cells[0].textContent.trim(); 
                    const UnidadeData = unidadeDataSource[UnidadeId];

                    if (UnidadeData) {
                        modalTitleUpdate.textContent = `Editar Unidade (ID: ${UnidadeId})`;
                        
                        // 1. CONFIGURA O ACTION DO FORMULÁRIO DINAMICAMENTE
                        // A rota "unidade.update" deve existir e esperar um parâmetro {Unidade}
                        // Ex: Route::patch('/usuarios/{Unidade}', [SeuController::class, 'update'])->name('unidade.update');
                        
                        // Usando a rota de update padrão do Laravel (assumindo que você a criou):
                        const updateRoute = '{{ route('unidade.update', ['unidade' => 'TEMP_ID']) }}';
                        const finalRoute = updateRoute.replace('TEMP_ID', UnidadeId);
                        UnidadeFormUpdate.setAttribute('action', finalRoute);
                        
                        // 2. PREENCHIMENTO DOS DADOS
                        UnidadeFormUpdate.querySelector('[name="nome"]').value = UnidadeData.nome;
                        UnidadeFormUpdate.querySelector('[name="simbolo"]').value = UnidadeData.simbolo || '';
                        
                        openModal(UnidadeModalUpdate);
                    } else {
                        console.error("Unidade não encontrada para edição com ID:", UnidadeId);
                    }
                });
            });

            // Fechar modal de Edição
            closeModalUpdateBtn.addEventListener('click', () => closeModal(UnidadeModalUpdate));
            cancelModalUpdateBtn.addEventListener('click', () => closeModal(UnidadeModalUpdate));


            // ------------------------------------------
            // MODAL DE VISUALIZAÇÃO
            // ------------------------------------------
            viewUnidadeButtons.forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const row = e.currentTarget.closest('tr');
                    const UnidadeId = row.cells[0].textContent.trim(); 
                    const UnidadeData = unidadeDataSource[UnidadeId];

                    if (UnidadeData) {
                        document.getElementById('view-nome').textContent = UnidadeData.nome;
                        document.getElementById('view-simbolo').textContent = UnidadeData.simbolo;
                        openModal(viewModal);
                    }
                });
            });
            
            // Fechar modal de Visualização
            closeViewModalBtn.addEventListener('click', () => closeModal(viewModal));
            okViewModalBtn.addEventListener('click', () => closeModal(viewModal));

            // Fechar qualquer modal clicando no backdrop
            window.addEventListener('click', function(event) {
                if (event.target === UnidadeModal) closeModal(UnidadeModal);
                if (event.target === UnidadeModalUpdate) closeModal(UnidadeModalUpdate);
                if (event.target === viewModal) closeModal(viewModal);
            });
        });
    </script>
@endsection