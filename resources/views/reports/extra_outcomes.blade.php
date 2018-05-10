@extends('reports.master')
 @section("table-head")
     <th>Description</th>
     <th>Paid</th>
     <th>Reciver</th>
     <th>Date</th>
 @endsection
 <?php $total_paid = 0; ?>
 @section("table-body")
     @foreach($outcomes as $outcome)
         <?php $total_paid+=$outcome->value; ?>
         <tr class="danger">
             <td>{{$outcome->title}}</td>
             <td>{{$outcome->value}}</td>
             <td>{{$outcome->user->name}}</td>
             <td>{{$outcome->date}}</td>
         </tr>
     @endforeach
     <tr class="info">
         <td>Total</td>
         <td>{{$total_paid}}</td>
         <td></td>
         <td></td>
     </tr>
 @endsection