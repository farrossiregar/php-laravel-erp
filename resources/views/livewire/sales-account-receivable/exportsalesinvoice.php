<!DOCTYPE html>
<html lang=" app()->getLocale() ">
    <head>
        <style>
            @page{
                margin:20px 20px;
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
        <table style="width:100%; border: 2px solid white;">
            <tr>
                <td style="width: 30%; text-align: center;"><b><h2>INVOICE</h2></b>  <hr></td>
            </tr>
        </table>

        <table style="width:100%; border: 2px solid white;">
            <tr >
                <td style="width: 15%; text-align: left; vertical-align: text-top; border: 2px solid white;" rowspan=5><b>Bill To : </b>  </td>
                <td style="width: 35%; text-align: left; vertical-align: text-top; border: 2px solid white;" rowspan=5>
                    <b>FINANCE DEPARTMENT</b>  
                    <br><br>
                    <b>
                        PT HUAWEI TECH INVESTMENT <br>
                        BRI II Building, 20 FLOOR, SUITE 2005 <br>
                        Jl. Jendral Sudirman Kav 44-66 <br>
                        Jakarta Pusat 10210
                    </b>
                </td>
                <td style="width: 25%; text-align: left; border: 2px solid white;"><b>INVOICE NUMBER :</b>  </td>
                <td style="width: 25%; text-align: left; border: 2px solid white;"><b><?php echo $sales_invoice->invoice_no; ?></b>  </td>
            </tr>
            <tr>
                
                
                <td style="width: 25%; text-align: left; border: 2px solid white;"><b>DATE :</b>  </td>
                <td style="width: 25%; text-align: left; border: 2px solid white;"><b><?php echo $sales_invoice->created_at; ?></b>  </td>
            </tr>
            <tr>
                <td style="width: 25%; text-align: left; border: 2px solid white;"><b>Delivery Terms :</b>  </td>
                <td style="width: 25%; text-align: left; border: 2px solid white;"><b></b>  </td>
            </tr>
            <tr>
                
                
                <td style="width: 25%; text-align: left; border: 2px solid white;"><b>Payment Terms :</b>  </td>
                <td style="width: 25%; text-align: left; border: 2px solid white;"><b><?php echo $sales_invoice->top.' Days'; ?></b>  </td>
            </tr>
            <tr>
                
                
                <td style="width: 25%; text-align: left; border: 2px solid white;"><b>Tax Number :</b>  </td>
                <td style="width: 25%; text-align: left; border: 2px solid white;"><b><?php echo $sales_invoice->tax_invoice_no; ?></b>  </td>
            </tr>
            <tr>
                <td style="width: 15%; text-align: left; border: 2px solid white;"><b>Attn : </b>  </td>
                <td style="width: 35%; text-align: left; border: 2px solid white;"><b>FINANCE DEPARTMENT</b>  </td>
                <td style="width: 25%; text-align: left; border: 2px solid white;"><b>PO Number</b>  </td>
                <td style="width: 25%; text-align: left; border: 2px solid white;"><b><?php echo $sales_invoice->po_no; ?></b>  </td>
            </tr>
        </table>
        <br><br>


        <table style="width:100%; border: 1px solid black;">
            <tr>
                <td style="width: 8%;"><b>ITEM</b>  </td>
                <td style="width: 44%;"><b>DESCRIPTION</b></td>
                <td style="width: 8%;"><b>QTY</b></td>
                <td style="width: 20%;"><b>PRICE PER UNIT (IDR)</b> </td>
                <td style="width: 20%;"><b>TOTAL (IDR)</b> </td>
            </tr>
            <tr>
                <td style="width: 8%; border-bottom: 2px solid white;"></td>
                <td style="width: 44%; border-bottom: 2px solid white; text-align: left;">
                    <b>100% for Stated Below :</b><br>
                    <?php echo $sales_invoice->invoice_description; ?>
                </td>
                <td style="width: 8%; border-bottom: 2px solid white;"></td>
                <td style="width: 20%; border-bottom: 2px solid white; text-align: right;"></td>
                <td style="width: 20%; border-bottom: 2px solid white; text-align: right;"></td>
            </tr>
            <?php
                foreach(\App\Models\SalesInvoiceListingDetaildesc::where('id_master', $sales_invoice->id)->get() as $i => $item){
            ?>
            <tr>
                <td style="width: 8%; border-bottom: 2px solid white;"><?php echo $i+1; ?> </td>
                <td style="width: 44%; border-bottom: 2px solid white; text-align: left;"><?php echo $item->item_description; ?></td>
                <td style="width: 8%; border-bottom: 2px solid white;"><?php echo $item->qty; ?></td>
                <td style="width: 20%; border-bottom: 2px solid white; text-align: right;"><?php echo "Rp " . number_format($item->price_perunit,2,',','.') ?> </td>
                <td style="width: 20%; border-bottom: 2px solid white; text-align: right;"><?php echo "Rp " . number_format($item->total,2,',','.'); ?> </td>
            </tr>
            <?php
                }
            ?>
            <tr>
                <td style="width: 8%; border-bottom: 2px solid white;"></td>
                <td style="width: 44%;"></td>
                <td style="width: 8%;"></td>
                <td style="width: 20%;"></td>
                <td style="width: 20%; text-align: right;"><?php echo "Rp " . number_format($sales_invoice->total,2,',','.'); ?></td>
            </tr>
            
            <tr>
                <td style="width: 8%; border-bottom: 2px solid white;"></td>
                <td style="width: 44%;">PPN</td>
                <td style="width: 8%;">10%</td>
                <td style="width: 20%;"></td>
                <td style="width: 20%; text-align: right;"><?php echo "Rp " . number_format(($sales_invoice->total * 10)/100,2,',','.'); ?></td>
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
                
                <td style="width: 80%; text-align: right;" colspan=4>TOTAL IDR</td>
                <td style="width: 20%; text-align: right;"><?php echo "Rp " . number_format($sales_invoice->total + (($sales_invoice->total * 10)/100),2,',','.'); ?></td>
            </tr>
            <tr>
                <td style="width: 40%; text-align: left;" colspan=3>
                    <b>
                        CUSTOMER'S CHOP & SIGNATURE <br>
                        (Received in good condition by)
                    </b>
                    
                    <br><br><br><br><br><br><br><br>

                </td>
                <td style="width: 60%; text-align: center;" colspan=2>
                    <b>PT PUTRA MULIA TELECOMMUNICATION</b>  <br>
                    <br><br><br><br><br><br>
                    <hr>
                    Lim Hoi Sheh<br>
                    Director
                </td>
            </tr>
            <tr>
                <td style="text-align: left;" colspan=5>
                    <b>
                        PT Putra Mulia Telecommunication Account No. HSBC Account : 050-000462-001 <br> 
                        Bank HSBC Head Office, World Trade Center, Jalan Sudirman Kav. 29-31, Jakarta Pusat
                    </b>
                </td>
            </tr>
        </table>
        
        <br>
        <table class="tables">
            

        <table class="tables">
            
        </table>

        <br><br>

    </body>
</html>