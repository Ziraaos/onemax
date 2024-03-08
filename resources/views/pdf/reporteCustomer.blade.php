<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Reporte cliente {{ $namec }}</title>

    <!-- cargar a través de la url del sistema -->

    {{-- <link rel="stylesheet" href="{{ asset('css/custom_pdf.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_page.css') }}"> --}}

    <!-- ruta física relativa OS -->
    <link rel="stylesheet" href="{{ public_path('css/custom_pdf.css') }}">
    <link rel="stylesheet" href="{{ public_path('css/custom_page.css') }}">

</head>

<body>

    <section class="header" style="top: -287px;">
        <table cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td colspan="2" class="text-center">
                    <span style="font-size: 25px; font-weight: bold;">ONEMAX</span>
                </td>
            </tr>
            <tr>
                <td width="30%" style="vertical-align: top; padding-top: 10px; position: relative">
                    <img src="{{ asset('assets/images/O.png') }}" alt="" class="invoice-logo">
                </td>

                <td width="70%" class="text-left text-company" style="vertical-align: top; padding-top: 10px">
                    <span style="font-size: 16px"><strong>Reporte del cliente: {{ $namec }}</strong></span>
                    <br>
                    <span style="font-size: 16px"><strong>Lugar de servicio: {{ $location ?? ' ' }}</strong></span>
                    <br>
                </td>
            </tr>
        </table>
    </section>


    <section style="margin-top: -110px">
        <table cellpadding="0" cellspacing="0" class="table-items" width="100%">
            <thead>
                <tr>
                    <th width="25%">MES</th>
                    <th width="25%">MONTO</th>
                    <th width="25%">ESTADO</th>
                    <th width="25%">DEUDA</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td align="center">{{ \Carbon\Carbon::parse($item->date_serv)->format('m-Y') }}</td>
                        <td align="center">{{ number_format($item->debt, 2) }}</td>
                        <td align="center">
                            @if ($item->status == 'PAID')
                                PAGADO
                            @elseif ($item->status == 'PENDING')
                                PENDIENTE
                            @else
                                {{ $item->status }}
                            @endif
                        </td>
                        <td align="center">{{ number_format($item->total, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-center">
                        <span><b>TOTALES</b></span>
                    </td>
                    <td class="text-center">
                        <span><strong>Bs. {{ number_format($suma, 2) }}</strong></span>
                    </td>
                </tr>
            </tfoot>
        </table>
    </section>


    <section class="footer">

        <table cellpadding="0" cellspacing="0" class="table-items" width="100%">
            <tr>
                <td width="20%">
                    <span>Sistema ONEMAX v1</span>
                </td>
                <td width="60%" class="text-center">
                    by Franz Ramos
                </td>
                <td class="text-center" width="20%">
                    página <span class="pagenum"></span>
                </td>

            </tr>
        </table>
    </section>

</body>

</html>
