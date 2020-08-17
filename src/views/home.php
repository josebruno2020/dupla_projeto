<div class="row lista">
    <h1>Sistema Maringá 1.0</h1>
    <hr>
    <div class="alert alert-info">
        Total de nomes cadastrados: <strong><?=count($pessoa->info);?></strong> 
    </div>
    
    <div class="alert alert-info">
        Total de visitas realizadas: <strong><?=count($visita->info);?></strong>
    </div>

    <div class="alert alert-info">
        Total pago: <strong>R$ <?=number_format($total, 2, ',', '.');?></strong>
    </div>
    
</div>
