

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
            $('table').empty();
            $('#tbody').empty();
            
            eventsData=data._embedded.events;
            var tr = `<tr>
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
            $('table').append($(tr));
            var colorIndex=0;
            var alterNativeColor='even';
            $.each(data._embedded.events, function (index, value) {
                console.log(value._embedded.venues[0].city.name);
                console.log(searchCity);
                var categoryFood=value.classifications[0].segment.name;
                if(category=='food')
                    categoryFood ='Food';
                if(searchCity==''||value._embedded.venues[0].city.name==searchCity){
                    if(category==' ' && (value.classifications[0].segment.name=='Food'|| value.classifications[0].segment.name=='Music' || value.classifications[0].segment.name=='Sports'))
                    { 

                    }else{
                        colorIndex++;
                        if(colorIndex%2==0){
                            alterNativeColor='odd';
                        }else{
                            alterNativeColor='even';
                        }
                        if(value._embedded.venues[0].address.line1==undefined)
                        {tr = `
                        <tr class=${alterNativeColor}>
                        <td><input class='eventid' type='checkbox' id='${value.id}' value='${value.id}' ></td>
                        <td class='ename'><a href='${value.url}'>${value.name}</a></td>
                        <td class='other'>${categoryFood}</td>
                        <td class='other'>${value.dates.start.localDate}</td>
                        <td class='other'>${value.dates.start.localTime}</td>
                        <td class='other'>${value._embedded.venues[0].city.name}</td>
                        <td class='other'>${value._embedded.venues[0].country.name}</td>
                        <td class='other'>Not Available</td>
                        <td class='epic'><img class='eventimg' src='${value.images[0].url}'></td>
                        </tr>
        
                        `;}
                        else{
                    tr = `
                            <tr class=${alterNativeColor}>
                            <td><input class='eventid' type='checkbox' id='${value.id}' value='${value.id}' ></td>
                            <td class='ename'><a href='${value.url}'>${value.name}</a></td>
                            <td class='other'>${categoryFood}</td>
                            <td class='other'>${value.dates.start.localDate}</td>
                            <td class='other'>${value.dates.start.localTime}</td>
                            <td class='other'>${value._embedded.venues[0].city.name}</td>
                            <td class='other'>${value._embedded.venues[0].country.name}</td>
                            <td class='other'>${value._embedded.venues[0].address.line1}</td>
                            <td class='epic'><img class='eventimg' src='${value.images[0].url}'></td>
                            </tr>
            
                            `;}
                        $('table').append($(tr));
                        $('#insertevents').val('1');
                    }
                }
            });

            }
    });
}
    function insertevent(){
        var category=$('#category').val();
        
        $events='';
        $(".eventid").each(function() {
            if($(this).prop('checked') == true){
                var eventid= $(this).attr('id');
                var value = eventsData.find(function (element) {
                    return element.id== eventid;
                });
                if(category==' ') category=value.classifications[0].segment.name;
                console.log(value);
                
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

                $events +='&category='+category;
                $events +='&eventUrl='+value.url;
                $events +='&imageUrl='+value.images[0].url;
                console.log($events);
                $.ajax({
                    url: "service.php?"+$events,
                    type: "GET",
                    success: function(data) {
                        if(data==='success'){
                            window.location='index.php';
                        }
                    }
                });
            }

        });
    }