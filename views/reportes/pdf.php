<?php
// views/reportes/pdf.php
?>
<!DOCTYPE html>
<html>
<head>
    <title>Reporte Trimestral</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        .info-box { border: 1px solid #000; padding: 10px; margin-bottom: 10px; }
        .semaforo { width: 50px; height: 80px; border: 2px solid #000; float: right; }
        .luz { width: 40px; height: 15px; margin: 2px auto; border-radius: 50%; }
        .rojo { background-color: #ff0000; }
        .amarillo { background-color: #ffff00; }
        .verde { background-color: #00ff00; }
        .azul { background-color: #0000ff; }
        .apagado { background-color: #cccccc; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        th { background-color: #f0f0f0; }
        .foto { width: 80px; height: 100px; border: 1px solid #000; float: right; margin-left: 10px; }
        .clear { clear: both; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Reporte de Trimestre <?= $trimestre ?></h2>
    </div>
    
    <div class="info-box">
        <div class="foto">FOTO</div>
        <div class="semaforo">
            <div class="luz <?= $semaforo == 'rojo' ? 'rojo' : 'apagado' ?>"></div>
            <div class="luz <?= $semaforo == 'amarillo' ? 'amarillo' : 'apagado' ?>"></div>
            <div class="luz <?= $semaforo == 'verde' ? 'verde' : 'apagado' ?>"></div>
            <div class="luz <?= $semaforo == 'azul' ? 'azul' : 'apagado' ?>"></div>
        </div>
        <strong>Tutor:</strong> <?= $tutor_info ? $tutor_info['nombres'] . ' ' . $tutor_info['apellidos'] : 'N/A' ?><br>
        <strong>Grupo:</strong> <?= $grupo_info ? $grupo_info['nombre'] : 'N/A' ?><br>
        <strong>Estudiante:</strong> <?= $estudiante['nombres'] . ' ' . $estudiante['apellidos'] ?><br>
        <strong>Carnet:</strong> <?= $estudiante['codigo'] ?>
        <div class="clear"></div>
    </div>
    
    <h3>Aspectos positivos</h3>
    <table>
        <tr>
            <th>#</th>
            <th>Fecha</th>
            <th>Descripción</th>
        </tr>
        <?php 
        $contador = 1;
        foreach($aspectos as $aspecto): 
            if($aspecto['tipo'] == 'P'):
        ?>
        <tr>
            <td><?= $contador++ ?></td>
            <td><?= date('d/m/Y', strtotime($aspecto['fecha'])) ?></td>
            <td><?= $aspecto['descripcion'] ?></td>
        </tr>
        <?php 
            endif;
        endforeach; 
        ?>
    </table>
    
    <h3>Aspectos a mejorar</h3>
    <table>
        <tr>
            <th>#</th>
            <th>Fecha</th>
            <th>Descripción</th>
            <th>Tipo</th>
        </tr>
        <?php 
        $contador = 1;
        foreach($aspectos as $aspecto): 
            if($aspecto['tipo'] != 'P'):
        ?>
        <tr>
            <td><?= $contador++ ?></td>
            <td><?= date('d/m/Y', strtotime($aspecto['fecha'])) ?></td>
            <td><?= $aspecto['descripcion'] ?></td>
            <td><?= $aspecto['tipo'] == 'L' ? 'Leve' : ($aspecto['tipo'] == 'G' ? 'Grave' : 'Muy Grave') ?></td>
        </tr>
        <?php 
            endif;
        endforeach; 
        ?>
    </table>
    
    <h3>Registro de Inasistencia</h3>
    <table>
        <tr>
            <th>#</th>
            <th>Fecha</th>
            <th>Tipo</th>
        </tr>
        <?php 
        $contador = 1;
        foreach($asistencias as $asistencia): 
            if($asistencia['tipo'] != 'A'):
        ?>
        <tr>
            <td><?= $contador++ ?></td>
            <td><?= date('d/m/Y', strtotime($asistencia['fecha'])) ?></td>
            <td><?= $asistencia['tipo'] == 'I' ? 'Injustificada' : 'Justificada' ?></td>
        </tr>
        <?php 
            endif;
        endforeach; 
        ?>
    </table>
    
    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>