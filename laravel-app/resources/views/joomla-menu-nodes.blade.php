<ul class="joomla-submenu">
@foreach($items as $entry)
@php($nested = $all->where('parent_id', $entry->joomla_id))
<li>
@if($nested->isNotEmpty())
<details>
<summary>{{ $entry->title }}</summary>
@include('joomla-menu-nodes', ['items' => $nested, 'all' => $all])
</details>
@else
<span>{{ $entry->title }}</span>
@endif
</li>
@endforeach
</ul>
