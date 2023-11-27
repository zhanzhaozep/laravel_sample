<x-app-layout>
    <h2>Item</h2>
    <div class="w-full max-auto">
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <form class="mb-4" action="{{ route('item.update', $item->id) }}" method="post">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                        商品名
                    </label>
                    <input type="text" name="name" value="{{ $item->name }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">価格</label>
                    <input type="text" name="price" value="{{ $item->price }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <button class="bg-blue-500 text-sm text-white py-1 px-4 rounded focus:outline-none focus:shadow-outline">保存</button>

                <a href="{{ route('item.index') }}" class="bg-white text-blue-500 font-bold py-2 px-4 rounded">戻る</a>
            </form>

            <form action="{{ route('item.destroy', $item->id) }}" method="post">
                @csrf
                <button class="bg-red-500 text-sm text-white py-1 px-4 rounded focus:outline-none focus:shadow-outline">削除</button>
            </form>
        </div>
    </div>
</x-app-layout>