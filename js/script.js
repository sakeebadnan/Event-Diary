

$(document).ready(function() {

    // Search movie
    function searchEvents(){
        // $.ajax({
        //     url: "https://app.ticketmaster.com/discovery/v2/events.json?apikey=jXwlWgP6L4ReAusj5R4yuFWwE0X6ej9l&size=10&classificationName=music",
        //     type: "GET",
        //     success: function(data) {
        //         data = JSON.parse(data);

        //     }
        // });

    }
});
var eventsData='';

function searchEvents(){
    var category=$('#category').val();
    var searchCity=$('#city').val();
    $.ajax({
        url: "https://app.ticketmaster.com/discovery/v2/events.json?apikey=jXwlWgP6L4ReAusj5R4yuFWwE0X6ej9l&size=200&classificationName="+category,
        type: "GET",
        success: function(data) {
            //data = JSON.parse(data);
            console.log(data._embedded.events);
            eventsData='';
            $('#searchOut').empty();
            //$('#tbody').empty();
            
            eventsData=data._embedded.events;
            
            var colorIndex=0;
            var alterNativeColor='even';
            var count =0;
            $.each(data._embedded.events, function (index, value) {
                console.log(value._embedded.venues[0].city.name);
                try{
                    var categoryValue=value.classifications[0].segment.name;
                }catch(err){
                    categoryValue = 'Not Available';
                }
                if(category=='food')
                    categoryFood ='Food';
                if(searchCity==''||value._embedded.venues[0].city.name==searchCity){
                    if(category==' ' && (value.classifications[0].segment.name=='Food'|| value.classifications[0].segment.name=='Music' || value.classifications[0].segment.name=='Sports'))
                    { 

                    }else{
                        count++;
                        if(count==1){
                            var tr = `
                            <input type='button' name='save' value='save' onclick='insertevent()'>
                            <table class='eventstable' id='evTable'>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th class='other'>Category</th>
                                    <th class='other'>Date</th>
                                    <th class='other'>Time</th>
                                    <th class='other'>City</th>
                                    <th class='other'>Country</th>
                                    <th class='other'>Address</th>
                                    <th>Picture</th>
                                </tr>`;
                            $('#searchOut').append($(tr));
                        }else{

                            colorIndex++;
                            if(colorIndex%2==0){
                                alterNativeColor='odd';
                            }else{
                                alterNativeColor='even';
                            }

                            try{
                                var addressValue = value._embedded.venues[0].address.line1;
                            }catch(err){
                                addressValue = 'Not Available';
                            }
                            try{
                                var dateValue = value.dates.start.localDate;
                            }catch(err){
                                dateValue = '1111:01:01';
                            }
                            try{
                                var timeValue = value.dates.start.localTime;
                            }catch(err){
                                timeValue = '00:00:00';
                            }
                            try{
                                var cityValue = value._embedded.venues[0].city.name;
                            }catch(err){
                                cityValue = 'Not Available';
                            }
                            try{
                                var countryValue = value._embedded.venues[0].country.name;
                            }catch(err){
                                countryValue = 'Not Available';
                            }
                        
                            
                            tr = `
                                <tr class=${alterNativeColor}>
                                <td><input class='eventid' type='checkbox' id='${value.id}' value='${value.id}' ></td>
                                <td class='ename'><a href='${value.url}'>${value.name}</a></td>
                                <td class='other'>${categoryValue}</td>
                                <td class='other'>${dateValue}</td>
                                <td class='other'>${timeValue}</td>
                                <td class='other'>${cityValue}</td>
                                <td class='other'>${countryValue}</td>
                                <td class='other'>${addressValue}</td>
                                <td class='epic'><img class='eventimg' src='${value.images[0].url}'></td>
                                </tr>
                
                                `;
                            $('#searchOut').append($(tr));
                            $('#insertevents').val('1');
                        }
                    }
                }
            });
            if(count==0) {
                alert('No Event Found.');
                window.location='searchEvent.php';            
            }else {
                $('#searchOut').append(`</table>`);
                $('#category').val('Select').change();
                $('#city').val('').change();
            }

        }
    });
}
    function insertevent(){
        //var category=$('#category').val();
        var tbValue=$('#evTable').val();
        console.log(tbValue);
        $events='';
        $(".eventid").each(function() {
            if($(this).prop('checked') == true){
                var eventid= $(this).attr('id');
                var value = eventsData.find(function (element) {
                    return element.id== eventid;
                });
                var categoryVal=value.classifications[0].segment.name;
                console.log(value);
                console.log(category);
                
                $events ='insertevents=1&eventId='+eventid;
                $events +='&eventName='+ value.name;
                $events +='&eventDate='+value.dates.start.localDate;
                $events +='&eventTime='+value.dates.start.localTime;

                $events +='&city=';
                if(value._embedded.venues[0].city!==undefined)
                $events +=value._embedded.venues[0].city.name;
                else $events +='Undefined';
                $events +='&country=';
                if(value._embedded.venues[0].country!==undefined)
                $events +=value._embedded.venues[0].country.name;
                else $events +='Undefined';
                $events +='&address=';
                if(value._embedded.venues[0].address!==undefined)
                $events +=value._embedded.venues[0].address.line1;
                else $events +='Undefined';

                $events +='&category='+categoryVal;
                $events +='&eventUrl='+value.url;
                $events +='&imageUrl='+value.images[0].url;
                console.log($events);
                $.ajax({
                    url: "service.php?"+$events,
                    type: "GET",
                    success: function(data) {                        
                    }
                });
            }
            
        });
        //window.location='index.php';
    }