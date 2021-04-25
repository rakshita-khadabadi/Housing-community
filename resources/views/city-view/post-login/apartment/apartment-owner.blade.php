@extends('city-view.app')

@section('title', 'Apartment Owner Page')

@section('content')

<div>
    <div class="left-panel">

        <div class="logo-and-menu">
            <div id="logo" class="logo">
                <h1>City View</h1>
            </div>

            <div class="menu-bar">
                <a href="javascript:void(0);" id="menu-icon" onclick="menuFunction()">
                <div class="menu-icon">
                <i class="menu-size fas fa-bars"></i>
                </div>
                </a>
            </div>
        </div>

        <div id="sidebar" class="sidebar">
        <button class="sidebar-menu-option sidebar-option text-left opacity active" onclick="myFunction(event, 'personal-details')">Personal Details</button>
    
        <button class="sidebar-menu-option sidebar-option text-left opacity" onclick="openMenu(event, 'apartment-dashboard-menu')">Dashboard<div class="dropdown-icon"><i class="fas fa-caret-down"></i></div></button>
        <div id="apartment-dashboard-menu" class="apartment-dashboard-menu">
        <!-- <button class="sidebar-option text-left opacity" onclick="myFunction(event, 'dashboard-home')">Home</button> -->
        <button class="sidebar-option text-left opacity" onclick="myFunction(event, 'dashboard-electricity-bill')">Electricity Bill</button>
        <button class="sidebar-option text-left opacity" onclick="myFunction(event, 'dashboard-water-bill')">Water Bill</button>
        <button class="sidebar-option text-left opacity" onclick="myFunction(event, 'dashboard-gas-bill')">Gas Bill</button>
        <button class="sidebar-option text-left opacity" onclick="myFunction(event, 'dashboard-internet-bill')">Internet Bill</button>
        </div>

        <button class="sidebar-menu-option text-left opacity" onclick="openMenu(event, 'apartment-bill-menu')">Bills<div class="dropdown-icon"><i class="fas fa-caret-down"></i></div></button>
        <div id="apartment-bill-menu" class="apartment-bill-menu">
        <button class="sidebar-option text-left opacity" onclick="myFunction(event, 'utility-bill')">Utility Bill</button>
        <button class="sidebar-option text-left opacity" onclick="myFunction(event, 'community-service-bill')">Community Service Bill</button>
        </div>

        <button class="sidebar-menu-option text-left opacity" onclick="openMenu(event, 'apartment-chat-menu')">Chat<div class="dropdown-icon"><i class="fas fa-caret-down"></i></div></button>
        <div id="apartment-chat-menu" class="apartment-chat-menu">
        <a href="#building-manager-chat"><button class="apartment-chat-menu-option sidebar-option text-left opacity" onclick="myFunction(event, 'building-manager-chat')">Building Manager</button></a>
        <a href="#subdivision-manager-chat"><button class="apartment-chat-menu-option sidebar-option text-left opacity" onclick="myFunction(event, 'subdivision-manager-chat')">Subdivision Manager</button></a>
        </div>

        <button class="sidebar-menu-option text-left opacity" onclick="openMenu(event, 'apartment-maintenance-request-menu')">Maintenance Requests<div class="dropdown-icon"><i class="fas fa-caret-down"></i></div></button>
        <div id="apartment-maintenance-request-menu" class="apartment-maintenance-request-menu">
        <button class="apartment-maintenance-request-menu-option sidebar-option text-left opacity" onclick="myFunction(event, 'new-maintenance-request')">New Maintenance Request</button>
        <button class="apartment-maintenance-request-menu-option sidebar-option text-left opacity" onclick="myFunction(event, 'view-maintenance-requests')">View Maintenance Requests</button>
        </div>

        <button class="sidebar-menu-option text-left opacity" onclick="openMenu(event, 'apartment-complaint-menu')">Complaints<div class="dropdown-icon"><i class="fas fa-caret-down"></i></div></button>
        <div id="apartment-complaint-menu" class="apartment-complaint-menu">
            <button class="sidebar-option text-left opacity" onclick="myFunction(event, 'new-complaint')">New Complaint</button>
            <button class="sidebar-option text-left opacity" onclick="myFunction(event, 'view-complaints')">View Complaints</button>
            </div>
            <a href="/">
            <button class="sidebar-option text-left opacity" onclick="myFunction(event, 'sign-out')">Sign out</button>
             </a>
        </div>
    </div>


    <div class="main-content">

