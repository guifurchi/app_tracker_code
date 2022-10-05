<div class="container">
    <div class="row">
            @if(isset($erro))
                <div class="col text-center mt-4 mb-4 p-2 alert-danger">
                    {{$erro}}
                </div>
            @endif
            <form action="{{url("/password/$user->id/edit")}}" method="post">
            @csrf
            <div class="col mb-2">
                <input name="password_old" type="password" placeholder="Senha atual" class="form-control" required>
            </div>
            <div class="col">
                <input name="password" type="password" placeholder="Senha nova" class="form-control" required>
            </div>
            <div class="col mt-2">
                <button type="submit" class="btn btn-primary">Alterar</button>
            </div>
        </form>
    </div>
</div>

