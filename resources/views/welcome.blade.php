@extends('layouts.default')

@section('body')

            <header class="bg-white shadow-md p-4 sticky top-0 z-10">
                <h2 id="page-title" class="text-2xl font-bold text-slate-700">Dashboard</h2>
            </header>
            
            <main class="flex-1 p-6 overflow-y-auto">
                <!-- Seção Dashboard -->
                <div id="dashboard" class="content-section active fade-in">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
                            <div>
                                <p class="text-sm text-slate-500">Pedidos Pendentes</p>
                                <p class="text-3xl font-bold">12</p>
                            </div>
                            <div class="bg-yellow-100 text-yellow-600 p-3 rounded-full">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
                            <div>
                                <p class="text-sm text-slate-500">Itens com Estoque Baixo</p>
                                <p class="text-3xl font-bold">5</p>
                            </div>
                            <div class="bg-red-100 text-red-600 p-3 rounded-full">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
                            <div>
                                <p class="text-sm text-slate-500">Ordens de Serviço Ativas</p>
                                <p class="text-3xl font-bold">8</p>
                            </div>
                            <div class="bg-blue-100 text-blue-600 p-3 rounded-full">
                                 <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
                            <div>
                                <p class="text-sm text-slate-500">Serviços Concluídos (Mês)</p>
                                <p class="text-3xl font-bold">23</p>
                            </div>
                            <div class="bg-green-100 text-green-600 p-3 rounded-full">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Últimos Pedidos de Retirada -->
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <h3 class="text-lg font-semibold mb-4">Últimos Pedidos de Retirada</h3>
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm text-left">
                                    <thead class="bg-slate-50">
                                        <tr>
                                            <th class="p-3">Solicitante</th>
                                            <th class="p-3">Itens</th>
                                            <th class="p-3">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="border-b">
                                            <td class="p-3">João Silva</td>
                                            <td class="p-3">Cimento, Areia, Tijolos</td>
                                            <td class="p-3"><span class="px-2 py-1 text-xs font-semibold text-yellow-800 bg-yellow-200 rounded-full">Pendente</span></td>
                                        </tr>
                                        <tr class="border-b">
                                            <td class="p-3">Maria Oliveira</td>
                                            <td class="p-3">Luvas, Botas, Capacete</td>
                                            <td class="p-3"><span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-200 rounded-full">Aprovado</span></td>
                                        </tr>
                                        <tr class="border-b">
                                            <td class="p-3">Carlos Souza</td>
                                            <td class="p-3">Tinta, Pincel, Rolo</td>
                                            <td class="p-3"><span class="px-2 py-1 text-xs font-semibold text-slate-800 bg-slate-200 rounded-full">Atendido</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Ordens de Serviço Recentes -->
                         <div class="bg-white p-6 rounded-lg shadow-md">
                            <h3 class="text-lg font-semibold mb-4">Ordens de Serviço Recentes</h3>
                            <div class="space-y-4">
                                <div>
                                    <p class="font-semibold">Reparo de vazamento - Rua das Flores</p>
                                    <div class="w-full bg-gray-200 rounded-full h-2.5 mt-1">
                                        <div class="bg-blue-600 h-2.5 rounded-full" style="width: 75%"></div>
                                    </div>
                                    <p class="text-xs text-slate-500 mt-1">Status: Em Andamento</p>
                                </div>
                                <div>
                                    <p class="font-semibold">Operação tapa-buraco - Av. Principal</p>
                                    <div class="w-full bg-gray-200 rounded-full h-2.5 mt-1">
                                        <div class="bg-green-600 h-2.5 rounded-full" style="width: 100%"></div>
                                    </div>
                                    <p class="text-xs text-slate-500 mt-1">Status: Concluído</p>
                                </div>
                                 <div>
                                    <p class="font-semibold">Troca de lâmpadas - Praça Central</p>
                                    <div class="w-full bg-gray-200 rounded-full h-2.5 mt-1">
                                        <div class="bg-gray-400 h-2.5 rounded-full" style="width: 10%"></div>
                                    </div>
                                    <p class="text-xs text-slate-500 mt-1">Status: A Fazer</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Seção Gestão de Estoque -->
                <div id="estoque" class="content-section fade-in">
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <div class="flex flex-col md:flex-row justify-between items-center mb-4 gap-4">
                            <div class="relative w-full md:w-1/3">
                                <input type="text" placeholder="Buscar produto..." class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <svg class="w-5 h-5 text-slate-400 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <button class="w-full md:w-auto bg-blue-600 text-white px-5 py-2 rounded-lg font-semibold hover:bg-blue-700 transition-colors flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                Cadastrar Produto
                            </button>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left">
                                <thead class="bg-slate-50">
                                    <tr>
                                        <th class="p-3 font-semibold">Código</th>
                                        <th class="p-3 font-semibold">Produto</th>
                                        <th class="p-3 font-semibold">Categoria</th>
                                        <th class="p-3 font-semibold">Estoque Atual</th>
                                        <th class="p-3 font-semibold">Unidade</th>
                                        <th class="p-3 font-semibold">Estoque Mínimo</th>
                                        <th class="p-3 font-semibold">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-b hover:bg-slate-50">
                                        <td class="p-3">CIM-001</td>
                                        <td class="p-3 font-medium">Cimento CP II</td>
                                        <td class="p-3">Cimento e Agregados</td>
                                        <td class="p-3">150</td>
                                        <td class="p-3">Sacos (Sc)</td>
                                        <td class="p-3">50</td>
                                        <td class="p-3 flex items-center space-x-2">
                                            <button class="text-blue-500 hover:text-blue-700" title="Editar"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.5L16.732 3.732z"></path></svg></button>
                                            <button class="text-slate-500 hover:text-slate-700" title="Ver Histórico"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg></button>
                                        </td>
                                    </tr>
                                    <tr class="border-b hover:bg-slate-50">
                                        <td class="p-3">LUV-003</td>
                                        <td class="p-3 font-medium">Luva de Raspa</td>
                                        <td class="p-3">EPI</td>
                                        <td class="p-3 text-red-600 font-bold">8</td>
                                        <td class="p-3">Pares (Pr)</td>
                                        <td class="p-3">10</td>
                                        <td class="p-3 flex items-center space-x-2">
                                            <button class="text-blue-500 hover:text-blue-700" title="Editar"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.5L16.732 3.732z"></path></svg></button>
                                            <button class="text-slate-500 hover:text-slate-700" title="Ver Histórico"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg></button>
                                        </td>
                                    </tr>
                                    <!-- Outras linhas -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Seção Cadastros Essenciais -->
                <div id="cadastros" class="content-section fade-in">
                    <!-- Abas -->
                    <div class="mb-4 border-b border-gray-200">
                        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="cadastros-tabs">
                            <li class="mr-2">
                                <a href="#funcionarios" class="tab-link inline-block p-4 border-b-2 rounded-t-lg">Funcionários</a>
                            </li>
                             <li class="mr-2">
                                <a href="#categorias" class="tab-link inline-block p-4 border-b-2 rounded-t-lg">Categorias</a>
                            </li>
                             <li class="mr-2">
                                <a href="#unidades" class="tab-link inline-block p-4 border-b-2 rounded-t-lg">Unidades</a>
                            </li>
                             <li class="mr-2">
                                <a href="#fornecedores" class="tab-link inline-block p-4 border-b-2 rounded-t-lg">Fornecedores</a>
                            </li>
                        </ul>
                    </div>
                    <!-- Conteúdo das Abas -->
                    <div id="tab-content">
                        <div id="funcionarios" class="tab-pane bg-white p-6 rounded-lg shadow-md">
                           <h3 class="text-lg font-semibold mb-4">Gerenciar Funcionários</h3>
                           <!-- Conteúdo de funcionários -->
                        </div>
                        <div id="categorias" class="tab-pane bg-white p-6 rounded-lg shadow-md">
                           <h3 class="text-lg font-semibold mb-4">Gerenciar Categorias de Produtos</h3>
                           <!-- Conteúdo de categorias -->
                        </div>
                         <div id="unidades" class="tab-pane bg-white p-6 rounded-lg shadow-md">
                           <h3 class="text-lg font-semibold mb-4">Gerenciar Unidades de Medida</h3>
                           <!-- Conteúdo de unidades -->
                        </div>
                         <div id="fornecedores" class="tab-pane bg-white p-6 rounded-lg shadow-md">
                           <h3 class="text-lg font-semibold mb-4">Gerenciar Fornecedores</h3>
                           <!-- Conteúdo de fornecedores -->
                        </div>
                    </div>
                </div>
                
                 <!-- Seção Movimentações -->
                <div id="movimentacoes" class="content-section fade-in">
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-xl font-bold mb-4">Pedidos de Retirada de Material</h3>
                         <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left">
                                <thead class="bg-slate-50">
                                    <tr>
                                        <th class="p-3">Nº Pedido</th>
                                        <th class="p-3">Data</th>
                                        <th class="p-3">Solicitante</th>
                                        <th class="p-3">Justificativa</th>
                                        <th class="p-3">Status</th>
                                        <th class="p-3">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-b">
                                        <td class="p-3 font-medium">#1052</td>
                                        <td class="p-3">08/10/2025</td>
                                        <td class="p-3">João Silva</td>
                                        <td class="p-3">OS #234 - Reparo de calçada</td>
                                        <td class="p-3"><span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-200 rounded-full">Aprovado</span></td>
                                        <td class="p-3">
                                            <button class="bg-green-500 text-white px-3 py-1 text-xs rounded-md font-semibold hover:bg-green-600">Atender</button>
                                        </td>
                                    </tr>
                                     <tr class="border-b">
                                        <td class="p-3 font-medium">#1051</td>
                                        <td class="p-3">07/10/2025</td>
                                        <td class="p-3">Maria Oliveira</td>
                                        <td class="p-3">Manutenção da Praça Central</td>
                                        <td class="p-3"><span class="px-2 py-1 text-xs font-semibold text-yellow-800 bg-yellow-200 rounded-full">Pendente</span></td>
                                        <td class="p-3 flex space-x-2">
                                            <button class="bg-blue-500 text-white px-3 py-1 text-xs rounded-md font-semibold hover:bg-blue-600">Aprovar</button>
                                            <button class="bg-red-500 text-white px-3 py-1 text-xs rounded-md font-semibold hover:bg-red-600">Rejeitar</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Seção Ordens de Serviço -->
                <div id="servicos" class="content-section fade-in">
                     <div class="bg-white p-6 rounded-lg shadow-md">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-xl font-bold">Ordens de Serviço</h3>
                            <button class="bg-blue-600 text-white px-5 py-2 rounded-lg font-semibold hover:bg-blue-700 transition-colors">Criar Nova OS</button>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <!-- Card de OS -->
                            <div class="border rounded-lg p-4 flex flex-col justify-between hover:shadow-lg transition-shadow">
                                <div>
                                    <div class="flex justify-between items-start">
                                        <h4 class="font-bold text-lg">Operação tapa-buraco</h4>
                                        <span class="px-2 py-1 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">Em Andamento</span>
                                    </div>
                                    <p class="text-sm text-slate-500">Av. Principal, em frente ao nº 500</p>
                                    <p class="text-sm mt-2">Equipe: Carlos, João, Pedro</p>
                                </div>
                                <div class="mt-4 flex justify-end">
                                    <button class="text-sm text-blue-600 font-semibold">Ver Detalhes</button>
                                </div>
                            </div>
                            <div class="border rounded-lg p-4 flex flex-col justify-between hover:shadow-lg transition-shadow">
                                <div>
                                    <div class="flex justify-between items-start">
                                        <h4 class="font-bold text-lg">Troca de Lâmpadas</h4>
                                        <span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-200 rounded-full">Concluído</span>
                                    </div>
                                    <p class="text-sm text-slate-500">Praça da Matriz</p>
                                    <p class="text-sm mt-2">Equipe: Ricardo, Ana</p>
                                </div>
                                <div class="mt-4 flex justify-end">
                                    <button class="text-sm text-blue-600 font-semibold">Ver Detalhes</button>
                                </div>
                            </div>
                             <div class="border rounded-lg p-4 flex flex-col justify-between hover:shadow-lg transition-shadow">
                                <div>
                                    <div class="flex justify-between items-start">
                                        <h4 class="font-bold text-lg">Limpeza de bueiro</h4>
                                        <span class="px-2 py-1 text-xs font-semibold text-slate-800 bg-slate-200 rounded-full">A Fazer</span>
                                    </div>
                                    <p class="text-sm text-slate-500">Rua da Conceição, esquina com a 7 de Setembro</p>
                                    <p class="text-sm mt-2">Equipe: A definir</p>
                                </div>
                                <div class="mt-4 flex justify-end">
                                    <button class="text-sm text-blue-600 font-semibold">Ver Detalhes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                 <!-- Seção Relatórios -->
                <div id="relatorios" class="content-section fade-in">
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-xl font-bold mb-6">Central de Relatórios</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <!-- Card de Relatório -->
                            <div class="border rounded-lg p-4 hover:shadow-md transition-shadow">
                                <h4 class="font-bold">Inventário de Estoque</h4>
                                <p class="text-sm text-slate-600 mt-1">Gera uma lista completa de todos os produtos e suas quantidades atuais.</p>
                                <button class="mt-4 w-full bg-slate-600 text-white py-2 rounded-lg font-semibold hover:bg-slate-700">Gerar Relatório</button>
                            </div>
                            <div class="border rounded-lg p-4 hover:shadow-md transition-shadow">
                                <h4 class="font-bold">Consumo por Setor</h4>
                                <p class="text-sm text-slate-600 mt-1">Analisa a quantidade de materiais retirados por cada setor da secretaria.</p>
                                <button class="mt-4 w-full bg-slate-600 text-white py-2 rounded-lg font-semibold hover:bg-slate-700">Gerar Relatório</button>
                            </div>
                            <div class="border rounded-lg p-4 hover:shadow-md transition-shadow">
                                <h4 class="font-bold">Histórico de Ordens de Serviço</h4>
                                <p class="text-sm text-slate-600 mt-1">Detalha todas as OS executadas em um período, com fotos e materiais.</p>
                                <button class="mt-4 w-full bg-slate-600 text-white py-2 rounded-lg font-semibold hover:bg-slate-700">Gerar Relatório</button>
                            </div>
                        </div>
                    </div>
                </div>

            </main>
      
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navLinks = document.querySelectorAll('.nav-link');
            const contentSections = document.querySelectorAll('.content-section');
            const pageTitle = document.getElementById('page-title');

            // Função para navegar entre as seções
            function navigateTo(hash) {
                // Atualiza o link ativo na sidebar
                navLinks.forEach(link => {
                    if (link.getAttribute('href') === hash) {
                        link.classList.add('bg-slate-700', 'font-semibold');
                    } else {
                        link.classList.remove('bg-slate-700', 'font-semibold');
                    }
                });

                // Mostra a seção de conteúdo correspondente
                contentSections.forEach(section => {
                    if ('#' + section.id === hash) {
                        section.classList.add('active');
                        // Atualiza o título da página
                        pageTitle.textContent = section.id.charAt(0).toUpperCase() + section.id.slice(1).replace('-', ' ');
                         if(section.id === 'servicos') pageTitle.textContent = 'Ordens de Serviço';
                         if(section.id === 'estoque') pageTitle.textContent = 'Gestão de Estoque';
                         if(section.id === 'cadastros') pageTitle.textContent = 'Cadastros Essenciais';
                         if(section.id === 'movimentacoes') pageTitle.textContent = 'Movimentações';
                    } else {
                        section.classList.remove('active');
                    }
                });
            }

            // Lógica de navegação
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetHash = this.getAttribute('href');
                    window.location.hash = targetHash;
                });
            });

            // Lida com a mudança de hash na URL (para navegação e refresh)
            window.addEventListener('hashchange', () => {
                 const hash = window.location.hash || '#dashboard';
                 navigateTo(hash);
            });

            // Carrega a página inicial ou a página no hash
            const initialHash = window.location.hash || '#dashboard';
            navigateTo(initialHash);


            // Lógica das abas na seção de Cadastros
            const tabLinks = document.querySelectorAll('.tab-link');
            const tabPanes = document.querySelectorAll('.tab-pane');

            function switchTab(targetId) {
                tabLinks.forEach(link => {
                    if(link.getAttribute('href') === targetId){
                        link.classList.add('border-blue-600', 'text-blue-600');
                        link.classList.remove('border-transparent', 'hover:text-gray-600', 'hover:border-gray-300');
                    } else {
                        link.classList.remove('border-blue-600', 'text-blue-600');
                        link.classList.add('border-transparent', 'hover:text-gray-600', 'hover:border-gray-300');
                    }
                });

                tabPanes.forEach(pane => {
                     if ('#' + pane.id === targetId) {
                        pane.style.display = 'block';
                    } else {
                        pane.style.display = 'none';
                    }
                });
            }

            tabLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    switchTab(this.getAttribute('href'));
                });
            });

            // Inicia na primeira aba
            if(tabLinks.length > 0) {
                 switchTab(tabLinks[0].getAttribute('href'));
            }

        });
    </script>
@endsection