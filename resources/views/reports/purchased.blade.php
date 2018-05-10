 @extends('reports.master')
 @section("table-head")
     <th>Product</th>
     <th>Quantity</th>
     <th>Paid</th>
     <th>Date</th>
 @endsection
    <?php $total = 0; ?>
 @section("table-body")
     @foreach($outcomes as $outcome)
         <?php $total+=$outcome->value; ?>
         <tr class="danger">
             <td>
                 <a href="/product/{{$outcome->product->id}}/{{$outcome->product->name}}"> {{$outcome->product->name}}</a>
             </td>
             <td>{{$outcome->quantity}}</td>
             <td>{{$outcome->value}}</td>
             <td>{{$outcome->date}}</td>
         </tr>
     @endforeach
     <tr class="info">
         <td>Total</td>
         <td></td>
         <td>{{$total}}</td>
         <td></td>
     </tr>
 @endsection