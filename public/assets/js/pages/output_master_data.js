var SalesData;
var MaterialProduct;


function getSalesData()
{
    fiscal_year = $('[name="fiscal_year"]').val();
    res = $.ajax({
        url: `${SITE_URL}/output_master/get_sales_data/${fiscal_year}`,
        type: 'get',
        dataType: 'json',
        async: false
    });

    return res.responseJSON;
}

function getSalesDataTable() {

    SalesDatas = getSalesData();
    datas = '';
    
    $.each(SalesDatas, function(i,v){
        datas += `<tr>
                    <td>${v.product_name}</td>
                    <td>${v.product_code}</td>
                    <td style="text-align:right">${v.apr_amount}</td>
                    <td style="text-align:right">${v.may_amount}</td>
                    <td style="text-align:right">${v.jun_amount}</td>
                    <td style="text-align:right">${v.jul_amount}</td>
                    <td style="text-align:right">${v.aug_amount}</td>
                    <td style="text-align:right">${v.sep_amount}</td>
                    <td style="text-align:right">${v.oct_amount}</td>
                    <td style="text-align:right">${v.nov_amount}</td>
                    <td style="text-align:right">${v.dec_amount}</td>
                    <td style="text-align:right">${v.jan_amount}</td>
                    <td style="text-align:right">${v.feb_amount}</td>
                    <td style="text-align:right">${v.mar_amount}</td>
                    <td style="text-align:right">${v.total}</td>
                </tr>`;
    });

    table = `
        <tbody>
            ${datas}
        </tbody>
        <tfoot>
            <tr style="text-align:right">
                <th colspan="2" style="text-align:right">Total</th>
                <td> ${SalesDatas[0].sum_apr}</td>
                <td> ${SalesDatas[0].sum_may}</td>
                <td> ${SalesDatas[0].sum_jun}</td>
                <td> ${SalesDatas[0].sum_jul}</td>
                <td> ${SalesDatas[0].sum_aug}</td>
                <td> ${SalesDatas[0].sum_sep}</td>
                <td> ${SalesDatas[0].sum_oct}</td>
                <td> ${SalesDatas[0].sum_nov}</td>
                <td> ${SalesDatas[0].sum_dec}</td>
                <td> ${SalesDatas[0].sum_jan}</td>
                <td> ${SalesDatas[0].sum_feb}</td>
                <td> ${SalesDatas[0].sum_mar}</td>
                <td> ${SalesDatas[0].sum_total}</td>
            </tr>
        </tfoot>
    `;
    
    $('#sales_data').find('tbody').remove();
    $('#sales_data').append(table);
}

function getMaterial()
{
    fiscal_year = $('[name="fiscal_year"]').val();
    res = $.ajax({
        url: `${SITE_URL}/output_master/get_material/${fiscal_year}`,
        type: 'get',
        dataType: 'json',
        async: false
    });

    return res.responseJSON;
}

function getMaterialTable() {

    Material = getMaterial();
    datas = '';

    $.each(Material, function(i,v){
        datas += `<tr>
                    <td>${v.product_name}</td>
                    <td>${v.product_code}</td>
                    <td style="text-align:right">${v.apr_amount}</td>
                    <td style="text-align:right">${v.may_amount}</td>
                    <td style="text-align:right">${v.jun_amount}</td>
                    <td style="text-align:right">${v.jul_amount}</td>
                    <td style="text-align:right">${v.aug_amount}</td>
                    <td style="text-align:right">${v.sep_amount}</td>
                    <td style="text-align:right">${v.oct_amount}</td>
                    <td style="text-align:right">${v.nov_amount}</td>
                    <td style="text-align:right">${v.dec_amount}</td>
                    <td style="text-align:right">${v.jan_amount}</td>
                    <td style="text-align:right">${v.feb_amount}</td>
                    <td style="text-align:right">${v.mar_amount}</td>
                    <td style="text-align:right">${v.total}</td>
                </tr>`;
    });

    table = `
        <tbody>
            ${datas}
        </tbody>
        <tfoot>
            <tr style="text-align:right">
                <th colspan="2" style="text-align:right">Total</th>
                <td> ${Material[0].sum_apr}</td>
                <td> ${Material[0].sum_may}</td>
                <td> ${Material[0].sum_jun}</td>
                <td> ${Material[0].sum_jul}</td>
                <td> ${Material[0].sum_aug}</td>
                <td> ${Material[0].sum_sep}</td>
                <td> ${Material[0].sum_oct}</td>
                <td> ${Material[0].sum_nov}</td>
                <td> ${Material[0].sum_dec}</td>
                <td> ${Material[0].sum_jan}</td>
                <td> ${Material[0].sum_feb}</td>
                <td> ${Material[0].sum_mar}</td>
                <td> ${Material[0].sum_total}</td>
            </tr>
        </tfoot>
    `;
    
    $('#material').find('tbody').remove();
    $('#material').append(table);
}

