<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cart') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <section class="flex gap-4 flex-col pt-4">
                @forelse ($cart as $cartItem)
                    <div class="p-4 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <h2>{{ $cartItem->name }}</h2>
                        <p>{{ $cartItem->desc }}</p>
                        <p>{{ $cartItem->price }}</p>
                        <p>
                            <a href="{{ route('cartItem.destroy', $cartItem->id) }}" class="text-red-500">Remove from cart</a>
                        </p>
                    </div>
                @empty
                    <p>Nothing in cart</p>
                @endforelse
                <a href="{{ route('cart.resetCart') }}" class="text-red-500">Reset cart</a>
            </section>
        </div>
    </div>
</x-app-layout>


