<!DOCTYPE html>
<html lang="lv">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Lielvārdes Svētā Krusta Paaugstināšanas Romas katoļu draudze</title>
<style>
*{box-sizing:border-box}
html,body{margin:0;width:100%;min-height:100%}
body{background:#fff7ec;color:#4a2422;font-family:Georgia,serif}
.layout{display:grid;grid-template-columns:260px minmax(0,1fr);min-height:70vh}
.sidebar{padding:10px;background:#f3e6d0}
.content{position:relative;min-width:0;min-height:70vh;background:#fff8ec}
.content::before{content:"✝";position:absolute;left:50%;top:42%;transform:translate(-50%,-50%);font:180px Georgia,serif;color:#e4c68a;opacity:.25}
.content::after{content:"✝";position:absolute;bottom:18px;left:50%;transform:translateX(-50%);font:32px Georgia,serif;color:#b7883b}
@media(max-width:700px){.layout{grid-template-columns:1fr}.content{min-height:50vh}}
</style>
</head>
<body>
@include('banner')
@includeIf('menu')
<div class="layout"><aside class="sidebar">@includeIf('sidebar')</aside><main class="content"></main></div>
</body>
</html>
