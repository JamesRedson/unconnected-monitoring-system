<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Laravel\Scout\Searchable;

class Client extends Model
{
	use HasFactory, Searchable;

	protected $fillable = [
		'first_name',
		'last_name',
		'sex',
		'age',
		'voucher',
		'mac_address',
		'site_name',
	];

	/**
	 * Get the attributes that should be cast.
	 *
	 * @return array<string, string>
	 */
	protected function casts(): array
	{
		return [
			'birth_date' => 'datetime:m-d-Y',
		];
	}

	/**
	 * Get the indexable data array for the model.
	 *
	 * @return array<string, mixed>
	 */
	public function toSearchableArray(): array
	{
    return [
			'first_name' => $this->first_name,
			'last_name' => $this->last_name,
			'sex' => $this->sex,
			'site_name' => $this->site_name
    ];
	}
}
