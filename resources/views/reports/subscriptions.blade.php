@extends('reports.master')
@section("table-head")
                <th>Player</th>
                <th>From</th>
                <th>To</th>
                <th>Total</th>
                <th>Paid</th>
                <th>Reciver</th>
                <th>Date</th>
                @endsection
            <?php $total = 0; ?>
@section("table-body")
    @foreach($incomes as $income)
        <?php $total+=$income->value; ?>
        <tr class="danger">
                        <td>
                            <a href="/player/{{$income->player->id}}/{{$income->player->user->name}}"> {{$income->player->user->name}}</a>
                        </td>
                        <td>{{$income->subscription->start}}</td>
                        <td>{{$income->subscription->end}}</td>
                        <td>{{$income->subscription->total}}</td>
                        <td>{{$income->subscription->paid}}</td>
                        <td>{{$income->receiver->name}}</td>
                        <td>{{$income->date}}</td>
        </tr>
            @endforeach
            <tr class="info">
                <td>Total</td>
                <td></td>
                <td></td>
                <td></td>
                <td>{{$total}}</td>
                <td></td>
                <td></td>
            </tr>
                @endsection