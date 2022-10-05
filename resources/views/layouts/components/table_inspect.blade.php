<div class="container">
    @foreach ($validA as $act)
        @if($act == 'create')
            <div class="col text-center">
                <a href="{{url('/inspecao')}}">
                    <button class="btn btn-success">Cadastrar</button>
                </a>
            </div>
        @endif
    @endforeach
    <div class="row">
        <div class="col">
            @csrf
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">qrcode</th>
                        <th scope="col">data registro</th>
                        <th scope="col">data alteração</th>
                        <th scope="col">Status</th>
                        <th class="text-end"> {{$inspect->count()}} registros no total {{$inspect->total()}}. </th>
                    </tr>
                    
                </thead>
                <tbody>
                @foreach ($inspect as $insp)
                    <tr>
                        <th scope="row">{{$insp->id}}</th>
                        <td>{{substr($insp->qrcode,0, 40)}}</td>
                        <td>{{$insp->created_at}}</td>
                        <td>{{$insp->updated_at}}</td>
                        <td 
                            @if($insp->status == 'Reprovado') 
                                style='color: red' 
                            @else 
                                style='color: green' 
                            @endif 
                        >{{$insp->status}}</td>
                        <td class="text-end">
                            <a href="{{url("showDetails/$insp->id")}}">
                                <button class="btn btn-dark">Visualizar</button>
                            </a>
                            @foreach ($validA as $act)
                                @if($act == 'edit')
                                    <a href="{{url("inspecao/$insp->id/edit")}}">
                                        <button class="btn btn-primary">Editar</button>
                                    </a>
                                @endif
                            @endforeach
                            @foreach ($validA as $act)
                                @if($act == 'delete')
                            <a href="{{url("inspecao/$insp->id/delete")}}" class="js-del" >
                                <button class="btn btn-danger" >Delete</button>
                            </a>
                                @endif
                            @endforeach
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{$inspect->links()}} 
</div>

