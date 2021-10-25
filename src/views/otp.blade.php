<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
</head>

<body>
    <div>
        <div id="otpForm">
            <h1>OTP Verification</h1>
            <form id="form">
                @csrf
                <div class="form-group">
                    <label class="control-label" style="margin-right:50px;"> Phone Number</label>
                    <input type="number" class="form-control-wrap" name="number" maxlength="10" id="number">
                </div>
                <div class="form-group" style="margin-top:30px;">
                    <label class="control-label" style="margin-right:40px;"> Enter Your OTP</label>
                    <input type="text" class="form-control-wrap" name="otp" maxlength="6" id="otp" disabled>
                </div>
                <div class="form-group" style="margin-top:30px;">
                    <a style="text-decoration:none;"><button type="button" id="sendOtp">Send</button></a>
                    <a style="text-decoration:none;"><button type="button" id="resendOtp">Resend</button></a>
                    <button type="submit" id="verifyOtp">Verify</button>
                </div>
            </form>
        </div>
    </div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#resendOtp").attr('style', 'visibility:hidden;');
        $("#verifyOtp").attr('style', 'visibility:hidden;');

        $('#sendOtp').click(function(e) {
            var number = $('input[name="number"]').val();
            $.ajax({
                url: "{{ route('web.sendOtp') }}",
                type: 'POST',
                data: {
                    'phone': number
                },
                success: function(response) {
                    if (response.data == "success") {
                        alert("OTP sent successfully.");
                        $("#number").attr('readonly',true);
                        $("#sendOtp").remove();
                        $("#otp").removeAttr('disabled');
                        $("#resendOtp").attr('style', 'visibility:visible;');
                        $("#verifyOtp").attr('style', 'visibility:visible;');
                    } else {
                        alert("OTP not sent. Try submitting again.")
                    }
                },
                error: function(response) {
                    alert("Some error occured");
                }
            });
        });

        $('#resendOtp').click(function(e) {
            var number = $('input[name="number"]').val();
            $.ajax({
                url: "{{ route('web.resendOtp') }}",
                type: 'POST',
                data: {
                    'phone': number
                },
                success: function(response) {
                    if (response.data == "success") {
                        alert("OTP resend successfully.");
                    } else {
                        alert("OTP not send. Try submitting again.")
                    }
                },
                error: function(response) {
                    alert("Some error occured");
                }
            });
        });

        $('#verifyOtp').click(function(e) {
            var number = $('input[name="number"]').val();
            var otp =parseInt( $('input[name="otp"]').val());
            $.ajax({
                url: "{{ route('web.verifyOtp') }}",
                type: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'phone': number,
                    'otp': otp
                },
                success: function(response) {
                    if (response.data == "success") {
                        alert("Your Number is Successfully Verified");
                    } else {
                        alert("Entered wrong OTP");
                    }
                },
                error: function(response) {
                    alert("Some error occured");
                }
            });
        });
    });
</script>

</html>