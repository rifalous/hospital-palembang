
var table = $('#data_table').dataTable({
    "ajax": "{{ url('capex/get').'/'.$budget_no }}",
    "ordering": false,
    "paging": false,
    "searching": false,
    "fnDrawCallback": function (oSettings) {
        approvalView();         //v3.1 by Ferry, 20150906, Additional link to Approval No
        budgetStatusStyler();
    }
});

function budgetStatusStyler()
{
    $('tr > td:nth-child(6)').each(function(index, element) {
        var value = $(this).text();
        if (value == 'Underbudget') {
            $(this).addClass('success');
        };

        if (value == 'Overbudget') {
            $(this).addClass('danger');
        };
    })
}

//v3.1 by Ferry, 20150906, Additional link to Approval No
function approvalView()
{
    $('tbody tr[role="row"]').each(function(i, e) {
        var approval_no = $(this).find('td:nth-child(1)');

        // set budget_no anchor
        approval_no.html('<a href="{{ url("approval/cx/") }}/'+approval_no.text()+'" >'+approval_no.text()+'</a>');

    });
}
