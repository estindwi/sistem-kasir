<?php

namespace App\Http\Controllers;

use App\Actions\Produk\CreateProdukAction;
use App\Actions\Produk\UpdateProdukAction;
use App\Actions\Produk\DeactivateProdukAction;
use App\Http\Requests\ProdukRequest;
use App\Queries\Produk\GetProdukQuery;
use App\Queries\Produk\GetProdukByIdQuery;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProdukController extends Controller
{
    protected $getProdukQuery;
    protected $getProdukByIdQuery;
    protected $createProdukAction;
    protected $updateProdukAction;
    protected $deactivateProdukAction;

    public function __construct(
        GetProdukQuery $getProdukQuery,
        GetProdukByIdQuery $getProdukByIdQuery,
        CreateProdukAction $createProdukAction,
        UpdateProdukAction $updateProdukAction,
        DeactivateProdukAction $deactivateProdukAction
    ) {
        $this->getProdukQuery = $getProdukQuery;
        $this->getProdukByIdQuery = $getProdukByIdQuery;
        $this->createProdukAction = $createProdukAction;
        $this->updateProdukAction = $updateProdukAction;
        $this->deactivateProdukAction = $deactivateProdukAction;
    }

    public function index(): View
    {
        $produk = $this->getProdukQuery->execute();

        return view('produk.index', compact('produk'));
    }

    public function create(): View
    {
        return view('produk.create');
    }

    public function store(ProdukRequest $request): RedirectResponse
    {
        $this->createProdukAction->execute(
            $request->validated()
        );

        return redirect()
            ->route('produk.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit($id): View
    {
        $produk = $this->getProdukByIdQuery->execute($id);

        abort_if(!$produk, 404);

        return view('produk.edit', compact('produk'));
    }

    public function update(ProdukRequest $request, $id): RedirectResponse
    {
        $this->updateProdukAction->execute(
            $id,
            $request->validated()
        );

        return redirect()
            ->route('produk.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function deactivate($id): RedirectResponse
    {
        $this->deactivateProdukAction->execute($id);

        return redirect()
            ->route('produk.index')
            ->with('success', 'Produk berhasil dinonaktifkan.');
    }
}