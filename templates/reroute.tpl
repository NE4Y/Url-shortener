<!DOCTYPE>
<html>
<head>
    <title>Rerouting</title>
    <link rel="stylesheet" type="text/css" href="templates/assets/css/core.css" />

</head>
<body>
<h1>Mapping ...</h1>

{if isset($errorMsg)}
    <p>{$errorMsg}</p>
{/if}

{if isset($notify)}
    <section id="notifyBox">
        <ul>
            {foreach from=$notify item=$n}
                <li>{$n}</li>
            {/foreach}
        </ul>
    </section>
{/if}
</body>
</html>

