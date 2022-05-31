# w43322.github.io

<html>
    <head>
        <script src="https://cdn.staticfile.org/crypto-js/3.1.9-1/crypto-js.min.js"></script>
    </head>
    <body>
        <p>NEU WebVPN 工具</p>
        <div>使用方法：在下面文本框内填入要访问的域名（不带前后缀），点击按钮。</div>
        <div>
            <input value="neu.edu.cn" type="text" id="url-input">
            <button id="convert">获取WebVPN链接</button>
        </div>
        <a id="converted-link" href="https://neu.edu.cn/">用东北大学WebVPN打开neu.edu.cn</a>
        <div>免责声明：本工具仅用于生成WebVPN链接，用于其他用途后果自负。</div>
        <script src="webvpn.js"></script>
    </body>
</html>