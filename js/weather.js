$(function () {
    getAMKForecast();
});

function getAMKForecast() {
    $.ajax({
        url: "https://api.data.gov.sg/v1/environment/2-hour-weather-forecast",
        method: "get"
    })
        .done(
            /*
            NEA's data service returns forecasted weather in its data.items[o].forecasts array of objects
            Each object has two properties: area and forecast.
            So it looks like this : { area: "Ang Mo Kio", forecast: "Light Showers" },{area: "Bedok", forecast: "Light Showers"}, .....
            */
            function (data) { // unpack data from NEA's data.gov.sg service.               
                let twohrRaw = data.items[0].forecasts; //get 2hr forecast information and store in array.
                for (let i = 0; i < twohrRaw.length; i++) { // we search for location = "Ang Mo Kio" to get Makando's weather forecast
                    let loc = twohrRaw[i]; // assign to a variable for each location
                    if (loc.area == "Ang Mo Kio") {
                        let str = "Current weather at our AMK location is '" + loc.forecast + "'. Please note that rainy conditions may delay our delivery services, please be patient with us. Thank you!";
                        $("#weather").html(str);
                    }
                }
            }
        )
        .fail(
            function (err) {
                $("#weather").html("Current weather at our AMK location is not available from NEA.");
            }
        )
}
