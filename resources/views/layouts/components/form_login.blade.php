@if($erro)
<div class="text-center p-3 mb-2 bg-danger text-white border">
    <div class="row">
        <h3>{{$action}}</h2>
        <small style="color: white">{{$erro}}</small>
    </div>
</div>
@endif
<div class="container position-absolute top-50 start-50 translate-middle bi-caret-down-fill">
    <div class="row justify-content-center">
            <div class="col-4 mt-2 border border-1 rounded p-4">
                <form action="/login" method="post">
                    @csrf
                    <div class="col mt-2 ">
                        <h3>{{$title}}</h3>
                    </div>
                    <div class="col mt-2">
                        <input name="matricula" type="text" placeholder="Matricula" class="form-control">
                    </div>
                    <div class="col mt-2">
                        <input name="password" type="password" placeholder="senha" class="form-control">
                    </div>
                    <div class="col mt-2">
                        <button type="submit" class="btn btn-primary">Logar</button>
                    </div>
                </form>
            </div>
    </div>
</div>

