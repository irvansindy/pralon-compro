<?php

namespace App\Exports;

use App\Models\LogUserDownload;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PricelistExport implements FromCollection, WithHeadings
{
    protected $product_id;
    protected $start_date;
    protected $end_date;

    public function __construct($product_id = null, $start_date = null, $end_date = null)
    {
        $this->product_id = $product_id;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function collection()
    {
        $query = LogUserDownload::query();

        if (!is_null($this->product_id)) {
            $query->where('product_id', $this->product_id);
        }

        if (!empty($this->start_date) && !empty($this->end_date)) {
            $query->whereRaw("DATE(created_at) LIKE ? OR DATE(created_at) LIKE ?", ["%$this->start_date%", "%$this->end_date%"]);
        }

        return $query->where('type_download', 'pricelist')->get(['id', 'name', 'email', 'type_download', 'created_at']);
    }

    public function headings(): array
    {
        return ["ID", "Name", "Email", "Type Download", "Created At"];
    }
}
