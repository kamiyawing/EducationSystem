<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Curriculum extends Model
{
    use HasFactory;

    protected $table = 'curriculums';

    public function curriculumUsers()
    {
        return $this->belongsToMany(User::class, 'curriculum_progress', 'curriculums_id', 'users_id')
                    ->withPivot('clear_flg')
                    ->as('progress');
    }

    public function grade():BelongsTo
    {
        return $this->belongsTo(Grade::class);
    }

    // Curriculumの複数形はCurriculaとなるため、明示的に「Curriculums」テーブルを指定する必要がある
}
