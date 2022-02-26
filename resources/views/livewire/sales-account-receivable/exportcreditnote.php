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
        <title>Sales Account Receivable - Credit Note</title>
    </head>
    <body>
        <table style="width:100%;">
            <tr>
                <td style="text-align: center; padding: 5px;" colspan=4><b><h2>CREDIT NOTE</h2></b></td>
            </tr>
        
            <tr style="border: 2px solid white;">
                <td style="width: 15%; text-align: left; border-bottom: 2px solid white; border-right: 2px solid white;"><b>Nomor </b>  </td>
                <td style="width: 35%; text-align: left; border-bottom: 2px solid white; border-right: 2px solid white;">:   </td>
                <td style="width: 25%; text-align: left; border-bottom: 2px solid white; border-right: 2px solid white;"><b>Nomor PO</b>  </td>
                <td style="width: 25%; text-align: left; border-bottom: 2px solid white;">: <?php echo $credit_note->po_no; ?></td>
            </tr>
            <tr style=" border: 2px solid white;">
                <td style="width: 15%; text-align: left; border-bottom: 2px solid white; border-right: 2px solid white;"><b>Tanggal </b>  </td>
                <td style="width: 35%; text-align: left; border-bottom: 2px solid white; border-right: 2px solid white;">:  <?php echo date_format(date_create($credit_note->created_at), 'd/m/Y'); ?></td>
                <td style="width: 25%; text-align: left; border-bottom: 2px solid white; border-right: 2px solid white;"><b>Tanggal Invoice</b>  </td>
                <td style="width: 25%; text-align: left; border-bottom: 2px solid white;">:  </td>
            </tr>
            <tr>
                <td style="width: 15%; text-align: left; border-right: 2px solid white;"><b>No Invoice </b>  </td>
                <td style="width: 35%; text-align: left; border-right: 2px solid white;">:  <?php echo $credit_note->invoice_no; ?></td>
                <td style="width: 25%; text-align: left; border-right: 2px solid white;"><b>No Tax Invoice</b>  </td>
                <td style="width: 25%; text-align: left;">:  <?php echo $credit_note->tax_invoice_no; ?></td>
            </tr>


            <tr style="border: 2px solid white;">
                <td style="width: 15%; text-align: left; border-bottom: 2px solid white; border-right: 2px solid white;">Kepada, </td>
                <td style="width: 35%; text-align: left; border-bottom: 2px solid white; border-right: 2px solid white;"></td>
                <td style="width: 25%; text-align: left; border-bottom: 2px solid white; border-right: 2px solid white;"></td>
                <td style="width: 25%; text-align: left; border-bottom: 2px solid white;"></td>
            </tr>
            <tr style=" border: 2px solid white;">
                <td style="width: 15%; text-align: left; border-bottom: 2px solid white; border-right: 2px solid white;">Bagian</td>
                <td style="width: 35%; text-align: left; border-bottom: 2px solid white; border-right: 2px solid white;">:  Account Payable</td>
                <td style="width: 25%; text-align: left; border-bottom: 2px solid white; border-right: 2px solid white;"></td>
                <td style="width: 25%; text-align: left; border-bottom: 2px solid white;"></td>
            </tr>
            <tr>
                <td style="width: 15%; text-align: left; border-right: 2px solid white;">Perusahaan</td>
                <td style="width: 35%; text-align: left; border-right: 2px solid white;">:  <?php echo $credit_note->cust_name; ?></td>
                <td style="width: 25%; text-align: left; border-right: 2px solid white;"></td>
                <td style="width: 25%; text-align: left;"></td>
            </tr>
            
        </table>
        


        <table style="width:100%; border: 1px solid black;">
            <tr>
                <td style="width: 8%;"><b>No</b>  </td>
                <td style="width: 9%;"><b>Site</b></td>
                <td style="width: 35%;"><b>Description</b></td>
                <td style="width: 8%;"><b>QTY</b></td>
                <td style="width: 20%;"><b>PRICE/UNIT</b> </td>
                <td style="width: 20%;"><b>Value</b> </td>
            </tr>
            
            <?php
                foreach(\App\Models\SalesInvoiceListingDetaildesc::where('id_master', $credit_note->id)->get() as $i => $item){
            ?>
            <tr>
                <td style="width: 8%;"><?php echo $i+1; ?> </td>
                <td style="width: 9%;"> </td>
                <td style="width: 35%; text-align: left;"><?php echo $item->item_description; ?></td>
                <td style="width: 8%;"><?php echo $item->qty; ?></td>
                <td style="width: 20%; text-align: right;"><?php echo "Rp " . number_format($item->price_perunit,2,',','.') ?> </td>
                <td style="width: 20%; text-align: right;"><?php echo "Rp " . number_format($item->total,2,',','.'); ?> </td>
            </tr>
            <?php
                }
            ?>
          
            <tr>
                <td style="text-align: right;" colspan=5><b>Sub Total (Excluding VAT)</b> </td>
                <td style="width: 20%; text-align: right;"><b><?php echo "Rp " . number_format($credit_note->total,2,',','.'); ?></b> </td>
            </tr>
            <tr>
                <td style="text-align: right;" colspan=5><b>VAT (PPN) 10%</b> </td>
                <td style="width: 20%; text-align: right;"><b><?php echo "Rp " . number_format(($credit_note->total * 10)/100,2,',','.'); ?></b> </td>
            </tr>
            <tr>
                <td style="text-align: right;" colspan=5><b>Total (Including VAT)</b> </td>
                <td style="width: 20%; text-align: right;"><b><?php echo "Rp " . number_format($credit_note->total + (($credit_note->total * 10)/100),2,',','.'); ?></b> </td>
            </tr>
           
            <tr>
                <td style="width: 40%; text-align: left; border-right: 2px solid white;" colspan=3>
                    Jakarta, 1 September 2022 <br>
                    Diketahui oleh PT Ericsson Indonesia
                    
                    <br><br><br><br><br><br><br><br>
                    <hr>
                </td>
                <td style="width: 60%; text-align: left;" colspan=3>
                    <br>
                    Disetujui oleh PT Harapan Utama Prima
                    <br><br><br><br><br><br><br><br>
                    <hr>
                    
                </td>
            </tr>

            
            <!-- <tr>
                <td style="text-align: left;" colspan=6>
                    <b>
                        PT Putra Mulia Telecommunication Account No. HSBC Account : 050-000462-001 <br> 
                        Bank HSBC Head Office, World Trade Center, Jalan Sudirman Kav. 29-31, Jakarta Pusat
                    </b>
                </td>
            </tr> -->
        </table>
        
        
        <table style="width:100%; border: 1px solid black;">
            <tr style="border: 2px solid white;">
                <td style="width: 15%; text-align: left; border-right: 2px solid white; border-bottom: 2px solid white;">
                    Nama
                </td>
                <td style="width: 35%; text-align: left; border-right: 2px solid white; border-bottom: 2px solid white;">
                    : 
                </td>
                <td style="width: 3%; text-align: left; border-right: 2px solid white; border-bottom: 2px solid white;" colspan=2>
                    
                </td>
                <td style="width: 15%; text-align: left; border-right: 2px solid white; border-bottom: 2px solid white;">
                    Nama
                </td>
                <td style="width: 32%; text-align: left; border-bottom: 2px solid white;">
                    : Dwi Ratna Wati
                </td>
            </tr>
            <tr style="border: 2px solid white;">
                <td style="width: 15%; text-align: left; border-right: 2px solid white; border-bottom: 2px solid white;">
                    Jabatan
                </td>
                <td style="width: 35%; text-align: left; border-right: 2px solid white; border-bottom: 2px solid white;">
                    : 
                </td>
                <td style="width: 3%; text-align: left; border-right: 2px solid white; border-bottom: 2px solid white;" colspan=2>
                    
                </td>
                <td style="width: 15%; text-align: left; border-right: 2px solid white; border-bottom: 2px solid white;">
                    Jabatan
                </td>
                <td style="width: 32%; text-align: left; border-bottom: 2px solid white;">
                    : Accounting & Finance Manager
                </td>
            </tr>
            <tr style="border: 2px solid white;">
                <td style="width: 15%; text-align: left; border-right: 2px solid white;">
                    Tanggal
                </td>
                <td style="width: 35%; text-align: left; border-right: 2px solid white;">
                    : 
                </td>
                <td style="width: 3%; text-align: left; border-right: 2px solid white;" colspan=2>
                    
                </td>
                <td style="width: 15%; text-align: left; border-right: 2px solid white;">
                    Tanggal
                </td>
                <td style="width: 32%; text-align: left;">
                    : 
                </td>
            </tr>
        </table>

    </body>
</html>