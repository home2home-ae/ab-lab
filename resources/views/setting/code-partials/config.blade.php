<!-- HTML generated using hilite.me -->
<div
    style="background: #ffffff; overflow:auto;width:auto;border:solid gray;border-width:.1em .1em .1em .8em;padding:.2em .6em;"><pre
        style="margin: 0; line-height: 125%"><span style="color: #557799">&lt;?php</span>

<span style="color: #008800; font-weight: bold">return</span> [

    <span style="color: #888888">// api, redis</span>
    <span style="background-color: #fff0f0">&#39;implementation&#39;</span> <span
            style="color: #333333">=&gt;</span> <span style="background-color: #fff0f0">&#39;redis&#39;</span>,


    <span style="background-color: #fff0f0">&#39;api&#39;</span> <span style="color: #333333">=&gt;</span> [
        <span style="background-color: #fff0f0">&#39;base_url&#39;</span> <span
            style="color: #333333">=&gt;</span> <span style="background-color: #fff0f0">&#39;http://ab-test.loc/api&#39;</span>,
        <span style="background-color: #fff0f0">&#39;token&#39;</span> <span style="color: #333333">=&gt;</span> <span
            style="color: #008800; font-weight: bold">null</span>,
    ],

    <span style="background-color: #fff0f0">&#39;redis&#39;</span> <span style="color: #333333">=&gt;</span> [
        <span style="background-color: #fff0f0">&#39;host&#39;</span> <span style="color: #333333">=&gt;</span> <span
            style="background-color: #fff0f0">&#39;{{ env('AB_LAB_DB_IP')  }}&#39;</span>,
        <span style="background-color: #fff0f0">&#39;password&#39;</span> <span
            style="color: #333333">=&gt;</span> <span style="color: #008800; font-weight: bold">null</span>,
        <span style="background-color: #fff0f0">&#39;port&#39;</span> <span style="color: #333333">=&gt;</span> <span
            style="background-color: #fff0f0">&#39;6379&#39;</span>,
        <span style="background-color: #fff0f0">&#39;database&#39;</span> <span
            style="color: #333333">=&gt;</span> <span
            style="background-color: #fff0f0">&#39;{{ env('REDIS_DB') }}&#39;</span>,
        <span style="background-color: #fff0f0">&#39;prefix&#39;</span> <span style="color: #333333">=&gt;</span> <span
            style="background-color: #fff0f0">&#39;{{ env('REDIS_PREFIX') }}&#39;</span>
    ]
];
</pre>
</div>
