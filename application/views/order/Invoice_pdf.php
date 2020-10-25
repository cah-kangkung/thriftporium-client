<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title><?php echo $title ?></title>

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .rtl table {
            text-align: right;
        }

        .rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="<?php echo base_url(); ?>assets/img/logo/thrift_logo_fixbgt.png" style="width:100%; max-width:150px;">
                            </td>

                            <td>
                                Invoice: <?php echo $payment["inv_number"] ?><br>
                                Created: <?php echo $payment["payment_created"] ?><br>
                                Due: <?php echo $payment["payment_expired"] ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                <br>
                                Thriftporium.id<br>
                                thriftporium.id@gmail.com

                            </td>

                            <td>
                                <br>
                                <?php echo $user["user_firstname"] . " " . $user["user_lastname"] ?><br>
                                <?php echo $user["user_email"] ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td>
                    Payment Method
                </td>

                <td>
                    Status
                </td>
            </tr>

            <tr class="details">
                <td>
                    <?php echo $payment["payment_accounttype"] . " " . $payment['payment_bank_name'] ?>
                </td>

                <td>
                    <?php if ($payment['payment_status'] < 3) {
                        echo 'UNPAID';
                    } else {
                        echo 'PAID';
                    }
                    ?>
                </td>
            </tr>

            <tr class="heading">
                <td>
                    Item
                </td>

                <td>
                    Price
                </td>
            </tr>
            <?php for ($i = 0; $i < count($products); $i++) : ?>
                <tr class="item">
                    <td>
                        <?php echo $products[$i]['product_name']; ?> x <?php echo $products[$i]['qty'] ?>
                    </td>

                    <td>
                        Rp<?php echo ($products[$i]['product_price'] * $products[$i]['qty']) / 1000; ?>.000
                    </td>
                </tr>
            <?php endfor; ?>

            <tr class="item last">
                <td>
                    Shipping (<?php echo $courier['courier_name'] ?>)
                </td>

                <td>
                    Rp<?php echo $order['shipping_price'] / 1000 ?>.000
                </td>
            </tr>

            <tr class="total">
                <td></td>
                <td>
                    Total: Rp<?php echo $payment['total_price'] / 1000 ?>.000
                </td>
            </tr>
        </table>
    </div>
</body>

</html>