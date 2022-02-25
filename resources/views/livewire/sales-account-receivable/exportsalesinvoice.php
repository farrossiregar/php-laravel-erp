<!DOCTYPE html>
<html lang=" app()->getLocale() ">
    <head>
        <style>
            @page{
                margin:10px 15px;;
            }
            .tables {
                border-left: 0.01em solid #000;
                border-right: 0;
                border-top: 0.01em solid #000;
                border-bottom: 0;
                border-collapse: collapse;
                width: 100%;
            }
            .tables td,
            .tables th {
                border-left: 0;
                border-right: 0.01em solid #000;
                border-top: 0;
                border-bottom: 0.01em solid #000;
                padding: 5px;
            }
            body {
                font-size: 15px;
            }
            .text-center {
                text-align: center;
            }

            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
                padding: 6px 4px;
                text-align: center;
            }
        </style>
        <title>Sales Account Receivable - Sales Invoice</title>
    </head>
    <body>
        <table style="width:100%;">
            <tr>
                <td style="width: 30%; text-align: center;"><b><h3>INVOICE</h3></b>  </td>
            </tr>
        </table>

        <table style="width:100%;">
            <tr>
                <td style="width: 25%; text-align: left; vertical-align: text-top;" rowspan=5><b>Bill To : </b>  </td>
                <td style="width: 25%; text-align: left; vertical-align: text-top;" rowspan=5><b>INVOICE</b>  </td>
                <td style="width: 25%; text-align: left;"><b>INVOICE NUMBER :</b>  </td>
                <td style="width: 25%; text-align: left;"><b></b>  </td>
            </tr>
            <tr>
                
                
                <td style="width: 25%; text-align: left;"><b>DATE :</b>  </td>
                <td style="width: 25%; text-align: left;"><b></b>  </td>
            </tr>
            <tr>
                
                
                <td style="width: 25%; text-align: left;"><b>Delivery Terms :</b>  </td>
                <td style="width: 25%; text-align: left;"><b></b>  </td>
            </tr>
            <tr>
                
                
                <td style="width: 25%; text-align: left;"><b>Payment Terms :</b>  </td>
                <td style="width: 25%; text-align: left;"><b></b>  </td>
            </tr>
            <tr>
                
                
                <td style="width: 25%; text-align: left;"><b>Tax Number :</b>  </td>
                <td style="width: 25%; text-align: left;"><b></b>  </td>
            </tr>
            <tr>
                <td style="width: 25%; text-align: left;"><b>Attn : </b>  </td>
                <td style="width: 25%; text-align: left;"><b></b>  </td>
                <td style="width: 25%; text-align: left;"><b>PO Number</b>  </td>
                <td style="width: 25%; text-align: left;"><b></b>  </td>
            </tr>
        </table>
        <br><br>

        <!-- <?php print_r($sales_invoice->total); ?> -->
        <!-- <?php echo $sales_invoice; ?> -->

        <table style="width:100%; border: 1px solid black;">
            <tr>
                <td style="width: 8%;"><b>ITEM</b>  </td>
                <td style="width: 44%;"><b>DESCRIPTION</b></td>
                <td style="width: 8%;"><b>QTY</b></td>
                <td style="width: 20%;"><b>PRICE PER UNIT</b> </td>
                <td style="width: 20%;"><b>TOTAL</b> </td>
            </tr>
            <?php
                foreach(\App\Models\SalesInvoiceListingDetaildesc::where('id_master', $sales_invoice->id)->get() as $i => $item){
            ?>
            <tr>
                <td style="width: 8%;"><?php echo $i+1; ?> </td>
                <td style="width: 44%; text-align: left;"><?php echo $item->item_description; ?></td>
                <td style="width: 8%;"><?php echo $item->qty; ?></td>
                <td style="width: 20%; text-align: right;"><?php echo "Rp " . number_format($item->price_perunit,2,',','.') ?> </td>
                <td style="width: 20%; text-align: right;"><?php echo "Rp " . number_format($item->total,2,',','.'); ?> </td>
            </tr>
            <?php
                }
            ?>
            <tr>
                <td style="width: 8%;"></td>
                <td style="width: 44%;"></td>
                <td style="width: 8%;"></td>
                <td style="width: 20%;"></td>
                <td style="width: 20%; text-align: right;"><?php echo "Rp " . number_format($sales_invoice->total,2,',','.'); ?></td>
            </tr>
            <tr>
                <td style="width: 8%;"></td>
                <td style="width: 44%;">
                    Project Quality Deduction<br>
                    Deduction for Project Accidents an Others<br>
                </td>
                <td style="width: 8%;"></td>
                <td style="width: 20%;"></td>
                <td style="width: 20%; text-align: right;"></td>
            </tr>
            <tr>
                <td style="width: 8%;"></td>
                <td style="width: 44%;">PPN</td>
                <td style="width: 8%;">10%</td>
                <td style="width: 20%;"></td>
                <td style="width: 20%; text-align: right;"><?php echo "Rp " . number_format(($sales_invoice->total * 10)/100,2,',','.'); ?></td>
            </tr>
            <tr>
                <td style="width: 80%; text-align: right;" colspan=4>TOTAL IDR</td>
                <td style="width: 20%; text-align: right;"><?php echo "Rp " . number_format($sales_invoice->total + (($sales_invoice->total * 10)/100),2,',','.'); ?></td>
            </tr>
        </table>
        
        <br>
        <table class="tables">
            

        <table class="tables">
            
        </table>

        <br><br>

    </body>
</html>