<div class="page-heading">
    <h1>Apartment Owner </h1>
</div>

@if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

<div id="personal-details" class="show-initial section-content">
    <div class="section-heading"><h1>Personal Details</h1></div>

    <div class="apartment-personal-details-table-position">
        <div class="apartment-personal-details-table">
            <table>
                
                <tr>
                    <td>User ID</td>
                    <td><?= $personalDetails->id; ?></td>
                </tr>
                <tr>
                    <td>First Name</td>
                    <td><?= $personalDetails->first_name; ?></td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td><?= $personalDetails->last_name; ?></td>
                </tr>
                <tr>
                    <td>Email Id</td>
                    <td><?= $personalDetails->email_id; ?></td>
                </tr>
                <tr>
                    <td>Phone Number</td>
                    <td><?= $personalDetails->phone_number; ?></td>
                </tr>
                <tr>
                    <td>Joining Date</td>
                    <td><?= $personalDetails->joining_datetime; ?></td>
                </tr>
            </table>
        </div>
    </div>

</div>

<div id="apartment-owner-dashboard" class="section-content">
    <h1>Apartment Owner Dashboard</h1>
</div>

<!-- Apartment Owner Utility Bill -->

<div id="utility-bill" class="section-content">
    <div class="section-heading"><h1>Utility Bill</h1></div>
    
    <div><h2>Month-Year: <?= $utilityReportMonth; ?>-<?= $utilityReportYear; ?></h2></div>

    <div class="apartment-owner-bill-table-position total-bill">
        <div class="apartment-owner-bill-table">
            <table>
                <tr>
                    <th>Utility Name</th>
                    <th>Bill Amount</th>
                    <th>Service Provider</th>
                </tr>
                <?php foreach($utilityBillRecordList as $ubr): ?>
                    <tr>
                        <td><?= $ubr->utility_name; ?></td>
                        <td><?= $ubr->bill_amount; ?></td>
                        <td><?= $ubr->service_provider_type ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td>Total</td>
                    <td><?= $utilityBillTotal->total_utility_bill ?></td>
                    <td></td>
                </tr>
            </table>
        </div>
        
    </div>
</div> 

<!-- Apartment Owner Community Service Bill -->

<div id="community-service-bill" class="section-content">
    <div class="section-heading"><h1>Community Service Bill</h1></div>

    <div><h2>Month-Year: <?= $utilityReportMonth; ?>-<?= $utilityReportYear; ?></h2></div>

    <div class="apartment-owner-bill-table-position total-bill">
        <div class="apartment-owner-bill-table">
            <table>
                <tr>
                    <th>Service Name</th>
                    <th>Bill Amount</th>
                </tr>
                <?php foreach($communityServiceBillRecordList as $csbr): ?>
                <tr>
                    <td><?= $csbr->community_service_name ?></td>
                    <td><?= $csbr->bill_amount ?></td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <td>Total</td>
                    <td><?= $communityServiceBillTotal->total_community_service_bill ?></td>
                    
                </tr>
            </table>
        </div>    
    </div>
</div>

