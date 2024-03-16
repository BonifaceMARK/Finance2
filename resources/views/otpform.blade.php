@include('layout.title')
<style>
    /* CSS styles for the form */
    .tank {
    max-width: 400px;
    width: 100%;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -90%);
    padding: 20px;
    background-color: #7abcf3;
    border-radius: 8px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}
    h1 {
        font-size: 24px;
        margin-bottom: 20px;
        text-align: flex;
    }

    label {
        display: block;
        margin-bottom: 10px;
    }

    input[type="text"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    button[type="submit"] {
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    button[type="submit"]:hover {
        background-color: #0056b3;
    }
    .error-container {
        margin-top :10px;
        height: 20px;
    }
    .error {
        color: red;
    }
    .foot {
        position: fixed;
        bottom: 0;
        width: 100%;
        text-align: center;
        display: block;
    }
</style>
<main id="main" class="main">
    <div class="tank">
    <h1>Enter the OTP sent to your email</h1>
        <form method="POST" action="{{ route('oauth.validate') }}">
            @csrf
            <label for="entered_otp">Enter OTP:</label>
            <input type="text" name="entered_otp" required>
            <button type="submit">Verify OTP</button>
        </form>
        <div class="error-container">
            @if(session('error'))
            <div class="error">
                {{ session('error') }}
            </div>
            @endif
        </div>
    </div>
</main>
<div class="foot">
    @include('layout.footer')
</div>
