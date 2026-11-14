<div class="side-stack">
@if(file_exists(public_path('images/aglonas_dievamate.png')))
<img class="madonna" src="{{ asset('images/aglonas_dievamate.png') }}" alt="Aglonas Dievmāte">
@endif
<section class="side-block"><h2>Radio</h2><div class="radio-area"></div></section>
<section class="side-block"><h2>Multimēdijas</h2><ul>
<li>Mieram tuvu</li>
<li>Katolis.lv</li>
<li>Katedrāle.lv</li>
<li>Foto galerija</li>
<li>Audio ieraksti</li>
</ul></section>
<section class="side-block"><h2>YouTube</h2><div class="brand">YouTube</div></section>
<section class="side-block"><h2>Vatican News</h2><div class="brand">Vatican News</div></section>
</div>
<style>
.side-stack{display:grid;gap:9px}
.madonna{display:block;width:100%;border:2px solid #cfaa69;border-radius:9px}
.side-block{background:#fff8eb;border:1px solid #d6b36d;border-radius:9px;overflow:hidden}
.side-block h2{margin:0;padding:7px 10px;color:#fff;font:bold 17px Georgia;background:linear-gradient(#9b364a,#570916)}
.side-block ul{margin:8px 0 10px;padding:0 0 0 26px;line-height:1.5;color:#2348a0}
.radio-area{height:35px;background:#f6eee3}.side-block .brand{text-align:center;padding:12px;font-size:22px;font-weight:bold}
</style>
