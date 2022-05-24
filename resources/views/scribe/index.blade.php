<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Cart</title>

    <link href="https://fonts.googleapis.com/css?family=PT+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@10.7.2/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@10.7.2/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
            </style>

    <script>
        var baseUrl = "http://127.0.0.1:8000";
        var useCsrf = Boolean();
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("vendor/scribe/js/tryitout-3.22.0.js") }}"></script>

    <script src="{{ asset("vendor/scribe/js/theme-default-3.22.0.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img loading="lazy" src="{{ asset("vendor/scribe/images/navbar.png") }}" alt="navbar-image" />
    </span>
</a>
<div class="tocify-wrapper">
            <img loading="lazy" src="logo.png" alt="logo" class="logo" style="padding-top: 10px;" width="230px"/>

            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                    </div>

    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                                                                            <ul id="tocify-header-0" class="tocify-header">
                    <li class="tocify-item level-1" data-unique="introduction">
                        <a href="#introduction">Introduction</a>
                    </li>

                                                                    </ul>
                                                <ul id="tocify-header-1" class="tocify-header">
                    <li class="tocify-item level-1" data-unique="authenticating-requests">
                        <a href="#authenticating-requests">Authenticating requests</a>
                    </li>

                                                </ul>

                    <ul id="tocify-header-2" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authentication">
                    <a href="#authentication">Authentication</a>
                </li>
                                    <ul id="tocify-subheader-authentication" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="authentication-GETapi-v1-login">
                        <a href="#authentication-GETapi-v1-login">Login.</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="authentication-POSTapi-v1-register">
                        <a href="#authentication-POSTapi-v1-register">Regsiter</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="authentication-GETapi-v1-otpverify">
                        <a href="#authentication-GETapi-v1-otpverify">OTP Verify</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="authentication-POSTapi-v1-otpresend">
                        <a href="#authentication-POSTapi-v1-otpresend">OTP Resend</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="authentication-POSTapi-v1-logout">
                        <a href="#authentication-POSTapi-v1-logout">Log out</a>
                    </li>
                                                    </ul>
                            </ul>
                    <ul id="tocify-header-3" class="tocify-header">
                <li class="tocify-item level-1" data-unique="checkout">
                    <a href="#checkout">Checkout</a>
                </li>
                                    <ul id="tocify-subheader-checkout" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="checkout-GETapi-v1-getcost">
                        <a href="#checkout-GETapi-v1-getcost">Shipping Cost</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="checkout-POSTapi-v1-getpromocode">
                        <a href="#checkout-POSTapi-v1-getpromocode">PromoCode</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="checkout-POSTapi-v1-getaddress">
                        <a href="#checkout-POSTapi-v1-getaddress">Address</a>
                    </li>
                                                    </ul>
                            </ul>
                    <ul id="tocify-header-4" class="tocify-header">
                <li class="tocify-item level-1" data-unique="endpoints">
                    <a href="#endpoints">Endpoints</a>
                </li>
                                    <ul id="tocify-subheader-endpoints" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="endpoints-GETapi-user">
                        <a href="#endpoints-GETapi-user">GET api/user</a>
                    </li>
                                                    </ul>
                            </ul>
                    <ul id="tocify-header-5" class="tocify-header">
                <li class="tocify-item level-1" data-unique="general">
                    <a href="#general">General</a>
                </li>
                                    <ul id="tocify-subheader-general" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="general-GETapi-v1-welcome">
                        <a href="#general-GETapi-v1-welcome">Welcome Page</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="general-GETapi-v1-getarea">
                        <a href="#general-GETapi-v1-getarea">Get Area</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="general-POSTapi-v1-checkpincode">
                        <a href="#general-POSTapi-v1-checkpincode">Get Servicability</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="general-GETapi-v1-category">
                        <a href="#general-GETapi-v1-category">Category</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="general-GETapi-v1-brand">
                        <a href="#general-GETapi-v1-brand">Brand</a>
                    </li>
                                                    </ul>
                            </ul>
                    <ul id="tocify-header-6" class="tocify-header">
                <li class="tocify-item level-1" data-unique="product">
                    <a href="#product">Product</a>
                </li>
                                    <ul id="tocify-subheader-product" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="product-POSTapi-v1-postreview">
                        <a href="#product-POSTapi-v1-postreview">Post a Review</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="product-GETapi-v1-products--name-">
                        <a href="#product-GETapi-v1-products--name-">Product View</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="product-GETapi-v1-newproducts">
                        <a href="#product-GETapi-v1-newproducts">New Product</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="product-GETapi-v1-trendingproducts">
                        <a href="#product-GETapi-v1-trendingproducts">Trending Product</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="product-GETapi-v1-topselling">
                        <a href="#product-GETapi-v1-topselling">Top Selling</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="product-POSTapi-v1-cart-add">
                        <a href="#product-POSTapi-v1-cart-add">Add to Cart</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="product-POSTapi-v1-wishlist-add">
                        <a href="#product-POSTapi-v1-wishlist-add">Add to Wishlist</a>
                    </li>
                                                    </ul>
                            </ul>


            </div>

            <ul class="toc-footer" id="toc-footer">
                            <li><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                            <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
                    </ul>
        <ul class="toc-footer" id="last-updated">
        <li>Last updated: February 21 2022</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<p>Api is for the API part for mobile development</p>
<p>This documentation aims to provide all the information you need to work with our API.</p>
<aside>As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).</aside>
<blockquote>
<p>Base URL</p>
</blockquote>
<pre><code class="language-yaml">http://127.0.0.1:8000</code></pre>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>This API is not authenticated.</p>

        <h1 id="authentication">Authentication</h1>



            <h2 id="authentication-GETapi-v1-login">Login.</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-login">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/v1/login" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"email\": \"beimqznhfpncduopkeagurgwzfzldrtxmukmivrixqsxduxddtlsyjhviitpabdtchfnaxqueyszivckmpfsnsfbzoegixfeksmblawlko\",
    \"password\": \"midvhwyqztx\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/v1/login"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "beimqznhfpncduopkeagurgwzfzldrtxmukmivrixqsxduxddtlsyjhviitpabdtchfnaxqueyszivckmpfsnsfbzoegixfeksmblawlko",
    "password": "midvhwyqztx"
};

