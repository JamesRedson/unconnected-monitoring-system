<?php

namespace App\Models\PointVoucher;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\SalesReport\SalesReport;
use App\Models\Site\Site;

class PointVoucher extends Model
{
    use HasFactory, HasUuids;
    protected $fillable = [
        "site_id",
        'name',
        'latitude',
        'longitude',
    ];


    public function site (): BelongsTo
    {
        return $this->belongsTo(Site::class);
    }

    public function salesReports (): HasMany
    {
        return $this->hasMany(SalesReport::class);
    }
}
