$(document).ready(function() {
    
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

    book_date_from = $(".book-date-from").persianDatepicker({
        "inline": false,
        "format": "HH:mm:ss  YYYY/MM/DD",
        "viewMode": "day",
        "initialValue": false,
        "minDate": false,
        "maxDate": false,
        "autoClose": false,
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
            "enabled": true,
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
            "enabled": false
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
            $('.book-date-to').val('');
            book_date_from.touched = true;
            if (book_date_to && book_date_to.options && book_date_to.options.minDate != unix) {
                var cachedValue = book_date_to.getState().selected.unixDate;
                book_date_to.options = {minDate: unix + 600000};
                if (book_date_to.touched) {
                    book_date_to.setDate(cachedValue);
                }
            }
            book_date_to.options = {minDate: unix + 600000};



            book_date_from_year = new Date(book_date_from.getState().selected.unixDate).getFullYear();
            book_date_from_month = "0" + ( new Date(book_date_from.getState().selected.unixDate).getMonth()+1 );
            book_date_from_monthday = "0" + ( new Date(book_date_from.getState().selected.unixDate).getDate() );
            book_date_from_hours = "0" + new Date(book_date_from.getState().selected.unixDate).getHours();
            book_date_from_minutes = "0" + new Date(book_date_from.getState().selected.unixDate).getMinutes();
            book_date_from_seconds = "0" + new Date(book_date_from.getState().selected.unixDate).getSeconds();

            formattedDate = book_date_from_year + '-' + book_date_from_month.substr(-2) + '-' + book_date_from_monthday.substr(-2) + ' ' + book_date_from_hours.substr(-2) + ':' + book_date_from_minutes.substr(-2) + ':' + book_date_from_seconds.substr(-2) ;

            $('.book-date-from-date').val(formattedDate);
        }
    });

    book_date_to = $(".book-date-to").persianDatepicker({
        "inline": false,
        "format": "HH:mm:ss  YYYY/MM/DD",
        "viewMode": "day",
        "initialValue": false,
        "minDate": false,
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
            "enabled": true,
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
            "enabled": false
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
            book_date_to_year = new Date(book_date_to.getState().selected.unixDate).getFullYear();
            book_date_to_month = "0" + ( new Date(book_date_to.getState().selected.unixDate).getMonth()+1 );
            book_date_to_monthday = "0" + ( new Date(book_date_to.getState().selected.unixDate).getDate() );
            book_date_to_hours = "0" + new Date(book_date_to.getState().selected.unixDate).getHours();
            book_date_to_minutes = "0" + new Date(book_date_to.getState().selected.unixDate).getMinutes();
            book_date_to_seconds = "0" + new Date(book_date_to.getState().selected.unixDate).getSeconds();

            formattedDate = book_date_to_year + '-' + book_date_to_month.substr(-2) + '-' + book_date_to_monthday.substr(-2) + ' ' + book_date_to_hours.substr(-2) + ':' + book_date_to_minutes.substr(-2) + ':' + book_date_to_seconds.substr(-2) ;

            $('.book-date-to-date').val(formattedDate);
        }
    });

    checkin_date_from = $(".checkin-date-from").persianDatepicker({
        "inline": false,
        "format": "YYYY/MM/DD",
        "viewMode": "day",
        "initialValue": false,
        "minDate": false,
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
            $('.checkin-date-to').val('');
            checkin_date_from.touched = true;
            if (checkin_date_to && checkin_date_to.options && checkin_date_to.options.minDate != unix) {
                var cachedValue = checkin_date_to.getState().selected.unixDate;
                checkin_date_to.options = {minDate: unix + 60000};
                if (checkin_date_to.touched) {
                    checkin_date_to.setDate(cachedValue);
                }
            }
            checkin_date_to.options = {minDate: unix + 60000};



            checkin_date_from_year = new Date(checkin_date_from.getState().selected.unixDate).getFullYear();
            checkin_date_from_month = "0" + ( new Date(checkin_date_from.getState().selected.unixDate).getMonth()+1 );
            checkin_date_from_monthday = "0" + ( new Date(checkin_date_from.getState().selected.unixDate).getDate() );

            formattedDate = checkin_date_from_year + '-' + checkin_date_from_month.substr(-2) + '-' + checkin_date_from_monthday.substr(-2);

            $('.checkin-date-from-date').val(formattedDate);
        }
    });

    checkin_date_to = $(".checkin-date-to").persianDatepicker({
        "inline": false,
        "format": "YYYY/MM/DD",
        "viewMode": "day",
        "initialValue": false,
        "minDate": false,
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
            checkin_date_to_year = new Date(checkin_date_to.getState().selected.unixDate).getFullYear();
            checkin_date_to_month = "0" + ( new Date(checkin_date_to.getState().selected.unixDate).getMonth()+1 );
            checkin_date_to_monthday = "0" + ( new Date(checkin_date_to.getState().selected.unixDate).getDate() );

            formattedDate = checkin_date_to_year + '-' + checkin_date_to_month.substr(-2) + '-' + checkin_date_to_monthday.substr(-2);

            $('.checkin-date-to-date').val(formattedDate);
        }
    });
    $(".persianNumber").persiaNumber();

});