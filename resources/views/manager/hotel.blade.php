<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hotel | {{ $hotel->id }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

</head>
<style>
/* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

</style>

<body>
    <div class="registration-form">
        <form action="{{ route('manager.hotels.update', $hotel->id) }}" method="post" autocomplete="off">
            @csrf
            @method("PUT")

            <div class="form-icon">
                <span><i class="icon icon-user"></i></span>
            </div>
            
            <div class="form-group">
                <input type="text" class="form-control item" name="name" id="name" placeholder="Name" value="{{ $hotel->name }}">
                @if ($errors->has('name'))
                    @error('name') 
                        <div style="color: red;">{{ $message }}</div>
                    @enderror
                @endif
            </div>

            <div class="form-group">
                <input type="text" class="form-control item" name="phone" id="phone" placeholder="Phone" value="{{ $hotel->phone }}">
                @if ($errors->has('phone'))
                    @error('name') 
                        <div style="color: red;">{{ $message }}</div>
                    @enderror
                @endif
            </div>
            
            <div class="form-group">
                <input type="text" class="form-control item" name="city" id="city" placeholder="City" value="{{ $hotel->city_id }}">
                @if ($errors->has('city'))
                    @error('name') 
                        <div style="color: red;">{{ $message }}</div>
                    @enderror
                @endif
            </div>
            
            <div class="form-group">
                <input type="text" class="form-control item" name="address" id="address" placeholder="Address" value="{{ $hotel->address }}">
                @if ($errors->has('address'))
                    @error('name') 
                        <div style="color: red;">{{ $message }}</div>
                    @enderror
                @endif
            </div>

            <div class="form-group">
                <Label for="members">Members</Label>
                
                <select class="js-example-basic-multiple" style="width: 100%;" name="members[]"  id="members" multiple>
                    @foreach ( $hotel_members as $hotel_member )
                        <option value="{{ $hotel_member->id }}" selected> {{ $hotel_member->name . " ($hotel_member->personnel_code)" }} </option>
                    @endforeach
                    @foreach ( $available_members as $available_member )
                        <option value="{{ $available_member->id }}"> {{ $available_member->name . " ($available_member->personnel_code)" }} </option>
                    @endforeach
                </select>

                @if ($errors->has('members'))
                    @error('members')
                        <div style="color: red;">{{ $message }}</div>
                    @enderror
                @endif

                @if ($errors->has('members.*'))
                    @error('members.*')
                        <div style="color: red;">{{ $message }}</div>
                    @enderror
                @endif
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-block create-account">Update</button>
            </div>

        </form>
    </div>
    <div class="registration-form"">
        <form action="{{ route('manager.hotels.destroy', $hotel->id) }}" method="post">
                @csrf
                @method("DELETE")
                
                <div class="form-group">
                    <button type="submit" class="btn btn-block create-account">Delete</button>
                </div>
        </form>
    </div>
    
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="/js/script.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>

</body>
</html>
