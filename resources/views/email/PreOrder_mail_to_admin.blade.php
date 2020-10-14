<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0;">
    <meta name="format-detection" content="telephone=no"/>
    <style>
        body {
            margin: 0;
            padding: 0;
            min-width: 100%;
            width: 100% !important;
            height: 100% !important;
        }

        body, table, td, div, p, a {
            -webkit-font-smoothing: antialiased;
            text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
            line-height: 100%;
        }

        table, td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
            border-collapse: collapse !important;
            border-spacing: 0;
        }

        img {
            border: 0;
            line-height: 100%;
            outline: none;
            text-decoration: none;
            -ms-interpolation-mode: bicubic;
        }

        #outlook a {
            padding: 0;
        }

        .ReadMsgBody {
            width: 100%;
        }

        .ExternalClass {
            width: 100%;
        }

        .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {
            line-height: 100%;
        }

        @media all and (min-width: 560px) {
            .container {
                border-radius: 8px;
                -webkit-border-radius: 8px;
                -moz-border-radius: 8px;
                -khtml-border-radius: 8px;
            }
        }

        a, a:hover {
            color: #FFFFFF;
        }

        .footer a, .footer a:hover {
            color: #828999;
        }
    </style>
    <title>Medical Pharma Resource Email Notifications</title>
</head>
<body topmargin="0" rightmargin="0" bottommargin="0" leftmargin="0" marginwidth="0" marginheight="0" width="100%"
      style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; width: 100%; height: 100%; -webkit-font-smoothing: antialiased; text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; line-height: 100%;
		background-color: #2D3445;
		color: #FFFFFF;"
      bgcolor="#2D3445"
      text="#FFFFFF">
<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0"
       style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; width: 100%;" class="background">
    <tr>
        <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0;"
            bgcolor="#2D3445">
            <table border="0" cellpadding="0" cellspacing="0" align="center"
                   width="500" style="border-collapse: collapse; border-spacing: 0; padding: 0; width: inherit;
				max-width: 500px;" class="wrapper">
                <tr>
                    <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%;
						padding-top: 20px;
						padding-bottom: 20px;">
                        <a target="_blank" style="text-decoration: none;"
                           href=""><img border="0" vspace="0" hspace="0"
                                        src="https://mp-resource.shop/wp-content/uploads/2019/12/Logo-Original.png"
                                        width="150" height="50"
                                        alt="Medical Pharma Resource" style="
							color: #FFFFFF;
						font-size: 10px; margin: 0; padding: 0; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; border: none; display: block;"/></a>
                    </td>
                </tr>
                <tr>
                    <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0;  padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 24px; font-weight: bold; line-height: 130%;
						padding-top: 5px;
						color: #FFFFFF;
						font-family: sans-serif;" class="header">
                        New Order is Created
                    </td>
                </tr>
                <tr>
                    <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%;
						padding-top: 24px;" class="line">
                        <hr
                                color="#565F73" align="center" width="100%" size="1" noshade
                                style="margin: 0; padding: 0;"/>
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 17px; font-weight: 400; line-height: 160%;
						padding-top: 15px;
						color: #FFFFFF;
						font-family: sans-serif; font-style: italic;" class="paragraph">
                        Dear Administrator,
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 17px; font-weight: 400; line-height: 160%;
						padding-top: 10px;
						color: #FFFFFF;
						font-family: sans-serif; justify-content: center;" class="paragraph">
                        A User Name: <strong>{{$data['name']}}</strong>, Email: <strong>{{$data['user_email']}}</strong>
                        has place an Order, Here are the details of the Order
                    </td>
                </tr>

                <tr>
                    <td align="left" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 17px; font-weight: 400; line-height: 160%;
						padding-top: 30px;
						color: #FFFFFF;
						font-family: sans-serif; justify-content: center;" class="paragraph">


                        <div style="padding-bottom: 5px;">Order ID: <strong
                                    style="color: #bbb;font-size: 18px;">{{$data['order']->id}}</strong></div>
                        <div style="padding-bottom: 5px;">Total Price: <strong
                                    style="color: #bbb;font-size: 18px;">{{$data['order']->total_price}}</strong></div>
                        <div style="padding-bottom: 5px;">Status: <strong
                                    style="color: #bbb;font-size: 18px;">{{$data['order']->status}}</strong></div>

                        @foreach($data['order']->carts as $cart)
                            <div style="padding-bottom: 5px;">Prduct Name : <strong
                                        style="color: #bbb;font-size: 18px;">{{$cart->product_name}}</strong></div>
                            <div style="padding-bottom: 5px;">Cart Item Price: <strong
                                        style="color: #bbb;font-size: 18px;">{{$cart->price}}</strong></div>
                            <div style="padding-bottom: 5px;">Variation Value Name: <strong
                                        style="color: #bbb;font-size: 18px;">{{$cart->variation_value_name}}</strong>
                            </div>
                            <div style="padding-bottom: 5px;">Quantity: <strong
                                        style="color: #bbb;font-size: 18px;">{{$cart->quantity}}</strong></div>
                        @endforeach

                    </td>
                </tr>

                <tr>
                    <td align="left" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 15px; font-weight: 400; line-height: 160%;
						padding-top: 15px;
						color: #FFFFFF;
						font-family: sans-serif;" class="paragraph">
                        Thanks,<br/>
                        Medical Pharma Resource
                    </td>
                </tr>
                <tr>
                    <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%;
						padding-top: 30px;" class="line">
                        <hr
                                color="#565F73" align="center" width="100%" size="1" noshade
                                style="margin: 0; padding: 0;"/>
                    </td>
                </tr>
                <tr>
                    <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 13px; font-weight: 400; line-height: 150%;
						padding-top: 10px;
						padding-bottom: 20px;
						color: #828999;
						font-family: sans-serif;" class="footer">
                        Copyright © 2019-2020, Medical Pharma Resource GmbH
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
