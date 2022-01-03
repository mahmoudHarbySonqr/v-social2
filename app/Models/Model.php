<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\StorageTraits;

class Model extends \Eloquent {

    use HasFactory;
    use StorageTraits;

}
