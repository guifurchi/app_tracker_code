<div class="container">
    @foreach ($validA as $act)
        @if($act == 'create')
            <div class="col text-center"">
                <a href="{{url('/cadastrar')}}">
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
                        <th scope="col">nome</th>
                        <th scope="col">matricula</th>
                        <th scope="col">nivel</th>
                        <th scope="col">data registro</th>
                        <th scope="col">data alteração</th>
                        <th class="text-end"> {{$users->count()}} registros no total {{$users->total()}}. </th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{$user->id}}</th>
                        <td>{{$user->name}}</td>
                        <td>{{$user->matricula}}</td>
                        <td>{{$user->nivel}}</td>
                        <td>{{$user->created_at}}</td>
                        <td>{{$user->updated_at}}</td>
                        <td class="text-end">
                            <a href="{{url("showUser/$user->id")}}">
                                <button class="btn btn-dark">Visualizar</button>
                            </a>
                            @foreach ($validA as $act)
                                @if($act == 'edit')
                                    <a href="{{url("cadastrar/$user->id/edit")}}">
                                        <button class="btn btn-primary">Editar</button>
                                    </a>
                                @endif
                            @endforeach
                            @foreach ($validA as $act)
                                @if($act == 'delete')
                                    <a href="{{url("cadastrar/$user->id/delete")}}" class="js-del" >
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
    {{$users->links()}} 
</div>

