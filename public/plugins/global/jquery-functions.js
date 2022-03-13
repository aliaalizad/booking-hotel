$(document).ready(function() {
    

    date_to = $(".date-to").persianDatepicker({
        "inline": false,
        "format": "YYYY/MM/DD",
        "viewMode": "day",
        "initialValue": false,
        "minDate": new persianDate().add("d",1),
        "maxDate": false,
        "autoClose": true,
        "position": "auto",
        "altFormat": "YYYY-MM-DD",
        "altField": "#altfieldExample",
        "onlyTimePicker": false,
        "onlySelectOnDate": false,
        "calendarType": "persian",
        "inputDelay": 800,
        "observer": false,
        "calendar": {
            "persian": {
            "locale": "fa",
            "showHint": true,
            "leapYearMode": "algorithmic"
            },
            "gregorian": {
            "locale": "en",
            "showHint": false
            }
        },
        "navigator": {
            "enabled": true,
            "scroll": {
            "enabled": true
            },
            "text": {
            "btnNextText": "<",
            "btnPrevText": ">"
            }
        },
        "toolbox": {
            "enabled": false,
            "calendarSwitch": {
            "enabled": false,
            "format": "MMMM"
            },
            "todayButton": {
            "enabled": false,
            "text": {
                "fa": "امروز",
                "en": "Today"
            }
            },
            "submitButton": {
            "enabled": false,
            "text": {
                "fa": "تایید",
                "en": "Submit"
            }
            },
            "text": {
            "btnToday": "امروز"
            }
        },
        "timePicker": {
            "enabled": false,
            "step": 1,
            "hour": {
            "enabled": true,
            "step": null
            },
            "minute": {
            "enabled": true,
            "step": null
            },
            "second": {
            "enabled": true,
            "step": null
            },
            "meridian": {
            "enabled": true
            }
        },
        "dayPicker": {
            "enabled": true,
            "titleFormat": "YYYY MMMM"
        },
        "monthPicker": {
            "enabled": true,
            "titleFormat": "YYYY"
        },
        "yearPicker": {
            "enabled": true,
            "titleFormat": "YYYY"
        },
        "responsive": true,

        onSelect: function () {
            date_to_year = new Date(date_to.getState().selected.unixDate).getFullYear();
            date_to_month = "0" + ( new Date(date_to.getState().selected.unixDate).getMonth()+1 );
            date_to_monthday = "0" + ( new Date(date_to.getState().selected.unixDate).getDate() );

            formattedDate = date_to_year + '-' + date_to_month.substr(-2) + '-' + date_to_monthday.substr(-2);

            $('.date-to-date').val(formattedDate);
        }
    });

    date_from = $(".date-from").persianDatepicker({
        "inline": false,
        "format": "YYYY/MM/DD",
        "viewMode": "day",
        "initialValue": false,
        "minDate": new persianDate(),
        "maxDate": false,
        "autoClose": true,
        "position": "auto",
        "altFormat": "YYYY-MM-DD",
        "altField": "#altfieldExample",
        "onlyTimePicker": false,
        "onlySelectOnDate": false,
        "calendarType": "persian",
        "inputDelay": 800,
        "observer": false,
        "calendar": {
            "persian": {
            "locale": "fa",
            "showHint": true,
            "leapYearMode": "algorithmic"
            },
            "gregorian": {
            "locale": "en",
            "showHint": false
            }
        },
        "navigator": {
            "enabled": true,
            "scroll": {
            "enabled": true
            },
            "text": {
            "btnNextText": "<",
            "btnPrevText": ">"
            }
        },
        "toolbox": {
            "enabled": false,
            "calendarSwitch": {
            "enabled": false,
            "format": "MMMM"
            },
            "todayButton": {
            "enabled": false,
            "text": {
                "fa": "امروز",
                "en": "Today"
            }
            },
            "submitButton": {
            "enabled": false,
            "text": {
                "fa": "تایید",
                "en": "Submit"
            }
            },
            "text": {
            "btnToday": "امروز"
            }
        },
        "timePicker": {
            "enabled": false,
            "step": 1,
            "hour": {
            "enabled": true,
            "step": null
            },
            "minute": {
            "enabled": true,
            "step": null
            },
            "second": {
            "enabled": true,
            "step": null
            },
            "meridian": {
            "enabled": true
            }
        },
        "dayPicker": {
            "enabled": true,
            "titleFormat": "YYYY MMMM"
        },
        "monthPicker": {
            "enabled": true,
            "titleFormat": "YYYY"
        },
        "yearPicker": {
            "enabled": true,
            "titleFormat": "YYYY"
        },
        "responsive": true,

        onSelect: function (unix) {
            $('.date-to').val('');
            date_from.touched = true;
            if (date_to && date_to.options && date_to.options.minDate != unix) {
                var cachedValue = date_to.getState().selected.unixDate;
                date_to.options = {minDate: unix + 86400000};
                if (date_to.touched) {
                    date_to.setDate(cachedValue);
                }
            }
            date_to.options = {minDate: unix + 86400000};



            date_from_year = new Date(date_from.getState().selected.unixDate).getFullYear();
            date_from_month = "0" + ( new Date(date_from.getState().selected.unixDate).getMonth()+1 );
            date_from_monthday = "0" + ( new Date(date_from.getState().selected.unixDate).getDate() );

            formattedDate = date_from_year + '-' + date_from_month.substr(-2) + '-' + date_from_monthday.substr(-2);

            $('.date-from-date').val(formattedDate);
        }
    });

    $(".persianNumber").persiaNumber();

});