fetch(url, {
    method: "GET",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-login">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json">{
 &quot;success&quot;: true,
 &quot;message&quot;: &quot;Sucess&quot;,
 &quot;data&quot;: {
         &quot;id&quot;:&quot;1&quot;,
         &quot;name&quot;:&quot;xxxxxx&quot;,
         &quot;email&quot;:&quot;xxxxxx@gmail.com&quot;,
         &quot;phno&quot;:&quot;88xxxxxxx1&quot;,
         &quot;token&quot;:&quot;xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx&quot;,
     }
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json">{
 &quot;success&quot;: false,
 &quot;message&quot;: &quot;Validation error&quot;,
 &quot;errors&quot;: {
         &quot;email&quot;:[&quot;error&quot;],
         &quot;password&quot;:[&quot;error&quot;],
     }
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json">{
 &quot;success&quot;: false,
 &quot;message&quot;: &quot;User Not Found&quot;,
 &quot;errors&quot;: {
         &quot;email&quot;:[&quot;error&quot;],
         &quot;password&quot;:[&quot;error&quot;],
     }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-login" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-login"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-login"></code></pre>
</span>
<span id="execution-error-GETapi-v1-login" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-login"></code></pre>
</span>
<form id="form-GETapi-v1-login" data-method="GET"
      data-path="api/v1/login"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-login', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-login"
                    onclick="tryItOut('GETapi-v1-login');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-login"
                    onclick="cancelTryOut('GETapi-v1-login');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-login" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/login</code></b>
        </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>email</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="email"
               data-endpoint="GETapi-v1-login"
               value="beimqznhfpncduopkeagurgwzfzldrtxmukmivrixqsxduxddtlsyjhviitpabdtchfnaxqueyszivckmpfsnsfbzoegixfeksmblawlko"
               data-component="body" hidden>
    <br>
<p>Must not be greater than 255 characters.</p>
        </p>
                <p>
            <b><code>password</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="password"
               data-endpoint="GETapi-v1-login"
               value="midvhwyqztx"
               data-component="body" hidden>
    <br>
<p>Must not be greater than 255 characters.</p>
        </p>
        </form>

            <h2 id="authentication-POSTapi-v1-register">Regsiter</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-register">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://127.0.0.1:8000/api/v1/register" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"bbwhrwvfamzeohzwouydcmlnfjdrxldkkiauleucfeazrwiuqudcqbfhjfvogrzbdocgueqqqotacntkfdsqatuafvaecyfgtfrlwaboxrsiseuwdxdsvzslzbrtbwzatarbneykavhghlrvuldodpguuvpt\",
    \"email\": \"scottie12@example.com\",
    \"phno\": \"4465740158\",
    \"password\": \"ccyhaeo\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/v1/register"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "bbwhrwvfamzeohzwouydcmlnfjdrxldkkiauleucfeazrwiuqudcqbfhjfvogrzbdocgueqqqotacntkfdsqatuafvaecyfgtfrlwaboxrsiseuwdxdsvzslzbrtbwzatarbneykavhghlrvuldodpguuvpt",
    "email": "scottie12@example.com",
    "phno": "4465740158",
    "password": "ccyhaeo"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-register">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json">{
 &quot;success&quot;: true,
 &quot;message&quot;: &quot;Sucess&quot;,
 &quot;data&quot;: {
         &quot;id&quot;:&quot;1&quot;,
         &quot;name&quot;:&quot;xxxxxx&quot;,
         &quot;email&quot;:&quot;xxxxxx@gmail.com&quot;,
         &quot;phno&quot;:&quot;88xxxxxxx1&quot;,
         &quot;token&quot;:&quot;xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx&quot;,
     }
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json">{
 &quot;success&quot;: false,
 &quot;message&quot;: &quot;Validation error&quot;,
 &quot;errors&quot;: {
         &quot;email&quot;:[&quot;error&quot;],
         &quot;password&quot;:[&quot;error&quot;],
     }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-v1-register" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-register"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-register"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-register" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-register"></code></pre>
</span>
<form id="form-POSTapi-v1-register" data-method="POST"
      data-path="api/v1/register"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-register', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-register"
                    onclick="tryItOut('POSTapi-v1-register');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-register"
                    onclick="cancelTryOut('POSTapi-v1-register');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-register" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/register</code></b>
        </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="name"
               data-endpoint="POSTapi-v1-register"
               value="bbwhrwvfamzeohzwouydcmlnfjdrxldkkiauleucfeazrwiuqudcqbfhjfvogrzbdocgueqqqotacntkfdsqatuafvaecyfgtfrlwaboxrsiseuwdxdsvzslzbrtbwzatarbneykavhghlrvuldodpguuvpt"
               data-component="body" hidden>
    <br>
<p>Must not be greater than 255 characters.</p>
        </p>
                <p>
            <b><code>email</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="email"
               data-endpoint="POSTapi-v1-register"
               value="scottie12@example.com"
               data-component="body" hidden>
    <br>
<p>Must be a valid email address.</p>
        </p>
                <p>
            <b><code>phno</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="phno"
               data-endpoint="POSTapi-v1-register"
               value="4465740158"
               data-component="body" hidden>
    <br>
<p>Must be 10 digits.</p>
        </p>
                <p>
            <b><code>password</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="password"
               data-endpoint="POSTapi-v1-register"
               value="ccyhaeo"
               data-component="body" hidden>
    <br>
<p>Must be at least 7 characters.</p>
        </p>
        </form>

            <h2 id="authentication-GETapi-v1-otpverify">OTP Verify</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-otpverify">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/v1/otpverify" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"OTP\": \"consequatur\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/v1/otpverify"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "OTP": "consequatur"
};

fetch(url, {
    method: "GET",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-otpverify">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json">{
 &quot;error&quot;: 0,
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json">{
 &quot;error&quot;: 1,
 &quot;errordata&quot;: &quot;Message/Incorrect OTP&quot;,
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-otpverify" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-otpverify"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-otpverify"></code></pre>
</span>
<span id="execution-error-GETapi-v1-otpverify" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-otpverify"></code></pre>
</span>
<form id="form-GETapi-v1-otpverify" data-method="GET"
      data-path="api/v1/otpverify"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-otpverify', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-otpverify"
                    onclick="tryItOut('GETapi-v1-otpverify');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-otpverify"
                    onclick="cancelTryOut('GETapi-v1-otpverify');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-otpverify" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/otpverify</code></b>
        </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>OTP</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="OTP"
               data-endpoint="GETapi-v1-otpverify"
               value="consequatur"
               data-component="body" hidden>
    <br>
<p>OTP Code</p>
        </p>
        </form>

            <h2 id="authentication-POSTapi-v1-otpresend">OTP Resend</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-otpresend">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://127.0.0.1:8000/api/v1/otpresend" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"UID\": \"omnis\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/v1/otpresend"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "UID": "omnis"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-otpresend">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json">{
 &quot;error&quot;: 0,
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json">{
 &quot;error&quot;: 1,
 &quot;errordata&quot;: &quot;Message/Incorrect OTP&quot;,
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-v1-otpresend" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-otpresend"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-otpresend"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-otpresend" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-otpresend"></code></pre>
</span>
<form id="form-POSTapi-v1-otpresend" data-method="POST"
      data-path="api/v1/otpresend"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-otpresend', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-otpresend"
                    onclick="tryItOut('POSTapi-v1-otpresend');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-otpresend"
                    onclick="cancelTryOut('POSTapi-v1-otpresend');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-otpresend" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/otpresend</code></b>
        </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>UID</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="UID"
               data-endpoint="POSTapi-v1-otpresend"
               value="omnis"
               data-component="body" hidden>
    <br>
<p>User ID</p>
        </p>
        </form>

            <h2 id="authentication-POSTapi-v1-logout">Log out</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-logout">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://127.0.0.1:8000/api/v1/logout" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/v1/logout"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-logout">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json">{
 &quot;success&quot;: true,
 &quot;message&quot;: &quot;Logout Successfully&quot;,</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json">{
 &quot;success&quot;: false,
 &quot;message&quot;: &quot;Unable to Logout&quot;,
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-v1-logout" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-logout"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-logout"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-logout" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-logout"></code></pre>
</span>
<form id="form-POSTapi-v1-logout" data-method="POST"
      data-path="api/v1/logout"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-logout', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-logout"
                    onclick="tryItOut('POSTapi-v1-logout');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-logout"
                    onclick="cancelTryOut('POSTapi-v1-logout');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-logout" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/logout</code></b>
        </p>
                    </form>

        <h1 id="checkout">Checkout</h1>



            <h2 id="checkout-GETapi-v1-getcost">Shipping Cost</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-getcost">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/v1/getcost" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"pincode\": \"vel\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/v1/getcost"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "pincode": "vel"
};

fetch(url, {
    method: "GET",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-getcost">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json">{
    &quot;success&quot;: true,
    &quot;title&quot;: &quot;&quot;,
    &quot;message&quot;: &quot;&quot;,
    &quot;data&quot;: {}
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json">{
    &quot;success&quot;: false,
    &quot;title&quot;: &quot;&quot;,
    &quot;message&quot;: &quot;&quot;,
    &quot;data&quot;: {}
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-getcost" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-getcost"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-getcost"></code></pre>
</span>
<span id="execution-error-GETapi-v1-getcost" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-getcost"></code></pre>
</span>
<form id="form-GETapi-v1-getcost" data-method="GET"
      data-path="api/v1/getcost"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-getcost', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-getcost"
                    onclick="tryItOut('GETapi-v1-getcost');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-getcost"
                    onclick="cancelTryOut('GETapi-v1-getcost');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-getcost" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/getcost</code></b>
        </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>pincode</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="pincode"
               data-endpoint="GETapi-v1-getcost"
               value="vel"
               data-component="body" hidden>
    <br>
<p>Pincode</p>
        </p>
        </form>

            <h2 id="checkout-POSTapi-v1-getpromocode">PromoCode</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-getpromocode">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://127.0.0.1:8000/api/v1/getpromocode" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"eaque\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/v1/getpromocode"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "eaque"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-getpromocode">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json">{
    &quot;success&quot;: true,
    &quot;title&quot;: &quot;Hurrey&quot;,
    &quot;message&quot;: &quot;We are there to service&quot;,
    &quot;data&quot;: {}
}</code>
 </pre>
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json">{
    &quot;success&quot;: false,
    &quot;title&quot;: &quot;Sorry&quot;,
    &quot;message&quot;: &quot;We dont serve the selected pincode.&quot;,
    &quot;data&quot;: {}
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-v1-getpromocode" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-getpromocode"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-getpromocode"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-getpromocode" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-getpromocode"></code></pre>
</span>
<form id="form-POSTapi-v1-getpromocode" data-method="POST"
      data-path="api/v1/getpromocode"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-getpromocode', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-getpromocode"
                    onclick="tryItOut('POSTapi-v1-getpromocode');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-getpromocode"
                    onclick="cancelTryOut('POSTapi-v1-getpromocode');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-getpromocode" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/getpromocode</code></b>
        </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>name</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="name"
               data-endpoint="POSTapi-v1-getpromocode"
               value="eaque"
               data-component="body" hidden>
    <br>
<p>PromoCode</p>
        </p>
        </form>

            <h2 id="checkout-POSTapi-v1-getaddress">Address</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-getaddress">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://127.0.0.1:8000/api/v1/getaddress" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/v1/getaddress"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-getaddress">
</span>
<span id="execution-results-POSTapi-v1-getaddress" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-getaddress"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-getaddress"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-getaddress" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-getaddress"></code></pre>
</span>
<form id="form-POSTapi-v1-getaddress" data-method="POST"
      data-path="api/v1/getaddress"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-getaddress', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-getaddress"
                    onclick="tryItOut('POSTapi-v1-getaddress');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-getaddress"
                    onclick="cancelTryOut('POSTapi-v1-getaddress');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-getaddress" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/getaddress</code></b>
        </p>
                    </form>

        <h1 id="endpoints">Endpoints</h1>



            <h2 id="endpoints-GETapi-user">GET api/user</h2>

<p>
</p>



<span id="example-requests-GETapi-user">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/user" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/user"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-user">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-user" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-user"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-user"></code></pre>
</span>
<span id="execution-error-GETapi-user" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-user"></code></pre>
</span>
<form id="form-GETapi-user" data-method="GET"
      data-path="api/user"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-user', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-user"
                    onclick="tryItOut('GETapi-user');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-user"
                    onclick="cancelTryOut('GETapi-user');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-user" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/user</code></b>
        </p>
                    </form>

        <h1 id="general">General</h1>



            <h2 id="general-GETapi-v1-welcome">Welcome Page</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-welcome">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/v1/welcome" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/v1/welcome"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-welcome">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json">{
 &quot;success&quot;: true,
 &quot;message&quot;: &quot;Fetched Data&quot;,
 &quot;data&quot;: {
     banner:[
         {
             name:'',
             desc:'',
             name:'',
             name:'',
         }
     ]
},</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json">{
 &quot;success&quot;: false,
 &quot;message&quot;: &quot;Unable to Logout&quot;,
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-welcome" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-welcome"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-welcome"></code></pre>
</span>
<span id="execution-error-GETapi-v1-welcome" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-welcome"></code></pre>
</span>
<form id="form-GETapi-v1-welcome" data-method="GET"
      data-path="api/v1/welcome"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-welcome', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-welcome"
                    onclick="tryItOut('GETapi-v1-welcome');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-welcome"
                    onclick="cancelTryOut('GETapi-v1-welcome');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-welcome" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/welcome</code></b>
        </p>
                    </form>

            <h2 id="general-GETapi-v1-getarea">Get Area</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-getarea">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/v1/getarea" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"pincode\": \"dicta\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/v1/getarea"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "pincode": "dicta"
};

fetch(url, {
    method: "GET",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-getarea">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json">{
    &quot;success&quot;: true,
    &quot;title&quot;: &quot;&quot;,
    &quot;message&quot;: &quot;&quot;,
    &quot;data&quot;: {}
}</code>
 </pre>
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json">{
    &quot;success&quot;: false,
    &quot;title&quot;: &quot;Sorry&quot;,
    &quot;message&quot;: &quot;We dont serve the selected pincode.&quot;,
    &quot;data&quot;: {}
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-getarea" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-getarea"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-getarea"></code></pre>
</span>
<span id="execution-error-GETapi-v1-getarea" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-getarea"></code></pre>
</span>
<form id="form-GETapi-v1-getarea" data-method="GET"
      data-path="api/v1/getarea"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-getarea', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-getarea"
                    onclick="tryItOut('GETapi-v1-getarea');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-getarea"
                    onclick="cancelTryOut('GETapi-v1-getarea');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-getarea" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/getarea</code></b>
        </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>pincode</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="pincode"
               data-endpoint="GETapi-v1-getarea"
               value="dicta"
               data-component="body" hidden>
    <br>
<p>Pincode</p>
        </p>
        </form>

            <h2 id="general-POSTapi-v1-checkpincode">Get Servicability</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-checkpincode">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://127.0.0.1:8000/api/v1/checkpincode" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"pincode\": \"iusto\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/v1/checkpincode"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "pincode": "iusto"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-checkpincode">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json">{
    &quot;success&quot;: true,
    &quot;title&quot;: &quot;Hurrey&quot;,
    &quot;message&quot;: &quot;We are there to service&quot;,
    &quot;data&quot;: {}
}</code>
 </pre>
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json">{
    &quot;success&quot;: false,
    &quot;title&quot;: &quot;Sorry&quot;,
    &quot;message&quot;: &quot;We dont serve the selected pincode.&quot;,
    &quot;data&quot;: {}
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-v1-checkpincode" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-checkpincode"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-checkpincode"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-checkpincode" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-checkpincode"></code></pre>
</span>
<form id="form-POSTapi-v1-checkpincode" data-method="POST"
      data-path="api/v1/checkpincode"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-checkpincode', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-checkpincode"
                    onclick="tryItOut('POSTapi-v1-checkpincode');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-checkpincode"
                    onclick="cancelTryOut('POSTapi-v1-checkpincode');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-checkpincode" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/checkpincode</code></b>
        </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>pincode</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="pincode"
               data-endpoint="POSTapi-v1-checkpincode"
               value="iusto"
               data-component="body" hidden>
    <br>
<p>Pincode</p>
        </p>
        </form>

            <h2 id="general-GETapi-v1-category">Category</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-category">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/v1/category" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/v1/category"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-category">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 55
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">[
    {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;Sunflower Oil&quot;,
        &quot;loc&quot;: &quot;storage/category/pLoCSxpGlgOQacnz.webp&quot;
    },
    {
        &quot;id&quot;: 2,
        &quot;name&quot;: &quot;Groundnut oil&quot;,
        &quot;loc&quot;: &quot;storage/category/5vensV90XZrtlFUk.jpg&quot;
    },
    {
        &quot;id&quot;: 3,
        &quot;name&quot;: &quot;Ghee&quot;,
        &quot;loc&quot;: &quot;storage/category/dquQ1gGrCkgFzqlr.jpg&quot;
    },
    {
        &quot;id&quot;: 4,
        &quot;name&quot;: &quot;Gingelly Oil&quot;,
        &quot;loc&quot;: &quot;storage/category/dMZfz38n8lFwet2H.jpeg&quot;
    },
    {
        &quot;id&quot;: 5,
        &quot;name&quot;: &quot;Hair Oil&quot;,
        &quot;loc&quot;: &quot;storage/category/2texImBeNqq9E7tt.jpg&quot;
    },
    {
        &quot;id&quot;: 6,
        &quot;name&quot;: &quot;Coconut oil&quot;,
        &quot;loc&quot;: &quot;storage/category/hp7GLqYH1h06IEVs.jfif&quot;
    },
    {
        &quot;id&quot;: 7,
        &quot;name&quot;: &quot;Ricebran oil&quot;,
        &quot;loc&quot;: &quot;storage/category/3qcqefdY7ZkcF9UZ.jpg&quot;
    },
    {
        &quot;id&quot;: 8,
        &quot;name&quot;: &quot;Cooking Coconut oil&quot;,
        &quot;loc&quot;: &quot;storage/category/HiqCphxEqk8thm1R.webp&quot;
    },
    {
        &quot;id&quot;: 9,
        &quot;name&quot;: &quot;Dheepam/Lamp Oil&quot;,
        &quot;loc&quot;: &quot;storage/category/MXC0aETmHf5xiniG.png&quot;
    },
    {
        &quot;id&quot;: 10,
        &quot;name&quot;: &quot;Pickle&quot;,
        &quot;loc&quot;: &quot;storage/category/ZzG945nD1X4r1Eiu.jpg&quot;
    },
    {
        &quot;id&quot;: 11,
        &quot;name&quot;: &quot;Palm Oil&quot;,
        &quot;loc&quot;: &quot;storage/category/1803mbXGiRPhmA81.jpg&quot;
    }
]</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-category" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-category"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-category"></code></pre>
</span>
<span id="execution-error-GETapi-v1-category" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-category"></code></pre>
</span>
<form id="form-GETapi-v1-category" data-method="GET"
      data-path="api/v1/category"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-category', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-category"
                    onclick="tryItOut('GETapi-v1-category');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-category"
                    onclick="cancelTryOut('GETapi-v1-category');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-category" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/category</code></b>
        </p>
                    </form>

            <h2 id="general-GETapi-v1-brand">Brand</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-brand">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/v1/brand" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/v1/brand"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-brand">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 54
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">[
    {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;Fortune&quot;,
        &quot;loc&quot;: &quot;storage/brand/4uCrsylbWdpcGwrA.jpg&quot;
    },
    {
        &quot;id&quot;: 2,
        &quot;name&quot;: &quot;Saffola&quot;,
        &quot;loc&quot;: &quot;storage/brand/ztK6BIH9g3XLGgA1.jpg&quot;
    },
    {
        &quot;id&quot;: 3,
        &quot;name&quot;: &quot;Sundrop&quot;,
        &quot;loc&quot;: &quot;storage/brand/6fbMRhM3kVXM45Lt.jpg&quot;
    },
    {
        &quot;id&quot;: 4,
        &quot;name&quot;: &quot;Gold Winner&quot;,
        &quot;loc&quot;: &quot;storage/brand/5MfDMloj8cVxjxe3.png&quot;
    },
    {
        &quot;id&quot;: 5,
        &quot;name&quot;: &quot;Idhayam&quot;,
        &quot;loc&quot;: &quot;storage/brand/ICTUGlmWTTfH5D28.jfif&quot;
    },
    {
        &quot;id&quot;: 6,
        &quot;name&quot;: &quot;Mr. Gold&quot;,
        &quot;loc&quot;: &quot;storage/brand/xQu1tAW5YWdFahe6.png&quot;
    },
    {
        &quot;id&quot;: 7,
        &quot;name&quot;: &quot;RKG&quot;,
        &quot;loc&quot;: &quot;storage/brand/sJHRVxEYUsUgXNkd.jpg&quot;
    },
    {
        &quot;id&quot;: 8,
        &quot;name&quot;: &quot;GRB&quot;,
        &quot;loc&quot;: &quot;storage/brand/x24bFfVy1rsDgaqb.jpg&quot;
    },
    {
        &quot;id&quot;: 9,
        &quot;name&quot;: &quot;Amul&quot;,
        &quot;loc&quot;: &quot;storage/brand/QPAghIHy8g8wr1c8.png&quot;
    },
    {
        &quot;id&quot;: 10,
        &quot;name&quot;: &quot;KPL&quot;,
        &quot;loc&quot;: &quot;storage/brand/zczuQclWC9AD2eq4.png&quot;
    },
    {
        &quot;id&quot;: 11,
        &quot;name&quot;: &quot;Parachute&quot;,
        &quot;loc&quot;: &quot;storage/brand/TRaMkuk6Ra4CcfvS.jpg&quot;
    },
    {
        &quot;id&quot;: 12,
        &quot;name&quot;: &quot;Aswini&quot;,
        &quot;loc&quot;: &quot;storage/brand/DaYNdhUinUBn7GfN.png&quot;
    },
    {
        &quot;id&quot;: 13,
        &quot;name&quot;: &quot;Dabur&quot;,
        &quot;loc&quot;: &quot;storage/brand/BDjEuYEcOsGtOsTn.jpg&quot;
    },
    {
        &quot;id&quot;: 14,
        &quot;name&quot;: &quot;VVD&quot;,
        &quot;loc&quot;: &quot;storage/brand/FncahN4jDicmHOuO.jfif&quot;
    },
    {
        &quot;id&quot;: 15,
        &quot;name&quot;: &quot;Orysa&quot;,
        &quot;loc&quot;: &quot;storage/brand/t6cTkmedFQAOv20Q.jpeg&quot;
    },
    {
        &quot;id&quot;: 16,
        &quot;name&quot;: &quot;RAS&quot;,
        &quot;loc&quot;: &quot;storage/brand/rd0oMQ90WgnqvMlU.jpg&quot;
    },
    {
        &quot;id&quot;: 18,
        &quot;name&quot;: &quot;Rajinis&quot;,
        &quot;loc&quot;: &quot;storage/brand/O7ei3F3PhxuCZy1b.jpg&quot;
    },
    {
        &quot;id&quot;: 19,
        &quot;name&quot;: &quot;Ruchi&quot;,
        &quot;loc&quot;: &quot;storage/brand/u1BoCmMuB62fDb1L.jpg&quot;
    }
]</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-brand" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-brand"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-brand"></code></pre>
</span>
<span id="execution-error-GETapi-v1-brand" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-brand"></code></pre>
</span>
<form id="form-GETapi-v1-brand" data-method="GET"
      data-path="api/v1/brand"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-brand', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-brand"
                    onclick="tryItOut('GETapi-v1-brand');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-brand"
                    onclick="cancelTryOut('GETapi-v1-brand');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-brand" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/brand</code></b>
        </p>
                    </form>

        <h1 id="product">Product</h1>



            <h2 id="product-POSTapi-v1-postreview">Post a Review</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-postreview">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://127.0.0.1:8000/api/v1/postreview" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"uid\": \"suscipit\",
    \"pid\": \"optio\",
    \"review\": \"odio\",
    \"rating\": \"qui\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/v1/postreview"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "uid": "suscipit",
    "pid": "optio",
    "review": "odio",
    "rating": "qui"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-postreview">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json">{
    &quot;success&quot;: true,
    &quot;title&quot;: &quot;Product Reviewed&quot;,
    &quot;message&quot;: &quot;Thank you for the review&quot;,
    &quot;data&quot;: {}
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json">{
    &quot;success&quot;: false,
    &quot;title&quot;: &quot;&quot;,
    &quot;message&quot;: &quot;&quot;,
    &quot;data&quot;: {}
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-v1-postreview" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-postreview"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-postreview"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-postreview" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-postreview"></code></pre>
</span>
<form id="form-POSTapi-v1-postreview" data-method="POST"
      data-path="api/v1/postreview"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-postreview', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-postreview"
                    onclick="tryItOut('POSTapi-v1-postreview');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-postreview"
                    onclick="cancelTryOut('POSTapi-v1-postreview');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-postreview" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/postreview</code></b>
        </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>uid</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="uid"
               data-endpoint="POSTapi-v1-postreview"
               value="suscipit"
               data-component="body" hidden>
    <br>
<p>User id</p>
        </p>
                <p>
            <b><code>pid</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="pid"
               data-endpoint="POSTapi-v1-postreview"
               value="optio"
               data-component="body" hidden>
    <br>
<p>Product id</p>
        </p>
                <p>
            <b><code>review</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="review"
               data-endpoint="POSTapi-v1-postreview"
               value="odio"
               data-component="body" hidden>
    <br>
<p>review</p>
        </p>
                <p>
            <b><code>rating</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="rating"
               data-endpoint="POSTapi-v1-postreview"
               value="qui"
               data-component="body" hidden>
    <br>
<p>Rating</p>
        </p>
        </form>

            <h2 id="product-GETapi-v1-products--name-">Product View</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-products--name-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/v1/products/quis" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/v1/products/quis"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-products--name-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json">{
 &quot;success&quot;: false,
 &quot;message&quot;: &quot;No Product Found&quot;,
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 59
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;No Product Found&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-products--name-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-products--name-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-products--name-"></code></pre>
</span>
<span id="execution-error-GETapi-v1-products--name-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-products--name-"></code></pre>
</span>
<form id="form-GETapi-v1-products--name-" data-method="GET"
      data-path="api/v1/products/{name}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-products--name-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-products--name-"
                    onclick="tryItOut('GETapi-v1-products--name-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-products--name-"
                    onclick="cancelTryOut('GETapi-v1-products--name-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-products--name-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/products/{name}</code></b>
        </p>
                    <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="name"
               data-endpoint="GETapi-v1-products--name-"
               value="quis"
               data-component="url" hidden>
    <br>

            </p>
                    </form>

            <h2 id="product-GETapi-v1-newproducts">New Product</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-newproducts">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/v1/newproducts" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/v1/newproducts"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-newproducts">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 58
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;current_page&quot;: 1,
    &quot;data&quot;: [
        {
            &quot;id&quot;: 2,
            &quot;name&quot;: &quot;Saffola Gold - Pro Healthy Lifestyle Edible Oil&quot;,
            &quot;created_at&quot;: &quot;2022-02-19T09:51:01.000000Z&quot;,
            &quot;fpricewtas&quot;: 202.65,
            &quot;cid&quot;: 1,
            &quot;scid&quot;: 0,
            &quot;status&quot;: 1,
            &quot;bid&quot;: 2,
            &quot;stock&quot;: -3,
            &quot;disp&quot;: 0,
            &quot;fpricebefdis&quot;: 0,
            &quot;disa&quot;: 0,
            &quot;packingid&quot;: 1,
            &quot;tags&quot;: [
                &quot;Cooking oil&quot;,
                &quot;Sunflower&quot;,
                &quot; Saffola&quot;
            ],
            &quot;oosc&quot;: 1,
            &quot;trackqty&quot;: 1,
            &quot;review&quot;: [
                {
                    &quot;id&quot;: 22,
                    &quot;uid&quot;: 1,
                    &quot;bid&quot;: 0,
                    &quot;pid&quot;: 2,
                    &quot;review&quot;: &quot;i&quot;,
                    &quot;rating&quot;: 3,
                    &quot;status&quot;: 1,
                    &quot;created_at&quot;: &quot;2022-02-20T16:15:22.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2022-02-20T16:15:22.000000Z&quot;,
                    &quot;customer&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Admin&quot;
                    }
                }
            ],
            &quot;image&quot;: {
                &quot;id&quot;: 13,
                &quot;pid&quot;: 2,
                &quot;loc&quot;: &quot;storage/products/2/YQj46b2EIgosISuP.jpg&quot;
            },
            &quot;category&quot;: {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Sunflower Oil&quot;
            }
        },
        {
            &quot;id&quot;: 3,
            &quot;name&quot;: &quot;Sundrop Super Lite Advanced - Sunflower Oil, 1 L Pouch&quot;,
            &quot;created_at&quot;: &quot;2022-02-19T09:51:01.000000Z&quot;,
            &quot;fpricewtas&quot;: 214.2,
            &quot;cid&quot;: 1,
            &quot;scid&quot;: 0,
            &quot;status&quot;: 1,
            &quot;bid&quot;: 3,
            &quot;stock&quot;: -2,
            &quot;disp&quot;: 0,
            &quot;fpricebefdis&quot;: 0,
            &quot;disa&quot;: 0,
            &quot;packingid&quot;: 1,
            &quot;tags&quot;: [
                &quot;Cooking oil&quot;,
                &quot;Sunflower&quot;,
                &quot; Sundrop&quot;
            ],
            &quot;oosc&quot;: 1,
            &quot;trackqty&quot;: 1,
            &quot;review&quot;: [
                {
                    &quot;id&quot;: 24,
                    &quot;uid&quot;: 1,
                    &quot;bid&quot;: 0,
                    &quot;pid&quot;: 3,
                    &quot;review&quot;: &quot;qweqw&quot;,
                    &quot;rating&quot;: 1,
                    &quot;status&quot;: 1,
                    &quot;created_at&quot;: &quot;2022-02-20T19:57:27.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2022-02-20T19:57:27.000000Z&quot;,
                    &quot;customer&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Admin&quot;
                    }
                },
                {
                    &quot;id&quot;: 23,
                    &quot;uid&quot;: 1,
                    &quot;bid&quot;: 0,
                    &quot;pid&quot;: 3,
                    &quot;review&quot;: &quot;asfd&quot;,
                    &quot;rating&quot;: 5,
                    &quot;status&quot;: 1,
                    &quot;created_at&quot;: &quot;2022-02-20T19:56:38.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2022-02-20T19:56:38.000000Z&quot;,
                    &quot;customer&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Admin&quot;
                    }
                },
                {
                    &quot;id&quot;: 5,
                    &quot;uid&quot;: 1,
                    &quot;bid&quot;: 0,
                    &quot;pid&quot;: 3,
                    &quot;review&quot;: &quot;wqe&quot;,
                    &quot;rating&quot;: 3,
                    &quot;status&quot;: 1,
                    &quot;created_at&quot;: &quot;2022-02-20T15:30:18.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2022-02-20T15:30:18.000000Z&quot;,
                    &quot;customer&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Admin&quot;
                    }
                },
                {
                    &quot;id&quot;: 4,
                    &quot;uid&quot;: 1,
                    &quot;bid&quot;: 0,
                    &quot;pid&quot;: 3,
                    &quot;review&quot;: &quot;123&quot;,
                    &quot;rating&quot;: 5,
                    &quot;status&quot;: 1,
                    &quot;created_at&quot;: &quot;2022-02-20T15:30:10.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2022-02-20T15:30:10.000000Z&quot;,
                    &quot;customer&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Admin&quot;
                    }
                },
                {
                    &quot;id&quot;: 3,
                    &quot;uid&quot;: 1,
                    &quot;bid&quot;: 0,
                    &quot;pid&quot;: 3,
                    &quot;review&quot;: &quot;asd&quot;,
                    &quot;rating&quot;: 5,
                    &quot;status&quot;: 1,
                    &quot;created_at&quot;: &quot;2022-02-20T15:29:27.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2022-02-20T15:29:27.000000Z&quot;,
                    &quot;customer&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Admin&quot;
                    }
                },
                {
                    &quot;id&quot;: 2,
                    &quot;uid&quot;: 1,
                    &quot;bid&quot;: 0,
                    &quot;pid&quot;: 3,
                    &quot;review&quot;: &quot;asdadasdas&quot;,
                    &quot;rating&quot;: 5,
                    &quot;status&quot;: 1,
                    &quot;created_at&quot;: &quot;2022-02-20T15:29:23.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2022-02-20T15:29:23.000000Z&quot;,
                    &quot;customer&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Admin&quot;
                    }
                },
                {
                    &quot;id&quot;: 1,
                    &quot;uid&quot;: 1,
                    &quot;bid&quot;: 0,
                    &quot;pid&quot;: 3,
                    &quot;review&quot;: &quot;qweqweqw&quot;,
                    &quot;rating&quot;: 4,
                    &quot;status&quot;: 1,
                    &quot;created_at&quot;: &quot;2022-02-20T15:29:16.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2022-02-20T15:29:16.000000Z&quot;,
                    &quot;customer&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Admin&quot;
                    }
                }
            ],
            &quot;image&quot;: {
                &quot;id&quot;: 16,
                &quot;pid&quot;: 3,
                &quot;loc&quot;: &quot;storage/products/3/yuVqn9ue1VkflwZF.jpg&quot;
            },
            &quot;category&quot;: {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Sunflower Oil&quot;
            }
        },
        {
            &quot;id&quot;: 4,
            &quot;name&quot;: &quot;Gold Winner Refined Groundnut Oil 1 L (Pouch)&quot;,
            &quot;created_at&quot;: &quot;2022-02-19T09:51:01.000000Z&quot;,
            &quot;fpricewtas&quot;: 187.95,
            &quot;cid&quot;: 2,
            &quot;scid&quot;: 0,
            &quot;status&quot;: 1,
            &quot;bid&quot;: 4,
            &quot;stock&quot;: -2,
            &quot;disp&quot;: 0,
            &quot;fpricebefdis&quot;: 0,
            &quot;disa&quot;: 0,
            &quot;packingid&quot;: 1,
            &quot;tags&quot;: [
                &quot;Cooking oil&quot;,
                &quot;Groudnut Oil&quot;,
                &quot;Gold winner&quot;
            ],
            &quot;oosc&quot;: 1,
            &quot;trackqty&quot;: 1,
            &quot;review&quot;: [],
            &quot;image&quot;: {
                &quot;id&quot;: 19,
                &quot;pid&quot;: 4,
                &quot;loc&quot;: &quot;storage/products/4/7XNKQOzrsLS0fl43.jpg&quot;
            },
            &quot;category&quot;: {
                &quot;id&quot;: 2,
                &quot;name&quot;: &quot;Groundnut oil&quot;
            }
        },
        {
            &quot;id&quot;: 5,
            &quot;name&quot;: &quot;Idhayam Oil - Mantra GroundNut, 1 L Pouch&quot;,
            &quot;created_at&quot;: &quot;2022-02-19T09:51:01.000000Z&quot;,
            &quot;fpricewtas&quot;: 210,
            &quot;cid&quot;: 2,
            &quot;scid&quot;: 0,
            &quot;status&quot;: 1,
            &quot;bid&quot;: 5,
            &quot;stock&quot;: -2,
            &quot;disp&quot;: 0,
            &quot;fpricebefdis&quot;: 0,
            &quot;disa&quot;: 0,
            &quot;packingid&quot;: 1,
            &quot;tags&quot;: [
                &quot;Cooking oil&quot;,
                &quot;Groudnut Oil&quot;,
                &quot;Idhayam&quot;
            ],
            &quot;oosc&quot;: 1,
            &quot;trackqty&quot;: 1,
            &quot;review&quot;: [],
            &quot;image&quot;: {
                &quot;id&quot;: 22,
                &quot;pid&quot;: 5,
                &quot;loc&quot;: &quot;storage/products/5/cjWpEFgc7piPtOjA.jpg&quot;
            },
            &quot;category&quot;: {
                &quot;id&quot;: 2,
                &quot;name&quot;: &quot;Groundnut oil&quot;
            }
        },
        {
            &quot;id&quot;: 6,
            &quot;name&quot;: &quot;Mr. Gold Groundnut Oil, 1 L Pouch&quot;,
            &quot;created_at&quot;: &quot;2022-02-19T09:51:01.000000Z&quot;,
            &quot;fpricewtas&quot;: 185.85,
            &quot;cid&quot;: 2,
            &quot;scid&quot;: 0,
            &quot;status&quot;: 1,
            &quot;bid&quot;: 6,
            &quot;stock&quot;: -1,
            &quot;disp&quot;: 0,
            &quot;fpricebefdis&quot;: 0,
            &quot;disa&quot;: 0,
            &quot;packingid&quot;: 1,
            &quot;tags&quot;: [
                &quot;Cooking oil&quot;,
                &quot;Groudnut Oil&quot;,
                &quot;Mr.Gold&quot;
            ],
            &quot;oosc&quot;: 1,
            &quot;trackqty&quot;: 1,
            &quot;review&quot;: [],
            &quot;image&quot;: {
                &quot;id&quot;: 25,
                &quot;pid&quot;: 6,
                &quot;loc&quot;: &quot;storage/products/6/nKg4k9wg59PI1p0k.jpg&quot;
            },
            &quot;category&quot;: {
                &quot;id&quot;: 2,
                &quot;name&quot;: &quot;Groundnut oil&quot;
            }
        },
        {
            &quot;id&quot;: 7,
            &quot;name&quot;: &quot;RKG AGMARK GHEE ,500 ml Pet Jar&quot;,
            &quot;created_at&quot;: &quot;2022-02-19T09:51:01.000000Z&quot;,
            &quot;fpricewtas&quot;: 391.65,
            &quot;cid&quot;: 3,
            &quot;scid&quot;: 0,
            &quot;status&quot;: 1,
            &quot;bid&quot;: 7,
            &quot;stock&quot;: 0,
            &quot;disp&quot;: 0,
            &quot;fpricebefdis&quot;: 0,
            &quot;disa&quot;: 0,
            &quot;packingid&quot;: 2,
            &quot;tags&quot;: [
                &quot;Ghee&quot;,
                &quot;RKG&quot;,
                &quot;Vanaspati&quot;
            ],
            &quot;oosc&quot;: 1,
            &quot;trackqty&quot;: 1,
            &quot;review&quot;: [
                {
                    &quot;id&quot;: 21,
                    &quot;uid&quot;: 1,
                    &quot;bid&quot;: 0,
                    &quot;pid&quot;: 7,
                    &quot;review&quot;: &quot;asdasdasd&quot;,
                    &quot;rating&quot;: 3,
                    &quot;status&quot;: 1,
                    &quot;created_at&quot;: &quot;2022-02-20T15:47:43.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2022-02-20T15:47:43.000000Z&quot;,
                    &quot;customer&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Admin&quot;
                    }
                },
                {
                    &quot;id&quot;: 20,
                    &quot;uid&quot;: 1,
                    &quot;bid&quot;: 0,
                    &quot;pid&quot;: 7,
                    &quot;review&quot;: &quot;asdasd&quot;,
                    &quot;rating&quot;: 1,
                    &quot;status&quot;: 1,
                    &quot;created_at&quot;: &quot;2022-02-20T15:47:36.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2022-02-20T15:47:36.000000Z&quot;,
                    &quot;customer&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Admin&quot;
                    }
                },
                {
                    &quot;id&quot;: 19,
                    &quot;uid&quot;: 1,
                    &quot;bid&quot;: 0,
                    &quot;pid&quot;: 7,
                    &quot;review&quot;: &quot;a&quot;,
                    &quot;rating&quot;: 3,
                    &quot;status&quot;: 1,
                    &quot;created_at&quot;: &quot;2022-02-20T15:47:22.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2022-02-20T15:47:22.000000Z&quot;,
                    &quot;customer&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Admin&quot;
                    }
                },
                {
                    &quot;id&quot;: 18,
                    &quot;uid&quot;: 1,
                    &quot;bid&quot;: 0,
                    &quot;pid&quot;: 7,
                    &quot;review&quot;: &quot;asdf&quot;,
                    &quot;rating&quot;: 2,
                    &quot;status&quot;: 1,
                    &quot;created_at&quot;: &quot;2022-02-20T15:46:53.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2022-02-20T15:46:53.000000Z&quot;,
                    &quot;customer&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Admin&quot;
                    }
                },
                {
                    &quot;id&quot;: 17,
                    &quot;uid&quot;: 1,
                    &quot;bid&quot;: 0,
                    &quot;pid&quot;: 7,
                    &quot;review&quot;: &quot;adsf&quot;,
                    &quot;rating&quot;: 2,
                    &quot;status&quot;: 1,
                    &quot;created_at&quot;: &quot;2022-02-20T15:46:46.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2022-02-20T15:46:46.000000Z&quot;,
                    &quot;customer&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Admin&quot;
                    }
                },
                {
                    &quot;id&quot;: 16,
                    &quot;uid&quot;: 1,
                    &quot;bid&quot;: 0,
                    &quot;pid&quot;: 7,
                    &quot;review&quot;: &quot;as&quot;,
                    &quot;rating&quot;: 4,
                    &quot;status&quot;: 1,
                    &quot;created_at&quot;: &quot;2022-02-20T15:46:38.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2022-02-20T15:46:38.000000Z&quot;,
                    &quot;customer&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Admin&quot;
                    }
                },
                {
                    &quot;id&quot;: 15,
                    &quot;uid&quot;: 1,
                    &quot;bid&quot;: 0,
                    &quot;pid&quot;: 7,
                    &quot;review&quot;: &quot;asdf&quot;,
                    &quot;rating&quot;: 4,
                    &quot;status&quot;: 1,
                    &quot;created_at&quot;: &quot;2022-02-20T15:46:32.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2022-02-20T15:46:32.000000Z&quot;,
                    &quot;customer&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Admin&quot;
                    }
                },
                {
                    &quot;id&quot;: 14,
                    &quot;uid&quot;: 1,
                    &quot;bid&quot;: 0,
                    &quot;pid&quot;: 7,
                    &quot;review&quot;: &quot;asdf&quot;,
                    &quot;rating&quot;: 4,
                    &quot;status&quot;: 1,
                    &quot;created_at&quot;: &quot;2022-02-20T15:46:31.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2022-02-20T15:46:31.000000Z&quot;,
                    &quot;customer&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Admin&quot;
                    }
                },
                {
                    &quot;id&quot;: 13,
                    &quot;uid&quot;: 1,
                    &quot;bid&quot;: 0,
                    &quot;pid&quot;: 7,
                    &quot;review&quot;: &quot;asdf&quot;,
                    &quot;rating&quot;: 5,
                    &quot;status&quot;: 1,
                    &quot;created_at&quot;: &quot;2022-02-20T15:46:25.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2022-02-20T15:46:25.000000Z&quot;,
                    &quot;customer&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Admin&quot;
                    }
                },
                {
                    &quot;id&quot;: 12,
                    &quot;uid&quot;: 1,
                    &quot;bid&quot;: 0,
                    &quot;pid&quot;: 7,
                    &quot;review&quot;: &quot;asd&quot;,
                    &quot;rating&quot;: 5,
                    &quot;status&quot;: 1,
                    &quot;created_at&quot;: &quot;2022-02-20T15:44:31.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2022-02-20T15:44:31.000000Z&quot;,
                    &quot;customer&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Admin&quot;
                    }
                },
                {
                    &quot;id&quot;: 11,
                    &quot;uid&quot;: 1,
                    &quot;bid&quot;: 0,
                    &quot;pid&quot;: 7,
                    &quot;review&quot;: &quot;asdsa&quot;,
                    &quot;rating&quot;: 5,
                    &quot;status&quot;: 1,
                    &quot;created_at&quot;: &quot;2022-02-20T15:43:58.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2022-02-20T15:43:58.000000Z&quot;,
                    &quot;customer&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Admin&quot;
                    }
                },
                {
                    &quot;id&quot;: 10,
                    &quot;uid&quot;: 1,
                    &quot;bid&quot;: 0,
                    &quot;pid&quot;: 7,
                    &quot;review&quot;: &quot;asd&quot;,
                    &quot;rating&quot;: 5,
                    &quot;status&quot;: 1,
                    &quot;created_at&quot;: &quot;2022-02-20T15:43:35.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2022-02-20T15:43:35.000000Z&quot;,
                    &quot;customer&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Admin&quot;
                    }
                },
                {
                    &quot;id&quot;: 9,
                    &quot;uid&quot;: 1,
                    &quot;bid&quot;: 0,
                    &quot;pid&quot;: 7,
                    &quot;review&quot;: &quot;asd&quot;,
                    &quot;rating&quot;: 5,
                    &quot;status&quot;: 1,
                    &quot;created_at&quot;: &quot;2022-02-20T15:43:03.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2022-02-20T15:43:03.000000Z&quot;,
                    &quot;customer&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Admin&quot;
                    }
                },
                {
                    &quot;id&quot;: 8,
                    &quot;uid&quot;: 1,
                    &quot;bid&quot;: 0,
                    &quot;pid&quot;: 7,
                    &quot;review&quot;: &quot;asd&quot;,
                    &quot;rating&quot;: 5,
                    &quot;status&quot;: 1,
                    &quot;created_at&quot;: &quot;2022-02-20T15:41:57.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2022-02-20T15:41:57.000000Z&quot;,
                    &quot;customer&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Admin&quot;
                    }
                },
                {
                    &quot;id&quot;: 7,
                    &quot;uid&quot;: 1,
                    &quot;bid&quot;: 0,
                    &quot;pid&quot;: 7,
                    &quot;review&quot;: &quot;asd&quot;,
                    &quot;rating&quot;: 4,
                    &quot;status&quot;: 1,
                    &quot;created_at&quot;: &quot;2022-02-20T15:41:00.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2022-02-20T15:41:00.000000Z&quot;,
                    &quot;customer&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Admin&quot;
                    }
                },
                {
                    &quot;id&quot;: 6,
                    &quot;uid&quot;: 1,
                    &quot;bid&quot;: 0,
                    &quot;pid&quot;: 7,
                    &quot;review&quot;: &quot;asdasd&quot;,
                    &quot;rating&quot;: 5,
                    &quot;status&quot;: 1,
                    &quot;created_at&quot;: &quot;2022-02-20T15:40:54.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2022-02-20T15:40:54.000000Z&quot;,
                    &quot;customer&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Admin&quot;
                    }
                }
            ],
            &quot;image&quot;: {
                &quot;id&quot;: 28,
                &quot;pid&quot;: 7,
                &quot;loc&quot;: &quot;storage/products/7/GjYn5zwx5xGuQAZt.jpg&quot;
            },
            &quot;category&quot;: {
                &quot;id&quot;: 3,
                &quot;name&quot;: &quot;Ghee&quot;
            }
        },
        {
            &quot;id&quot;: 8,
            &quot;name&quot;: &quot;Grb Ghee, 500 ml Bottle&quot;,
            &quot;created_at&quot;: &quot;2022-02-19T09:51:01.000000Z&quot;,
            &quot;fpricewtas&quot;: 336,
            &quot;cid&quot;: 3,
            &quot;scid&quot;: 0,
            &quot;status&quot;: 1,
            &quot;bid&quot;: 8,
            &quot;stock&quot;: 0,
            &quot;disp&quot;: 0,
            &quot;fpricebefdis&quot;: 0,
            &quot;disa&quot;: 0,
            &quot;packingid&quot;: 2,
            &quot;tags&quot;: [
                &quot;Ghee&quot;,
                &quot;GRB&quot;,
                &quot;Vanaspati&quot;
            ],
            &quot;oosc&quot;: 1,
            &quot;trackqty&quot;: 1,
            &quot;review&quot;: [],
            &quot;image&quot;: {
                &quot;id&quot;: 31,
                &quot;pid&quot;: 8,
                &quot;loc&quot;: &quot;storage/products/8/9A5zcgqyjmgP7qBT.jpg&quot;
            },
            &quot;category&quot;: {
                &quot;id&quot;: 3,
                &quot;name&quot;: &quot;Ghee&quot;
            }
        },
        {
            &quot;id&quot;: 9,
            &quot;name&quot;: &quot;Amul Cow Ghee 1 L (Tin)&quot;,
            &quot;created_at&quot;: &quot;2022-02-19T09:51:01.000000Z&quot;,
            &quot;fpricewtas&quot;: 538.65,
            &quot;cid&quot;: 3,
            &quot;scid&quot;: 0,
            &quot;status&quot;: 1,
            &quot;bid&quot;: 9,
            &quot;stock&quot;: 0,
            &quot;disp&quot;: 0,
            &quot;fpricebefdis&quot;: 0,
            &quot;disa&quot;: 0,
            &quot;packingid&quot;: 3,
            &quot;tags&quot;: [
                &quot;Ghee&quot;,
                &quot;Amul&quot;,
                &quot;Vanaspati&quot;
            ],
            &quot;oosc&quot;: 1,
            &quot;trackqty&quot;: 1,
            &quot;review&quot;: [],
            &quot;image&quot;: {
                &quot;id&quot;: 34,
                &quot;pid&quot;: 9,
                &quot;loc&quot;: &quot;storage/products/9/rPweWxydZrIbdpcU.jpg&quot;
            },
            &quot;category&quot;: {
                &quot;id&quot;: 3,
                &quot;name&quot;: &quot;Ghee&quot;
            }
        },
        {
            &quot;id&quot;: 10,
            &quot;name&quot;: &quot;Idhayam Oil - Gingelly, 500 ml Pouch&quot;,
            &quot;created_at&quot;: &quot;2022-02-19T09:51:01.000000Z&quot;,
            &quot;fpricewtas&quot;: 159.6,
            &quot;cid&quot;: 4,
            &quot;scid&quot;: 0,
            &quot;status&quot;: 1,
            &quot;bid&quot;: 5,
            &quot;stock&quot;: 0,
            &quot;disp&quot;: 0,
            &quot;fpricebefdis&quot;: 0,
            &quot;disa&quot;: 0,
            &quot;packingid&quot;: 1,
            &quot;tags&quot;: [
                &quot;Cooking oil&quot;,
                &quot;Gingelly oil&quot;,
                &quot; Idhayam&quot;
            ],
            &quot;oosc&quot;: 1,
            &quot;trackqty&quot;: 1,
            &quot;review&quot;: [],
            &quot;image&quot;: {
                &quot;id&quot;: 37,
                &quot;pid&quot;: 10,
                &quot;loc&quot;: &quot;storage/products/10/BIA9j8pLnCyhV1ym.jpg&quot;
            },
            &quot;category&quot;: {
                &quot;id&quot;: 4,
                &quot;name&quot;: &quot;Gingelly Oil&quot;
            }
        },
        {
            &quot;id&quot;: 11,
            &quot;name&quot;: &quot;Kpl Shudhi Gingelly Oil, 500 ml Bottle&quot;,
            &quot;created_at&quot;: &quot;2022-02-19T09:51:01.000000Z&quot;,
            &quot;fpricewtas&quot;: 184.8,
            &quot;cid&quot;: 4,
            &quot;scid&quot;: 0,
            &quot;status&quot;: 1,
            &quot;bid&quot;: 10,
            &quot;stock&quot;: 0,
            &quot;disp&quot;: 0,
            &quot;fpricebefdis&quot;: 0,
            &quot;disa&quot;: 0,
            &quot;packingid&quot;: 4,
            &quot;tags&quot;: [
                &quot;Cooking oil&quot;,
                &quot;Gingelly oil&quot;,
                &quot; KPL&quot;
            ],
            &quot;oosc&quot;: 1,
            &quot;trackqty&quot;: 1,
            &quot;review&quot;: [],
            &quot;image&quot;: {
                &quot;id&quot;: 40,
                &quot;pid&quot;: 11,
                &quot;loc&quot;: &quot;storage/products/11/jn1fH0OSVGH7FY9u.jpg&quot;
            },
            &quot;category&quot;: {
                &quot;id&quot;: 4,
                &quot;name&quot;: &quot;Gingelly Oil&quot;
            }
        },
        {
            &quot;id&quot;: 12,
            &quot;name&quot;: &quot;Mr. Gold Gingely Oil, 1 L&quot;,
            &quot;created_at&quot;: &quot;2022-02-19T09:51:01.000000Z&quot;,
            &quot;fpricewtas&quot;: 279.3,
            &quot;cid&quot;: 4,
            &quot;scid&quot;: 0,
            &quot;status&quot;: 1,
            &quot;bid&quot;: 6,
            &quot;stock&quot;: 0,
            &quot;disp&quot;: 0,
            &quot;fpricebefdis&quot;: 0,
            &quot;disa&quot;: 0,
            &quot;packingid&quot;: 1,
            &quot;tags&quot;: [
                &quot;Cooking oil&quot;,
                &quot;Gingelly oil&quot;,
                &quot; MR.gold&quot;
            ],
            &quot;oosc&quot;: 1,
            &quot;trackqty&quot;: 1,
            &quot;review&quot;: [],
            &quot;image&quot;: {
                &quot;id&quot;: 43,
                &quot;pid&quot;: 12,
                &quot;loc&quot;: &quot;storage/products/12/PycLTLrgiTGKYHxi.jpg&quot;
            },
            &quot;category&quot;: {
                &quot;id&quot;: 4,
                &quot;name&quot;: &quot;Gingelly Oil&quot;
            }
        },
        {
            &quot;id&quot;: 13,
            &quot;name&quot;: &quot;Parachute Advansed Ayurvedic Coconut Hair Oil, 300 ml Bottle&quot;,
            &quot;created_at&quot;: &quot;2022-02-19T09:51:01.000000Z&quot;,
            &quot;fpricewtas&quot;: 142.8,
            &quot;cid&quot;: 5,
            &quot;scid&quot;: 0,
            &quot;status&quot;: 1,
            &quot;bid&quot;: 11,
            &quot;stock&quot;: 0,
            &quot;disp&quot;: 0,
            &quot;fpricebefdis&quot;: 0,
            &quot;disa&quot;: 0,
            &quot;packingid&quot;: 4,
            &quot;tags&quot;: [
                &quot;Hair Oil&quot;,
                &quot;Parachute&quot;,
                &quot;Ayurvedicc&quot;
            ],
            &quot;oosc&quot;: 1,
            &quot;trackqty&quot;: 1,
            &quot;review&quot;: [],
            &quot;image&quot;: {
                &quot;id&quot;: 49,
                &quot;pid&quot;: 13,
                &quot;loc&quot;: &quot;storage/products/13/UNvZ2B7pDsne2Re5.jpg&quot;
            },
            &quot;category&quot;: {
                &quot;id&quot;: 5,
                &quot;name&quot;: &quot;Hair Oil&quot;
            }
        },
        {
            &quot;id&quot;: 14,
            &quot;name&quot;: &quot;Aswini Hair Oil 180ml&quot;,
            &quot;created_at&quot;: &quot;2022-02-19T09:51:01.000000Z&quot;,
            &quot;fpricewtas&quot;: 120.75,
            &quot;cid&quot;: 5,
            &quot;scid&quot;: 0,
            &quot;status&quot;: 1,
            &quot;bid&quot;: 12,
            &quot;stock&quot;: 0,
            &quot;disp&quot;: 0,
            &quot;fpricebefdis&quot;: 0,
            &quot;disa&quot;: 0,
            &quot;packingid&quot;: 4,
            &quot;tags&quot;: [
                &quot;Hair Oil&quot;,
                &quot;Edible oil&quot;,
                &quot;Aswini&quot;
            ],
            &quot;oosc&quot;: 1,
            &quot;trackqty&quot;: 1,
            &quot;review&quot;: [],
            &quot;image&quot;: {
                &quot;id&quot;: 52,
                &quot;pid&quot;: 14,
                &quot;loc&quot;: &quot;storage/products/14/tP3jObTQHUMTXgkZ.jpg&quot;
            },
            &quot;category&quot;: {
                &quot;id&quot;: 5,
                &quot;name&quot;: &quot;Hair Oil&quot;
            }
        },
        {
            &quot;id&quot;: 15,
            &quot;name&quot;: &quot;Dabur Almond Hair Oil for Damage Free Hair 500 ml&quot;,
            &quot;created_at&quot;: &quot;2022-02-19T09:51:01.000000Z&quot;,
            &quot;fpricewtas&quot;: 241.5,
            &quot;cid&quot;: 5,
            &quot;scid&quot;: 0,
            &quot;status&quot;: 1,
            &quot;bid&quot;: 13,
            &quot;stock&quot;: -3,
            &quot;disp&quot;: 0,
            &quot;fpricebefdis&quot;: 0,
            &quot;disa&quot;: 0,
            &quot;packingid&quot;: 4,
            &quot;tags&quot;: [
                &quot;Hair Oil&quot;,
                &quot;Edible oil&quot;,
                &quot;&quot;
            ],
            &quot;oosc&quot;: 1,
            &quot;trackqty&quot;: 1,
            &quot;review&quot;: [],
            &quot;image&quot;: {
                &quot;id&quot;: 54,
                &quot;pid&quot;: 15,
                &quot;loc&quot;: &quot;storage/products/15/Rr9cgmz9NTRfQdrI.jpg&quot;
            },
            &quot;category&quot;: {
                &quot;id&quot;: 5,
                &quot;name&quot;: &quot;Hair Oil&quot;
            }
        },
        {
            &quot;id&quot;: 16,
            &quot;name&quot;: &quot;Dabur Anmol Gold Coconut Oil - Edible Grade, Pure, Natural, For Hair &amp; Skin Use, 600 ml&quot;,
            &quot;created_at&quot;: &quot;2022-02-19T09:51:01.000000Z&quot;,
            &quot;fpricewtas&quot;: 235.2,
            &quot;cid&quot;: 6,
            &quot;scid&quot;: 0,
            &quot;status&quot;: 1,
            &quot;bid&quot;: 13,
            &quot;stock&quot;: 0,
            &quot;disp&quot;: 0,
            &quot;fpricebefdis&quot;: 0,
            &quot;disa&quot;: 0,
            &quot;packingid&quot;: 1,
            &quot;tags&quot;: [
                &quot;Coconut Oil&quot;,
                &quot;Edible oil&quot;,
                &quot;Darbour&quot;
            ],
            &quot;oosc&quot;: 1,
            &quot;trackqty&quot;: 1,
            &quot;review&quot;: [],
            &quot;image&quot;: {
                &quot;id&quot;: 58,
                &quot;pid&quot;: 16,
                &quot;loc&quot;: &quot;storage/products/16/BdCNWYsoj04bZznm.jpg&quot;
            },
            &quot;category&quot;: {
                &quot;id&quot;: 6,
                &quot;name&quot;: &quot;Coconut oil&quot;
            }
        }
    ],
    &quot;first_page_url&quot;: &quot;http://127.0.0.1:8000/api/v1/newproducts?page=1&quot;,
    &quot;from&quot;: 1,
    &quot;last_page&quot;: 3,
    &quot;last_page_url&quot;: &quot;http://127.0.0.1:8000/api/v1/newproducts?page=3&quot;,
    &quot;next_page_url&quot;: &quot;http://127.0.0.1:8000/api/v1/newproducts?page=2&quot;,
    &quot;path&quot;: &quot;http://127.0.0.1:8000/api/v1/newproducts&quot;,
    &quot;per_page&quot;: 15,
    &quot;prev_page_url&quot;: null,
    &quot;to&quot;: 15,
    &quot;total&quot;: 33
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-newproducts" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-newproducts"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-newproducts"></code></pre>
</span>
<span id="execution-error-GETapi-v1-newproducts" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-newproducts"></code></pre>
</span>
<form id="form-GETapi-v1-newproducts" data-method="GET"
      data-path="api/v1/newproducts"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-newproducts', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-newproducts"
                    onclick="tryItOut('GETapi-v1-newproducts');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-newproducts"
                    onclick="cancelTryOut('GETapi-v1-newproducts');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-newproducts" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/newproducts</code></b>
        </p>
                    </form>

            <h2 id="product-GETapi-v1-trendingproducts">Trending Product</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-trendingproducts">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/v1/trendingproducts" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/v1/trendingproducts"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-trendingproducts">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 57
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;current_page&quot;: 1,
    &quot;data&quot;: [
        {
            &quot;id&quot;: 2,
            &quot;name&quot;: &quot;Saffola Gold - Pro Healthy Lifestyle Edible Oil&quot;,
            &quot;created_at&quot;: &quot;2022-02-19T09:51:01.000000Z&quot;,
            &quot;fpricewtas&quot;: 202.65,
            &quot;cid&quot;: 1,
            &quot;scid&quot;: 0,
            &quot;status&quot;: 1,
            &quot;bid&quot;: 2,
            &quot;stock&quot;: -3,
            &quot;disp&quot;: 0,
            &quot;fpricebefdis&quot;: 0,
            &quot;disa&quot;: 0,
            &quot;packingid&quot;: 1,
            &quot;tags&quot;: [
                &quot;Cooking oil&quot;,
                &quot;Sunflower&quot;,
                &quot; Saffola&quot;
            ],
            &quot;oosc&quot;: 1,
            &quot;trackqty&quot;: 1,
            &quot;review&quot;: [
                {
                    &quot;id&quot;: 22,
                    &quot;uid&quot;: 1,
                    &quot;bid&quot;: 0,
                    &quot;pid&quot;: 2,
                    &quot;review&quot;: &quot;i&quot;,
                    &quot;rating&quot;: 3,
                    &quot;status&quot;: 1,
                    &quot;created_at&quot;: &quot;2022-02-20T16:15:22.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2022-02-20T16:15:22.000000Z&quot;,
                    &quot;customer&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Admin&quot;
                    }
                }
            ],
            &quot;image&quot;: {
                &quot;id&quot;: 13,
                &quot;pid&quot;: 2,
                &quot;loc&quot;: &quot;storage/products/2/YQj46b2EIgosISuP.jpg&quot;
            },
            &quot;category&quot;: {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Sunflower Oil&quot;
            }
        },
        {
            &quot;id&quot;: 3,
            &quot;name&quot;: &quot;Sundrop Super Lite Advanced - Sunflower Oil, 1 L Pouch&quot;,
            &quot;created_at&quot;: &quot;2022-02-19T09:51:01.000000Z&quot;,
            &quot;fpricewtas&quot;: 214.2,
            &quot;cid&quot;: 1,
            &quot;scid&quot;: 0,
            &quot;status&quot;: 1,
            &quot;bid&quot;: 3,
            &quot;stock&quot;: -2,
            &quot;disp&quot;: 0,
            &quot;fpricebefdis&quot;: 0,
            &quot;disa&quot;: 0,
            &quot;packingid&quot;: 1,
            &quot;tags&quot;: [
                &quot;Cooking oil&quot;,
                &quot;Sunflower&quot;,
                &quot; Sundrop&quot;
            ],
            &quot;oosc&quot;: 1,
            &quot;trackqty&quot;: 1,
            &quot;review&quot;: [
                {
                    &quot;id&quot;: 24,
                    &quot;uid&quot;: 1,
                    &quot;bid&quot;: 0,
                    &quot;pid&quot;: 3,
                    &quot;review&quot;: &quot;qweqw&quot;,
                    &quot;rating&quot;: 1,
                    &quot;status&quot;: 1,
                    &quot;created_at&quot;: &quot;2022-02-20T19:57:27.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2022-02-20T19:57:27.000000Z&quot;,
                    &quot;customer&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Admin&quot;
                    }
                },
                {
                    &quot;id&quot;: 23,
                    &quot;uid&quot;: 1,
                    &quot;bid&quot;: 0,
                    &quot;pid&quot;: 3,
                    &quot;review&quot;: &quot;asfd&quot;,
                    &quot;rating&quot;: 5,
                    &quot;status&quot;: 1,
                    &quot;created_at&quot;: &quot;2022-02-20T19:56:38.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2022-02-20T19:56:38.000000Z&quot;,
                    &quot;customer&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Admin&quot;
                    }
                },
                {
                    &quot;id&quot;: 5,
                    &quot;uid&quot;: 1,
                    &quot;bid&quot;: 0,
                    &quot;pid&quot;: 3,
                    &quot;review&quot;: &quot;wqe&quot;,
                    &quot;rating&quot;: 3,
                    &quot;status&quot;: 1,
                    &quot;created_at&quot;: &quot;2022-02-20T15:30:18.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2022-02-20T15:30:18.000000Z&quot;,
                    &quot;customer&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Admin&quot;
                    }
                },
                {
                    &quot;id&quot;: 4,
                    &quot;uid&quot;: 1,
                    &quot;bid&quot;: 0,
                    &quot;pid&quot;: 3,
                    &quot;review&quot;: &quot;123&quot;,
                    &quot;rating&quot;: 5,
                    &quot;status&quot;: 1,
                    &quot;created_at&quot;: &quot;2022-02-20T15:30:10.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2022-02-20T15:30:10.000000Z&quot;,
                    &quot;customer&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Admin&quot;
                    }
                },
                {
                    &quot;id&quot;: 3,
                    &quot;uid&quot;: 1,
                    &quot;bid&quot;: 0,
                    &quot;pid&quot;: 3,
                    &quot;review&quot;: &quot;asd&quot;,
                    &quot;rating&quot;: 5,
                    &quot;status&quot;: 1,
                    &quot;created_at&quot;: &quot;2022-02-20T15:29:27.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2022-02-20T15:29:27.000000Z&quot;,
                    &quot;customer&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Admin&quot;
                    }
                },
                {
                    &quot;id&quot;: 2,
                    &quot;uid&quot;: 1,
                    &quot;bid&quot;: 0,
                    &quot;pid&quot;: 3,
                    &quot;review&quot;: &quot;asdadasdas&quot;,
                    &quot;rating&quot;: 5,
                    &quot;status&quot;: 1,
                    &quot;created_at&quot;: &quot;2022-02-20T15:29:23.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2022-02-20T15:29:23.000000Z&quot;,
                    &quot;customer&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Admin&quot;
                    }
                },
                {
                    &quot;id&quot;: 1,
                    &quot;uid&quot;: 1,
                    &quot;bid&quot;: 0,
                    &quot;pid&quot;: 3,
                    &quot;review&quot;: &quot;qweqweqw&quot;,
                    &quot;rating&quot;: 4,
                    &quot;status&quot;: 1,
                    &quot;created_at&quot;: &quot;2022-02-20T15:29:16.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2022-02-20T15:29:16.000000Z&quot;,
                    &quot;customer&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Admin&quot;
                    }
                }
            ],
            &quot;image&quot;: {
                &quot;id&quot;: 16,
                &quot;pid&quot;: 3,
                &quot;loc&quot;: &quot;storage/products/3/yuVqn9ue1VkflwZF.jpg&quot;
            },
            &quot;category&quot;: {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Sunflower Oil&quot;
            }
        },
        {
            &quot;id&quot;: 4,
            &quot;name&quot;: &quot;Gold Winner Refined Groundnut Oil 1 L (Pouch)&quot;,
            &quot;created_at&quot;: &quot;2022-02-19T09:51:01.000000Z&quot;,
            &quot;fpricewtas&quot;: 187.95,
            &quot;cid&quot;: 2,
            &quot;scid&quot;: 0,
            &quot;status&quot;: 1,
            &quot;bid&quot;: 4,
            &quot;stock&quot;: -2,
            &quot;disp&quot;: 0,
            &quot;fpricebefdis&quot;: 0,
            &quot;disa&quot;: 0,
            &quot;packingid&quot;: 1,
            &quot;tags&quot;: [
                &quot;Cooking oil&quot;,
                &quot;Groudnut Oil&quot;,
                &quot;Gold winner&quot;
            ],
            &quot;oosc&quot;: 1,
            &quot;trackqty&quot;: 1,
            &quot;review&quot;: [],
            &quot;image&quot;: {
                &quot;id&quot;: 19,
                &quot;pid&quot;: 4,
                &quot;loc&quot;: &quot;storage/products/4/7XNKQOzrsLS0fl43.jpg&quot;
            },
            &quot;category&quot;: {
                &quot;id&quot;: 2,
                &quot;name&quot;: &quot;Groundnut oil&quot;
            }
        },
        {
            &quot;id&quot;: 5,
            &quot;name&quot;: &quot;Idhayam Oil - Mantra GroundNut, 1 L Pouch&quot;,
            &quot;created_at&quot;: &quot;2022-02-19T09:51:01.000000Z&quot;,
            &quot;fpricewtas&quot;: 210,
            &quot;cid&quot;: 2,
            &quot;scid&quot;: 0,
            &quot;status&quot;: 1,
            &quot;bid&quot;: 5,
            &quot;stock&quot;: -2,
            &quot;disp&quot;: 0,
            &quot;fpricebefdis&quot;: 0,
            &quot;disa&quot;: 0,
            &quot;packingid&quot;: 1,
            &quot;tags&quot;: [
                &quot;Cooking oil&quot;,
                &quot;Groudnut Oil&quot;,
                &quot;Idhayam&quot;
            ],
            &quot;oosc&quot;: 1,
            &quot;trackqty&quot;: 1,
            &quot;review&quot;: [],
            &quot;image&quot;: {
                &quot;id&quot;: 22,
                &quot;pid&quot;: 5,
                &quot;loc&quot;: &quot;storage/products/5/cjWpEFgc7piPtOjA.jpg&quot;
            },
            &quot;category&quot;: {
                &quot;id&quot;: 2,
                &quot;name&quot;: &quot;Groundnut oil&quot;
            }
        },
        {
            &quot;id&quot;: 6,
            &quot;name&quot;: &quot;Mr. Gold Groundnut Oil, 1 L Pouch&quot;,
            &quot;created_at&quot;: &quot;2022-02-19T09:51:01.000000Z&quot;,
            &quot;fpricewtas&quot;: 185.85,
            &quot;cid&quot;: 2,
            &quot;scid&quot;: 0,
            &quot;status&quot;: 1,
            &quot;bid&quot;: 6,
            &quot;stock&quot;: -1,
            &quot;disp&quot;: 0,
            &quot;fpricebefdis&quot;: 0,
            &quot;disa&quot;: 0,
            &quot;packingid&quot;: 1,
            &quot;tags&quot;: [
                &quot;Cooking oil&quot;,
                &quot;Groudnut Oil&quot;,
                &quot;Mr.Gold&quot;
            ],
            &quot;oosc&quot;: 1,
            &quot;trackqty&quot;: 1,
            &quot;review&quot;: [],
            &quot;image&quot;: {
                &quot;id&quot;: 25,
                &quot;pid&quot;: 6,
                &quot;loc&quot;: &quot;storage/products/6/nKg4k9wg59PI1p0k.jpg&quot;
            },
            &quot;category&quot;: {
                &quot;id&quot;: 2,
                &quot;name&quot;: &quot;Groundnut oil&quot;
            }
        },
        {
            &quot;id&quot;: 7,
            &quot;name&quot;: &quot;RKG AGMARK GHEE ,500 ml Pet Jar&quot;,
            &quot;created_at&quot;: &quot;2022-02-19T09:51:01.000000Z&quot;,
            &quot;fpricewtas&quot;: 391.65,
            &quot;cid&quot;: 3,
            &quot;scid&quot;: 0,
            &quot;status&quot;: 1,
            &quot;bid&quot;: 7,
            &quot;stock&quot;: 0,
            &quot;disp&quot;: 0,
            &quot;fpricebefdis&quot;: 0,
            &quot;disa&quot;: 0,
            &quot;packingid&quot;: 2,
            &quot;tags&quot;: [
                &quot;Ghee&quot;,
                &quot;RKG&quot;,
                &quot;Vanaspati&quot;
            ],
            &quot;oosc&quot;: 1,
            &quot;trackqty&quot;: 1,
            &quot;review&quot;: [
                {
                    &quot;id&quot;: 21,
                    &quot;uid&quot;: 1,
                    &quot;bid&quot;: 0,
                    &quot;pid&quot;: 7,
                    &quot;review&quot;: &quot;asdasdasd&quot;,
                    &quot;rating&quot;: 3,
                    &quot;status&quot;: 1,
                    &quot;created_at&quot;: &quot;2022-02-20T15:47:43.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2022-02-20T15:47:43.000000Z&quot;,
                    &quot;customer&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Admin&quot;
                    }
                },
                {
                    &quot;id&quot;: 20,
                    &quot;uid&quot;: 1,
                    &quot;bid&quot;: 0,
                    &quot;pid&quot;: 7,
                    &quot;review&quot;: &quot;asdasd&quot;,
                    &quot;rating&quot;: 1,
                    &quot;status&quot;: 1,
                    &quot;created_at&quot;: &quot;2022-02-20T15:47:36.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2022-02-20T15:47:36.000000Z&quot;,
                    &quot;customer&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Admin&quot;
                    }
                },
                {
                    &quot;id&quot;: 19,
                    &quot;uid&quot;: 1,
                    &quot;bid&quot;: 0,
                    &quot;pid&quot;: 7,
                    &quot;review&quot;: &quot;a&quot;,
                    &quot;rating&quot;: 3,
                    &quot;status&quot;: 1,
                    &quot;created_at&quot;: &quot;2022-02-20T15:47:22.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2022-02-20T15:47:22.000000Z&quot;,
                    &quot;customer&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Admin&quot;
                    }
                },
                {
                    &quot;id&quot;: 18,
                    &quot;uid&quot;: 1,
                    &quot;bid&quot;: 0,
                    &quot;pid&quot;: 7,
                    &quot;review&quot;: &quot;asdf&quot;,
                    &quot;rating&quot;: 2,
                    &quot;status&quot;: 1,
                    &quot;created_at&quot;: &quot;2022-02-20T15:46:53.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2022-02-20T15:46:53.000000Z&quot;,
                    &quot;customer&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Admin&quot;
                    }
                },
                {
                    &quot;id&quot;: 17,
                    &quot;uid&quot;: 1,
                    &quot;bid&quot;: 0,
                    &quot;pid&quot;: 7,
                    &quot;review&quot;: &quot;adsf&quot;,
                    &quot;rating&quot;: 2,
                    &quot;status&quot;: 1,
                    &quot;created_at&quot;: &quot;2022-02-20T15:46:46.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2022-02-20T15:46:46.000000Z&quot;,
                    &quot;customer&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Admin&quot;
                    }
                },
                {
                    &quot;id&quot;: 16,
                    &quot;uid&quot;: 1,
                    &quot;bid&quot;: 0,
                    &quot;pid&quot;: 7,
                    &quot;review&quot;: &quot;as&quot;,
                    &quot;rating&quot;: 4,
                    &quot;status&quot;: 1,
                    &quot;created_at&quot;: &quot;2022-02-20T15:46:38.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2022-02-20T15:46:38.000000Z&quot;,
                    &quot;customer&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Admin&quot;
                    }
                },
                {
                    &quot;id&quot;: 15,
                    &quot;uid&quot;: 1,
                    &quot;bid&quot;: 0,
                    &quot;pid&quot;: 7,
                    &quot;review&quot;: &quot;asdf&quot;,
                    &quot;rating&quot;: 4,
                    &quot;status&quot;: 1,
                    &quot;created_at&quot;: &quot;2022-02-20T15:46:32.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2022-02-20T15:46:32.000000Z&quot;,
                    &quot;customer&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Admin&quot;
                    }
                },
                {
                    &quot;id&quot;: 14,
                    &quot;uid&quot;: 1,
                    &quot;bid&quot;: 0,
                    &quot;pid&quot;: 7,
                    &quot;review&quot;: &quot;asdf&quot;,
                    &quot;rating&quot;: 4,
                    &quot;status&quot;: 1,
                    &quot;created_at&quot;: &quot;2022-02-20T15:46:31.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2022-02-20T15:46:31.000000Z&quot;,
                    &quot;customer&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Admin&quot;
                    }
                },
                {
                    &quot;id&quot;: 13,
                    &quot;uid&quot;: 1,
                    &quot;bid&quot;: 0,
                    &quot;pid&quot;: 7,
                    &quot;review&quot;: &quot;asdf&quot;,
                    &quot;rating&quot;: 5,
                    &quot;status&quot;: 1,
                    &quot;created_at&quot;: &quot;2022-02-20T15:46:25.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2022-02-20T15:46:25.000000Z&quot;,
                    &quot;customer&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Admin&quot;
                    }
                },
                {
                    &quot;id&quot;: 12,
                    &quot;uid&quot;: 1,
                    &quot;bid&quot;: 0,
                    &quot;pid&quot;: 7,
                    &quot;review&quot;: &quot;asd&quot;,
                    &quot;rating&quot;: 5,
                    &quot;status&quot;: 1,
                    &quot;created_at&quot;: &quot;2022-02-20T15:44:31.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2022-02-20T15:44:31.000000Z&quot;,
                    &quot;customer&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Admin&quot;
                    }
                },
                {
                    &quot;id&quot;: 11,
                    &quot;uid&quot;: 1,
                    &quot;bid&quot;: 0,
                    &quot;pid&quot;: 7,
                    &quot;review&quot;: &quot;asdsa&quot;,
                    &quot;rating&quot;: 5,
                    &quot;status&quot;: 1,
                    &quot;created_at&quot;: &quot;2022-02-20T15:43:58.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2022-02-20T15:43:58.000000Z&quot;,
                    &quot;customer&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Admin&quot;
                    }
                },
                {
                    &quot;id&quot;: 10,
                    &quot;uid&quot;: 1,
                    &quot;bid&quot;: 0,
                    &quot;pid&quot;: 7,
                    &quot;review&quot;: &quot;asd&quot;,
                    &quot;rating&quot;: 5,
                    &quot;status&quot;: 1,
                    &quot;created_at&quot;: &quot;2022-02-20T15:43:35.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2022-02-20T15:43:35.000000Z&quot;,
                    &quot;customer&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Admin&quot;
                    }
                },
                {
                    &quot;id&quot;: 9,
                    &quot;uid&quot;: 1,
                    &quot;bid&quot;: 0,
                    &quot;pid&quot;: 7,
                    &quot;review&quot;: &quot;asd&quot;,
                    &quot;rating&quot;: 5,
                    &quot;status&quot;: 1,
                    &quot;created_at&quot;: &quot;2022-02-20T15:43:03.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2022-02-20T15:43:03.000000Z&quot;,
                    &quot;customer&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Admin&quot;
                    }
                },
                {
                    &quot;id&quot;: 8,
                    &quot;uid&quot;: 1,
                    &quot;bid&quot;: 0,
                    &quot;pid&quot;: 7,
                    &quot;review&quot;: &quot;asd&quot;,
                    &quot;rating&quot;: 5,
                    &quot;status&quot;: 1,
                    &quot;created_at&quot;: &quot;2022-02-20T15:41:57.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2022-02-20T15:41:57.000000Z&quot;,
                    &quot;customer&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Admin&quot;
                    }
                },
                {
                    &quot;id&quot;: 7,
                    &quot;uid&quot;: 1,
                    &quot;bid&quot;: 0,
                    &quot;pid&quot;: 7,
                    &quot;review&quot;: &quot;asd&quot;,
                    &quot;rating&quot;: 4,
                    &quot;status&quot;: 1,
                    &quot;created_at&quot;: &quot;2022-02-20T15:41:00.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2022-02-20T15:41:00.000000Z&quot;,
                    &quot;customer&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Admin&quot;
                    }
                },
                {
                    &quot;id&quot;: 6,
                    &quot;uid&quot;: 1,
                    &quot;bid&quot;: 0,
                    &quot;pid&quot;: 7,
                    &quot;review&quot;: &quot;asdasd&quot;,
                    &quot;rating&quot;: 5,
                    &quot;status&quot;: 1,
                    &quot;created_at&quot;: &quot;2022-02-20T15:40:54.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2022-02-20T15:40:54.000000Z&quot;,
                    &quot;customer&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Admin&quot;
                    }
                }
            ],
            &quot;image&quot;: {
                &quot;id&quot;: 28,
                &quot;pid&quot;: 7,
                &quot;loc&quot;: &quot;storage/products/7/GjYn5zwx5xGuQAZt.jpg&quot;
            },
            &quot;category&quot;: {
                &quot;id&quot;: 3,
                &quot;name&quot;: &quot;Ghee&quot;
            }
        },
        {
            &quot;id&quot;: 8,
            &quot;name&quot;: &quot;Grb Ghee, 500 ml Bottle&quot;,
            &quot;created_at&quot;: &quot;2022-02-19T09:51:01.000000Z&quot;,
            &quot;fpricewtas&quot;: 336,
            &quot;cid&quot;: 3,
            &quot;scid&quot;: 0,
            &quot;status&quot;: 1,
            &quot;bid&quot;: 8,
            &quot;stock&quot;: 0,
            &quot;disp&quot;: 0,
            &quot;fpricebefdis&quot;: 0,
            &quot;disa&quot;: 0,
            &quot;packingid&quot;: 2,
            &quot;tags&quot;: [
                &quot;Ghee&quot;,
                &quot;GRB&quot;,
                &quot;Vanaspati&quot;
            ],
            &quot;oosc&quot;: 1,
            &quot;trackqty&quot;: 1,
            &quot;review&quot;: [],
            &quot;image&quot;: {
                &quot;id&quot;: 31,
                &quot;pid&quot;: 8,
                &quot;loc&quot;: &quot;storage/products/8/9A5zcgqyjmgP7qBT.jpg&quot;
            },
            &quot;category&quot;: {
                &quot;id&quot;: 3,
                &quot;name&quot;: &quot;Ghee&quot;
            }
        },
        {
            &quot;id&quot;: 9,
            &quot;name&quot;: &quot;Amul Cow Ghee 1 L (Tin)&quot;,
            &quot;created_at&quot;: &quot;2022-02-19T09:51:01.000000Z&quot;,
            &quot;fpricewtas&quot;: 538.65,
            &quot;cid&quot;: 3,
            &quot;scid&quot;: 0,
            &quot;status&quot;: 1,
            &quot;bid&quot;: 9,
            &quot;stock&quot;: 0,
            &quot;disp&quot;: 0,
            &quot;fpricebefdis&quot;: 0,
            &quot;disa&quot;: 0,
            &quot;packingid&quot;: 3,
            &quot;tags&quot;: [
                &quot;Ghee&quot;,
                &quot;Amul&quot;,
                &quot;Vanaspati&quot;
            ],
            &quot;oosc&quot;: 1,
            &quot;trackqty&quot;: 1,
            &quot;review&quot;: [],
            &quot;image&quot;: {
                &quot;id&quot;: 34,
                &quot;pid&quot;: 9,
                &quot;loc&quot;: &quot;storage/products/9/rPweWxydZrIbdpcU.jpg&quot;
            },
            &quot;category&quot;: {
                &quot;id&quot;: 3,
                &quot;name&quot;: &quot;Ghee&quot;
            }
        },
        {
            &quot;id&quot;: 11,
            &quot;name&quot;: &quot;Kpl Shudhi Gingelly Oil, 500 ml Bottle&quot;,
            &quot;created_at&quot;: &quot;2022-02-19T09:51:01.000000Z&quot;,
            &quot;fpricewtas&quot;: 184.8,
            &quot;cid&quot;: 4,
            &quot;scid&quot;: 0,
            &quot;status&quot;: 1,
            &quot;bid&quot;: 10,
            &quot;stock&quot;: 0,
            &quot;disp&quot;: 0,
            &quot;fpricebefdis&quot;: 0,
            &quot;disa&quot;: 0,
            &quot;packingid&quot;: 4,
            &quot;tags&quot;: [
                &quot;Cooking oil&quot;,
                &quot;Gingelly oil&quot;,
                &quot; KPL&quot;
            ],
            &quot;oosc&quot;: 1,
            &quot;trackqty&quot;: 1,
            &quot;review&quot;: [],
            &quot;image&quot;: {
                &quot;id&quot;: 40,
                &quot;pid&quot;: 11,
                &quot;loc&quot;: &quot;storage/products/11/jn1fH0OSVGH7FY9u.jpg&quot;
            },
            &quot;category&quot;: {
                &quot;id&quot;: 4,
                &quot;name&quot;: &quot;Gingelly Oil&quot;
            }
        },
        {
            &quot;id&quot;: 14,
            &quot;name&quot;: &quot;Aswini Hair Oil 180ml&quot;,
            &quot;created_at&quot;: &quot;2022-02-19T09:51:01.000000Z&quot;,
            &quot;fpricewtas&quot;: 120.75,
            &quot;cid&quot;: 5,
            &quot;scid&quot;: 0,
            &quot;status&quot;: 1,
            &quot;bid&quot;: 12,
            &quot;stock&quot;: 0,
            &quot;disp&quot;: 0,
            &quot;fpricebefdis&quot;: 0,
            &quot;disa&quot;: 0,
            &quot;packingid&quot;: 4,
            &quot;tags&quot;: [
                &quot;Hair Oil&quot;,
                &quot;Edible oil&quot;,
                &quot;Aswini&quot;
            ],
            &quot;oosc&quot;: 1,
            &quot;trackqty&quot;: 1,
            &quot;review&quot;: [],
            &quot;image&quot;: {
                &quot;id&quot;: 52,
                &quot;pid&quot;: 14,
                &quot;loc&quot;: &quot;storage/products/14/tP3jObTQHUMTXgkZ.jpg&quot;
            },
            &quot;category&quot;: {
                &quot;id&quot;: 5,
                &quot;name&quot;: &quot;Hair Oil&quot;
            }
        },
        {
            &quot;id&quot;: 19,
            &quot;name&quot;: &quot;Fortune Refined Rice Bran Oil 1 L&quot;,
            &quot;created_at&quot;: &quot;2022-02-19T09:51:01.000000Z&quot;,
            &quot;fpricewtas&quot;: 175.35,
            &quot;cid&quot;: 7,
            &quot;scid&quot;: 0,
            &quot;status&quot;: 1,
            &quot;bid&quot;: 1,
            &quot;stock&quot;: 0,
            &quot;disp&quot;: 0,
            &quot;fpricebefdis&quot;: 0,
            &quot;disa&quot;: 0,
            &quot;packingid&quot;: 1,
            &quot;tags&quot;: [
                &quot;Cooking oil&quot;,
                &quot;Ricebran oil&quot;,
                &quot;Fortune&quot;
            ],
            &quot;oosc&quot;: 1,
            &quot;trackqty&quot;: 1,
            &quot;review&quot;: [],
            &quot;image&quot;: {
                &quot;id&quot;: 67,
                &quot;pid&quot;: 19,
                &quot;loc&quot;: &quot;storage/products/19/YDoMPWlZAuxdHZMb.jpg&quot;
            },
            &quot;category&quot;: {
                &quot;id&quot;: 7,
                &quot;name&quot;: &quot;Ricebran oil&quot;
            }
        },
        {
            &quot;id&quot;: 30,
            &quot;name&quot;: &quot;Rajinis Pickle - Garlic, 5 kg&quot;,
            &quot;created_at&quot;: &quot;2022-02-19T09:51:01.000000Z&quot;,
            &quot;fpricewtas&quot;: 498.75,
            &quot;cid&quot;: 10,
            &quot;scid&quot;: 0,
            &quot;status&quot;: 1,
            &quot;bid&quot;: 18,
            &quot;stock&quot;: 0,
            &quot;disp&quot;: 0,
            &quot;fpricebefdis&quot;: 0,
            &quot;disa&quot;: 0,
            &quot;packingid&quot;: 4,
            &quot;tags&quot;: [
                &quot;Pickle&quot;,
                &quot;Rajini pickle&quot;,
                &quot;garlic&quot;
            ],
            &quot;oosc&quot;: 1,
            &quot;trackqty&quot;: 1,
            &quot;review&quot;: [],
            &quot;image&quot;: {
                &quot;id&quot;: 96,
                &quot;pid&quot;: 30,
                &quot;loc&quot;: &quot;storage/products/30/GReAR3aWETXuIZZV.jpg&quot;
            },
            &quot;category&quot;: {
                &quot;id&quot;: 10,
                &quot;name&quot;: &quot;Pickle&quot;
            }
        },
        {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;Fortune Sun Lite - Sunflower Refined Oil, 1 L&quot;,
            &quot;created_at&quot;: &quot;2022-02-19T09:51:00.000000Z&quot;,
            &quot;fpricewtas&quot;: 140.7,
            &quot;cid&quot;: 1,
            &quot;scid&quot;: 0,
            &quot;status&quot;: 1,
            &quot;bid&quot;: 1,
            &quot;stock&quot;: 0,
            &quot;disp&quot;: 0,
            &quot;fpricebefdis&quot;: 0,
            &quot;disa&quot;: 0,
            &quot;packingid&quot;: 1,
            &quot;tags&quot;: [
                &quot;Cooking oil&quot;,
                &quot;Sunflower&quot;,
                &quot; Fortune&quot;
            ],
            &quot;oosc&quot;: 1,
            &quot;trackqty&quot;: 1,
            &quot;review&quot;: [],
            &quot;image&quot;: {
                &quot;id&quot;: 7,
                &quot;pid&quot;: 1,
                &quot;loc&quot;: &quot;storage/products/1/3bInOpKf6do9Z08N.jpg&quot;
            },
            &quot;category&quot;: {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Sunflower Oil&quot;
            }
        }
    ],
    &quot;first_page_url&quot;: &quot;http://127.0.0.1:8000/api/v1/trendingproducts?page=1&quot;,
    &quot;from&quot;: 1,
    &quot;last_page&quot;: 1,
    &quot;last_page_url&quot;: &quot;http://127.0.0.1:8000/api/v1/trendingproducts?page=1&quot;,
    &quot;next_page_url&quot;: null,
    &quot;path&quot;: &quot;http://127.0.0.1:8000/api/v1/trendingproducts&quot;,
    &quot;per_page&quot;: 15,
    &quot;prev_page_url&quot;: null,
    &quot;to&quot;: 13,
    &quot;total&quot;: 13
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-trendingproducts" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-trendingproducts"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-trendingproducts"></code></pre>
</span>
<span id="execution-error-GETapi-v1-trendingproducts" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-trendingproducts"></code></pre>
</span>
<form id="form-GETapi-v1-trendingproducts" data-method="GET"
      data-path="api/v1/trendingproducts"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-trendingproducts', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-trendingproducts"
                    onclick="tryItOut('GETapi-v1-trendingproducts');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-trendingproducts"
                    onclick="cancelTryOut('GETapi-v1-trendingproducts');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-trendingproducts" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/trendingproducts</code></b>
        </p>
                    </form>

            <h2 id="product-GETapi-v1-topselling">Top Selling</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-topselling">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/v1/topselling" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/v1/topselling"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-topselling">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 56
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;current_page&quot;: 1,
    &quot;data&quot;: [
        {
            &quot;id&quot;: 2,
            &quot;name&quot;: &quot;Saffola Gold - Pro Healthy Lifestyle Edible Oil&quot;,
            &quot;created_at&quot;: &quot;2022-02-19T09:51:01.000000Z&quot;,
            &quot;fpricewtas&quot;: 202.65,
            &quot;cid&quot;: 1,
            &quot;scid&quot;: 0,
            &quot;status&quot;: 1,
            &quot;bid&quot;: 2,
            &quot;stock&quot;: -3,
            &quot;disp&quot;: 0,
            &quot;fpricebefdis&quot;: 0,
            &quot;disa&quot;: 0,
            &quot;packingid&quot;: 1,
            &quot;tags&quot;: [
                &quot;Cooking oil&quot;,
                &quot;Sunflower&quot;,
                &quot; Saffola&quot;
            ],
            &quot;oosc&quot;: 1,
            &quot;trackqty&quot;: 1,
            &quot;review&quot;: [
                {
                    &quot;id&quot;: 22,
                    &quot;uid&quot;: 1,
                    &quot;bid&quot;: 0,
                    &quot;pid&quot;: 2,
                    &quot;review&quot;: &quot;i&quot;,
                    &quot;rating&quot;: 3,
                    &quot;status&quot;: 1,
                    &quot;created_at&quot;: &quot;2022-02-20T16:15:22.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2022-02-20T16:15:22.000000Z&quot;,
                    &quot;customer&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Admin&quot;
                    }
                }
            ],
            &quot;image&quot;: {
                &quot;id&quot;: 13,
                &quot;pid&quot;: 2,
                &quot;loc&quot;: &quot;storage/products/2/YQj46b2EIgosISuP.jpg&quot;
            },
            &quot;category&quot;: {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Sunflower Oil&quot;
            }
        },
        {
            &quot;id&quot;: 3,
            &quot;name&quot;: &quot;Sundrop Super Lite Advanced - Sunflower Oil, 1 L Pouch&quot;,
            &quot;created_at&quot;: &quot;2022-02-19T09:51:01.000000Z&quot;,
            &quot;fpricewtas&quot;: 214.2,
            &quot;cid&quot;: 1,
            &quot;scid&quot;: 0,
            &quot;status&quot;: 1,
            &quot;bid&quot;: 3,
            &quot;stock&quot;: -2,
            &quot;disp&quot;: 0,
            &quot;fpricebefdis&quot;: 0,
            &quot;disa&quot;: 0,
            &quot;packingid&quot;: 1,
            &quot;tags&quot;: [
                &quot;Cooking oil&quot;,
                &quot;Sunflower&quot;,
                &quot; Sundrop&quot;
            ],
            &quot;oosc&quot;: 1,
            &quot;trackqty&quot;: 1,
            &quot;review&quot;: [
                {
                    &quot;id&quot;: 24,
                    &quot;uid&quot;: 1,
                    &quot;bid&quot;: 0,
                    &quot;pid&quot;: 3,
                    &quot;review&quot;: &quot;qweqw&quot;,
                    &quot;rating&quot;: 1,
                    &quot;status&quot;: 1,
                    &quot;created_at&quot;: &quot;2022-02-20T19:57:27.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2022-02-20T19:57:27.000000Z&quot;,
                    &quot;customer&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Admin&quot;
                    }
                },
                {
                    &quot;id&quot;: 23,
                    &quot;uid&quot;: 1,
                    &quot;bid&quot;: 0,
                    &quot;pid&quot;: 3,
                    &quot;review&quot;: &quot;asfd&quot;,
                    &quot;rating&quot;: 5,
                    &quot;status&quot;: 1,
                    &quot;created_at&quot;: &quot;2022-02-20T19:56:38.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2022-02-20T19:56:38.000000Z&quot;,
                    &quot;customer&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Admin&quot;
                    }
                },
                {
                    &quot;id&quot;: 5,
                    &quot;uid&quot;: 1,
                    &quot;bid&quot;: 0,
                    &quot;pid&quot;: 3,
                    &quot;review&quot;: &quot;wqe&quot;,
                    &quot;rating&quot;: 3,
                    &quot;status&quot;: 1,
                    &quot;created_at&quot;: &quot;2022-02-20T15:30:18.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2022-02-20T15:30:18.000000Z&quot;,
                    &quot;customer&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Admin&quot;
                    }
                },
                {
                    &quot;id&quot;: 4,
                    &quot;uid&quot;: 1,
                    &quot;bid&quot;: 0,
                    &quot;pid&quot;: 3,
                    &quot;review&quot;: &quot;123&quot;,
                    &quot;rating&quot;: 5,
                    &quot;status&quot;: 1,
                    &quot;created_at&quot;: &quot;2022-02-20T15:30:10.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2022-02-20T15:30:10.000000Z&quot;,
                    &quot;customer&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Admin&quot;
                    }
                },
                {
                    &quot;id&quot;: 3,
                    &quot;uid&quot;: 1,
                    &quot;bid&quot;: 0,
                    &quot;pid&quot;: 3,
                    &quot;review&quot;: &quot;asd&quot;,
                    &quot;rating&quot;: 5,
                    &quot;status&quot;: 1,
                    &quot;created_at&quot;: &quot;2022-02-20T15:29:27.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2022-02-20T15:29:27.000000Z&quot;,
                    &quot;customer&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Admin&quot;
                    }
                },
                {
                    &quot;id&quot;: 2,
                    &quot;uid&quot;: 1,
                    &quot;bid&quot;: 0,
                    &quot;pid&quot;: 3,
                    &quot;review&quot;: &quot;asdadasdas&quot;,
                    &quot;rating&quot;: 5,
                    &quot;status&quot;: 1,
                    &quot;created_at&quot;: &quot;2022-02-20T15:29:23.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2022-02-20T15:29:23.000000Z&quot;,
                    &quot;customer&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Admin&quot;
                    }
                },
                {
                    &quot;id&quot;: 1,
                    &quot;uid&quot;: 1,
                    &quot;bid&quot;: 0,
                    &quot;pid&quot;: 3,
                    &quot;review&quot;: &quot;qweqweqw&quot;,
                    &quot;rating&quot;: 4,
                    &quot;status&quot;: 1,
                    &quot;created_at&quot;: &quot;2022-02-20T15:29:16.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2022-02-20T15:29:16.000000Z&quot;,
                    &quot;customer&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Admin&quot;
                    }
                }
            ],
            &quot;image&quot;: {
                &quot;id&quot;: 16,
                &quot;pid&quot;: 3,
                &quot;loc&quot;: &quot;storage/products/3/yuVqn9ue1VkflwZF.jpg&quot;
            },
            &quot;category&quot;: {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Sunflower Oil&quot;
            }
        },
        {
            &quot;id&quot;: 4,
            &quot;name&quot;: &quot;Gold Winner Refined Groundnut Oil 1 L (Pouch)&quot;,
            &quot;created_at&quot;: &quot;2022-02-19T09:51:01.000000Z&quot;,
            &quot;fpricewtas&quot;: 187.95,
            &quot;cid&quot;: 2,
            &quot;scid&quot;: 0,
            &quot;status&quot;: 1,
            &quot;bid&quot;: 4,
            &quot;stock&quot;: -2,
            &quot;disp&quot;: 0,
            &quot;fpricebefdis&quot;: 0,
            &quot;disa&quot;: 0,
            &quot;packingid&quot;: 1,
            &quot;tags&quot;: [
                &quot;Cooking oil&quot;,
                &quot;Groudnut Oil&quot;,
                &quot;Gold winner&quot;
            ],
            &quot;oosc&quot;: 1,
            &quot;trackqty&quot;: 1,
            &quot;review&quot;: [],
            &quot;image&quot;: {
                &quot;id&quot;: 19,
                &quot;pid&quot;: 4,
                &quot;loc&quot;: &quot;storage/products/4/7XNKQOzrsLS0fl43.jpg&quot;
            },
            &quot;category&quot;: {
                &quot;id&quot;: 2,
                &quot;name&quot;: &quot;Groundnut oil&quot;
            }
        },
        {
            &quot;id&quot;: 5,
            &quot;name&quot;: &quot;Idhayam Oil - Mantra GroundNut, 1 L Pouch&quot;,
            &quot;created_at&quot;: &quot;2022-02-19T09:51:01.000000Z&quot;,
            &quot;fpricewtas&quot;: 210,
            &quot;cid&quot;: 2,
            &quot;scid&quot;: 0,
            &quot;status&quot;: 1,
            &quot;bid&quot;: 5,
            &quot;stock&quot;: -2,
            &quot;disp&quot;: 0,
            &quot;fpricebefdis&quot;: 0,
            &quot;disa&quot;: 0,
            &quot;packingid&quot;: 1,
            &quot;tags&quot;: [
                &quot;Cooking oil&quot;,
                &quot;Groudnut Oil&quot;,
                &quot;Idhayam&quot;
            ],
            &quot;oosc&quot;: 1,
            &quot;trackqty&quot;: 1,
            &quot;review&quot;: [],
            &quot;image&quot;: {
                &quot;id&quot;: 22,
                &quot;pid&quot;: 5,
                &quot;loc&quot;: &quot;storage/products/5/cjWpEFgc7piPtOjA.jpg&quot;
            },
            &quot;category&quot;: {
                &quot;id&quot;: 2,
                &quot;name&quot;: &quot;Groundnut oil&quot;
            }
        },
        {
            &quot;id&quot;: 6,
            &quot;name&quot;: &quot;Mr. Gold Groundnut Oil, 1 L Pouch&quot;,
            &quot;created_at&quot;: &quot;2022-02-19T09:51:01.000000Z&quot;,
            &quot;fpricewtas&quot;: 185.85,
            &quot;cid&quot;: 2,
            &quot;scid&quot;: 0,
            &quot;status&quot;: 1,
            &quot;bid&quot;: 6,
            &quot;stock&quot;: -1,
            &quot;disp&quot;: 0,
            &quot;fpricebefdis&quot;: 0,
            &quot;disa&quot;: 0,
            &quot;packingid&quot;: 1,
            &quot;tags&quot;: [
                &quot;Cooking oil&quot;,
                &quot;Groudnut Oil&quot;,
                &quot;Mr.Gold&quot;
            ],
            &quot;oosc&quot;: 1,
            &quot;trackqty&quot;: 1,
            &quot;review&quot;: [],
            &quot;image&quot;: {
                &quot;id&quot;: 25,
                &quot;pid&quot;: 6,
                &quot;loc&quot;: &quot;storage/products/6/nKg4k9wg59PI1p0k.jpg&quot;
            },
            &quot;category&quot;: {
                &quot;id&quot;: 2,
                &quot;name&quot;: &quot;Groundnut oil&quot;
            }
        },
        {
            &quot;id&quot;: 15,
            &quot;name&quot;: &quot;Dabur Almond Hair Oil for Damage Free Hair 500 ml&quot;,
            &quot;created_at&quot;: &quot;2022-02-19T09:51:01.000000Z&quot;,
            &quot;fpricewtas&quot;: 241.5,
            &quot;cid&quot;: 5,
            &quot;scid&quot;: 0,
            &quot;status&quot;: 1,
            &quot;bid&quot;: 13,
            &quot;stock&quot;: -3,
            &quot;disp&quot;: 0,
            &quot;fpricebefdis&quot;: 0,
            &quot;disa&quot;: 0,
            &quot;packingid&quot;: 4,
            &quot;tags&quot;: [
                &quot;Hair Oil&quot;,
                &quot;Edible oil&quot;,
                &quot;&quot;
            ],
            &quot;oosc&quot;: 1,
            &quot;trackqty&quot;: 1,
            &quot;review&quot;: [],
            &quot;image&quot;: {
                &quot;id&quot;: 54,
                &quot;pid&quot;: 15,
                &quot;loc&quot;: &quot;storage/products/15/Rr9cgmz9NTRfQdrI.jpg&quot;
            },
            &quot;category&quot;: {
                &quot;id&quot;: 5,
                &quot;name&quot;: &quot;Hair Oil&quot;
            }
        },
        {
            &quot;id&quot;: 20,
            &quot;name&quot;: &quot;Mr. Gold Refined Oil - Rice Bran, 1 L Pouch&quot;,
            &quot;created_at&quot;: &quot;2022-02-19T09:51:01.000000Z&quot;,
            &quot;fpricewtas&quot;: 178.5,
            &quot;cid&quot;: 7,
            &quot;scid&quot;: 0,
            &quot;status&quot;: 1,
            &quot;bid&quot;: 6,
            &quot;stock&quot;: -1,
            &quot;disp&quot;: 0,
            &quot;fpricebefdis&quot;: 0,
            &quot;disa&quot;: 0,
            &quot;packingid&quot;: 1,
            &quot;tags&quot;: [
                &quot;Cooking oil&quot;,
                &quot;Ricebran oil&quot;,
                &quot;Mr.Gold&quot;
            ],
            &quot;oosc&quot;: 1,
            &quot;trackqty&quot;: 1,
            &quot;review&quot;: [],
            &quot;image&quot;: {
                &quot;id&quot;: 70,
                &quot;pid&quot;: 20,
                &quot;loc&quot;: &quot;storage/products/20/1V6ZirFO4Smibu9G.jpg&quot;
            },
            &quot;category&quot;: {
                &quot;id&quot;: 7,
                &quot;name&quot;: &quot;Ricebran oil&quot;
            }
        },
        {
            &quot;id&quot;: 21,
            &quot;name&quot;: &quot;Orysa Refined Rice Bran Oil 1 L&quot;,
            &quot;created_at&quot;: &quot;2022-02-19T09:51:01.000000Z&quot;,
            &quot;fpricewtas&quot;: 159.6,
            &quot;cid&quot;: 7,
            &quot;scid&quot;: 0,
            &quot;status&quot;: 1,
            &quot;bid&quot;: 1,
            &quot;stock&quot;: -1,
            &quot;disp&quot;: 0,
            &quot;fpricebefdis&quot;: 0,
            &quot;disa&quot;: 0,
            &quot;packingid&quot;: 1,
            &quot;tags&quot;: [
                &quot;Cooking oil&quot;,
                &quot;Ricebran oil&quot;,
                &quot;Orysa&quot;
            ],
            &quot;oosc&quot;: 1,
            &quot;trackqty&quot;: 1,
            &quot;review&quot;: [],
            &quot;image&quot;: {
                &quot;id&quot;: 73,
                &quot;pid&quot;: 21,
                &quot;loc&quot;: &quot;storage/products/21/qb2w9ZNp9Ym45RuV.jpg&quot;
            },
            &quot;category&quot;: {
                &quot;id&quot;: 7,
                &quot;name&quot;: &quot;Ricebran oil&quot;
            }
        }
    ],
    &quot;first_page_url&quot;: &quot;http://127.0.0.1:8000/api/v1/topselling?page=1&quot;,
    &quot;from&quot;: 1,
    &quot;last_page&quot;: 1,
    &quot;last_page_url&quot;: &quot;http://127.0.0.1:8000/api/v1/topselling?page=1&quot;,
    &quot;next_page_url&quot;: null,
    &quot;path&quot;: &quot;http://127.0.0.1:8000/api/v1/topselling&quot;,
    &quot;per_page&quot;: 15,
    &quot;prev_page_url&quot;: null,
    &quot;to&quot;: 8,
    &quot;total&quot;: 8
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-topselling" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-topselling"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-topselling"></code></pre>
</span>
<span id="execution-error-GETapi-v1-topselling" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-topselling"></code></pre>
</span>
<form id="form-GETapi-v1-topselling" data-method="GET"
      data-path="api/v1/topselling"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-topselling', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-topselling"
                    onclick="tryItOut('GETapi-v1-topselling');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-topselling"
                    onclick="cancelTryOut('GETapi-v1-topselling');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-topselling" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/topselling</code></b>
        </p>
                    </form>

            <h2 id="product-POSTapi-v1-cart-add">Add to Cart</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-cart-add">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://127.0.0.1:8000/api/v1/cart/add" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"uid\": \"dolorem\",
    \"pid\": \"velit\",
    \"qty\": \"eos\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/v1/cart/add"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "uid": "dolorem",
    "pid": "velit",
    "qty": "eos"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-cart-add">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json">{
    &quot;success&quot;: true,
    &quot;title&quot;: &quot;&quot;,
    &quot;message&quot;: &quot;&quot;,
    &quot;data&quot;: {}
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json">{
    &quot;success&quot;: false,
    &quot;title&quot;: &quot;&quot;,
    &quot;message&quot;: &quot;&quot;,
    &quot;data&quot;: {}
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-v1-cart-add" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-cart-add"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-cart-add"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-cart-add" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-cart-add"></code></pre>
</span>
<form id="form-POSTapi-v1-cart-add" data-method="POST"
      data-path="api/v1/cart/add"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-cart-add', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-cart-add"
                    onclick="tryItOut('POSTapi-v1-cart-add');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-cart-add"
                    onclick="cancelTryOut('POSTapi-v1-cart-add');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-cart-add" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/cart/add</code></b>
        </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>uid</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="uid"
               data-endpoint="POSTapi-v1-cart-add"
               value="dolorem"
               data-component="body" hidden>
    <br>
<p>User id</p>
        </p>
                <p>
            <b><code>pid</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="pid"
               data-endpoint="POSTapi-v1-cart-add"
               value="velit"
               data-component="body" hidden>
    <br>
<p>Product id</p>
        </p>
                <p>
            <b><code>qty</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="qty"
               data-endpoint="POSTapi-v1-cart-add"
               value="eos"
               data-component="body" hidden>
    <br>
<p>Quantity</p>
        </p>
        </form>

            <h2 id="product-POSTapi-v1-wishlist-add">Add to Wishlist</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-wishlist-add">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://127.0.0.1:8000/api/v1/wishlist/add" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"uid\": \"est\",
    \"pid\": \"quia\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/v1/wishlist/add"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "uid": "est",
    "pid": "quia"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-wishlist-add">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json">{
    &quot;success&quot;: true,
    &quot;title&quot;: &quot;Hurrey&quot;,
    &quot;message&quot;: &quot;Added to wishlist successfully&quot;,
    &quot;data&quot;: {}
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json">{
    &quot;success&quot;: false,
    &quot;title&quot;: &quot;&quot;,
    &quot;message&quot;: &quot;&quot;,
    &quot;data&quot;: {}
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-v1-wishlist-add" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-wishlist-add"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-wishlist-add"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-wishlist-add" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-wishlist-add"></code></pre>
</span>
<form id="form-POSTapi-v1-wishlist-add" data-method="POST"
      data-path="api/v1/wishlist/add"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-wishlist-add', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-wishlist-add"
                    onclick="tryItOut('POSTapi-v1-wishlist-add');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-wishlist-add"
                    onclick="cancelTryOut('POSTapi-v1-wishlist-add');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-wishlist-add" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/wishlist/add</code></b>
        </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>uid</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="uid"
               data-endpoint="POSTapi-v1-wishlist-add"
               value="est"
               data-component="body" hidden>
    <br>
<p>User id</p>
        </p>
                <p>
            <b><code>pid</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="pid"
               data-endpoint="POSTapi-v1-wishlist-add"
               value="quia"
               data-component="body" hidden>
    <br>
<p>Product id</p>
        </p>
        </form>




    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                            </div>
            </div>
</div>
</body>
</html>
