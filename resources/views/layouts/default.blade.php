<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGET-INFRA | Secretaria de Infraestrutura</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide-react@0.368.0/dist/lucide-react.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        aside nav{
            overflow-y: auto;
        }

        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
        .content-section {
            display: none;
        }
        .content-section.active {
            display: block;
        }
        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
    @yield('styles')
</head>
<body class="bg-slate-100 text-slate-800">
    <div class="flex h-screen">

        <aside class="w-64 bg-slate-800 text-white flex flex-col fixed h-full z-20">
            <div class="px-6 py-4 border-b border-slate-700">
                <h1 class="text-xl font-bold tracking-wider">SIGET-INFRA</h1>
                <p class="text-xs text-slate-400">Secretaria de Infraestrutura</p>
            </div>
            <nav class="flex-1 p-4 space-y-2">
                <a href="#dashboard" class="nav-link flex items-center px-4 py-2.5 text-sm rounded-lg hover:bg-slate-700 transition-colors duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18M3 6h18"></path></svg>
                    Dashboard
                </a>
                <a href="#estoque" class="nav-link flex items-center px-4 py-2.5 text-sm rounded-lg hover:bg-slate-700 transition-colors duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                    Gestão de Estoque
                </a>
                <a href="{{ route('usuario.index') }}" class="nav-link flex items-center px-4 py-2.5 text-sm rounded-lg hover:bg-slate-700 transition-colors duration-200">
                     <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    Usuários
                </a>
                <a href="{{ route('categoria.index') }}" class="nav-link flex items-center px-4 py-2.5 text-sm rounded-lg hover:bg-slate-700 transition-colors duration-200">
                     <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    Categorias
                </a>
                <a href="{{ route('fornecedor.index') }}" class="nav-link flex items-center px-4 py-2.5 text-sm rounded-lg hover:bg-slate-700 transition-colors duration-200">
                     <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    Fornecedores
                </a>
                <a href="{{ route('unidade.index') }}" class="nav-link flex items-center px-4 py-2.5 text-sm rounded-lg hover:bg-slate-700 transition-colors duration-200">
                     <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    Unidades
                </a>
                <a href="#movimentacoes" class="nav-link flex items-center px-4 py-2.5 text-sm rounded-lg hover:bg-slate-700 transition-colors duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h5M20 20v-5h-5M4 20h5v-5M20 4h-5v5"></path></svg>
                    Movimentações
                </a>
                <a href="#servicos" class="nav-link flex items-center px-4 py-2.5 text-sm rounded-lg hover:bg-slate-700 transition-colors duration-200">
                   <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    Ordens de Serviço
                </a>
                <a href="#relatorios" class="nav-link flex items-center px-4 py-2.5 text-sm rounded-lg hover:bg-slate-700 transition-colors duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Relatórios
                </a>
            </nav>
            <div class="p-4 mt-auto border-t border-slate-700">
                <div class="flex items-center">
                    <img src="https://placehold.co/40x40/E2E8F0/475569?text=AF" alt="Avatar" class="w-10 h-10 rounded-full">
                    <div class="ml-3">
                        <p class="text-sm font-semibold">André Farias</p>
                        <p class="text-xs text-slate-400">Administrador</p>
                    </div>
                </div>
                <button class="w-full mt-4 flex items-center justify-center py-2 px-4 text-sm bg-red-500 hover:bg-red-600 rounded-lg transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Sair
                </button>
            </div>
        </aside>

        <div class="ml-64 flex-1 flex flex-col h-screen">
            @yield('body')

        </div>
    </div>
</body>
</html>
