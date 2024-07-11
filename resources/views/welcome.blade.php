<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Choose products') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Remove py-8 -->
            <div class="container py-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2">
                    @foreach ($products as $product)
                        <!-- Card 1 -->
                        <div tabindex="0" class="focus:outline-none mb-2 w-full mx-2">
                            <div>
                                <img alt="person capturing an image" src="{{ $product->image }}" tabindex="0" class="focus:outline-none w-full h-44" />
                            </div>
                            <div class="bg-white">
                                <div class="flex items-center justify-between px-4 pt-4">
                                    <div class="bg-yellow-200 py-1.5 px-6 rounded-full">
                                        <p tabindex="0" class="focus:outline-none text-xs text-yellow-700">{{ $product->formatted_price }}</p>
                                    </div>
                                </div>
                                <div class="p-4">
                                    <div class="flex items-center">
                                        <h2 tabindex="0" class="focus:outline-none text-lg font-semibold h-20 line-clamp-1">{{ $product->name }}</h2>
                                        <p tabindex="0" class="focus:outline-none text-xs text-gray-600 pl-5"></p>
                                    </div>
                                    <p tabindex="0" class="focus:outline-none text-xs text-gray-600 mt-2 line-clamp-1">{{ $product->description }}</p>

                                    <add-to-cart :product-id="{{ $product->id }}"></add-to-cart>
                                </div>
                            </div>
                        </div>
                        <!-- Card 1 Ends -->
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
