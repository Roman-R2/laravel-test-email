<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Simples-Minimalistic Responsive Template</title>

    <style type="text/css">
        /* Client-specific Styles */
        #outlook a {
            padding: 0;
        }

        /* Force Outlook to provide a "view in browser" menu link. */
        body {
            width: 100% !important;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            margin: 0;
            padding: 0;
        }

        /* Force Hotmail to display normal line spacing.*/
        #backgroundTable {
            margin: 0;
            padding: 0;
            width: 100% !important;
            line-height: 100% !important;
        }

        img {
            outline: none;
            text-decoration: none;
            border: none;
            -ms-interpolation-mode: bicubic;
        }

        a img {
            border: none;
        }

        p {
            margin: 0px 0px !important;
        }

        table td {
            border-collapse: collapse;
        }

        table {
            border-collapse: collapse;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        a {
            color: #0a8cce;
            text-decoration: none;
            text-decoration: none !important;
        }
    </style>
</head>
<body>
<table width="100%" bgcolor="#ffffff" cellpadding="0" cellspacing="0" border="0" id="backgroundTable"
       st-sortable="full-text">
    <tbody>
    <tr>
        <td>
            <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                <tbody>
                <tr>
                    <td>
                        <table width="560" align="center" cellpadding="0" cellspacing="0" border="0"
                               class="devicewidthinner">
                            <tbody>
                            <tr>
                                <td style="padding-top: 30px; font-family: Helvetica, arial, sans-serif; font-size: 30px; color: #333333; text-align:center; line-height: 30px;"
                                    st-title="fulltext-heading">
                                    Поздравляю! У вас новое сообщение.
                                </td>
                            </tr>
                            <tr>
                                <td width="100%" height="20"
                                    style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td style="font-family: Helvetica, arial, sans-serif; font-size: 16px; color: #666666; text-align:center; line-height: 30px;"
                                    st-content="fulltext-content">
                                    {{ $text }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>
