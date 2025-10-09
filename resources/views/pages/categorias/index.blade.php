@extends('layouts.default')

@section('styles')
    <link rel="stylesheet" href="{{ asset('styles/user.css') }}">
@endsection

@section('body')
    <div class="container mx-auto p-6 lg:p-8">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                <h1 class="text-2xl font-bold text-slate-700">Gerenciamento de Categorias</h1>
                <button id="addUserBtn" class="w-full md:w-auto bg-blue-600 text-white px-5 py-2.5 rounded-lg font-semibold hover:bg-blue-700 transition-colors flex items-center justify-center whitespace-nowrap shadow-sm">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    Adicionar Categoria
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-slate-50 text-slate-600">
                        <tr>
                            <th class="p-4 font-semibold">ID</th>
                            <th class="p-4 font-semibold">Nome</th>
                            <th class="p-4 font-semibold text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ( $categorias as $categoria)
                            <tr class="border-b hover:bg-slate-50">
                                <td class="p-4">{{$categoria->id}}</td>
                                <td class="p-4 font-medium">{{$categoria->nome}}</td>
                                <td class="p-4 flex items-center justify-center space-x-3">
                                    <button class="text-slate-500 hover:text-slate-700" title="Visualizar"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg></button>
                                    <button class="text-blue-500 hover:text-blue-700" title="Editar"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.5L16.732 3.732z"></path></svg></button>
                                    <form action="{{ route('categoria.destroy', ['categoria'=>$categoria->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-500 hover:text-red-700" type="submit" title="Inativar"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg></button>
                                    </form>
                                </td>
                            </tr>                        
                        @empty
                            <tr><td colspan="6" class="p-4 text-center text-slate-500">Não existem categorias cadastrados.</td></tr>
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
    
    <div id="user-modal" class="modal-backdrop">
        <div class="modal-content bg-white w-full max-w-2xl rounded-lg shadow-xl m-4">
            <div class="p-6 border-b">
                <div class="flex justify-between items-center">
                    <h2 id="modal-title" class="text-xl font-bold">Adicionar Nova Categoria</h2>
                    <button id="close-modal-btn-create" class="text-slate-500 hover:text-slate-800 text-3xl font-bold leading-none">&times;</button>
                </div>
            </div>
            <div class="p-6">
                <form id="user-form" action="{{ route('categoria.store') }}" method="POST" class="space-y-4">
                    @csrf                    
                    <div>
                        <label for="nome" class="block text-sm font-medium text-slate-700">Nome</label>
                        <input type="text" name="nome" id="nome" class="mt-1 block w-full border border-slate-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div class="p-6 bg-slate-50 rounded-b-lg flex justify-end space-x-3">
                        <button id="cancel-modal-btn-create" type="button" class="bg-white text-slate-700 px-4 py-2 rounded-lg border border-slate-300 hover:bg-slate-100 transition-colors">Cancelar</button>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-blue-700 transition-colors">Salvar Usuário</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div id="user-modal-update" class="modal-backdrop">
        <div class="modal-content bg-white w-full max-w-2xl rounded-lg shadow-xl m-4">
            <div class="p-6 border-b">
                <div class="flex justify-between items-center">
                    <h2 id="modal-title-update" class="text-xl font-bold">Atualizar Categoria</h2>
                    <button id="close-modal-btn-update" class="text-slate-500 hover:text-slate-800 text-3xl font-bold leading-none">&times;</button>
                </div>
            </div>
            <div class="p-6">
                <form id="user-form-update" action="" method="POST" class="space-y-4">
                    @csrf

                    @method('PUT')                    
                    <div>
                        <label for="nome_update" class="block text-sm font-medium text-slate-700">Nome Completo</label>
                        <input type="text" name="nome" id="nome_update" class="mt-1 block w-full border border-slate-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div class="p-6 bg-slate-50 rounded-b-lg flex justify-end space-x-3">
                        <button id="cancel-modal-btn-update" type="button" class="bg-white text-slate-700 px-4 py-2 rounded-lg border border-slate-300 hover:bg-slate-100 transition-colors">Cancelar</button>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-blue-700 transition-colors">Atualizar Usuário</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div id="view-modal" class="modal-backdrop">
        <div class="modal-content bg-white w-full max-w-lg rounded-lg shadow-xl m-4">
            <div class="p-6 border-b">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-bold">Detalhes da Categoria</h2>
                    <button id="close-view-modal-btn" class="text-slate-500 hover:text-slate-800 text-3xl font-bold leading-none">&times;</button>
                </div>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <p class="text-sm text-slate-500">Nome</p>
                    <p id="view-nome" class="font-semibold text-lg"></p>
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
        // A variável do Blade é $categorias, e os dados são mapeados em 'categoriaDataSource'.
        const categorias = {!! json_encode($categorias) !!}; 
        
        // Mapeia o array de categorias por ID para acesso rápido
        const categoriaDataSource = categorias.reduce((acc, categoria) => {
            const key = categoria.id; 
            if (key) {
                acc[key] = categoria;
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
        const userModal = document.getElementById('user-modal'); // Criação
        const userModalUpdate = document.getElementById('user-modal-update'); // Edição
        const viewModal = document.getElementById('view-modal');
        
        const addUserBtn = document.getElementById('addUserBtn');
        const editUserButtons = document.querySelectorAll('button[title="Editar"]');
        const viewUserButtons = document.querySelectorAll('button[title="Visualizar"]');
        
        // Criação
        const userForm = document.getElementById('user-form');
        const cancelModalCreateBtn = document.getElementById('cancel-modal-btn-create');
        const closeModalCreateBtn = document.getElementById('close-modal-btn-create');
        
        // Edição
        const userFormUpdate = document.getElementById('user-form-update');
        const modalTitleUpdate = document.getElementById('modal-title-update');
        const cancelModalUpdateBtn = document.getElementById('cancel-modal-btn-update');
        const closeModalUpdateBtn = document.getElementById('close-modal-btn-update');
        
        // ------------------------------------------
        // ABRIR PARA ADICIONAR (CRIAÇÃO)
        // ------------------------------------------
        addUserBtn.addEventListener('click', () => {
            userForm.reset();
            userModal.querySelector('#modal-title').textContent = 'Adicionar Nova Categoria';
            openModal(userModal);
        });

        // Fechar modal de Criação
        closeModalCreateBtn.addEventListener('click', () => closeModal(userModal));
        cancelModalCreateBtn.addEventListener('click', () => closeModal(userModal));


        // ------------------------------------------
        // ABRIR PARA EDITAR (ATUALIZAÇÃO) -> CORRIGIDO
        // ------------------------------------------
        editUserButtons.forEach(btn => {
            btn.addEventListener('click', (e) => {
                const row = e.currentTarget.closest('tr');
                const categoriaId = row.cells[0].textContent.trim(); 
                const categoriaData = categoriaDataSource[categoriaId]; // Usando categoriaDataSource

                if (categoriaData) { // Usando categoriaData
                    modalTitleUpdate.textContent = `Editar Categoria (ID: ${categoriaId})`;
                    
                    // 1. CONFIGURA O ACTION DO FORMULÁRIO DINAMICAMENTE
                    const updateRoute = '{{ route('categoria.update', ['categoria' => 'TEMP_ID']) }}';
                    const finalRoute = updateRoute.replace('TEMP_ID', categoriaId);
                    userFormUpdate.setAttribute('action', finalRoute);
                    
                    // 2. PREENCHIMENTO DOS DADOS
                    // A categoria só tem o campo 'nome'
                    userFormUpdate.querySelector('[name="nome"]').value = categoriaData.nome; 
                    
                    openModal(userModalUpdate);
                } else {
                    console.error("Categoria não encontrada para edição com ID:", categoriaId);
                }
            });
        });

        // Fechar modal de Edição
        closeModalUpdateBtn.addEventListener('click', () => closeModal(userModalUpdate));
        cancelModalUpdateBtn.addEventListener('click', () => closeModal(userModalUpdate));


        // ------------------------------------------
        // MODAL DE VISUALIZAÇÃO -> CORRIGIDO
        // ------------------------------------------
        viewUserButtons.forEach(btn => {
            btn.addEventListener('click', (e) => {
                const row = e.currentTarget.closest('tr');
                const categoriaId = row.cells[0].textContent.trim(); 
                const categoriaData = categoriaDataSource[categoriaId]; // Usando categoriaDataSource

                if (categoriaData) {
                    // A categoria só tem o campo 'nome'
                    document.getElementById('view-nome').textContent = categoriaData.nome;
                    
                    // Limpando ou escondendo campos não existentes em Categoria
                    // (O modal de visualização original tem campos de user, se não usarmos, é melhor limpá-los)
                    if (document.getElementById('view-matricula')) document.getElementById('view-matricula').textContent = '';
                    if (document.getElementById('view-nivel')) document.getElementById('view-nivel').innerHTML = '';
                    if (document.getElementById('view-cargo')) document.getElementById('view-cargo').textContent = '';
                    if (document.getElementById('view-setor')) document.getElementById('view-setor').textContent = '';
                    if (document.getElementById('view-contato')) document.getElementById('view-contato').textContent = '';


                    openModal(viewModal);
                } else {
                    console.error("Categoria não encontrada para visualização com ID:", categoriaId);
                }
            });
        });
        
        // Fechar modal de Visualização
        const closeViewModalBtn = document.getElementById('close-view-modal-btn');
        const okViewModalBtn = document.getElementById('ok-view-modal-btn');
        closeViewModalBtn.addEventListener('click', () => closeModal(viewModal));
        okViewModalBtn.addEventListener('click', () => closeModal(viewModal));

        // Fechar qualquer modal clicando no backdrop
        window.addEventListener('click', function(event) {
            if (event.target === userModal) closeModal(userModal);
            if (event.target === userModalUpdate) closeModal(userModalUpdate);
            if (event.target === viewModal) closeModal(viewModal);
        });
    });
</script>
@endsection