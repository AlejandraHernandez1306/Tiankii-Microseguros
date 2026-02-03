<!DOCTYPE html>
<html>
<head>
    <title>Contrato de Servicio - Tiankii</title>
    <style>
        body { font-family: 'Arial', sans-serif; padding: 40px; color: #333; }
        .header { text-align: center; border-bottom: 2px solid #000; padding-bottom: 20px; margin-bottom: 30px; }
        .title { font-size: 24px; font-weight: bold; text-transform: uppercase; }
        .content { line-height: 1.6; text-align: justify; }
        .signature { margin-top: 50px; border-top: 1px solid #000; width: 200px; text-align: center; padding-top: 10px; }
        .btn { background: #333; color: #fff; padding: 10px 20px; text-decoration: none; display: inline-block; margin-bottom: 20px; cursor: pointer;}
    </style>
</head>
<body>
    <button onclick="window.print()" class="btn">🖨️ IMPRIMIR / GUARDAR PDF</button>

    <div class="header">
        <div class="title">TIANKII MICROSEGUROS S.A. DE C.V.</div>
        <p>Contrato de Adhesión a Póliza de Seguro de Salud Rural</p>
    </div>

    <div class="content">
        <p>Por medio del presente documento, se certifica que <strong><?php echo e(Auth::user()->name); ?></strong> (el "Asegurado"), con correo electrónico <?php echo e(Auth::user()->email); ?>, ha adquirido satisfactoriamente la póliza de microseguro.</p>

        <h3>TÉRMINOS Y CONDICIONES</h3>
        <p>1. <strong>COBERTURA:</strong> La aseguradora se compromete a cubrir gastos médicos hasta por la suma de $1,000.00 USD anuales.</p>
        <p>2. <strong>COPAGO:</strong> El asegurado será responsable del 20% de cada evento médico realizado en la red.</p>
        <p>3. <strong>VIGENCIA:</strong> Este contrato entra en vigor a partir de la fecha de registro: <?php echo e(Auth::user()->created_at->format('d/m/Y')); ?>.</p>
        
        <p>Este documento sirve como comprobante legal de afiliación.</p>
    </div>

    <div class="signature">
        Firma Autorizada<br>Tiankii Seguros
    </div>
</body>
</html><?php /**PATH C:\Users\Ale Mar\Tiankii-Microseguros\sistema\resources\views/contract.blade.php ENDPATH**/ ?>