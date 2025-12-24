@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detalhes do Equipamento</h1>
        <table class="table">
            <tr>
                <th>ID</th>
                <td>{{ $equipment->id }}</td>
            </tr>
            <tr>
                <th>Nome</th>
                <td>{{ $equipment->name }}</td>
            </tr>
            <tr>
                <th>Marca</th>
                <td>{{ $equipment->brand }}</td>
            </tr>
            <tr>
                <th>Número de Série</th>
                <td>{{ $equipment->serial_number }}</td>
            </tr>
            <tr>
                <th>Localização</th>
                <td>{{ $equipment->location }}</td>
            </tr>
            <tr>
                <th>Data da Última Manutenção</th>
                <td>{{ $equipment->last_maintenance_date }}</td>
            </tr>
        </table>
        <a href="{{ route('equipments.index') }}" class="btn btn-secondary">Voltar</a>
    </div>
@endsection
