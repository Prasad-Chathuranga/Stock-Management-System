
var app = angular.module('sms' , ['CMALoader','ui.bootstrap']);



function getErrorAsString(errorObj) {

    //var errorObj = {"code": ["The code has already been taken."]};
    var errMsg = errorObj.message || 'An error occured';
    errMsg += '<br><ul>';
    
    var errorText = '';

    try {

        if (typeof (errorObj.errors) != 'undefined') {

            var keyList = Object.keys(errorObj.errors);

            

            keyList.forEach((value) => {

                errorText += '<li>' + errorObj.errors[value][0] + '</li>';

            });
        }
    } catch (ex) {

    }

    return errMsg + errorText + '</ul>';

}


function pnotify(title,text,type){
    let addClass='';
    let icon ='';

    if(type=='success'){
        type='custom';
        addClass='green';
        icon='ti-check';

    }
    if(type=='error'){
        type='custom';
        addClass='red';
        icon='ti-close';
    }

    new PNotify({'title': title , 'text' : text , 'type' : type ,'addclass': addClass,'icon': icon, 'delay' : 2000});
}


app.directive('tableRepeat' , ()=>{
    
    return (scope,element,attr)=>{
        
        if(scope.$last){
            scope.initDataTable();
        }
        
    };
    
});


// function saveFile (name, type, data) {
//     if (data !== null && navigator.msSaveBlob)
//         return navigator.msSaveBlob(new Blob([data], { type: type }), name);
//     var a = $("<a style='display: none;'/>");
//     var url = window.URL.createObjectURL(new Blob([data], {type: type}));
//     a.attr("href", url);
//     a.attr("download", name);
//     $("body").append(a);
//     a[0].click();
//     window.URL.revokeObjectURL(url);
//     a.remove();
// }


/**
 * 
 * @param {date} $date (format would be general mysql returning date format: 'yyyy-mm-dd' )
 * @returns a date senska preferred date format 'dd-mm-yyyy'
 */
function returnSenskaDateString($date){
                    
    let formatteddate =  new Date($date);
    //console.log(formatteddate);

    var date= formatteddate.getDate();

    //in js monts starts from 0, hense make sure to add one to get exact month
    var month= formatteddate.getMonth()+1;

    var yr= formatteddate.getFullYear();

    if(date<9){
        date="0"+date;
    }

    if(month<9){
        month="0"+month;
    }


    return date+"-"+month+"-"+yr;

}

function returnSenskaDateTimeString($date){
                    
    let formatteddate =  new Date($date);
    //console.log(formatteddate);

    var date= formatteddate.getDate();

    //in js monts starts from 0, hense make sure to add one to get exact month
    var month= formatteddate.getMonth()+1;

    var yr= formatteddate.getFullYear();

    var hours=formatteddate.getHours();
    var mins=formatteddate.getMinutes();


    if(date<9){
        date="0"+date;
    }

    if(month<9){
        month="0"+month;
    }
    
    var ampm='';
    if(hours>12){
        ampm='PM';
        hours-=12;
    }else{
        ampm='AM';
    }

    return date+"-"+month+"-"+yr+" "+hours+":"+mins +" "+ampm;

}