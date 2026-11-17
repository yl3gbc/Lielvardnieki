<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder; use Illuminate\Support\Facades\DB;
class JoomlaMenusSeeder extends Seeder { public function run(): void {
    $d = json_decode(file_get_contents(storage_path('app/private/joomla-visas-izvelnes.json')), true, 512, JSON_THROW_ON_ERROR);
    if (count($d['menu']) !== 296) throw new \RuntimeException('Expected 296 Joomla records');
    $rows = array_map(fn($x) => [
        'joomla_id' => (int)$x['id'], 'menutype' => $x['menutype'],
        'parent_id' => (int)$x['parent_id'], 'level' => (int)$x['level'],
        'lft' => (int)$x['lft'], 'rgt' => (int)$x['rgt'],
        'title' => $x['title'], 'link' => $x['link'],
        'published' => (int)$x['published'], 'access' => (int)$x['access'],
        'source_data' => json_encode($x, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR),
    ], $d['menu']);
    DB::transaction(function () use ($rows) {
        if (DB::table('joomla_menus')->exists()) throw new \RuntimeException('Already imported');
        DB::table('joomla_menus')->insert($rows); });
} }
