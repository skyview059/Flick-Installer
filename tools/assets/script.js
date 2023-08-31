$('#test_conn').on('click', function(){
    var FormData = $('#config').serialize();
    $.ajax({
        type: 'POST',
        data: FormData,        
        url: 'crm_installer/test_db_conn',
        dataType: 'html',
        beforeSend: function () {
            $('#respond').html('<p class="ajax_processing">Sending...</p>');
        },
        success: function (respond) {
            $('#respond').html(respond);            
        }
    });
});



$('.execute').on('click', function(){
    var sql_str = $(this).parent('td').parent('tr').find('pre').html();       
    sendData2SQL( sql_str );  
});

$('.utf8mb4_alter').on('click', function(){
    var sql_str = $('#utf8mb4').html();    
    sendData2SQL( sql_str );  
});

$('.sync_tbl').on('click', function(){
    var sql_str = $(this).parents('div.sync_box').find('pre').html();    
    sendData2SQL( sql_str );  
});

$('#custom_sql_btn').on('click', function(){
    var sql_str = $('#custom_sql').val();    
    sendData2SQL( sql_str );  
});

function sendData2SQL( sql_str ){
    $('#respond').empty();
    $.ajax({
        url: BaseURL + 'main/run_sql_str',
        type: 'POST',
        dataType: "HTML",
        data: { sql_str: sql_str },                
        beforeSend: function () {
            $('#info-box-bg').fadeIn('fast');
            $('#respond').html( 'Query is Runing... ' );
            $('#respond').append( sql_str );
        },
        success: function (respond) {            
            $('#respond').html( respond );
            setTimeout(function(){ $('#info-box-bg').fadeOut(); }, 2000);
        }		
    }); 
}

$('.ib-close').on('click', function(){
    $('#info-box-bg').fadeOut('slow');
});