<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Campaign participants</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body>
    <?php
    $count = 0;
    ?>
    <h3>Delivery for {{ $campaign->campaign_name }}</h3>
    <h5>Dispatch date: {{ $campaign->dispatch_date }}</h5>
    <table class="table table-bordered">
        <thead style="background-color: #9653bd; color:white">
            <tr>
                <td>No.</td>
                <td>Name</td>
                <td>Phone Number</td>
                <td>Address</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($campaign_users as $cuser)
            @foreach ($users as $user)
            @if ($cuser->user_id == $user->id)
            <?php
            $count = $count + 1;
            ?>
            <tr>
                <td>{{ $count }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->phone_number }}</td>
                <td>{{ $user->address }}</td>
            </tr>
            @endif
            @endforeach
            @endforeach
        </tbody>
    </table>
</body>

</html>
