 <table class="table">
            <thead>
            <tr class="info">
                <th>Product</th>
                <th>User</th>
                <th>Debt</th>
                <th>Date</th>
            </tr>
            </thead>
            <tbody>
            <?php $total = 0; ?>
            @foreach($incomes as $income)
                    <?php $total+=$income->debt; ?>
                    <tr class="danger">
                        <td>
                            <a href="/product/{{$income->product->id}}/{{$income->product->name}}"> {{$income->product->name}}</a>
                        </td>
                        <td>
                            {{$income->user->name}}
                        </td>
                        <td>{{$income->debt}}</td>
                        <td>{{$income->date}}</td>
                    </tr>
            @endforeach
            <tr class="info">
                <td>Total</td>
                <td></td>
                <td>{{$total}}</td>
                <td></td>
            </tr>
            </tbody>
        </table>