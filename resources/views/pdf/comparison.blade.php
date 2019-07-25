<html>
<head>
  <title>Comparison Print</title>
</head>
<body>
<style type="text/css">

body {
    color: #333;
    font-size: 9px;
}

table {
    width: 100%;
    border-collapse: collapse;
    font-size: 9px;
}

p {
    font-size: 12px;
}

.custom-table {
    width: 100%;
}

.custom-table .grey {
    background-color: #e1e1e1;
}

.custom-table tr > th, .custom-table tr > td {
    border: 1px solid #ccc;
    box-shadow: none;
    padding: 5px;
}

.text-center {
    text-align: center;
}

.text-right {
    text-align: right;
}

.text-left {
    text-align: left;
}

.top-table {
    margin-bottom: 10px;
}

.top-table tr > td {
    padding: 3px 10px;
}

.img-small {
    width: 100px;
}

.title {
    background-color: #e1e1e1;
    font-weight: 600;
    padding: 5px;
    margin-bottom: 10px;
}

.box {
    border: 1px solid #333;
    padding: 0px 5px;
    margin: 5px;
}

.custom-table-again-whatever td, .custom-table-again-whatever th {
    padding: 5px;
}

    .page-break { display: block; page-break-after: always; }
</style>
    <div style="margin-bottom: 10px">
        <table class="custom-table-again-whatever">
            <tr>
                <td rowspan="2" style="width: 100px"><img src="{{ url('assets/images/logo-pdf.png') }}" style="width: 100px"></td>
                <th class="text-left">Dept Name:</th>
            </tr>
            <tr>
                <th class="text-left">User Name:</th>
            </tr>
        </table>
    </div>

    <div class="margin:bottom: 10px;">
        <table class="custom-table-again-whatever">
            <tr>
                <th colspan="2" class="text-left" style="width: 100px">Nama Barang :</th>
            </tr>
            @php ($i = 1)
            @foreach ($compares as $compare)
            <tr>
                <td style="width: 100px;"></td>
                <td>{{ $i.'. '. $compare['name'] }}</td>
            </tr>
            @php($i++)
            @endforeach
        </table>
    </div>

    <div style="width: 50%; display:inline-block">
        <div class="title" style="margin-right:10px">CATEGORY</div>
        <div style="padding: 0px 10px; margin-bottom: 20px">
            <table class="custom-table-again-whatever">
                <tr>
                    <td style="width: 50px; vertical-align:top" rowspan="10">Category :</td>
                    <th>A. REGULAR</th>
                    <th>B. IRREGULAR</th>
                </tr>
                <tr>
                    <td>1. <span class="box"></span> PRD Consumable</td>
                    <td>1. <span class="box"></span> Repair Maintenance Part / Service </td>
                </tr>

                <tr>
                    <td>2. <span class="box"></span> Chemicals</td>
                    <td>2. <span class="box"></span> Equipment / Machine </td>
                </tr>

                <tr>
                    <td>3. <span class="box"></span> Employee's Consumables</td>
                    <td>3. <span class="box"></span> Service </td>
                </tr>

                <tr>
                    <td>4. <span class="box"></span> Repair Mantenance Part / Service</td>
                    <td>4. <span class="box"></span> IT Need</td>
                </tr>

                <tr>
                    <td>5. <span class="box"></span> Service</td>
                    <td>5. <span class="box"></span> Office Equipment & Stationary</td>
                </tr>

                <tr>
                    <td>6. <span class="box"></span> IT Need</td>
                    <td>6. <span class="box"></span> General Supply</td>
                </tr>

                <tr>
                    <td>7. <span class="box"></span> Office Equipment & Stationary</td>
                    <td></td>
                </tr>

                <tr>
                    <td>Notes :</td>
                    <td>Notes :</td>
                </tr>

                <tr>
                    <td style="vertical-align:top">
                        1. Semua barang item stock harus mengisi  :	<br>		
                            item dibawah ini (terdapat di Form PR) : <br>		
                                - Stock			<br>
                                - Min Stock			<br>
                                - Used / month			<br>
                        2. Harga untuk regular order 		<br>	
                                menggunakan harga periodik		<br>	
                                (3 bulan, 6 bulan, 1 thn)			<br>

                    </td>
                    <td style="vertical-align:top">
                        Harga untuk irregular order menggunakan	<br>
                        compare min 2 source, kecuali untuk 	<br>
                        harga dibawah ini :	<br>
                        1. Unit Price (< IDR 100.000)	<br>
                        2. Total Price (< IDR 5.000.000)	<br>
                        boleh menggunakan 1 source.	<br>
                    </td>
                </tr>

            </table>
        </div>
        <div>
            <p>Semua permintaan pembelian barang harus melampirkan data lengkap :</p>
            <table class="custom-table-again-whatever">
                <tr>
                    <td><span class="box"></span>Barang</td>
                    <td><span class="box"></span>Drawing</td>
                    <td><span class="box"></span>Foto + Spec</td>
                </tr>
                <tr>
                    <td><span class="box"></span>Service</td>
                    <td><span class="box"></span>Scope of work</td>
                    <td><span class="box"></span>Foto area kerja / kondisi sekarang</td>
                </tr>
            </table>
            <p>*Fill <span class="box"></span> for the selected item</p>
        </div>
        <div>
            <table class="custom-table" style="width: 80%">
                <tr>
                    <th colspan="2">User Department</th>
                    <th>FAC Dept. Head</th>
                </tr>
                <tr>
                    <td style="height: 80px"></td>
                    <td style="height: 80px"></td>
                    <td style="height: 80px"></td>
                </tr>
                <tr>
                    <th class="text-center">SPV</th>
                    <th class="text-center">Dept. Head</th>
                    <th class="text-center">Komang Yoga</th>
                </tr>
                <tr>
                    <td>Date</td>
                    <td>Date</td>
                    <td>Date</td>
                </tr>
            </table>
        </div>
    </div>
    <div style="width: 50%; display:inline-block; float: right">
        <div class="title">REVIEW ORDER</div>
        <table class="custom-table">
            <thead>
                <tr>
                    <th rowspan="2" style="vertical-align:middle; text-align:center; width: 200px">Aspect</th>
                    <th colspan="{{ count($compares) }}" class="text-center">Supplier Candidat</th>
                </tr>
                <tr>
                    @foreach ($compares as $compare)
                        <td class="text-center">{{ $compare['supplier'] }} <a href="{{ url('catalog/compare/remove/'.$compare['id']) }}" class="btn btn-danger btn-sm btn-link text-danger float-right"><i class="fas fa-times"></i></a></td>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1. Specification</td>
                    @foreach ($compares as $compare)
                    <td>{{ $compare['specification'] }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td>2. Price</td>
                    @foreach ($compares as $compare)
                    <td class="text-right">Rp. {{ number_format($compare['price']) }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td>3. Lead Times</td>
                    @foreach ($compares as $compare)
                    <td>{{ $compare['lead_times'] }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td>4. After Sales</td>
                    @foreach ($compares as $compare)
                    <td></td>
                    @endforeach
                </tr>
                <tr>
                    <td>&nbsp; &nbsp; 4.1 Guarantee</td>
                    @foreach ($compares as $compare)
                    <td>{{ $compare['guarantee'] }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td>&nbsp; &nbsp; 4.1 Technical Support</td>
                    @foreach ($compares as $compare)
                    <td>{{ $compare['technical_support'] }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td>&nbsp; &nbsp; 4.1 Others</td>
                    @foreach ($compares as $compare)
                    <td>{{ $compare['other'] }}</td>
                    @endforeach
                </tr>
                <tr class="grey">
                    <td style="text-center"><strong>Judge</strong></td>
                    @foreach ($compares as $compare)
                    <td></td>
                    @endforeach
                </tr>
            </tbody>
        </table>
        <p style="font-size: 9px">
        *) Jika Total Amount PO < 10 Juta TTD sampai dengan MGR Level	<br>	
            &nbsp; &nbsp; Jika Total Amount PO > 10 Juta TTD sampai dengan BOD Level		

        </p>

        <div>
            <table class="custom-table" style="width: 80%; margin-top: 130px">
                    <tr>
                        <th>Prepared By</th>
                        <th>Checked By</th>
                        <th>Approved By</th>
                    </tr>
                    <tr>
                        <td style="height: 80px"></td>
                        <td style="height: 80px"></td>
                        <td style="height: 80px"></td>
                    </tr>
                    <tr>
                        <th class="text-center">Ahmad Mukromin</th>
                        <th class="text-center">Irawan H. R</th>
                        <th class="text-center">Herlina Trisnawati</th>
                    </tr>
                    <tr>
                        <td>Date</td>
                        <td>Date</td>
                        <td>Date</td>
                    </tr>
                </table>
        </div>
    </div>
</html>