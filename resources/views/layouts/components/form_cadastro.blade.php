<div class="container">
    <div class="row">
            @if(isset($errors) && count($errors)>0)
                <div class="col text-center mt-4 mb-4 p-2 alert-danger">
                    @foreach($errors->all() as $erro)
                        {{$erro}}
                    @endforeach
                </div>
            @endif
            <form action="@if (isset($user)) {{url("/cadastrar/$user->id/edit")}} @else {{url("/cadastrar/create")}} @endif" method="post">
            @csrf
            <div class="col">
                <small style="color: red">{{$erro}}</small>
                <input value="@if(isset($user)){{$user->name}}@endif" name="name" type="text" placeholder="Nome" class="form-control" required >
            </div>
            <div class="col mt-2">
                <input value="@if(isset($user)){{$user->matricula}}@endif" name="matricula" type="text" placeholder="Matricula" class="form-control" required>
            </div>
            <div class="col mt-2">
                <select id="nivel" name="nivel" type="text" placeholder="nivel" class="form-control" required>
                    @foreach ($level as $index => $value )
                           <option value="{{$value->nivel}}">{{$value->nivel}}</option>
                    @endforeach
                </select>
            </div>
            @if (!isset($user))
            <div class="col mt-2">
                <input value="@if(isset($user)){{$user->password}}@endif" name="password" type="password" placeholder="Senha" class="form-control" required>
            </div>
            @endif
            <div class="col mt-2">
                <button type="submit" class="btn btn-primary">@if (!isset($user)) Cadastrar @else Alterar @endif </button>
            @if (isset($user))
                <a href="{{url("/password/$user->id")}}" class="btn btn-danger">Alterar Senha</a>
            @endif
            </div>
        </form>
            <div class="col mt-4">
                <a href="{{url('/usuarios')}}">
                    <button class="btn btn-success">Voltar</button>
                </a>
            </div>

    </div>
</div>

