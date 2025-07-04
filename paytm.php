<!DOCTYPE html>
<!--
 Copyright 2024 Google LLC

 Licensed under the Apache License, Version 2.0 (the "License");
 you may not use this file except in compliance with the License.
 You may obtain a copy of the License at

      http://www.apache.org/licenses/LICENSE-2.0

 Unless required by applicable law or agreed to in writing, software
 distributed under the License is distributed on an "AS IS" BASIS,
 WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 See the License for the specific language governing permissions and
 limitations under the License.
-->
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Google Pay API for Web</title>
  </head>

  <body>
    <div id="gpay-container"></div>
    <p>Transaction info and errors will be logged to the console.</p>
    <script type="text/javascript" src="main.js"></script>
    <script async src="https://pay.google.com/gp/p/js/pay.js" onload="onGooglePayLoaded()"></script>

    <div class="container" style="display: flex; align-items: center">
      <p>If running on IDX, Click</p>
      <img
        src="https://fonts.gstatic.com/s/i/short-term/release/googlesymbols/open_in_new/default/40px.svg"
        width="32"
        alt="open new window icon"
      />
      <p>to open this page in a separate window in order for the Google Pay button to work.</p>
    </div>
  </body>
</html>
