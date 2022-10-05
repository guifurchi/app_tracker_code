<div class="container">
    <div class="row">
        @if(isset($errors) && count($errors)>0)
            <div class="col text-center mt-4 mb-4 p-2 alert-danger">
                @foreach($errors->all() as $erro)
                    {{$erro}}</small>
                @endforeach
            </div>
        @endif

        @if(isset($inspect))
            <form name='formEdit' action=" {{url("/inspecao/$inspect->id/edit")}} " method="post">
            @method('PUT')
        @else
            <form name='formCad' action=" {{url("/inspecao/create")}} " method="post">
        @endif
            @csrf
                <div class="col mb-2">
                @if(isset($inspect))
                    <input name="qrcode" value='{{ $inspect->qrcode }}' id="qrcode" class="form-control" type="text" placeholder="Scan do QR Code" aria-label="default input example" required readOnly>
                @else  
                    <input name="qrcode" id="qrcode" class="form-control" type="text" placeholder="Scan do QR Code" aria-label="default input example" required >
                @endif
                </div>
            <div class="col mb-2">
                <select name="status" id="status" class="form-select" value=''>
                @if(isset($inspect))
                    <option value="{{ $inspect->status }}">{{ $inspect->status }}</option>
                @else
                    <option value="Aprovado">Aprovado</option>
                    <option value="Reprovado">Reprovado</option>
                @endif
                </select>
            </div>
            <div class="col mb-2">
                <input hidden name="nome_insp" value='{{$_SESSION['name']}}' id="nome_insp" class="form-control" type="text" aria-label="default input example" required>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary ">@if(isset($inspect))Alterar @else Registrar @endif</button> 
            </div>
        </form>
            <div class="col mt-4">
                <a href="{{url('/inspectQuery')}}">
                    <button class="btn btn-success">Voltar</button>
                </a>
            </div>
    </div>
</div>
