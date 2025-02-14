<!DOCTYPE html>
<html>
    <head>
        <style type="text/css">
            body {font-family: Arial, sans-serif; font-size: 14px; }
            table{
                max-width: 600px;
                width: 96%;
                margin: auto;
                border-radius: 20px;
                overflow: hidden;
                border-collapse: separate;
                border-spacing: unset;
            }
            thead{
                background-color: white;
            }
            tfoot{
                background-color: #00B4F1;
                color: white;
                height: 50px;
            }

            tbody{
                background-color: white;

            }

            tbody td{
                padding: 0 20px;
                color: #333333!important;
                border-top: 1px solid lightgrey;
            }

            tfoot td{
                padding: 0 20px;
            }
            tfoot a{
                color: white;
            }

            .im {
                color:#333333;
            }

        </style>
    </head>
    <body style="background-color: #e4efef; padding: 50px 20px;">
        <table>
            <thead>
                <tr>
                    <th>
                        <img style="width:104px;" src="https://crm.mirturizma46.ru/img/logo.png" alt="">
                        <h3>Туристическое агентство «МирТуризма 46»</h3>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="color:#333333">
                        @yield('main')
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td>
                        <a style="color:white" href="https://www.mirturizma46.ru/">Сайт «МирТуризма46»</a>
                    </td>
                </tr>
            </tfoot>
        </table>
    </body>
</html>
