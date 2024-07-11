<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard - Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                @foreach ($orders as $order)
                <div class="p-6 bg-white border-b border-gray-200 mb-5">
                    <table class="table-auto w-full">
                        <thead class="border-b">
                            <h2>Order Number {{ $order->id }} placed on {{ $order->created_at->format('d M Y') }}</h2>
                        </thead>
                        <tbody>
                           <tr class="border-b hover:bg-gray-50">
                              <td class="p-4">
                                Name
                              </td>
                              <td class="p-4">
                                 Price
                              </td>
                              <td class="p-4">
                                 Quantity
                              </td>
                           </tr>
                           @foreach($order->products as $product)
                           <tr class="border-b hover:bg-gray-50">
                              <td class="p-4">
                                {{ $product->name }}
                              </td>
                              <td class="p-4">
                                {{ str_replace('.', ',', $product->pivot->price / 100) . ' $' }}
                              </td>
                              <td class="p-4">
                                {{ $product->pivot->quantity }}
                              </td>
                           </tr>

                           @endforeach

                        </tbody>
                     </table>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
