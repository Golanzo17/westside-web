@extends('layouts.app')

@section('content')



    @include('partes.hero-general', [
        'badge' => 'Estamos para ayudarte',
        'title' => 'Consultas',
        'subtitle' => '¿Tenés alguna duda sobre nuestros productos o servicios?<br>Completá el formulario y te respondemos a la brevedad.'
    ])

    @include('partes.formulario_contacto')

@endsection
