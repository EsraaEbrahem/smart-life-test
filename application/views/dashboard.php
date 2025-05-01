<div class="row">
    <div class="col-md-3">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <a href="student?opt=mgst" style="color:white;">
                    Total Student : <span class="badge"><?php echo $countTotalStudent; ?></span>
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="panel panel-success">
            <div class="panel-heading">
                <a href="teacher">
                    Total Teacher : <span class="badge"><?php echo $countTotalTeacher; ?></span>
                </a>

            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="panel panel-info">
            <div class="panel-heading">
                <a href="classes">
                    Total Class : <span class="badge"><?php echo $countTotalClasses; ?></span>
                </a>

            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <a href="marksheet?opt=mngms">
                    Total Marksheet : <span class="badge"><?php echo $countTotalMarksheet; ?></span>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="panel panel-primary">
            <div class="panel-heading">Filter Balance</div>
            <div class="panel-body">
                <form action="<?php echo base_url('dashboard/incomeFilter') ?>" method="post" id="IncomeFilterForm">
                    <div class="form-group">
                        <label for="fromDate">From Date</label>
                        <input type="text" class="form-control" id="fromDate" name="fromDate"
                               placeholder="From Date" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="toDate">To Date</label>
                        <input type="text" class="form-control" id="toDate" name="toDate"
                               placeholder="From Date" autocomplete="off">
                    </div>
                    <button type="submit" class="btn btn-primary">Filter</button>

                </form>
            </div>
        </div>

        <div class="panel panel-primary">
            <div class="panel-heading"> Lifetime Income</div>
            <div class="panel-body">
                <center>
                    <h3><b id="incomes"><?php echo $totalIncome; ?> </b></h3>
                </center>
            </div>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading"> Lifetime Expenses</div>
            <div class="panel-body">
                <center>
                    <h3><b id="expenses"><?php echo $totalExpenses; ?></b></h3>
                </center>

            </div>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading "> Current Budget</div>
            <div class="panel-body">
                <center>
                    <h3><b id="budget"><?php echo $totalBudget; ?></b></h3>
                </center>
            </div>
        </div>
    </div>

    <div class="col-md-7">
        <div class="panel panel-primary">
            <div class="panel-heading"><i class="glyphicon glyphicon-calendar"></i> Calendar</div>
            <div class="panel-body">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function () {
        $("#topNavDashboard").addClass('active');
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'agendaWeek,agendaDay'
            },
            events: 'calendarCalcs'
        });
        $('#fromDate').calendarsPicker({
            dateFormat: 'yyyy-mm-dd'
        });
        $('#toDate').calendarsPicker({
            dateFormat: 'yyyy-mm-dd'
        });

        $("#IncomeFilterForm").unbind('submit').bind('submit', function() {
            var form = $(this);
            var formData = new FormData($(this)[0]);
            var url = form.attr('action');
            var type = form.attr('method');

            $.ajax({
                url : url,
                type : type,
                data: formData,
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                async: false,
                success:function(response) {
                    if(response.success == true) {
                        $("#budget").html(response.totalBudget);
                        $("#incomes").html(response.totalIncome);
                        $("#expenses").html(response.totalExpenses);
                    }
                    else {
                        console.log('response')
                        console.log(response)
                        $("#budget").html('-');
                        $("#incomes").html('-');
                        $("#expenses").html('-');
                    } // /else
                } // /success
            }); // /ajax

            return false;
        });

    });
</script>

