@extends('layouts.app')

@section('content')
<style>
    .status-badge {
        display: inline-block;
        padding: 0.35em 0.65em;
        font-size: .75em;
        font-weight: 700;
        line-height: 1;
        color: #fff;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 50rem; /* pill shape */
    }
    .status-pending { background-color: var(--warning-color); }
    .status-in_progress { background-color: var(--primary-color); }
    .status-completed { background-color: var(--success-color); }
    .status-cancelled { background-color: var(--danger-color); }
</style>

<div class="card">
    <div class="flex justify-between items-center mb-6">
        <h2 class="font-semibold text-2xl">Ordens de Serviço</h2>
        <a href="{{ route('service-orders.create') }}" class="btn btn-primary">Nova Ordem de Serviço</a>
    </div>

    @if ($message = Session::get('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="table">
            <thead>
                <tr>
                    <th>Equipamento</th>
                    <th>Status</th>
                    <th>Responsável</th>
                    <th>Data de Abertura</th>
                    <th class="text-right">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($serviceOrders as $order)
                    <tr>
                        <td class="font-medium">{{ $order->equipment->name ?? 'N/A' }}</td>
                        <td>
                            <span class="status-badge status-{{ str_replace(' ', '_', strtolower($order->status)) }}">{{ $order->status }}</span>
                        </td>
                        <td>{{ $order->user->name ?? 'N/A' }}</td>
                        <td>{{ $order->created_at->format('d/m/Y') }}</td>
                        <td class="text-right">
                            <div class="flex items-center justify-end space-x-2">
                                <a href="{{ route('service-orders.show', $order->id) }}" title="Ver">
                                   <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400 hover:text-primary-color" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                                <a href="{{ route('service-orders.edit', $order->id) }}" title="Editar">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400 hover:text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.5L15.232 5.232z" />
                                    </svg>
                                </a>
                                <form action="{{ route('service-orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja deletar esta Ordem de Serviço?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Deletar" class="bg-transparent border-none p-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400 hover:text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-8 text-gray-500">
                            Nenhuma Ordem de Serviço cadastrada ainda.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
