<?php

namespace App\Models;

use Atlcom\LaravelHelper\Defaults\DefaultModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Test extends DefaultModel
{
    use HasFactory;
    use SoftDeletes;

    protected ?bool $withModelLog = false;
    public $guarded = ['id'];
    public $timestamps = true;
    protected $casts = [
        'name' => 'string',
    ];
}
