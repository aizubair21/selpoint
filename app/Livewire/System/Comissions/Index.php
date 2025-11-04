<?php

namespace App\Livewire\System\Comissions;

use App\Models\DistributeComissions;
use App\Models\TakeComissions;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use Illuminate\Support\Str;

#[layout('layouts.app')]
class Index extends Component
{
    use WithPagination;
    public $seller = 0, $product = 0, $order = 0, $from, $to, $where, $wid;


    // PDF customization options
    public $paper = 'A4';
    public $orientation = 'portrait'; // portrait or landscape
    public $margins = '10mm';
    public $fullWidth = true;


    // Option A: Browser-based printable view (client saves PDF)
    public function openPrintable()
    {
        // Build query string for customization options
        // $qs = http_build_query([
        //     'paper' => $this->paper,
        //     'orientation' => $this->orientation,
        //     'margins' => $this->margins,
        //     'fullWidth' => $this->fullWidth ? 1 : 0,
        // ]);

        $url =  route('system.comissions.takes', ['where' => $this->where, 'from' => $this->from, 'to' => $this->to, 'wid' => $this->wid]);
        // return response()->download($url);
        // dd($url);
        // open a new window (client-side JS will handle this)
        // $this->dispatchBrowserEvent('open-printable', ['url' => url('/pdf/print?' . $qs)]);
        $this->dispatch('open-printable', ['url' => $url]);
    }

    public function mount()
    {
        $this->from = now()->format('Y-m-d');
        $this->to = now()->format('Y-m-d');
    }

    // public function getSummery()
    // {
    //     $url = route('system.comissions.takes', ['where' => $this->where, 'sdate' => $this->sdate, 'edate' => $this->edate, 'wid' => $this->wid], true);
    //     return redirect()->to($url);
    // }
    // public function getDistributors() {}

    public function print()
    {
        // $pdf = Pdf::loadView('livewire.system.comissions.takes', [
        //     'comissions' => $this->queryResult()->get(),
        //     'where' => $this->where,
        //     'from' => $this->from,
        //     'to' => $this->to,
        //     'wid' => $this->wid
        // ]);
        // return $pdf->download('comissions.pdf');
        // return pdf::view('livewire.system.comissions.takes', [
        //     'comissions' => $this->queryResult()->get(),
        //     'where' => $this->where,
        //     'from' => $this->from,
        //     'to' => $this->to,
        //     'wid' => $this->wid
        // ])
        //     ->name('comissions')
        //     ->format('A4')
        //     ->download('comissions.pdf');
        $url =  route('system.comissions.takes', ['where' => $this->where, 'from' => $this->from, 'to' => $this->to, 'wid' => $this->wid], true);
        return redirect()->to($url);


        // Render the print view HTML
        // $items = $this->getItems();
        // $html = view('livewire.system.comissions.takes', [
        //     'comissions' => $this->queryResult()->get(),
        //     'where' => $this->where,
        //     'from' => $this->from,
        //     'to' => $this->to,
        //     'wid' => $this->wid,
        //     'paper' => $this->paper,
        //     'orientation' => $this->orientation,
        //     'margins' => $this->margins,
        //     'fullWidth' => $this->fullWidth,
        // ])->render();


        // $tmpHtmlPath = storage_path('app/public/pdf_temp_' . Str::random(10) . '.html');
        // $tmpPdfPath = storage_path('app/public/pdf_' . Str::random(12) . '.pdf');


        // file_put_contents($tmpHtmlPath, $html);


        // Build wkhtmltopdf command
        // $cmd = "wkhtmltopdf --page-size {$this->paper} --orientation {$this->orientation} --margin-top {$this->margins} --margin-bottom {$this->margins} --margin-left {$this->margins} --margin-right {$this->margins} " . escapeshellarg($tmpHtmlPath) . ' ' . escapeshellarg($tmpPdfPath);


        // exec($cmd . ' 2>&1', $output, $returnVar);


        // if ($returnVar !== 0) {
        //     // cleanup
        //     @unlink($tmpHtmlPath);
        //     @unlink($tmpPdfPath);


        //     $this->dispatch('notify', ['type' => 'error', 'message' => 'Server PDF generation failed. Ensure wkhtmltopdf is installed and executable.']);
        //     return;
        // }


        // Serve the file for download
        // return response()->download($tmpPdfPath)->deleteFileAfterSend(true);
    }

    private function queryResult()
    {
        return TakeComissions::query()->when($this->where == 'user_id', function ($query) {
            return $query->where('user_id', $this->wid);
        })
            ->when($this->where == 'product_id', function ($query) {
                return $query->where('product_id', $this->wid);
            })
            ->when($this->where == 'order_id', function ($query) {
                return $query->where('order_id', $this->wid);
            })
            ->when($this->from, function ($query) {
                return $query->whereDate('created_at', '>=', $this->from);
            })
            ->when($this->to, function ($query) {
                return $query->whereDate('created_at', '<=', $this->to);
            })
            ->when($this->wid && $this->where == '', function ($query) {
                return $query->where('id', $this->wid);
            });
    }

    public function render()
    {

        return view(
            'livewire.system.comissions.index',
            [
                'comissions' => $this->queryResult()->paginate(20)
            ]
        );
    }
}
