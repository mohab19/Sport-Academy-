@extends('invoices.master')

@section('style')

@endsection
@section('invoice-table-titles')
    <th class="text-left">Description</th>
@endsection
@section('invoice-table-body')
    <td class="text-left">Pay Debt For Product : {{$debt->income->product->name}}</td>
@endsection