function getSalesMaterial()
{
    fiscal_year = $('[name="fiscal_year"]').val();
    res = $.ajax({
        url: `${SITE_URL}/output_master/get_sales_material/${fiscal_year}`,
        type: 'get',
        dataType: 'json',
        async: false
    });

    return res.responseJSON;
}

function getSalesMaterialTable() {

    MaterialSales = getSalesMaterial();
    datas = '';

    // console.log(MaterialSales);

    $.each(MaterialSales, function(i,v){
        datas += `<tr>
                    <td>${v.product_name}</td>
                    <td>${v.product_code}</td>
                    <td style="text-align:right">${v.apr_amount} %</td>
                    <td style="text-align:right">${v.may_amount} %</td>
                    <td style="text-align:right">${v.jun_amount} %</td>
                    <td style="text-align:right">${v.jul_amount} %</td>
                    <td style="text-align:right">${v.aug_amount} %</td>
                    <td style="text-align:right">${v.sep_amount} %</td>
                    <td style="text-align:right">${v.oct_amount} %</td>
                    <td style="text-align:right">${v.nov_amount} %</td>
                    <td style="text-align:right">${v.dec_amount} %</td>
                    <td style="text-align:right">${v.jan_amount} %</td>
                    <td style="text-align:right">${v.feb_amount} %</td>
                    <td style="text-align:right">${v.mar_amount} %</td>
                    <td style="text-align:right">${v.total}</td>
                </tr>`;
    });

    table = `
        <tbody>
            ${datas}
        </tbody>
        <tfoot>
            <tr style="text-align:right">
                <th colspan="2" style="text-align:right">Total</th>
                <td> ${MaterialSales[0].sum_apr} %</td>
                <td> ${MaterialSales[0].sum_may} %</td>
                <td> ${MaterialSales[0].sum_jun} %</td>
                <td> ${MaterialSales[0].sum_jul} %</td>
                <td> ${MaterialSales[0].sum_aug} %</td>
                <td> ${MaterialSales[0].sum_sep} %</td>
                <td> ${MaterialSales[0].sum_oct} %</td>
                <td> ${MaterialSales[0].sum_nov} %</td>
                <td> ${MaterialSales[0].sum_dec} %</td>
                <td> ${MaterialSales[0].sum_jan} %</td>
                <td> ${MaterialSales[0].sum_feb} %</td>
                <td> ${MaterialSales[0].sum_mar} %</td>
                <td> ${MaterialSales[0].sum_total} %</td>
            </tr>
        </tfoot>
    `;
    
    $('#material_sales_data').find('tbody').remove();
    $('#material_sales_data').append(table);
}

function getGroupMaterial()
{
    fiscal_year = $('[name="fiscal_year"]').val();
    res = $.ajax({
        url: `${SITE_URL}/output_master/get_group_material/${fiscal_year}`,
        type: 'get',
        dataType: 'json',
        async: false
    });

    return res.responseJSON;
}

