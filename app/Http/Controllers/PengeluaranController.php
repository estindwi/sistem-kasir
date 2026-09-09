<?php

namespace App\Http\Controllers;

use App\Actions\Pengeluaran\CreatePengeluaranAction;
use App\Actions\Pengeluaran\UpdatePengeluaranAction;
use App\Actions\Pengeluaran\DeletePengeluaranAction;
use App\Http\Requests\PengeluaranRequest;
use App\Queries\Pengeluaran\GetPengeluaranQuery;
use App\Queries\Pengeluaran\GetPengeluaranByIdQuery;
use App\Queries\KategoriPengeluaran\GetKategoriPengeluaranQuery;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PengeluaranController extends Controller
{
    protected $getPengeluaranQuery;
    protected $getPengeluaranByIdQuery;
    protected $getKategoriPengeluaranQuery;
    protected $createPengeluaranAction;
    protected $updatePengeluaranAction;
    protected $deletePengeluaranAction;

    public function __construct(
        GetPengeluaranQuery $getPengeluaranQuery,
        GetPengeluaranByIdQuery $getPengeluaranByIdQuery,
        GetKategoriPengeluaranQuery $getKategoriPengeluaranQuery,
        CreatePengeluaranAction $createPengeluaranAction,
        UpdatePengeluaranAction $updatePengeluaranAction,
        DeletePengeluaranAction $deletePengeluaranAction
    ) {
        $this->getPengeluaranQuery = $getPengeluaranQuery;
        $this->getPengeluaranByIdQuery = $getPengeluaranByIdQuery;
        $this->getKategoriPengeluaranQuery = $getKategoriPengeluaranQuery;
        $this->createPengeluaranAction = $createPengeluaranAction;
        $this->updatePengeluaranAction = $updatePengeluaranAction;
        $this->deletePengeluaranAction = $deletePengeluaranAction;
    }

    public function index(): View
    {
        $pengeluaran = $this->getPengeluaranQuery->execute();

        return view('pengeluaran.index', compact('pengeluaran'));
    }

    public function create(): View
    {
        $kategori = $this->getKategoriPengeluaranQuery->execute();

        return view('pengeluaran.create', compact('kategori'));
    }

    public function store(PengeluaranRequest $request): RedirectResponse
    {
        $this->createPengeluaranAction->execute(
            $request->validated()
        );

        return redirect()
            ->route('pengeluaran.index')
            ->with('success', 'Pengeluaran berhasil ditambahkan.');
    }

    public function edit($id): View
    {
        $pengeluaran = $this->getPengeluaranByIdQuery->execute($id);

        abort_if(!$pengeluaran, 404);

        $kategori = $this->getKategoriPengeluaranQuery->execute();

        return view(
            'pengeluaran.edit',
            compact('pengeluaran', 'kategori')
        );
    }

    public function update(
        PengeluaranRequest $request,
        $id
    ): RedirectResponse {
        $this->updatePengeluaranAction->execute(
            $id,
            $request->validated()
        );

        return redirect()
            ->route('pengeluaran.index')
            ->with('success', 'Pengeluaran berhasil diperbarui.');
    }

    public function destroy($id): RedirectResponse
    {
        $this->deletePengeluaranAction->execute($id);

        return redirect()
            ->route('pengeluaran.index')
            ->with('success', 'Pengeluaran berhasil dihapus.');
    }
}