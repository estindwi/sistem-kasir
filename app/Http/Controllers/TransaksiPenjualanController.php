<?php

namespace App\Http\Controllers;

use App\Actions\TransaksiPenjualan\CreateTransaksiPenjualanAction;
use App\Actions\TransaksiPenjualan\AddDetailTransaksiAction;
use App\Actions\TransaksiPenjualan\CompleteTransaksiPenjualanAction;
use App\Http\Requests\TransaksiPenjualanRequest;
use App\Queries\TransaksiPenjualan\GetTransaksiPenjualanQuery;
use App\Queries\TransaksiPenjualan\GetTransaksiPenjualanByIdQuery;
use App\Queries\Produk\GetProdukQuery;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TransaksiPenjualanController extends Controller
{
    protected $getTransaksiPenjualanQuery;
    protected $getTransaksiPenjualanByIdQuery;
    protected $getProdukQuery;
    protected $createTransaksiPenjualanAction;
    protected $addDetailTransaksiAction;
    protected $completeTransaksiPenjualanAction;

    public function __construct(
        GetTransaksiPenjualanQuery $getTransaksiPenjualanQuery,
        GetTransaksiPenjualanByIdQuery $getTransaksiPenjualanByIdQuery,
        GetProdukQuery $getProdukQuery,
        CreateTransaksiPenjualanAction $createTransaksiPenjualanAction,
        AddDetailTransaksiAction $addDetailTransaksiAction,
        CompleteTransaksiPenjualanAction $completeTransaksiPenjualanAction
    ) {
        $this->getTransaksiPenjualanQuery = $getTransaksiPenjualanQuery;
        $this->getTransaksiPenjualanByIdQuery = $getTransaksiPenjualanByIdQuery;
        $this->getProdukQuery = $getProdukQuery;
        $this->createTransaksiPenjualanAction = $createTransaksiPenjualanAction;
        $this->addDetailTransaksiAction = $addDetailTransaksiAction;
        $this->completeTransaksiPenjualanAction = $completeTransaksiPenjualanAction;
    }

    public function index(): View
    {
        $transaksi = $this->getTransaksiPenjualanQuery->execute();

        return view('transaksi.index', compact('transaksi'));
    }

    public function show($id): View
    {
        $transaksi = $this->getTransaksiPenjualanByIdQuery->execute($id);

        abort_if(!$transaksi, 404);

        $produk = $this->getProdukQuery->execute()
            ->where('status', true)
            ->where('stok', '>', 0);

        return view('transaksi.show', compact('transaksi', 'produk'));
    }

    public function create(): View
    {
        return view('transaksi.create');
    }

    public function store(TransaksiPenjualanRequest $request): RedirectResponse
    {
        $transaksi = $this->createTransaksiPenjualanAction->execute(
            $request->validated()
        );

        return redirect()
            ->route('transaksi.show', $transaksi->id)
            ->with('success', 'Transaksi berhasil dibuat.');
    }

    public function addDetail(Request $request, $id): RedirectResponse
    {
        $transaksi = $this->getTransaksiPenjualanByIdQuery->execute($id);

        abort_if(!$transaksi, 404);

        $request->validate([
            'produk_id' => ['required', 'exists:produk,id'],
            'jumlah' => ['required', 'integer', 'min:1'],
        ]);

        try {
            $this->addDetailTransaksiAction->execute(
                $transaksi,
                $request->produk_id,
                $request->jumlah
            );

            return redirect()
                ->route('transaksi.show', $id)
                ->with('success', 'Produk berhasil ditambahkan ke transaksi.');
        } catch (\Exception $e) {
            return back()->withErrors([
                'produk_id' => $e->getMessage()
            ]);
        }
    }

    public function complete($id): RedirectResponse
    {
        $transaksi = $this->getTransaksiPenjualanByIdQuery->execute($id);

        abort_if(!$transaksi, 404);

        try {
            $this->completeTransaksiPenjualanAction->execute($transaksi);

            return redirect()
                ->route('transaksi.index')
                ->with('success', 'Transaksi berhasil diselesaikan.');
        } catch (\Exception $e) {
            return back()->withErrors([
                'transaksi' => $e->getMessage()
            ]);
        }
    }
}