<!-- HTML generated using hilite.me -->
<div
    style="background: #ffffff; overflow:auto;width:auto;border:solid gray;border-width:.1em .1em .1em .8em;padding:.2em .6em;"><pre
        style="margin: 0; line-height: 125%"><span style="color: #557799">&lt;?php</span>

<span style="color: #008800; font-weight: bold">use</span> ABLab\Accessor\ABLabAccessor;
<span style="color: #008800; font-weight: bold">use</span> ABLab\Accessor\Data\FeatureTreatment;
<span style="color: #008800; font-weight: bold">use</span> ABLab\Accessor\Request\Builder\TreatmentRequestBuilder;
<span style="color: #008800; font-weight: bold">use</span> Illuminate\Support\Facades\Route;
<span style="color: #008800; font-weight: bold">use</span> Illuminate\Support\Facades\Redis;


Route<span style="color: #333333">::</span><span style="color: #0000CC">get</span>(<span
            style="background-color: #fff0f0">&#39;/test&#39;</span>, <span
            style="color: #008800; font-weight: bold">function</span> () {

    <span style="color: #996633">$feature</span> <span style="color: #333333">=</span> <span
            style="background-color: #fff0f0">&#39;AB_TEST_1_BP0_12000_3543&#39;</span>;
    <span style="color: #996633">$defaultTreatment</span> <span style="color: #333333">=</span> FeatureTreatment<span
            style="color: #333333">::</span><span style="color: #0000CC">C</span>;
    <span style="color: #996633">$entityId</span> <span style="color: #333333">=</span> <span
            style="background-color: #fff0f0">&#39;555&#39;</span>;

    <span style="color: #996633">$treatmentRequest</span> <span
            style="color: #333333">=</span> TreatmentRequestBuilder<span style="color: #333333">::</span><span
            style="color: #0000CC">builder</span>()
        <span style="color: #333333">-&gt;</span><span style="color: #0000CC">setFeatureName</span>(<span
            style="color: #996633">$feature</span>)
        <span style="color: #333333">-&gt;</span><span style="color: #0000CC">setDefaultTreatment</span>(<span
            style="color: #996633">$defaultTreatment</span>)
        <span style="color: #333333">-&gt;</span><span style="color: #0000CC">setEntityId</span>(<span
            style="color: #996633">$entityId</span>)
        <span style="color: #333333">-&gt;</span><span style="color: #0000CC">build</span>();

    <span style="color: #DD4422">/** @var ABLabAccessor $manager */</span>
    <span style="color: #996633">$manager</span> <span style="color: #333333">=</span> app(<span
            style="background-color: #fff0f0">&#39;ab-lab-accessor&#39;</span>);

    <span style="color: #996633">$treatment</span> <span style="color: #333333">=</span> <span style="color: #996633">$manager</span><span
            style="color: #333333">-&gt;</span><span style="color: #0000CC">getTreatment</span>(<span
            style="color: #996633">$treatmentRequest</span>);

    <span style="color: #888888">// if true mean feature is not launched (C)</span>
    <span style="color: #008800; font-weight: bold">echo</span> FeatureTreatment<span
            style="color: #333333">::</span><span style="color: #0000CC">C</span> <span style="color: #333333">==</span> <span
            style="color: #996633">$treatment</span>;

    <span style="color: #888888">// if true mean feature is launched (T1)</span>
    <span style="color: #008800; font-weight: bold">echo</span> FeatureTreatment<span
            style="color: #333333">::</span><span style="color: #0000CC">T1</span> <span style="color: #333333">==</span> <span
            style="color: #996633">$treatment</span>;

});
</pre>
</div>
