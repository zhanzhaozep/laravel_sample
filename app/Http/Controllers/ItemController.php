<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use Illuminate\Http\Request;
use App\Models\Item;

//CRUD(Create, Read, Update, Delete)

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $order_column = ($request->order_column) ? $request->order_column : 'id';
        $order_value = ($request->order_value) ? $request->order_value : 'asc';
        if ($item_name = $request->item_name) {
            //SELECT * FROM items WHERE name LIKE '%xxxx%' ORDER BY XXX;
            $items = Item::where('name', 'LIKE', "%{$item_name}%")
                ->orderBy($order_column, $order_value)
                ->get();
        } else {
            //SELECT * FROM items;
            $items = Item::orderBy($order_column, $order_value)->get();
        }

        $data = [
            'items' => $items,
            'item_name' => $item_name,
        ];
        // resources/views/item/index.blade.php に受け渡して表示
        return view('item.index', $data);
    }

    public function create()
    {
        return view('item.create');
    }

    public function store(ItemRequest $request)
    {
        // リクエストから POSTデータを取得
        $posts = $request->input();

        // INSERT INTO items (name, price) VALUES (xxxx, xxxx);
        Item::create($posts);

        // item/ にリダイレクト
        return redirect(route('item.index'));
    }

    public function show(int $id)
    {
        //TODO: MySQLデータベースから取得
        // SELECT * FROM items WHERE id = xx;
        $item = Item::find($id);

        //商品がなければ、商品トップページにリダイレクト 
        if (!$item) return redirect(route('item.index'));

        // Viewに受け渡すデータを作成
        $data = ['item' => $item];

        // resouces/views/item/show.blade.php
        // データ受け渡し
        return view('item.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // SELECT * FROM items WHERE id = xx;
        $item = Item::find($id);
        if (!$item) return redirect(route('item.index'));
        $data = ['item' => $item];
        return view('item.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemRequest $request, string $id)
    {
        // dd($id);
        $data = $request->all();
        //Tokenを削除
        // unset($data['_token']);
        // Item::where('id', $id)->update($data);

        // SELECT * FROM items WHERE id = xx;
        // UPDATE items SET xxx = xxx, ... WHERE id = xx;
        Item::find($id)->fill($data)->save();

        //編集画面にリダイレクト
        return redirect(route('item.edit', $id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // dd($id);
        //DELETE FROM items WHERE id = xx;
        Item::destroy($id);
        return redirect(route('item.index'));
    }
}
