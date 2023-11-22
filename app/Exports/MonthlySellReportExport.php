<?php

namespace App\Exports;

use App\Models\OrderProduct;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class MonthlySellReportExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $MonthlySellReport;

    public function __construct($MonthlySellReport)
    {
        $this->MonthlySellReport = $MonthlySellReport;
    }

    public function view(): View
    {
        return view('backend.Report.export', [
            'MonthlySellReport' => $this->MonthlySellReport,
        ]);
    }
}
