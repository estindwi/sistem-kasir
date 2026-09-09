<?php

namespace App\Http\Controllers;

use App\Actions\KategoriPengeluaran\CreateKategoriPengeluaranAction;
use App\Actions\KategoriPengeluaran\UpdateKategoriPengeluaranAction;
use App\Actions\KategoriPengeluaran\DeleteKategoriPengeluaranAction;
use App\Http\Requests\KategoriPengeluaranRequest;
use App\Queries\KategoriPengeluaran\GetKategoriPengeluaranQuery;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class KategoriPengeluaranController extends Controller
{
    protected $getKategoriPengeluaranQuery;
    protected $createKategoriPengeluaranAction;
    protected $updateKategoriPengeluaranAction;
    protected $deleteKategoriPengeluaranAction;

    public function __construct(
        GetKategoriPengeluaranQuery $getKategoriPengeluaranQuery,
        CreateKategoriPengeluaranAction $createKategoriPengeluaranAction,
        UpdateKategoriPengeluaranAction $updateKategoriPengeluaranAction,
        DeleteKategoriPengeluaranAction $deleteKategoriPengeluaranAction
    ) {
        $this->getKategoriPengeluaranQuery = $getKategoriPengeluaranQuery;
        $this->createKategoriPengeluaranAction = $createKategoriPengeluaranAction;
        $this->updateKategoriPengeluaranAction = $updateKategoriPengeluaranAction;
        $this->deleteKategoriPengeluaranAction = $deleteKategoriPengeluaranAction;
    }

    public function index(): View
    {
        $kategori = $this->getKategoriPengeluaranQuery->execute();

        return view('kategori_pengeluaran.index', compact('kategori'));
    }

    public function create(): View
    {
        return view('kategori_pengeluaran.create');
    }

    public function store(KategoriPengeluaranRequest $request): RedirectResponse
    {
        $this->createKategoriPengeluaranAction->execute(
            $request->validated()
        );

        return redirect()
            ->route('kategori-pengeluaran.index')
            ->with('success', 'Kategori pengeluaran berhasil ditambahkan.');
    }

    public function edit($id): View
    {
        $kategori = $this->getKategoriPengeluaranQuery
            ->execute()
            ->where('id', $id)
            ->first();

        abort_if(!$kategori, 404);

        return view('kategori_pengeluaran.edit', compact('kategori'));
    }

    public function update(
        KategoriPengeluaranRequest $request,
        $id
    ): RedirectResponse {
        $this->updateKategoriPengeluaranAction->execute(
            $id,
            $request->validated()
        );

        return redirect()
            ->route('kategori-pengeluaran.index')
            ->with('success', 'Kategori pengeluaran berhasil diperbarui.');
    }

    public function destroy($id): RedirectResponse
    {
        $this->deleteKategoriPengeluaranAction->execute($id);

        return redirect()
            ->route('kategori-pengeluaran.index')
            ->with('success', 'Kategori pengeluaran berhasil dihapus.');
    }
}