@extends('reports.master')
@section("table-head")
    <th>User</th>
    <th>Salary</th>
    <th>Penalty</th>
    <th>Extra</th>
    <th>Net Salary</th>
    <th>Date</th>
@endsection
<?php $total = 0; ?>
@section("table-body")
    @foreach($users as $user)
        <?php $user_penalties =0 ?>
        <?php $user_extras =0 ?>
        @foreach($user->penalties as $penalty)
            <?php $user_penalties+=$penalty->value ?>
            @endforeach
        @foreach($user->extras as $extra)
            <?php $user_extras+=$extra->value ?>
            @endforeach
        <tr class="danger">
        <td></td>
        </tr>
    @endforeach
    <tr class="info">
        <td>Total</td>
        <td></td>
        <td>{{$total}}</td>
        <td></td>
        <td></td>
    </tr>
@endsection