function getGroupMaterialTable() {

    MaterialSales = getGroupMaterial();
    datas = '';
    child = {};

    console.log(MaterialSales);

    $.each(MaterialSales, function(i){        

        $.each(MaterialSales[i], function(j,v){

            child[i] += `<tr>
                        <td>${v.product_name}</td>
                        <td>${v.product_code}</td>
                        <td style="text-align:right">${v.apr_amount}</td>
                        <td style="text-align:right">${v.may_amount}</td>
                        <td style="text-align:right">${v.jun_amount}</td>
                        <td style="text-align:right">${v.jul_amount}</td>
                        <td style="text-align:right">${v.aug_amount}</td>
                        <td style="text-align:right">${v.sep_amount}</td>
                        <td style="text-align:right">${v.oct_amount}</td>
                        <td style="text-align:right">${v.nov_amount}</td>
                        <td style="text-align:right">${v.dec_amount}</td>
                        <td style="text-align:right">${v.jan_amount}</td>
                        <td style="text-align:right">${v.feb_amount}</td>
                        <td style="text-align:right">${v.mar_amount}</td>
                        <td style="text-align:right">${v.total}</td>
                    </tr>`;
        });


        datas += `<div class="col-md-12 table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr style="text-align:center">
                                <th><span class="text-uppercase">${i}</span></th>
                                <th><span class="text-uppercase">Product Code</span></th>
                                <th>April</th>
                                <th>May</th>
                                <th>June</th>
                                <th>July</th>
                                <th>Aug</th>
                                <th>Sep</th>
                                <th>Oct</th>
                                <th>Nov</th>
                                <th>Dec</th>
                                <th>Jan</th>
                                <th>Peb</th>
                                <th>Mar</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                           ${child[i]}
                        </tbody>
                        <tfoot>
                            <tr style="text-align:right">
                                <th colspan="2" style="text-align:right">Total</th>
                                <td> ${MaterialSales[i][0].sum_apr}</td>
                                <td> ${MaterialSales[i][0].sum_may}</td>
                                <td> ${MaterialSales[i][0].sum_jun}</td>
                                <td> ${MaterialSales[i][0].sum_jul}</td>
                                <td> ${MaterialSales[i][0].sum_aug}</td>
                                <td> ${MaterialSales[i][0].sum_sep}</td>
                                <td> ${MaterialSales[i][0].sum_oct}</td>
                                <td> ${MaterialSales[i][0].sum_nov}</td>
                                <td> ${MaterialSales[i][0].sum_dec}</td>
                                <td> ${MaterialSales[i][0].sum_jan}</td>
                                <td> ${MaterialSales[i][0].sum_feb}</td>
                                <td> ${MaterialSales[i][0].sum_mar}</td>
                                <td> ${MaterialSales[i][0].sum_total}</td>
                            </tr>
                            <tr style="text-align:right">
                                <th colspan="2" style="text-align:right">Presentage</th>
                                <td> ${MaterialSales[i][0].perc_apr} %</td>
                                <td> ${MaterialSales[i][0].perc_may} %</td>
                                <td> ${MaterialSales[i][0].perc_jun} %</td>
                                <td> ${MaterialSales[i][0].perc_jul} %</td>
                                <td> ${MaterialSales[i][0].perc_aug} %</td>
                                <td> ${MaterialSales[i][0].perc_sep} %</td>
                                <td> ${MaterialSales[i][0].perc_oct} %</td>
                                <td> ${MaterialSales[i][0].perc_nov} %</td>
                                <td> ${MaterialSales[i][0].perc_dec} %</td>
                                <td> ${MaterialSales[i][0].perc_jan} %</td>
                                <td> ${MaterialSales[i][0].perc_feb} %</td>
                                <td> ${MaterialSales[i][0].perc_mar} %</td>
                                <td> ${MaterialSales[i][0].perc_total} %</td>
                            </tr>
                        </tfoot>
                    <table>
                </div>`;

                // console.log(i);
    });

    

    table = datas;
    
    // console.log(datas);
    
    $('#group-wrapper').html('');
    $('#group-wrapper').html(table);
}

$(document).ready(function(){
    getSalesDataTable();
    getMaterialTable();
    getSalesMaterialTable();
    getGroupMaterialTable();
});
