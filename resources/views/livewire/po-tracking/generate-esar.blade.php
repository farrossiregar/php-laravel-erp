<html>
    <head>
        <style>
            .tables {
                border-left: 0.01em solid #000;
                border-right: 0;
                border-top: 0.01em solid #000;
                border-bottom: 0;
                border-collapse: collapse;
            }
            .tables td,
            .tables th {
                border-left: 0;
                border-right: 0.01em solid #000;
                border-top: 0;
                border-bottom: 0.01em solid #000;
            }
            body {
                font-size: 12px;
            }
        </style>
        <title>Generate ESAR {{ date('d-M-Y',strtotime($po_tracking->created_at)) }}</title>
    </head>
    <body>
        <table>
            <tr>
                <td width=70><b><!-- <img src="<?php echo asset('storage/po_tracking/logo/logo-huawei.jpg'); ?>"> --></b></td>
                <td width=100><b><h3>PT. HUAWEI TECH INVESTMENT ENGINEERING SERVICE ACCEPTANCE REPORT</h3></b></td>
                <td width=90></td>
            </tr>
        </table>
        <br>
        <table class="tables" border=1>
            <tr>
                <td width=120><b>Project Name</b></td>
                <td width=125><b>{{ $po_tracking->project_name }}</b></td>
                <td width=125><b>Acceptance</b></td>
                <td width=125><b><?php echo date_format(date_create($po_tracking->acceptance_date), 'd F Y'); ?></b></td>
            </tr>
            <tr>
                <td><b>Project Code</b></td>
                <td><b>{{ $po_tracking->project_code }}</b></td>
                <td><b>Subcontractor Name</b></td>
                <td><b></b></td>
            </tr>
            <tr>
                <td><b>PO No</b></td>
                <td><b>{{ $po_tracking->po_no }}</b></td>
                <td><b>Subcontractor No</b></td>
                <td><b>{{ $po_tracking->sub_contract_no }}</b></td>
            </tr>
            <tr>
                <td><b>Payment</b></td>
                <td><b></b></td>
                <td><b></b></td>
                <td><b></b></td>
            </tr>
        </table>
        <br>
        <table  class="tables" border=1>
            <tr>
                <td><b>L/No</b></td>
                <td><b>Site ID</b></td>
                <td><b>Site Name</b></td>
                <td><b>Description</b></td>
                <td><b>UOM</b></td>
                <td><b>PO Qty</b></td>
                <td><b>Actual Qty</b></td>
                <td><b>Start Date on PO</b></td>
                <td><b>End Date on PO</b></td>
                <td><b>Remarks</b></td>
            </tr>
            <?php $no = 0; ?>
            {{-- @foreach($po_tracking as $key => $item) --}}
            <?php $no++; ?>
            <tr>
                <td>{{ $no }}</td>
                <td>{{ @$po_tracking->site_code }}</td>
                <td>{{ @$po_tracking->site_name }}</td>
                <td>{{ @$po_tracking->item_description }}</td>
                <td>{{ @$po_tracking->unit }}</td>
                <td>{{ @$po_tracking->requested_qty }}</td>
                <td>{{ @$po_tracking->due_qty }}</td>
                <td><?php echo date_format(date_create($po_tracking->start_date), 'd-m-Y'); ?></td>
                <td><?php echo date_format(date_create($po_tracking->end_date), 'd-m-Y'); ?></td>
                <td>{{ @$po_tracking->note_to_receiver }}</td>
            </tr>
            {{-- @endforeach --}}
        </table>
        <br>
        <div style="border 0.01em solid black;">
            <table>
                <tr>
                    <td width=140></td>
                    <td width=230>[ ] Deduction</td>
                    <td width=80></td>
                    <td width=230>[ ] No Deduction</td>
                </tr>
            </table>
        </div>
        
        <br>
        <table>
            <tr>
                <td width=200></td>
                <td width=200></td>
                <td width=200><b>Date: <?php echo date_format(date_create($po_tracking->acceptance_date), 'd-m-Y'); ?></b></td>
            </tr>
        </table>
        <table>
            <tr>
                <td width=200><b>Authorized Signature</b></td>
                <td width=200><b>Authorized Signature</b></td>
                <td width=200><b>Authorized Signature</b></td>
            </tr>
        </table>
        <br><br><br>
        <table >
            <tr>
                <td width=200><b>Subcontractor Name</b></td>
                <td width=200><b>PT Huawei Tech Investment</b></td>
                <td width=200><b>PT Huawei Tech Investment</b></td>
            </tr>
            <tr>
                <td>Name : Lim Hooi Seeh</td>
                <td>Name : Yoyok Madiyanto (WX579951)</td>
                <td>Name : Muhammad Ricky (00739513)</td>
            </tr>
            <tr>
                <td>Title : Director</td>
                <td>Title : GM FOP Jabo</td>
                <td>Title : GH FOP Jabo</td>
            </tr>
        </table>
       
    </body>
</html>