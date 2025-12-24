@extends('layouts.app')

@section('content')
<style>
    .form-input {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        transition: border-color 0.3s ease;
    }
    .form-input:focus {
        border-color: var(--primary-color);
        outline: none;
    }
    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
        color: var(--text-color);
    }
</style>

<div class="card">
    <div class="flex justify-between items-center mb-6">
        <h2 class="font-semibold text-2xl">Adicionar Novo Equipamento</h2>
        <a href="{{ route('equipments.index') }}" class="btn" style="background-color: var(--secondary-color); color: var(--text-color-light);">Voltar</a>
    </div>

    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
            <strong>Opa!</strong> Havia alguns problemas com seus dados.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('equipments.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="name" class="form-label">Nome do Equipamento</label>
                <input type="text" name="name" id="name" class="form-input" value="{{ old('name') }}" required>
            </div>
            <div>
                <label for="brand" class="form-label">Marca</label>
                <input type="text" name="brand" id="brand" class="form-input" value="{{ old('brand') }}">
            </div>
            <div>
                <label for="serial_number" class="form-label">Número de Série</label>
                <input type="text" name="serial_number" id="serial_number" class="form-input" value="{{ old('serial_number') }}">
            </div>
            <div>
                <label for="location" class="form-label">Localização</label>
                <input type="text" name="location" id="location" class="form-input" value="{{ old('location') }}">
            </div>
            <div class="md:col-span-2">
                <label for="last_maintenance_date" class="form-label">Data da Última Manutenção</label>
                <input type="date" name="last_maintenance_date" id="last_maintenance_date" class="form-input" value="{{ old('last_maintenance_date') }}">
            </div>
        </div>

        <div class="mt-8 text-right">
            <button type="submit" class="btn btn-primary">Salvar Equipamento</button>
        </div>
    </form>
</div>
@endsection
