<div class="container">
    <div class="row">
        <div class="col">
            ID: {{ $user->id }} <br>
            Código: {{ $user->name }}<br>
            Matrícula: {{ $user->matricula }}<br>
            Nível: {{ $user->nivel }}<br>
            Data: {{ $user->created_at }}<br>
            Data Ateração: {{ $user->updated_at }}<br>
        </div>
    </div>
        <div class="col mt-4">
            <a href="{{url('/usuarios')}}">
                <button class="btn btn-success">Voltar</button>
            </a>
        </div>

</div>
