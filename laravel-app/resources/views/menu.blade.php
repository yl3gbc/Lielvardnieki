@php($items = \App\Models\JoomlaMenu::query()->where('menutype','mainmenu')->where('published',1)->where('access',1)->orderBy('lft')->get())
@php($icons = [101=>'<path d="M3 10 12 3l9 7M5 9v12h14V9M9 21v-7h6v7"/>',132=>'<circle cx="12" cy="5" r="3"/><path d="M5 21v-5c0-4 14-4 14 0v5H5M12 12v6"/>',133=>'<path d="M5 3h14v5c0 4-3 6-7 6s-7-2-7-6V3M12 14v7M7 21h10"/>',171=>'<rect x="4" y="3" width="16" height="18" rx="1"/><path d="M8 7h8M8 11h8M8 15h6"/>',174=>'<path d="M10 3 5 13l4 8M14 3l5 10-4 8M10 3l2 5 2-5M9 17h6"/>',183=>'<path d="M12 5C9 3 6 3 3 4v16c3-1 6-1 9 1V5Zm0 0c3-2 6-2 9-1v16c-3-1-6-1-9 1"/>',184=>'<path d="M10 13a5 5 0 0 0 7 0l3-3a5 5 0 0 0-7-7l-2 2M14 11a5 5 0 0 0-7 0l-3 3a5 5 0 0 0 7 7l2-2"/>',215=>'<rect x="4" y="3" width="16" height="18" rx="1"/><path d="M8 7h8M8 11h8M8 15h8M8 18h8"/>'])
<nav class="draudze-menu" aria-label="Galvenā izvēlne">
@foreach($items->where('parent_id',1) as $entry)
<details class="menu-root"><summary><svg viewBox="0 0 24 24">{!! $icons[(int)$entry->joomla_id] ?? '' !!}</svg>{{ $entry->title }}</summary>
@include('joomla-menu-nodes', ['items'=>$items->where('parent_id',$entry->joomla_id), 'all'=>$items])
</details>
@endforeach
</nav>
<style>
.draudze-menu{display:flex;gap:7px;background:linear-gradient(#8d2333,#53091a);padding:6px 10px;position:relative;z-index:20;overflow:visible}.menu-root{position:relative;flex:1;min-width:0}
.menu-root>summary{display:flex;align-items:center;justify-content:center;gap:7px;list-style:none;cursor:pointer;min-height:38px;padding:6px;color:#fff;background:linear-gradient(#a33345,#5e0919);border:1px solid #b75a55;border-radius:8px;font:bold 15px Georgia}.menu-root:first-child>summary{color:#481b1e;background:linear-gradient(#fff5db,#edc873)}
.draudze-menu svg{width:18px;height:18px;flex:none;stroke:currentColor;stroke-width:2;fill:none}.draudze-menu .joomla-submenu{display:none;position:absolute;top:100%;left:0;width:max-content;min-width:240px;max-width:min(420px,85vw);padding:6px;list-style:none;background:#fff8ec;border:1px solid #d6b36d;box-shadow:0 4px 12px #3116;z-index:50}
.draudze-menu details[open]>.joomla-submenu{display:block}.draudze-menu .joomla-submenu details{position:relative}
.draudze-menu .joomla-submenu details>.joomla-submenu{top:0;left:100%}.draudze-menu .menu-root:nth-last-child(-n+3) .joomla-submenu details>.joomla-submenu{left:auto;right:100%}
.draudze-menu .menu-root:last-child>.joomla-submenu{left:auto;right:0}.draudze-menu .joomla-submenu summary,.draudze-menu .joomla-submenu span{display:block;white-space:normal;overflow-wrap:anywhere;padding:7px;cursor:pointer}
@media(max-width:700px){.draudze-menu{flex-wrap:wrap}.menu-root{flex:1 1 44%}.draudze-menu .joomla-submenu,.draudze-menu .joomla-submenu details>.joomla-submenu{position:static;width:100%;min-width:0;max-width:100%}}
</style>

<style>
.draudze-menu .joomla-submenu{margin:0;padding:0;min-width:270px;max-width:min(460px,92vw);background:linear-gradient(#8d2333,#53091a);border:1px solid #d6ac54;border-radius:8px;box-shadow:0 5px 14px #23080e55}
.draudze-menu .joomla-submenu li{margin:0;padding:0;list-style:none}
.draudze-menu .joomla-submenu summary,.draudze-menu .joomla-submenu span{display:flex;align-items:center;min-height:44px;white-space:normal;overflow-wrap:break-word;padding:10px 12px;color:#fff;background:linear-gradient(#a33345,#5e0919);border:1px solid #b75a55;border-radius:5px;font:bold 14px Georgia,serif;line-height:1.35}
.draudze-menu .joomla-submenu summary:hover,.draudze-menu .joomla-submenu span:hover{background:linear-gradient(#fff5db,#edc873);color:#481b1e}
.draudze-menu .menu-root>.joomla-submenu{top:100%}
@media(min-width:701px){.draudze-menu .joomla-submenu details>.joomla-submenu{left:calc(100% - 2px);top:0}.draudze-menu .menu-root:nth-last-child(-n+3) .joomla-submenu details>.joomla-submenu{right:calc(100% - 2px);left:auto}}
@media(max-width:700px){.draudze-menu .joomla-submenu{width:100%;max-width:100%}}
</style>
<script>
document.querySelectorAll('.draudze-menu details').forEach(node => node.addEventListener('toggle', () => {
  if (!node.open) return;
  node.closest('ul,nav').querySelectorAll(':scope > details[open], :scope > li > details[open]').forEach(other => { if (other !== node) other.open = false; });
}));
</script>
<style>
.draudze-menu .joomla-submenu details[open] > summary {
  background: linear-gradient(#fff5db, #edc873);
  color: #481b1e;
  border-color: #e8b23e;
  box-shadow: inset 0 2px 2px #fff;
}
</style>
