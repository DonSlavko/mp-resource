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

        .border-line {
            border-top: 1px solid #88b04b;
        }
    </style>

</head>
<body>

<table width="100%">

    <tr>
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
    </tr>

</table>

<table width="100%">
    <tr>
        <td>
            <h1>Rechnung</h1>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Rechnungsnummer:</strong><br>
            {{ $invoice->id }}
        </td>
        <td>
            <strong>Kundennummer:</strong><br>
            {{ $invoice->user->id }}
        </td>
        <td>
            <strong>Auftragsnummer:</strong><br>
            {{ $invoice->order->id }}
        </td>
        <td>
            <strong>Datum:</strong><br>
            {{ $invoice->created_at->format('m.d.Y') }}<br>
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
    @foreach($invoice->order->carts as $key => $item)
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
        <td colspan="2" align="right">{{ number_format((($invoice->order->total_price)/1.19), 2, '.', '') }} €</td>
    </tr>
    <tr>
        <td colspan="3"></td>
        <td colspan="2" align="right">Umsatzsteuer 19%</td>
        <td colspan="2" align="right">{{ number_format(($invoice->order->total_price-(($invoice->order->total_price)/1.19)), 2, '.', '') }} €</td>
    </tr>
    <tr>
        <td colspan="3"></td>
        <td colspan="2" align="right">Gesamtbetrag</td>
        <td colspan="2" align="right" class="gray">{{ $invoice->order->total_price }} €</td>
    </tr>
    </tfoot>
</table>

<table width="100%">
    <tr>
        <td align="left">
            <p>
                Sollten Sie den Gesamtbetrag nicht per Vorkasse oder Sofortüberweisung überweisen haben, dann
                werden wir es innerhalb von 14 Tagen über den von Ihnen erteilten SEPA-Einzug einfordern.
            </p>
            <p>Für weitere Fragen können Sie sich gerne mit uns in Verbindung setzen.
            </p>
            <p>Mit freundlichen Grüßen</p>
            <p>Ihr MPR-Team</p>
        </td>
    </tr>
</table>

<table width="100%" class="border-line">
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
