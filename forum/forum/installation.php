<html>
<head>
  <meta charset="UTF-8">
  <title>Forum Installation</title>
  <style>

    * {
      padding: 0;
      margin: 0;
      font-family: Helvetica;
    }
    body {
      margin: 3em;
      font-size: 1em;
      line-height: 1.5em;
    }
    h1 {
      margin-bottom: 1em;
    }
    h2 {
      margin-bottom: 1em;
      font-weight: 400;
    }
    p {
      margin-bottom: 1.5em;
    }
    code pre {
      display: block;
      margin-bottom: 1.5em;
      background: #eee;
      padding: 1.5em;
    }


  </style>
</head>
<body>

<h1>Kirby Forum Installation</h1>

<h2>Config.php</h2>

<p>
  Your forum is not configured correctly yet.
  Please make sure to add the following to
  <strong>site/config/config.php</strong>:
</p>

<code>
  <pre><?php echo html(f::read(__DIR__ . DS . 'config.php')) ?></pre>
</code>

<h2>Accounts</h2>
The <strong>site/accounts</strong> folder must be writable

<pre>
  <code>
  </code>
</pre>

</body>
</html>