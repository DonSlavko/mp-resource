<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Aloha!</title>

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        table{
            font-size: x-small;
        }
        tfoot tr td{
            font-weight: bold;
            font-size: x-small;
        }

        .gray {
            background-color: lightgray
        }
    </style>

</head>
<body>

<table width="100%">
    <tr>
        <td></td>
        <td align="right"><img src="{{asset('/Logo-Original.png')}}" alt="" width="150"/></td>
    </tr>

    <tr>
        <td align="left">
            <p>Medical Pharma Resource GmbH Marktplatz 1  40764  Langenfeld</p>
            <p>
                Musterapotheke <br>
                Musterstrastraße 12 <br>
                67891 Musterstadt
            </p>
            <pre>

            </pre>
        </td>

        <td align="right">
            <h3></h3>
            <p>
                <strong>Kundennummer:</strong><br>
                {{ $order->user->id }} <br>
                <strong>Auftragsnummer:</strong><br>
                {{ $order->id }} <br>
                <strong>Datum:</strong><br>
                {{ $order->created_at->format('m.d.Y') }}<br>
                <strong>Bezug:</strong><br>
                <strong>Vobestellungsummer:</strong><br>
                {{ $order->preorder_id ?? '' }} <br>

            </p>
        </td>
    </tr>

</table>

<table width="100%">
    <tr>
        <td>
            <h1>Auftragsbestätigung</h1>
            <p>
                Sehr geehrte Damen und Herren,<br>
                vielen Dank fur ihre verbindliche Vorbestellung und ihr Verstrauen. Wir freuen uns uber
                ihr Interesse an unseren Produkten. Sie haben folgende Produkte bei uns vorbestellt:
            </p>
        </td>
    </tr>

</table>

<br/>

<table width="100%">
    <thead style="background-color: lightgray;">
    <tr>
        <th>Position</th>
        <th>Anzahl</th>
        <th>Preis</th>
        <th>EinHeit(g/Kg)</th>
        <th>Beschreibung</th>
        <th>Steuer</th>
        <th>Netto</th>
    </tr>
    </thead>
    <tbody>
    @foreach($order->carts as $key => $item)
        <tr>
            @php
                $product = $item->product;

                $variation_price = $product->variationValues()->where('variation_value_product.variation_value_id', $item->variation_value->id)->first()->pivot->price;

            @endphp
            <th scope="row">{{ $key }}</th>
            <td>{{ $item->quantity }}</td>
            <td>{{ $variation_price }} €</td>
            <td>{{ $item->variation_value->name }}</td>
            <td>{{ $item->product->name }}</td>
            <td>19%</td>
            <td>{{ number_format((($item->price)/1.19), 2, '.', '') }} €</td>
        </tr>
    @endforeach
    </tbody>

    <tfoot>
    <tr>
        <td colspan="3"></td>
        <td colspan="2" align="right">Zwischensumme Netto</td>
        <td colspan="2" align="right">{{ number_format((($order->total_price)/1.19), 2, '.', '') }} €</td>
    </tr>
    <tr>
        <td colspan="3"></td>
        <td colspan="2" align="right">Umsatzsteuer 19%</td>
        <td colspan="2" align="right">{{ number_format(($order->total_price-(($order->total_price)/1.19)), 2, '.', '') }} €</td>
    </tr>
    <tr>
        <td colspan="3"></td>
        <td colspan="2" align="right">Gesamtbetrag</td>
        <td colspan="2" align="right" class="gray">{{ $order->total_price }} €</td>
    </tr>
    </tfoot>
</table>

<table width="100%" style="margin-top: 2rem">
    <tr>
        <td align="left">
            <p>

            </p>
            <p>Ihr Rechnung wird parallel erstellt und Ihnen zeitnah versendet, Solten Sie weitere Fragen haben, dürfen Sie uns gerne kontaktieren.
            </p>
            <p>Mit freundlichen Grüßen</p>
            <p>Ihr MPR-Team</p>
        </td>
    </tr>
</table>

<table width="100%">
    <tr>
        <td>Medical Pharma Resource GmbH <br>
            Markplatz 1<br>
            40746 Largenfeld <br>
            Deutschland
        </td>
        <td>CEO: Eng in Ates <br>
            St-Nr: 230/5712/3624 <br>
            USt.-Id-Nr: DE323439826 <br>
            Handelsregister: HRB 88695 <br>
            AG Düsseldorf
        </td>
        <td>Telefon: 02173/ 940 94 91 <br>
            Telefax: 02173/ 940 94 99 <br>
            E-Mail: info@mp-resource.shop <br>
            Web: mp-resource.shop
        </td>
        <td>
            Bank: Commerzbank Köln <br>
            IBAN: DE81 3704 0044 0505 3525 00 <br>
            BIC: COBADEFFXXX
        </td>
    </tr>

</table>
</body>
</html>
