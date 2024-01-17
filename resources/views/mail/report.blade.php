<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @include('layouts.css')
</head>
<style>
    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    td, th {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }

    tr:nth-child(even) {
      background-color: #dddddd;
    }
    </style>
<body>
    <div class="">
        <h3 class="">
            <b>รายการที่ขอของคุณ {{ $RequestProduct->first_name  }} {{  $RequestProduct->last_name }}</b>
            <b>วันที่ขอ {{ date('d/m/Y', strtotime('+543 Years', strtotime($RequestProduct->updated_at))) }}</b>
        </h3>

    </div>
    <div class="">
        <div class="">
            @php

                $i=1;
            @endphp
            <table class="table">
                <tr>
                  <th>ลำดับ</th>
                  <th>ประเภท</th>
                  <th>ยี่ห้อ</th>
                  <th>รายการ</th>
                  <th>ราคา</th>
                </tr>
                @if ($mouse)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $mouse->type }}</td>
                    <td>{{ $mouse->brand }}</td>
                    <td >{{ $mouse->name }}</td>
                    <td >{{ number_format($mouse->price) }}
                      <input type="hidden" value="{{ $mouse->price }}" class="price">
                  </td>
                @endif

                  @if ($keyboard)
                  <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $keyboard->type }}</td>
                    <td>{{ $keyboard->brand }}</td>
                    <td >{{ $keyboard->name }}</td>
                    <td >{{ number_format($keyboard->price) }}
                      <input type="hidden" value="{{ $keyboard->price }}" class="price">
                  </td>
                  </tr>
                  @endif

                  @if ($RequestProductMonitor)
                  @foreach ($RequestProductMonitor as $monitor)
                  <tr>
                      <td>{{ $i++ }}</td>
                      <td>{{ $monitor->type }}</td>
                      <td>{{ $monitor->brand }}</td>
                      <td >{{ $monitor->name }}</td>
                      <td >{{ number_format($monitor->price) }}
                        <input type="hidden" value="{{ $monitor->price }}" class="price">
                    </td>
                    </tr>
                  @endforeach
                  @endif

                <tr>
                  <td><b>รวมราคา</b></td>
                  <td colspan="3"></td>
                  <td><b>{{ number_format($total) }}</b></td>
                </tr>
              </table>
        </div>
    </div>
    @include('layouts.script')



</body>
</html>
