@extends('city-view.app')

@section('title', 'Subdivision Manager Page')

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
                <button href="#dashboard-electricity-bill" class="sidebar-option text-left opacity" onclick="myFunction(event, 'dashboard-electricity-bill')">Electricity Bill</button>
                <button class="sidebar-option text-left opacity" onclick="myFunction(event, 'dashboard-water-bill')">Water Bill</button>
                <button class="sidebar-option text-left opacity" onclick="myFunction(event, 'dashboard-gas-bill')">Gas Bill</button>

            </div>

            <button class="sidebar-menu-option text-left opacity" onclick="openMenu(event, 'master-record-menu')">Master Record<div class="dropdown-icon"><i class="fas fa-caret-down"></i></div></button>
            <div id="master-record-menu" class="master-record-menu">
                <a href="#building-manager-details"><button class="sidebar-menu-option sidebar-option text-left opacity" onclick="myFunction(event, 'building-manager-details')">Building Manager Details</button></a>
                <a href="#apartment-details"><button class="sidebar-menu-option sidebar-option text-left opacity" onclick="myFunction(event, 'apartment-details')">Apartment Owners Details</button></a>
            </div>

            <button class="sidebar-menu-option text-left opacity" onclick="openMenu(event, 'building-report-menu')">Reports<div class="dropdown-icon"><i class="fas fa-caret-down"></i></div></button>
            <div id="building-report-menu" class="building-report-menu">
                <a href="#utility-bill-report"><button class="sidebar-option text-left opacity" onclick="myFunction(event, 'utility-bill-report')">Utility Bill Report</button></a>
                <a href="#community-service-bill-report"><button class="sidebar-option text-left opacity" onclick="myFunction(event, 'community-service-bill-report')">Community Service Bill Report</button></a>
            </div>

            <button class="sidebar-menu-option text-left opacity" onclick="openMenu(event, 'subdivision-manager-chat-menu')">Chat<div class="dropdown-icon"><i class="fas fa-caret-down"></i></div></button>
            <div id="subdivision-manager-chat-menu" class="subdivision-manager-chat-menu">
                <a href="#apartment-owner-chat"><button class="subdivision-manager-chat-menu-option sidebar-option text-left opacity" onclick="myFunction(event, 'apartment-owner-chat')">Apartment Owner</button></a>
                <a href="#building-manager-chat"><button class="subdivision-manager-chat-menu-option sidebar-option text-left opacity" onclick="myFunction(event, 'building-manager-chat')">Building Manager</button></a>
            </div>

            <button class="sidebar-menu-option text-left opacity" onclick="openMenu(event, 'subdivision-it-request-menu')">IT Requests<div class="dropdown-icon"><i class="fas fa-caret-down"></i></div></button>
            <div id="subdivision-it-request-menu" class="subdivision-it-request-menu">
                <button class="subdivision-it-request-menu-option sidebar-option text-left opacity" onclick="myFunction(event, 'new-it-request')">New IT Request</button>
                <button class="subdivision-it-request-menu-option sidebar-option text-left opacity" onclick="myFunction(event, 'view-it-requests')">View IT Requests</button>
            </div>

            {{-- <a href="../../index.php"> --}}
            <a href="/">
                <button class="admin-option text-left opacity" onclick="myFunction(event, 'sign-out')">Sign out</button>
            </a>

        </div>
    </div>


    <div class="main-content">

        <div class="page-heading">
            <h1>Subdivision Manager</h1>
        </div>

        @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div id="personal-details" class="show-initial section-content">
            <div class="section-heading">
                <h1>Personal Details</h1>
            </div>

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

            <!-- <div class="edit-button-position">
                    <button class="edit-button">Edit</button>
                </div> -->
        </div>

        {{-- <!-- Subdivision Manager New IT Requests --> --}}

        <div id="new-it-request" class="section-content">
            <div class="section-heading">
                <h1>IT Request</h1>
            </div>
            <h3>Create New IT Request</h3>

            <div>
                <form method="post">
                    @csrf
                    <label for="it-request-input-message">
                        <h4>Enter details:</h4>
                    </label>
                    <textarea id="it-request-input-message" name="it-request-input-message" class="textarea-size" rows="4" cols="50"></textarea><br />
                    <input type="submit" value="Submit" class="submit-button">
                </form>
            </div>
        </div>

        {{-- <!-- Subdivision Manager View IT Requests --> --}}

        <div id="view-it-requests" class="section-content">
            <div class="section-heading">
                <h1>IT Request</h1>
            </div>
            <h3>View IT Request</h3>
            <div>

                <div class="it-request-list">
                    <?php foreach ($itrlist as $itr): ?>
                    <button class="it-request" onclick="viewItDetails(event, 'it-<?= $itr->id ?>')">
                        IT Request ID: <?= $itr->id ?> <br />
                        Date: <?= $itr->message_datetime ?> <br />
                        Status: <?= $itr->status ?>
                    </button>
                    <?php endforeach; ?>

                </div>

                <div class="display-it-request">
                    <?php foreach ($itrlist as $itr): ?>

                    <div id="it-<?= $itr->id ?>" class="it-request-details">
                        <h3>Datetime</h3>
                        <p><?= $itr->message_datetime ?></p>
                        <h3>Message</h3>
                        <p><?= $itr->message ?></p>
                        <h3>Status</h3>
                        <p><?= $itr->status ?></p>
                    </div>
                    <?php endforeach; ?>

                </div>
            </div>

        </div>

        {{-- <!-- Subdivision Manager Apartment Details --> --}}

        <div id="apartment-details" class="section-content">
            <div class="section-heading">
                <h1>Apartment Details</h1>
            </div>
            <h3>Apartment Owner List</h3>
            <div>

                <div class="view-data-list">

                    <?php foreach ($aptList as $key => $value): ?>
                    <a href="#apartment-owner-detail-<?= htmlspecialchars($key); ?>">
                        <button class="apartment-owner-detail-tile" onclick="viewApartmentDetails(event, 'apartment-owner-detail-<?= htmlspecialchars($key); ?>')">
                            Apartment Number: <?= $value->apartment_number; ?> <br />
                            Building Name: <?= $value->building_name; ?>
                        </button>
                    </a>
                    <?php endforeach; ?>


                </div>

                <div class="view-data">

                    <?php foreach ($aptList as $key => $value): ?>

                    <div id="apartment-owner-detail-<?= htmlspecialchars($key); ?>" class="apartment-owner-detail">
                        <div class="apartment-personal-details-table">
                            <table>
                                <tr>
                                    <td>Building Name</td>
                                    <td><?= $value->building_name; ?></td>
                                </tr>
                                <tr>
                                    <td>Apartment Number</td>
                                    <td><?= $value->apartment_number; ?></td>
                                </tr>
                                <tr>
                                    <td>First Name</td>
                                    <td><?= $value->first_name; ?></td>
                                </tr>
                                <tr>
                                    <td>Last Name</td>
                                    <td><?= $value->last_name; ?></td>
                                </tr>
                                <tr>
                                    <td>Email Id</td>
                                    <td><?= $value->email_id; ?></td>
                                </tr>
                                <tr>
                                    <td>Phone Number</td>
                                    <td><?= $value->phone_number; ?></td>
                                </tr>
                                <tr>
                                    <td>Joining Date</td>
                                    <td><?= $value->joining_datetime; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <?php endforeach; ?>

                </div>
            </div>
        </div>

        {{-- <!-- Subdivision Manager Building Manager Details --> --}}

        <div id="building-manager-details" class="section-content">
            <div class="section-heading">
                <h1>Building Manager Details</h1>
            </div>
            <h3>Building Manager List</h3>
            <div>

                <div class="view-data-list">
                    <?php foreach ($buildingList as $key => $value): ?>
                    <a href="#building-manager-detail-<?= htmlspecialchars($key); ?>">
                        <button class="apartment-owner-detail-tile" onclick="viewApartmentDetails(event, 'building-manager-detail-<?= htmlspecialchars($key); ?>')">
                            <?= $value->first_name; ?> <br />
                            Building Name: <?= $value->building_name; ?>
                        </button>
                    </a>
                    <?php endforeach; ?>

                </div>

                <div class="view-data">
                    <?php foreach ($buildingList as $key => $value): ?>
                    <div id="building-manager-detail-<?= htmlspecialchars($key); ?>" class="apartment-owner-detail">
                        <div class="apartment-personal-details-table">
                            <table>
                                <tr>
                                    <td>Building Name</td>
                                    <td><?= $value->building_name; ?></td>
                                </tr>
                                <tr>
                                    <td>First Name</td>
                                    <td><?= $value->first_name; ?></td>
                                </tr>
                                <tr>
                                    <td>Last Name</td>
                                    <td><?= $value->last_name; ?></td>
                                </tr>
                                <tr>
                                    <td>Email Id</td>
                                    <td><?= $value->email_id; ?></td>
                                </tr>
                                <tr>
                                    <td>Phone Number</td>
                                    <td><?= $value->phone_number; ?></td>
                                </tr>
                                <tr>
                                    <td>Joining Date</td>
                                    <td><?= $value->joining_datetime; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>

        {{-- <!-- Subdivision Manager Utility Bill --> --}}

        <div id="utility-bill-report" class="section-content">
            <div class="section-heading">
                <h1>Utility Bill Report</h1>
            </div>

            <div>
                <h2>Month-Year: <?= $utilityReportMonth; ?>-<?= $utilityReportYear; ?></h2>
            </div>

            <div class="subdivision-manager-bill-table-position total-bill">
                <div class="apartment-owner-bill-table">
                    <table>
                        <tr>
                            <th>Building Name</th>
                            <th>Apartment Number</th>
                            <th>Electricity Bill</th>
                            <th>Gas Bill</th>
                            <th>water Bill</th>
                            <th>Total</th>
                        </tr>
                        <?php foreach ($utilityBillRecordList as $ubr): ?>
                        <tr>
                            <td><?= $ubr->building_name ?></td>
                            <td><?= $ubr->apartment_number ?></td>
                            <td><?= $ubr->electricity_bill ?></td>
                            <td><?= $ubr->gas_bill ?></td>
                            <td><?= $ubr->water_bill ?></td>
                            <td><?= $ubr->total ?></td>
                        </tr>
                        <?php endforeach; ?>

                        <tr>
                            <td>Subdivision Total</td>
                            <td><?= $apartmentCount->total_apartments ?></td>
                            <td><?= $electricityBillTotal->total_electricity_bill ?></td>
                            <td>{{ $gasBillTotal->total_gas_bill }}</td>
                            <td>{{ $waterBillTotal->total_water_bill }}</td>
                            <td>{{ $utilityBillTotal }}</td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>

        {{-- <!-- Subdivision Manager community Service Bill --> --}}

        <div id="community-service-bill-report" class="section-content">
            <div class="section-heading">
                <h1>Community Service Bill Report</h1>
            </div>

            <div>
                <h2>Month-Year: <?= $utilityReportMonth; ?>-<?= $utilityReportYear; ?></h2>
            </div>

            <div class="subdivision-manager-bill-table-position total-bill">
                <div class="apartment-owner-bill-table">
                    <table>
                        <tr>
                            <th>Building Name</th>
                            <th>Apartment Number</th>
                            <th>Bill Amount</th>
                            <th>Community Service Name</th>

                        </tr>
                        <?php foreach ($communityServiceBillRecordList as $csbr): ?>
                        <tr>
                            <td><?= $csbr->building_name ?></td>
                            <td><?= $csbr->apartment_number ?></td>
                            <td><?= $csbr->bill_amount ?></td>
                            <td><?= $csbr->community_service_name ?></td>
                        </tr>
                        <?php endforeach; ?>

                        <tr>
                            <td>Subdivision Total</td>
                            <td><?= $apartmentCountCommunityService->total_apartments ?></td>
                            <td><?= $communityServiceBillTotal->total_community_service_bill ?></td>
                            <td></td>
                        </tr>
                    </table>
                </div>
            </div>
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
                // let polo = JSON.stringify(<?php $ebilljson ?>);

                let eDashboard = new Chart(eChart, {
                    type: 'bar'
                    , data: {
                        labels: <?php echo $monthLabels ?> 
                        , datasets: [{
                            label: 'Total Electricty Bill of Subdivision/Month'
                            , data: <?php echo $electricityBillLabels ?> 
                            , backgroundColor: 'green'
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
                // let polo = JSON.stringify(<?php $ebilljson ?>);

                let gasDashboard = new Chart(gasChart, {
                    type: 'bar'
                    , data: {
                        labels: <?php echo $monthLabels ?> 
                        , datasets: [{
                            label: 'Total Gas Bill of Subdivision/Month'
                            , data: <?php echo $gasBillLabels ?> 
                            , backgroundColor: 'red'
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
                // let polo = JSON.stringify(<?php $ebilljson ?>);

                let waterDashboard = new Chart(waterChart, {
                    type: 'bar'
                    , data: {
                        labels: <?php echo $monthLabels ?> 
                        , datasets: [{
                            label: 'Total Gas Bill of Subdivision/Month'
                            , data: <?php echo $waterBillLabels ?> 
                            , backgroundColor: 'blue'
                        }]
                    }
                });

            </script>

        </div>

        {{-- Subdivision Manager Building Manager Chat --}}

        <div id="building-manager-chat" class="section-content">
            <div class="section-heading">
                <h1>Chat</h1>
            </div>

            <div class="chat-with-list">

                <div class="chat-list">

                    <div>
                        <h3>Building Manager</h3>
                    </div>

                    <div class="chat-name-list">
                        <?php foreach ($buildingList as $key => $value): ?>
                        <a href="#building-manager-<?= htmlspecialchars($value->id); ?>">
                            <button class="building-manager-chat-tile" onclick="viewBuildingManagerChatMenu(event, 'building-manager-<?= htmlspecialchars($value->id); ?>')">
                                <?= $value->first_name; ?> <?= $value->last_name; ?> <br />
                                <?= $value->building_name; ?> <br />
                            </button>
                        </a>
                        <?php endforeach; ?>
                    </div>

                </div>

                <div class="small-chat-frame">

                    <div class="chat-name-display">

                        <?php foreach ($buildingList as $key => $value): ?>
                        <div id="building-manager-<?= htmlspecialchars($value->id); ?>" class="display-chat-name">
                            <h3><?= $value->first_name; ?> <?= $value->last_name; ?>, <?= $value->building_name; ?></h3>
                            <div class="small-chat-display-box">
                                <ul id ='building-manager-ul-<?= htmlspecialchars($value->id); ?>' class="ul-design">

                                </ul>
                            </div>

                            <div class="chat-input-bar">
                                <div class="chat-input">
                                    <label for="send"></label>
                                    <input type="text" id="building-manager-send-<?= htmlspecialchars($value->id); ?>" value="" name="send" class="chat-input-box" placeholder="Enter Message">
                                </div>
                                <div>
                                    <button class="send-button" onclick="sendChatMessageToAO(event, 'building-manager-send-<?= htmlspecialchars($value->id); ?>', 'building-manager-ul-', <?= htmlspecialchars($value->id); ?>, <?= $personalDetails->id; ?>)">Send</button>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>

                    </div>


                </div>

            </div>
        </div>

        {{-- Subdivision Manager Apartment Owner Chat  --}}

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
                        <?php foreach ($aptList as $key => $value): ?>
                        <a href="#apartment-owner-<?= htmlspecialchars($value->id); ?>">
                            <button class="apartment-owner-chat-tile" onclick="viewApartmentOwnerChatMenu(event, 'apartment-owner-<?= htmlspecialchars($value->id); ?>')">
                                <?= $value->first_name; ?> <?= $value->last_name; ?>, <?= $value->apartment_number; ?><br />
                                <?= $value->building_name; ?> <br />
                            </button>
                        </a>
                        <?php endforeach; ?>
                    </div>

                </div>

                <div class="small-chat-frame">

                    <div class="chat-name-display">

                        <?php foreach ($aptList as $key => $value): ?>
                        <div id="apartment-owner-<?= htmlspecialchars($value->id); ?>" class="display-chat-name">
                            <h3><?= $value->first_name; ?> <?= $value->last_name; ?>, <?= $value->apartment_number; ?>, <?= $value->building_name; ?></h3>
                            <div id="small-chat-display-box-<?= htmlspecialchars($value->id); ?>" class="small-chat-display-box">
                                <ul id ='apt-owner-ul-<?= htmlspecialchars($value->id); ?>' class="ul-design">
                                
                                </ul>
                            </div>

                            <div class="chat-input-bar">
                                <div class="chat-input">
                                    <label for="send"></label>
                                    <input type="text" id="apartment-owner-send-<?= htmlspecialchars($value->id); ?>" name="send" class="chat-input-box" placeholder="Enter Message">
                                </div>
                                <div>
                                    <button class="send-button" onclick="sendChatMessageToAO(event, 'apartment-owner-send-<?= htmlspecialchars($value->id); ?>', 'apt-owner-ul-', <?= htmlspecialchars($value->id); ?>, <?= $personalDetails->id; ?>)">Send</button>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

<script src="{{ asset('js/subdivision-manager-page.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdn.socket.io/4.0.1/socket.io.min.js" integrity="sha384-LzhRnpGmQP+lOvWruF/lgkcqD+WDVt9fU3H4BWmwP5u5LTmkUGafMcpZKNObVMLU" crossorigin="anonymous"></script>

<script>

    let ip_address = '127.0.0.1';
    let socket_port = '3000';
    let socket = io(ip_address + ':' + socket_port);

    socket.on('sendChatToSMFromBM', (message, buildingManagerUserId) => {
            var newMessage = document.createElement("li");
            newMessage.innerHTML = message;
            newMessage.className = "chat-receiver-msg make-larger";
            console.log('inside sendChatToSMFromBM');
            var ul = document.getElementById('building-manager-ul-'+buildingManagerUserId);
            console.log(ul);
            ul.append(newMessage);

            {{-- socket.off('sendChatToSMFromAO', message); --}}
        });

    function sendChatMessageToAO(event, inputBoxId, displayChatBoxIdConst, aptOwnerUserId, subManagerUserId) {

        var chatMessage = document.getElementById(inputBoxId).value;
        console.log('chatMessage = ' + chatMessage);
        socket.emit('sendChatMessageFromSMToAO', chatMessage, aptOwnerUserId, subManagerUserId);

        document.getElementById(inputBoxId).value = '';

        var newMessage = document.createElement("li");
        newMessage.innerHTML = chatMessage;
        newMessage.className = "chat-sender-msg";
        console.log('inside sendChatToClient');

        var ul = document.getElementById(displayChatBoxIdConst+aptOwnerUserId);
        console.log(ul);
        ul.append(newMessage);
    }

    socket.on('sendChatToSMFromAO', (message, aptOwnerUserId) => {
            var newMessage = document.createElement("li");
            newMessage.innerHTML = message;
            newMessage.className = "chat-receiver-msg";
            console.log('inside sendChatToSMFromAO');
            var ul = document.getElementById('apt-owner-ul-'+aptOwnerUserId);
            console.log(ul);
            ul.append(newMessage);

            socket.off('sendChatToSMFromAO', message);
        });

</script>

@endsection
