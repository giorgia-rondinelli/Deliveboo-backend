@extends('layouts.admin')

@section('content')
    <div class="mt-4 ms-4">

        <div>
            <h1>Da {{$allDate[0]}} a {{$allDate[11]}}</h1>
        </div>

        <div class="d-flex">
            <div class="w-75">
                <canvas id="myChart" style="width:100%"></canvas>
            </div>

            <div>
                <h3>Last 10 orders:</h3>
                <table class="table" style="width:600px">
                    <thead>
                      <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Date</th>
                        <th scope="col">Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($lastOrders as $order)
                        <tr>
                            <th scope="row">{{$order->name}}</th>
                            <td>{{$order->formatted_created_at}}</td>
                            <td>&euro;{{$order->total_price}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
      const xValues = <?php echo json_encode($allDate); ?>;
      const yValues = <?php echo json_encode($totOrdersMonth); ?>;
      const yValuesPlus = <?php echo json_encode($totRevenueMonth); ?>;

      new Chart("myChart", {
        type: "line",
        data: {
          labels: xValues,
          datasets: [{
            fill: false,
            lineTension: 0,
            backgroundColor: "rgba(0,0,255,1.0)",
            borderColor: "rgba(0,0,255,0.1)",
            data: yValues,
            pointHitRadius: 50,
            pointRadius: 5
          }]
        },
        options: {
          legend: {display: false},
          scales: {
            yAxes: [{
              ticks: {
                min: 0,
                max: Math.max(...yValues) + 5
              }
            }]
          },
          tooltips: {
            callbacks: {
              title: function(tooltipItems, data) {
                return 'Month: ' + tooltipItems[0].xLabel;
              },
              label: function(tooltipItem, data) {
                  let info = yValuesPlus[tooltipItem.index];
                let label = 'Orders: ' + tooltipItem.yLabel + ' - Sales: €' + info;
                return [label];
              }
            }
          }
        }
      });
    });
</script>
