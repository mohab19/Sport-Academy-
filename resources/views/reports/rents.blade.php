@extends('reports.master')
 @section("table-head")
     <th>Place Name</th>
     <th>Rent Value</th>
     <th>Date</th>
 @endsection
 <?php $total = 0; ?>
 @section("table-body")
     @foreach($outcomes as $outcome)
         <?php $total+=$outcome->value; ?>
         <tr class="danger">
             <td>{{$outcome->place->name}}</td>
             <td>{{$outcome->value}}</td>
             <td>{{date('F',strtotime($outcome->date))}} {{date('Y',strtotime($outcome->date))}}</td>
         </tr>
     @endforeach
     <tr class="info">
         <td>Total</td>
         <td>{{$total}}</td>
         <td></td>
     </tr>
 @endsection