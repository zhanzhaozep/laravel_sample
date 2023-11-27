<x-app-layout>
    <h2>Item detail</h2>
    <h3>ID</h3>
    <p>{{ $item->id }}</p>
    <h3>商品名</h3>
    <p>{{ $item->name }}</p>
    <h3>価格</h3>
    <p>{{ $item->price }}円</p>
</x-app-layout>