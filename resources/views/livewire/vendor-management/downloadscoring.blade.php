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
                font-size: 12px;
            }
            .text-center {
                text-align: center;
            }
        </style>
        <title>Vendor Management - Supplier Scoring Summary</title>
    </head>
    <body>
        <table style="width:100%;">
            <tr>
                <td style="width: 30%;"><b>Supplier Scoring Summary</b>  </td>
            </tr>
        </table>
        <br><br>

        <table style="width:100%;">
            
            <tr>
                <td style="width: 30%;"><b>Date :</b> {{ date_format(date_create($vendor_management['created_at']), 'd M Y') }} </td>
            </tr>
            <tr>
                <td style="width: 30%;"><b>Working period :</b></td>
            </tr>
            <tr>
                <td style="width: 30%;"><b>Supplier Name :</b> {{ $vendor_management['supplier_pic'] }}</td>
            </tr>
            <tr>
                <td style="width: 30%;"><b>Category :</b> </td>
            </tr>
        </table>
        
        <br>
        <table class="tables">
            <tr>
                <td style="width:25%;"><b>Indicator</b></td>
                <td style="width:45%;" ><b> Detail Indicator </b></td>
                <td style="width:10%;"><b>Score</b></td>
                <td style="width:10%;"><b>Point</b></td>
                <td style="width:10%;" ><b>Total</b></td>
            </tr>
            <tr>
                <td><b>01. General Information</b></td>
                <td ><b> Company Legality Compliance </b></td>
                <td><b>{{ $vendor_management['general_information'] }}</b></td>
                
                @if($vendor_management['supplier_category'] != 'Material Supplier')
                <td><b>10%</b></td>
                <td ><b><?php echo ($vendor_management['general_information'] * 10) / 100 ?></b></td>
                @else
                <td><b>40%</b></td>
                <td ><b><?php echo ($vendor_management['general_information'] * 40) / 100 ?></b></td>
                @endif
            </tr>
            @if($vendor_management['supplier_category'] != 'Material Supplier')
            <tr>
                <td><b>02. Team Availability</b></td>
                <td ><b> Quantity & Quality to support work  </b></td>
                <td><b>{{ $vendor_management['team_availability_capability'] }}</b></td>
                <td><b>25%</b></td>
                <td ><b><?php echo ($vendor_management['team_availability_capability'] * 25) / 100 ?></b></td>
            </tr>
            <tr>
                <td><b>03. Tools & Facilities</b></td>
                <td ><b> Working Tool & Support completeness </b></td>
                <td><b>{{ $vendor_management['tools_facilities'] }}</b></td>
                <td><b>20%</b></td>
                <td ><b><?php echo ($vendor_management['tools_facilities'] * 20) / 100 ?></b></td>
            </tr>
            <tr>
                <td><b>04. EHS & Quality Management</b></td>
                <td ><b> Compliance to Company EHS rules & project quality management </b></td>
                <td><b>{{ $vendor_management['ehs_quality_management'] }}</b></td>
                <td><b>20%</b></td>
                <td ><b><?php echo ($vendor_management['ehs_quality_management'] * 20) / 100 ?></b></td>
            </tr>
            @endif
            <tr>
                @if($vendor_management['supplier_category'] != 'Material Supplier')
                <td><b>05. Commercial Compliance</b></td>
                @else
                <td><b>02. Commercial Compliance</b></td>
                @endif
                <td ><b> Competitive Pricing, Lead Time, and Payment Term  </b></td>
                <td><b>{{ $vendor_management['commercial_compliance'] }}</b></td>
                @if($vendor_management['supplier_category'] != 'Material Supplier')
                <td><b>25%</b></td>
                <td ><b><?php echo ($vendor_management['commercial_compliance'] * 25) / 100 ?></b></td>
                @else
                <td><b>60%</b></td>
                <td ><b><?php echo ($vendor_management['commercial_compliance'] * 60) / 100 ?></b></td>
                @endif
            </tr>
            <tr>
                <td colspan="2"></td>
                <td><b><?php echo $vendor_management['general_information'] + $vendor_management['team_availability_capability'] + $vendor_management['tools_facilities'] + $vendor_management['ehs_quality_management'] + $vendor_management['commercial_compliance'] ?></b></td>
                <td><b>100%</b></td>
                <td ><b><?php echo (($vendor_management['general_information'] * 10) / 100) + (($vendor_management['team_availability_capability'] * 25) / 100) + (($vendor_management['tools_facilities'] * 20) / 100) + (($vendor_management['ehs_quality_management'] * 20) / 100) + (($vendor_management['commercial_compliance'] * 25) / 100) ?></b></td>
            </tr>
        </table>
        <br><br>

        <table class="tables">
            <tr>
                <td colspan="2" style="width:100%;">
                    <b>Result of Scoring : </b> <?php echo (($vendor_management['general_information'] * 10) / 100) + (($vendor_management['team_availability_capability'] * 25) / 100) + (($vendor_management['tools_facilities'] * 20) / 100) + (($vendor_management['ehs_quality_management'] * 20) / 100) + (($vendor_management['commercial_compliance'] * 25) / 100) ?> Point
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <b>Summary Note :</b>
                    <ol>
                        <li>Supplier have less asset, such as working tools, special tools, etc</li>
                        <li>Team Quantity are still small, only 1 team available to handle the project </li>
                        <li>Have high willingnes to complete job and also do the complete docmentation </li>
                        <li>Compare with other supplier, this supplier are one that can follow project model by shopping list, and agree with term payment model </li>
                    </ol>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <b>Summary Note :</b>
                    <ol>
                        <li>Lacking on proper feedback on administration part, like price compliance, email confirmation</li>
                        <li>If in future, we want to expand more business with them, need to make sure they have proper management team</li>
                    </ol>
                </td>
            </tr>
            <tr>
                <td>
                    <b>Prepared by :</b>
                    <br><br><br><br><br><br>
                    PVM Team
                </td>
                <td>
                    <b>Review & Acknowledge by :</b>
                    <br><br><br><br><br><br>
                    Manager & head (Operation, PMG, HRLVM)
                </td>
            </tr>
        </table>

        <br><br>

        <!-- <table class="tables">
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
            <tr>
                <td>1</td>
                <td> @site_id </td>
                <td> @site_name </td>
                <td> @item_description </td>
                <td> @unit </td>
                <td> @requested_qty </td>
                <td> @due_qty </td>
                <td></td>
                <td></td>
                <td> @note_to_receiver </td>
            </tr>
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
                    Date: <span style="border-bottom:1px solid;padding-left:25px;padding-right:25px;">></span><br />
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
        </p> -->
    </body>
</html>