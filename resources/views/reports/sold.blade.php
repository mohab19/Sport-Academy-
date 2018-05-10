@extends('reports.master')
 @section("table-head")
     <th>Product</th>
     <th>Player</th>
     <th>Quantity</th>
     <th>Total</th>
     <th>Discount</th>
     <th>Paid</th>
     <th>Reciver</th>
     <th>Date</th>
 @endsection
 <?php $total_paid = 0; ?>
 <?php $total_total = 0; ?>
 <?php $total_discount = 0; ?>
 @section("table-body")
     @foreach($incomes as $income)
         <?php $total_paid+=$income->value; ?>
         <?php $total_total+=$income->total; ?>
         <?php $total_discount+=$income->discount; ?>
         <tr class="danger">
             <td>
                 <a href="/product/{{$income->product->id}}/{{$income->product->name}}"> {{$income->product->name}}</a>
             </td>
             <td>
                 {{$income->user->name}}
             </td>
             <td>{{$income->quantity}}</td>
             <td>{{$income->total}}</td>
             <td>{{$income->discount}}</td>
             <td>{{$income->value}}</td>
             <td>{{$income->receiver->name}}</td>
             <td>{{$income->date}}</td>
         </tr>
     @endforeach
     <tr class="info">
         <td>Total</td>
         <td></td>
         <td></td>
         <td>{{$total_total}}</td>
         <td>{{$total_discount}}</td>
         <td>{{$total_paid}}</td>
         <td></td>
         <td></td>
     </tr>
 @endsection