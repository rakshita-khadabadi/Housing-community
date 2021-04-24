@extends('city-view.app') 

@section('title', 'Building Manager Page') 

@section('content')

<div>
    <div class="left-panel">

        <div class="logo-and-menu">
            <div class="menu-bar">
                <a href="javascript:void(0);" id="menu-icon" onclick="menuFunction()">
                    <div class="menu-icon">
                        <i class="menu-size fas fa-bars"></i>
                    </div>
                </a>
            </div>
            <div id="logo" class="logo">
                <h1>&nbsp; &nbsp; City View
                    <?php $userId; ?>
                </h1>
            </div>

        </div>

        <div id="sidebar" class="sidebar">
            <button class="sidebar-menu-option sidebar-option text-left opacity active" onclick="myFunction(event, 'personal-details')">Personal Details</button>

            <button class="sidebar-menu-option sidebar-option text-left opacity" onclick="openMenu(event, 'apartment-dashboard-menu')">Dashboard<div class="dropdown-icon"><i class="fas fa-caret-down"></i></div></button>
            <div id="apartment-dashboard-menu" class="apartment-dashboard-menu">
                <!-- <button class="sidebar-option text-left opacity" onclick="myFunction(event, 'dashboard-home')">Home</button> -->
                <button class="sidebar-option text-left opacity" onclick="myFunction(event, 'dashboard-electricity-bill')">Electricity Bill</button>
                <button class="sidebar-option text-left opacity" onclick="myFunction(event, 'dashboard-water-bill')">Water Bill</button>
                <button class="sidebar-option text-left opacity" onclick="myFunction(event, 'dashboard-gas-bill')">Gas
                    Bill</button>
                <!-- <button class="sidebar-option text-left opacity" onclick="myFunction(event, 'dashboard-maintenance-requests')">Maintenance Requests</button>
                    <button class="sidebar-option text-left opacity" onclick="myFunction(event, 'dashboard-complaints')">Complaints</button> -->
            </div>

            <a href="#apartment-details"><button class="sidebar-menu-option sidebar-option text-left opacity" onclick="myFunction(event, 'apartment-details')">Apartment Details</button></a>

            <button class="sidebar-menu-option text-left opacity" onclick="openMenu(event, 'building-report-menu')">Reports<div class="dropdown-icon"><i class="fas fa-caret-down"></i></div></button>
            <div id="building-report-menu" class="building-report-menu">
                <a href="#utility-bill-report"><button class="sidebar-option text-left opacity" onclick="myFunction(event, 'utility-bill-report')">Utility Bill Report</button></a>
                <a href="#community-service-bill-report"><button class="sidebar-option text-left opacity" onclick="myFunction(event, 'community-service-bill-report')">Community Service Bill
                        Report</button></a>
                <a href="#maintenance-request-report"><button class="sidebar-option text-left opacity" onclick="myFunction(event, 'maintenance-request-report')">Maintenance Request
                        Report</button></a>
                <a href="#complaint-report"><button class="sidebar-option text-left opacity" onclick="myFunction(event, 'complaint-report')">Complaint Report</button></a>
            </div>

            <button class="sidebar-menu-option text-left opacity" onclick="openMenu(event, 'building-manager-chat-menu')">Chat<div class="dropdown-icon"><i class="fas fa-caret-down"></i></div></button>
            <div id="building-manager-chat-menu" class="building-manager-chat-menu">
                <a href="#apartment-owner-chat"><button class="building-manager-chat-menu-option sidebar-option text-left opacity" onclick="myFunction(event, 'apartment-owner-chat')">Apartment Owner</button></a>
                <a href="#subdivision-manager-chat"><button class="building-manager-chat-menu-option sidebar-option text-left opacity" onclick="myFunction(event, 'subdivision-manager-chat')">Subdivision Manager</button></a>
            </div>

            <a href="#manage-maintenance-requests"><button class="apartment-maintenance-request-menu-option sidebar-option text-left opacity" onclick="myFunction(event, 'manage-maintenance-requests')">View Maintenance Requests</button></a>

            <a href="#manage-complaints"><button class="sidebar-menu-option sidebar-option text-left opacity" onclick="myFunction(event, 'manage-complaints')">View Complaints</button></a>

            <a href="../../index.php">
                <button class="admin-option text-left opacity" onclick="myFunction(event, 'sign-out')">Sign out</button>
            </a>
        </div>
    </div>


    <div class="main-content">

        <div class="page-heading">
            <h1>Building Manager</h1>
        </div>

        <div id="personal-details" class="show-initial section-content">
            <div class="section-heading">
                <h1>Personal Details</h1>
            </div>
            <div class="apartment-personal-details-table-position">
                <div class="apartment-personal-details-table">
                    <table>

                        <tr>
                            <td>User ID</td>
                            <td><?php echo $user->id  ?></td>
                        </tr>
                        <tr>
                            <td>First Name</td>
                            <td><?php echo $user->first_name  ?></td>
                        </tr>
                        <tr>
                            <td>Last Name</td>
                            <td><?php echo $user->last_name  ?></td>
                        </tr>
                        <tr>
                            <td>Email Id</td>
                            <td><?php echo $user->email_id  ?></td>
                        </tr>
                        <tr>
                            <td>Phone Number</td>
                            <td><?php echo $user->phone_number  ?></td>
                        </tr>
                        <tr>
                            <td>Joining Date</td>
                            <td><?php echo $user->joining_datetime  ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="apartment-personal-details-table-position section-content">
            <div class="apartment-personal-details-table">
                <table>

                    <tr>
                        <td>User ID</td>
                        <td>
                            <?php echo $user->id; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>First Name</td>
                        <td>
                            <?php echo $user->first_name; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Last Name</td>
                        <td>
                            <?php echo $user->last_name; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Email Id</td>
                        <td>
                            <?php echo $user->email_id; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Phone Number</td>
                        <td>
                            <?php echo $user->phone_number; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Joining Date</td>
                        <td>
                            <?php echo $user->joining_datetime; ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>


        <div class="edit-button-position section-content">
            <button class="edit-button">Edit</button>
        </div>

        <div id="dashboard-electricity-bill" class="section-content">
            <div class="section-heading">
                <h1>Electricity Dashboard</h1>
            </div>

            <div>
                <canvas id="electricity-chart"></canvas>
            </div>

            <script>
                let eChart = document.getElementById('electricity-chart').getContext('2d');
                let eDashboard = new Chart(eChart, {
                    type: 'bar'
                    , data: {
                        labels: <?php echo $electricityBill->eJson; ?> 
                        , datasets : [{
                            label: 'Total Electricty Bill of Buildings/Month'
                            , data: <?php echo $electricityBill->billJson; ?> 
                            , backgroundColor : '#bbb'
                        }]
                    }
                });

            </script>

        </div>

        <div id="dashboard-gas-bill" class="section-content">
            <div class="section-heading">
                <h1>Gas Dashboard</h1>
            </div>
            <div>
                <canvas id="gas-chart"></canvas>
            </div>

            <script>
                let gasChart = document.getElementById('gas-chart').getContext('2d');

                let gasDashboard = new Chart(gasChart, {
                    type: 'bar'
                    , data: {
                        labels: <?php echo $gasBill->eJson; ?> 
                        , datasets : [{
                            label: 'Total Gas Bill of Subdivision/Month'
                            , data: <?php echo $gasBill->billJson; ?> 
                            , backgroundColor : 'red'
                        }]
                    }
                });

            </script>

        </div>

        <div id="dashboard-water-bill" class="section-content">
            <div class="section-heading">
                <h1>Water Dashboard</h1>
            </div>

            <div>
                <canvas id="water-chart"></canvas>
            </div>

            <script>
                let waterChart = document.getElementById('water-chart').getContext('2d');
                // let polo = JSON.stringify(<?php $ebilljson; ?>);

                let waterDashboard = new Chart(waterChart, {
                    type: 'bar'
                    , data: {
                        labels: <?php echo $waterBill->eJson; ?> 
                        , datasets : [{
                            label: 'Total Water Bill of Subdivision/Month'
                            , data: <?php echo $waterBill->billJson; ?> 
                            , backgroundColor : 'blue'
                        }]
                    }
                });

            </script>

        </div>

        <div id="apartment-details" class="section-content">
            <div class="section-heading">
                <h1>Apartment Details</h1>
            </div>
            <h3>Apartment List</h3>
            <div>

                <div class="view-data-list">
                    @foreach ($apartments as $apt)
                    <a href="#apartment-owner-detail-1">
                        <?php $json = json_encode($apt); ?>
                        <button class="apartment-owner-detail-tile" onclick='viewApartmentDetails(event,"apartment-owner-detail-1" , JSON.stringify(<?php echo $json; ?>))'>
                            Apartment Number: {{ $apt->apartment_number }} <br />
                        </button>
                    </a>
                    @endforeach

                </div>
                <div class="view-data">
                    <div id="apartment-owner-detail-1" class="apartment-owner-detail">
                        <div class="apartment-personal-details-table">
                            <table>
                                <tr>
                                    <td>Apartment Number</td>
                                    <td id="aptNum"></td>
                                </tr>
                                <tr>
                                    <td>First Name</td>
                                    <td id="firstName"></td>
                                </tr>
                                <tr>
                                    <td>Last Name</td>
                                    <td id="lastName"></td>
                                </tr>
                                <tr>
                                    <td>Email Id</td>
                                    <td id="emailId"></td>
                                </tr>
                                <tr>
                                    <td>Phone Number</td>
                                    <td id="phoneNum"></td>
                                </tr>
                                <tr>
                                    <td>Joining Date</td>
                                    <td id="joinDate"></td>
                                </tr>
                            </table>
                        </div>
                    </div>


                </div>
            </div>
        </div>


        <div id="utility-bill-report" class="section-content">
            <div class="section-heading">
                <h1>Utility Bill Report</h1>
            </div>

            <div>
                <h2></h2>
            </div>

            <div class="apartment-owner-bill-table-position total-bill">
                <div class="apartment-owner-bill-table">
                    <table>
                        <tr>
                            <th>Apartment Number</th>
                            <th>Utility Name</th>
                            <th>Cost</th>
                            <th>Service Provider</th>
                        </tr>

                        @foreach ($utils as $u)

                        <tr>
                            <td> {{$u->apartment_number}} </td>
                            <td>{{$u->utility_name}}</td>
                            <td>{{$u->bill_amount}}</td>
                            <td>{{$u->service_provider_type}}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

        <div id="community-service-bill-report" class="section-content">
            <div class="section-heading">
                <h1>Community Service Bill Report</h1>
            </div>

            <div>
                <h2></h2>
            </div>

            <div class="apartment-owner-bill-table-position total-bill">
                <div class="apartment-owner-bill-table">
                    <table>
                        <tr>
                            <th>Apartment Number</th>
                            <th>Maintenance Fee</th>
                        </tr>

                        @foreach ($csb as $csb)

                        <tr>
                            <td>{{$csb->apartment_number}}</td>
                            <td>{{$csb->bill}}</td>


                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

        <div id="maintenance-request-report" class="section-content">
            <div class="section-heading">
                <h1>Maintenance Request Report</h1>
            </div>


            <div>
                <h2></h2>
            </div>
            <div class="building-manager-request-table-position">
                <div class="apartment-owner-bill-table">
                    <table>
                        <tr>
                            <th>Maintenance Request ID</th>
                            <th>Apartment Number</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                        @foreach ($mr as $m)
                        <tr>
                            <td>{{$m->id}}</td>
                            <td>{{$m->apartment_number}}</td>
                            <td>{{$m->message_datetime}}</td>
                            <td>{{$m->status}}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

        <div id="complaint-report" class="section-content">
            <div class="section-heading">
                <h1>Complaint Report</h1>
            </div>

            <div>
                <h2></h2>
            </div>

            <div class="building-manager-request-table-position">
                <div class="apartment-owner-bill-table">
                    <table>

                        <tr>
                            <th>Complaint ID</th>
                            <th>Apartment Number</th>
                            <th>Date</th>
                            <th>Complaint</th>
                            <th>Status</th>
                        </tr>
                        @foreach ($complaints as $m)
                        <tr>
                            <td>{{$m->id}}</td>
                            <td>{{$m->apartment_number}}</td>
                            <td>{{$m->message_datetime}}</td>
                            <td>{{$m->message}}</td>
                            <td>{{$m->status}}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

        <div id="manage-maintenance-requests" class="section-content">
            <div class="section-heading">
                <h1>View Maintenance Request</h1>
            </div>
            <br>
            <div>

                <div class="maintenance-request-list">

                    @foreach ($mr as $m)
                    <a href='#mr-3'>
                        <button class="maintenance-request" onclick="viewMaintenanceDetails(event, 'mr-3')">
                            Maintenance Request ID: {{$m->id}} <br />
                        </button>
                    </a>
                    <!-- </div> -->
                    <div class="display-maintenance-request">
                        <div id="mr-3" class="maintenance-request-details">
                            <h3>Datetime</h3>
                            <p>{{$m->message_datetime}}</p>
                            <h3>Message</h3>
                            <p>{{$m->message}}</p>
                            <h3>Status</h3>
                            <p>{{$m->status}}</p>
                            <div class="status-change-button-position">
                                <button class="status-change-button">In-progress</button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- <div class="display-maintenance-request">
                        <div id="mr-1" class="maintenance-request-details">
                            <h3>Datetime</h3>
                            <p>01/27/2021 04:05:06</p>
                            <h3>Message</h3>
                            <p>Pipe needs maintenance.</p>
                            <h3>Status</h3>
                            <p>In-progress</p>

                            <div class="status-change-button-position">
                                <button class="status-change-button">Completed</button>
                            </div>
                        </div>

                        <div id="mr-2" class="maintenance-request-details">
                            <h3>Datetime</h3>
                            <p>02/09/2021 04:05:06</p>
                            <h3>Message</h3>
                            <p>Electric maintenance required.</p>
                            <h3>Status</h3>
                            <p>Completed</p>
                        </div>

                        <div id="mr-3" class="maintenance-request-details">
                            <h3>Datetime</h3>
                            <p>01/27/2021 04:05:06</p>
                            <h3>Message</h3>
                            <p>Pipe needs maintenance.</p>
                            <h3>Status</h3>
                            <p>Open</p>

                            <div class="status-change-button-position">
                                <button class="status-change-button">In-progress</button>
                            </div>
                        </div>
                    </div> -->
            </div>

        </div>

        <div id="manage-complaints" class="section-content">
            <div class="section-heading">
                <h1>View Complaints</h1>
            </div>
            <div>

                <div class="maintenance-request-list">

                    @foreach ($mr as $m)
                    <a href='#co-3'>
                        <button class="maintenance-request" onclick="viewMaintenanceDetails(event, 'co-3')">
                            Complaint ID: {{$m->id}} <br />
                        </button>
                    </a>
                    <div class="display-maintenance-request">
                        <div id="co-3" class="maintenance-request-details">
                            <h3>Datetime</h3>
                            <p>{{$m->message_datetime}}</p>
                            <h3>Message</h3>
                            <p>{{$m->message}}</p>
                            <h3>Status</h3>
                            <p>{{$m->status}}</p>
                            <div class="status-change-button-position">
                                <button class="status-change-button">In-progress</button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div id="subdivision-manager-chat" class="section-content">
            <div class="section-heading">
                <h1>Chat</h1>
            </div>
            <h3>Subdivision Manager</h3>

            <div class="chat-frame">

                <div class="chat-display-box">
                    <ul id="subdivision-manager-chat-display-box" class="ul-design">

                        @foreach ($chats as $chat)
                            @if ($chat->sender_user_id == $user->id && $chat->receiver_user_id == $subdivisionManagerUserId)
                                <li class="chat-sender-msg make-larger">{{ $chat->message }}</li>
                                <li class="chat-sender-msg make-small">{{ $chat->message_datetime }}</li>
                            @elseif ($chat->sender_user_id == $subdivisionManagerUserId && $chat->receiver_user_id == $user->id)
                                <li class="chat-receiver-msg make-larger">{{ $chat->message }}</li>
                                <li class="chat-receiver-msg make-small">{{ $chat->message_datetime }}</li>
                            @endif
                        @endforeach
                    </ul>
                </div>

                <div class="chat-input-bar">
                    <div class="chat-input">
                        <label for="send"></label>
                        <input type="text" id="subdivision-manager-send" name="send" class="chat-input-box" placeholder="Enter Message">
                    </div>
                    <div>
                        <button class="send-button" onclick="sendChatMessageToSM(event, 'subdivision-manager-send', 'subdivision-manager-chat-display-box', <?= $user->id; ?>, <?= $subdivisionManagerUserId ?>)">Send</button>
                    </div>
                </div>
            </div>

        </div>

        <div id="apartment-owner-chat" class="section-content">
            <div class="section-heading">
                <h1>Chat</h1>
            </div>

            <div class="chat-with-list">

                <div class="chat-list">

                    <div>
                        <h3>Apartment Owners</h3>
                    </div>

                    <div class="chat-name-list">
                        <?php foreach ($apartments as $key => $value): ?>
                            <a href="#apartment-owner-<?= htmlspecialchars($value->id); ?>">
                                <button class="apartment-owner-chat-tile" onclick="viewApartmentOwnerChatMenu(event, 'apartment-owner-<?= htmlspecialchars($value->id); ?>')">
                                    <?= $value->first_name; ?> <?= $value->last_name; ?><br />
                                    Apartment Number: <?= $value->apartment_number; ?> <br />
                                </button>
                            </a>
                        <?php endforeach; ?>
                    </div>

                </div>

                <div class="small-chat-frame">

                    <div class="chat-name-display">
                        <?php foreach ($apartments as $key => $value): ?>
                            <div id="apartment-owner-<?= htmlspecialchars($value->id); ?>" class="display-chat-name">
                                <h3><?= $value->first_name; ?> <?= $value->last_name; ?>, <?= $value->apartment_number; ?></h3>
                                <div class="small-chat-display-box">
                                    <ul id ='apt-owner-ul-<?= htmlspecialchars($value->id); ?>' class="ul-design">
                                        @foreach ($chats as $chat)
                                            @if ($chat->sender_user_id == $user->id && $chat->receiver_user_id == $value->id)
                                                <li class="chat-sender-msg make-larger">{{ $chat->message }}</li>
                                                <li class="chat-sender-msg make-small">{{ $chat->message_datetime }}</li>
                                            @elseif ($chat->sender_user_id == $value->id && $chat->receiver_user_id == $user->id)
                                                <li class="chat-receiver-msg make-larger">{{ $chat->message }}</li>
                                                <li class="chat-receiver-msg make-small">{{ $chat->message_datetime }}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>

                                <div class="chat-input-bar">
                                    <div class="chat-input">
                                        <label for="send"></label>
                                        <input type="text" id="apartment-owner-send-<?= htmlspecialchars($value->id); ?>" name="send" class="chat-input-box" placeholder="Enter Message">
                                    </div>
                                    <div>
                                        <button class="send-button" onclick="sendChatMessageToAO(event, 'apartment-owner-send-<?= htmlspecialchars($value->id); ?>', 'apt-owner-ul-', <?= htmlspecialchars($value->id); ?>, <?= $user->id; ?>)">Send</button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        
                    </div>


                </div>

            </div>
        </div>
    </div>

