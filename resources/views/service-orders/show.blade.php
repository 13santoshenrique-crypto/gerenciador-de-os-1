<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Show Service Order') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4">
                        <strong class="font-medium text-gray-700">Vehicle Model:</strong>
                        <p class="text-gray-900">{{ $serviceOrder->vehicle_model }}</p>
                    </div>
                    <div class="mb-4">
                        <strong class="font-medium text-gray-700">License Plate:</strong>
                        <p class="text-gray-900">{{ $serviceOrder->license_plate }}</p>
                    </div>
                    <div class="mb-4">
                        <strong class="font-medium text-gray-700">Service Description:</strong>
                        <p class="text-gray-900">{{ $serviceOrder->service_description }}</p>
                    </div>
                    <div class="mb-4">
                        <strong class="font-medium text-gray-700">Status:</strong>
                        <p class="text-gray-900">{{ $serviceOrder->status }}</p>
                    </div>

                    <div class="mt-6 flex items-center justify-end gap-x-6">
                        <a href="{{ route('service-orders.index') }}" class="text-sm font-semibold leading-6 text-gray-900">Back</a>
                        <a href="{{ route('service-orders.edit', $serviceOrder->id) }}" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Edit</a>
                        <form action="{{ route('service-orders.destroy', $serviceOrder->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
