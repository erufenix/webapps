$(document).ready(function () {
    var country_list_url = LocationManagement_country_Url + "";
    var city_list_url = LocationManagement_country_Url + "/cities";
    var airport_list_url = LocationManagement_country_Url + "/airports";
    //?searchText={searchText}&country={country}&pageSize={pageSize}&pageNum={pageNum}

    ///----------------------------------------------------------------------------------------------------------
    /// Bindding event to html control
    ///-----------------------------------------------------------------------------------------------------------
    AppInit();


    /// --------------------------------------------------------------------------------------------------------
    /// Main method (Entry point of this application)
    /// --------------------------------------------------------------------------------------------------------
    function AppInit() {
        $.mobile.showPageLoadingMsg("a", "Loading ...");
        // Login and init state
        $.GetAccessTokenKey(function () {
            GetCountryList();
        });
    }

    /// --------------------------------------------------------------------------------------------------------
    /// ajax call - Get CountryList  
    /// --------------------------------------------------------------------------------------------------------
    function GetCountryList() {
        var country_list_url_updated = country_list_url + "?pageSize=0&pageNum=0&searchText=&fields=";
        $.ajaxExec({
            url: country_list_url_updated,
            success: function (data) {
                ShowCountryList(data.data);
                $.mobile.hidePageLoadingMsg();
            }
        });
    }

    /// --------------------------------------------------------------------------------------------------------
    /// bind countries json to list
    /// --------------------------------------------------------------------------------------------------------
    function ShowCountryList(data) {

        // For each data item
        $.each(data, function (index, rawSelectedItem) {
        	var selectedItem = rawSelectedItem.attributes;
            $('#countryList').append(PopulateCountryItem(selectedItem));
        });

        // Apply to view
        $('#countryList').listview('refresh');
        $('#countryList').show();
    }

    /// --------------------------------------------------------------------------------------------------------
    /// populate country row
    /// --------------------------------------------------------------------------------------------------------
    function PopulateCountryItem(selectedItem) {

        var result = JSON.stringify(selectedItem, undefined, 2);
        var record = '<li data-identity="' + selectedItem.Code2 + '" data-icon="false"><a href="#"><img src="' + selectedItem.FlagUrlRound + '_128.png"  ';
        record += '  class="ui-li-icon ui-corner-none">' + selectedItem.Name + ' (' + selectedItem.Code3 + ')   </a> ' +
        '<pre id="drCountry-' + selectedItem.Code2 + '" style="display:none;">' + result + '</pre> </li>';
        return record;
    }


    /// --------------------------------------------------------------------------------------------------------
    /// Declare event for countryList list item
    /// --------------------------------------------------------------------------------------------------------
    $('#countryList').delegate('li', 'click', function () {
        var code = $(this).data('identity');

        var sJson = $('#drCountry-' + code).html();

        $('#cityList li').remove();
        $('#airportList li').remove();

        //  alert(sJson);
        var jJson = JSON.parse(sJson);


        $.mobile.changePage($("#pageCityList"), "none");

        if (code != '') {

            $('#hCityPageHeader').html(jJson.Name);

            $('#lblCountryID').val(jJson.Name);

            $('#lblName').html(jJson.Name);
            $('#lblCode').html(jJson.Code2);
            $('#lblCapitalCity').html(jJson.CapitalCity);
            $('#lblCityIDD').html(jJson.IDD);

            $('#imgFlag').attr("src", jJson.FlagUrlRect + '_128.png');

            GetCityList(jJson.Code2, '');

        }
    });


    /// --------------------------------------------------------------------------------------------------------
    /// ajax call - Get CityList  
    /// --------------------------------------------------------------------------------------------------------
    function GetCityList(country, searchtext) {

        $.mobile.showPageLoadingMsg("a", "Loading ...");

        // var city_list_url_updated = city_list_url + "?searchText=" + searchtext + "&countryCode=" + country + "&pageSize=200&pageNum=1";
        var city_list_url_updated = city_list_url + "?searchText=" + searchtext + "&countryCode=" + country + "&pageSize=200&pageNum=1";
        $.ajaxExec({
            url: city_list_url_updated,
            success: function (data) {
                // $.log(JSON.stringify(data.data));
                ShowCityList(data.data);

                $.mobile.hidePageLoadingMsg();
            }
        });
    }

    /// --------------------------------------------------------------------------------------------------------
    /// bind citys json to table
    /// --------------------------------------------------------------------------------------------------------
    function ShowCityList(data) {

        $('#cityList li').remove();
        // For each data item
        $.each(data, function (index, rawSelectedItem) {
        	var selectedItem = rawSelectedItem.attributes; 
            $('#cityList').append(PopulateCityItem(selectedItem));
        });

        // Apply to view
        $('#cityList').listview('refresh');
    }

    /// --------------------------------------------------------------------------------------------------------
    /// populate city row
    /// --------------------------------------------------------------------------------------------------------
    function PopulateCityItem(selectedItem) {

        var result = JSON.stringify(selectedItem, undefined, 2);

        var record = '<li data-identity="' + selectedItem.ID + '" data-icon="false"><a href="#pageCityDetails"> ' + selectedItem.CityName + '  </a>' +
                     '<pre id="drCity-' + selectedItem.ID + '" style="display:none;">' + result + '</pre> </li>';
        return record;
    }

    /// --------------------------------------------------------------------------------------------------------
    /// Declare event for countryList list item
    /// --------------------------------------------------------------------------------------------------------
    $('#cityList').delegate('li', 'click', function () {
        var id = $(this).data('identity');

        var sJson = $('#drCity-' + id).html();

        // alert(sJson);

        var jJson = JSON.parse(sJson);


        if (id > 0) {
            $('#lblCityName2').html(jJson.CityName);
            $('#lblCityCountry').html(jJson.CountryObj.Name);
            $('#lblCityLatitude').html(jJson.Latitude);
            $('#lblCityLongitude').html(jJson.Longitude);

            if (jJson.SuSubDivisionObj != null) {

                var a = moment.tz(new Date(), jJson.SuSubDivisionObj.TimeZone);
                //  alert(a.format('YYYY-MM-DD HH:mm')); // 2013-11-18T11:55:00-05:00 

                $('#lblCityTimeZone').html(jJson.SuSubDivisionObj.TimeZone);
                $('#lblCitySubDivision').html(jJson.SuSubDivisionObj.Name);
                $('#lblCityCurrentTime').html(a.format('YYYY-MM-DD HH:mm'));
                $('#lblCityGMT').html(a.format('Z z'));

                $('#fclblCityTimeZone').removeAttr("style", "display:none;");
                $('#fclblCityCurrentTime').removeAttr("style", "display:none;");
                $('#fclblCitySubDivision').removeAttr("style", "display:none;");
                $('#fclblCityGMT').removeAttr("style", "display:none;");


            } else {
               
                $('#fclblCityTimeZone').attr("style", "display:none;");
                $('#fclblCitySubDivision').attr("style", "display:none;");
                $('#fclblCityCurrentTime').attr("style", "display:none;");
                $('#fclblCityGMT').attr("style", "display:none;");
            }

            $('#hCityDetails').html("City Details - " + jJson.CityName);

            SetMapSettings(jJson.Latitude, jJson.Longitude, jJson.CityName);

        }
    });
    $("#btnCitySearch").click(function () {

        GetCityList($("#lblCode").html(), $("#txtCitySearch").val());
    });

    $('#pageCityDetails').on('pageshow', function (event) {
        initialize('map_canvas_city');
    });

    $("#btnViewAirports").click(function () {

        $.mobile.changePage($("#pageAirportList"), "none");


        $.mobile.showPageLoadingMsg("a", "Loading ...");

        $('#hlblCodeAirportPageHeader').html($('#hlblCodeCityPageHeader').html());


        $('#lblNameAirport').html($('#lblName').html());
        $('#lblCodeAirport').html($('#lblCode').html());
        $('#lblCapitalAirport').html($('#lblCapitalCity').html());

        $('#imgFlagAirport').attr("src", $('#imgFlag').attr("src"));

        GetAirportList($("#lblCode").html(), '')
    });

    // Airport //////////////////////////


    /// --------------------------------------------------------------------------------------------------------
    /// ajax call - Get AirportList  
    /// --------------------------------------------------------------------------------------------------------
    function GetAirportList(country, searchtext) {

        $.mobile.showPageLoadingMsg("a", "Loading ...");

        var airport_list_url_updated = airport_list_url + "?searchText=" + searchtext + "&countryCode=" + country + "&type=&pageSize=200&pageNum=1";
        $.ajaxExec({
            url: airport_list_url_updated,
            success: function (data) {
                // $.log(JSON.stringify(data.data));
                ShowAirportList(data.data);

                $.mobile.hidePageLoadingMsg();
            }
        });
    }

    /// --------------------------------------------------------------------------------------------------------
    /// bind airports json to table
    /// --------------------------------------------------------------------------------------------------------
    function ShowAirportList(data) {

        $('#airportList li').remove();
        // For each data item
        $.each(data, function (index, rawSelectedItem) {
        	var selectedItem = rawSelectedItem.attributes;
            $('#airportList').append(PopulateAirportItem(selectedItem));
        });

        // Apply to view
        $('#airportList').listview('refresh');
    }

    /// --------------------------------------------------------------------------------------------------------
    /// populate airport row
    /// --------------------------------------------------------------------------------------------------------
    function PopulateAirportItem(selectedItem) {

        var result = JSON.stringify(selectedItem, undefined, 2);

        var record = '<li data-identity="' + selectedItem.ID + '" data-icon="false"><a href="#pageAirportDetails"> ' + selectedItem.Name + '  </a>' +
                     '<pre id="drAirport-' + selectedItem.ID + '" style="display:none;">' + result + '</pre> </li>';
        return record;
    }

    /// --------------------------------------------------------------------------------------------------------
    /// Declare event for countryList list item
    /// --------------------------------------------------------------------------------------------------------
    $('#airportList').delegate('li', 'click', function () {
        var id = $(this).data('identity');

        var sJson = $('#drAirport-' + id).html();

        // alert(sJson);

        var jJson = JSON.parse(sJson);


        if (id > 0) {
            $('#lblAirportName2').html(jJson.Name);
            $('#lblAirportType').html(jJson.Type);
            $('#lblAirportMunicipality').html(jJson.Municipality);
            $('#lblAirportCountry').html(jJson.Country.Name);
            $('#lblAirportMunicipality').html(jJson.Municipality);
            $('#lblAirportIdent').html(jJson.Ident);

            $('#lblAirportLatitude').html(jJson.Latitude);
            $('#lblAirportLongitude').html(jJson.Longitude);

            $('#hAirportDetails').html("Airport Details - " + jJson.Name);

            SetMapSettings(jJson.Latitude, jJson.Longitude, jJson.Name);

        }
    });
    $("#btnAirportSearch").click(function () {

        GetAirportList($("#lblCode").html(), $("#txtAirportSearch").val());
    });

    $('#pageAirportDetails').on('pageshow', function (event) {
        initialize('map_canvas_airport');
    });


    function initialize(divMap) {
        geocoder = new google.maps.Geocoder();
        //  alert(Lat+'-'+ Lng);
        var latlng = new google.maps.LatLng(Lat, Lng);
        var myOptions = {
            zoom: 15,
            center: latlng,
            mapTypeControl: true,
            mapTypeControlOptions: { style: google.maps.MapTypeControlStyle.DROPDOWN_MENU },
            navigationControl: true,
            scrollwheel: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById(divMap), myOptions);
        if (geocoder) {
            geocoder.geocode({ 'address': Address }, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {
                        map.setCenter(results[0].geometry.location);

                        var infowindow = new google.maps.InfoWindow(
                            {
                                content: '<b>' + Address + '</b>',
                                size: new google.maps.Size(600, 400)
                            });

                        var marker = new google.maps.Marker({
                            position: results[0].geometry.location,
                            map: map,
                            title: Address
                        });
                        google.maps.event.addListener(marker, 'click', function () {
                            infowindow.open(map, marker);
                        });

                    } else {
                        alert("No results found");
                    }
                } else {
                    alert("Geocode was not successful for the following reason: " + status);
                }
            });
        }
    }


    var Lat = 0;
    var Lng = 0;
    var geocoder;
    var map;
    var Address = "6 Westbury Crescent Remuera NZ";

    function SetMapSettings(lat, lng, address) {

        Lat = lat;
        Lng = lng;
        Address = address;

    }

});