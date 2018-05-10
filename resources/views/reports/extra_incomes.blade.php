@extends('reports.master')
 @section("table-head")
     <th>Description</th>
     <th>Client</th>
     <th>Paid</th>
     <th>Reciver</th>
     <th>Date</th>
 @endsection
 <?php $total_paid = 0; ?>
 @section("table-body")
     @foreach($incomes as $income)
         <?php $total_paid+=$income->value; ?>
         <tr class="danger">
             <td>{{$income->title}}</td>
             @if($income->user)
             <td>
                 {{$income->user->name}}
             </td>
             @else
                 <td>{{$income->client_name}}</td>
             @endif
             <td>{{$income->value}}</td>
             <td>{{$income->receiver->name}}</td>
             <td>{{$income->date}}</td>
         </tr>
     @endforeach
     <tr class="info">
         <td>Total</td>
         <td></td>
         <td>{{$total_paid}}</td>
         <td></td>
         <td></td>
     </tr>
 @endsection