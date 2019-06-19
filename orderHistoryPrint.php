<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    include(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'DBsql.php');
    $DBsql = new sql;
    
    $buyerID = $_SESSION['user']['userID'];
    $res = $DBsql->select('orders LEFT JOIN status ON orders.status = status.statusID', array('buyerID' => $buyerID));
    var_dump($res);
    if ($res !== null) {
        for ($i = 0; $i < count($res); $i++) {
            echo '
                <div id="accordion">
                <div class="card">
                    <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#coid">
                            DETAIL
                            <i class="fas fa-chevron-circle-down"></i>
                        </button>
                    </h5>
                    </div>
                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                        </div>
                    </div>
                </div>
            ';
        }
    } 


    
     
    // <div class="card-body">
    //   Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
    // </div>