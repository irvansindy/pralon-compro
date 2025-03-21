<?php
namespace App\Exports;

use App\Models\LogUserDownload;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;
class BrocureExport implements FromCollection, WithHeadings
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

        // Filter berdasarkan product_id jika bukan "all"
        if ($this->product_id !== 'all') {
            $query->where('product_id', $this->product_id);
        }

        // Filter berdasarkan range tanggal jika tidak kosong
        if (!is_null($this->start_date) && !is_null($this->end_date)) {
            $query->whereBetween('created_at', [$this->start_date . ' 00:00:00', $this->end_date . ' 23:59:59']);
        }

        return $query->where('type_download', 'brocure')->get(['id', 'name', 'email', 'type_download', 'created_at']);
    }

    public function headings(): array
    {
        return ["ID", "Name", "Email", "Type Download", "Created At"];
    }
}
