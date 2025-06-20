<?php
namespace App\Exports;

use App\Models\LogUserDownload;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
class BrocureExport implements FromCollection, WithHeadings, WithMapping
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
        $query = LogUserDownload::with('product')
            ->where('type_download', 'brocure');

        if ($this->product_id !== 'all') {
            $query->where('product_id', $this->product_id);
        }

        if (!is_null($this->start_date) && !is_null($this->end_date)) {
            $query->whereBetween('created_at', [
                $this->start_date . ' 00:00:00',
                $this->end_date . ' 23:59:59'
            ]);
        }

        return $query->get(['id', 'name', 'email', 'phone_number', 'product_id', 'created_at']);
    }
    public function map($row): array
    {
        return [
            $row->id,
            $row->name,
            $row->email,
            $row->phone_number,
            $row->product->full_name ?? '-',
            $row->created_at->format('Y-m-d H:i:s'),
        ];
    }
    public function headings(): array
    {
        return ["ID", "Name", "Email", "Phone Number", "Product", "Created At"];
    }
}
