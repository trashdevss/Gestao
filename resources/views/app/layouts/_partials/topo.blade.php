
    <div class="topo">
        <div class="logo">
            <img src=" {{ asset('img/logo.png') }} ">
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{ route('app.home') }}">Home</a></li>
                <li><a href="{{ route('app.cliente') }}">Clientes</a></li>
                <li><a href="{{ route('app.fornecedor') }}">Fornecedores</a></li>
                <li><a href="{{ route('produto.index') }}">Produtos</a></li>
                <li><a href="{{ route('app.logout') }}">Logout</a></li>
            </ul>
        </div>
    </div>

