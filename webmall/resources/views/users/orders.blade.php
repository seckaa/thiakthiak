<x-main.layout>
    <x-main.card class="p-10 max-w-lg mx-auto mt-24">
        {{-- <x-main.card class="p-10"> --}}
        <header>
            <h1 class="text-3xl text-center font-bold my-6 uppercase">
                Order History
            </h1>
        </header>

        <table class="w-full table-auto rounded-sm">
            <tbody>
                @unless ($orders->isEmpty())
                    <tr class=" border-gray-300">
                        <td class="px-4 py-8 border-r border-t">
                            id
                        </td>
                        <td class="px-4 py-8 border-r border-t">
                            date
                        </td>
                        <td class="px-4 py-8 border-r border-t">
                            status
                        </td>
                        <td class="px-4 py-8 border-t">
                            amount
                        </td>
                    </tr>
                    @foreach ($orders as $order)
                        <tr class="border-gray-300">
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <a href="/listings/{{ $order->id }}"> {{ $order->id }} </a>
                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                {{ $order->created_at }}
                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                {{ $order->status }}
                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                ${{ $order->grand_total }}
                            </td>
                            {{-- <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <a href="/orders/{{ $order->id }}/edit" class="text-blue-400 px-6 py-2 rounded-xl"><i
                                        class="fa-solid fa-check"></i>
                                    Edit</a>
                            </td> --}}
                            {{-- <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <a href="/orders/{{ $order->id }}/edit" class="text-blue-400 px-6 py-2 rounded-xl"><i
                                        class="fa-solid fa-pen-to-square"></i>
                                    Edit</a>
                            </td> --}}
                            {{-- <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <form method="POST" action="/user/orders/{{ $order->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-500"><i class="fa-solid fa-trash"></i> Delete</button>
                                </form>
                            </td> --}}
                        </tr>
                    @endforeach
                @else
                    <tr class="border-gray-300">
                        <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                            <p class="text-center">No orders found</p>
                        </td>
                    </tr>
                @endunless

            </tbody>
        </table>
    </x-main.card>
</x-main.layout>