<script src="{{ asset('js/building-manager-page.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdn.socket.io/4.0.1/socket.io.min.js" integrity="sha384-LzhRnpGmQP+lOvWruF/lgkcqD+WDVt9fU3H4BWmwP5u5LTmkUGafMcpZKNObVMLU" crossorigin="anonymous"></script>

<script>

    let ip_address = '127.0.0.1';
    let socket_port = '3000';
    let socket = io(ip_address + ':' + socket_port);

    function sendChatMessageToSM(event, inputBoxId, displayChatBoxIdConst, bmUserId, smUserId) {

        var chatMessage = document.getElementById(inputBoxId).value;
        {{-- console.log('chatMessage = ' + chatMessage); --}}

        socket.emit('sendChatMessageFromBMToSM', chatMessage, smUserId, bmUserId);

        document.getElementById(inputBoxId).value = '';

        var newMessage = document.createElement("li");
        newMessage.innerHTML = chatMessage;
        newMessage.className = "chat-sender-msg make-larger";

        var ul = document.getElementById(displayChatBoxIdConst);
        {{-- console.log(ul); --}}
        ul.append(newMessage);
    }

    socket.on('sendChatToBMFromSM', (message) => {
            var newMessage = document.createElement("li");
            newMessage.innerHTML = message;
            newMessage.className = "chat-receiver-msg make-larger";

            var ul = document.getElementById('subdivision-manager-chat-display-box');
            {{-- console.log(ul); --}}
            ul.append(newMessage);
        });

    function sendChatMessageToAO(event, inputBoxId, displayChatBoxIdConst, aptOwnerUserId, buildingManagerUserId) {

        var chatMessage = document.getElementById(inputBoxId).value;
        {{-- console.log('chatMessage = ' + chatMessage); --}}
        socket.emit('sendChatMessageFromBMToAO', chatMessage, aptOwnerUserId, buildingManagerUserId);

        document.getElementById(inputBoxId).value = '';

        var newMessage = document.createElement("li");
        newMessage.innerHTML = chatMessage;
        newMessage.className = "chat-sender-msg make-larger";
        console.log('inside sendChatMessageToAO');

        var ul = document.getElementById(displayChatBoxIdConst+aptOwnerUserId);
        {{-- console.log(ul); --}}
        ul.append(newMessage);
    }

    socket.on('sendChatToBMFromAO', (message, aptOwnerUserId) => {
            var newMessage = document.createElement("li");
            newMessage.innerHTML = message;
            newMessage.className = "chat-receiver-msg make-larger";

            var ul = document.getElementById('apt-owner-ul-'+aptOwnerUserId);
            {{-- console.log(ul); --}}
            ul.append(newMessage);
        });

</script>
@endsection
