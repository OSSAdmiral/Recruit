<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Departments extends Model
{
    use SoftDeletes, HasFactory, Userstamps;

    const CREATED_BY = 'CreatedBy';
    const UPDATED_BY = 'ModifiedBy';
    const DELETED_BY  = 'DeletedBy';

    protected $fillable = [
        'DepartmentName',
        'ParentDepartment',
        'CreatedBy',
        'ModifiedBy',
        'DeletedBy'
    ];

    public function author() {
        return $this->creator();
    }
    public function modified() {
        return $this->editor();
    }
    public function deletedby() {
        return $this->destroyer();
    }
}
