<?php

namespace App\Models\SalesReport;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Site\Site;
use App\Models\PointVoucher\PointVoucher;

class SalesReport extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'point_voucher_id',
        'voucher_price',
        'total_voucher_sales',
        'total_amount',
        'reported_at',
    ];

    public function pointVoucher (): BelongsTo
    {
        return $this->belongsTo(PointVoucher::class);
    }

    public function site (): BelongsTo
    {
        return $this->belongsToThrough(Site::class, PointVoucher::class);
    }
}
