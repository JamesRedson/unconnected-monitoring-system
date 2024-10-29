<?php

namespace App\Models\Site;

use App\Models\PointVoucher\PointVoucher;
use App\Models\SalesReport\SalesReport;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Site extends Model
{
    use HasFactory, HasUuids;
    protected $fillable = [
        'name',
    ];

    public function pointVouchers (): HasMany
    {
        return $this->hasMany(PointVoucher::class);
    }

    public function salesReports (): HasManyThrough
    {
        return $this->hasManyThrough(SalesReport::class, PointVoucher::class);
    }
}
