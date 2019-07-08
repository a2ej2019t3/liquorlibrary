<?php
echo '
<div id="historyCtrls">
    <div class="container-fluid mb-1 pl-3">
        <div class="row">
            
        </div>
        <div class="row">
            <div class="col-9">
                <div class="row">
                    <div class="col-2">
                        <span>ID <button data-key="orderID" data-sort="des" class="sorter btn btn-light px-1 py-0"><i class="fas fa-sort"></i></button></span>
                    </div>
                    <div class="col-4 text-left">
                        <span>Items in order</span>
                    </div>
                    <div class="col-3 text-left">
                        <span>Total price <button data-key="cost" data-sort="des" class="sorter btn btn-light px-1 py-0"><i class="fas fa-sort"></i></button></span>
                    </div>
                    <div class="col-3 text-left">
                        <span>Order date <button data-key="date" data-sort="des" class="sorter btn btn-light px-1 py-0"><i class="fas fa-sort"></i></button></span>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="btn-group">
                    <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
                        Status filter
                    </button>
                    <div class="dropdown-menu">
                        <button class="dropdown-item" value="all" onclick="selectChecking(this.value)">All</button>
                        <button class="dropdown-item" value="paid" onclick="selectChecking(this.value)">Paid</button>
                        <button class="dropdown-item" value="completed" onclick="selectChecking(this.value)">Completed</button>
                        <button class="dropdown-item" value="processing" onclick="selectChecking(this.value)">Processing</button>
                        <button class="dropdown-item" value="cancelled" onclick="selectChecking(this.value)">Cancelled</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<article id="container" class="container-fluid mx-auto">
    <!-----orders go here----->
</article>';