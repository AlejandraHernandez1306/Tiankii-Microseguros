<!DOCTYPE html>
<html>
<head>
    <title>Receta Médica - {{ $atencion->paciente->name }}</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; padding: 40px; color: #333; max-width: 800px; margin: 0 auto; border: 1px solid #eee; }
        .header { display: flex; justify-content: space-between; border-bottom: 2px solid #008080; padding-bottom: 20px; margin-bottom: 30px; }
        .brand h1 { margin: 0; color: #008080; }
        .brand p { margin: 5px 0 0; color: #666; font-size: 14px; }
        .meta { text-align: right; font-size: 14px; }
        .patient-info { background: #f9f9f9; padding: 15px; border-radius: 5px; margin-bottom: 30px; }
        .section-title { font-weight: bold; color: #008080; margin-bottom: 10px; border-bottom: 1px solid #ddd; padding-bottom: 5px; }
        .content { margin-bottom: 30px; line-height: 1.6; }
        .footer { margin-top: 50px; text-align: center; font-size: 12px; color: #999; border-top: 1px solid #eee; padding-top: 20px; }
        .btn-print { background: #008080; color: white; border: none; padding: 10px 20px; cursor: pointer; font-size: 14px; border-radius: 4px; }
        @media print { .btn-print { display: none; } body { border: none; } }
    </style>
</head>
<body>
    <button onclick="window.print()" class="btn-print">🖨️ Imprimir / Guardar PDF</button>

    <div class="header">
        <div class="brand">
            <h1>TIANKII</h1>
            <p>Red de Microseguros de Salud</p>
        </div>
        <div class="meta">
            <p><strong>Fecha:</strong> {{ $atencion->created_at->format('d/m/Y') }}</p>
            <p><strong>Folio:</strong> #{{ str_pad($atencion->id, 6, '0', STR_PAD_LEFT) }}</p>
        </div>
    </div>

    <div class="patient-info">
        <p><strong>Paciente:</strong> {{ $atencion->paciente->name }}</p>
        <p><strong>Médico Tratante:</strong> Dr. {{ $atencion->medico->name }}</p>
    </div>

    <div class="content">
        <div class="section-title">DIAGNÓSTICO</div>
        <p>{{ $atencion->diagnostico }}</p>
    </div>

    <div class="content">
        <div class="section-title">RECETA MÉDICA (Rp)</div>
        <p style="white-space: pre-line;">{{ $atencion->receta }}</p>
    </div>

    <div class="footer">
        <p>Este documento es un comprobante digital de atención médica generado por la plataforma Tiankii.</p>
        <p>San Salvador, El Salvador</p>
    </div>
</body>
</html>