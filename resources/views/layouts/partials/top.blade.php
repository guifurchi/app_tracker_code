    <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
    <div class="container-fluid">
        <a class="navbar-brand" href="/mainPage">{{$title}}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/inspecao">Inspeção</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/inspectQuery">Registros</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/usuarios">Usuários</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/password/{{$_SESSION['id'] }}">Trocar Senha</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/logout">Logout</a>
            </li>
        </ul>
        </div>
    </div>
    </nav>
        <div class="container mb-4">
        <div class="row">
            <div class="col">
                <small >Seja bem vindo(a), {{ $_SESSION['name'] }}! ({{ $_SESSION['nivel'] }})</small>
            </div>
        </div>
    </div>
