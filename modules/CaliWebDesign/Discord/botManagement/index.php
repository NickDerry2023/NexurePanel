<?php

    // Uninitialized values to prevent page load failure

    $pagetitle = '';
    $pagesubtitle = 'Discord Hosting Services Management';
    $pagetype = '';

    include($_SERVER["DOCUMENT_ROOT"].'/modules/CaliWebDesign/Utility/Backend/Dashboard/Headers/index.php');

    $accountnumber = $_GET['account_number'] ?? '';

    function setPageTitleAndType($role) {

        $titles = [
            'customer' => 'Client',
            'authorized user' => 'Authorized User',
            'administrator' => 'Administration',
            'partner' => 'Partners',
        ];

        if (isset($titles[strtolower($role)])) {

            return [
                'title' => $titles[strtolower($role)],
                'type' => $titles[strtolower($role)]
            ];

        } else {

            echo "Error: Undefined role. Please contact the system administrator.";
            exit();

        }

    }

    if (isset($currentAccount->role->name)) {

        $pageInfo = setPageTitleAndType($currentAccount->role->name);
        $pagetitle = $pageInfo['title'];
        $pagesubtitle =  $pagesubtitle;
        $pagetype = $pageInfo['type'];

    }

    function fetchCustomerAccount($con, $accountnumber) {

        $query = "SELECT * FROM caliweb_users WHERE accountNumber = '".mysqli_real_escape_string($con, $accountnumber)."'";
        $result = mysqli_query($con, $query);
        $info = mysqli_fetch_array($result);
        mysqli_free_result($result);

        return $info;

    }

    function displayPageTitle($pagetitle, $pagesubtitle) {

        echo '<title>' . $pagetitle . ' | ' . $pagesubtitle . '</title>';

    }

    if (strtolower($currentAccount->role->name) == "customer") {

        $accountnumber = $_GET['account_number'] ?? '';

        if (!$accountnumber) {

            header("location: /dashboard/customers/");
            exit;

        }

        $customerAccountInfo = fetchCustomerAccount($con, $accountnumber);

        if (!$customerAccountInfo) {

            header("location: /dashboard/administration/accounts");
            exit;

        }

        displayPageTitle($pagetitle, $pagesubtitle);

        if (in_array($pagetitle, $clientPages) || (isset($pagesubtitle) && $pagesubtitle == "Client") || $pagetype == "Client") {

            echo '<link href="/assets/css/client-dashboard-css-2024.css" rel="stylesheet" type="text/css" />';

        } else {

            echo '';

        }

?>

        <!-- HTML Content for customer users view -->

        <section class="first-dashboard-area-cards">

            <section class="section caliweb-section customer-dashboard-greeting-section">
                <div class="container caliweb-container">
                    <div class="display-flex align-center" style="justify-content:space-between;">
                        <div>
                            <p class="no-padding" style="font-size:16px;">Overview / Cali Web Design Bot Hosting / Home Page</p>
                        </div>
                        <div class="width-25">
                            <select class="form-input with-border-special" name="discordbotselector" id="discordbotselector" style="margin-top:0;">
                                <option>Discord Bot 1</option>
                                <option>Discord Bot 2</option>
                                <option>Discord Bot 3</option>
                                <option>Discord Bot 4</option>
                            </select>
                        </div>
                    </div>
                </div>
            </section>

            <section class="section caliweb-section customer-dashboard-section" style="padding-bottom:60px;">
                <div class="container caliweb-container">
                    <div class="caliweb-one-grid" style="grid-row-gap: 32px;">
                        <div class="caliweb-card dashboard-card" style="padding:30px;">
                            <div class="display-flex align-center" style="justify-content:space-between;">
                                <div class="title">
                                    <h4 class="font-size-20" style="padding:0; margin:0;">Discord Bot 1</h4>
                                </div>
                                <div class="actionButtons">
                                    <div class="display-flex align-center">
                                        <div>
                                            <button class="caliweb-button secondary red" onclick="" name="" type="">Stop</button>
                                            <button class="caliweb-button secondary" style="margin-left:10px;" onclick="" name="" type="">Start</button>
                                            <button class="caliweb-button secondary" style="margin-left:10px;" onclick="" name="" type="">Restart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="botOutputfromDocker">
                                <p>This bot is not started.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </section>

 
<?php

    } else if (strtolower($currentAccount->role->name) == "authorized user") {
        
        displayPageTitle($pagetitle, $pagesubtitle);
    
?>

    <!-- HTML Content for authorized users view -->

<?php

    } else if (strtolower($currentAccount->role->name) == "administrator") {

        if (!$accountnumber) {

            header("location: /dashboard/administration/accounts/");
            exit;

        }

        $domainName = "caliwebdesignservices.com";

        $customerAccountInfo = fetchCustomerAccount($con, $accountnumber);
        displayPageTitle($pagetitle, $pagesubtitle);

?>


        <!-- HTML Content for administrators view -->

        <section class="section first-dashboard-area-cards" style="padding-top:2%;">
            <div class="container width-98">
                
            </div>
        </section>


<?php

    }

    include($_SERVER["DOCUMENT_ROOT"].'/modules/CaliWebDesign/Utility/Backend/Dashboard/Footers/index.php');

?>