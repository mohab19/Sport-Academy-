@extends('invoices.master')
@section('invoice-table-titles')
    <th>Description</th>
    <th>Start Date</th>
    <th>End Date</th>
    <th>Total</th>
@endsection
@section('invoice-table-body')
    <td>Add New Subscription</td>
    <td>{{$income->subscription->start}}</td>
    <td>{{$income->subscription->end}}</td>
    <td>{{$total}}</td>
@endsection