<div id="dashboard-electricity-bill" class="section-content">
    <div class="section-heading"><h1>Electricity Dashboard</h1></div>

    <div>
        <canvas id="electricity-chart"></canvas>
    </div>

    <script>
        let eChart = document.getElementById('electricity-chart').getContext('2d');
        // let polo = JSON.stringify(<?php $ebilljson ?>);

        let eDashboard = new Chart(eChart, {
            type:'bar',
            data:{
                labels: <?php echo $monthLabels ?>,
                datasets:[{
                    label:'Total Electricty Bill of Subdivision/Month',
                    data: <?php echo $electricityBillLabels ?>,
                    backgroundColor:'green'
                }]
            }
        });
    </script>
    
</div>  

<div id="dashboard-gas-bill" class="section-content">
    <div class="section-heading"><h1>Gas Dashboard</h1></div>

    <div>
        <canvas id="gas-chart"></canvas>
    </div>

    <script>
        let gasChart = document.getElementById('gas-chart').getContext('2d');
         {{-- let polo = JSON.stringify(<?php $ebilljson ?>); --}}

        let gasDashboard = new Chart(gasChart, {
            type:'bar',
            data:{
                labels: <?php echo $monthLabels ?>,
                datasets:[{
                    label:'Total Gas Bill of Subdivision/Month',
                    data: <?php echo $gasBillLabels ?>,
                    backgroundColor:'red'
                }]
            }
        });
    </script>
    
</div>  

<div id="dashboard-water-bill" class="section-content">
    <div class="section-heading"><h1>Water Dashboard</h1></div>

    <div>
        <canvas id="water-chart"></canvas>
    </div>

    <script>
        let waterChart = document.getElementById('water-chart').getContext('2d');
         {{-- let polo = JSON.stringify(<?php $ebilljson ?>); --}}

        let waterDashboard = new Chart(waterChart, {
            type:'bar',
            data:{
                labels: <?php echo $monthLabels ?>,
                datasets:[{
                    label:'Total Gas Bill of Subdivision/Month',
                    data: <?php echo $waterBillLabels ?>,
                    backgroundColor:'blue'
                }]
            }
        });
    </script>
    
</div>  

 <div id="dashboard-internet-bill" class="section-content">
    <div class="section-heading"><h1>Internet Dashboard</h1></div>

    <div>
        <canvas id="internet-chart"></canvas>
    </div>

    <script>
        let internetChart = document.getElementById('internet-chart').getContext('2d');
         {{-- let polo = JSON.stringify(<?php $ebilljson ?>); --}}

        let internetDashboard = new Chart(internetChart, {
            type:'bar',
            data:{
                labels: <?php echo $monthLabels ?>,
                datasets:[{
                    label:'Total internet Bill of Subdivision/Month',
                    data: <?php echo $internetBillLabels ?>,
                    backgroundColor:'green'
                }]
            }
        });
    </script>
    
</div> 

<!-- Apartment Owner New Maintenance Requests -->

  <div id="new-maintenance-request" class="section-content">
    <div class="section-heading"><h1>Maintenance Request</h1></div>
    <h3>Create New Maintenance Request</h3>

    <div>
        <form method="post">
        @csrf
            <label for="maintenance-request-input-message"><h4>Enter details:</h4></label>
            <textarea id="maintenance-request-input-message" name="maintenance-request-input-message" class="textarea-size"rows="4" cols="50"></textarea><br/>
            <input type="submit" value="Submit" class="submit-button">
        </form>
    </div>
</div> 

<!-- Apartment Owner View Maintenance Requests -->

<div id="view-maintenance-requests" class="section-content">
    <div class="section-heading"><h1>Maintenance Request</h1></div>
    <h3>View Maintenance Request</h3>
    <div>

        <div class="maintenance-request-list-apt">
            <?php foreach ($mrlist as $mr): ?>
                <button class="maintenance-request" onclick="viewMaintenanceDetails(event, 'mr-<?= $mr->id ?>')">
                    Maintenance Request ID: <?= $mr->id ?> <br />
                    Date: <?= $mr->message_datetime ?> <br />
                    Status: <?= $mr->status ?>
                </button>
            <?php endforeach; ?>
            
        </div>

        <div class="display-maintenance-request">
            <?php foreach ($mrlist as $mr): ?>
                <div id="mr-<?= $mr->id ?>" class="maintenance-request-details">
                    <h3>Datetime</h3>
                    <p><?= $mr->message_datetime ?></p>
                    <h3>Message</h3>
                    <p><?= $mr->message ?></p>
                    <h3>Status</h3>
                    <p><?= $mr->status ?></p>
                </div>
            <?php endforeach; ?>

            
        </div>
    </div>
    
