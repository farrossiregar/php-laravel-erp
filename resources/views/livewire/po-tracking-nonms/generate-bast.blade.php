<html>
    <head>
        <title>{{$data->no_tt}}</title>
        <style>
            * {
                font-size:14px;
            }
            .page_break { page-break-before: always; }
            table.border {
                width:100%;
            }
            table.border tr th,table.border tr td{
                border: 1px solid #000;
            }
        </style>
    </head>
    <body>
        <div style="text-align: center;">
            <p><b>THE FIRST HAND OVER CERTIFICATE<br />(BERITA ACARA SERAH TERIMA)</b></p>
        </div>
        <table>
            <tr>
                <td style="width:100px;">Works</td>
                <td>: {{ $data->pekerjaan }}</td>
            </tr>
            <tr>
                <td>Region</td><td>:{{ $data->region }} </td>
            </tr>
            <tr>
                <td>Project</td><td>: Indosat Managed Services-Field Maintenance Service</td>
            </tr>
        </table>
        <hr style="margin-bottom:3px;padding-bottom:0;" />
        <hr style="margin-top:0;padding-top:0;height:4px;background:black;" />
        <p style="text-align:center">Number: <b> 310/I/HUP/2021</b></p>
        <p>On the date _________________________, we the undersigned:</p>
        <ol>
            <li>
                <table>
                    <tr>
                        <td>Name</td>
                        <td> : Dicky Firdaus</td>
                    </tr>
                    <tr>
                        <td>Title</td>
                        <td> : REGIONAL PROJECT MANAGER </td>
                    </tr>
                    <tr>
                        <td colspan="2">On the matter acting for and behalf of PT HARAPAN UTAMA PRIMA (hereinafter “Vendor”); and</td>
                    </tr>
                </table>
            </li>
            <li>
                <table>
                    <tr>
                        <td>Name</td>
                        <td> : Deni Sopiana</td>
                    </tr>
                    <tr>
                        <td>Title</td>
                        <td> : REGIONAL PROJECT MANAGER </td>
                    </tr>
                    <tr>
                        <td colspan="2">On the matter acting for and behalf of PT. ERICSSON INDONESIA (hereinafter referred to as “Ericsson”)</td>
                    </tr>
                </table>
            </li>
        </ol>
        <p>By virtue of:</p>
        <ol>
            <li>Supply Agreement No : MA-2020-01996 dated 23 June 2020</li>
            <li>PO No : <?php echo $data->po_no; ?> dated <?php echo date_format( $data->created_at, 'd M Y'); ?> </li>
        </ol>
        <p>Harapan Utama Prima and Ericsson hereby stated the followings:</p>
        <ol>
            <li><b>PT Harapan Utama Prima</b> has transferred the works and the title thereof to Ericsson at the Location in accordance with Purchase Order referred to above:</li>
            <li>
                <b>Ericsson</b> has accepted the works and the title thereof satisfactorily, provided that :
                <ol style="list-style-type: lower-alpha;">
                    <li>Completion of the works <b>Rectification Lamp 10 Site CJN & CJS Area.</b></li>
                    <li>The works has been functioning properly in accordance with the condition of the above referred Supply Agreement and/or Purchase Order, The First Hand Over Certificate (or Berita Acara Serah Terima or “BAST”) will be issued accordingly by Ericsson</li>
                    <li>There is/ There is no additional/ subtraction of works as basis of Amendment of the Purchase Order</li>
                    <li>d.	Attached to this BAST are all required supporting documents for this project as agreed with Ericsson Project Manager, such as (but not limited to):Foto Evidence, Purchase Order (PO), Total project cost (actual implemented/PO value revised):IDR.<b>10,700,828,-</b>         (see attachment)</li>
                </ol>
            </li>
        </ol>
        <p>This certificate is made in one original bearing sufficient stamp duties which shall have the same legal powers after being signed by their respective duly representatives.</p>
        <br />
        <br />
        <table style="width:100%;">
            <tr>
                
                @if($data->type_doc == 1)
                <th style="text-align:left;width:60%;">PT Solusi Tunas Pratama</th>
                @endif

                @if($data->type_doc == 2)
                <th style="text-align:left;width:60%;">PT Ericsson Indonesia</th>
                @endif

                <th style="text-align:left;width:40%;">PT Harapan Utama Prima</th>
            </tr>
        </table>
        <br />
        <br />
        <br />
        <table style="width:100%;">
            <tr>
                <th style="text-align:left;width:60%;">
                    Deni Sopiana<br />
                    REGIONAL PROJECT MANAGER
                </th>
                <th style="text-align:left;width:40%;">
                    Dicky Firdaus. R<br />
                    REGIONAL PROJECT MANAGER
                </th>
            </tr>
        </table>
        <div class="page_break"></div>
        <p style="text-align:center;">
            <b>The First Hand-Over Certificate Attachment</b><br />
            Number : _____________
        </p>
        <table>
            <tr>
                <td style="width:100px;">Works</td>
                <td>: {{ $data->pekerjaan }}</td>
            </tr>
            <tr>
                <td>Region</td><td>: {{ $data->region }}</td>
            </tr>
            <tr>
                <td>Project</td><td>: Indosat Managed Services-Field Maintenance Service</td>
            </tr>
        </table>
        <hr style="margin-bottom:3px;padding-bottom:0;" />
        <hr style="margin-top:0;padding-top:0;height:4px;background:black;" />
        <table class="border">
            <tr>
                <th>Site ID</th>
                <th>Site Name</th>
                <th>Description</th>
                <th>QTY</th>
                <th>PO#</th>
                <th>Value as per PO</th>
                <th>Implemented Value</th>
            </tr>
            @if($data->type_doc==1)
                @foreach(\App\Models\PoTrackingNonmsStp::where('id_po_nonms_master',$data->id)->get() as $item)
                <tr>
                    <td>{{$data->site_id}}</td>
                    <td>{{$item->site_name}}</td>
                    <td>{{$item->item_description}}</td>
                    <td style="text-align:center">{{$item->qty}}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                @endforeach
            @else
                @foreach(\App\Models\PoTrackingNonmsBoq::where('id_po_nonms_master',$data->id)->get() as $item)
                <tr>
                    <td>{{$item->site_id}}</td>
                    <td>{{$item->site_name}}</td>
                    <td>{{$item->item_description}}</td>
                    <td style="text-align:center">{{$item->qty}}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                @endforeach
            @endif
        </table>
        <p>Note: This attachment is to be completed prior to signing/approval of ‘First Hand-Over Certificate (BAST)’. Necessary administrative supporting documentation is to be completed and included as well. For change of Purchase Order (PO) value detailed calculations based on SoW/BoQ changes are to be attached (and listed under “Reference”).</p>
        <table style="width:100%;">
            <tr>
                @if($data->type_doc == 1)
                <th style="text-align:left;width:60%;">PT Solusi Tunas Pratama</th>
                @endif

                @if($data->type_doc == 2)
                <th style="text-align:left;width:60%;">PT Ericsson Indonesia</th>
                @endif

                <th style="text-align:left;width:40%;">PT Harapan Utama Prima</th>
            </tr>
        </table>
        <br />
        <br />
        <br />
        <table style="width:100%;">
            <tr>
                <th style="text-align:left;width:60%;">
                    Deni Sopiana<br />
                    REGIONAL PROJECT MANAGER
                </th>
                <th style="text-align:left;width:40%;">
                    Dicky Firdaus. R<br />
                    REGIONAL PROJECT MANAGER
                </th>
            </tr>
        </table>
        <div class="page_break"></div>
        <table style="border:1p solid #000;width:100%;">
            <tr>
                <td style="width:50%;">Project</td>
                <td> : </td>
            </tr>
            <tr>
                <td>PO Number</td>
                <td> : {{ $data->po_no }}</td>
            </tr>
            <tr>
                <td>Cluster Area</td>
                <td> : </td>
            </tr>
            <tr>
                <td>Site ID Name</td>
                <td> : </td>
            </tr>
            <tr>
                <td>Scope of Works</td>
                <td> : {{$data->pekerjaan}}</td>
            </tr>
        </table>
        <br />
        <br />
        @php($enter=0)
        @php($enter2=0)
        @foreach(\App\Models\PoTrackingNonmsBast::where('po_tracking_nonms_id',$data->id)->get() as $item)
            <div style="border:1px solid #000;padding:10px;float:left;width:30%;margin-right:10px;">
                <img src="{{asset($item->image)}}" style="width:100%;" />
                <div style="margin-top:10px; margin-left:-10px;margin-right:-10px;border-top:1px solid #000;text-align:center;">
                    {!!$item->description!!}
                </div>
            </div>
            @if($enter2==9)
                @php($enter2=0)
                <br style="clear:both">
                <div class="page_break"></div>
                <br style="clear:both">

            @endif 
            @if($enter==3) 
                <br style="clear:both">
                <br style="clear:both">
                <br style="clear:both">
                @php($enter=0)
            @endif
            @php($enter++)
            @php($enter2++)
        @endforeach
        </br>
    </body>
</html>