<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\InwardTransaction;
use App\Models\Material;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class InwardTransactionController extends Controller
{
    // Show the transaction entry page and recent transaction history.
    public function index(): View
    {
        $transactions = InwardTransaction::with(['category', 'material'])
            ->orderByDesc('transaction_date')
            ->orderByDesc('id')
            ->paginate(15);

        return view('inward_transactions.index', compact('transactions'));
    }

    // Show the form with category options.
    public function create(): View
    {
        $categories = Category::orderBy('name')->get();

        return view('inward_transactions.create', compact('categories'));
    }

    // Validate and save a signed quantity movement.
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'material_id' => ['required', 'integer', 'exists:materials,id'],
            'transaction_date' => ['required', 'date'],
            'quantity' => ['required', 'numeric', 'regex:/^-?\d+(?:\.\d{1,2})?$/'],
        ], [
            'quantity.regex' => 'Quantity must have no more than 2 decimal places.',
        ]);

        // Ensure the chosen material belongs to the chosen category and is not soft-deleted.
        $material = Material::whereKey($validated['material_id'])
            ->where('category_id', $validated['category_id'])
            ->first();

        if (!$material) {
            return back()
                ->withErrors(['material_id' => 'Select a valid material for the chosen category.'])
                ->withInput();
        }

        // Keep the material check and transaction insert together.
        DB::transaction(function () use ($validated) {
            InwardTransaction::create($validated);
        });

        return redirect()->route('inward-transactions.index')
            ->with('success', 'Inward/outward quantity saved successfully.');
    }
}
