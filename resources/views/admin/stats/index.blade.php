{{-- resources/views/admin/stats/index.blade.php --}}
@extends('layouts.app')
@section('content')

<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;1,300;1,500&family=Raleway:wght@200;300;400;500;600&display=swap" rel="stylesheet">

<style>
    :root{--cream:#FDF5F0;--blush:#F2C4CE;--rose:#E8A0B0;--deep-rose:#C4748A;--gold:#C9A96E;--gold-light:#E8D5B0;--gold-pale:#FAF3E8;--dark:#3A2028;--dark-2:#2A1419;--text:#4A2E34;--muted:#9C7A80;--white:#FFFAF8;--bg:#F8F0ED;--border:rgba(196,116,138,0.13);}
    .admin-page{padding:28px 34px;font-family:'Raleway',sans-serif;color:var(--text);}
    .btn-back{display:inline-flex;align-items:center;gap:8px;padding:8px 16px;background:transparent;border:1px solid rgba(201,169,110,.25);color:var(--muted);font-family:'Raleway',sans-serif;font-size:9px;font-weight:400;letter-spacing:2.5px;text-transform:uppercase;text-decoration:none;transition:all .22s ease;margin-bottom:20px;opacity:0;animation:fadeUp .5s ease forwards .02s;}
    .btn-back:hover{background:rgba(201,169,110,.07);border-color:var(--gold);color:var(--gold);transform:translateX(-2px);}
    .btn-back svg{transition:transform .22s;}.btn-back:hover svg{transform:translateX(-3px);}
    .page-eyebrow{font-size:9px;letter-spacing:4px;text-transform:uppercase;color:var(--gold);font-weight:400;margin-bottom:6px;opacity:0;animation:fadeUp .5s ease forwards .07s;}
    .page-title{font-family:'Cormorant Garamond',serif;font-size:32px;font-weight:300;color:var(--dark);line-height:1;letter-spacing:1px;opacity:0;animation:fadeUp .5s ease forwards .13s;}
    .page-title em{font-style:italic;color:var(--deep-rose);}
    .page-header-row{display:flex;align-items:flex-end;justify-content:space-between;gap:16px;}
    .gold-div{display:flex;align-items:center;gap:10px;margin:16px 0 26px;opacity:0;animation:fadeUp .5s ease forwards .2s;}
    .gold-div span{height:1px;}.gold-div span:first-child{width:36px;background:linear-gradient(to right,var(--deep-rose),var(--gold));}.gold-div span:last-child{flex:1;background:linear-gradient(to right,rgba(201,169,110,.18),transparent);}.gold-div i{width:4px;height:4px;border-radius:50%;background:var(--gold);display:inline-block;}
    .stats-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:22px;}
    .stat-card{background:var(--white);border-radius:16px;padding:20px 18px;border:1px solid var(--border);position:relative;overflow:hidden;transition:transform .22s,box-shadow .22s;opacity:0;animation:fadeUp .5s ease forwards;}
    .stat-card::before{content:'';position:absolute;top:0;left:0;width:3px;height:100%;background:linear-gradient(180deg,var(--deep-rose),var(--gold));}
    .stat-card:hover{transform:translateY(-4px);box-shadow:0 14px 30px rgba(196,116,138,.12);}
    .stat-ico{width:40px;height:40px;border-radius:11px;display:flex;align-items:center;justify-content:center;font-size:18px;margin-bottom:12px;}
    .stat-val{font-family:'Cormorant Garamond',serif;font-size:32px;font-weight:400;color:var(--dark);line-height:1;margin-bottom:4px;}
    .stat-lbl{font-size:9.5px;letter-spacing:1.5px;text-transform:uppercase;color:var(--muted);}
    .chart-grid{display:grid;grid-template-columns:1fr 300px;gap:20px;margin-bottom:20px;}
    .card{background:var(--white);border-radius:16px;border:1px solid var(--border);overflow:hidden;opacity:0;animation:fadeUp .5s ease forwards;}
    .card::before{content:'';display:block;height:2px;background:linear-gradient(to right,var(--deep-rose),var(--gold),transparent);}
    .card-head{display:flex;align-items:center;justify-content:space-between;padding:16px 22px;border-bottom:1px solid var(--border);background:rgba(248,240,237,.45);}
    .card-head h3{font-family:'Cormorant Garamond',serif;font-size:19px;font-weight:400;color:var(--dark);}
    .card-head h3 em{color:var(--deep-rose);font-style:italic;}
    .chart-inner{padding:20px;}
    .period-tabs{display:flex;gap:4px;}
    .tab{padding:6px 14px;font-size:9.5px;letter-spacing:2px;text-transform:uppercase;font-family:'Raleway',sans-serif;font-weight:400;cursor:pointer;border:1px solid transparent;color:var(--muted);transition:all .2s;background:transparent;}
    .tab.active{border-color:rgba(201,169,110,.35);color:var(--gold);background:var(--gold-pale);}
    .tab:hover:not(.active){color:var(--deep-rose);}
    .legend-item{display:flex;align-items:center;justify-content:space-between;font-size:12px;color:var(--text);}
    .legend-dot{width:10px;height:10px;border-radius:2px;display:inline-block;}
    .prod-bar-row{display:flex;align-items:center;gap:14px;padding:12px 22px;border-bottom:1px solid rgba(196,116,138,.07);transition:background .18s;}
    .prod-bar-row:last-child{border-bottom:none;}
    .prod-bar-row:hover{background:rgba(242,196,206,.08);}
    .prod-rank-n{font-family:'Cormorant Garamond',serif;font-size:20px;color:rgba(196,116,138,.22);width:22px;text-align:right;flex-shrink:0;}
    .prod-dot{width:36px;height:36px;border-radius:9px;background:linear-gradient(135deg,rgba(242,196,206,.3),rgba(201,169,110,.2));border:1px solid var(--border);display:flex;align-items:center;justify-content:center;font-size:16px;flex-shrink:0;overflow:hidden;}
    .prod-dot img{width:100%;height:100%;object-fit:cover;}
    .bar-wrap{flex:1;min-width:0;}
    .bar-label{font-size:13px;font-weight:500;color:var(--dark);margin-bottom:5px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
    .bar-track{height:3px;background:rgba(196,116,138,.1);border-radius:2px;}
    .bar-fill{height:100%;border-radius:2px;background:linear-gradient(to right,var(--deep-rose),var(--gold));transition:width .4s ease;}
    .prod-rev-n{text-align:right;flex-shrink:0;}
    .prod-rev-n p{font-family:'Cormorant Garamond',serif;font-size:17px;color:var(--dark);}
    .prod-rev-n small{font-size:9px;color:var(--muted);letter-spacing:1px;}
    .empty-state{padding:48px 24px;text-align:center;}
    .empty-state .empty-ico{font-size:38px;margin-bottom:14px;opacity:.45;}
    .empty-state p{font-family:'Cormorant Garamond',serif;font-style:italic;font-size:18px;color:var(--muted);}
    .empty-state small{font-size:10px;color:rgba(156,122,128,.6);letter-spacing:2px;text-transform:uppercase;display:block;margin-top:4px;}
    @keyframes fadeUp{from{opacity:0;transform:translateY(14px)}to{opacity:1;transform:translateY(0)}}
    .d1{animation-delay:.05s}.d2{animation-delay:.13s}.d3{animation-delay:.21s}.d4{animation-delay:.29s}
    ::-webkit-scrollbar{width:4px}::-webkit-scrollbar-thumb{background:var(--blush);border-radius:4px}
</style>

<div class="admin-page">

    {{-- ── Bouton retour ── --}}
    <a href="{{ route('admin.dashboard') }}" class="btn-back">
        <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
            <path d="M9 2L4 7L9 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        Tableau de bord
    </a>

    <div class="page-header-row">
        <div>
            <p class="page-eyebrow">Analyse</p>
            <h1 class="page-title">Statis<em>tiques</em></h1>
        </div>
        <div style="opacity:0;animation:fadeUp .5s ease forwards .3s">
            <div class="period-tabs">
                <button class="tab {{ ($period??'7')=='7' ?'active':'' }}" onclick="goTo(7)">7 jours</button>
                <button class="tab {{ ($period??'7')=='30'?'active':'' }}" onclick="goTo(30)">30 jours</button>
                <button class="tab {{ ($period??'7')=='90'?'active':'' }}" onclick="goTo(90)">3 mois</button>
            </div>
        </div>
    </div>

    <div class="gold-div"><span></span><i></i><i></i><i></i><span></span></div>

    {{-- KPIs --}}
    <div class="stats-grid">
        <div class="stat-card d1"><div class="stat-ico" style="background:linear-gradient(135deg,#E8F5F0,#C8E8DC)">💰</div><div class="stat-val">{{ number_format($totalRevenue??0,0,',',' ') }}</div><div class="stat-lbl">Revenus totaux (FCF)</div></div>
        <div class="stat-card d2"><div class="stat-ico" style="background:linear-gradient(135deg,var(--gold-pale),#EEE0C0)">📦</div><div class="stat-val">{{ number_format($ordersCount??0,0,',',' ') }}</div><div class="stat-lbl">Commandes totales</div></div>
        <div class="stat-card d3"><div class="stat-ico" style="background:linear-gradient(135deg,#FDEEF0,#F5D5DA)">👥</div><div class="stat-val">{{ number_format($clientsCount??0,0,',',' ') }}</div><div class="stat-lbl">Clients inscrits</div></div>
        <div class="stat-card d4"><div class="stat-ico" style="background:linear-gradient(135deg,#EEF2FD,#D0DEFB)">📅</div><div class="stat-val">{{ $ordersToday??0 }}</div><div class="stat-lbl">Commandes aujourd'hui</div></div>
    </div>

    {{-- Charts --}}
    <div class="chart-grid">
        <div class="card" style="animation-delay:.32s">
            <div class="card-head"><h3>Activité des <em>Revenus</em></h3></div>
            <div class="chart-inner"><canvas id="revenueChart" height="180"></canvas></div>
        </div>
        <div class="card" style="animation-delay:.40s">
            <div class="card-head"><h3>Par <em>Statut</em></h3></div>
            <div class="chart-inner" style="display:flex;flex-direction:column;align-items:center;gap:18px">
                <canvas id="statusChart" height="180" style="max-width:180px"></canvas>
                <div style="width:100%;display:flex;flex-direction:column;gap:10px">
                    @foreach([['Livrées',$delivered??0,'#C9A96E'],['En cours',$processing??0,'#C4748A'],['Préparation',$pending??0,'#E8A0B0'],['Annulées',$cancelled??0,'#F2C4CE']] as [$lbl,$val,$col])
                    <div class="legend-item">
                        <div style="display:flex;align-items:center;gap:8px"><span class="legend-dot" style="background:{{ $col }}"></span>{{ $lbl }}</div>
                        <span style="font-family:'Cormorant Garamond',serif;font-size:17px;color:var(--dark)">{{ $val }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- Top produits --}}
    <div class="card" style="animation-delay:.48s">
        <div class="card-head">
            <h3>Top <em>Produits</em> vendus</h3>
            <a href="{{ route('admin.products.index') }}" style="font-size:9.5px;letter-spacing:1.5px;text-transform:uppercase;color:var(--gold);text-decoration:none;border-bottom:1px solid var(--gold-light);padding-bottom:1px">Voir tout</a>
        </div>
        @if(isset($topProducts) && $topProducts->count() > 0)
            @php $maxSales = $topProducts->max('sales_count') ?: 1; @endphp
            <div style="padding:8px 0">
                @foreach($topProducts as $i => $product)
                <div class="prod-bar-row">
                    <span class="prod-rank-n">{{ str_pad($i+1,2,'0',STR_PAD_LEFT) }}</span>
                    <div class="prod-dot">@if($product->image)<img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">@else 💄 @endif</div>
                    <div class="bar-wrap">
                        <div class="bar-label">{{ $product->name }}</div>
                        <div class="bar-track"><div class="bar-fill" style="width:{{ round(($product->sales_count/$maxSales)*100) }}%"></div></div>
                    </div>
                    <div class="prod-rev-n">
                        <p>{{ number_format($product->total_revenue??0,0,',',' ') }}</p>
                        <small>DZD · {{ $product->sales_count??0 }} ventes</small>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="empty-state"><div class="empty-ico">📦</div><p>Aucune vente enregistrée</p><small>Ajoutez des produits pour commencer</small></div>
        @endif
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    const rose='#C4748A',gold='#C9A96E',blush='#F2C4CE',gpal='#E8D5B0',muted='#9C7A80';
    const rCtx=document.getElementById('revenueChart').getContext('2d');
    const grad=rCtx.createLinearGradient(0,0,0,220);
    grad.addColorStop(0,'rgba(196,116,138,.22)');grad.addColorStop(1,'rgba(196,116,138,.01)');
    new Chart(rCtx,{type:'line',data:{labels:@json($revenueLabels??[]),datasets:[{data:@json($revenueData??[]),borderColor:rose,borderWidth:2,pointBackgroundColor:gold,pointBorderColor:'#fff',pointBorderWidth:2,pointRadius:4,pointHoverRadius:6,fill:true,backgroundColor:grad,tension:0.4}]},options:{responsive:true,plugins:{legend:{display:false},tooltip:{backgroundColor:'#2A1419',titleColor:'#F2C4CE',bodyColor:'#E8D5B0',borderColor:'rgba(196,116,138,.3)',borderWidth:1,padding:12,callbacks:{label:c=>' '+c.parsed.y.toLocaleString('fr-FR')+' FCFA'}}},scales:{x:{grid:{color:'rgba(196,116,138,.07)'},ticks:{color:muted,font:{family:'Raleway',size:10}}},y:{grid:{color:'rgba(196,116,138,.07)'},ticks:{color:muted,font:{family:'Raleway',size:10},callback:v=>v.toLocaleString('fr-FR')}}}}});
    new Chart(document.getElementById('statusChart').getContext('2d'),{type:'doughnut',data:{labels:['Livrées','En cours','Préparation','Annulées'],datasets:[{data:[{{ $delivered??0 }},{{ $processing??0 }},{{ $pending??0 }},{{ $cancelled??0 }}],backgroundColor:[gold,rose,blush,gpal],borderColor:'#FFFAF8',borderWidth:3}]},options:{responsive:true,cutout:'70%',plugins:{legend:{display:false},tooltip:{backgroundColor:'#2A1419',titleColor:'#F2C4CE',bodyColor:'#E8D5B0',borderColor:'rgba(196,116,138,.3)',borderWidth:1,padding:12}}}});
    function goTo(d){window.location.href='?period='+d;}
</script>
@endsection
