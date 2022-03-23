<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
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
                font-size: 12px;
            }
            .text-center {
                text-align: center;
            }
        </style>
        <title>Generate ESAR po_tracking->po_reimbursement_id </title>
    </head>
    <body>
        <table style="width:100%;">
            <tr>
                <td style="width: 10%;"><img src="{{ public_path().'/images/huawei.jpeg'}}" style="width:70px;"></td>
                <td style="width: 90%;text-align:center;">
                    <h3>PT. HUAWEI TECH INVESTMENT<br />ENGINEERING SERVICE ACCEPTANCE REPORT</h3>
                </td>
            </tr>
        </table>
        <table class="tables">
            <tr>
                <td style="width:18%;"><b>Project Name</b></td>
                <td style="width:32%;" class="text-center"><b> po_tracking->project_name</b></td>
                <td style="width:17%;"><b>Acceptance</b></td>
                <td style="width:33%;" class="text-center"><b><?php //echo date_format(date_create($po_tracking->acceptance_date), 'd F Y'); ?></b></td>
            </tr>
            <tr>
                <td><b>Project Code</b></td>
                <td class="text-center"><b>po_tracking->project_code</b></td>
                <td><b>Subcontractor Name</b></td>
                <td class="text-center"><b></b></td>
            </tr>
            <tr>
                <td><b>PO No</b></td>
                <td class="text-center"><b>{{ $data->po_no }}</b></td>
                <td><b>Subcontractor No</b></td>
                <td class="text-center"><b>po_tracking->sub_contract_no</b></td>
            </tr>
            <tr>
                <td><b>Payment Milestone</b></td>
                <td><b>po_tracking->payment_method</b></td>
                <td><b></b></td>
                <td><b></b></td>
            </tr>
        </table>
        <br>
        <table class="tables">
            <tr>
                <th>L/No</th>
                <th>Site ID</th>
                <th>Site Name<</th>
                <th>Description</th>
                <th>UOM</th>
                <th>PO Qty</th>
                <th>Actual Qty</th>
                <th>Start Date on PO</th>
                <th>End Date on PO</th>
                <th>Remarks</th>
            </tr>
            @if($data->type_doc == 1)
                @foreach(\App\Models\PoTrackingNonmsStp::where('id_po_nonms_master',$data->id)->get() as $key => $item)
                <tr>
                    
                    <td>{{ $key + 1}}</td>
                    <td>{{ $data->site_id }}</td>
                    <td>{{ $data->site_id }}</td>
                    <td>{{ $item->pekerjaan }}</td>
                    <td>XXX</td>
                    <td>{{ $item->qty }}</td>
                    <td>XXX</td>
                    <td>XXX</td>
                    <td>XXX</td>
                    <td>XXX</td>
                    
                </tr>
                @endforeach
            @else
                @foreach(\App\Models\PoTrackingNonmsBoq::where('id_po_nonms_master',$data->id)->get() as $key => $item)
               
                <tr>
                    
                    <td>{{ $key + 1}}</td>
                    <td>{{ $data->site_id }}</td>
                    <td>{{ $data->site_id }}</td>
                    <td>{{ $item->item_description }}</td>
                    <td>{{ $item->uom }}</td>
                    <td>{{ $item->qty }}</td>
                    <td>XXX</td>
                    <td>XXX</td>
                    <td>XXX</td>
                    <td>{{ $item->remark }}</td>
                    
                </tr>
                @endforeach
            @endif
        </table>
        <br>
        <table class="tables">
            <tr>
                <td style="width:80%;border-right:0;border-bottom:0;padding-left:50px;">
                    [&nbsp;&nbsp;] Deduction
                </td>
                <td style="width:30%;border-bottom:0;">[&nbsp;&nbsp;] No Deduction</td>
            </tr>
            <tr>
                <th colspan="2" style="border-top:0 !important;"><strong style="color:red">( If there is a deduction information, please put a mark in above box and attached Payment Deduction Statement Form)</strong></th>
            </tr>
        </table>
        <br>
        <table>
            <tr>
                <td width=200 style="vertical-align: bottom"><b>Authorized Signature</b></td>
                <td width=200 style="vertical-align: bottom"><b>Authorized Signature</b></td>
                <td width=200>
                    Date: <span style="border-bottom:1px solid;padding-left:25px;padding-right:25px;"><?php //echo date_format(date_create($po_tracking->acceptance_date), 'd-M-Y'); ?></span><br />
                    <b>Authorized Signature</b>
                </td>
            </tr>
        </table>
        <br><br><br><br />
        <table >
            <tr>
                <td width=200><b style="border-top:1px solid;">Subcontractor Name</b></td>
                <td width=200><b style="border-top:1px solid;">PT Huawei Tech Investment</b></td>
                <td width=200><b style="border-top:1px solid;">PT Huawei Tech Investment</b></td>
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
        <br />
        <p><strong>BCG Guarantee</strong><br />
            Subcontractor:<br />
            I guarantee all ESAR that I claimed are actual works. No any fake information inside. No any private benefit with Huawei engineer  <br />
            Should I disobey this rule, I will accept the consequences as stated in the contract with Huawei.  
        </p>
        <p><strong>Huawei PM:</strong><br />
            I guarantee all ESAR that I signed are the actual works. No any fake information inside. No any private benefit with subcontractors  <br />
            Should I disobey this rule, I will accept the punishment as written BCG which I declared to the company.
        </p>
    </body>
</html>