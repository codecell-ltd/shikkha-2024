<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print All PDF</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .fixed-width {
            max-width: 1080px;
            margin: auto;
            border: 2px solid black;
        }

        .clear::after {
            content: '';
            clear: both;
            display: block;
        }

        .left {
            float: left;
        }

        .right {
            float: right;
        }

        .center {
            float: center;
        }

        .left img {
            width: 60px;
        }

        /* img{
            max-width: 100%;
        } */
        a {
            text-decoration: none;
        }

        .mid-content {
            max-width: 1100px;
            margin: auto;
        }

        body h1 h2 h3 h4 h5 h6 p span {
            font-family: 'Work Sans', sans-serif;
        }

        .text-center {
            text-align: center;
        }

        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: left;
        }

        .header-left {
            width: 35%;
            display: block;
        }

        .header-right {
            width: 65%;
            margin-left: -140px;
        }

        .header-bottom-left {
            width: 50%;
            display: block;
        }

        .header-bottom-right {
            width: 50%;
            display: block;
        }

        .bottom-left {
            width: 48%;
            display: block;
        }

        .bottom-right {
            width: 48%;
            display: block;
        }

        .mark-left {
            width: 35%;
            float: left;
            padding-right: 10px;
            display: block;
        }

        .mark-right {
            width: 52%;
            float: right;
            display: block;
            padding-right: 22px
        }

        .bordered-table {
            border-collapse: collapse;
        }

        .bordered-table th,
        .bordered-table td {
            border: 1px solid black;
            padding: 12px;
            text-align: center;
        }

        .bottom {
            padding-top: 30px;
        }

        .button {
            background-color: #7900a7;
            /* Green */
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-bottom: 15px;
            cursor: pointer;
        }

        .page-break {
            page-break-after: always;
        }

        section{
            height: 100vh;
        }

        @media print {
            .print-button {
                visibility: hidden;
            }

            .section-to-print {
                visibility: visible;
                position: absolute;
                left: 0;
                top: 0;
            }
        }
    </style>
</head>
<body>
    <div class="text-center print-button" style="margin-top:20px">
        <h6> Total students: <span id="totalStudent">0</span></h6>
            <button class="button" onclick="printDiv()">Print All</button>
        <h6> We are preparing your result: <span id="printing">0</span> </h6>
    </div>
    <main class="page-content">
        <div class="row">
            <div class="col-xl mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="border p-3 rounded" style="overflow-x:auto;">
                            
                            <div id="printDiv"></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <div class="text-center" style="margin-top:20px">
        <button class="button" onclick="printDiv()">Print All</button>
    </div>
    <script>

        async function fetchData(studentUrl){
            const response = await fetch(studentUrl)
            const data = await response.text()
            return data
        }
        
        async function processUrls(studentUrls){
            for (let i = 1; i <= studentUrls.length; i++) {
                const data = await fetchData(studentUrls[i-1])
                document.getElementById('printing').textContent = i
                document.getElementById('printDiv').innerHTML += data
            }
        }
        
        let final_wise_class_id = "{{ $final_wise_class_id }}"
        let term_id = JSON.parse('{!! json_encode($term_id) !!}')
            term_id = Object.values(term_id)
        
        let students = JSON.parse('{!! json_encode($students_id) !!}')
            students = Object.values(students)
        
            document.getElementById('totalStudent').textContent = students.length
        
        let studentUrls = []
            for (let i = 1; i <= students.length; i++) {
                studentUrls.push("{{ url('/get-all-students-results') }}" + `/${final_wise_class_id}/${students[i-1]}/${JSON.stringify(term_id)}`)
            }

        onload = () => processUrls(studentUrls)

        function printDiv(printDiv) {
            var printContents = document.getElementById('printDiv').innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>
</body>
</html>