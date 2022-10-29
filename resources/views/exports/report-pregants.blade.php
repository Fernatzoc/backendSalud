<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
  <title>Reporte de Pagos</title>

  <!-- Styles -->
  <link href="{{ public_path('assets/css/custom_pdf.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>
  {{-- <div class="row">
    <div class="col-xs-4">
      <div class="invoice-logo-container">
        <img class="invoice-logo" src="{{ public_path('assets/img/logo-ct.jpg') }}">
      </div>
    </div>
    <div class="col-xs-8">
      <h1 class="font-weight-bold">
        Sistema
      </h1>
      <div class="text-company">
        <div class="font-weight-bold fs-18">
          Reporte
        </div>
        <div class="fs-16">
          Fecha: {{ $from->eq($to) ? $from->format('d/m/Y') : "{$from->format('d/m/Y')} al
          {$to->format('d/m/Y')}" }}
        </div>
        <div class="fs-16">Usuario: {{ $user }}</div>
      </div>
    </div>
  </div> --}}

  <div class="row">
    <div class="col-xs-12">
      <table cellpadding="0" cellspacing="0" class="table-items" width="100%">
        <thead>
          <tr>
            <th width="13%">Cui</th>
            <th width="20%">Nombre</th>
            <th width="20%">Direccion</th>
            <th width="11%">Fecha de nacimiento</th>
            <th width="11%">Ultima regla</th>
            <th width="7%">Peso</th>
            <th width="7%">Altura</th>
            <th width="11%">Fecha de registro</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($pregants as $pregant)
          <tr>
            <td align="center">{{ $pregant->cui}}</td>
            <td align="center">{{ $pregant->nombres . ' ' . $pregant->apellidos}}</td>
            <td align="center">{{ $pregant->direccion}}</td>
            <td align="center">{{ $pregant->fecha_de_nacimiento}}</td>
            <td align="center">{{ $pregant->ultima_regla}}</td>
            <td align="center">{{ $pregant->peso}} lb</td>
            <td align="center">{{ $pregant->altura}} mt</td>
            <td align="center">{{ \Carbon\Carbon::parse($pregant->created_at)->format('d-m-Y') }}</td>
          </tr>
          @empty
          <tr>
            <td colspan="5">No se ha encontrado ningún registro</td>
          </tr>
          @endforelse
        </tbody>
        {{-- <tfoot>
          <tr>
            <td class="text-center">
              <span class="font-weight-bold">
                TOTALES:
              </span>
            </td>
            <td colspan="1" class="text-center">
              <span class="font-weight-bold">
                ${{ number_format($pagos->sum('montoPagado'), 2) }}
              </span>
            </td>
            <td class="text-center">
              {{ $pagos->sum('prestamoMonto') }}
            </td>
            <td colspan="3"></td>
          </tr>
        </tfoot> --}}
      </table>
    </div>
  </div>

  <div class="footer">
    <table cellpadding="0" cellspacing="0" class="table-items" width="100%">
      <tr>
        <td width="20%">
          <span>Sistema</span>
        </td>
        <td width="60%" class="text-center">
          <span>UMG</span>
        </td>
        <td width="20%" class="text-center">
          Pagina <span class="pagenum"></span>
        </td>
      </tr>
    </table>
  </div>

</body>

</html>