</div>  

<!-- Apartment Owner New Complaints -->

<div id="new-complaint" class="section-content">
    <div class="section-heading"><h1>Complaints</h1></div>
    <h3>Create New Complaint</h3>

    <div>
        <form method="post">
         @csrf
            <label for="complaints-request-input-message"><h4>Enter details:</h4></label>
            <textarea id="complaints-request-input-message" name="complaints-request-input-message" class="textarea-size" rows="4" cols="50"></textarea><br/>
            <input type="submit" value="Submit" class="submit-button">
        </form>
    </div>
</div> 

<!-- Apartment Owner View Complaints -->

 <div id="view-complaints" class="section-content">
    <div class="section-heading"><h1>View Complaints</h1></div>
    <h3>View Complaints</h3>
    <div>

        <div class="complaint-list">
        <?php foreach ($crlist as $cm): ?>
            <button class="complaint" onclick="viewComplaintDetails(event, 'cm-<?= $cm->id ?>')">
                   Complaint ID: <?= $cm->id ?> <br />
                    Date: <?= $cm->message_datetime ?> <br />
                    Status: <?= $cm->status ?>
                
            </button>
            <?php endforeach; ?>

        </div>

        <div class="display-complaint">

            <?php foreach ($crlist as $cm): ?>
                <div id="cm-<?= $cm->id ?>" class="complaint-details">
                    <h3>Datetime</h3>
                    <p><?= $cm->message_datetime ?></p>
                    <h3>Message</h3>
                    <p><?= $cm->message ?></p>
                    <h3>Status</h3>
                    <p><?= $cm->status ?></p>
                </div>
            <?php endforeach;?>    
        </div>
    </div>
</div>

<!-- Apartment Owner Building Manager Chat -->

<div id="building-manager-chat" class="section-content">
    <div class="section-heading"><h1>Chat</h1></div>
    <h3>Building Manager</h3>

    <div class="chat-frame">

        <div class="chat-display-box">
            <ul id="building-manager-chat-display-box-<?= htmlspecialchars($personalDetails->id); ?>" class="ul-design">

                @foreach ($chats as $chat)
                    @if ($chat->sender_user_id == $personalDetails->id && $chat->receiver_user_id == $buildingManagerUserId)
                        <li class="chat-sender-msg make-larger">{{ $chat->message }}</li>
                        <li class="chat-sender-msg make-small">{{ $chat->message_datetime }}</li>
                    @elseif ($chat->sender_user_id == $buildingManagerUserId && $chat->receiver_user_id == $personalDetails->id)
                        <li class="chat-receiver-msg make-larger">{{ $chat->message }}</li>
                        <li class="chat-receiver-msg make-small">{{ $chat->message_datetime }}</li>
                    @endif
                @endforeach
            </ul>
        </div>

        <div class="chat-input-bar">
            <div class="chat-input">
                <label for="send"></label>
                <input type="text" id="building-manager-send" name="send" class="chat-input-box" placeholder="Enter Message">
            </div>
            <div>
                <button class="send-button" onclick="sendChatMessageToBM(event, 'building-manager-send', 'building-manager-chat-display-box-', <?= $personalDetails->id; ?>, <?= $buildingManagerUserId ?>)">Send</button>
            </div>
        </div>
    </div>

</div> 

