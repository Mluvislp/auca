@extends('backend.layout.layout')

@section('title')
    kết nối lazada
@endsection

@section('style')
    <style>
        .perfect-scrollbar-example {
            position: relative;
        }
    </style>
@endsection

@section('content')
    <div class="page-content">
        <h1>Connect Sucessfully</h1>
    </div>
@endsection

@section('script')
    <script>
        var scrollbarExample = new PerfectScrollbar('.perfect-scrollbar-example');
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>

    <script type="text/javascript">

        const currentURL = window.location.href;


        const paramsArray = currentURL.split('?')[1].split('&');

        const paramsObject = {};

        paramsArray.forEach(param => {
            const [key, value] = param.split('=');
            paramsObject[key] = value;
        });
       
        // Lấy giá trị của tham số code
        const codeValue = paramsObject['code'];
        console.log(codeValue)
        const appSecret = "8yKAGKZRvrDvJ1DkGI1cMnEtmEjKvJfL"; // Thay YOUR_APP_SECRET bằng mật khẩu ứng dụng của bạn
        const signRequest = (appSecret, apiPath, params) => {
            // 1. Sort all request parameters (except the “sign” and parameters with byte array type)
            const keysortParams = keysort(params);

            // 2. Concatenate the sorted parameters into a string i.e. "key" + "value" + "key2" + "value2"...
            const concatString = concatDictionaryKeyValue(keysortParams);

            // 3. Add API name in front of the string in (2)
            const preSignString = apiPath + concatString;

            // 4. Encode the concatenated string in UTF-8 format & and make a digest (HMAC_SHA256)
            const hash = CryptoJS.HmacSHA256(preSignString, appSecret);

            // 5. Convert the digest to hexadecimal format
            const signature = CryptoJS.enc.Hex.stringify(hash);

            return signature.toUpperCase(); // must use upper case
        };
        const keysort = (unordered) => {
            return Object.keys(unordered)
                .sort()
                .reduce((ordered, key) => {
                    ordered[key] = unordered[key];
                    return ordered;
                }, {});
        };
        const concatDictionaryKeyValue = (object) => {
            return Object.keys(object).reduce(
                (concatString, key) => concatString.concat(key + object[key]),
                ''
            );
        };
        function AuthByCode() {
            var paramenter = {
                code: codeValue,
            };

            $.ajax({
                url: "https://node.hannguhiendai.com/lazada/connector",
                type: 'GET',
                data: paramenter,
                success: function(response) {
                    console.log(response.data)
                    if(response.data.access_token) {
                        localStorage.setItem('Token_lazada', response.data.access_token);
                    }
                }

            });
        }
        AuthByCode()
    </script>
@endsection
