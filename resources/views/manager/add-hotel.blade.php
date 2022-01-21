<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Hotel</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>
<body>
    <div class="registration-form">
        <form action="{{ route('manager.hotels.store') }}" method="post" autocomplete="off">
            @csrf

            <div class="form-icon">
                <span><i class="icon icon-user"></i></span>
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" name="name" id="name" placeholder="Name" value="{{ old('name') }}">

                @if ($errors->has('name'))
                    @error('name')
                        <div style="color: red;">{{ $message }}</div>
                    @enderror
                @endif
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" name="phone" id="phone" placeholder="Phone" value="{{ old('phone') }}">
                @if ($errors->has('phone'))
                    @error('phone')
                        <div style="color: red;">{{ $message }}</div>
                    @enderror
                @endif
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" name="city" id="city" placeholder="City" value="{{ old('city') }}">
                @if ($errors->has('city'))
                    @error('city')
                        <div style="color: red;">{{ $message }}</div>
                    @enderror
                @endif
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" name="address" id="address" placeholder="Address" value="{{ old('address') }}">
                @if ($errors->has('address'))
                    @error('address')
                        <div style="color: red;">{{ $message }}</div>
                    @enderror
                @endif
            </div>
            <div class="form-group">
                <Label for="members">Members</Label>
                
                <select class="js-example-basic-multiple" style="width: 100%;" name="members[]"  id="members" multiple>
                    @foreach ( $members as $member )
                        <option value="{{ $member->id }}"> {{ $member->name . " ($member->personnel_code)" }} </option>
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
                <button type="submit" class="btn btn-block create-account">Add</button>
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