<!-- Apartment Owner Subdivision Manager Chat -->

 <div id="subdivision-manager-chat" class="section-content">
    <div class="section-heading"><h1>Chat</h1></div>
    <h3>Subdivision Manager</h3>

    <div class="chat-frame">

        <div class="chat-display-box">
            <ul id="subdivision-manager-chat-display-box-<?= htmlspecialchars($personalDetails->id); ?>" class="ul-design">

                @foreach ($chats as $chat)
                    @if ($chat->sender_user_id == $personalDetails->id && $chat->receiver_user_id == $subdivisionManagerUserId)
                        <li class="chat-sender-msg make-larger">{{ $chat->message }}</li>
                        <li class="chat-sender-msg make-small">{{ $chat->message_datetime }}</li>
                    @elseif ($chat->sender_user_id == $subdivisionManagerUserId && $chat->receiver_user_id == $personalDetails->id)
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
                <button class="send-button" onclick="sendChatMessageToSM(event, 'subdivision-manager-send', 'subdivision-manager-chat-display-box-', <?= $personalDetails->id; ?>, <?= $subdivisionManagerUserId ?>)">Send</button>
            </div>
        </div>
    </div>

</div>

</div>

</div>

<script src="{{ asset('js/apartment-owner-page.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdn.socket.io/4.0.1/socket.io.min.js" integrity="sha384-LzhRnpGmQP+lOvWruF/lgkcqD+WDVt9fU3H4BWmwP5u5LTmkUGafMcpZKNObVMLU" crossorigin="anonymous"></script>

<script>

    let ip_address = '127.0.0.1';
    let socket_port = '3000';
    let socket = io(ip_address + ':' + socket_port);
        
    function sendChatMessageToSM(event, inputBoxId, displayChatBoxIdConst, aptOwnerUserId, smUserId) {

        var chatMessage = document.getElementById(inputBoxId).value;
        {{-- console.log('chatMessage = ' + chatMessage); --}}
        socket.emit('sendChatMessageToSMFromAO', chatMessage, smUserId, aptOwnerUserId);

        document.getElementById(inputBoxId).value = '';

        var newMessage = document.createElement("li");
        newMessage.innerHTML = chatMessage;
        newMessage.className = "chat-sender-msg make-larger";

        var ul = document.getElementById(displayChatBoxIdConst+aptOwnerUserId);
        {{-- console.log(ul); --}}
        ul.append(newMessage);
    }

    socket.on('sendChatToAOFromSM', (message, aptOwnerUserId) => {
            var newMessage = document.createElement("li");
            newMessage.innerHTML = message;
            newMessage.className = "chat-receiver-msg make-larger";
            
            var ul = document.getElementById('subdivision-manager-chat-display-box-'+aptOwnerUserId);
            {{-- console.log(ul); --}}
            ul.append(newMessage);
        });

    function sendChatMessageToBM(event, inputBoxId, displayChatBoxIdConst, aptOwnerUserId, bmUserId) {

        var chatMessage = document.getElementById(inputBoxId).value;
        {{-- console.log('chatMessage = ' + chatMessage); --}}
        socket.emit('sendChatMessageToBMFromAO', chatMessage, bmUserId, aptOwnerUserId);

        document.getElementById(inputBoxId).value = '';

        var newMessage = document.createElement("li");
        newMessage.innerHTML = chatMessage;
        newMessage.className = "chat-sender-msg make-larger";

        var ul = document.getElementById(displayChatBoxIdConst+aptOwnerUserId);
        {{-- console.log(ul); --}}
        ul.append(newMessage);
    }

    socket.on('sendChatToAOFromBM', (message, aptOwnerUserId) => {
            var newMessage = document.createElement("li");
            newMessage.innerHTML = message;
            newMessage.className = "chat-receiver-msg make-larger";
            
            var ul = document.getElementById('building-manager-chat-display-box-'+aptOwnerUserId);
            {{-- console.log(ul); --}}
            ul.append(newMessage);

        });

</script>

@endsection
