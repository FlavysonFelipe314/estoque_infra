@extends('layouts.default')

@section('styles')
    <link rel="stylesheet" href="{{ asset('styles/user.css') }}">
@endsection

@section('body')
    <div class="container mx-auto p-6 lg:p-8">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                <h1 class="text-2xl font-bold text-slate-700">Gerenciamento de Fornecedores</h1>
                
                {{-- BOTÃO DE ADICIONAR FORNECEDOR (CORRIGIDO ID) --}}
                <button id="addFornecedorBtn" class="w-full md:w-auto bg-blue-600 text-white px-5 py-2.5 rounded-lg font-semibold hover:bg-blue-700 transition-colors flex items-center justify-center whitespace-nowrap shadow-sm">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    Adicionar Fornecedor
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-slate-50 text-slate-600">
                        <tr>
                            <th class="p-4 font-semibold">ID</th> 
                            <th class="p-4 font-semibold">CNPJ</th>
                            <th class="p-4 font-semibold">Razão Social</th>
                            <th class="p-4 font-semibold">Telefone</th>
                            <th class="p-4 font-semibold">Representante</th>
                            <th class="p-4 font-semibold text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ( $fornecedores as $fornecedor)
                            <tr class="border-b hover:bg-slate-50">
                                <td class="p-4">{{$fornecedor->id}}</td> 
                                <td class="p-4">{{$fornecedor->cnpj}}</td>
                                <td class="p-4 font-medium">{{$fornecedor->razao_social}}</td>
                                <td class="p-4">{{$fornecedor->telefone}}</td>
                                <td class="p-4">{{$fornecedor->representante}}</td>
                                <td class="p-4 flex items-center justify-center space-x-3">
                                    {{-- Botão Visualizar --}}
                                    <button class="text-slate-500 hover:text-slate-700" title="Visualizar"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg></button>
                                    {{-- Botão Editar --}}
                                    <button class="text-blue-500 hover:text-blue-700" title="Editar"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.5L16.732 3.732z"></path></svg></button>
                                    {{-- Formulário Deletar --}}
                                    <form action="{{ route('fornecedor.destroy', ['fornecedor'=>$fornecedor->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-500 hover:text-red-700" type="submit" title="Inativar"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg></button>
                                    </form>
                                </td>
                            </tr>                        
                        @empty
                            <tr><td colspan="6" class="p-4 text-center text-slate-500">Não existem Fornecedores cadastrados.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
{{-- Display de Erros/Mensagens (Manter) --}}
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
    
    {{-- Modal de Criação --}}
    <div id="fornecedor-modal" class="modal-backdrop">
        <div class="modal-content bg-white w-full max-w-2xl rounded-lg shadow-xl m-4">
            <div class="p-6 border-b">
                <div class="flex justify-between items-center">
                    <h2 id="modal-title" class="text-xl font-bold">Adicionar Novo Fornecedor</h2>
                    <button id="close-modal-btn-create" class="text-slate-500 hover:text-slate-800 text-3xl font-bold leading-none">&times;</button>
                </div>
            </div>
            <div class="p-6">
                <form id="fornecedor-form" action="{{ route('fornecedor.store') }}" method="POST" class="space-y-4">
                    @csrf                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="cnpj" class="block text-sm font-medium text-slate-700">CNPJ</label>
                            <input type="text" name="cnpj" id="cnpj" class="mt-1 block w-full border border-slate-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="razao_social" class="block text-sm font-medium text-slate-700">Razão Social</label>
                            <input type="text" name="razao_social" id="razao_social" class="mt-1 block w-full border border-slate-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="email" class="block text-sm font-medium text-slate-700">E-mail</label>
                            <input type="email" name="email" id="email" class="mt-1 block w-full border border-slate-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="telefone" class="block text-sm font-medium text-slate-700">Telefone</label>
                            <input type="text" name="telefone" id="telefone" class="mt-1 block w-full border border-slate-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="representante" class="block text-sm font-medium text-slate-700">Representante</label>
                            <input type="text" name="representante" id="representante" class="mt-1 block w-full border border-slate-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            {{-- Espaço Vazio --}}
                        </div>
                    </div>

                    <div class="p-6 bg-slate-50 rounded-b-lg flex justify-end space-x-3">
                        <button id="cancel-modal-btn-create" type="button" class="bg-white text-slate-700 px-4 py-2 rounded-lg border border-slate-300 hover:bg-slate-100 transition-colors">Cancelar</button>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-blue-700 transition-colors">Salvar Fornecedor</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    {{-- Modal de Edição --}}
    <div id="fornecedor-modal-update" class="modal-backdrop">
        <div class="modal-content bg-white w-full max-w-2xl rounded-lg shadow-xl m-4">
            <div class="p-6 border-b">
                <div class="flex justify-between items-center">
                    <h2 id="modal-title-update" class="text-xl font-bold">Atualizar Fornecedor</h2>
                    <button id="close-modal-btn-update" class="text-slate-500 hover:text-slate-800 text-3xl font-bold leading-none">&times;</button>
                </div>
            </div>
            <div class="p-6">
                <form id="fornecedor-form-update" action="" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="cnpj_update" class="block text-sm font-medium text-slate-700">CNPJ</label>
                            <input type="text" name="cnpj" id="cnpj_update" class="mt-1 block w-full border border-slate-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="razao_social_update" class="block text-sm font-medium text-slate-700">Razão Social</label>
                            <input type="text" name="razao_social" id="razao_social_update" class="mt-1 block w-full border border-slate-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="email_update" class="block text-sm font-medium text-slate-700">E-mail</label>
                            <input type="email" name="email" id="email_update" class="mt-1 block w-full border border-slate-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="telefone_update" class="block text-sm font-medium text-slate-700">Telefone</label>
                            <input type="text" name="telefone" id="telefone_update" class="mt-1 block w-full border border-slate-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="representante_update" class="block text-sm font-medium text-slate-700">Representante</label>
                            <input type="text" name="representante" id="representante_update" class="mt-1 block w-full border border-slate-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            {{-- Espaço Vazio --}}
                        </div>
                    </div>

                    <div class="p-6 bg-slate-50 rounded-b-lg flex justify-end space-x-3">
                        <button id="cancel-modal-btn-update" type="button" class="bg-white text-slate-700 px-4 py-2 rounded-lg border border-slate-300 hover:bg-slate-100 transition-colors">Cancelar</button>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-blue-700 transition-colors">Atualizar Fornecedor</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    {{-- Modal de Visualização --}}
    <div id="view-modal" class="modal-backdrop">
        <div class="modal-content bg-white w-full max-w-lg rounded-lg shadow-xl m-4">
            <div class="p-6 border-b">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-bold">Detalhes do Fornecedor</h2>
                    <button id="close-view-modal-btn" class="text-slate-500 hover:text-slate-800 text-3xl font-bold leading-none">&times;</button>
                </div>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <p class="text-sm text-slate-500">CNPJ</p>
                    <p id="view-cnpj" class="font-semibold text-lg"></p>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-slate-500">Razão Social</p>
                        <p id="view-razao" class="font-semibold"></p>
                    </div>
                    <div>
                        <p class="text-sm text-slate-500">Telefone</p>
                        <p id="view-telefone" class="font-semibold"></p>
                    </div>
                </div>
                <div>
                    <p class="text-sm text-slate-500">E-mail</p>
                    <p id="view-email" class="font-semibold"></p>
                </div>
                <div>
                    <p class="text-sm text-slate-500">Representante</p>
                    <p id="view-representante" class="font-semibold"></p>
                </div>
            </div>
            <div class="p-6 bg-slate-50 rounded-b-lg flex justify-end">
                <button id="ok-view-modal-btn" class="bg-white text-slate-700 px-4 py-2 rounded-lg border border-slate-300 hover:bg-slate-100 transition-colors">Fechar</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // 1. CARREGAMENTO E MAPEAMENTO DE DADOS 
            const fornecedores = {!! json_encode($fornecedores) !!}; 
            
            // Mapeia o array de Fornecedores por ID para acesso rápido
            const fornecedorDataSource = fornecedores.reduce((acc, fornecedor) => {
                const key = fornecedor.id; 
                if (key) {
                    acc[key] = fornecedor;
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

            // --- SELEÇÃO DE ELEMENTOS (CORRIGIDA) ---
            const fornecedorModal = document.getElementById('fornecedor-modal'); // Criação
            const fornecedorModalUpdate = document.getElementById('fornecedor-modal-update'); // Edição
            const viewModal = document.getElementById('view-modal');
            
            // CORREÇÃO AQUI: ID do botão de adicionar
            const addFornecedorBtn = document.getElementById('addFornecedorBtn'); 
            
            const editFornecedorButtons = document.querySelectorAll('button[title="Editar"]');
            const viewFornecedorButtons = document.querySelectorAll('button[title="Visualizar"]');
            
            // Criação
            const fornecedorForm = document.getElementById('fornecedor-form');
            const cancelModalCreateBtn = document.getElementById('cancel-modal-btn-create');
            const closeModalCreateBtn = document.getElementById('close-modal-btn-create');
            
            // Edição
            const fornecedorFormUpdate = document.getElementById('fornecedor-form-update');
            const modalTitleUpdate = document.getElementById('modal-title-update');
            const cancelModalUpdateBtn = document.getElementById('cancel-modal-btn-update');
            const closeModalUpdateBtn = document.getElementById('close-modal-btn-update');
            
            // Visualização
            const closeViewModalBtn = document.getElementById('close-view-modal-btn');
            const okViewModalBtn = document.getElementById('ok-view-modal-btn');

            // ------------------------------------------
            // ABRIR PARA ADICIONAR (CRIAÇÃO)
            // ------------------------------------------
            addFornecedorBtn.addEventListener('click', () => { 
                fornecedorForm.reset();
                fornecedorModal.querySelector('#modal-title').textContent = 'Adicionar Novo Fornecedor';
                
                // Garante que a action é a de store e o método é POST
                fornecedorForm.setAttribute('action', '{{ route('fornecedor.store') }}');
                
                openModal(fornecedorModal);
            });

            // Fechar modal de Criação
            closeModalCreateBtn.addEventListener('click', () => closeModal(fornecedorModal));
            cancelModalCreateBtn.addEventListener('click', () => closeModal(fornecedorModal));


            // ------------------------------------------
            // ABRIR PARA EDITAR (ATUALIZAÇÃO)
            // ------------------------------------------
            editFornecedorButtons.forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const row = e.currentTarget.closest('tr');
                    const fornecedorId = row.cells[0].textContent.trim(); 
                    const fornecedorData = fornecedorDataSource[fornecedorId];

                    if (fornecedorData) {
                        modalTitleUpdate.textContent = `Editar Fornecedor (ID: ${fornecedorId})`;
                        
                        // 1. CONFIGURA O ACTION DINAMICAMENTE
                        const updateRoute = '{{ route('fornecedor.update', ['fornecedor' => 'TEMP_ID']) }}';
                        const finalRoute = updateRoute.replace('TEMP_ID', fornecedorId);
                        fornecedorFormUpdate.setAttribute('action', finalRoute);
                        
                        // 2. PREENCHIMENTO DOS DADOS 
                        fornecedorFormUpdate.querySelector('[name="cnpj"]').value = fornecedorData.cnpj;
                        fornecedorFormUpdate.querySelector('[name="razao_social"]').value = fornecedorData.razao_social || '';
                        fornecedorFormUpdate.querySelector('[name="email"]').value = fornecedorData.email || ''; 
                        fornecedorFormUpdate.querySelector('[name="telefone"]').value = fornecedorData.telefone || '';
                        fornecedorFormUpdate.querySelector('[name="representante"]').value = fornecedorData.representante || '';
                        
                        openModal(fornecedorModalUpdate);
                    } else {
                        console.error("Fornecedor não encontrado para edição com ID:", fornecedorId);
                    }
                });
            });

            // Fechar modal de Edição
            closeModalUpdateBtn.addEventListener('click', () => closeModal(fornecedorModalUpdate));
            cancelModalUpdateBtn.addEventListener('click', () => closeModal(fornecedorModalUpdate));


            // ------------------------------------------
            // MODAL DE VISUALIZAÇÃO
            // ------------------------------------------
            viewFornecedorButtons.forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const row = e.currentTarget.closest('tr');
                    const fornecedorId = row.cells[0].textContent.trim(); 
                    const fornecedorData = fornecedorDataSource[fornecedorId];

                    if (fornecedorData) {
                        document.getElementById('view-cnpj').textContent = fornecedorData.cnpj;
                        document.getElementById('view-razao').textContent = fornecedorData.razao_social;
                        document.getElementById('view-telefone').textContent = fornecedorData.telefone;
                        document.getElementById('view-representante').textContent = fornecedorData.representante;
                        document.getElementById('view-email').textContent = fornecedorData.email;

                        openModal(viewModal);
                    }
                });
            });
            
            // Fechar modal de Visualização
            closeViewModalBtn.addEventListener('click', () => closeModal(viewModal));
            okViewModalBtn.addEventListener('click', () => closeModal(viewModal));

            // Fechar qualquer modal clicando no backdrop
            window.addEventListener('click', function(event) {
                if (event.target === fornecedorModal) closeModal(fornecedorModal);
                if (event.target === fornecedorModalUpdate) closeModal(fornecedorModalUpdate);
                if (event.target === viewModal) closeModal(viewModal);
            });
        });
    </script>
@endsection