<?php
namespace App\Http\Controllers;

use App\Models\ShoppingList;
use App\Models\Colocation;
use Illuminate\Http\Request;

class ShoppingListController extends Controller
{
    public function store(Request $request, Colocation $colocation)
    {
        $request->validate([
            'item_name' => 'required|string|max:255',
        ]);

        $colocation->shoppingList()->create([
            'item_name' => $request->item_name,
            'added_by' => auth()->id(),
        ]);

        return back()->with('success', 'Item added to shopping list.');
    }

    public function update(Request $request, Colocation $colocation, ShoppingList $item)
    {
        $item->update([
            'is_bought' => !$item->is_bought
        ]);

        return back()->with('success', 'Item status updated.');
    }

    public function destroy(Colocation $colocation, ShoppingList $item)
    {
        $item->delete();
        return back()->with('success', 'Item removed from list.');
    }
}