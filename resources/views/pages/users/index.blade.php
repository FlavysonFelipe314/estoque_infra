@extends('layouts.default')

@section('styles')
    <link rel="stylesheet" href="{{ asset('styles/user.css') }}">
@endsection

@section('body')
    <div class="container mx-auto p-6 lg:p-8">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                <h1 class="text-2xl font-bold text-slate-700">Gerenciamento de Usuários</h1>
                <button id="addUserBtn" class="w-full md:w-auto bg-blue-600 text-white px-5 py-2.5 rounded-lg font-semibold hover:bg-blue-700 transition-colors flex items-center justify-center whitespace-nowrap shadow-sm">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    Adicionar Usuário
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-slate-50 text-slate-600">
                        <tr>
                            <th class="p-4 font-semibold">ID</th> <th class="p-4 font-semibold">Matrícula</th>
                            <th class="p-4 font-semibold">Nome Completo</th>
                            <th class="p-4 font-semibold">Cargo</th>
                            <th class="p-4 font-semibold">Nível de Acesso</th>
                            <th class="p-4 font-semibold text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ( $users as $user)
                            <tr class="border-b hover:bg-slate-50">
                                <td class="p-4">{{$user->id}}</td> <td class="p-4">{{$user->matricula}}</td>
                                <td class="p-4 font-medium">{{$user->name}}</td>
                                <td class="p-4">{{$user->cargo}}</td>
                                <td class="p-4"><span class="px-2 py-1 text-xs font-semibold text-gray-800 bg-gray-200 rounded-full">{{$user->acesso}}</span></td>
                                <td class="p-4 flex items-center justify-center space-x-3">
                                    <button class="text-slate-500 hover:text-slate-700" title="Visualizar"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg></button>
                                    <button class="text-blue-500 hover:text-blue-700" title="Editar"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.5L16.732 3.732z"></path></svg></button>
                                    <form action="{{ route('usuario.destroy', ['user'=>$user->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-500 hover:text-red-700" type="submit" title="Inativar"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg></button>
                                    </form>
                                </td>
                            </tr>                        
                        @empty
                            <tr><td colspan="6" class="p-4 text-center text-slate-500">Não existem usuários cadastrados.</td></tr>
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
                    <h2 id="modal-title" class="text-xl font-bold">Adicionar Novo Usuário</h2>
                    <button id="close-modal-btn-create" class="text-slate-500 hover:text-slate-800 text-3xl font-bold leading-none">&times;</button>
                </div>
            </div>
            <div class="p-6">
                <form id="user-form" action="{{ route('usuario.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="user_id" id="user_id_create_hidden" value=""> 
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="nome" class="block text-sm font-medium text-slate-700">Nome Completo</label>
                            <input type="text" name="name" id="nome" class="mt-1 block w-full border border-slate-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="matricula" class="block text-sm font-medium text-slate-700">Matrícula</label>
                            <input type="text" name="matricula" id="matricula" class="mt-1 block w-full border border-slate-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="cargo" class="block text-sm font-medium text-slate-700">Cargo</label>
                            <input type="text" name="cargo" id="cargo" class="mt-1 block w-full border border-slate-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="setor" class="block text-sm font-medium text-slate-700">Setor</label>
                            <input type="text" name="setor" id="setor" class="mt-1 block w-full border border-slate-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="email" class="block text-sm font-medium text-slate-700">E-mail</label>
                            <input type="email" name="email" id="email" class="mt-1 block w-full border border-slate-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="telefone" class="block text-sm font-medium text-slate-700">Telefone</label>
                            <input type="tel" name="telefone" id="telefone" class="mt-1 block w-full border border-slate-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="cpf" class="block text-sm font-medium text-slate-700">CPF</label>
                            <input type="number" name="cpf" id="cpf" class="mt-1 block w-full border border-slate-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="acesso" class="block text-sm font-medium text-slate-700">Nível de Acesso</label>
                            <select id="acesso" name="acesso" class="mt-1 block w-full border border-slate-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option>Funcionário</option>
                                <option>Administrador</option>
                                <option>Solicitante</option>
                            </select>
                        </div>
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
                    <h2 id="modal-title-update" class="text-xl font-bold">Atualizar Usuário</h2>
                    <button id="close-modal-btn-update" class="text-slate-500 hover:text-slate-800 text-3xl font-bold leading-none">&times;</button>
                </div>
            </div>
            <div class="p-6">
                <form id="user-form-update" action="" method="POST" class="space-y-4">
                    @csrf

                    @method('PUT')
                    <input type="hidden" name="user_id" id="user_id_update_hidden">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="name_update" class="block text-sm font-medium text-slate-700">Nome Completo</label>
                            <input type="text" name="name" id="name_update" class="mt-1 block w-full border border-slate-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="matricula_update" class="block text-sm font-medium text-slate-700">Matrícula</label>
                            <input type="text" name="matricula" id="matricula_update" class="mt-1 block w-full border border-slate-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="cargo_update" class="block text-sm font-medium text-slate-700">Cargo</label>
                            <input type="text" name="cargo" id="cargo_update" class="mt-1 block w-full border border-slate-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="setor_update" class="block text-sm font-medium text-slate-700">Setor</label>
                            <input type="text" name="setor" id="setor_update" class="mt-1 block w-full border border-slate-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="email_update" class="block text-sm font-medium text-slate-700">E-mail</label>
                            <input type="email" name="email" id="email_update" class="mt-1 block w-full border border-slate-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="telefone_update" class="block text-sm font-medium text-slate-700">Telefone</label>
                            <input type="tel" name="telefone" id="telefone_update" class="mt-1 block w-full border border-slate-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="cpf_update" class="block text-sm font-medium text-slate-700">CPF</label>
                            <input type="number" name="cpf" id="cpf_update" class="mt-1 block w-full border border-slate-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="acesso_update" class="block text-sm font-medium text-slate-700">Nível de Acesso</label>
                            <select id="acesso_update" name="acesso" class="mt-1 block w-full border border-slate-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option>Funcionário</option>
                                <option>Administrador</option>
                                <option>Solicitante</option>
                            </select>
                        </div>
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
                    <h2 class="text-xl font-bold">Detalhes do Usuário</h2>
                    <button id="close-view-modal-btn" class="text-slate-500 hover:text-slate-800 text-3xl font-bold leading-none">&times;</button>
                </div>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <p class="text-sm text-slate-500">Nome Completo</p>
                    <p id="view-nome" class="font-semibold text-lg"></p>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-slate-500">Matrícula</p>
                        <p id="view-matricula" class="font-semibold"></p>
                    </div>
                    <div>
                        <p class="text-sm text-slate-500">Nível de Acesso</p>
                        <p id="view-nivel" class="font-semibold"></p>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-slate-500">Cargo</p>
                        <p id="view-cargo" class="font-semibold"></p>
                    </div>
                    <div>
                        <p class="text-sm text-slate-500">Setor</p>
                        <p id="view-setor" class="font-semibold"></p>
                    </div>
                </div>
                <div>
                    <p class="text-sm text-slate-500">Contato</p>
                    <p id="view-contato" class="font-semibold"></p>
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
            const users = {!! json_encode($users) !!}; 
            
            // Mapeia o array de usuários por ID para acesso rápido
            const userDataSource = users.reduce((acc, user) => {
                const key = user.id; // Usando o ID da primeira célula da tabela
                if (key) {
                    acc[key] = user;
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
            const userIdHiddenUpdate = document.getElementById('user_id_update_hidden');
            const cancelModalUpdateBtn = document.getElementById('cancel-modal-btn-update');
            const closeModalUpdateBtn = document.getElementById('close-modal-btn-update');
            
            // Visualização
            const closeViewModalBtn = document.getElementById('close-view-modal-btn');
            const okViewModalBtn = document.getElementById('ok-view-modal-btn');

            // ------------------------------------------
            // ABRIR PARA ADICIONAR (CRIAÇÃO)
            // ------------------------------------------
            addUserBtn.addEventListener('click', () => {
                userForm.reset();
                userModal.querySelector('#modal-title').textContent = 'Adicionar Novo Usuário';
                
                // Garante que o campo ID escondido está vazio para a criação
                userForm.querySelector('#user_id_create_hidden').value = ''; 
                
                openModal(userModal);
            });

            // Fechar modal de Criação
            closeModalCreateBtn.addEventListener('click', () => closeModal(userModal));
            cancelModalCreateBtn.addEventListener('click', () => closeModal(userModal));


            // ------------------------------------------
            // ABRIR PARA EDITAR (ATUALIZAÇÃO)
            // ------------------------------------------
            editUserButtons.forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const row = e.currentTarget.closest('tr');
                    // Pega o ID da primeira célula da tabela
                    const userId = row.cells[0].textContent.trim(); 
                    const userData = userDataSource[userId];

                    if (userData) {
                        modalTitleUpdate.textContent = `Editar Usuário (ID: ${userId})`;
                        
                        // 1. CONFIGURA O ACTION DO FORMULÁRIO DINAMICAMENTE
                        // A rota "usuario.update" deve existir e esperar um parâmetro {user}
                        // Ex: Route::patch('/usuarios/{user}', [SeuController::class, 'update'])->name('usuario.update');
                        
                        // Usando a rota de update padrão do Laravel (assumindo que você a criou):
                        const updateRoute = '{{ route('usuario.update', ['user' => 'TEMP_ID']) }}';
                        const finalRoute = updateRoute.replace('TEMP_ID', userId);
                        userFormUpdate.setAttribute('action', finalRoute);
                        
                        // 2. PREENCHIMENTO DOS DADOS
                        userFormUpdate.querySelector('[name="name"]').value = userData.name;
                        userFormUpdate.querySelector('[name="matricula"]').value = userData.matricula || '';
                        userFormUpdate.querySelector('[name="cargo"]').value = userData.cargo || '';
                        userFormUpdate.querySelector('[name="setor"]').value = userData.setor || '';
                        userFormUpdate.querySelector('[name="email"]').value = userData.email;
                        userFormUpdate.querySelector('[name="telefone"]').value = userData.telefone || '';
                        userFormUpdate.querySelector('[name="cpf"]').value = userData.cpf;
                        userFormUpdate.querySelector('[name="acesso"]').value = userData.acesso;
                        
                        openModal(userModalUpdate);
                    } else {
                        console.error("Usuário não encontrado para edição com ID:", userId);
                    }
                });
            });

            // Fechar modal de Edição
            closeModalUpdateBtn.addEventListener('click', () => closeModal(userModalUpdate));
            cancelModalUpdateBtn.addEventListener('click', () => closeModal(userModalUpdate));


            // ------------------------------------------
            // MODAL DE VISUALIZAÇÃO
            // ------------------------------------------
            viewUserButtons.forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const row = e.currentTarget.closest('tr');
                    const userId = row.cells[0].textContent.trim(); 
                    const userData = userDataSource[userId];

                    if (userData) {
                        document.getElementById('view-nome').textContent = userData.name;
                        document.getElementById('view-matricula').textContent = userData.matricula || 'N/A';
                        document.getElementById('view-nivel').innerHTML = row.cells[4].innerHTML; // Pega a 5ª célula (Nível)
                        document.getElementById('view-cargo').textContent = userData.cargo;
                        document.getElementById('view-setor').textContent = userData.setor;
                        document.getElementById('view-contato').textContent = `${userData.email} | ${userData.telefone}`;
                        openModal(viewModal);
                    }
                });
            });
            
            // Fechar modal de Visualização
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