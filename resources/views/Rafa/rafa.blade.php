@extends('Master.Master')
@section('title','Rafa')

@section('content')

<div class="container mt-4">
    <div class="card shadow-lg border-0">
        <div class="card-body text-center">

            <h4 class="mb-3">
                <i class="feather-radio text-danger"></i>
                Ouvir Rádio RAFA
            </h4>

            <p class="text-muted">
                Ritmo, Voz e Coração de Timor
            </p>

            <iframe 
                src="https://rafa.tl/radiochannel/ouvir-rafa/" 
                width="100%" 
                height="200" 
                frameborder="0"
                style="border-radius:10px;">
            </iframe>

        </div>
    </div>
</div>

@endsection