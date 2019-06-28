<?php
echo '
<div id="historyCtrls">
    <div class="container-fluid mb-1 pl-3">
        <div class="row">
            
        </div>
        <div class="row">
            <div class="col-9">
                <div class="row">
                    <div class="col-1">
                        <span>ID <button  data-key="orderID" data-sort="des" class="secondsorter btn btn-light px-1 py-0 sortbtn"><i class="fas fa-sort"></i></button></span>
                    </div>
                    <div class="col-4 text-left">
                        <span>Items in order</span>
                    </div>
                    <div class="col-3 text-left">
                        <span>Total price <button  data-key="cost" data-sort="des" class="secondsorter btn btn-light px-1 py-0 sortbtn"><i class="fas fa-sort"></i></button></span>
                    </div>
                    <div class="col-4 text-left">
                        <span>Order date <button data-key="date" data-sort="des" class="secondsorter btn btn-light px-1 py-0 sortbtn"><i class="fas fa-sort"></i></button></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<article id="container" class="container-fluid mx-auto">
    <!-----orders go here----->
</article>';
?>