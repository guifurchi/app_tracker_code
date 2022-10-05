<div class="container">
    <div class="row">
        <div class="col">
            ID: {{ $inspect->id }} <br>
            Modelo: {{ $dados[0] }}<br>
            Descrição: {{ $dados[1] }}<br>
            Quantidade: {{ $dados[2] }}<br>
            Código1: {{ $dados[3] }}<br>
            Código2: {{ $dados[4] }}<br>
            Máquina: {{ $dados[5] }}<br>
            Responsável: {{ $dados[6] }}<br>
            Turno: {{ $dados[7] }}<br>
            Resina: {{ $dados[8] }}<br>
            Data_hora-Produção: {{ $dados[9]}}<br>
            Data_hora-Inspeção: {{ $inspect->created_at }}<br>
            Resp_Inspeção: {{ $inspect->nome_insp }}<br>
            Status: {{ $inspect->status }}<br>
        </div>
    </div>
            <div class="col mt-4">
            <a href="{{url('/inspectQuery')}}">
                <button class="btn btn-success">Voltar</button>
            </a>
        </div>

</div>
