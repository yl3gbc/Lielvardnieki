<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class JoomlaMenu extends Model
{
    protected $table = 'joomla_menus';
    protected $fillable = [
        'joomla_id', 'menutype', 'parent_id', 'level',
        'lft', 'rgt', 'title', 'link', 'published',
        'access', 'source_data',
    ];
    protected function casts(): array
    {
        return ['source_data' => 'array'];
    }
}
